<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Models\BetweenCity;
use App\Models\StationWallet;
use App\Models\Travel;
use App\Models\Wallet;
use App\Models\PackageType;        
use App\Models\Subscription;       
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TravelController extends Controller
{
    public function travels(Request $request)
    {
        $status = $request->get('status');
        $query = Travel::with('appUser')->whereHas('appUser');

        if ($status) {
            $query->where('status', $status);
        }

        $travels = $query->get();
        return view('admin.transport.travel.travel', compact('travels', 'status'));
    }

    public function allUserTravell($user, $status)
    {
        $travels = Travel::where('user_id', $user)->where('status', $status)->get();
        return response()->json([
            'success' => true,
            'message' => 'User Travel',
            'data' => ['travels' => $travels->load('client')]
        ], 201);
    }

    public function updateTravellStatus(Request $request, $id)
    {
        $travel = Travel::find($id);

        if (!$travel) {
            return response()->json([
                'success' => false,
                'message' => 'Travel not found',
            ], 404);
        }

        if (!$request->has('status')) {
            return response()->json([
                'success' => false,
                'message' => 'Status is required',
            ], 400);
        }

        $travel->status = $request->status;
        $travel->save();

        return response()->json([
            'success' => true,
            'message' => 'Travel status updated successfully',
            'data' => ['travel' => $travel->load('client')]
        ], 200);
    }

    // ✅ NEW METHODS - TRAVEL CREATION LOGIC MOVED HERE

    /**
     * Create travel for unassigned ride (no driver yet)
     */
    public function createUnassignedTravel(array $data)
    {
        return Travel::create([
            'from' => $data['from'],
            'to' => $data['to'],
            'date' => $data['date'],
            'amount' => $data['amount'],
            'time' => $data['time'],
            'status' => 'Waiting',
            'user_id' => null, // No driver assigned yet
            'passengers' => $data['passengers'],
            'between_city_id' => $data['between_city_id'],
            'round_trip' => $data['round_trip'] ?? false
        ]);
    }

    /**
     * Create travel with driver assigned
     */
    public function createAssignedTravel(array $data)
    {
        return Travel::create([
            'from' => $data['from'],
            'to' => $data['to'],
            'date' => $data['date'],
            'amount' => $data['amount'],
            'time' => $data['time'],
            'status' => 'Waiting',
            'user_id' => $data['user_id'],
            'passengers' => $data['passengers'],
            'between_city_id' => $data['between_city_id'],
            'round_trip' => $data['round_trip'] ?? false
        ]);
    }

    /**
     * Create travel with client (passenger who booked)
     */
    public function createClientTravel(array $data)
    {
        return Travel::create([
            'from' => $data['from'],
            'to' => $data['to'],
            'date' => $data['date'],
            'amount' => $data['amount'],
            'time' => $data['time'],
            'status' => 'Waiting',
            'user_id' => $data['user_id'] ?? null,
            'client_id' => $data['client_id'],
            'passengers' => $data['passengers'],
            'latitude_from' => $data['latitude_from'] ?? null,
            'longitude_from' => $data['longitude_from'] ?? null,
            'latitude_to' => $data['latitude_to'] ?? null,
            'longitude_to' => $data['longitude_to'] ?? null,
            'between_city_id' => $data['between_city_id'],
            'round_trip' => $data['round_trip'] ?? false
        ]);
    }

    /**
     * Check if travel already exists
     */
    public function findExistingTravel(array $criteria)
    {
        return Travel::where('from', $criteria['from'])
            ->where('to', $criteria['to'])
            ->where('date', $criteria['date'])
            ->where('time', $criteria['time'])
            ->where('user_id', $criteria['user_id'])
            ->where('client_id', $criteria['client_id'])
            ->where('amount', $criteria['amount'])
            ->where('passengers', $criteria['passengers'])
            ->where('round_trip', $criteria['round_trip'])
            ->first();
    }

    /**
     * Validate and get BetweenCity ID
     */
    public function validateBetweenCity($from, $to, $betweenCityId = null, $lang = 'en')
    {
        if ($betweenCityId) {
            return $betweenCityId;
        }

        if ($from === $to) {
            return null;
        }

        $cleanFrom = rtrim(trim($from), '/');
        $cleanTo = rtrim(trim($to), '/');

        $betweenCity = BetweenCity::where(function($query) use ($cleanFrom, $cleanTo) {
            $query->where('city_one', $cleanFrom)->where('city_two', $cleanTo);
        })->orWhere(function($query) use ($cleanFrom, $cleanTo) {
            $query->where('city_one', $cleanTo)->where('city_two', $cleanFrom);
        })->first();

        if (!$betweenCity) {
            $messages = [
                'ar' => 'هذه المدن غير متاحة. يرجى اختيار من القائمة المتاحة',
                'ur' => 'یہ شہر دستیاب نہیں ہیں۔ برائے مہربانی دستیاب فہرست سے منتخب کریں',
                'en' => 'These cities are not available. Please select from available cities'
            ];

            throw new \Exception($messages[$lang] ?? $messages['en']);
        }

        return $betweenCity->id;
    }

    /**
     * Process client payment and create travel
     */
    public function processClientPaymentAndTravel(array $data, $clientId)
    {
        $wallet = Wallet::where('user_id', $clientId)->first();

        if (!$wallet) {
            throw new \Exception('لا توجد محفظة لهذا العميل');
        }

        if ($wallet->current_balance < $data['amount']) {
            throw new \Exception('رصيد المحفظة غير كافٍ');
        }

        // Deduct payment
        $wallet->current_balance -= $data['amount'];
        $wallet->save();

        // Create travel
        return $this->createClientTravel($data);
    }

    /**
     * Create station wallet for travel
     */
    public function createStationWallet($travelId, $amount)
    {
        return StationWallet::create([
            'travel_id' => $travelId,
            'amount' => $amount ?? 0,
            'driver_status' => 'pending',
            'client_status' => 'hold',
            'payment_status' => 'hold'
        ]);
    }

    /**
     * Get unassigned travels
     */
    public function getUnassignedTravels()
    {
        $travels = Travel::whereNull('user_id')->with('between_city')->get();
        return response()->json([
            'message' => 'successfully.',
            'data' => $travels
        ]);
    }

    /**
     * Get unassigned travels sorted by passengers and car type
     */
    public function getUnassignedTravelsFiltered(Request $request)
    {
        $passengers = $request->passengers;
        $type = trim($request->input('type'));

        if (!$passengers || !$type) {
            return response()->json([
                'message' => 'passengers and type are required.',
                'data' => []
            ], 400);
        }

        $betweenCity = BetweenCity::where('passengers', $passengers)
            ->where('car_type', $type)
            ->first();

        if (!$betweenCity) {
            return response()->json([
                'message' => 'No matching BetweenCity found.',
                'data' => []
            ], 404);
        }

        $travels = Travel::whereNull('user_id')
            ->where('between_city_id', $betweenCity->id)
            ->get();

        return response()->json([
            'message' => 'Successfully retrieved.',
            'data' => $travels
        ]);
    }

    /**
     * Get client travels
     */
    public function getClientTravels($clientId)
    {
        $travels = Travel::where('client_id', $clientId)
            ->with(['appUser.vehicle'])
            ->get();

        return response()->json([
            'message' => 'successfully.',
            'data' => $travels
        ]);
    }

    /**
     * Driver accepts travel
     */
    public function acceptTravel($travelId, $userId)
    {
        DB::beginTransaction();
        try {
            $travel = Travel::find($travelId);

            if (!$travel) {
                throw new \Exception('Travel not found');
            }

            $stationWallet = StationWallet::where('travel_id', $travelId)->first();
            
            if (!$stationWallet) {
                $stationWallet = $this->createStationWallet($travelId, $travel->amount);
            }

            // Update travel with driver
            $travel->update([
                'user_id' => $userId,
                'status' => 'DriverAccepted'
            ]);
            
            // ✅ MISSING LOGIC ADDED - UPDATE PASSENGER WITH DRIVER
            if ($travel->passenger_id) {
                $passenger = Passenger::where('id', $travel->passenger_id)->first();
                if ($passenger) {
                    $passenger->update([
                        'user_id' => $userId
                    ]);
                }
            }

            $stationWallet->update(['driver_status' => 'confirmed']);

            DB::commit();

            return [
                'success' => true,
                'message' => 'Driver accepted successfully. Waiting for passenger confirmation.',
                'status' => 'driver_accepted',
                'requires_passenger_confirmation' => true,
                'travel_id' => $travelId
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Cancel unassigned travel (by client)
     */
    public function cancelUnassignedTravel($travelId)
    {
        DB::beginTransaction();
        try {
            $travel = Travel::find($travelId);

            if (!$travel) {
                throw new \Exception('Travel not found');
            }

            $clientId = $travel->client_id;
            $price = $travel->amount;

            $stationWallet = StationWallet::where('travel_id', $travelId)->first();
            
            if ($stationWallet && $stationWallet->payment_status === 'hold') {
                // Refund to client
                $wallet = Wallet::where('user_id', $clientId)->first();
                
                if ($wallet) {
                    $wallet->current_balance += $price;
                    $wallet->save();
                }

                $stationWallet->update([
                    'payment_status' => 'cancelled',
                    'client_status' => 'cancelled',
                    'driver_status' => 'cancelled'
                ]);
            } else {
                // Old case - no hold payment
                $wallet = Wallet::firstOrCreate(
                    ['user_id' => $clientId],
                    ['current_balance' => 0, 'total_recharge' => 0]
                );

                $wallet->current_balance += $price;
                $wallet->save();
            }

            $travel->delete();
            DB::commit();

            return ['message' => 'Travel cancelled and amount refunded to wallet.'];

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Cancel travel by driver
     */
    public function cancelTravelByDriver($travelId)
    {
        DB::beginTransaction();
        try {
            $travel = Travel::find($travelId);

            if (!$travel) {
                throw new \Exception('Travel not found or already assigned');
            }

            $driverId = $travel->user_id;

            // SUBSCRIPTION CANCELLATION
            $intercityPackage = PackageType::where('name', 'بين المدن')->first();

            if ($intercityPackage) {
                Subscription::where('user_id', $driverId)
                    ->where('package_id', $intercityPackage->id)
                    ->delete();
            }

            // Update travel - remove driver assignment
            $travel->update([
                'user_id' => null
            ]);
            
            // PASSENGER UNASSIGNMENT
            if ($travel->passenger_id) {
                $passenger = Passenger::where('id', $travel->passenger_id)->first();

                if ($passenger) {
                    $passenger->update([
                        'user_id' => null
                    ]);
                }
            }

            DB::commit();

            return [
                'message' => 'Travel cancelled, amount refunded, and subscription removed if applicable.'
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Confirm order (by client or driver)
     */
    public function confirmOrder($travelId, $type)
    {
        if (!in_array($type, ['client', 'driver'])) {
            throw new \Exception('Invalid confirmation type');
        }

        $stationWallet = StationWallet::where('travel_id', $travelId)->first();

        if (!$stationWallet) {
            throw new \Exception('Station wallet record not found.');
        }

        if ($stationWallet->payment_status === 'released') {
            return ['message' => 'Payment already released to driver.'];
        }

        // Update status
        if ($type === 'client') {
            $stationWallet->client_status = 'confirmed';
        } else {
            $stationWallet->driver_status = 'confirmed';
        }
        $stationWallet->save();

        // Release payment if both confirmed
        if ($stationWallet->client_status === 'confirmed' && 
            $stationWallet->driver_status === 'confirmed') {
            
            $travel = Travel::find($travelId);
            $driverId = $travel->user_id;

            $driverWallet = Wallet::firstOrCreate(
                ['user_id' => $driverId],
                ['current_balance' => 0, 'total_recharge' => 0]
            );

            $driverWallet->current_balance += $stationWallet->amount;
            $driverWallet->save();

            $travel->update(['status' => 'Confirmed']);
            $stationWallet->update(['payment_status' => 'released']);

            return [
                'message' => 'Payment transferred to driver successfully.',
                'amount_transferred' => $stationWallet->amount,
                'travel_status' => 'Confirmed'
            ];
        }

        // Client confirmed but driver not yet
        if ($type === 'client' && $stationWallet->driver_status === 'confirmed') {
            $travel = Travel::find($travelId);
            $travel->update(['status' => 'Waiting']);

            return [
                'message' => 'Passenger confirmed successfully. Waiting for driver action.',
                'travel_status' => 'Waiting',
                'requires_driver_notification' => true
            ];
        }

        return [
            'message' => ucfirst($type) . ' confirmed successfully. Waiting for the other party.'
        ];
    }

    /**
     * Release all pending payments
     */
    public function releasePendingPayments()
    {
        DB::beginTransaction();
        try {
            $pendingPayments = StationWallet::where('driver_status', 'confirmed')
                ->where('client_status', 'confirmed')
                ->where('payment_status', 'hold')
                ->get();

            $releasedCount = 0;

            foreach ($pendingPayments as $payment) {
                $travel = Travel::find($payment->travel_id);
                if ($travel && $travel->user_id) {
                    $driverWallet = Wallet::firstOrCreate(
                        ['user_id' => $travel->user_id],
                        ['current_balance' => 0, 'total_recharge' => 0]
                    );

                    $driverWallet->current_balance += $payment->amount;
                    $driverWallet->save();

                    $payment->update(['payment_status' => 'released']);
                    $releasedCount++;
                }
            }

            DB::commit();

            return [
                'success' => true,
                'message' => 'Released ' . $releasedCount . ' pending payments successfully'
            ];

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    // ==========================================
    // ROUTE WRAPPER METHODS
    // ==========================================

    /**
     * Route wrapper: Accept travel
     */
    public function acceptTravelRoute($travelId, Request $request)
    {
        try {
            $result = $this->acceptTravel($travelId, $request->user_id);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Route wrapper: Cancel unassigned travel
     */
    public function cancelUnassignedTravelRoute($travelId)
    {
        try {
            $result = $this->cancelUnassignedTravel($travelId);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Route wrapper: Cancel travel by driver
     */
    public function cancelTravelByDriverRoute($travelId)
    {
        try {
            $result = $this->cancelTravelByDriver($travelId);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error: ' . $e->getMessage()
            ], 404);
        }
    }

    /**
     * Route wrapper: Confirm order
     */
    public function confirmOrderRoute(Request $request, $travelId)
    {
        $request->validate([
            'type' => 'required|in:client,driver',
        ]);

        try {
            $result = $this->confirmOrder($travelId, $request->type);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Route wrapper: Release pending payments
     */
    public function releasePendingPaymentsRoute()
    {
        try {
            $result = $this->releasePendingPayments();
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error releasing payments: ' . $e->getMessage()
            ], 500);
        }
    }
}
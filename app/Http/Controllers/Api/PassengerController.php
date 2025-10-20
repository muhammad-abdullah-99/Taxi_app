<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BetweenCity;
use App\Models\PackageType;
use App\Models\Passenger;
use App\Models\PassengerList;
use App\Models\StationWallet;
use App\Models\Subscription;
use App\Models\TransactionHistory;
use App\Models\Travel;
use App\Models\Wallet;
use App\Models\AppUser;
use App\Models\Company;
use App\Models\Vehicle;
// use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class PassengerController extends Controller
{
    // public function create(Request $request)
    // {
    //     $lang = $request->get('lang', 'en'); // تحديد اللغة أو القيمة الافتراضية 'en'

    //     DB::beginTransaction();
    //     try {
    //         $passenger = Passenger::create([
    //             'from' => $request->from,
    //             'to' => $request->to,
    //             'count' => $request->count,
    //             'user_id' => $request->user_id,
    //         ]);
    //         foreach ($request->passenger_list as $passengerData) {
    //             PassengerList::create([
    //                 'name' => $passengerData['name'],
    //                 'nationality' => $passengerData['nationality'],
    //                 'id_number' => $passengerData['id_number'],
    //                 'Gender' => $passengerData['Gender'],
    //                 'phone_number' => $passengerData['Phone_number'],
    //                 'passenger_id' => $passenger->id,
    //             ]);
    //         }
    //         DB::commit();
    //         // استرجاع الرسالة بناءً على اللغة
    //         $message = ($lang == 'ar') ? 'تم إنشاء الرحلة بنجاح.' : 'Passenger created successfully.';
    //         return response()->json(['success' => true, 'message' => $message, 'data' => $passenger->load('list')], 201);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         // استرجاع رسالة الخطأ بناءً على اللغة
    //         $errorMessage = ($lang == 'ar') ? 'حدث خطأ أثناء إنشاء الرحلة.' : 'An error occurred while creating the passenger.';
    //         return response()->json(['success' => false, 'message' => $errorMessage, 'error' => $e->getMessage()], 500);
    //     }
    // }
public function create(Request $request)
{
    $lang = $request->get('lang', 'en');

    DB::beginTransaction();
    try {
        // 1. Passenger create
        $passenger = Passenger::create([
            'from' => $request->from,
            'to' => $request->to,
            'count' => $request->count,
            'user_id' => $request->user_id,
        ]);

        // 2. Passenger lists create
        if ($request->has('passenger_list')) {
            foreach ($request->passenger_list as $passengerData) {
                PassengerList::create([
                    'name' => $passengerData['name'],
                    'id_number' => $passengerData['id_number'],
                    'phone_number' => $passengerData['Phone_number'],
                    'passenger_id' => $passenger->id,
                ]);
            }
        }

        $travel = null;

        // ✅ BETWEEN CITIES AUTOMATIC CREATION - YAHAN ADD KAREIN
            $betweenCityId = $request->between_city_id;

        // ✅ BETWEEN CITIES AUTOMATIC CREATION - WITH SLASH FIX
        if (!$betweenCityId && $request->from !== $request->to) {
            // ✅ CITY NAMES KO CLEAN KARO - SLASH REMOVE KARO
            $cleanFrom = rtrim(trim($request->from), '/');
            $cleanTo = rtrim(trim($request->to), '/');
            
            // ✅ PEHLE CHECK KARO KE CLEAN NAMES SE RECORD EXIST KARTA HAI YA NAHI
            $existingBetweenCity = BetweenCity::where('city_one', $cleanFrom)
                ->where('city_two', $cleanTo)
                ->first();

            if (!$existingBetweenCity) {
                $betweenCity = BetweenCity::create([
                    'city_one' => $cleanFrom, // ✅ CLEAN NAME WITHOUT SLASH
                    'city_two' => $cleanTo,   // ✅ CLEAN NAME WITHOUT SLASH
                    'amount' => $request->amount ?? 500,
                    'passengers' => $request->count,
                    'car_type' => 'Auto',
                    'office_commission' => '10%',
                    'code' => 'TRIP-' . time()
                ]);
                $betweenCityId = $betweenCity->id;
            } else {
                $betweenCityId = $existingBetweenCity->id;
            }
        }


        // 3. Travel create
        if ($request->date) {
            $travel = Travel::where('from', $request->from)
                ->where('to', $request->to)
                ->where('date', $request->date)
                ->where('time', $request->time)
                ->where('user_id', $request->user_id)
                ->where('client_id', $request->client_id)
                ->where('amount', $request->amount)
                ->where('passengers', $request->count)
                ->first();

            if (!$travel) {
                if ($request->user_id && !$request->client_id) {
                    $travel = Travel::create([
                        'from' => $request->from,
                        'to' => $request->to,
                        'date' => $request->date,
                        'amount' => $request->amount,
                        'time' => $request->time,
                        'status' => 'Waiting',
                        'user_id' => $request->user_id,
                        'passengers' => $request->count,
                    ]);
                } elseif ($request->client_id) {
                    $wallet = Wallet::where('user_id', $request->client_id)->first();

                    if (!$wallet) {
                        return response()->json(['message' => 'لا توجد محفظة لهذا العميل'], 404);
                    }

                    if ($wallet->current_balance < $request->amount) {
                        return response()->json(['message' => 'رصيد المحفظة غير كافٍ'], 400);
                    }

                    // ✅ PAYMENT HOLD - DIRECT DEDUCT
                    $wallet->current_balance -= $request->amount;
                    $wallet->save();

                    $travel = Travel::create([
                        'from' => $request->from,
                        'to' => $request->to,
                        'date' => $request->date,
                        'amount' => $request->amount,
                        'time' => $request->time,
                        'status' => 'Waiting',
                        'user_id' => $request->user_id,
                        'passengers' => $request->count,
                        'client_id' => $request->client_id,
                        'latitude_from' => $request->latitude_from,
                        'longitude_from' => $request->longitude_from,
                        'latitude_to' => $request->latitude_to,
                        'longitude_to' => $request->longitude_to,
                        'between_city_id' => $betweenCityId,
                    ]);
                }
            }
        }

// ✅ STATION WALLET CREATE WITH HOLD STATUS
if ($travel && $request->client_id) {
    $stationWallet = StationWallet::create([
        'travel_id' => $travel->id,
        'amount' => $travel->amount ?? 0,
        'driver_status' => 'pending',
        'client_status' => 'hold',
        'payment_status' => 'hold'
    ]);

    // ✅ WALLET DETAILS ENTRY - PASSENGER PAYMENT HOLD
    // $passengerWallet = Wallet::where('user_id', $request->client_id)->first();
    // if ($passengerWallet) {
    //     \App\Models\WalletDetail::create([
    //         'wallet_id' => $passengerWallet->id,
    //         'name' => 'حجز مبلغ الرحلة',
    //         'amount' => -$travel->amount, // Negative = outgoing from passenger
    //         'details' => 'رحلة من ' . $request->from . ' إلى ' . $request->to,
    //         'travel_id' => $travel->id
    //     ]);
    // }
}

        DB::commit();

        $message = ($lang == 'ar') ? 'تم إنشاء الرحلة بنجاح وحجز الدفع.' : 'Passenger created successfully with payment hold.';
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => [
                'passenger' => $passenger->load('list'),
                'travel' => $travel ? $travel->load('client') : null,
            ]
        ], 201);
        
    } catch (\Exception $e) {
        DB::rollBack();
        $errorMessage = ($lang == 'ar') ? 'حدث خطأ أثناء إنشاء الرحلة.' : 'An error occurred while creating the passenger.';
        return response()->json([
            'success' => false,
            'message' => $errorMessage,
            'error' => $e->getMessage()
        ], 500);
    }
}


    // تحديث بيانات رحلة مع كشف الركاب
    public function update(Request $request, $id)
    {
        $lang = $request->get('lang', 'en'); // تحديد اللغة أو القيمة الافتراضية 'en'

        DB::beginTransaction();
        try {
            $passenger = Passenger::findOrFail($id);
            $passenger->update($request->only(['from', 'to', 'count']));

            // حذف الركاب الحاليين وإعادة إدخال القائمة الجديدة
            PassengerList::where('passenger_id', $id)->delete();
            foreach ($request->passenger_list as $passengerData) {
                PassengerList::create([
                    'name' => $passengerData['name'],
                    'nationality' => $passengerData['nationality'],
                    'id_number' => $passengerData['id_number'],
                    'Gender' => $passengerData['Gender'],
                    'phone_number' => $passengerData['Phone_number'],
                    'passenger_id' => $passenger->id,
                ]);
            }

            DB::commit();

            $message = ($lang == 'ar') ? 'تم تحديث الرحلة بنجاح.' : 'Passenger updated successfully.';
            return response()->json(['success' => true, 'message' => $message, 'data' => $passenger->load('list')], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            $errorMessage = ($lang == 'ar') ? 'حدث خطأ أثناء تحديث الرحلة.' : 'An error occurred while updating the passenger.';
            return response()->json(['success' => false, 'message' => $errorMessage, 'error' => $e->getMessage()], 500);
        }
    }

    // حذف رحلة بالكامل
    public function delete($id, Request $request)
    {
        $lang = $request->get('lang', 'en'); // تحديد اللغة أو القيمة الافتراضية 'en'

        $passenger = Passenger::findOrFail($id);
        $passenger->delete();

        $message = ($lang == 'ar') ? 'تم حذف الرحلة بنجاح.' : 'Passenger deleted successfully.';
        return response()->json(['success' => true, 'message' => $message], 200);
    }

    // حذف راكب واحد من كشف الركاب
    public function deletePassenger($id, Request $request)
    {
        $lang = $request->get('lang', 'en'); // تحديد اللغة أو القيمة الافتراضية 'en'
        $passenger = PassengerList::findOrFail($id);
        $passenger->delete();
        $passengerId = $passenger->passenger_id;
        $passengerRecord = Passenger::findOrFail($passengerId);
        $passengerRecord->count = max(0, $passengerRecord->count - 1); // تقليل العدد والتأكد من أن العدد لا يصبح أقل من 0
        $passengerRecord->save();


        $message = ($lang == 'ar') ? 'تم حذف الراكب من القائمة بنجاح.' : 'Passenger removed from list successfully.';
        return response()->json(['success' => true, 'message' => $message], 200);
    }

    // جلب جميع الرحلات
    public function getAll($driver, Request $request)
    {
        $lang = $request->get('lang', 'en'); // تحديد اللغة أو القيمة الافتراضية 'en'

        $passengers = Passenger::where('user_id', $driver)->with('list')->get();
        $message = ($lang == 'ar') ? 'تم جلب جميع الرحلات.' : 'All passengers fetched successfully.';
        return response()->json(['success' => true, 'message' => $message, 'data' => $passengers], 200);
    }

    // جلب تفاصيل رحلة واحدة مع كشف الركاب
    public function getOne($id, Request $request)
    {
        $lang = $request->get('lang', 'en'); // تحديد اللغة أو القيمة الافتراضية 'en'

        $passenger = Passenger::with('list')->findOrFail($id);
        $message = ($lang == 'ar') ? 'تم جلب تفاصيل الرحلة بنجاح.' : 'Passenger details fetched successfully.';
        return response()->json(['success' => true, 'message' => $message, 'data' => $passenger], 200);
    }

    /////web 
public function showAllPassengers($id = null)
{
    $passengers = $id 
        ? Passenger::where('user_id', $id)->latest()->get()   // بيعمل ORDER BY created_at DESC
        : Passenger::latest()->get();

    return view('/admin/transport/drivers/passengers', compact('passengers'));
}


    public function showPassengesrDataWithDetails($id)
    {
        $passenger = Passenger::where('id', $id)->with('appUser.vehicle', 'list', 'appUser.company')->first();
        if (!$passenger) {
            abort(404, 'الركاب غير موجودين');
        }
        return view('/admin/transport/drivers/passengersPDF', compact('passenger'));
    }
    // public function showPassengesrDataWithDetails($id)
    // {
    //     $passenger = Passenger::where('id', $id)
    //         ->with('appUser.vehicle', 'list', 'appUser.company')
    //         ->first();

    //     if (!$passenger) {
    //         abort(404, 'الركاب غير موجودين');
    //     }

    //     $pdf = Pdf::loadView('admin.transport.drivers.passengersPDF', compact('passenger'));

    //     // للعرض فقط في المتصفح:
    //     // return $pdf->stream('passenger_details.pdf');

    //     // للتحميل مباشرة:
    //     return $pdf->download('passenger_details.pdf');
    // }


// public function getUnassignedTravel()
// {
//     $travels = Travel::whereNull('user_id')
//         ->where('status', 'Waiting')  // Only show the response of entries with waiting response
//         ->with('between_city')
//         ->get();
        
//     return response()->json([
//         'message' => 'successfully.',
//         'data' => $travels
//     ]);
// }

    public function getUnassignedTravel()
    {
        $travels = Travel::whereNull('user_id')->with('between_city')->get();
        return response()->json([
            'message' => 'successfully.',
            'data' => $travels
        ]);
    }

public function getUnassignedTravelSort(Request $request)
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




public function getClientTravel($client)
{
    $travels = Travel::where('client_id', $client)
        ->with(['appUser.vehicle'])
        ->get();

    return response()->json([
        'message' => 'successfully.',
        'data' => $travels, 
    ]);
}



public function acceptTravel($travelId, Request $request)
{
    DB::beginTransaction();
    try {
        $travel = Travel::find($travelId);

        if (!$travel) {
            return response()->json(['message' => 'Travel not found'], 404);
        }

        // ✅ ENSURE STATION WALLET EXISTS
        $stationWallet = StationWallet::where('travel_id', $travelId)->first();
        
        if (!$stationWallet) {
            $stationWallet = StationWallet::create([
                'travel_id' => $travelId,
                'amount' => $travel->amount ?? 0,
                'driver_status' => 'pending',
                'client_status' => 'hold',
                'payment_status' => 'hold'
            ]);
        }

        // ✅ UPDATE TRAVEL WITH DRIVER
        $travel->update([
            'user_id' => $request->user_id
        ]);
        
        $travel->update([
            'status' => 'DriverAccepted' // ✅ Changed to English
        ]);
        
        // ✅ UPDATE PASSENGER WITH DRIVER
        if ($travel->passenger_id) {
            $passenger = Passenger::where('id', $travel->passenger_id)->first();
            if ($passenger) {
                $passenger->update([
                    'user_id' => $request->user_id
                ]);
            }
        }

        // ✅ UPDATE STATION WALLET - DRIVER CONFIRMED ONLY (NO PAYMENT RELEASE)
        $stationWallet->update([
            'driver_status' => 'confirmed'
            // client_status remains 'hold'
            // payment_status remains 'hold' - WAITING FOR PASSENGER CONFIRMATION
        ]);
        

        DB::commit();

        // ✅ RETURN STATUS FOR FLUTTER
        return response()->json([
            'success' => true,
            'message' => 'Driver accepted successfully. Waiting for passenger confirmation.',
            'status' => 'driver_accepted',
            'requires_passenger_confirmation' => true,
            'travel_id' => $travelId
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
}



public function cancelUnassignedTravel($travelId)
{
    DB::beginTransaction();
    try {
        $travel = Travel::find($travelId);

        if (!$travel) {
            return response()->json(['message' => 'Travel not found'], 404);
        }

        $clientId = $travel->client_id;
        $price = $travel->amount;

        // ✅ CHECK STATION WALLET - PAYMENT HOLD WALA CASE
        $stationWallet = StationWallet::where('travel_id', $travelId)->first();
        
        if ($stationWallet && $stationWallet->payment_status === 'hold') {
            // Client ko refund karo
            $wallet = Wallet::where('user_id', $clientId)->first();
            
            if ($wallet) {
                $wallet->current_balance += $price;
                $wallet->save();
            }

            // ✅ WALLET DETAILS ENTRY - REFUND TO PASSENGER
            // \App\Models\WalletDetail::create([
            //     'wallet_id' => $wallet->id,
            //     'name' => 'استرداد مبلغ الرحلة',
            //     'amount' => $price, // Positive = incoming refund
            //     'details' => 'إلغاء رحلة من ' . $travel->from . ' إلى ' . $travel->to,
            //     'travel_id' => $travelId
            // ]);

            // StationWallet update karo - cancelled
            $stationWallet->update([
                'payment_status' => 'cancelled',
                'client_status' => 'cancelled',
                'driver_status' => 'cancelled'
            ]);

            // ✅ TRAVEL DELETE KARO
            $travel->delete();

            DB::commit();
            return response()->json(['message' => 'Travel cancelled and amount refunded to wallet.']);
            
        } else {
            // ✅ AGAR PAYMENT HOLD NAHI HAI (OLD CASE)
            $wallet = Wallet::firstOrCreate(
                ['user_id' => $clientId],
                ['current_balance' => 0, 'total_recharge' => 0]
            );

            $wallet->current_balance += $price;
            $wallet->save();

            $travel->delete();

            DB::commit();
            return response()->json(['message' => 'Travel cancelled and amount refunded to wallet.']);
        }

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
    }
}



    public function cancelTravelByDriver($travelId)
    {
        $travel = Travel::find($travelId);

        if (!$travel) {
            return response()->json(['message' => 'Travel not found or already assigned'], 404);
        }

        $driverId = $travel->user_id;

        $intercityPackage = PackageType::where('name', 'بين المدن')->first();

        if ($intercityPackage) {
            Subscription::where('user_id', $driverId)
                ->where('package_id', $intercityPackage->id)
                ->delete();
        }

        // حذف الرحلة
        $travel->update([
            'user_id' => null
        ]);
        if ($travel->passenger_id) {
            $passenger = Passenger::where('id', $travel->passenger_id)->first();

            $passenger->update([
                'user_id' => null
            ]);
        }
        return response()->json(['message' => 'Travel cancelled, amount refunded, and subscription removed if applicable.']);
    }



    // public function confirmOrderByDriverAndClient(Request $request, $travelId)
    // {
    //     $request->validate([
    //         'type' => 'required|in:client,driver',
    //     ]);

    //     $stationWallet = StationWallet::where('travel_id', $travelId)->first();

    //     if (!$stationWallet) {
    //         return response()->json(['message' => 'Station wallet record not found.'], 404);
    //     }

    //     if ($stationWallet->client_status === 'confirmed' && $stationWallet->driver_status === 'confirmed') {
    //         return response()->json([
    //             'message' => 'Order has already been confirmed by both client and driver. Amount already transferred.'
    //         ]);
    //     }

    //     if ($request->type === 'client') {
    //         $stationWallet->client_status = 'confirmed';
    //     } elseif ($request->type === 'driver') {
    //         $stationWallet->driver_status = 'confirmed';
    //     }

    //     $stationWallet->save();

    //     if ($stationWallet->client_status === 'confirmed' && $stationWallet->driver_status === 'confirmed') {
    //         $driverId = Travel::find($travelId)->user_id;

    //         $wallet = Wallet::firstOrCreate(
    //             ['user_id' => $driverId],
    //             ['current_balance' => 0, 'total_recharge' => 0]
    //         );

    //         $wallet->current_balance += $stationWallet->amount ;
    //         $wallet->save();

    //         return response()->json([
    //             'message' => 'Both client and driver confirmed. Amount has been transferred to driver wallet.'
    //         ]);
    //     }

    //     return response()->json([
    //         'message' => ucfirst($request->type) . ' confirmed successfully. Waiting for the other party.'
    //     ]);
    // }


public function confirmOrderByDriverAndClient(Request $request, $travelId)
{
    $request->validate([
        'type' => 'required|in:client,driver',
    ]);

    $stationWallet = StationWallet::where('travel_id', $travelId)->first();

    if (!$stationWallet) {
        return response()->json(['message' => 'Station wallet record not found.'], 404);
    }

    // ✅ AGAR PEHLE SE RELEASED HAI TOH RETURN
    if ($stationWallet->payment_status === 'released') {
        return response()->json([
            'message' => 'Payment already released to driver.'
        ]);
    }

    if ($request->type === 'client') {
        $stationWallet->client_status = 'confirmed';
    } elseif ($request->type === 'driver') {
        $stationWallet->driver_status = 'confirmed';
    }

    $stationWallet->save();

    // ✅ PAYMENT RELEASE - JAB DONO CONFIRM KAREIN
    if ($stationWallet->client_status === 'confirmed' && $stationWallet->driver_status === 'confirmed') {
        $travel = Travel::find($travelId);
        $driverId = $travel->user_id;

        $driverWallet = Wallet::firstOrCreate(
            ['user_id' => $driverId],
            ['current_balance' => 0, 'total_recharge' => 0]
        );

        $driverWallet->current_balance += $stationWallet->amount;
        $driverWallet->save();

        // ✅ TRAVEL STATUS UPDATE - PASSENGER CONFIRMED (ENGLISH)
        $travel->update([
            'status' => 'Confirmed' // ✅ Changed to English
        ]);

        $stationWallet->update([
            'payment_status' => 'released'
        ]);

        return response()->json([
            'message' => 'Payment transferred to driver successfully.',
            'amount_transferred' => $stationWallet->amount,
            'travel_status' => 'Confirmed' // ✅ Changed to English
        ]);
    }

    // ✅ AGAR SIRF CLIENT NE CONFIRM KIYA HAI (NEW SCENARIO)
    if ($request->type === 'client' && $stationWallet->driver_status === 'confirmed') {
        $travel = Travel::find($travelId);
        
        // ✅ TRAVEL STATUS UPDATE - WAITING FOR DRIVER (ENGLISH)
        $travel->update([
            'status' => 'Waiting' // ✅ Changed to English
        ]);

        return response()->json([
            'message' => 'Passenger confirmed successfully. Waiting for driver action.',
            'travel_status' => 'Waiting', // ✅ Changed to English
            'requires_driver_notification' => true
        ]);
    }

    return response()->json([
        'message' => ucfirst($request->type) . ' confirmed successfully. Waiting for the other party.'
    ]);
}



    //كشف ركاب عن طريق لحة التحكم 
    public function storeNewPassengers(Request $request)
{
    $request->validate([
        'from' => 'required|string',
        'to' => 'required|string',
        'count' => 'required|integer|min:1',
        'user_id' => 'required',
    ]);

    // 1. إنشاء الراكب الأساسي
    $passenger = Passenger::create([
        'from' => $request->from,
        'to' => $request->to,
        'count' => $request->count,
        'user_id' => $request->user_id,
    ]);

    // 2. إنشاء تفاصيل الركابx
    if ($request->has('passenger_list')) {
        foreach ($request->passenger_list as $passengerData) {
            PassengerList::create([
            'name' => $passengerData['name'], // ✅ $passengerData CORRECT
            'id_number' => $passengerData['id_number'],
            'phone_number' => $passengerData['Phone_number'],
            ]);
        }
    }

    return redirect()->route('showAllPassengers')->with('success', 'تم إصدار كشف الركاب بنجاح');
}

// PassengerController ke existing methods ke baad add karein
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

        return response()->json([
            'success' => true,
            'message' => 'Released ' . $releasedCount . ' pending payments successfully'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Error releasing payments: ' . $e->getMessage()
        ], 500);
    }
}


public function getTransactionHistory($userId)
{
    $transactions = TransactionHistory::where('user_id', $userId)
        ->with(['travel' => function($query) {
            $query->select('id', 'from', 'to', 'date', 'time');
        }])
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'success' => true,
        'message' => 'Transaction history retrieved successfully',
        'data' => $transactions
    ]);
}

public function upgradeToDriver(Request $request)
{
    $lang = $request->lang ?? 'en';

    $messages = [
        'en' => [
            'upgrade_successful' => 'Upgraded to Driver successfully.',
            'upgrade_failed' => 'Upgrade failed.',
            'already_driver' => 'You are already registered as Driver.',
            'user_not_found' => 'User not found.',
        ],
        'ar' => [
            'upgrade_successful' => 'تم الترقية إلى سائق بنجاح.',
            'upgrade_failed' => 'فشلت الترقية.',
            'already_driver' => 'أنت مسجل بالفعل كسائق.',
            'user_not_found' => 'لم يتم العثور على المستخدم.',
        ],
        'ur' => [
            'upgrade_successful' => 'ڈرائیور میں کامیابی سے اپ گریڈ ہو گئے۔',
            'upgrade_failed' => 'اپ گریڈ ناکام ہو گیا۔',
            'already_driver' => 'آپ پہلے سے ڈرائیور کے طور پر رجسٹرڈ ہیں۔',
            'user_not_found' => 'صارف نہیں ملا۔',
        ],        
    ];

    // Validation
    $validator = Validator::make($request->all(), [
        'user_id' => 'required|exists:app_users,id',
        'id_number' => 'required|string|unique:app_users,id_number,' . $request->user_id . ',id',
        'id_image' => 'required|image|max:5120',
        'driver_image' => 'required|image|max:5120', 
        'license_image' => 'required|image|max:5120',
        'car_type' => 'required|string',
        'number_of_passengers' => 'required|integer|min:1',
        'car_model' => 'required|string',
        'car_color' => 'required|string',
        'licence_plate_number' => 'required|string',
        'car_image' => 'required|image|max:5120',
        'company_name' => 'required|string',
        'company_location' => 'required|string',
        'company_registration_number' => 'required|string',
        'company_type' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $messages[$lang]['upgrade_failed'] ?? $messages['en']['upgrade_failed'],
            'errors' => $validator->errors(),
        ], 422);
    }

    // Find user
    $user = AppUser::find($request->user_id);

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => $messages[$lang]['user_not_found'] ?? $messages['en']['user_not_found'],
        ], 404);
    }

    // Check if already driver
    if ($user->user_type == 'Driver') {
        return response()->json([
            'success' => false,
            'message' => $messages[$lang]['already_driver'] ?? $messages['en']['already_driver'],
        ], 400);
    }

    DB::beginTransaction();

    try {
        $destinationPath = public_path('storage/drivers/');

        // Upload images
        $idFileName = time() . '_id_' . $request->file('id_image')->getClientOriginalName();
        $request->file('id_image')->move($destinationPath . 'ids', $idFileName);
        $idImagePath = 'drivers/ids/' . $idFileName;

        $driverFileName = time() . '_driver_' . $request->file('driver_image')->getClientOriginalName();
        $request->file('driver_image')->move($destinationPath . 'driver', $driverFileName);
        $driverImagePath = 'drivers/driver/' . $driverFileName;

        $licenseFileName = time() . '_license_' . $request->file('license_image')->getClientOriginalName();
        $request->file('license_image')->move($destinationPath . 'licenses', $licenseFileName);
        $licenseImagePath = 'drivers/licenses/' . $licenseFileName;

        $carFileName = time() . '_car_' . $request->file('car_image')->getClientOriginalName();
        $request->file('car_image')->move(public_path('storage/vehicles/images'), $carFileName);
        $carImagePath = 'vehicles/images/' . $carFileName;

        // Update user to Driver
        $user->update([
            'user_type' => 'Driver',
            'id_number' => $request->id_number,
            'id_image' => $idImagePath,
            'license_image_url' => $licenseImagePath,
            'driver_image' => $driverImagePath,
            'status' => null, // Pending approval
        ]);

        // Create vehicle
        $vehicle = Vehicle::create([
            'user_id' => $user->id,
            'car_type' => $request->car_type,
            'number_of_passengers' => $request->number_of_passengers,
            'car_model' => $request->car_model,
            'car_color' => $request->car_color,
            'licence_plate_number' => $request->licence_plate_number,
            'car_image' => $carImagePath,
        ]);

        // Create company
        $company = Company::create([
            'user_id' => $user->id,
            'company_name' => $request->company_name,
            'company_location' => $request->company_location,
            'company_registration_number' => $request->company_registration_number,
            'company_type' => $request->company_type,
        ]);

        // Send SMS
        $smsMessages = [
            'en' => "Your upgrade request to Driver (ID: {$user->id_number}) has been received.\nWe will get back to you soon.",
            'ar' => "تم استلام طلب الترقية إلى سائق (رقم: {$user->id_number}).\nسيتم الرد عليك قريباً.",
            'ur' => "آپ کی ڈرائیور اپ گریڈ درخواست (شناخت: {$user->id_number}) موصول ہو گئی ہے۔\nہم جلد ہی آپ سے رابطہ کریں گے۔",
        ];

        try {
            Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.taqnyat.bearer_token'),
                'Content-Type' => 'application/json',
            ])->post(config('services.taqnyat.url'), [
                'sender' => config('services.taqnyat.sender'),
                'recipients' => [$user->mobile],
                'body' => $smsMessages[$lang] ?? $smsMessages['ar'],
            ]);
        } catch (\Exception $e) {
            Log::error('SMS Error: ' . $e->getMessage());
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => $messages[$lang]['upgrade_successful'] ?? $messages['en']['upgrade_successful'],
            'data' => [
                'user' => $user->fresh(['company', 'vehicle']),
                'vehicle' => $vehicle,
                'company' => $company,
            ],
        ], 200);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Upgrade Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => $messages[$lang]['upgrade_failed'] ?? $messages['en']['upgrade_failed'],
            'error' => config('app.debug') ? $e->getMessage() : null,
        ], 500);
    }
}

}
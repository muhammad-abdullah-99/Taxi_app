<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Models\DriverPayment;
use App\Models\Travel;
use App\Models\Wallet;
use App\Models\WalletDetail;
use App\Models\AppUser;
use App\Models\StationWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DriverPaymentController extends Controller
{
    /**
     * Show pending driver payments
     */
    public function pendingPayments()
    {
        $payments = DriverPayment::with(['travel.between_city', 'driver:id,name,mobile'])
            ->where('status', 'pending')
            ->orderBy('trip_completed_at', 'asc')
            ->get();

        $totalPending = $payments->sum('driver_amount');

        return view('admin.transport.payouts.pending', compact('payments', 'totalPending'));
    }

    /**
     * Show payment history
     */
    public function paymentHistory(Request $request)
    {
        $query = DriverPayment::with(['travel.between_city', 'driver:id,name,mobile', 'markedByAdmin'])
            ->where('status', 'paid');

        // Filters
        if ($request->filled('driver_id')) {
            $query->where('driver_id', $request->driver_id);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('paid_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('paid_at', '<=', $request->to_date);
        }

        $payments = $query->orderBy('paid_at', 'desc')->paginate(50);
        
        $totalPaid = $payments->sum('driver_amount');
        $totalFees = $payments->sum('operating_fee');

        return view('admin.transport.payouts.history', compact('payments', 'totalPaid', 'totalFees'));
    }

    /**
     * Mark payment as paid (after manual bank transfer)
     */
    public function markAsPaid(Request $request, $paymentId)
    {
        DB::beginTransaction();
        try {
            $payment = DriverPayment::where('payment_id', $paymentId)
                ->where('status', 'pending')
                ->first();

            if (!$payment) {
                return redirect()->back()->with('error', 'السجل غير موجود أو تم معالجته بالفعل');
            }

            // ✅ UPDATE PAYMENT STATUS
            $payment->update([
                'status' => 'paid',
                'marked_by' => auth()->id(),
                'paid_at' => now()
            ]);

            // ✅ UPDATE STATION WALLET STATUS TO 'released'
            $stationWallet = StationWallet::where('travel_id', $payment->travel_id)->first();
            if ($stationWallet) {
                $stationWallet->update(['payment_status' => 'released']);
            }

            DB::commit();

            // ✅ FIX: USE payment_id INSTEAD OF UNDEFINED admin_reference
            $driver = AppUser::find($payment->driver_id);
            if ($driver && $driver->mobile) {
                $this->sendNonBlockingSms(
                    $driver->mobile,
                    "تم تحويل مبلغ {$payment->driver_amount} ريال إلى حسابك البنكي.\nرقم العملية: {$payment->payment_id}",
                    $driver->id
                );
            }

            return redirect()->back()->with('success', '✅ تم تأكيد التحويل البنكي بنجاح');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Mark Payment Error', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', '❌ حدث خطأ أثناء تأكيد التحويل');
        }
    }

    /**
     * Cancel payment (if needed)
     */
    public function cancelPayment(Request $request, $paymentId)
    {
        DB::beginTransaction();
        try {
            $payment = DriverPayment::where('payment_id', $paymentId)
                ->where('status', 'pending')
                ->first();

            if (!$payment) {
                return redirect()->back()->with('error', 'السجل غير موجود');
            }

            $payment->update([
                'status' => 'cancelled',
                'marked_by' => auth()->id()
            ]);

            DB::commit();
            return redirect()->back()->with('success', '✅ تم إلغاء الدفعة بنجاح');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', '❌ حدث خطأ');
        }
    }


    /**
     * Non-blocking SMS function
     */
    private function sendNonBlockingSms($mobile, $message, $userId = null)
    {
        try {
            Http::timeout(5)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . config('services.taqnyat.bearer_token'),
                    'Content-Type' => 'application/json',
                ])->post(config('services.taqnyat.url'), [
                    'sender' => config('services.taqnyat.sender'),
                    'recipients' => [$mobile],
                    'body' => $message
                ]);

            \Log::info('Driver payment SMS sent', ['user_id' => $userId, 'mobile' => $mobile]);

        } catch (\Exception $e) {
            \Log::warning('SMS failed but payment completed', [
                'user_id' => $userId,
                'error' => $e->getMessage()
            ]);
        }
    }
}
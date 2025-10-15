<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Models\Geha;
use App\Models\Snd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Wallet;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'name' => 'required|string',
            'number' => 'required|string',
            'cvc' => 'required|string',
            'month' => 'required|string',
            'year' => 'required|string',
            'user_id' => 'required|integer'
        ]);

        $response = Http::withBasicAuth(env('MOYASAR_API_KEY'), '')
            ->post('https://api.moyasar.com/v1/payments', [
                'amount' => $request->amount * 100,
                'currency' => 'SAR',
                'description' => 'شحن رصيد ',
                'callback_url' => url('api/payment/callback'),
                'metadata' => [
                    'user_id' => $request->user_id,
                    'client_type' => 'جهة',
                    'client_id' => Geha::where('name', 'تطبيق روز تاكسي')->value('id'),
                    'type' => 'قبض',
                    'payment_method' => 'بوابة الدفع',
                    'tax' => 'غير خاضع للضريبة',
                    'description' => 'شحن رصيد عبر بوابة ميسر',
                    'date' => now()->toDateString(),

                ],
                'source' => [
                    'type' => 'creditcard',
                    'name' => $request->name,
                    'number' => $request->number,
                    'cvc' => $request->cvc,
                    'month' => $request->month,
                    'year' => $request->year
                ]
            ]);

        if ($response->successful()) {
            return response()->json([
                'status' => 'success',
                'payment' => $response->json()
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $response->json()
            ], 400);
        }
    }

    public function callback(Request $request)
    {
        $paymentId = $request->get('id');

        if (!$paymentId) {
            return '❌ معرف العملية غير موجود.';
        }

        $response = Http::withBasicAuth(env('MOYASAR_API_KEY'), '')
            ->get("https://api.moyasar.com/v1/payments/{$paymentId}");

        if ($response->successful()) {
            $payment = $response->json();

            if ($payment['status'] === 'paid') {
                // ✅ تم الدفع بنجاح - نضيف الرصيد للسائق

                $userId = $payment['metadata']['user_id'] ?? null;
                $amount = $payment['amount'] / 100; // نحوله من هللات إلى ريال
                $meta = $payment['metadata'];

                if ($userId && $amount > 0) {
                    DB::transaction(function () use ($meta, $userId, $amount) {
                        // 1. إنشاء السند
                        $snd = new Snd();
                        $snd->type = $meta['type'] ?? 'قبض';
                        $snd->payment_method = $meta['payment_method'] ?? 'بوابة الدفع';
                        $snd->bank_account = null;
                        $snd->amount = $amount;
                        $snd->tax = $meta['tax'] ?? 'غير خاضع للضريبة';
                        $snd->description = $meta['description'] ?? 'دفع عبر بوابة ميسر من التطبيق';
                        $snd->date = $meta['date'] ?? now();
                        $snd->client_type = $meta['client_type'];
                        $snd->geha_id = $meta['client_id']; // "تطبيق روز تاكسي"
                        $snd->save();
                        $wallet = Wallet::firstOrCreate(
                            ['user_id' => $userId],
                            ['current_balance' => 0]
                        );

                        $wallet->current_balance += $amount;
                        $wallet->save();

                        $wallet->details()->create([
                            'name' => 'قبض',
                            'amount' => $amount,
                            'details' => 'شحن رصيد عبر ميسر',
                        ]);
                    });
                }

                return '✅ تم الدفع وشحن الرصيد بنجاح. رقم العملية: ' . $paymentId;
            } else {
                return '❌ الدفع لم يكتمل. الحالة: ' . $payment['status'];
            }
        } else {
            return '❌ خطأ في التحقق من حالة الدفع.';
        }
    }
}

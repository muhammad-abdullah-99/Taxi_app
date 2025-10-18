<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\Geha;
use App\Models\Snd;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class WalletController extends Controller
{
    // دالة لجلب بيانات المحفظة
    public function getWallet($userId)
    {
        $wallet = Wallet::where('user_id', $userId)->with('details')->first();

        if (!$wallet) {
            return response()->json(['message' => 'Wallet not found'], 404);
        }

        return response()->json($wallet);
    }

    // دالة لتحديث الرصيد
    public function updateWallet(Request $request, $userId)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $userId) {
            $wallet = Wallet::firstOrCreate(
                ['user_id' => $userId],
                ['current_balance' => 0, 'total_recharge' => 0]
            );

            $wallet->increment('current_balance', $request->amount);
            $wallet->increment('total_recharge', $request->amount);
            $wallet->save();
        });

        return response()->json(['message' => 'Wallet updated successfully']);
    }

    public function index()
    {
        $wallets = Wallet::whereHas('user', function ($query) {
            $query->where('user_type', 'Driver')
                ->where('status', 1)
                ->where('name', '!=', 'guest');
        })->get();
        $drivers = AppUser::where('user_type', 'Driver')->where('status', 1)->where('name', '!=', 'guest')->get();
        return view('admin.transport.wallet.wallet', compact(['wallets', 'drivers']));
    }
    public function walletClient()
    {
        $wallets = Wallet::whereHas('user', function ($query) {
            $query->where('user_type', 'Passenger')
                ->where('status', 1)
                ->where('name', '!=', 'guest');
        })->get();
        $drivers = AppUser::where('user_type', 'Passenger')->where('status', 1)->where('name', '!=', 'guest')->get();
        return view('admin.transport.wallet.client', compact(['wallets', 'drivers']));
    }



    // public function addBalance(Request $request)
    // {
    //     $request->validate([
    //         'driver_id' => 'required',
    //         'amount' => 'required|numeric|min:0.01',
    //     ]);

    //     DB::transaction(function () use ($request) {
    //         $wallet = Wallet::firstOrCreate(
    //             ['user_id' => $request->driver_id],
    //             ['current_balance' => 0]
    //         );

    //         $wallet->current_balance += $request->amount;
    //         $wallet->save();

    //         $wallet->details()->create([
    //             'name' => 'قبض',
    //             'amount' => $request->amount,
    //             'details' => 'شحن رصيد ',
    //         ]);
    //     });

    //     return redirect()->back()->with('success', 'تمت إضافة الرصيد وتسجيل العملية بنجاح.');
    // }

public function chargeOnline(Request $request)
{
    $request->validate([
        'driver_id' => 'required',
        'amount' => 'required|numeric|min:0.01',
        'name' => 'required|string',
        'number' => 'required|string',
        'cvc' => 'required|string',
        'month' => 'required|string',
        'year' => 'required|string',
    ]);

    $response = Http::withBasicAuth(env('MOYASAR_API_KEY'), '')
        ->post('https://api.moyasar.com/v1/payments', [
            'amount' => $request->amount * 100,
            'currency' => 'SAR',
            'description' => 'شحن رصيد للسائق',
            'callback_url' => url('wallet/charge/callback'),


    
            'metadata' => [
                'driver_id' => $request->driver_id,
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
                'year' => $request->year,
            ]
        ]);

    if ($response->successful()) {
        $payment = $response->json();
        return redirect($payment['source']['transaction_url']);
    }

    return redirect()->back()->with('error', '❌ فشل إرسال الطلب إلى بوابة الدفع.');
}
public function chargeCallback(Request $request)
{
    $paymentId = $request->get('id');
    if (!$paymentId) {
        return redirect()->route('showTransportBox')->with('error', '❌ معرف العملية غير موجود.');
    }

    $response = Http::withBasicAuth(env('MOYASAR_API_KEY'), '')
        ->get("https://api.moyasar.com/v1/payments/{$paymentId}");

    if ($response->failed()) {
        return redirect()->route('showTransportBox')->with('error', '❌ فشل التحقق من الدفع.');
    }

    $payment = $response->json();
    if ($payment['status'] !== 'paid') {
        return redirect()->route('showTransportBox')->with('error', '❌ الدفع لم يكتمل. الحالة: ' . $payment['status']);
    }

    $amount = $payment['amount'] / 100;
    $meta = $payment['metadata'];

    DB::transaction(function () use ($meta, $amount) {
        // 1. إنشاء السند
           $snd = new Snd();
        $snd->type = $meta['type'] ?? 'قبض';
        $snd->payment_method = $meta['payment_method'] ?? 'بوابة الدفع';
        $snd->bank_account = null;
        $snd->amount = $amount;
        $snd->tax = $meta['tax'] ?? 'غير خاضع للضريبة';
        $snd->description = $meta['description'] ?? 'دفع عبر بوابة ميسر';
        $snd->date = $meta['date'] ?? now();
        $snd->client_type = $meta['client_type'];
        $snd->geha_id = $meta['client_id']; // "تطبيق روز تاكسي"
        $snd->save();

        // 2. تحديث رصيد المحفظة
        $wallet = Wallet::firstOrCreate(
            ['user_id' => $meta['driver_id']],
            ['current_balance' => 0]
        );

        $wallet->current_balance += $amount;
        $wallet->save();

        // 3. إضافة تفاصيل المعاملة
        $wallet->details()->create([
            'name' => 'قبض',
            'amount' => $amount,
            'details' => 'شحن رصيد عن طريق بوابة الدفع',
        ]);
    });

    return redirect()->route('showTransportBox')->with('success', '✅ تم الدفع وشحن الرصيد بنجاح.');
}




    public function showWalletDetails($wallet_id)
    {
        $wallet = Wallet::with('details')->findOrFail($wallet_id);

        return view('admin.transport.wallet.details', compact('wallet'));
    }
}

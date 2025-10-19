<?php

namespace App\Http\Controllers\Api;

use App\Models\AppUser;
use App\Models\PackageType;
use App\Models\Wallet;
use App\Http\Controllers\Controller;
use App\Models\PackageSubDetail;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class SubController extends Controller
{
    public function index()
    {

        return view('/admin/transport/subscriptions/show');
    }


    public function subscrptions()
    {
        $subscriptions = Subscription::all();
        return view('/admin/transport/subscriptions/subscripe', compact('subscriptions'));
    }


    // function createSubscription(Request $request)
    // {
    //     try {
    //         DB::beginTransaction();

    //         $lang = $request->input('lang', 'en');

    //         $user = AppUser::find($request->user_id);
    //         if (!$user) {
    //             return response()->json(['error' => $lang == 'ar' ? 'المستخدم غير موجود' : 'User not found'], 404);
    //         }

    //         $package = PackageType::find($request->package_id);
    //         if (!$package || !$package->is_active) {
    //             return response()->json(['error' => $lang == 'ar' ? 'الباقة غير متوفرة أو غير مفعلة' : 'Package not found or inactive'], 400);
    //         }

    //         $wallet = Wallet::where('user_id', $request->user_id)->first();
    //         if (!$wallet) {
    //             return response()->json(['error' => $lang == 'ar' ? 'المحفظة غير موجودة' : 'Wallet not found'], 400);
    //         }

    //         if ($wallet->current_balance < $package->cost) {
    //             return response()->json(['error' => $lang == 'ar' ? 'الرصيد غير كافٍ' : 'Insufficient balance'], 400);
    //         }

    //         $wallet->current_balance -= $package->cost;
    //         $wallet->save();

    //         $wallet->details()->create([
    //             'name' => 'صرف',
    //             'amount' => $package->cost,
    //             'details' => 'شحن باقة ' . $package->name . ' ' . $package->type,
    //         ]);

    //         $expireAt = Carbon::now()->addDays($package->days)->toDateString();

    //         Subscription::create([
    //             'user_id' => $request->user_id,
    //             'package_id' => $request->package_id,
    //             'expire_at' => $expireAt,
    //         ]);

    //         // ✅ تحديث أو إنشاء package_sub_details
    //         $detail = PackageSubDetail::firstOrCreate(
    //             ['package_id' => $request->package_id],
    //             ['count' => 0, 'amount' => 0]
    //         );

    //         $detail->increment('count', 1);
    //         $detail->increment('amount', $package->cost);

    //         DB::commit();
    //         return response()->json([
    //             'message' => $lang == 'ar' ? 'تم إنشاء الاشتراك بنجاح' : 'Subscription created successfully',
    //             'expire_at' => $expireAt
    //         ], 201);
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             'error' => $lang == 'ar' ? 'حدث خطأ ما' : 'Something went wrong',
    //             'details' => $e->getMessage()
    //         ], 500);
    //     }
    // }
    function createSubscription(Request $request)
    {
        try {
            DB::beginTransaction();

            $lang = $request->input('lang', 'en');

            $user = AppUser::find($request->user_id);
            if (!$user) {
                return response()->json(['error' => $lang == 'ar' ? 'المستخدم غير موجود' : 'User not found'], 404);
            }

            $package = PackageType::find($request->package_id);
            if (!$package || !$package->is_active) {
                return response()->json(['error' => $lang == 'ar' ? 'الباقة غير متوفرة أو غير مفعلة' : 'Package not found or inactive'], 400);
            }

            // ✅ تحقق من وجود اشتراك نشط لنفس الباقة
            $currentSub = Subscription::where('user_id', $request->user_id)
                ->where('package_id', $request->package_id)
                ->where('expire_at', '>=', now())
                ->first();

            if ($currentSub) {
                return response()->json([
                    'error' => $lang == 'ar' ? 'لديك اشتراك نشط في هذه الباقة بالفعل' : 'You already have an active subscription for this package'
                ], 400);
            }

            $wallet = Wallet::where('user_id', $request->user_id)->first();
            if (!$wallet) {
                return response()->json(['error' => $lang == 'ar' ? 'المحفظة غير موجودة' : 'Wallet not found'], 400);
            }

            if ($wallet->current_balance < $package->cost) {
                return response()->json(['error' => $lang == 'ar' ? 'الرصيد غير كافٍ' : 'Insufficient balance'], 400);
            }

            $wallet->current_balance -= $package->cost;
            $wallet->save();

            $wallet->details()->create([
                'name' => 'صرف',
                'amount' => $package->cost,
                'details' => 'شحن باقة ' . $package->name . ' ' . $package->type,
            ]);

            $expireAt = Carbon::now()->addDays($package->days)->toDateString();

            Subscription::create([
                'user_id' => $request->user_id,
                'package_id' => $request->package_id,
                'expire_at' => $expireAt,
            ]);

            $detail = PackageSubDetail::firstOrCreate(
                ['package_id' => $request->package_id],
                ['count' => 0, 'amount' => 0]
            );

            $detail->increment('count', 1);
            $detail->increment('amount', $package->cost);

            DB::commit();
            return response()->json([
                'message' => $lang == 'ar' ? 'تم إنشاء الاشتراك بنجاح' : 'Subscription created successfully',
                'expire_at' => $expireAt
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $lang == 'ar' ? 'حدث خطأ ما' : 'Something went wrong',
                'details' => $e->getMessage()
            ], 500);
        }
    }


    public function showSubscriptions($driver)
    {
        $subscriptions = Subscription::where('user_id', $driver)->whereHas('package')->with('package')->get();

        return response()->json([
            'message' => 'تم جلب الاشتراكات بنجاح',
            'data' => $subscriptions
        ]);
    }
}

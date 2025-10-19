<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Models\Mandub;
use App\Models\PackageSubDetail;
use App\Models\PackageType;
use App\Models\Passenger;
use App\Models\Subscription;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MandubController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0',
        ]);
        Mandub::create([
            'code' => $request->code,
            'name' => $request->name,
            'percentage' => $request->percentage,
            'user_name' => auth()->user()->name
        ]);
        return redirect()->back()->with('success', 'تم إضافة المندوب بنجاح');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0',
        ]);

        $mandub = Mandub::findOrFail($id);

        $mandub->update([
            'name' => $request->name,
            'code' => $request->code,
            'percentage' => $request->percentage,
        ]);

        return redirect()->back()->with('success', 'تم تعديل بيانات المندوب بنجاح');
    }


    public function index()
    {
        $mandubs = Mandub::whereNull('archive')->get();
        return view('/admin/transport/mandub/mandub', compact('mandubs'));
    }
    public function archived()
    {
        $mandubs = Mandub::where('archive', 'archived')->get();
        return view('/admin/transport/mandub/archive', compact('mandubs'));
    }
    public function show()
    {
        return view('/admin/transport/mandub/allMandub');
    }
    public function archive($id)
    {
        $mandub = Mandub::findOrFail($id);
        $mandub->archive = 'archived';
        $mandub->save();

        return redirect()->back()->with('success', 'تم أرشفة المندوب بنجاح');
    }
    public function unarchive($id)
    {
        $mandub = Mandub::findOrFail($id);
        $mandub->archive = Null;
        $mandub->save();

        return redirect()->back()->with('success', 'تم الغاء أرشفة المندوب بنجاح');
    }

    ///api
    public function addSub($code)
    {
        $mandub = Mandub::where('code', $code)->first();

        if (!$mandub) {
            return response()->json([
                'message' => 'الكود غير صحيح',
            ]);
        }

        $mandub->amount += $mandub->percentage;

        $mandub->count = ($mandub->count ?? 0) + 1;

        $mandub->save();

        return response()->json([
            'message' => 'تم بنجاح',
        ]);
    }


    //

    public function spend($id)
    {
        $mandub = Mandub::findOrFail($id);

        // نقل المبلغ إلى الصرف وتصفير المبلغ
        $mandub->spent += $mandub->amount;
        $mandub->amount = 0;

        $mandub->save();

        return redirect()->back()->with('success', 'تم صرف المبلغ بنجاح');
    }



    //api delete data
    public function deleteDataBase()
    {
        // إيقاف التحقق من الـ foreign key مؤقتاً
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // احذف الجداول المرتبطة أولاً
        DB::table('wallet_details')->delete();
        DB::table('wallets')->delete();
        DB::table('mandubs')->delete();
        DB::table('passengers')->delete();
        DB::table('subscriptions')->delete();
        DB::table('package_types')->delete();
        DB::table('package_sub_details')->delete();

        // تفعيل التحقق مرة أخرى
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return response()->json(['message' => 'Data deleted from tables successfully']);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PackageType;
use Illuminate\Http\Request;

class PackageController extends Controller
{



    public function show()
    {
        $packages = PackageType::where('is_active', true)->get();

        return response()->json([
            'message' => 'تم جلب الباقات بنجاح ✅',
            'data' => $packages
        ], 200);
    }


    // عرض جميع الباقات
    public function index()
    {
        $Types = PackageType::all();
        return view('/admin/transport/subscriptions/packageTypes', compact('Types'));
    }



    // حفظ باقة جديدة في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'days' => 'nullable|integer|min:1',
            'cost' => 'nullable|numeric|min:0',
        ]);
        PackageType::create($request->all());
        toastr()->success('تمت الاضافة بنجاح');
        return back();
    }


    public function update(Request $request, $id)
    {
        $packageType = PackageType::findOrFail($id);

        $request->validate([
            'name' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'days' => 'nullable|integer|min:1',
            'cost' => 'nullable|numeric|min:0',
        ]);

        $packageType->update($request->all());

        toastr()->success('تمت التحديث بنجاح');
        return back();
    }

    // تفعيل أو تعطيل الباقة
    public function toggleActive($id)
    {
        $packageType = PackageType::findOrFail($id);
        $packageType->is_active = !$packageType->is_active; // تبديل القيمة بين true و false
        $packageType->save();

        toastr()->success('تمت العملية بنجاح');
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Alahda;
use App\Models\AlahdaCount;
use Illuminate\Http\Request;

class AlahdaController extends Controller
{

      public function all(){
        return view('/admin/alahd/all');   
    }
    
    public function index(){
        $alahdas=Alahda::whereNull('archive')->get();
        return view('/admin/alahd/alahd', compact('alahdas'));   
    }

    public function archiveAlahda()
    {
        $alahdas = Alahda::where('archive', 'archived')->get();
        return view('/admin/alahd/archive', compact('alahdas'));
    }
    public function archive($id)
    {
        $alahda= Alahda::findOrFail($id);
        $alahda->archive = 'archived';
        $alahda->save();
        toastr()->success('تم ارشيف العهده بنجاح');
        return redirect()->back();
    }
    ///
    public function unarchive($id)
    {
        $alahda = Alahda::findOrFail($id);
        $alahda->archive = null;
        $alahda->save();
        toastr()->success('تم إلغاء أرشفة العهده بنجاح');
        return redirect()->back();
    }
    public function store(Request $request)
{
    $request->validate([
        'name' => 'nullable|string',
        'description' => 'nullable|string',
        'count' => 'nullable|integer|min:1'
    ]);

    $alahda = Alahda::create([
        'name' => $request->name,
        'description' => $request->description,
        'count' => $request->count,
        'user_name' => auth()->user()->name

    ]);

    foreach ($request->serial_numbers as $serial) {
        AlahdaCount::create([
            'alahda_id' => $alahda->id,
            'serial_number' => $serial,
        ]);
    }

    return redirect()->back()->with('success', 'تم إنشاء العهدة وعددها بنجاح ✅');
}

public function addCount(Request $request, $id)
{
    $request->validate([
        'new_count' => 'required|integer|min:1',
        'serial_numbers' => 'required|array|min:1',
        'serial_numbers.*' => 'required|string',
    ]);

    $alahda = Alahda::findOrFail($id);

    foreach ($request->serial_numbers as $serial) {
        AlahdaCount::create([
            'alahda_id' => $alahda->id,
            'serial_number' => $serial,
        ]);
    }

    // تحديث العدد الإجمالي
    $alahda->count += count($request->serial_numbers);
    $alahda->save();

    return redirect()->back()->with('success', 'تمت إضافة العدد الجديد للعهدة بنجاح ✅');
}
//
public function deleteSerial($id)
{
    $serial = AlahdaCount::findOrFail($id);

    // نحفظ العهدة المرتبطة لتحديث العدد
    $alahda = $serial->alahda;

    $serial->delete();

    // نحدث العدد
    $alahda->count = $alahda->alahdaCounts()->count();
    $alahda->save();

    return redirect()->back()->with('success', 'تم حذف السيريال بنجاح ✅');
}


}

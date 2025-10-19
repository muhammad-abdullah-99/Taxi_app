<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    
    public function index()
    {
        $purchases = Purchase::all();
        return view('admin.transport.purchases.purchase', compact('purchases'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'amount' => 'required|numeric',
            'tax' => 'required|numeric',
            'total' => 'required|numeric',
            'attachments' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);


            $attachmentPath = null;
            if ($request->hasFile('image')) {
                $destinationPath = public_path('storage/drivers/ids');
                $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->move($destinationPath, $fileName);
                $attachmentPath = 'drivers/ids/' . $fileName;
            }

            $purchase = Purchase::create([
                'description' => $request->description,
                'amount' => $request->amount,
                'tax' => $request->tax,
                'total' => $request->total,
                'image' => $attachmentPath,
            ]);

            
            session()->flash('success', 'تم إنشاء المشتريات بنجاح');
            return back();
        } 
    

        public function update(Request $request, $id)
        {
            $request->validate([
                'description' => 'sometimes|string',
                'amount' => 'sometimes|numeric',
                'tax' => 'sometimes|numeric',
                'total' => 'sometimes|numeric',
                'image' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
            ]);
        
            DB::beginTransaction(); // بدء المعاملة لضمان سلامة البيانات
        
                $purchase = Purchase::findOrFail($id);
                $updateData = $request->except('image'); // استبعاد الصورة مؤقتًا
        
                if ($request->hasFile('image')) {
                    $destinationPath = public_path('storage/drivers/ids');
                    $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
                    $request->file('image')->move($destinationPath, $fileName);
                    $updateData['image'] = 'drivers/ids/' . $fileName;
                }
        
                $purchase->update($updateData); // تحديث البيانات
        
        
                session()->flash('success', 'تم تحديث المشتريات بنجاح');
            
            return back();
        }
        
}

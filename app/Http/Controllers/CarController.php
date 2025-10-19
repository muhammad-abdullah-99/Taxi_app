<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarDriver;
use App\Models\CarMaintenance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;


class CarController extends Controller
{
    public function showAllCars()
    {
        return view('/admin/cars/showAllCars');
    }
    // public function index()
    // {

    //     $cars = Car::whereNull('archive')->get();;
    //     return view('/admin/cars/allCars', compact('cars'));
    // }

    public function index(Request $request)
    {
        
        $query = Car::whereNull('archive');
    
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
    
        $cars = $query->get();
    
        // احصائيات الحالات
        $statusesCount = Car::whereNull('archive')
            ->select('status', \DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();
    
        $totalCount = array_sum($statusesCount);
    
        return view('admin.cars.allCars', [
            'cars' => $cars,
            'status' => $request->status ?? 'all',
            'statusesCount' => $statusesCount,
            'totalCount' => $totalCount,
        ]);
    }
    

    public function archiveCar()
    {
        $cars = Car::where('archive', 'archived')->get();
        return view('/admin/cars/archiveCars', compact('cars'));
    }

//     public function store(Request $request)
//     {
//         $validatedData = $request->validate([
//             'name' => 'required',
//             'type' => 'required',
//             'plate_number' => 'required|unique:cars',
//             'card_number' => 'nullable',
//             'serial_number' => 'nullable',
//             'color' => 'nullable',
//             'status' => 'nullable',
//         ], [
//             'name.required' => 'حقل الاسم مطلوب.',
//             'type.required' => 'حقل النوع مطلوب.',
//             'plate_number.required' => 'رقم اللوحة مطلوب.',
//             'plate_number.unique' => 'رقم اللوحة مسجل مسبقًا.',
//         ]);

// $car = Car::create(array_merge($validatedData, [
//     'user_name' => auth()->user()->name,
// ]));

//         if ($car) {
//             toastr()->success('تمت إضافة السيارة بنجاح');
//             return back();
//         } else {
//             toastr()->error('هناك مشكلة حالياً، يرجى المحاولة مرة أخرى');
//             return back();
//         }
//     }

//     public function update(Request $request, Car $car)
//     {
//         $validatedData = $request->validate([
//             'name' => 'required',
//             'type' => 'required',
//             'plate_number' => [
//                 'required',
//                 Rule::unique('cars')->ignore($car->id),
//             ],
//             'card_number' => 'nullable',
//             'serial_number' => 'nullable',
//             'color' => 'nullable',
//             'status' => 'nullable',
//         ], [
//             'name.required' => 'حقل الاسم مطلوب.',
//             'type.required' => 'حقل النوع مطلوب.',
//             'plate_number.required' => 'رقم اللوحة مطلوب.',
//             'plate_number.unique' => 'رقم اللوحة مسجل مسبقًا.',
//         ]);

//         $car->update($validatedData);

//         toastr()->success('تم تعديل السيارة بنجاح');
//         return back();
//     }

// Add Cars 
public function addCars()
{
    $types = Car::get();
    return view('admin.cars.addCars', compact('types')); 
}
// Add Cars

public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'type' => 'required',
        'plate_number' => 'required|unique:cars',
        'card_number' => 'nullable',
        'serial_number' => 'nullable',
        'color' => 'nullable',
        'status' => 'nullable',
        'type_price' => 'nullable|in:شهري,يومي',
        'price' => 'nullable|numeric',
    ], [
        'name.required' => 'حقل الاسم مطلوب.',
        'type.required' => 'حقل النوع مطلوب.',
        'plate_number.required' => 'رقم اللوحة مطلوب.',
        'plate_number.unique' => 'رقم اللوحة مسجل مسبقًا.',
        'price.numeric' => 'قيمة السعر يجب أن تكون رقمًا.',
    ]);

    $car = Car::create(array_merge($validatedData, [
        'user_name' => auth()->user()->name,
    ]));

    if ($car) {
        toastr()->success('تمت إضافة السيارة بنجاح');
        return back();
    } else {
        toastr()->error('هناك مشكلة حالياً، يرجى المحاولة مرة أخرى');
        return back();
    }
}




public function update(Request $request, Car $car)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'type' => 'required',
        'plate_number' => [
            'required',
            Rule::unique('cars')->ignore($car->id),
        ],
        'card_number' => 'nullable',
        'serial_number' => 'nullable',
        'color' => 'nullable',
        'status' => 'nullable',
        'type_price' => 'nullable|in:شهري,يومي',
        'price' => 'nullable|numeric',
    ], [
        'name.required' => 'حقل الاسم مطلوب.',
        'type.required' => 'حقل النوع مطلوب.',
        'plate_number.required' => 'رقم اللوحة مطلوب.',
        'plate_number.unique' => 'رقم اللوحة مسجل مسبقًا.',
        'price.numeric' => 'قيمة السعر يجب أن تكون رقمًا.',
    ]);

    $car->update($validatedData);

    toastr()->success('تم تعديل السيارة بنجاح');
    return back();
}


    // public function archive(Car $car)
    // {
    //     $car->status = 'خارج عن الخدمة'; 
    //     $car->save(); 
    //     toastr()->success('تم ارشيف السيارة بنجاح');

    //     // Redirect back
    //     return redirect()->back();
    // }

    public function archive($id)
    {
        $car = Car::findOrFail($id);
        $car->archive = 'archived';
        $car->save();
        toastr()->success('تم ارشيف السيارة بنجاح');
        return redirect()->back();
    }
    ///
    public function unarchiveCar($id)
    {
        $car = car::findOrFail($id);
        $car->archive = null;
        $car->save();
        toastr()->success('تم إلغاء أرشفة المستند بنجاح');
        return redirect()->back();
    }
    //showHandover
    public function showHandover($id)
    {
        $car = car::findOrFail($id);
        $employees = Employee::get();
        $handoverRecords = CarDriver::where('car_id', $id)->get();
        return view('/admin/cars/handover', compact('employees', 'handoverRecords', 'car'));
    }
    public function storeHandover(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'car_id' => 'required|exists:cars,id',
            'handover_date' => 'required|date',
            'initial_meter_reading' => 'required|numeric|min:0',
        ], [
            'employee_id.required' => 'يرجى اختيار الموظف.',
            'employee_id.exists' => 'الموظف غير موجود في النظام.',
            'car_id.required' => 'يرجى اختيار السيارة.',
            'car_id.exists' => 'السيارة غير موجودة في النظام.',
            'handover_date.required' => 'يرجى تحديد تاريخ الاستلام.',
            'handover_date.date' => 'يجب أن يكون تاريخ الاستلام تاريخًا صالحًا.',
            'initial_meter_reading.required' => 'يرجى إدخال قراءة العداد عند الاستلام.',
            'initial_meter_reading.numeric' => 'يجب أن تكون قراءة العداد رقمًا.',
            'initial_meter_reading.min' => 'يجب أن تكون قراءة العداد قيمة موجبة.',
        ]);

        CarDriver::create([
            'employee_id' => $request->employee_id,
            'car_id' => $request->car_id,
            'handover_date' => $request->handover_date,
            'initial_meter_reading' => $request->initial_meter_reading,
        ]);

        return redirect()->back()->with('success', 'تمت إضافة عملية التسليم بنجاح!');
    }
    public function updateHandover(Request $request, $id)
    {
        $request->validate([
            'return_date' => 'required|date|after_or_equal:handover_date',
            'final_meter_reading' => 'required|numeric|min:0',
        ], [
            'return_date.required' => 'يرجى تحديد تاريخ التسليم.',
            'return_date.date' => 'يجب أن يكون تاريخ التسليم تاريخًا صالحًا.',
            'return_date.after_or_equal' => 'يجب أن يكون تاريخ التسليم مساويًا أو بعد تاريخ الاستلام.',
            'final_meter_reading.required' => 'يرجى إدخال قراءة العداد عند التسليم.',
            'final_meter_reading.numeric' => 'يجب أن تكون قراءة العداد رقمًا.',
            'final_meter_reading.min' => 'يجب أن تكون قراءة العداد قيمة موجبة.',
        ]);

        $handover = CarDriver::findOrFail($id);

        if ($request->final_meter_reading < $handover->initial_meter_reading) {
            return redirect()->back()->with('error', 'قراءة العداد عند التسليم يجب أن تكون أكبر من قراءة الاستلام.');
        }

        $handover->update([
            'return_date' => $request->return_date,
            'final_meter_reading' => $request->final_meter_reading,
        ]);

        return redirect()->back()->with('success', 'تم تحديث بيانات التسليم بنجاح!');
    }
    //
    public function editBasic(Request $request, $id)
    {
        $handover = CarDriver::findOrFail($id);

        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'handover_date' => 'required|date',
            'initial_meter_reading' => 'required|numeric|min:0',
        ]);

        $handover->update([
            'employee_id' => $request->employee_id,
            'handover_date' => $request->handover_date,
            'initial_meter_reading' => $request->initial_meter_reading,
        ]);

        return redirect()->back()->with('success', 'تم تعديل البيانات الأساسية بنجاح');
    }
    //carMaintenance
    public function carMaintenance($c, $e)
    {
        $car = Car::findOrFail($c);
        $employee = Employee::findOrFail($e);
        $maintenances = CarMaintenance::where('car_id', $c)
            ->where('employee_id', $e)
            ->get();
        return view('/admin/cars/carMaintenance', compact('car', 'employee','maintenances'));
    }
    //
    public function storeCarMaintenance(Request $request, $car ,$employee)
{
    // تحقق من البيانات المدخلة
    $validatedData = $request->validate([
        'maintenance_type' => 'required|string|max:255',
        'odometer_reading' => 'required|integer',
        'invoice_image' => 'nullable|file|mimes:jpg,png,pdf', // تحديد نوع الملفات المسموح بها
        'notes' => 'nullable|string|max:500',
    ], [
        'maintenance_type.required' => 'نوع الصيانة مطلوب.',
        'maintenance_type.string' => 'نوع الصيانة يجب أن يكون نصًا.',
        'maintenance_type.max' => 'نوع الصيانة يجب ألا يتجاوز 255 حرفًا.',
        'odometer_reading.required' => 'رقم العداد مطلوب.',
        'odometer_reading.integer' => 'رقم العداد يجب أن يكون عددًا صحيحًا.',
        'invoice_image.file' => 'الصورة يجب أن تكون ملفًا.',
        'invoice_image.mimes' => 'الصورة يجب أن تكون من نوع jpg, png, أو pdf.',
        'notes.string' => 'الملاحظات يجب أن تكون نصًا.',
        'notes.max' => 'الملاحظات يجب ألا تتجاوز 500 حرفًا.',
    ]);

    // حفظ بيانات الصيانة
    $maintenance = CarMaintenance::create([
        'car_id' => $car,
        'employee_id' => $employee,
        'maintenance_type' => $validatedData['maintenance_type'],
        'odometer_reading' => $validatedData['odometer_reading'],
        'notes' => $validatedData['notes'] ?? null,
    ]);

    // حفظ صورة الفاتورة إذا كانت موجودة
    if ($request->hasFile('invoice_image')) {
        $file = $request->file('invoice_image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('storage/car_maintenance_invoices');

        // نقل الصورة للمسار المحدد
        $file->move($destinationPath, $fileName);

        // تحديث مسار الصورة في قاعدة البيانات
        $maintenance->update([
            'invoice_image' => 'car_maintenance_invoices/' . $fileName
        ]);
    }

    toastr()->success('تم حفظ بيانات الصيانة بنجاح');
    return back();
}
//
public function updateCarMaintenance(Request $request, $id)
{
    // تحقق من البيانات المدخلة
    $validatedData = $request->validate([
        'maintenance_type' => 'required|string|max:255',
        'odometer_reading' => 'required|integer',
        'invoice_image' => 'nullable|file|mimes:jpg,png,pdf',
        'notes' => 'nullable|string|max:500',
    ], [
        'maintenance_type.required' => 'نوع الصيانة مطلوب.',
        'maintenance_type.string' => 'نوع الصيانة يجب أن يكون نصًا.',
        'maintenance_type.max' => 'نوع الصيانة يجب ألا يتجاوز 255 حرفًا.',
        'odometer_reading.required' => 'رقم العداد مطلوب.',
        'odometer_reading.integer' => 'رقم العداد يجب أن يكون عددًا صحيحًا.',
        'invoice_image.file' => 'الصورة يجب أن تكون ملفًا.',
        'invoice_image.mimes' => 'الصورة يجب أن تكون من نوع jpg, png, أو pdf.',
        'notes.string' => 'الملاحظات يجب أن تكون نصًا.',
        'notes.max' => 'الملاحظات يجب ألا تتجاوز 500 حرفًا.',
    ]);

    // تحديث بيانات الصيانة
    $maintenance = CarMaintenance::findOrFail($id);
    $maintenance->update([
        'maintenance_type' => $validatedData['maintenance_type'],
        'odometer_reading' => $validatedData['odometer_reading'],
        'notes' => $validatedData['notes'] ?? null,
    ]);

    // حفظ صورة الفاتورة إذا كانت موجودة
    if ($request->hasFile('invoice_image')) {
        $file = $request->file('invoice_image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $destinationPath = public_path('storage/car_maintenance_invoices');

        // نقل الصورة للمسار المحدد
        $file->move($destinationPath, $fileName);

        // تحديث مسار الصورة في قاعدة البيانات
        $maintenance->update([
            'invoice_image' => 'car_maintenance_invoices/' . $fileName
        ]);
    }

    toastr()->success('تم تحديث بيانات الصيانة بنجاح');
    return back();
}
//
public function deleteCarMaintenance($id)
{
    $maintenance = CarMaintenance::findOrFail($id);

    // حذف صورة الفاتورة إذا كانت موجودة
    if ($maintenance->invoice_image) {
        $filePath = public_path('storage/' . $maintenance->invoice_image);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    // حذف بيانات الصيانة
    $maintenance->delete();

    toastr()->success('تم حذف بيانات الصيانة بنجاح');
    return back();
}
public function updateExpiry(Request $request, Car $car)
{
    $field = $request->input('field');
    $value = $request->input('value');

    if (in_array($field, ['saer_expire_at', 'tamen_expire_at', 'fahs_expire_at', 'cart_expire_at', 'zaet_expire_at', 'tafwed_expire_at'])) {
        $car->$field = $value;
        $car->save();
    }

    return back()->with('success', 'تم تحديث التاريخ بنجاح.');
}

//
public function report(Request $request)
{
    $status = $request->status ?? 'all';

    if($status == 'all'){
        $cars = Car::with('carDrivers')->get();
    } else {
        $cars = Car::where('status', $status)->with('carDrivers')->get();
    }

    $statuses = [
        'all' => 'عرض الكل',
        'عاملة' => 'عاملة',
        'متعطلة' => 'متعطلة',
        'انتظار' => 'انتظار',
        'خارج عن الخدمة' => 'خارج عن الخدمة',
    ];

    return view('admin.cars.report', compact('cars', 'statuses', 'status'));
}

}

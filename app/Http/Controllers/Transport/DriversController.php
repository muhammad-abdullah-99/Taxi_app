<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DriversController extends Controller
{

    public function showAllDrivers()
    {
            $companies = Company::with(['appUser' => function ($query) {
        $query->where('user_type', 1)
            ->where('status', 1)
            ->where('name', '!=', 'guest')
            ->with('vehicle');
    }])->get();

        return view('/admin/transport/drivers/allDrivers',compact('companies'));
    }
    // public function showCurrentDrivers()
    // {
    //     $drivers = AppUser::where('user_type', 1)->where('status', 1)
    //         ->where('name', '!=', 'guest')
    //         ->with(['company', 'vehicle'])->get();
    //     return view('/admin/transport/drivers/currentDrivers', compact('drivers'));
    // }
  public function showCurrentDrivers($companyType = null)
{
    $query = AppUser::where('user_type', 1)
        ->where('status', 1)
        ->where('name', '!=', 'guest')
        ->with(['company', 'vehicle']);

    if ($companyType) {
        $query->whereHas('company', function ($q) use ($companyType) {
            $q->where('company_type', $companyType);
        });
    }

    $drivers = $query->get();

    return view('/admin/transport/drivers/currentDrivers', compact('drivers', 'companyType'));
}


    public function showWaitingDrivers()
    {
        $drivers = AppUser::where('user_type', 1)->where('status', null)->with(['company', 'vehicle'])->get();
        return view('/admin/transport/drivers/waitingDrivers', compact('drivers'));
    }
    public function showarchiveDrivers()
    {
        $drivers = AppUser::where('user_type', 1)->where('status', 2)->with(['company', 'vehicle'])->get();
        return view('/admin/transport/drivers/archiveDrivers', compact('drivers'));
    }

    public function activeDriver(Request $request, $id)
    {
        $driver = AppUser::find($id);

        if (!$driver) {
            toastr()->error('السائق غير موجود');
            return back();
        }

        $driver->status = 1;
        $driver->user_name = auth()->user()->name;
        $driver->accept_driver = now();

        $driver->save();

        $lang = $request->lang ?? 'ar';

        $messages = [
            'ar' => "تم قبول طلبك رقم ({$driver->id_number}) بنجاح.\nيمكنك الآن الاستفادة من خدمات التطبيق المتاحة.\n\nتطبيق روز لتوجيه الحافلات\nللتواصل واتساب: 0551796056",

            'en' => "Your application (ID: {$driver->id_number}) has been successfully approved.\nYou can now benefit from the available services in the app.\n\nRose Bus Guidance App\nContact WhatsApp: 0551796056",

            'ur' => "آپ کی درخواست (ID: {$driver->id_number}) کامیابی سے منظور کر لی گئی ہے۔\nآپ اب ایپ میں دستیاب خدمات سے فائدہ اٹھا سکتے ہیں۔\n\nروز بس رہنمائی ایپ\nرابطہ کریں واٹس ایپ: 0551796056",
        ];


        // إرسال رسالة SMS عبر Taqnyat
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.taqnyat.bearer_token'),
                'Content-Type' => 'application/json',
            ])->post(config('services.taqnyat.url'), [
                'sender' => config('services.taqnyat.sender'),
                'recipients' => [$driver->mobile],
                'body' => $messages[$lang] ?? $messages['ar'],
            ]);

            if (!$response->successful()) {
                Log::error('Taqnyat SMS Failed', ['response' => $response->body()]);
            }
        } catch (\Exception $e) {
            Log::error('SMS Send Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }

        toastr()->success('تم الموافقة على السائق بنجاح');
        return back();
    }


    public function deactiveDriver($id)
    {

        $driver = AppUser::where('id', $id)->first();
        if ($driver) {
            $driver->status = null;
            $driver->save();
        }

        toastr()->success('تم الغاء التنشيط بنجاح');
        return back();
    }
    //
    // public function archiveDriver($id)
    // {

    //     $driver = AppUser::where('id', $id)->first();
    //     if ($driver) {
    //         $driver->status = 2;
    //         $driver->save();
    //     }

    //     toastr()->success('تم الارشيف بنجاح');
    //     return back();
    // }
    public function archiveDriver(Request $request, $id)
    {
        $driver = AppUser::find($id);

        if (!$driver) {
            toastr()->error('السائق غير موجود');
            return back();
        }

        $driver->status = 2;
        $driver->user_name = auth()->user()->name;
        $driver->accept_driver = now();
        $driver->save();

        $lang = $request->lang ?? 'ar';

        $messages = [
            'ar' => "تم رفض طلبك رقم ({$driver->id_number})\nوذلك بسبب عدم صحة البيانات أو المستندات المرفقة.\nيمكنك إعادة تقديم طلب التسجيل بعد توفر المستندات النظامية.\n\nتطبيق روز لتوجيه الحافلات\nللتواصل واتساب: 0551796056",

            'en' => "Your application (ID: {$driver->id_number}) has been rejected due to incorrect or missing documents.\nYou may reapply once the official documents are available.\n\nRose Bus Guidance App\nContact WhatsApp: 0551796056",

            'ur' => "آپ کی درخواست (ID: {$driver->id_number}) مسترد کر دی گئی ہے کیونکہ فراہم کردہ دستاویزات درست نہیں ہیں۔\nآپ دستاویزات مکمل ہونے کے بعد دوبارہ درخواست دے سکتے ہیں۔\n\nروز بس رہنمائی ایپ\nرابطہ کریں واٹس ایپ: 0551796056",
        ];


        // إرسال رسالة SMS عبر Taqnyat
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.taqnyat.bearer_token'),
                'Content-Type' => 'application/json',
            ])->post(config('services.taqnyat.url'), [
                'sender' => config('services.taqnyat.sender'),
                'recipients' => [$driver->mobile],
                'body' => $messages[$lang] ?? $messages['ar'],
            ]);

            if (!$response->successful()) {
                Log::error('Taqnyat SMS Failed', ['response' => $response->body()]);
            }
        } catch (\Exception $e) {
            Log::error('SMS Send Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }

        toastr()->success('تم الرفض وأرشفة السائق بنجاح');
        return back();
    }


    public function unarchiveDriver($id)
    {

        $driver = AppUser::where('id', $id)->first();
        if ($driver) {
            $driver->status = 1;
            $driver->save();
        }

        toastr()->success('تم الغاء الارشيف بنجاح');
        return back();
    }

    // getCompany
    public function companies()
    {
        $companies = Company::with('appUser')
            ->whereHas('appUser', function ($query) {
                $query->where('status', '1');
            })
            ->get()
            ->unique('company_registration_number'); // <-- يحذف التكرار بعد جلب البيانات


        return view('/admin/transport/company/company', compact('companies'));
    }
    public function archivedCompanies()
    {
        $companies = Company::with('appUser')
            ->whereHas('appUser', function ($query) {
                $query->where('status', '2');
            })
            ->get();
        return view('/admin/transport/company/archivedCompanies', compact('companies'));
    }
    public function getCompanies()
    {
        return view('/admin/transport/company/allCompanies');
    }


    public function editDriver($id)
    {
        $driver = AppUser::where('id', $id)->first();
        return view('/admin/transport/drivers/driverEdit', compact('driver'));
    }


    // public function updateDriver(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'id_number' => 'required|string|max:20',
    //         'mobile' => 'required|string|max:15',
    //         'company_name' => 'nullable|string|max:255',
    //         'company_location' => 'nullable|string|max:255',
    //         'company_type' => 'nullable|string|max:255',
    //         'company_registration_number' => 'nullable|string|max:50',
    //         'car_type' => 'nullable|string|max:255',
    //         'car_model' => 'nullable|string|max:255',
    //         'car_color' => 'nullable|string|max:50',
    //         'number_of_passengers' => 'nullable|string|max:50',
    //         'licence_plate_number' => 'nullable|string|max:20',
    //     ], [
    //         'name.required' => 'الاسم مطلوب.',
    //         'name.string' => 'يجب أن يكون الاسم نصًا.',
    //         'name.max' => 'يجب ألا يتجاوز الاسم 255 حرفًا.',
    //         'id_number.required' => 'رقم الهوية مطلوب.',
    //         'id_number.string' => 'يجب أن يكون رقم الهوية نصًا.',
    //         'id_number.max' => 'يجب ألا يتجاوز رقم الهوية 20 حرفًا.',
    //         'mobile.required' => 'رقم الجوال مطلوب.',
    //         'mobile.string' => 'يجب أن يكون رقم الجوال نصًا.',
    //         'mobile.max' => 'يجب ألا يتجاوز رقم الجوال 15 حرفًا.',
    //         'company_name.string' => 'يجب أن يكون اسم الشركة نصًا.',
    //         'company_location.string' => 'يجب أن يكون موقع الشركة نصًا.',
    //         'company_type.string' => 'يجب أن يكون نوع الشركة نصًا.',
    //         'company_registration_number.string' => 'يجب أن يكون رقم التسجيل نصًا.',
    //         'car_type.string' => 'يجب أن يكون نوع السيارة نصًا.',
    //         'car_model.string' => 'يجب أن يكون موديل السيارة نصًا.',
    //         'car_color.string' => 'يجب أن يكون لون السيارة نصًا.',
    //         'licence_plate_number.string' => 'يجب أن يكون رقم اللوحة نصًا.',
    //     ]);

    //     $driver = AppUser::findOrFail($id);
    //     $driver->update($request->only(['name', 'id_number', 'mobile']));

    //     if ($driver->company) {
    //         $driver->company->update($request->only(['company_name', 'company_location', 'company_type', 'company_registration_number']));
    //     }

    //     if ($driver->vehicle) {
    //         $driver->vehicle->update($request->only(['car_type', 'car_model', 'car_color', 'licence_plate_number','number_of_passengers']));
    //     }
    //     return redirect()->back()->with('success', 'تم تحديث بيانات السائق بنجاح.');

    //     // return redirect()->route('showWaitingDrivers')->with('success', 'تم تحديث بيانات السائق بنجاح.');
    // }
    public function updateDriver(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id_number' => 'required|string|max:20',
            'mobile' => 'required|string|max:15',
            'company_name' => 'nullable|string|max:255',
            'company_location' => 'nullable|string|max:255',
            'company_type' => 'nullable|string|max:255',
            'company_registration_number' => 'nullable|string|max:50',
            'car_type' => 'nullable|string|max:255',
            'car_model' => 'nullable|string|max:255',
            'car_color' => 'nullable|string|max:50',
            'number_of_passengers' => 'nullable|string|max:50',
            'licence_plate_number' => 'nullable|string|max:20',
        ], [
            'name.required' => 'الاسم مطلوب.',
            'id_number.required' => 'رقم الهوية مطلوب.',
            'mobile.required' => 'رقم الجوال مطلوب.',
        ]);

        $driver = AppUser::findOrFail($id);

        // تحديث بيانات السائق
        $driver->update($request->only(['name', 'id_number', 'mobile']));

        // إنشاء أو تحديث الشركة
        $driver->company()->updateOrCreate(
            ['user_id' => $driver->id], // الشرط للتحديث
            $request->only(['company_name', 'company_location', 'company_type', 'company_registration_number'])
        );

        // إنشاء أو تحديث السيارة
        $driver->vehicle()->updateOrCreate(
            ['user_id' => $driver->id], // الشرط للتحديث
            $request->only(['car_type', 'car_model', 'car_color', 'licence_plate_number', 'number_of_passengers'])
        );

        return redirect()->back()->with('success', 'تم تحديث بيانات السائق والشركة والسيارة بنجاح.');
    }

    /////

    public function deleteDriver($id)
    {

        $driver = AppUser::where('id', $id)->first();
        if ($driver) {
            $driver->delete();
        }

        toastr()->success('تم الحذف  بنجاح');
        return back();
    }
}

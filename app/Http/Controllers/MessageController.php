<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use App\Models\Employee;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('employee')->latest()->get();
        $employees = Employee::whereNull('archive')->get();
        return view('admin.messages.messages', compact('messages', 'employees'));
    }


    public function appIndex()
    {
        $userApp = AppUser::where('name', '!=', 'guest')->with('company')->get();
        return view('admin.transport.messages.messages', compact('userApp'));
    }

public function storeAppUser(Request $request)
{
    // التحقق من صحة البيانات المدخلة
  $validated = $request->validate([
    'name' => 'required|string|max:255',
    'mobile' => 'required|string|max:20|unique:app_users,mobile',
    'address' => 'nullable|string|max:255',
], [
    'mobile.unique' => 'رقم الموبايل مسجل بالفعل.',
    'name.required' => 'يرجى إدخال الاسم.',
    'mobile.required' => 'يرجى إدخال رقم الموبايل.',
]);


    try {
        // محاولة إضافة المستخدم
        AppUser::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'status' => 1,
        ]);

        // إعادة التوجيه مع رسالة النجاح
        return redirect()->back()->with('success', 'تمت الإضافة بنجاح');

    } catch (\Exception $e) {
        // في حال حدوث أي خطأ
        return redirect()->back()->withErrors(['error' => 'حدث خطأ أثناء الإضافة. حاول مرة أخرى.'])->withInput();
    }
}





    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'employee_id' => 'required',
    //         'message' => 'required|string',
    //     ]);

    //     Message::create([
    //         'employee_id' => $request->employee_id,
    //         'message' => $request->message,
    //     ]);

    //     return back()->with('success', 'تم بنجاح.');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'message' => 'required|string',
        ]);

        // حفظ الرسالة في قاعدة البيانات
        $message = Message::create([
            'employee_id' => $request->employee_id,
            'message' => $request->message,
        ]);

        // جلب الموظف
        $employee = \App\Models\Employee::find($request->employee_id);

        if ($employee && $employee->phone) {
            try {
                // إرسال SMS عبر Taqnyat
                $response = \Illuminate\Support\Facades\Http::withHeaders([
                    'Authorization' => 'Bearer ' . config('services.taqnyat.bearer_token'),
                    'Content-Type' => 'application/json',
                ])->post(config('services.taqnyat.url'), [
                    'sender' => config('services.taqnyat.sender'),
                    'recipients' => [$employee->phone],
                    'body' => $request->message,
                ]);

                if (!$response->successful()) {
                    \Illuminate\Support\Facades\Log::error('فشل إرسال SMS للموظف', ['response' => $response->body()]);
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('خطأ أثناء إرسال SMS', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);
            }
        }

        return back()->with('success', 'تم إرسال الرسالة بنجاح.');
    }

    public function sendSms(Request $request)
    {
        $request->validate([
            'selected_users' => 'required|array',
            'message' => 'required|string',
        ]);

        foreach ($request->selected_users as $phone) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . config('services.taqnyat.bearer_token'),
                    'Content-Type' => 'application/json',
                ])->post(config('services.taqnyat.url'), [
                    'sender' => config('services.taqnyat.sender'),
                    'recipients' => [$phone],
                    'body' => $request->message,
                ]);

                if (!$response->successful()) {
                    Log::error('فشل إرسال SMS للمستخدم', ['phone' => $phone, 'response' => $response->body()]);
                }
            } catch (\Exception $e) {
                Log::error('خطأ أثناء إرسال SMS', [
                    'phone' => $phone,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return back()->with('success', 'تم إرسال الرسائل بنجاح للمستخدمين المحددين.');
    }



public function sendDriverMessage(Request $request)
{
    $request->validate([
        'driver_id' => 'required|exists:app_users,id',
        'message' => 'required|string',
    ]);

    $driver = AppUser::findOrFail($request->driver_id);
    $phone = $driver->mobile;

    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . config('services.taqnyat.bearer_token'),
            'Content-Type' => 'application/json',
        ])->post(config('services.taqnyat.url'), [
            'sender' => config('services.taqnyat.sender'),
            'recipients' => [$phone],
            'body' => $request->message,
        ]);

        if (!$response->successful()) {
            Log::error('فشل إرسال SMS للسائق', [
                'driver_id' => $driver->id,
                'phone' => $phone,
                'response' => $response->body()
            ]);

return back()->with('error', 'فشل إرسال الرسالة: ' . $response->body());
        }

    } catch (\Exception $e) {
        Log::error('خطأ أثناء إرسال SMS للسائق', [
            'driver_id' => $driver->id,
            'phone' => $phone,
            'error' => $e->getMessage(),
        ]);

        return back()->with('error', 'حدث خطأ أثناء إرسال الرسالة.');
    }

    return back()->with('success', 'تم إرسال الرسالة بنجاح للسائق.');
}

}

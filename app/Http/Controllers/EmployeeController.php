<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeFile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class EmployeeController extends Controller
{
    public function showAllEmployees()
    {
        // عرض جميع الموظفين
        return view('admin.employees.showAllEmployees');
    }
    
    public function toggleAllArchive()
    {
        $archivedIds = Employee::where('archive', 'archived')->pluck('id');

        Employee::whereIn('id', $archivedIds)->update(['archive' => null]);

        // Employee::whereNotIn('id', $archivedIds)->update(['archive' => 'archived']);

        return response()->json([
            'message' => 'تم أرشفة الموظف بنجاح'
        ]);
    }

    public function index(Request $request)
    {
        // Get list of companies with their employee count (excluding archived)
        $companies = Employee::whereNull('archive')
            ->select('company', \DB::raw('count(*) as count'))
            ->groupBy('company')
            ->get();

        // Get all employees not archived (with optional filter)
        if ($request->has('company') && $request->company != '') {
            $employees = Employee::whereNull('archive')
                ->where('company', $request->company)
                ->get();
        } else {
            $employees = Employee::whereNull('archive')->get();
        }

        return view('admin.employees.allEmployees', compact('employees', 'companies'));
    }

    public function archiveEmployee()
    {
        // عرض الموظفين المؤرشفين
        $employees = Employee::where('archive', 'archived')->get();
        return view('admin.employees.archiveEmployee', compact('employees'));
    }

    // ✅ FIXED: Add this missing method
    public function addEmployee()
    {
        return view('admin.employees.addEmployees'); 
    }

    // ✅ FIXED: Store employee with directory creation
    public function store(Request $request)
    {
        \Log::info('🟢 EMPLOYEE STORE STARTED');

        // تحقق من البيانات المدخلة
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'identity_number' => 'required|unique:employees',
            'joining_date' => 'required|date',
            'job_title' => 'required|string|max:255',
            'archive' => 'nullable',
            'phone' => 'nullable',
            'company' => 'nullable',
            'files.*' => 'nullable|file|mimes:jpg,png,pdf,docx,zip',
        ], [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'حقل الاسم يجب أن يكون نصًا.',
            'name.max' => 'حقل الاسم يجب ألا يتجاوز 255 حرفًا.',
            'nationality.required' => 'حقل الجنسية مطلوب.',
            'nationality.string' => 'حقل الجنسية يجب أن يكون نصًا.',
            'nationality.max' => 'حقل الجنسية يجب ألا يتجاوز 255 حرفًا.',
            'identity_number.required' => 'رقم الهوية مطلوب.',
            'identity_number.unique' => 'رقم الهوية مسجل مسبقًا.',
            'joining_date.required' => 'تاريخ الالتحاق مطلوب.',
            'joining_date.date' => 'تاريخ الالتحاق يجب أن يكون تاريخًا صحيحًا.',
            'job_title.required' => 'المسمى الوظيفي مطلوب.',
            'job_title.string' => 'المسمى الوظيفي يجب أن يكون نصًا.',
            'job_title.max' => 'المسمى الوظيفي يجب ألا يتجاوز 255 حرفًا.',
            'files.*.file' => 'الملف يجب أن يكون من نوع ملف.',
            'files.*.mimes' => 'الملف يجب أن يكون من نوع jpg, png, pdf, docx, أو zip.',
        ]);

        DB::beginTransaction();

        try {
            \Log::info('🟢 Creating employee record...');

            // حفظ بيانات الموظف
            $employee = Employee::create([
                'name' => $validatedData['name'],
                'nationality' => $validatedData['nationality'],
                'identity_number' => $validatedData['identity_number'],
                'joining_date' => $validatedData['joining_date'],
                'job_title' => $validatedData['job_title'],
                'archive' => $validatedData['archive'] ?? null,
                'company' => $validatedData['company'] ?? null,
                'phone' => $validatedData['phone'] ?? null,
                'user_name' => auth()->user()->name,
            ]);

            \Log::info("🟢 Employee created - ID: {$employee->id}");

            // ✅ FIXED: Ensure directory exists
            $destinationPath = public_path('storage/employee_files');
            
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
                \Log::info('🟢 Directory created: ' . $destinationPath);
            }

            // حفظ الملفات الخاصة بالموظف
            if ($request->hasFile('files')) {
                $files = $request->file('files');
                \Log::info("🟢 Files received: " . count($files));

                foreach ($files as $file) {
                    // Safe filename
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $safeFilename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $originalName);
                    $fileName = time() . '_' . uniqid() . '_' . $safeFilename . '.' . $extension;

                    \Log::info("🟢 Processing file: " . $fileName);

                    // Manual file move
                    $file->move($destinationPath, $fileName);

                    // Save to database
                    EmployeeFile::create([
                        'file' => 'employee_files/' . $fileName, // ✅ CONSISTENT PATH
                        'employee_id' => $employee->id,
                    ]);
                    
                    \Log::info("✅ File uploaded: " . $fileName);
                }
            }

            DB::commit();
            \Log::info('🎉 EMPLOYEE STORE COMPLETED SUCCESSFULLY');

            toastr()->success('تم حفظ بيانات الموظف بنجاح');
            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('💥 EMPLOYEE STORE ERROR: ' . $e->getMessage());
            toastr()->error('حدث خطأ: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function update(Request $request, Employee $employee)
    {
        \Log::info('🟢 EMPLOYEE UPDATE STARTED - ID: ' . $employee->id);

        // تحقق من البيانات المدخلة
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'identity_number' => [
                'required',
                Rule::unique('employees')->ignore($employee->id),
            ],
            'joining_date' => 'required|date',
            'job_title' => 'required|string|max:255',
            'archive' => 'nullable',
            'company' => 'nullable',
            'phone' => 'nullable',
            'files.*' => 'nullable|file|mimes:jpg,png,pdf,docx,zip',
        ], [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.string' => 'حقل الاسم يجب أن يكون نصًا.',
            'name.max' => 'حقل الاسم يجب ألا يتجاوز 255 حرفًا.',
            'nationality.required' => 'حقل الجنسية مطلوب.',
            'nationality.string' => 'حقل الجنسية يجب أن يكون نصًا.',
            'nationality.max' => 'حقل الجنسية يجب ألا يتجاوز 255 حرفًا.',
            'identity_number.required' => 'رقم الهوية مطلوب.',
            'identity_number.unique' => 'رقم الهوية مسجل مسبقًا.',
            'joining_date.required' => 'تاريخ الالتحاق مطلوب.',
            'joining_date.date' => 'تاريخ الالتحاق يجب أن يكون تاريخًا صحيحًا.',
            'job_title.required' => 'المسمى الوظيفي مطلوب.',
            'job_title.string' => 'المسمى الوظيفي يجب أن يكون نصًا.',
            'job_title.max' => 'المسمى الوظيفي يجب ألا يتجاوز 255 حرفًا.',
            'files.*.file' => 'الملف يجب أن يكون من نوع ملف.',
            'files.*.mimes' => 'الملف يجب أن يكون من نوع jpg, png, pdf, docx, أو zip.',
        ]);

        DB::beginTransaction();

        try {
            // تحديث بيانات الموظف
            $employee->update($validatedData);
            \Log::info("✅ Employee data updated - ID: {$employee->id}");

            // ✅ FIXED: Ensure directory exists
            $destinationPath = public_path('storage/employee_files');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            // حفظ الملفات الجديدة
            if ($request->hasFile('files')) {
                $files = $request->file('files');
                \Log::info("🟢 New files for update: " . count($files));

                foreach ($files as $file) {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $safeFilename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $originalName);
                    $fileName = time() . '_' . uniqid() . '_' . $safeFilename . '.' . $extension;

                    $file->move($destinationPath, $fileName);

                    EmployeeFile::create([
                        'file' => 'employee_files/' . $fileName, // ✅ CONSISTENT PATH
                        'employee_id' => $employee->id,
                    ]);
                }
            }

            DB::commit();
            \Log::info('🎉 EMPLOYEE UPDATE COMPLETED SUCCESSFULLY');

            toastr()->success('تم تعديل بيانات الموظف بنجاح');
            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('💥 EMPLOYEE UPDATE ERROR: ' . $e->getMessage());
            toastr()->error('حدث خطأ: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function archive($id)
    {
        // أرشفة الموظف
        $employee = Employee::findOrFail($id);
        $employee->archive = 'archived';
        $employee->save();

        toastr()->success('تم أرشفة الموظف بنجاح');
        return redirect()->back();
    }

    public function unarchiveEmployee($id)
    {
        // إلغاء أرشفة الموظف
        $employee = Employee::findOrFail($id);
        $employee->archive = null;
        $employee->save();

        toastr()->success('تم إلغاء أرشفة الموظف بنجاح');
        return redirect()->back();
    }

    public function showAllEmployeefiles($id)
    {
        $files = EmployeeFile::where('employee_id', $id)->get();
        $employee = Employee::findOrFail($id);
        return view('/admin/employees/employeeFiles', compact('files', 'employee'));
    }

    public function deleteEmployeeFile($id)
    {
        try {
            $file = EmployeeFile::findOrFail($id);
            \Log::info("🟢 Deleting employee file - ID: {$id}");

            if ($file->file) {
                $filePath = public_path('storage/' . $file->file);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                    \Log::info("✅ File deleted from storage: " . $file->file);
                }
            }

            $file->delete();
            \Log::info("✅ File record deleted from database");

            toastr()->success('تم حذف الملف بنجاح');

        } catch (\Exception $e) {
            \Log::error('💥 DELETE EMPLOYEE FILE ERROR: ' . $e->getMessage());
            toastr()->error('حدث خطأ أثناء حذف الملف');
        }

        return redirect()->back();
    }

    // ✅ FIXED: Store employee file with consistent path
    public function storeEmployeeFile(Request $request, $employeeId)
    {
        \Log::info("🟢 STORE EMPLOYEE FILE - Employee ID: {$employeeId}");

        $request->validate([
            'files' => 'required|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240',
        ]);

        DB::beginTransaction();

        try {
            // ✅ FIXED: Ensure directory exists
            $destinationPath = public_path('storage/employee_files');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true, true);
            }

            if ($request->hasFile('files')) {
                $files = $request->file('files');
                \Log::info("🟢 Files to add: " . count($files));

                foreach ($files as $file) {
                    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $safeFilename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $originalName);
                    $fileName = time() . '_' . uniqid() . '_' . $safeFilename . '.' . $extension;

                    $file->move($destinationPath, $fileName);

                    // ✅ FIXED: Consistent path - 'employee_files/' + filename
                    EmployeeFile::create([
                        'file' => 'employee_files/' . $fileName, // ✅ FIXED PATH
                        'employee_id' => $employeeId,
                    ]);
                    
                    \Log::info("✅ Additional file uploaded: " . $fileName);
                }
            }

            DB::commit();
            toastr()->success('تم اضافة الملفات بنجاح');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('💥 STORE EMPLOYEE FILE ERROR: ' . $e->getMessage());
            toastr()->error('حدث خطأ: ' . $e->getMessage());
        }

        return redirect()->back();
    }

    public function updateExpiry(Request $request, $id)
    {
        $request->validate([
            'field' => 'required|in:moqem_expire_at,mokhalsa_expire_at,cart_expire_at',
            'value' => 'required|date',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->{$request->field} = $request->value;
        $employee->save();

        return back()->with('success', 'تم تحديث التاريخ بنجاح');
    }

    public function report(Request $request)
    {
        $employees = Employee::where('company', $request->company)->get();
        $company = $request->company;
        return view('admin.employees.report', compact('employees', 'company'));
    }
}
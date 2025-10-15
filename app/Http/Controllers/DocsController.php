<?php

namespace App\Http\Controllers;

use App\Models\DocsFile;
use App\Models\DocsType;
use App\Models\DocsUpdate;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DocsController extends Controller
{
    public function index()
    {
        return view('/admin/docs/docs');
    }

    // Docs types
    public function docsType()
    {
        $types = DocsType::get();
        return view('/admin/docs/docsType', compact('types'));   
    }

    public function storeDocsType(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:docs_types,name',
        ], [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.unique' => 'هذا الاسم مستخدم بالفعل، يرجى اختيار اسم آخر.',
        ]);
    
        $type = DocsType::create([
            'name' => $validatedData['name'],
            'user_name' => auth()->user()->name
        ]);
    
        if ($type) {
            toastr()->success('تم حفظ البيانات بنجاح');
        } else {
            toastr()->error('يوجد مشكلة، حاول مرة أخرى.');
        }
    
        return back();
    }

    public function updateDocsType(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:docs_types,name,' . $id,
        ], [
            'name.required' => 'حقل الاسم مطلوب.',
            'name.unique' => 'هذا النوع مستخدم بالفعل.',
        ]);
    
        $type = DocsType::findOrFail($id);
        $type->update([
            'name' => $validatedData['name'],
        ]);
    
        toastr()->success('تم تحديث البيانات بنجاح');
        return back();
    }

    public function deleteDocsType($id)
    {
        $type = DocsType::findOrFail($id);
        $type->delete();
    
        toastr()->success('تم حذف البيانات بنجاح');
        return back();
    }

    // Add docs
    public function addDocs()
    {
        $types = DocsType::get();
        return view('/admin/docs/addDocs', compact('types'));   
    }

    // ✅ FIXED: Redirection removed - stays on same page after success
    public function storeNewDocs(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'expire_at' => 'required|date',
            'type_id' => 'required|exists:docs_types,id',
            'files' => 'required|array|min:1',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:10240'
        ], [
            'files.required' => 'يرجى اختيار ملف واحد على الأقل.',
            'files.min' => 'يرجى اختيار ملف واحد على الأقل.',
        ]);

        DB::beginTransaction();

        try {
            // Create document record
            $document = Document::create([
                'name' => $request->name,
                'expire_at' => $request->expire_at,
                'type_id' => $request->type_id,
                'user_name' => auth()->user()->name
            ]);

            // Ensure directory exists
            $destinationPath = public_path('storage/documents');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            // Upload files manually like old project
            $uploadedFiles = 0;
            foreach ($request->file('files') as $file) {
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                
                // Manual file move like old project
                $file->move($destinationPath, $fileName);

                // Save to database
                DocsFile::create([
                    'file' => 'documents/' . $fileName,
                    'docs_id' => $document->id,
                    'user_name' => auth()->user()->name
                ]);
                
                $uploadedFiles++;
            }

            DB::commit();
            
            if ($uploadedFiles > 0) {
                toastr()->success('تم حفظ البيانات والملفات بنجاح');
            } else {
                toastr()->warning('تم حفظ البيانات ولكن لم يتم رفع أي ملف');
            }

            // ✅ FIXED: Redirect removed - stays on same page
            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in storeNewDocs: ' . $e->getMessage());
            toastr()->error('حدث خطأ: ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function showAllDocs(Request $request)
    {
        $query = Document::whereNull('archive');

        // Filter by status
        if ($request->has('status')) {
            $now = now();
            $after15Days = $now->copy()->addDays(15);

            if ($request->status == 'expired') {
                $query->where('expire_at', '<', $now);
            } elseif ($request->status == 'active') {
                $query->where('expire_at', '>', $after15Days);
            } elseif ($request->status == 'expiring') {
                $query->whereBetween('expire_at', [$now, $after15Days]);
            }
        }

        // Filter by type
        if ($request->has('type_id') && $request->type_id != '') {
            $query->where('type_id', $request->type_id);
        }

        $docs = $query->get();

        // Statistics
        $totalCount = Document::whereNull('archive')->count();
        $activeCount = Document::whereDate('expire_at', '>', now()->addDays(15))->whereNull('archive')->count();
        $expiredCount = Document::whereDate('expire_at', '<', now())->whereNull('archive')->count();
        $expiringCount = Document::whereBetween('expire_at', [now(), now()->addDays(15)])->whereNull('archive')->count();

        $types = DocsType::get();

        return view('/admin/docs/allDocs', compact(
            'docs',
            'types',
            'totalCount',
            'activeCount',
            'expiredCount',
            'expiringCount'
        ));
    }

    public function showAllArchiveDocs()
    {
        $docs = Document::where('archive','archived')->get();
        return view('/admin/docs/allArchiveDocs', compact('docs'));   
    }

    public function showAllfiles($id)
    {
        $files = DocsFile::where('docs_id',$id)->get();
        $document = Document::findOrFail($id);
        return view('/admin/docs/docsFiles', compact('files','document'));   
    }

    public function showAllDocsUpdates($id)
    {
        $updates = DocsUpdate::where('docs_id',$id)->get();
        $document = Document::findOrFail($id);
        return view('/admin/docs/docsUpdates', compact('updates','document'));   
    }

    public function archiveDocs($id)
    {
        $docs = Document::findOrFail($id);
        $docs->archive = 'archived';
        $docs->save();
        toastr()->success('تم ارشيف المستند بنجاح');
        return redirect()->back();
    }

    public function unarchiveDocs($id)
    {
        $docs = Document::findOrFail($id);
        $docs->archive = null;
        $docs->save();
        toastr()->success('تم إلغاء أرشفة المستند بنجاح');
        return redirect()->back();
    }

    public function updateDocs($id, Request $request)
    {
        $docs = Document::findOrFail($id);
        $docs->name = $request->input('name');
        $docs->expire_at = $request->input('expire_at');
        $docs->save();

        DocsUpdate::create([
            'docs_id' => $docs->id,
            'user_name' => auth()->user()->name
        ]);

        toastr()->success('تم تحديث المستند بنجاح');
        return redirect()->back();
    }

    // ✅ PURANI PROJECT STYLE: Add files manually
    public function storeDocsFile(Request $request, $documentId)
    {
        $request->validate([
            'files' => 'nullable|array',
            'files.*' => 'file|mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:10240', 
            'text' => 'nullable|string'
        ]);

        // Check if at least one file or text is provided
        if (!$request->hasFile('files') && !$request->filled('text')) {
            toastr()->error('يرجى إدخال ملف أو نص');
            return redirect()->back();
        }

        DB::beginTransaction();

        try {
            // Ensure directory exists
            $destinationPath = public_path('storage/documents');
            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $uploadedFiles = 0;

            // Upload files manually
            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $file) {
                    $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                    
                    // Manual file move
                    $file->move($destinationPath, $fileName);

                    DocsFile::create([
                        'file' => 'documents/' . $fileName,
                        'docs_id' => $documentId,
                        'text' => $request->text ?? null,
                        'user_name' => auth()->user()->name
                    ]);
                    $uploadedFiles++;
                }
            } 
            // If no files but text provided, save text only
            elseif ($request->filled('text')) {
                DocsFile::create([
                    'file' => null,
                    'docs_id' => $documentId,
                    'text' => $request->text,
                    'user_name' => auth()->user()->name
                ]);
                $uploadedFiles = 1;
            }

            DB::commit();
            
            if ($uploadedFiles > 0) {
                toastr()->success('تم اضافة البيانات بنجاح');
            } else {
                toastr()->warning('لم يتم إضافة أي بيانات');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error in storeDocsFile: ' . $e->getMessage());
            toastr()->error('حدث خطأ: ' . $e->getMessage());
        }

        return redirect()->back();
    }

    // ✅ PURANI PROJECT STYLE: Delete file manually
    public function deleteDocsFile($id)
    {
        try {
            $file = DocsFile::findOrFail($id);

            // Delete from storage if file exists
            if ($file->file) {
                $filePath = public_path('storage/' . $file->file);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }

            $file->delete();
            toastr()->success('تم حذف الملف بنجاح');

        } catch (\Exception $e) {
            Log::error('Error in deleteDocsFile: ' . $e->getMessage());
            toastr()->error('حدث خطأ أثناء حذف الملف');
        }

        return redirect()->back();
    }

    // Download file
    public function downloadFile($id)
    {
        try {
            $file = DocsFile::findOrFail($id);
            
            if ($file->file && File::exists(public_path('storage/' . $file->file))) {
                return response()->download(public_path('storage/' . $file->file));
            } else {
                toastr()->error('الملف غير موجود');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Log::error('Error in downloadFile: ' . $e->getMessage());
            toastr()->error('حدث خطأ أثناء تحميل الملف');
            return redirect()->back();
        }
    }

    // View file
    public function viewFile($id)
    {
        try {
            $file = DocsFile::findOrFail($id);
            
            if ($file->file && File::exists(public_path('storage/' . $file->file))) {
                $filePath = public_path('storage/' . $file->file);
                return response()->file($filePath);
            } else {
                toastr()->error('الملف غير موجود');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Log::error('Error in viewFile: ' . $e->getMessage());
            toastr()->error('حدث خطأ أثناء عرض الملف');
            return redirect()->back();
        }
    }
}
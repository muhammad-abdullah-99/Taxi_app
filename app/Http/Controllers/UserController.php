<?php 

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Manually active users filter karein
        $users = User::where('status', 'active')
                    ->where('email', '!=', 'adminadmin4@yahoo.com')
                    ->get();
        return view('/admin/users', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|unique:users',
            'password' => 'required|string',
            'role' => 'required|string|in:مسؤول,موظف,تحديث البيانات',
        ], [
            'name.required' => 'حقل الاسم مطلوب.',
            'email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'email.email' => 'يجب أن يكون البريد الإلكتروني صالحًا.',
            'email.unique' => 'البريد الإلكتروني مستخدم بالفعل.',
            'phone.required' => 'حقل رقم الهاتف مطلوب.',
            'phone.unique' => 'رقم الهاتف مستخدم بالفعل.',
            'password.required' => 'حقل كلمة المرور مطلوب.',
            'role.required' => 'حقل الدور مطلوب.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => bcrypt($request->password),
            'status' => 'active',
        ]);

        toastr()->success('تمت الاضافة بنجاح ');
        return back();
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|unique:users,phone,' . $id,
            'password' => 'nullable|string',
            'role' => 'required|string|in:مسؤول,موظف,تحديث البيانات', 
        ]);

        // Admin protection
        if($user->email == 'adminadmin4@yahoo.com' && $request->role != 'مسؤول') {
            toastr()->error('لا يمكن تغيير دور المسؤول الرئيسي');
            return back();
        }
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        toastr()->success('تم تحديث البيانات ');
        return back();
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Admin protection
        if($user->email == 'adminadmin4@yahoo.com') {
            toastr()->error('لا يمكن حذف المسؤول الرئيسي');
            return back();
        }

        // Self-delete protection
        if($user->id == auth()->id()) {
            toastr()->error('لا يمكنك حذف حسابك الخاص');
            return back();
        }

        // Status inactive karo (soft delete)
        $user->status = 'inactive';
        $user->save();
        
        \Log::info('User deactivated', [
            'user_id' => $user->id,
            'by_user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'timestamp' => now()
        ]);
        
        toastr()->success('تم حذف المستخدم بنجاح');
        return back();
    }
}
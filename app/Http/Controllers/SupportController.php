<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class SupportController extends Controller
{
    public function create(Request $request ,$app_user)
{
    try {
        DB::beginTransaction();

        // رفع الصورة إذا كانت موجودة
        $imagePath = null;
        if ($request->hasFile('image')) {
            $destinationPath = public_path('storage/supports/');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move($destinationPath, $fileName);
            $imagePath = 'supports/' . $fileName;
        }

        // إنشاء الدعم
        $support = Support::create([
            'app_user_id' => $app_user,
            'image' => $imagePath,
            'text' => $request->text,
            'status' => 'Pending',
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Support created successfully.',
            'data' => $support,
        ], 201);
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Support Creation Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Support creation failed.',
            'error' => config('app.debug') ? $e->getMessage() : null,
        ], 500);
    }
}


public function get($app_user)
{
    try {
        $supports = Support::where('app_user_id', $app_user)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Support tickets fetched successfully.',
            'data' => $supports,
        ], 200);
    } catch (\Exception $e) {
        Log::error('Support Fetch Error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Failed to fetch support tickets.',
            'error' => config('app.debug') ? $e->getMessage() : null,
        ], 500);
    }
}

//
 public function index()
    {
        return view('admin.transport.support.support');
    }

     public function ticketsByUserType($user_type)
    {

        return view('admin.transport.support.supportType',compact('user_type'));
    }

public function waitTickets($user_type)
{
        $tickets = Support::where('status', 'Pending')
        ->with('appUser')
        ->whereHas('appUser', function ($query) use ($user_type) {
            $query->where('user_type', $user_type); // Direct string compare
        })->get();

    return view('admin.transport.support.waitTickets', compact('tickets'));
}


public function updateStatusWaitTickets($ticketId)
{
    try {
        $ticket = Support::findOrFail($ticketId);
        $ticket->status = 'InProgress'; // الحالة المستلمة مثلاً
        $ticket->user_id = auth()->id(); // المستخدم اللي استلم التذكرة
        $ticket->save();

        return redirect()->back()->with('success', 'تم استلام التذكرة بنجاح.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث حالة التذكرة.');
    }
}




public function processTickets($user_type)
{
    $tickets = Support::where('status',  'InProgress')
        ->with('appUser')
        ->whereHas('appUser', function ($query) use ($user_type) {
            $query->where('user_type', $user_type); // Direct string compare
        })->get();

    return view('admin.transport.support.processTickets', compact('tickets'));
}


//
public function updateStatusCloseTickets($ticketId)
{
    try {
        $ticket = Support::findOrFail($ticketId);
        $ticket->status = 2; // الحالة المستلمة مثلاً
        $ticket->user_id = auth()->id(); // المستخدم اللي استلم التذكرة
        $ticket->save();

        return redirect()->back()->with('success', 'تم استلام التذكرة بنجاح.');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث حالة التذكرة.');
    }
}

//To Display Existing Close Tickets
public function closeTickets($user_type)
{
    $tickets = Support::where('status', 'TicketClosed')
        ->with('appUser')
        ->whereHas('appUser', function ($query) use ($user_type) {
            $query->where('user_type', $user_type); // Direct string compare
        })->get();

    return view('admin.transport.support.closeTickets', compact('tickets'));
}


//To Close The Tickets Directly
public function closeTicketDirect($ticketId)
{
    try {
        $ticket = Support::findOrFail($ticketId);
        $ticket->status = 'TicketClosed';
        
        // ✅ AGAR auth()->id() NULL HAI, TOH EXISTING user_id KO PRESERVE KARO
        if (auth()->check() && auth()->id()) {
            $ticket->user_id = auth()->id();
        }
        // Agar auth null hai, toh existing user_id ko change mat karo
        // $ticket->user_id = $ticket->user_id (no change)
        
        $ticket->save();

        return redirect()->back()->with('success', 'تم إغلاق التذكرة بنجاح');

    } catch (\Exception $e) {
        Log::error('Close Ticket Error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'فشل في إغلاق التذكرة');
    }
}

public function reopenTicket($ticketId)
{
    try {
        $ticket = Support::findOrFail($ticketId);
        $ticket->status = 'InProgress'; // Back to process status
        $ticket->user_id = auth()->id();
        $ticket->save();

        return redirect()->back()->with('success', 'تم إعادة فتح التذكرة بنجاح');

    } catch (\Exception $e) {
        Log::error('Reopen Ticket Error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'فشل في إعادة فتح التذكرة');
    }
}

// public function sendOtp(Request $request)
// {
//     $ticket = Support::findOrFail($request->ticket_id);
//     $otp = mt_rand(1000, 9999);
//     $ticket->otp = $otp;
//     $ticket->otp_expires_at = now()->addMinutes(10);
//     $ticket->save();

//     // إرسال الرسالة (Taqnyat أو log للتجربة)
//     Log::info("OTP to {$ticket->user->phone}: $otp");

//     return response()->json(['success' => true]);
// }

// public function verifyOtp(Request $request)
// {
//     $ticket = Support::findOrFail($request->ticket_id);

//     if ($ticket->otp != $request->otp || now()->gt($ticket->otp_expires_at)) {
//         return response()->json(['success' => false, 'message' => 'رمز التحقق غير صالح أو منتهي']);
//     }

//     $ticket->status = 2;
//     $ticket->user_id = auth()->id();
//     $ticket->save();

//     return response()->json(['success' => true]);
// }



}

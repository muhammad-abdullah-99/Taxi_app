<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Models\Travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    // public function travels()
    // {
    //     $travels = Travel::with('appUser')->get();
    //     return view('/admin/transport/travels/travels', compact('travels'));
    // }
    public function travels(Request $request)
    {
        $status = $request->get('status'); // مثلاً: انتظار، جارية، مكتملة

        $query = Travel::with('appUser')->whereHas('appUser');

        if ($status) {
            $query->where('status', $status);
        }

        $travels = $query->get();

        return view('admin.transport.travel.travel', compact('travels', 'status'));
    }

    public function allUserTravell($user, $status)
    {
        $travels = Travel::where('user_id', $user)->where('status', $status)->get();
        return response()->json([
            'success' => true,
            'message' => 'User Travel',
            'data' => [
                'travels' => $travels->load('client'),
            ]
        ], 201);
    }
    public function updateTravellStatus(Request $request, $id)
    {
        // تحقق من وجود السفر
        $travel = Travel::find($id);

        if (!$travel) {
            return response()->json([
                'success' => false,
                'message' => 'Travel not found',
            ], 404);
        }

        // تحقق من وجود الحالة في الطلب
        if (!$request->has('status')) {
            return response()->json([
                'success' => false,
                'message' => 'Status is required',
            ], 400);
        }

        // تحديث الحالة
        $travel->status = $request->status;
        $travel->save();

        return response()->json([
            'success' => true,
            'message' => 'Travel status updated successfully',
            'data' => [
                'travel' => $travel->load('client'),
            ]
        ], 200);
    }
}

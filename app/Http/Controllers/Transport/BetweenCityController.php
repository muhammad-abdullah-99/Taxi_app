<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Models\BetweenCity;
use Illuminate\Http\Request;

class BetweenCityController extends Controller
{
    public function index()
    {
        $between_cities = BetweenCity::all();
        $transportTypes = BetweenCity::TRANSPORT_TYPES;
        return view('admin.transport.user.betweenCity', compact('between_cities', 'transportTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'city_one' => 'required|string|max:255',
            'city_two' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'office_commission' => 'required|numeric',
            'passengers' => 'required|integer',
            'car_type' => 'required|string',
            'transport_types' => 'required|array',
        ]);

        // ✅ CITY NAMES CLEAN KARO
        $cleanCityOne = rtrim(trim($request->city_one), '/');
        $cleanCityTwo = rtrim(trim($request->city_two), '/');

        // Transport types ko comma separated string mein convert karein
        $transportTypesString = implode(',', $request->transport_types);

        BetweenCity::create([
            'city_one' => $cleanCityOne,
            'city_two' => $cleanCityTwo,
            'amount' => $request->amount,
            'office_commission' => $request->office_commission,
            'passengers' => $request->passengers,
            'car_type' => $request->car_type,
            'code' => $request->code,
            'transport_types' => $transportTypesString,
        ]);

        return redirect()->back()->with('success', 'تمت إضافة المسافة بنجاح');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'city_one' => 'required|string|max:255',
            'city_two' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'office_commission' => 'required|numeric',
            'passengers' => 'required|integer',
            'car_type' => 'required|string',
            'transport_types' => 'required|array',
        ]);

        // ✅ CITY NAMES CLEAN KARO
        $cleanCityOne = rtrim(trim($request->city_one), '/');
        $cleanCityTwo = rtrim(trim($request->city_two), '/');

        // Transport types ko comma separated string mein convert karein
        $transportTypesString = implode(',', $request->transport_types);

        $city = BetweenCity::findOrFail($id);
        $city->update([
            'city_one' => $cleanCityOne,
            'city_two' => $cleanCityTwo,
            'amount' => $request->amount,
            'passengers' => $request->passengers,
            'office_commission' => $request->office_commission,
            'car_type' => $request->car_type,
            'code' => $request->code,
            'transport_types' => $transportTypesString,
        ]);

        return redirect()->back()->with('success', 'تم تعديل البيانات بنجاح');
    }

    public function showBetweenCity()
    {
        $cities = BetweenCity::all();

        return response()->json([
            'message' => 'show all cities',
            'cities' => $cities,
        ]);
    }
}
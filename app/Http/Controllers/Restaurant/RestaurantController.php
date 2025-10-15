<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\FoodBox;
use App\Models\FoodBoxStation;
use App\Models\FoodPrice;
use App\Models\FoodType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    public function store(Request $request)
    {
        // التحقق من صحة البيانات لو حابب
        $request->validate([
            'type' => 'nullable|string',
            'name' => 'nullable|string',
            'prices' => 'nullable|array',
            'prices.*.size' => 'nullable|string',
            'prices.*.price' => 'nullable|numeric',
        ]);

        // إنشاء نوع الطعام
        $foodType = FoodType::create([
            'type' => $request->type,
            'name' => $request->name,
        ]);

        // إنشاء الأسعار المرتبطة به
        if ($request->has('prices')) {
            foreach ($request->prices as $priceData) {
                FoodPrice::create([
                    'food_type_id' => $foodType->id,
                    'size' => $priceData['size'] ?? null,
                    'price' => $priceData['price'] ?? null,
                ]);
            }
        }
        return back()->with('success', 'تمت الإضافة بنجاح');
    }
    public function addNewFoodType()
    {
        return view('/admin/restaurant/addNewFoodType');
    }


    public function breakfast()
    {
        $foods = FoodType::with('food_price')->where('type', 'افطار')->get();
        $box = FoodBoxStation::where('food_type', 'افطار')->sum('amount');
        return view('/admin/restaurant/breakfast', compact('foods', 'box'));
    }

    public function lunch()
    {
        $foods = FoodType::with('food_price')->where('type', 'غداء')->get();
        $box = FoodBoxStation::where('food_type', 'غداء')->sum('amount');
        return view('/admin/restaurant/lunch', compact('foods', 'box'));
    }

    public function dinner()
    {
        $foods = FoodType::with('food_price')->where('type', 'عشاء')->get();
        $box = FoodBoxStation::where('food_type', 'عشاء')->sum('amount');
        return view('/admin/restaurant/dinner', compact('foods', 'box'));
    }
    //
    public function storeBoxStation(Request $request)
    {
        $request->validate([
            'food_id' => 'required',
            'size' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        $food = FoodType::with(['food_price' => function ($q) use ($request) {
            $q->where('size', $request->size);
        }])->findOrFail($request->food_id);

        $price = $food->food_price->first();

        if (!$price) {
            return back()->with('error', 'السعر غير موجود لهذا الحجم.');
        }

        $total = $price->price * $request->quantity;

        FoodBoxStation::create([
            'food_type' => $food->type,
            'amount' => $total,
        ]);

        return back()->with('success', 'تمت إضافة الطلب بنجاح.');
    }

    public function confirmBoxAmount(Request $request)
    {
        $request->validate([
            'food_type' => 'required|string',
            'total_amount' => 'required|numeric',
        ]);

        FoodBox::create([
            'amount' => $request->total_amount,
        ]);

        FoodBoxStation::where('food_type', $request->food_type)->delete();

        return back()->with('success', 'تم التأكيد وتصنيف المبلغ بنجاح.');
    }

    public function cancelBox(Request $request)
    {
        $request->validate([
            'food_type' => 'required|string',
        ]);

        FoodBoxStation::where('food_type', $request->food_type)->delete();

        return back()->with('error', 'تم الالغاء.');
    }




    //
    public function showDailyTotals()
    {
        // جلب مجموع المبالغ لكل يوم مع التاريخ
        $dailyTotals = FoodBox::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(amount) as total_amount')
        )
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();

        return view('/admin/restaurant/box', compact('dailyTotals'));
    }
    public function updatePrices(Request $request, FoodType $food)
    {
        foreach ($request->prices as $priceId => $newPrice) {
            $price = \App\Models\FoodPrice::find($priceId);
            if ($price && $price->food_type_id == $food->id) {
                $price->update(['price' => $newPrice]);
            }
        }
        return back()->with('success', 'تم تحديث الأسعار بنجاح.');
    }



    //


    public function clearAllData()
    {
        try {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            DB::table('food_boxes')->truncate();

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return response()->json([
                'status' => 200,
                'message' => 'تم مسح كل البيانات من جدول food_boxes بنجاح.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'حدث خطأ أثناء المسح: ' . $e->getMessage()
            ]);
        }
    }
}

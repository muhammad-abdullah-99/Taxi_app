<?php

namespace App\Http\Controllers\Transport;

use App\Http\Controllers\Controller;
use App\Models\BetweenCity;
use Illuminate\Http\Request;

class BetweenCityController extends Controller
{
    // ✅ COMPANY TYPES (Single Selection)
    const COMPANY_TYPES = [
    'privateCarsResidents' => [
        'name_ar' => 'سيارات خاصة للمقيمين',
        'name_en' => 'Private Cars Residents',
        'max_passengers' => 8,
        'transport_type' => 'private_car'  // ✅ NEW
    ],
    'privateCarsCitizens' => [
        'name_ar' => 'سيارات خاصة للمواطنين',
        'name_en' => 'Private Cars Citizens',
        'max_passengers' => 8,
        'transport_type' => 'private_car'  // ✅ NEW
    ],
    'specializedTransport' => [
        'name_ar' => 'النقل المتخصص',
        'name_en' => 'Specialized Transport',
        'max_passengers' => 20,
        'transport_type' => 'bus'  // ✅ NEW
    ],
    'privateFare' => [
        'name_ar' => 'الأجرة الخاصة',
        'name_en' => 'Private Fare',
        'max_passengers' => 8,
        'transport_type' => 'private_car'  // ✅ NEW
    ],
    'publicFare' => [
        'name_ar' => 'الأجرة العامة',
        'name_en' => 'Public Fare',
        'max_passengers' => 8,
        'transport_type' => 'limousine_taxi'  // ✅ NEW
    ],
    ];

    public function index()
    {
        $between_cities = BetweenCity::all();
        $transportTypes = BetweenCity::TRANSPORT_TYPES;
        $companyTypes = self::COMPANY_TYPES;
        
        return view('admin.transport.user.betweenCity', compact('between_cities', 'transportTypes', 'companyTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'city_one' => 'required|string|max:255',
            'city_two' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'office_commission' => 'required|numeric',
            'passengers' => 'required|integer|min:1',
            'transport_types' => 'required|array',
            'company_type' => 'required|string', // ← Single selection
        ]);

        // ✅ FIX: Ensure company_type is stored as KEY (not Arabic name)
        $companyType = $request->company_type;
        
        // ✅ If Arabic name received, convert to key
        $companyTypeMapping = [
            'سيارات خاصة للمقيمين' => 'privateCarsResidents',
            'سيارات خاصة للمواطنين' => 'privateCarsCitizens',
            'النقل المتخصص' => 'specializedTransport',
            'الأجرة الخاصة' => 'privateFare',
            'الأجرة العامة' => 'publicFare',
        ];
        
        // Convert if Arabic name provided
        if (isset($companyTypeMapping[$companyType])) {
            $companyType = $companyTypeMapping[$companyType];
        }
        
        // ✅ Validate passenger count based on company type
        $maxPassengers = $this->getMaxPassengers($companyType);
        if ($request->passengers > $maxPassengers) {
            return redirect()->back()->withErrors([
                'passengers' => "الحد الأقصى لعدد الركاب هو {$maxPassengers} لهذا النوع"
            ])->withInput();
        }

        $cleanCityOne = rtrim(trim($request->city_one), '/');
        $cleanCityTwo = rtrim(trim($request->city_two), '/');

        $transportTypesString = implode(',', $request->transport_types);

        BetweenCity::create([
            'city_one' => $cleanCityOne,
            'city_two' => $cleanCityTwo,
            'amount' => $request->amount,
            'office_commission' => $request->office_commission,
            'passengers' => $request->passengers,
            'car_type' => $request->car_type ?: 'Auto',
            'code' => $request->code,
            'transport_types' => $transportTypesString,
            'company_type' => $request->company_type, // ← Single value
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
            'passengers' => 'required|integer|min:1',
            'transport_types' => 'required|array',
            'company_type' => 'required|string', // ← Single selection
        ]);

        // ✅ FIX: Ensure company_type is stored as KEY (not Arabic name)
            $companyType = $request->company_type;
            
            // ✅ If Arabic name received, convert to key
            $companyTypeMapping = [
                'سيارات خاصة للمقيمين' => 'privateCarsResidents',
                'سيارات خاصة للمواطنين' => 'privateCarsCitizens',
                'النقل المتخصص' => 'specializedTransport',
                'الأجرة الخاصة' => 'privateFare',
                'الأجرة العامة' => 'publicFare',
            ];
            
            // Convert if Arabic name provided
            if (isset($companyTypeMapping[$companyType])) {
                $companyType = $companyTypeMapping[$companyType];
            }        

        // ✅ Validate passenger count based on company type
        $maxPassengers = $this->getMaxPassengers($request->company_type);
        if ($request->passengers > $maxPassengers) {
            return redirect()->back()->withErrors([
                'passengers' => "الحد الأقصى لعدد الركاب هو {$maxPassengers} لهذا النوع"
            ])->withInput();
        }

        $cleanCityOne = rtrim(trim($request->city_one), '/');
        $cleanCityTwo = rtrim(trim($request->city_two), '/');

        $transportTypesString = implode(',', $request->transport_types);

        $city = BetweenCity::findOrFail($id);
        $city->update([
            'city_one' => $cleanCityOne,
            'city_two' => $cleanCityTwo,
            'amount' => $request->amount,
            'passengers' => $request->passengers,
            'office_commission' => $request->office_commission,
            'car_type' => $request->car_type ?: 'Auto',
            'code' => $request->code,
            'transport_types' => $transportTypesString,
            'company_type' => $request->company_type, // ← Single value
        ]);

        return redirect()->back()->with('success', 'تم تعديل البيانات بنجاح');
    }

    // ✅ Get max passengers for company type
    private function getMaxPassengers($companyType)
    {
        if (isset(self::COMPANY_TYPES[$companyType])) {
            return self::COMPANY_TYPES[$companyType]['max_passengers'];
        }
        return 8; // Default
    }

    public function showBetweenCity()
    {
        $cities = BetweenCity::all();

        return response()->json([
            'message' => 'show all cities',
            'cities' => $cities,
        ]);
    }

    /**
     * ✅ Get all company type keys
     */
    public static function getAllKeys()
    {
        return array_keys(self::COMPANY_TYPES);
    }

    /**
     * ✅ Convert English key to Arabic name
     */
    public static function toArabic($key)
    {
        return self::COMPANY_TYPES[$key]['name_ar'] ?? $key;
    }

    /**
     * ✅ Convert ANY value to English key
     */
    public static function toKey($value)
    {
        if (empty($value)) return null;
        
        // Already English key?
        if (isset(self::COMPANY_TYPES[$value])) {
            return $value;
        }
        
        // Arabic to English mapping
        $arabicToKey = [
            'الاجرة العامة' => 'publicFare',
            'الأجرة العامة' => 'publicFare',
            'الاجرة الخاصة' => 'privateFare',
            'الأجرة الخاصة' => 'privateFare',
            'النقل المتخصص' => 'specializedTransport',
            'السيارات الخاصة للمقيمين' => 'privateCarsResidents',
            'سيارات خاصة للمقيمين' => 'privateCarsResidents',
            'السيارات الخاصة للمواطنين' => 'privateCarsCitizens',
            'سيارات خاصة للمواطنين' => 'privateCarsCitizens',
        ];
        
        return $arabicToKey[$value] ?? $value;
    }

}
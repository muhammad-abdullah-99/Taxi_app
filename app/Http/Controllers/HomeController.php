<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Transport\BetweenCityController;

use App\Models\AppUser;
use App\Models\Car;
use App\Models\CarDriver;
use App\Models\Company;
use App\Models\Document;
use App\Models\Employee;
use App\Models\PackageType;
use App\Models\Passenger;
use App\Models\Snd;
use App\Models\Subscription;
use App\Models\EmployeeDocument;
use App\Models\CarDocument;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today()->toDateString();
        $in_15_days = Carbon::today()->addDays(15)->toDateString();
        //// ------------------- شركة الجواب -------------------
        $jawab_sareyah = DB::table('documents')
            ->join('docs_types', 'documents.type_id', '=', 'docs_types.id')
            ->where('docs_types.name', 'شركة الجواب')
            ->whereNull('documents.archive')
            ->whereRaw("STR_TO_DATE(documents.expire_at, '%Y-%m-%d') > ?", [$in_15_days])
            ->select('documents.name as document_name', 'documents.expire_at', 'documents.id')
            ->get();

        $jawab_near_expiry = DB::table('documents')
            ->join('docs_types', 'documents.type_id', '=', 'docs_types.id')
            ->where('docs_types.name', 'شركة الجواب')
            ->whereNull('documents.archive')
            ->whereRaw("STR_TO_DATE(documents.expire_at, '%Y-%m-%d') > ?", [$today])
            ->whereRaw("STR_TO_DATE(documents.expire_at, '%Y-%m-%d') <= ?", [$in_15_days])
            ->select('documents.name as document_name', 'documents.expire_at', 'documents.id')
            ->get();

        $jawab_expired = DB::table('documents')
            ->join('docs_types', 'documents.type_id', '=', 'docs_types.id')
            ->where('docs_types.name', 'شركة الجواب')
            ->whereNull('documents.archive')
            ->whereRaw("STR_TO_DATE(documents.expire_at, '%Y-%m-%d') <= ?", [$today])
            ->select('documents.name as document_name', 'documents.expire_at', 'documents.id')
            ->get();

        // // ------------------- هوية مقيم -------------------

        $moqem_sareyah = DB::table('employees')
            ->whereNull('archive') // استبعاد المؤرشفين
            ->whereNotNull('company')
            ->where('company', '!=', 'العملاء')
            ->whereNotNull('moqem_expire_at')
            ->whereRaw("STR_TO_DATE(moqem_expire_at, '%Y-%m-%d') > ?", [$in_15_days])
            ->select('id', 'name', 'moqem_expire_at')
            ->get();

        $moqem_near_expiry = DB::table('employees')
            ->whereNull('archive') // استبعاد المؤرشفين
            ->whereNotNull('company')
            ->where('company', '!=', 'العملاء')
            ->whereNotNull('moqem_expire_at')
            ->whereRaw("STR_TO_DATE(moqem_expire_at, '%Y-%m-%d') > ?", [$today])
            ->whereRaw("STR_TO_DATE(moqem_expire_at, '%Y-%m-%d') <= ?", [$in_15_days])
            ->select('id', 'name', 'moqem_expire_at')
            ->get();

        $moqem_expired = DB::table('employees')
            ->whereNull('archive') // استبعاد المؤرشفين
            ->whereNotNull('company')
            ->where('company', '!=', 'العملاء')
            ->where(function ($query) use ($today) {
                $query->whereNull('moqem_expire_at')
                    ->orWhereRaw("STR_TO_DATE(moqem_expire_at, '%Y-%m-%d') <= ?", [$today]);
            })
            ->select('id', 'name', 'moqem_expire_at')
            ->get();

        // // ------------------- المخالصة المالية -------------------
        $mokhalasa_sareyah = DB::table('employees')
            ->whereNull('archive')
            ->whereNotNull('company')
            ->where('company', '!=', 'العملاء')
            ->whereNotNull('mokhalsa_expire_at')
            ->whereRaw("STR_TO_DATE(mokhalsa_expire_at, '%Y-%m-%d') > ?", [$in_15_days])
            ->select('id', 'name', 'mokhalsa_expire_at')
            ->get();

        $mokhalasa_near_expiry = DB::table('employees')
            ->whereNull('archive')
            ->whereNotNull('company')
            ->where('company', '!=', 'العملاء')
            ->whereNotNull('mokhalsa_expire_at')
            ->whereRaw("STR_TO_DATE(mokhalsa_expire_at, '%Y-%m-%d') > ?", [$today])
            ->whereRaw("STR_TO_DATE(mokhalsa_expire_at, '%Y-%m-%d') <= ?", [$in_15_days])
            ->select('id', 'name', 'mokhalsa_expire_at')
            ->get();

        $mokhalasa_expired = DB::table('employees')
            ->whereNull('archive')
            ->whereNotNull('company')
            ->where('company', '!=', 'العملاء')
            ->where(function ($query) use ($today) {
                $query->whereNull('mokhalsa_expire_at')
                    ->orWhereRaw("STR_TO_DATE(mokhalsa_expire_at, '%Y-%m-%d') <= ?", [$today]);
            })
            ->select('id', 'name', 'mokhalsa_expire_at')
            ->get();
        // ------------------- بطاقة سائق صادرة من الهيئة العامة للنقل -------------------
        $saiq_card_sareyah = DB::table('employees')
            ->whereNull('archive')
            ->whereNotNull('company')
            ->where('company', '!=', 'العملاء')
            ->whereNotNull('cart_expire_at')
            ->whereRaw("STR_TO_DATE(cart_expire_at, '%Y-%m-%d') > ?", [$in_15_days])
            ->select('id', 'name', 'cart_expire_at')
            ->get();

        $saiq_card_near_expiry = DB::table('employees')
            ->whereNull('archive')
            ->whereNotNull('company')
            ->where('company', '!=', 'العملاء')
            ->whereNotNull('cart_expire_at')
            ->whereRaw("STR_TO_DATE(cart_expire_at, '%Y-%m-%d') > ?", [$today])
            ->whereRaw("STR_TO_DATE(cart_expire_at, '%Y-%m-%d') <= ?", [$in_15_days])
            ->select('id', 'name', 'cart_expire_at')
            ->get();

        $saiq_card_expired = DB::table('employees')
            ->whereNull('archive')
            ->whereNotNull('company')
            ->where('company', '!=', 'العملاء')
            ->where(function ($query) use ($today) {
                $query->whereNull('cart_expire_at')
                    ->orWhereRaw("STR_TO_DATE(cart_expire_at, '%Y-%m-%d') <= ?", [$today]);
            })
            ->select('id', 'name', 'cart_expire_at')
            ->get();










        $employees = Employee::whereNull('archive')
            ->whereNotNull('company')
            ->where('company', '!=', 'العملاء')
            ->count();
        //end employee

        /////cars
        $cars = Car::where('status', '!=', 'خارج عن الخدمة')->whereNull('archive')->count();
        $carsWork = Car::where('status', 'عاملة')->whereNull('archive')->count();
        $carsNotWork = Car::where('status', 'متعطلة')->whereNull('archive')->count();
        $carsWaiting = Car::where('status', 'انتظار')->whereNull('archive')->count();
        //

        $carsDriversWork = CarDriver::with(['car', 'employee'])
            ->whereHas('car', function ($q) {
                $q->where('status', 'عاملة')
                    ->whereNull('archive');
            })
            ->orderByDesc('handover_date') // عشان نجيب أحدث استلام
            ->get()
            ->groupBy('car_id') // نجمع السجلات حسب السيارة
            ->map(function ($items) {
                $latest = $items->first(); // أحدث سجل
                return [
                    'car_plate' => $latest->car->plate_number ?? 'غير متوفر',
                    'employee_name' => $latest->employee->name ?? 'غير متوفر',
                    'days_working' => $latest->handover_date
                        ? Carbon::parse($latest->handover_date)->diffInDays(now()) . ' يوم'
                        : 'غير متوفر',
                ];
            });

        $carsDriversNotWork = CarDriver::with(['car', 'employee'])
            ->whereHas('car', function ($q) {
                $q->where('status', 'متعطلة')->whereNull('archive');
            })
            ->get()
            ->groupBy('car_id')
            ->map(function ($group) {
                $latest = $group->sortByDesc('return_date')->first();

                return [
                    'car_plate'     => $latest->car->plate_number ?? 'غير معروف',
                    'employee_name' => $latest->employee->name ?? 'غير معروف',
                    'days_waiting'  => $latest->return_date
                        ? Carbon::parse($latest->return_date)->diffInDays(Carbon::now())
                        : 0,
                ];
            })
            ->values();


        $carsDriversWaiting = CarDriver::with(['car', 'employee'])
            ->whereHas('car', function ($q) {
                $q->where('status', 'انتظار')->whereNull('archive');
            })
            ->get()
            ->groupBy('car_id') // جَمع كل السجلات لكل سيارة
            ->map(function ($group) {
                $latest = $group->sortByDesc('return_date')->first();

                return [
                    'car_plate'     => $latest->car->plate_number ?? 'غير معروف',
                    'employee_name' => $latest->employee->name ?? 'غير معروف',
                    'days_waiting'  => $latest->return_date
                        ? Carbon::parse($latest->return_date)->diffInDays(Carbon::now())
                        : 0,
                ];
            })
            ->values(); // رجّع مجموعة البيانات كـ array بدون المفاتيح


        // // ------------------- رخصة سير -------------------
        // السيارات التي تنتهي رخصتها بعد 15 يوم
        $rukhsa_sareyah = DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->whereNotNull('saer_expire_at')
            ->whereRaw("STR_TO_DATE(saer_expire_at, '%Y-%m-%d') > ?", [$in_15_days])
            ->get();

        // السيارات التي ستنتهي رخصتها خلال 15 يوم
        $rukhsa_near_expiry = DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->whereNotNull('saer_expire_at')
            ->whereRaw("STR_TO_DATE(saer_expire_at, '%Y-%m-%d') > ?", [$today])
            ->whereRaw("STR_TO_DATE(saer_expire_at, '%Y-%m-%d') <= ?", [$in_15_days])
            ->get();

        // السيارات التي انتهت رخصتها
        $rukhsa_expired = DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->where(function ($query) use ($today) {
                $query->whereNull('saer_expire_at')
                    ->orWhereRaw("STR_TO_DATE(saer_expire_at, '%Y-%m-%d') <= ?", [$today]);
            })
            ->get();


        // ------------------- تأمين مركبة -------------------
        $taamen_sareyah = DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->whereNotNull('tamen_expire_at')
            ->whereRaw("STR_TO_DATE(tamen_expire_at, '%Y-%m-%d') > ?", [$in_15_days])
            ->get();

        $taamen_near_expiry = DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->whereNotNull('tamen_expire_at')
            ->whereRaw("STR_TO_DATE(tamen_expire_at, '%Y-%m-%d') > ?", [$today])
            ->whereRaw("STR_TO_DATE(tamen_expire_at, '%Y-%m-%d') <= ?", [$in_15_days])
            ->get();

        $taamen_expired = DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->where(function ($query) use ($today) {
                $query->whereNull('tamen_expire_at')
                    ->orWhereRaw("STR_TO_DATE(tamen_expire_at, '%Y-%m-%d') <= ?", [$today]);
            })
            ->get();
        // ------------------- الفحص الدوري -------------------
        $fahes_sareyah = DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->whereNotNull('fahs_expire_at')
            ->whereRaw("STR_TO_DATE(fahs_expire_at, '%Y-%m-%d') > ?", [$in_15_days])
            ->get();

        $fahes_near_expiry =  DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->whereNotNull('fahs_expire_at')
            ->whereRaw("STR_TO_DATE(fahs_expire_at, '%Y-%m-%d') > ?", [$today])
            ->whereRaw("STR_TO_DATE(fahs_expire_at, '%Y-%m-%d') <= ?", [$in_15_days])
            ->get();
        $fahes_expired = DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->where(function ($query) use ($today) {
                $query->whereNull('fahs_expire_at')
                    ->orWhereRaw("STR_TO_DATE(fahs_expire_at, '%Y-%m-%d') <= ?", [$today]);
            })
            ->get();
        // ------------------- بطاقة تشغيل صادرة من الهيئة العامة للنقل -------------------
        $tasgheel_sareyah = DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->whereNotNull('cart_expire_at')
            ->whereRaw("STR_TO_DATE(cart_expire_at, '%Y-%m-%d') > ?", [$in_15_days])
            ->get();

        $tasgheel_near_expiry = DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->whereNotNull('cart_expire_at')
            ->whereRaw("STR_TO_DATE(cart_expire_at, '%Y-%m-%d') > ?", [$today])
            ->whereRaw("STR_TO_DATE(cart_expire_at, '%Y-%m-%d') <= ?", [$in_15_days])
            ->get();
        $tasgheel_expired = DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->where(function ($query) use ($today) {
                $query->whereNull('cart_expire_at')
                    ->orWhereRaw("STR_TO_DATE(cart_expire_at, '%Y-%m-%d') <= ?", [$today]);
            })
            ->get();
        // ------------------- تغيير زيت محرك المركبة -------------------
        $zayt_sareyah =  DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->whereNotNull('zaet_expire_at')
            ->whereRaw("STR_TO_DATE(zaet_expire_at, '%Y-%m-%d') > ?", [$in_15_days])
            ->get();


        $zayt_near_expiry =  DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->whereNotNull('zaet_expire_at')
            ->whereRaw("STR_TO_DATE(zaet_expire_at, '%Y-%m-%d') > ?", [$today])
            ->whereRaw("STR_TO_DATE(zaet_expire_at, '%Y-%m-%d') <= ?", [$in_15_days])
            ->get();

        $zayt_expired = DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->where(function ($query) use ($today) {
                $query->whereNull('zaet_expire_at')
                    ->orWhereRaw("STR_TO_DATE(zaet_expire_at, '%Y-%m-%d') <= ?", [$today]);
            })
            ->get();

        // ------------------- تفويض المركبة -------------------
        $tafwed_sareyah = DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->whereNotNull('tafwed_expire_at')
            ->whereRaw("STR_TO_DATE(tafwed_expire_at, '%Y-%m-%d') > ?", [$in_15_days])
            ->get();

        $tafwed_near_expiry = DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->whereNotNull('tafwed_expire_at')
            ->whereRaw("STR_TO_DATE(tafwed_expire_at, '%Y-%m-%d') > ?", [$today])
            ->whereRaw("STR_TO_DATE(tafwed_expire_at, '%Y-%m-%d') <= ?", [$in_15_days])
            ->get();

        $tafwed_expired = DB::table('cars')
            ->where('status', '!=', 'خارج عن الخدمة')
            ->whereNull('archive')
            ->where(function ($query) use ($today) {
                $query->whereNull('tafwed_expire_at')
                    ->orWhereRaw("STR_TO_DATE(tafwed_expire_at, '%Y-%m-%d') <= ?", [$today]);
            })
            ->get();


            //// النسبة المئوية 


            $total_documents = 0;
$active_documents = 0;

// قائمة كل أسماء المستندات
$document_types = [
    'moqem', 'mokhalasa', 'saiq_card', 'rukhsa', 'taamen',
    'fahes', 'tasgheel', 'zayt', 'tafwed'
];

// نحسب العدد الكلي للمستندات وحالاتها
foreach ($document_types as $type) {
    $sareyah_var = $type . '_sareyah';
    $near_var    = $type . '_near_expiry';
    $expired_var = $type . '_expired';

    // نفترض إنك جبتهم من الباك مسبقًا كـ Collections
    $sareyah = $$sareyah_var;
    $near    = $$near_var;
    $expired = $$expired_var;

    // عدد المستندات الإجمالي (ساري + قرب انتهاء + منتهي)
    $total_documents += $sareyah->count() + $near->count() + $expired->count();

    // عدد المستندات السارية فقط
    $active_documents += $sareyah->count();
}

// نحسب النسبة المؤوية
$company_indicator = $total_documents > 0 ? round(($active_documents / $total_documents) * 100, 2) : 0;
$deactive_documents = $total_documents - $active_documents ;
// انتهاء النسبة المئوية 


        //
        $gehaName = 'مخالفات المواقف';

        $totalForGeha = Snd::where('client_type', 'جهة')->whereNotNull('employee_id')
            ->whereHas('geha', function ($query) use ($gehaName) {
                $query->where('name', $gehaName);
            })
            ->sum('amount');


        $totalForOthers = Snd::whereIn('client_type', ['موظف', 'سيارة'])
            ->whereHas('geha', function ($query) use ($gehaName) {
                $query->where('name', $gehaName);
            })
            ->sum('amount');

        //صرف

        $totalForGehaSarf = Snd::where('client_type', 'جهة')->where('type', 'صرف')
            ->whereHas('geha', function ($query) use ($gehaName) {
                $query->where('name', $gehaName);
            })
            ->sum('amount');

        $sndMoaqefAmount = $totalForGeha - $totalForOthers - $totalForGehaSarf;

        //

        $gehaName = 'مخالفات الهيئة العامة للنقل';

        $totalForGeha = Snd::where('client_type', 'جهة')->whereNotNull('employee_id')
            ->whereHas('geha', function ($query) use ($gehaName) {
                $query->where('name', $gehaName);
            })
            ->sum('amount');

        $totalForOthers = Snd::whereIn('client_type', ['موظف', 'سيارة'])
            ->whereHas('geha', function ($query) use ($gehaName) {
                $query->where('name', $gehaName);
            })
            ->sum('amount');


        //صرف

        $totalForGehaSarf = Snd::where('client_type', 'جهة')->where('type', 'صرف')
            ->whereHas('geha', function ($query) use ($gehaName) {
                $query->where('name', $gehaName);
            })
            ->sum('amount');

        $sndNaqlAmount = $totalForGeha - $totalForOthers - $totalForGehaSarf;


        //
        $gehaName = 'المخالفات المرورية';

        $totalForGeha = Snd::where('client_type', 'جهة')->whereNotNull('employee_id')
            ->whereHas('geha', function ($query) use ($gehaName) {
                $query->where('name', $gehaName);
            })
            ->sum('amount');

        $totalForOthers = Snd::whereIn('client_type', ['موظف', 'سيارة'])
            ->whereHas('geha', function ($query) use ($gehaName) {
                $query->where('name', $gehaName);
            })
            ->sum('amount');


        //صرف

        $totalForGehaSarf = Snd::where('client_type', 'جهة')->where('type', 'صرف')
            ->whereHas('geha', function ($query) use ($gehaName) {
                $query->where('name', $gehaName);
            })
            ->sum('amount');

        $sndMorurAmount = $totalForGeha - $totalForOthers - $totalForGehaSarf;





        //22222222222222
        $activeCaptains = AppUser::where('status', 1)->where('user_type', 'Driver')->where('name', '!=', 'guest')->count();
        $pendingCaptains = AppUser::whereNull('status')->where('user_type', 'Driver')->where('name', '!=', 'guest')->count();
        $allCaptains = AppUser::where(function ($query) {
            $query->where('status', '!=', 2)
                ->orWhereNull('status');
        })->where('user_type', 'Driver')->where('name', '!=', 'guest')->count();

        $passengers = Passenger::count(); //كشف االركاب 

        $activeCaptainsData = AppUser::where('status', 1)->where('user_type', 'Driver')->where('name', '!=', 'guest')->get();
        $pendingCaptainsData = AppUser::whereNull('status')->where('user_type', 'Driver')->where('name', '!=', 'guest')->get();


//// OLD CODE
//  $companyTypes = [
//         'الاجرة العامة',
//         'الاجرة الخاصة',
//         'النقل المتخصص',
//         'السيارات الخاصة للمقيمين',
//         'السيارات الخاصة للمواطنين',
//     ];

//     $data = [];

//     foreach ($companyTypes as $type) {
//         $data[$type]['active'] = AppUser::where('user_type', 'Driver')
//             ->where('status', 1)
//             ->where('name', '!=', 'guest')
//             ->whereHas('company', function ($q) use ($type) {
//                 $q->where('company_type', $type);
//             })
//             ->with('company')
//             ->get();

//         $data[$type]['pending'] = AppUser::where('user_type', 'Driver')
//             ->whereNull('status')
//             ->where('name', '!=', 'guest')
//             ->whereHas('company', function ($q) use ($type) {
//                 $q->where('company_type', $type);
//             })
//             ->with('company')
//             ->get();

//         $data[$type]['archived'] = AppUser::where('user_type', 'Driver')
//             ->where('status', 2)
//             ->where('name', '!=', 'guest')
//             ->whereHas('company', function ($q) use ($type) {
//                 $q->where('company_type', $type);
//             })
//             ->with('company')
//             ->get();
//     }

// NEW CODE
        // ✅ FIX: Use English keys from BetweenCityController
        $companyTypes = BetweenCityController::getAllKeys(); // Returns: ['publicFare', 'privateFare', ...]
        $companyTypesData = BetweenCityController::COMPANY_TYPES;
        $data = [];

        foreach ($companyTypes as $type) {
            // ✅ All queries now use English keys
            $data[$type]['active'] = AppUser::where('user_type', 'Driver')
                ->where('status', 1)
                ->where('name', '!=', 'guest')
                ->whereHas('company', function ($q) use ($type) {
                    $q->where('company_type', $type); // ✅ English key: 'publicFare'
                })
                ->with('company')
                ->get();

            $data[$type]['pending'] = AppUser::where('user_type', 'Driver')
                ->whereNull('status')
                ->where('name', '!=', 'guest')
                ->whereHas('company', function ($q) use ($type) {
                    $q->where('company_type', $type);
                })
                ->with('company')
                ->get();

            $data[$type]['archived'] = AppUser::where('user_type', 'Driver')
                ->where('status', 2)
                ->where('name', '!=', 'guest')
                ->whereHas('company', function ($q) use ($type) {
                    $q->where('company_type', $type);
                })
                ->with('company')
                ->get();
        }




        //

        // $targetCities = ['القصيم', 'الرياض', 'الدمام', 'مكة', 'جدة', 'المدينة المنورة'];

        // $cities_summary = collect($targetCities)->map(function ($city) {
        //     $companies = Company::where('company_location', $city)
        //         ->select('company_name', 'user_id')
        //         ->get()
        //         ->unique('company_name');

        //     $captainUserIds = Company::where('company_location', $city)
        //         ->pluck('user_id')
        //         ->unique();

        //     return [
        //         'city' => $city,
        //         'companies_count' => $companies->count(),
        //         'captains_count' => $captainUserIds->count(),
        //     ];
        // });

        // $active_captains_count = Passenger::whereNotNull('user_id')
        //     ->pluck('user_id')
        //     ->unique()
        //     ->count();

        // $actual_cities_with_trips_count = Company::whereIn('company_location', $targetCities)
        //     ->whereIn('user_id', function ($query) {
        //         $query->select('user_id')
        //             ->from('passengers')
        //             ->whereNotNull('user_id');
        //     })
        //     ->pluck('company_location')
        //     ->unique()
        //     ->count();




        //////

        // المدن المستهدفة
        $targetCities = ['القصيم', 'الرياض', 'الدمام', 'مكة', 'جدة', 'المدينة المنورة'];

        // 1. نجيب كل الشركات في المدن المحددة (مع السائق اللي فيها user_id)
        $companies = Company::whereIn('company_location', $targetCities)
            ->select('company_location', 'user_id', 'company_name')
            ->get();

        // 2. نجيب عدد الرحلات لكل سائق من جدول passengers
        $tripsPerUser = Passenger::whereIn('user_id', $companies->pluck('user_id')->unique())
            ->whereNotNull('user_id')
            ->groupBy('user_id')
            ->select('user_id', DB::raw('count(*) as trips_count'))
            ->pluck('trips_count', 'user_id');

        // 3. نحسب عدد الرحلات لكل مدينة من خلال جمع عدد رحلات كل سائق تبع شركات المدينة
        $city_trip_counts = [];

        foreach ($companies as $company) {
            $userId = $company->user_id;
            $city = $company->company_location;
            $tripsCount = $tripsPerUser->get($userId, 0);

            if (!isset($city_trip_counts[$city])) {
                $city_trip_counts[$city] = 0;
            }

            $city_trip_counts[$city] += $tripsCount;
        }

        // نضمن كل المدن موجودة حتى لو صفر
        foreach ($targetCities as $city) {
            if (!isset($city_trip_counts[$city])) {
                $city_trip_counts[$city] = 0;
            }
        }

        // 4. نجيب قائمة الكباتن النشطين (اللي عندهم رحلات فعلًا)
        $activeCaptainIds = Passenger::whereNotNull('user_id')
            ->pluck('user_id')
            ->unique();

        // 5. نجيب ملخص لكل مدينة
        $cities_summary = collect($targetCities)->map(function ($city) use ($city_trip_counts, $activeCaptainIds) {
            // الشركات الموجودة في المدينة
            $companies = Company::where('company_location', $city)
                ->select('company_name', 'user_id')
                ->get();

            // الشركات اللي عندها كباتن نشطين (قاموا برحلات فعلًا)
            $activeCompanies = $companies->filter(function ($company) use ($activeCaptainIds) {
                return $activeCaptainIds->contains($company->user_id);
            });

            // الكباتن النشطين في المدينة
            $captainUserIds = $activeCompanies->pluck('user_id');

            return [
                'city' => $city,
                'companies_count' => $activeCompanies->count(), // فقط الشركات اللي كباتنهم نشطين
                'captains_count' => $captainUserIds->count(),
                'trips_count' => $city_trip_counts[$city] ?? 0,
            ];
        });


        // عدد الكباتن الفعّالين الكلي
        $active_captains_count = $activeCaptainIds->count();

        // عدد المدن التي بها رحلات فعلًا
        $cities_with_trips = collect($targetCities)->filter(function ($city) {
            // نجيب الشركات في المدينة
            $companies = Company::where('company_location', $city)
                ->select('user_id')
                ->get();

            // نتحقق هل فيه أي سائق من هذه الشركات قام برحلة
            $userIds = $companies->pluck('user_id')->filter();

            $hasTrips = Passenger::whereIn('user_id', $userIds)
                ->whereNotNull('user_id')
                ->exists();

            return $hasTrips;
        });

        // عدد المدن اللي فيها رحلات فعلية
        $actual_cities_with_trips_count = $cities_with_trips->count();
        // عدد الشركات التي لديها رحلات فعلية (حسب وجود user_id في passengers)
        $companies_with_trips_count = Company::whereIn('company_location', $targetCities)
            ->whereExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('passengers')
                    ->whereColumn('passengers.user_id', 'companies.user_id')
                    ->whereNotNull('user_id');
            })
            ->select('company_location')
            ->distinct()
            ->count();






        // الباقات المتاحة
        $availablePackages = PackageType::where('is_active', true)->get();
        $subscriptions = Subscription::with(['appUser', 'package'])->get();

        // الاشتراكات المفعلة (اليوم قبل تاريخ الانتهاء)
        $activeSubscriptions = $subscriptions->filter(function ($sub) {
            $expire = Carbon::parse($sub->expire_at);
            return $expire->gt(Carbon::now()->addDays(10));
        });

        // الاشتراكات القريبة على الانتهاء (من اليوم إلى 10 أيام)
        $expiringSoon = $subscriptions->filter(function ($sub) {
            $expire = Carbon::parse($sub->expire_at);
            return $expire->between(Carbon::now(), Carbon::now()->addDays(10));
        });














        return view('dashboard', compact(


            //
            'company_indicator',

            'deactive_documents',
            'total_documents',

            //
            'jawab_sareyah',
            'jawab_near_expiry',
            'jawab_expired',
            //

            'moqem_sareyah',
            'moqem_near_expiry',
            'moqem_expired',
            //
            'mokhalasa_sareyah',
            'mokhalasa_near_expiry',
            'mokhalasa_expired',
            //
            'employees',
            //
            'saiq_card_sareyah',
            'saiq_card_near_expiry',
            'saiq_card_expired',
            //car
            'cars',
            //
            'rukhsa_sareyah',
            'rukhsa_near_expiry',
            'rukhsa_expired',
            //
            'taamen_sareyah',
            'taamen_near_expiry',
            'taamen_expired',
            //
            'fahes_sareyah',
            'fahes_near_expiry',
            'fahes_expired',
            //
            'tasgheel_sareyah',
            'tasgheel_near_expiry',
            'tasgheel_expired',
            //
            'zayt_sareyah',
            'zayt_near_expiry',
            'zayt_expired',
            //
            'tafwed_sareyah',
            'tafwed_near_expiry',
            'tafwed_expired',
            //snd //مخالفات
            'sndMoaqefAmount',
            'sndNaqlAmount',
            'sndMorurAmount',
            'carsWork',
            'carsNotWork',
            'carsWaiting',
            'carsDriversWork',
            'carsDriversWaiting',
            'carsDriversNotWork',
            'allCaptains',
            'pendingCaptains',
            'activeCaptains',
            'passengers',
            'activeCaptainsData',
            'pendingCaptainsData',
            'cities_summary',
            'active_captains_count',
            'actual_cities_with_trips_count',
            'companies_with_trips_count',
            'city_trip_counts',
            //
            'availablePackages',
            'subscriptions',
            'activeSubscriptions',
            'expiringSoon',
            'data', 
            'companyTypes',
            'companyTypesData',

        ));
    }
    public function updateExpiry(Request $request)
    {

        $request->validate([
            'id' => 'required|exists:documents,id',
            'expire_at' => 'required|date',
        ]);

        $doc = Document::findOrFail($request->id);
        $doc->expire_at = $request->expire_at;
        $doc->save();

        return redirect()->back()->with('success', 'تم تعديل تاريخ الانتهاء بنجاح');
    }

    // public function moqemUpdateExpiry(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|exists:employees,id',
    //         'expire_at' => 'required|date',
    //     ]);

    //     $employee = Employee::findOrFail($request->id);
    //     $employee->moqem_expire_at = $request->expire_at;
    //     $employee->save();


    //     return redirect()->back()->with('success', 'تم تعديل تاريخ الانتهاء بنجاح');
    // }
    public function moqemUpdateExpiry(Request $request)
{
    $request->validate([
        'id' => 'required|exists:employees,id',
        'expire_at' => 'required|date',
        'files.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:20480', // صور أو PDF
    ]);

    $employee = Employee::findOrFail($request->id);
    $employee->moqem_expire_at = $request->expire_at;
    $employee->save();

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            // اسم فريد للملف
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            // تحديد المسار
            $destinationPath = public_path('storage/employee_files');

            // إنشاء المجلد لو مش موجود
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // نقل الملف
            $file->move($destinationPath, $fileName);

            // حفظ في قاعدة البيانات
            EmployeeDocument::create([
                'employee_id' => $employee->id,
                'type' => 'moqem',
                'file_path' => 'employee_files/' . $fileName,
            ]);
        }
    }

    return redirect()->back()->with('success', 'تم تعديل تاريخ الإقامة وحفظ المرفقات بنجاح');
}

    // public function mokhalsaUpdateExpiry(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|exists:employees,id',
    //         'expire_at' => 'required|date',
    //     ]);

    //     $employee = Employee::findOrFail($request->id);
    //     $employee->mokhalsa_expire_at = $request->expire_at;
    //     $employee->save();

    //     return redirect()->back()->with('success', 'تم تعديل تاريخ الانتهاء بنجاح');
    // }


    public function mokhalsaUpdateExpiry(Request $request)
{
    $request->validate([
        'id' => 'required|exists:employees,id',
        'expire_at' => 'required|date',
        'files.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:20480', // صور أو PDF
    ]);

    $employee = Employee::findOrFail($request->id);
    $employee->mokhalsa_expire_at = $request->expire_at;
    $employee->save();

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $destinationPath = public_path('storage/employee_files');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $fileName);

            EmployeeDocument::create([
                'employee_id' => $employee->id,
                'type' => 'mokhalsa',
                'file_path' => 'employee_files/' . $fileName,
            ]);
        }
    }

    return redirect()->back()->with('success', 'تم تعديل تاريخ المخالصة وحفظ المرفقات بنجاح');
}


    // public function cardUpdateExpiry(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|exists:employees,id',
    //         'expire_at' => 'required|date',
    //     ]);

    //     $employee = Employee::findOrFail($request->id);
    //     $employee->cart_expire_at = $request->expire_at;
    //     $employee->save();

    //     return redirect()->back()->with('success', 'تم تعديل تاريخ الانتهاء بنجاح');
    // }

    public function cardUpdateExpiry(Request $request)
{
    $request->validate([
        'id' => 'required|exists:employees,id',
        'expire_at' => 'required|date',
        'files.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:20480', // ملفات PDF أو صور
    ]);

    $employee = Employee::findOrFail($request->id);
    $employee->cart_expire_at = $request->expire_at;
    $employee->save();

    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $destinationPath = public_path('storage/employee_files');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $fileName);

            EmployeeDocument::create([
                'employee_id' => $employee->id,
                'type' => 'card',  // نوع المرفق 'card'
                'file_path' => 'employee_files/' . $fileName,
            ]);
        }
    }

    return redirect()->back()->with('success', 'تم تعديل تاريخ الكارت وحفظ المرفقات بنجاح');
}


    // public function carsUpdateExpiry(Request $request)
    // {

    //     $request->validate([
    //         'id' => 'required|exists:cars,id',
    //         'expire_at' => 'required',
    //         'field' => 'required|in:saer_expire_at,tamen_expire_at,fahs_expire_at,cart_expire_at,zaet_expire_at,tafwed_expire_at',
    //     ]);

    //     $car = Car::findOrFail($request->id);

    //     // تحديث الحقل المطلوب فقط
    //     $car->{$request->field} = $request->expire_at;
    //     $car->save();

    //     return redirect()->back()->with('success', 'تم تحديث تاريخ الانتهاء بنجاح.');
    // }



    public function carsUpdateExpiry(Request $request)
{
    $request->validate([
        'id' => 'required|exists:cars,id',
        'expire_at' => 'required|date',
        'field' => 'required|in:saer_expire_at,tamen_expire_at,fahs_expire_at,cart_expire_at,zaet_expire_at,tafwed_expire_at',
        'files.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,webp|max:20480', 
    ]);

    $car = Car::findOrFail($request->id);

    // تحديث التاريخ
    $car->{$request->field} = $request->expire_at;
    $car->save();

    // حفظ الملفات (إن وجدت)
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $destinationPath = public_path('storage/car_files');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $file->move($destinationPath, $fileName);

            CarDocument::create([
                'car_id' => $car->id,
                'type' => $request->field,  // نخزن النوع بنفس اسم الحقل المحدث (مثلاً: tamen_expire_at)
                'file_path' => 'car_files/' . $fileName,
            ]);
        }
    }

    return redirect()->back()->with('success', 'تم تحديث تاريخ الانتهاء وحفظ المرفقات بنجاح.');
}
}

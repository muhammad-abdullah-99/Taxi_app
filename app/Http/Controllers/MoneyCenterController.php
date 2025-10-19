<?php

namespace App\Http\Controllers;

use App\Models\Mandub;
use App\Models\Snd;
use App\Models\Wallet;
use Illuminate\Http\Request;

class MoneyCenterController extends Controller
{
    // public function index()
    // {
    //     // الاجمالي //////
    //     $qbd = Snd::where('type', 'قبض')->get();
    //     $srf = Snd::where('type', 'صرف')->get();

    //     $totalQbd = $qbd->sum('amount');
    //     $totalSrf = $srf->sum('amount');

    //     //  بنك الرياض //////////
    //     $qbdBankAlryad = Snd::where('type', 'قبض')->where('bank_account', 'شركة الجواب - بنك الرياض')->get();
    //     $srfBankAlryad = Snd::where('type', 'صرف')->where('bank_account', 'شركة الجواب - بنك الرياض')->get();

    //     $totalQbdBankAlryad = $qbdBankAlryad->sum('amount');
    //     $totalSrfBankAlryad = $srfBankAlryad->sum('amount');

    //     // ضريب  القيمة المضافة /////
    //     $qbdDryb = Snd::where('type', 'قبض')
    //         ->whereHas('geha', function ($q) {
    //             $q->where('name', 'ضريبة القيمه المضافه');
    //         })
    //         ->get();

    //     $srfDryb = Snd::where('type', 'صرف')
    //         ->whereHas('geha', function ($q) {
    //             $q->where('name', 'ضريبة القيمه المضافه');
    //         })
    //         ->get();

    //     $totalQbdDryb = $qbdDryb->sum('amount');
    //     $totalSrfDryb = $srfDryb->sum('amount');


    //     return view('admin.box.moneyCenter', compact('totalQbd', 'totalSrf', 'totalQbdBankAlryad', 'totalSrfBankAlryad', 'totalQbdDryb', 'totalSrfDryb'));
    // }


    //     public function index()
    //     {
    //         $cars = snd::where('type', 'تحويل داخلي')->where('client_type', 'سيارة')->get();
    //         $cars = snd::where('type', 'تحويل داخلي')->where('client_type', 'جهة')->get();
    //         $qbd = Snd::where('type', 'قبض')->get();
    //         $srf = Snd::where('type', 'صرف')->get();
    // // ضريب  القيمة المضافة /////
    //         $qbdDryb = Snd::where('type', 'قبض')
    //             ->whereHas('geha', function ($q) {
    //                 $q->where('name', 'ضريبة القيمه المضافه');
    //             })
    //             ->get();

    //         $srfDryb = Snd::where('type', 'صرف')
    //             ->whereHas('geha', function ($q) {
    //                 $q->where('name', 'ضريبة القيمه المضافه');
    //             })
    //             ->get();

    //         $totalQbdDryb = $qbdDryb->sum('amount');
    //         $totalSrfDryb = $srfDryb->sum('amount');
    //      return view('admin.box.moneyCenter');

    //     }
    public function index(Request $request)
    {
        $year = $request->input('year', now()->year);

        // إجماليات سنوية لاستحقاقات السيارات والجهات
        $yearlyCarEsthqaq = Snd::where('type', 'تحويل داخلي')
            ->where('client_type', 'سيارة')
            ->whereYear('date', $year)
            ->sum('amount');

        $yearlyGehaEsthqaq = Snd::where('type', 'تحويل داخلي')
            ->where('client_type', 'جهة')
            ->whereYear('date', $year)
            ->sum('amount');

        $yearlyTotalEsthqaq = $yearlyCarEsthqaq + $yearlyGehaEsthqaq;

        $yearlyQbd = Snd::where('type', 'قبض')
            ->whereYear('date', $year)
            ->sum('amount');

        $yearlySrf = Snd::where('type', 'صرف')
            ->whereYear('date', $year)
            ->sum('amount');

        $yearlyQbdTax = Snd::where('type', 'قبض')
            ->whereHas('geha', function ($q) {
                $q->where('name', 'ضريبة القيمه المضافه');
            })
            ->whereYear('date', $year)
            ->sum('amount');

        $yearlySrfTax = Snd::where('type', 'صرف')
            ->whereHas('geha', function ($q) {
                $q->where('name', 'ضريبة القيمه المضافه');
            })
            ->whereYear('date', $year)
            ->sum('amount');

        $yearlyBalance = $yearlyQbd - $yearlySrf;
        $yearlyMuta3ather = $yearlyBalance - $yearlyTotalEsthqaq;
        $yearlyTaxDiff = $yearlyQbdTax - $yearlySrfTax;

        // البيانات الشهرية كما هي
        $monthlyData = [];
        for ($month = 1; $month <= 12; $month++) {
            $qbd = Snd::where('type', 'قبض')->whereYear('date', $year)->whereMonth('date', $month)->sum('amount');
            $srf = Snd::where('type', 'صرف')->whereYear('date', $year)->whereMonth('date', $month)->sum('amount');
            $cars = Snd::where('type', 'تحويل داخلي')->where('client_type', 'سيارة')->whereYear('date', $year)->whereMonth('date', $month)->sum('amount');
            $gehat = Snd::where('type', 'تحويل داخلي')->where('client_type', 'جهة')->whereYear('date', $year)->whereMonth('date', $month)->sum('amount');
            $taxQbd = Snd::where('type', 'قبض')->whereHas('geha', fn($q) => $q->where('name', 'ضريبة القيمه المضافه'))->whereYear('date', $year)->whereMonth('date', $month)->sum('amount');
            $taxSrf = Snd::where('type', 'صرف')->whereHas('geha', fn($q) => $q->where('name', 'ضريبة القيمه المضافه'))->whereYear('date', $year)->whereMonth('date', $month)->sum('amount');

            $qbd_ngat = Snd::where('type', 'قبض')->where('payment_method', 'نقاط بيع')->whereYear('date', $year)->whereMonth('date', $month)->sum('amount');
            $qbd_cach = Snd::where('type', 'قبض')->where('payment_method', 'كاش')->whereYear('date', $year)->whereMonth('date', $month)->sum('amount');
            $qbd_bank = Snd::where('type', 'قبض')->where('payment_method', 'تحويل بنكي')->whereYear('date', $year)->whereMonth('date', $month)->sum('amount');

            $srf_ngat = Snd::where('type', 'صرف')->where('payment_method', 'نقاط بيع')->whereYear('date', $year)->whereMonth('date', $month)->sum('amount');
            $srf_cach = Snd::where('type', 'صرف')->where('payment_method', 'كاش')->whereYear('date', $year)->whereMonth('date', $month)->sum('amount');
            $srf_bank = Snd::where('type', 'صرف')->where('payment_method', 'تحويل بنكي')->whereYear('date', $year)->whereMonth('date', $month)->sum('amount');
            $total_qbd_pay = $qbd_ngat + $qbd_cach + $qbd_bank;
            $total_srf_pay = $srf_ngat + $srf_cach + $srf_bank;

            $monthlyData[$month] = [
                'esthqaq_cars' => $cars,
                'esthqaq_gehat' => $gehat,
                'esthqaq_total' => $cars + $gehat,
                'qbd' => $qbd,
                'srf' => $srf,
                'tax' => $taxQbd - $taxSrf,
                'balance' => $qbd - $srf,
                //
                'qbd_ngat' => $qbd_ngat,
                'qbd_cach' => $qbd_cach,
                'qbd_bank' => $qbd_bank,
                'srf_ngat' => $srf_ngat,
                'srf_cach' => $srf_cach,
                'srf_bank' => $srf_bank,
                'eldkhl' => $total_qbd_pay - $total_srf_pay
                //

            ];
        }







        return view('admin.box.moneyCenter', compact(
            'year',
            'monthlyData',
            'yearlyCarEsthqaq',
            'yearlyGehaEsthqaq',
            'yearlyTotalEsthqaq',
            'yearlyQbd',
            'yearlySrf',
            'yearlyBalance',
            'yearlyMuta3ather',
            'yearlyTaxDiff'
        ));
    }





    //transport

    public function transport()
    {
        // الاجمالي //////
        $qbd = Wallet::whereHas('details', function ($q) {
            $q->where('name', 'قبض');
        })->with('details')->get();

        $srf = Wallet::whereHas('details', function ($q) {
            $q->where('name', 'صرف');
        })->with('details')->get();

        $totalQbd = $qbd->reduce(function ($carry, $wallet) {
            return $carry + $wallet->details->sum('amount');
        }, 0);

        $totalSrf = $srf->reduce(function ($carry, $wallet) {
            return $carry + $wallet->details->sum('amount');
        }, 0);
        //  المناديب  //////////
        $Mandub = Mandub::all();

        $totalQbdMandub = $Mandub->sum('amount');
        $totalSrfMandub = $Mandub->sum('spent');


        return view('/admin/transport/box/moneyCenter', compact('totalQbd', 'totalSrf', 'totalSrfMandub', 'totalQbdMandub'));
    }
}

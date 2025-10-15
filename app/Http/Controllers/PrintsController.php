<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class PrintsController extends Controller
{

    public function showAllPrints($id)
    {
        $employee = Employee::find($id);
        return view('/admin/prints/prints', compact('employee'));
    }

    public function moghalsa(request $request)
    {
        $name = $request->name;
        $idNumber = $request->id_number;
        $date = $request->date;
        $nationality = $request->nationality;

        return view('/admin/prints/moghalsa', compact('name', 'idNumber', 'date' ,'nationality'));
    }
    public function ratb(request $request)
    {
        $name = $request->name;
        $idNumber = $request->id_number;
        $date = $request->date;
        $nationality = $request->nationality;

        return view('/admin/prints/ratb', compact('name', 'idNumber', 'date' ,'nationality'));
    }
    public function tafwed(Request $request)
    {
        $name = $request->name;
        $idNumber = $request->id_number;
        $nationality = $request->nationality;
    
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $car_type = $request->car_type;
        $color = $request->color;
        $plate_number = $request->plate_number;
        $year = $request->year;
    
        return view('/admin/prints/tafwed', compact(
            'name',
            'idNumber',
            'nationality',
            'start_date',
            'end_date',
            'car_type',
            'color',
            'plate_number',
            'year'
        ));
    }



    public function tasleemMarkba(Request $request)
{
    // استلام البيانات من الفورم
    $name         = $request->name;
    $nationality  = $request->nationality;
    $idNumber     = $request->id_number;
    $start_date   = $request->start_date;
    $car_type     = $request->car_type;
    $plate_number = $request->plate_number;
    $year         = $request->year;

    // الحقول الجديدة
    $adad_number  = $request->adad_number;
    $nqt_number   = $request->nqt_number;
    $zyt_number   = $request->zyt_number;
    $day_cost     = $request->day_cost;

    return view('admin.prints.tasleem', compact(
        'name',
        'nationality',
        'idNumber',
        'start_date',
        'car_type',
        'plate_number',
        'year',
        'adad_number',
        'nqt_number',
        'zyt_number',
        'day_cost'
    ));
}

public function a3daMarkba(Request $request)
{
    $name          = $request->name;
    $nationality   = $request->nationality;
    $idNumber      = $request->id_number;
    $start_date    = $request->start_date;
    $car_type      = $request->car_type;
    $plate_number  = $request->plate_number;
    $year          = $request->year;
    $reason        = $request->reason;
    $adad_zayt     = $request->adad_zayt;
    $adad_number   = $request->adad_number;
    $nqt_number    = $request->nqt_number;
    $zyt_date      = $request->zyt_date;
    $reset_number  = $request->reset_number;
    $price         = $request->price;

    return view('admin.prints.a3da', compact(
        'name',
        'nationality',
        'idNumber',
        'start_date',
        'car_type',
        'plate_number',
        'year',
        'reason',
        'adad_zayt',
        'adad_number',
        'nqt_number',
        'zyt_date',
        'reset_number',
        'price'
    ));
}


    

}

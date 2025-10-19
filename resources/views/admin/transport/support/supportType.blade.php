@extends('layouts.master')
@section('title', 'إدارة الدعم الفني')

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
@if ($user_type == 1)
    <h4 class="mb-0">تذاكر السائقين</h4>
@elseif ($user_type == 2)
    <h4 class="mb-0">تذاكر العملاء</h4>
@endif       
 </div>
    </div>
</div>
@endsection

@section('content')

<div class="row mb-30 d-flex justify-content-center">

    {{-- تذاكر قيد الانتظار --}}
  <a href="{{ route('waitTickets', ['user_type' => $user_type]) }}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
    <div class="card text-center d-flex align-items-center justify-content-center shadow-lg"
        style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
        <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
            <i class="fa fa-clock-o fa-4x text-warning mb-3"></i>
            <h6 class="card-title text-light" style="font-size: 1.2rem;">تذاكر قيد الانتظار</h6>
        </div>
    </div>
</a>


    {{-- تذاكر تحت الإجراء --}}
        <a href="#" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
    <!-- <a href="{{ route('processTickets', ['user_type' => $user_type]) }}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center"> -->
        <div class="card text-center d-flex align-items-center justify-content-center shadow-lg"
            style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-cogs fa-4x text-info mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.2rem;">تذاكر تحت الإجراء</h6>
            </div>
        </div>
    </a>

    {{-- تذاكر مغلقة --}}
    <a href="#" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
    <!-- <a href="{{ route('closeTickets', ['user_type' => $user_type]) }}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center"> -->
        <div class="card text-center d-flex align-items-center justify-content-center shadow-lg"
            style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-check-circle fa-4x text-success mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.2rem;">تذاكر مغلقة</h6>
            </div>
        </div>
    </a>

</div>

@endsection

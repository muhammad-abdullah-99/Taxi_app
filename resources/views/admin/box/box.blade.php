@extends('layouts.master')
@section('css')
@section('title')
الصندوق
@stop
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> الصندوق </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item" class="default-color"> لوحة التحكم </li>
                <li class="breadcrumb-item active"> الصندوق </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row mb-30 d-flex justify-content-center">

    <a href="{{ route('getBank') }}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
        <div class="card text-center d-flex align-items-center justify-content-center shadow-lg"
            style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-money fa-4x text-primary mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.3rem;"> المبالغ النقدية المؤكده </h6>
            </div>
        </div>
    </a>
    <a href="{{ route('getsnds') }}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
        <div class="card text-center d-flex align-items-center justify-content-center shadow-lg"
            style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-file fa-4x text-info mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.3rem;"> سند </h6>
            </div>
        </div>
    </a>

 
    <a href="{{ route('getPointAndBank') }}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
        <div class="card text-center d-flex align-items-center justify-content-center shadow-lg"
            style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-bank fa-4x text-primary mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.3rem;"> البنك </h6>
            </div>
        </div>
    </a>
    <a href="{{route('employee.statement')}}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
        <div class="card text-center d-flex align-items-center justify-content-center shadow-lg"
            style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-credit-card fa-4x text-success mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.3rem;">كشف الحساب</h6>
            </div>
        </div>
    </a>

    <a href="{{ route('getInsideSnds') }}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
        <div class="card text-center d-flex align-items-center justify-content-center shadow-lg"
            style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-retweet fa-4x text-info mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.3rem;"> تحويل داخلي  </h6>
            </div>
        </div>
    </a>
    <a href="{{ route('late.payments') }}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
        <div class="card text-center d-flex align-items-center justify-content-center shadow-lg"
            style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-exclamation-triangle fa-4x text-danger mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.2rem;"> المتعثرين على السداد </h6>
            </div>
        </div>
    </a>

    <!--  -->
    <a href="{{ route('moneyCenter') }}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
        <div class="card text-center d-flex align-items-center justify-content-center shadow-lg"
            style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-line-chart fa-4x text-light mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.2rem;"> المركز المالي </h6>
            </div>
        </div>
    </a>
     <!--  مبالغ بوابة الدفع -->
    <a href="{{ route('onlinePayment') }}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
        <div class="card text-center d-flex align-items-center justify-content-center shadow-lg"
            style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-calculator fa-4x text-info mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.2rem;"> مبالغ بوابة الدفع  </h6>
            </div>
        </div>
    </a>

</div>

<!-- row closed -->
@endsection

@section('js')
@endsection
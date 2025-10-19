@extends('layouts.master')
@section('css')
@section('title')
الشركات
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> الشركات </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item default-color"> لوحة التحكم </li>
                <li class="breadcrumb-item active"> الشركات </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')

<!-- row -->
<div class="row mb-30 d-flex justify-content-center">

    <!-- الشركات الحالية -->
    <a href="{{ route('companies') }}" class="col-md-3 mb-3 text-decoration-none d-flex justify-content-center">
        <div class="card text-center shadow-lg" style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-building fa-4x text-success mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.3rem;">الشركات الحالية</h6>
            </div>
        </div>
    </a>
    <!-- الأرشيف -->
    <a href="{{ route('archivedCompanies') }}" class="col-md-3 mb-3 text-decoration-none d-flex justify-content-center">
        <div class="card text-center shadow-lg" style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-archive fa-4x text-danger mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.3rem;">أرشيف الشركات</h6>
            </div>
        </div>
    </a>

</div>
<!-- row closed -->

@endsection
@section('js')
@endsection

@extends('layouts.master')
@section('css')
@section('title')
dashboard
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> السائقين </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item default-color"> لوحة التحكم </li>
                <li class="breadcrumb-item active"> السائقين </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<div class="row mb-30 d-flex justify-content-center">
    @php
        // ✅ FIXED: Use English keys with Arabic display
        $companyTypesUI = [
            'publicFare' => ['كباتن الأجرة العامة', 'fa-taxi', 'text-success'],
            'privateFare' => ['كباتن الأجرة الخاصة', 'fa-car', 'text-info'],
            'specializedTransport' => ['كباتن النقل المتخصص', 'fa-bus', 'text-success'],
            'privateCarsResidents' => ['كباتن السيارات الخاصة للمقيمين', 'fa-user', 'text-primary'],
            'privateCarsCitizens' => ['كباتن السيارات الخاصة للمواطنين', 'fa-flag', 'text-warning'],
        ];
    @endphp

    {{-- ✅ Loop sends English keys to route --}}
    @foreach($companyTypesUI as $typeKey => [$title, $icon, $color])
        <a href="{{ route('showCurrentDrivers', $typeKey) }}" class="col-md-3 mb-3 text-decoration-none d-flex justify-content-center">
            <div class="card text-center shadow-lg" style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
                <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                    <i class="fa {{ $icon }} fa-4x {{ $color }} mb-3"></i>
                    <h6 class="card-title text-light" style="font-size: 1.1rem;">{{ $title }}</h6>
                </div>
            </div>
        </a>
    @endforeach

    {{-- Waiting Drivers --}}
    <a href="{{route('showWaitingDrivers')}}" class="col-md-3 mb-3 text-decoration-none d-flex justify-content-center">
        <div class="card text-center shadow-lg" style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-clock-o fa-4x text-warning mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.3rem;">بانتظار الموافقة</h6>
            </div>
        </div>
    </a>

    {{-- Archived Drivers --}}
    <a href="{{route('showarchiveDrivers')}}" class="col-md-3 mb-3 text-decoration-none d-flex justify-content-center">
        <div class="card text-center shadow-lg" style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-archive fa-4x text-danger mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.3rem;">الأرشيف</h6>
            </div>
        </div>
    </a>
</div>
@endsection
@section('js')
@endsection

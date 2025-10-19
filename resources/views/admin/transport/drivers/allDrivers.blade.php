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

<!-- row -->
<div class="row mb-30 d-flex justify-content-center">

    <!-- السائقين الحاليين -->

  @php
    $companyTypes = [
        'الاجرة العامة' => ['كباتن الأجرة العامة', 'fa-taxi', 'text-success'],
        'الاجرة الخاصة' => ['كباتن الأجرة الخاصة', 'fa-car', 'text-info'],
        'النقل المتخصص' => ['كباتن النقل المتخصص', 'fa-bus', 'text-success'],
        'السيارات الخاصة للمقيمين' => ['كباتن السيارات الخاصة للمقيمين', 'fa-user', 'text-primary'],
        'السيارات الخاصة للمواطنين' => ['كباتن السيارات الخاصة للمواطنين', 'fa-flag', 'text-warning'],
    ];
@endphp

    @foreach($companyTypes as $type => [$title, $icon, $color])
        <a href="{{ route('showCurrentDrivers', $type) }}" class="col-md-3 mb-3 text-decoration-none d-flex justify-content-center">
            <div class="card text-center shadow-lg" style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
                <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                    <i class="fa {{ $icon }} fa-4x {{ $color }} mb-3"></i>
                    <h6 class="card-title text-light" style="font-size: 1.1rem;">{{ $title }}</h6>
                </div>
            </div>
        </a>
    @endforeach




 
    <!-- السائقين بانتظار الموافقة -->
    <a href="{{route('showWaitingDrivers')}}" class="col-md-3 mb-3 text-decoration-none d-flex justify-content-center">
        <div class="card text-center shadow-lg" style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-clock-o fa-4x text-warning mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.3rem;">بانتظار الموافقة</h6>
            </div>
        </div>
    </a>

    <!-- الأرشيف -->
    <a href="{{route('showarchiveDrivers')}}" class="col-md-3 mb-3 text-decoration-none d-flex justify-content-center">
        <div class="card text-center shadow-lg" style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-archive fa-4x text-danger mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.3rem;">الأرشيف</h6>
            </div>
        </div>
    </a>

</div>
<!-- row closed -->

@endsection
@section('js')
@endsection

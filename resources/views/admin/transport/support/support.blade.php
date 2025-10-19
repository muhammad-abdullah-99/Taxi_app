@extends('layouts.master')
@section('title', 'إدارة الدعم الفني')

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">إدارة الدعم الفني</h4>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="row mb-30 d-flex justify-content-center">

    <a href="{{ route('support.tickets.byUserType', ['user_type' => 'Driver']) }}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
        <div class="card text-center d-flex align-items-center justify-content-center shadow-lg"
             style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-car fa-4x text-primary mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.3rem;">السائقين</h6>
            </div>
        </div>
    </a>

    <a href="{{ route('support.tickets.byUserType', ['user_type' => 'Passenger']) }}" class="col-md-3 mb-3 text-dark text-decoration-none d-flex justify-content-center">
        <div class="card text-center d-flex align-items-center justify-content-center shadow-lg"
             style="background-color: #2c3e50; border-radius: 20px; width: 220px; height: 160px;">
            <div class="card-body d-flex flex-column align-items-center justify-content-center p-2">
                <i class="fa fa-users fa-4x text-danger mb-3"></i>
                <h6 class="card-title text-light" style="font-size: 1.2rem;">العملاء</h6>
            </div>
        </div>
    </a>

</div>

@endsection

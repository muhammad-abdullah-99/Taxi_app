@extends('layouts.master')

@section('css')
@endsection

@section('title')
قائمة السائقين
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> قائمة السائقين الحالين </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <!-- <li class="breadcrumb-item">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addDriverModal">
                        <i class="fa fa-plus"></i> إضافة سائق جديد
                    </button>
                </li> -->
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- جدول السائقين -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>رقم الهوية</th>
                                <th>الجوال</th>
                                <th>الشركة</th>
                                <th>السيارة</th>
                                <th>المرفقات</th>
                                <th>كشف الركاب </th>
                                <th>قبل بواسطة </th>
                                <th>تاريخ القبول </th>
                                <!-- <th>الحالة</th> -->
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($drivers as $driver)

                            <tr>
                                <td>{{ $driver->name }}</td>
                                <td>{{ $driver->id_number }}</td>
                                <td>{{ $driver->mobile }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#show{{ $driver->id }}">
                                        عرض
                                    </button>

                                </td>

                                <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#show1{{ $driver->id }}">
                                        عرض
                                    </button>
                                </td>

                                <td>
                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#show2{{ $driver->id }}">
                                        عرض
                                    </button>
                                </td>

                                <td>
                                    <a href="{{ route('showAllPassengers', $driver->id) }}" class="btn btn-primary btn-sm">
                                        عرض
                                    </a>

                                </td>
                                <td>{{ $driver->user_name }}</td>
                                <td>
                                    {{ $driver->accept_driver ? \Carbon\Carbon::parse($driver->accept_driver)->format('Y-m-d') : '—' }}
                                </td>

                                <!-- <td> - </td> -->
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#active{{$driver->id}}">
                                        الغاء التنشيط
                                    </button>

                                    @if (Auth::check() && Auth::user()->role == 'مسؤول')

                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#archive{{$driver->id}}">
                                        <i class="fa fa-archive"></i>
                                    </button>
                                    @endif

                                </td>
                            </tr>
                            <!-- // archive-->
                            <div class="modal fade" id="archive{{ $driver->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"> استبعاد السائق </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('archiveDriver', $driver->id) }}" method="post">
                                            @csrf
                                            <h4 class="modal-body">هل أنت متاكد علي استبعاد السائق؟؟</h4>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                <button type="submit" class="btn btn-danger">استبعاد</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- // active -->
                            <div class="modal fade" id="active{{ $driver->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"> الغاء التنشيط </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('deactiveDriver', $driver->id) }}" method="post">
                                            @csrf
                                            <h4 class="modal-body">هل أنت متاكد علي الغا التنشيط ؟؟</h4>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                <button type="submit" class="btn btn-primary">موافقه</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- بيانات الشركة -->
                            <div class="modal fade" id="show{{ $driver->id }}" tabindex="-1" role="dialog" aria-labelledby="archiveCarModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="archiveCarModalLabel">بيانات الشركة</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>اسم الشركة:</strong> <span>{{ optional($driver->company)->company_name ?? 'غير متوفر' }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>موقع الشركة:</strong> <span>{{ optional($driver->company)->company_location ?? 'غير متوفر' }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>رقم التسجيل:</strong> <span>{{ optional($driver->company)->company_registration_number ?? 'غير متوفر' }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>نوع الشركة:</strong> <span>{{ optional($driver->company)->company_type ?? 'غير متوفر' }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- بيانات السيارة -->
                            <div class="modal fade" id="show1{{ $driver->id }}" tabindex="-1" role="dialog" aria-labelledby="archiveCarModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="archiveCarModalLabel">بيانات السيارة</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>نوع السيارة:</strong> <span>{{ optional($driver->vehicle)->car_type ?? 'غير متوفر' }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>عدد الركاب:</strong> <span>{{ optional($driver->vehicle)->number_of_passengers ?? 'غير متوفر' }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>موديل السيارة:</strong> <span>{{ optional($driver->vehicle)->car_model ?? 'غير متوفر' }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>لون السيارة:</strong> <span>{{ optional($driver->vehicle)->car_color ?? 'غير متوفر' }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>رقم اللوحة:</strong> <span>{{ optional($driver->vehicle)->licence_plate_number ?? 'غير متوفر' }}</span>
                                                </li>
                                             
                                                <li class="list-group-item">
                                                    <strong>صورة السيارة:</strong><br>
                                                    @if(optional($driver->vehicle)->car_image)
                                                    <img src="{{ asset('storage/' . $driver->vehicle->car_image) }}" alt="Car Image" class="img-fluid" />
                                                    @else
                                                    <span>غير متوفر</span>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- مرفقات السائق -->
                            <div class="modal fade" id="show2{{ $driver->id }}" tabindex="-1" role="dialog" aria-labelledby="archiveDriverModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="archiveDriverModalLabel">مرفقات السائق</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>اسم السائق:</strong> <span>{{ $driver->name }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>صورة السائق:</strong><br>
                                                    @if($driver->driver_image)
                                                    <img src="{{ asset('storage/' . $driver->driver_image) }}" alt="Driver Image" class="img-fluid" />
                                                    @else
                                                    <span>غير متوفر</span>
                                                    @endif
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>الهوية:</strong><br>
                                                    @if($driver->id_image)
                                                    <img src="{{ asset('storage/' . $driver->id_image) }}" alt="ID Image" class="img-fluid" />
                                                    @else
                                                    <span>غير متوفر</span>
                                                    @endif
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>رخصة القيادة:</strong><br>
                                                    @if($driver->license_image_url)
                                                    <img src="{{ asset('storage/' . $driver->license_image_url) }}" alt="License Image" class="img-fluid" />
                                                    @else
                                                    <span>غير متوفر</span>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection
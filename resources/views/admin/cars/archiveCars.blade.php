@extends('layouts.master')

@section('css')
@endsection

@section('title')
ارشيف السيارات
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">إدارة السيارات</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <!-- <li class="breadcrumb-item">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addCarModal" style="font-size: 18px; font-family:Amiri; line-height: 1.2;">
                        <i class="fa fa-plus"></i> - إضافة سيارة جديدة
                    </button>
                </li> -->
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

<!-- عرض الأخطاء -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<!-- نهاية الأخطاء -->

<!-- نافذة إضافة سيارة -->
<div class="modal fade" id="addCarModal" tabindex="-1" role="dialog" aria-labelledby="addCarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCarModalLabel">إضافة سيارة جديدة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storeCar') }}" method="post">
                    @csrf
                    <label for="type">نوع المركب </label>
                    <input type="text" name="type" class="form-control" placeholder="النوع">
                    <br>
                    <label for="name">الموديل</label>
                    <input type="text" name="name" class="form-control" placeholder="الاسم">
                    <br>
                  
                    <label for="plate_number">رقم اللوحة</label>
                    <input type="text" name="plate_number" class="form-control" placeholder="رقم اللوحة">
                    <br>
                    <label for="card_number">   رقم بطاقةالجمرك</label>
                    <input type="text" name="card_number" class="form-control" placeholder="رقم البطاقة">
                    <br>
                    <label for="serial_number">الرقم التسلسلي</label>
                    <input type="text" name="serial_number" class="form-control" placeholder="الرقم التسلسلي">
                    <br>
                    <label for="color">اللون</label>
                    <input type="text" name="color" class="form-control" placeholder="اللون">
                    <br>
                    <label for="status">الحالة</label>
                    <select name="status" class="form-control">
                        <option value="عاملة">عاملة</option>
                        <option value="متعطلة">متعطلة</option>
                        <option value="انتظار">انتظار</option>
                        <option value="خارج عن الخدمة">خارج عن الخدمة</option>

                    </select>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- جدول عرض السيارات -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>النوع</th>
                                <th>رقم اللوحة</th>
                                <th> بيانات السيارة</th>

                                <th>بيانات التسليم والتسلم</th>

                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cars as $car)
                            <tr>
                                <td>{{ $car->name }}</td>
                                <td>{{ $car->type }}</td>
                                <td>{{ $car->plate_number }}</td>
                                <td><button type="button" class="btn btn-info " data-toggle="modal" data-target="#showdata{{ $car->id }}">
                                عرض  </button></td>

                                <td><a href="{{route('showHandover',$car->id)}}" class="btn btn-sm btn-info" style="font-size:15px;">عرض</a></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $car->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    @if (Auth::check() && Auth::user()->role == 'مسؤول')
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#archive{{ $car->id }}">
                                        <i class="fa fa-undo"></i>
                                    </button>
                                    @endif
                                </td>
                            </tr>

                              <!-- نافذة بيانات  السيارة  -->
                              <div class="modal fade" id="showdata{{ $car->id }}" tabindex="-1" role="dialog" aria-labelledby="archiveCarModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="archiveCarModalLabel">بيانات السيارة </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group">
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>رقم بطاقة الجمرك:</strong> <span>{{ $car->card_number }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>الرقم التسلسلي:</strong> <span>{{ $car->serial_number }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>اللون:</strong> <span>{{ $car->color }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>الحالة:</strong> <span>{{ $car->status }}</span>
                                                </li>
                                            </ul>

                                        </div>
                                    </div> 
                                </div>
                            </div>

                         <!-- نافذة تعديل سيارة -->
<div class="modal fade" id="edit{{ $car->id }}" tabindex="-1" aria-labelledby="editCarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل بيانات السيارة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('updateCar', $car->id) }}" method="post">
                    @csrf
                    <label for="type">نوع المركبة</label>
                    <input type="text" name="type" class="form-control" value="{{ $car->type }}">
                    <br>
                    <label for="name">الموديل</label>
                    <input type="text" name="name" class="form-control" value="{{ $car->name }}">
                    <br>
                    <label for="plate_number">رقم اللوحة</label>
                    <input type="text" name="plate_number" class="form-control" value="{{ $car->plate_number }}">
                    <br>
                    <label for="card_number">   رقم بطاقةالجمرك</label>
                    <input type="text" name="card_number" class="form-control" value="{{ $car->card_number }}">
                    <br>
                    <label for="serial_number">الرقم التسلسلي</label>
                    <input type="text" name="serial_number" class="form-control" value="{{ $car->serial_number }}">
                    <br>
                    <label for="color">اللون</label>
                    <input type="text" name="color" class="form-control" value="{{ $car->color }}">
                    <br>
                    <label for="status">الحالة</label>
                    <select name="status" class="form-control">
                        <option value="عاملة" {{ $car->status == 'عاملة' ? 'selected' : '' }}>عاملة</option>
                        <option value="متعطلة" {{ $car->status == 'متعطلة' ? 'selected' : '' }}>متعطلة</option>
                        <option value="انتظار" {{ $car->status == 'انتظار' ? 'selected' : '' }}>انتظار</option>
                        <option value="خارج عن الخدمة" {{ $car->status == 'خارج عن الخدمة' ? 'selected' : '' }}>خارج عن الخدمة</option>


                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary">تحديث</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- نافذة أرشفة سيارة -->
<div class="modal fade" id="archive{{ $car->id }}" tabindex="-1" role="dialog" aria-labelledby="archiveCarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="archiveCarModalLabel">استعادة السيارة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('unarchiveCar', $car->id) }}" method="post">
                    @csrf
                    <p>هل أنت متأكد من أنك تريد استعادة هذه السيارة؟</p>
                    <button type="submit" class="btn btn-warning">استعادة</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                </form>
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
@endsection  الارشيف يبقي موديل والايديت فيه كل التعديلات 
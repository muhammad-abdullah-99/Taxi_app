@extends('layouts.master')

@section('css')
@endsection

@section('title')
جميع السيارات
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
                <li class="breadcrumb-item">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addCarModal" style="font-size: 16px; font-family:Amiri; line-height: 1.2;">
                        <i class="fa fa-plus"></i> - إضافة سيارة جديدة
                    </button>
                </li>
            </ol>
        </div>
    </div>
</div>

<div class="p-3 m-2 d-flex flex-wrap gap-3">
    @php
        $statuses = [
            'all' => 'عرض الكل',
            'عاملة' => 'عاملة',
            'متعطلة' => 'متعطلة',
            'انتظار' => 'انتظار',
            'خارج عن الخدمة' => 'خارج عن الخدمة',
        ];
    @endphp

    @foreach ($statuses as $key => $label)
        @php
            $isActive = request('status', 'all') == $key;
            $count = $key === 'all' ? $totalCount : ($statusesCount[$key] ?? 0);
        @endphp

        <div class="d-flex align-items-center gap-2 border rounded p-2 bg-light">
            {{-- زر الفلترة --}}
            <a href="{{ route('getCar', ['status' => $key]) }}"
                class="btn btn-sm {{ $isActive ? 'btn-primary' : 'btn-outline-primary' }}">
                {{ $label }} ({{ $count }})
            </a>

            {{-- زر التقرير --}}
            <a href="{{ route('cars.report', ['status' => $key]) }}" target="_blank"
                class="btn btn-sm btn-success">
                تقرير
            </a>
        </div>
    @endforeach
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
                    <label for="type">نوع المركب</label>
                    <input type="text" name="type" class="form-control" placeholder="النوع">
                    <br>

                    <label for="name">الموديل</label>
                    <input type="text" name="name" class="form-control" placeholder="الموديل">
                    <br>

                    <label for="plate_number">رقم اللوحة</label>
                    <input type="text" name="plate_number" class="form-control" placeholder="رقم اللوحة">
                    <br>

                    <label for="card_number">رقم بطاقة الجمرك</label>
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

                    <!-- نوع السعر -->
                    <label for="type_price">نوع السعر</label>
                    <select name="type_price" class="form-control">
                        <option value="شهري">شهري</option>
                        <option value="يومي">يومي</option>
                    </select>
                    <br>

                    <!-- قيمة السعر -->
                    <label for="price">قيمة السعر</label>
                    <input type="number" name="price" class="form-control" placeholder="مثال: 500">
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
                                <th>نوع المركبة</th>
                                <th>الموديل</th>
                                <th>رقم اللوحة</th>
                                <th> بيانات السيارة</th>

                                <th>بيانات التسليم والتسلم</th>
                                <th>المستندات</th>

                                <th> بواسطة </th>

                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cars as $car)
                            <tr>
                                <td>{{ $car->name }}</td>
                                <td>{{ $car->type }}</td>
                                <td>{{ $car->plate_number }}</td>
                                <td>
                                    <span class="car-status" style="display: none;">{{ $car->status }}</span>
                                    <button type="button" class="btn btn-info " data-toggle="modal" data-target="#showdata{{ $car->id }}">عرض</button>
                                </td>

                                <td><a href="{{route('showHandover',$car->id)}}" class="btn btn-sm btn-info" style="font-size:15px;"> عرض </a></td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#carModalDocs{{ $car->id }}">
                                        عرض
                                    </button>
                                </td>

                                <!-- مودال معلومات السيارة -->
                                <div class="modal fade" id="carModalDocs{{ $car->id }}" tabindex="-1" role="dialog" aria-labelledby="carModalDocsLabel{{ $car->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="carModalDocsLabel{{ $car->id }}"> مستندات السيارة </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- التواريخ مع زر التحديث -->
                                                @foreach([
                                                'saer_expire_at' => 'انتهاء رخصة السير',
                                                'tamen_expire_at' => 'انتهاء التأمين',
                                                'fahs_expire_at' => 'انتهاء الفحص',
                                                'cart_expire_at' => 'انتهاء البطاقة',
                                                'zaet_expire_at' => 'انتهاء الزيت',
                                                'tafwed_expire_at' => 'انتهاء التفويض'
                                                ] as $field => $label)
                                                <div class="mb-2 d-flex justify-content-between border-bottom pb-2 align-items-center">
                                                    <div><strong>{{ $label }}:</strong> {{ $car->$field ?? 'غير محدد' }}</div>
                                                    <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#updateModal_{{ $field }}_{{ $car->id }}">
                                                        تحديث
                                                    </button>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @foreach([
                                'saer_expire_at' => 'انتهاء رخصة السير',
                                'tamen_expire_at' => 'انتهاء التأمين',
                                'fahs_expire_at' => 'انتهاء الفحص',
                                'cart_expire_at' => 'انتهاء البطاقة',
                                'zaet_expire_at' => 'انتهاء الزيت',
                                'tafwed_expire_at' => 'انتهاء التفويض'
                                ] as $field => $label)
                                <div class="modal fade" id="updateModal_{{ $field }}_{{ $car->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel_{{ $field }}_{{ $car->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form method="POST" action="{{ route('cars.update_expiry', [$car->id]) }}">
                                            @csrf
                                            <input type="hidden" name="field" value="{{ $field }}">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel_{{ $field }}_{{ $car->id }}">تحديث {{ $label }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="value_{{ $field }}_{{ $car->id }}">التاريخ الجديد:</label>
                                                    <input type="date" name="value" class="form-control" id="value_{{ $field }}_{{ $car->id }}" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endforeach




                                <td>{{ $car->user_name }}</td>

                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $car->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    @if (Auth::check() && Auth::user()->role == 'مسؤول')
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#archive{{ $car->id }}">
                                        <i class="fa fa-archive"></i>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            <!-- نافذة بيانات السيارة -->
                            <div class="modal fade" id="showdata{{ $car->id }}" tabindex="-1" role="dialog" aria-labelledby="archiveCarModalLabel" aria-hidden="true">
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
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>نوع السعر:</strong> <span>{{ $car->type_price }}</span>
                                                </li>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <strong>قيمة السعر:</strong> <span>{{ $car->price }}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- نافذة تعديل سيارة -->
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

                                                <label for="card_number">رقم بطاقة الجمرك</label>
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

                                                <!-- نوع السعر -->
                                                <label for="type_price">نوع السعر</label>
                                                <select name="type_price" class="form-control">
                                                    <option value="شهري" {{ $car->type_price == 'شهري' ? 'selected' : '' }}>شهري</option>
                                                    <option value="يومي" {{ $car->type_price == 'يومي' ? 'selected' : '' }}>يومي</option>
                                                </select>
                                                <br>

                                                <!-- قيمة السعر -->
                                                <label for="price">قيمة السعر</label>
                                                <input type="number" name="price" class="form-control" value="{{ $car->price }}">
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
                                            <h5 class="modal-title" id="archiveCarModalLabel">أرشفة السيارة</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('archiveCar', $car->id) }}" method="post">
                                                @csrf
                                                <p>هل أنت متأكد من أنك تريد أرشفة هذه السيارة؟</p>
                                                <button type="submit" class="btn btn-warning">أرشفة</button>
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
@endsection
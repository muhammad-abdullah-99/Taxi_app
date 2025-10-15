@extends('layouts.master')

@section('css')
@endsection

@section('title')
الباقات
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">الباقات</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">
                    <div>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addPackageModal" style="font-size: 18px; font-family:Amiri; line-height: 1.2;">
                            <i class="fa fa-plus"></i> - إضافة باقة جديدة
                        </button>
                    </div>
                </li>
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

<!-- نافذة إضافة باقة جديدة -->
<div class="modal fade" id="addPackageModal" tabindex="-1" role="dialog" aria-labelledby="addPackageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPackageModalLabel">إضافة باقة جديدة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storePackage') }}" method="post">
                    @csrf
                    <input type="text" name="name" class="form-control" placeholder="اسم الباقة" required>
                    <br>
                    <input type="text" name="type" class="form-control" placeholder="نوع الباقة" required>
                    <br>
                    <input type="number" name="cost" class="form-control" placeholder="السعر" required>
                    <br>
                    <input type="number" name="days" class="form-control" placeholder="عدد الأيام" required>
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

<!-- جدول الباقات -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>نوع الباقة</th>
                                <th>التكلفة</th>
                                <th>عدد الأيام</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Types as $type)
                            <tr>
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->type }}</td>
                                <td>{{ $type->cost }}</td>
                                <td>{{ $type->days }}</td>
                                <td>
                                    {{ $type->is_active ? 'نشط' : 'غير نشط' }}
                                </td>
                                <td>
                                    <!-- زر تعديل الباقة -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $type->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <!-- نافذة تعديل الباقة -->
                                    <div class="modal fade" id="edit{{ $type->id }}" tabindex="-1" aria-labelledby="editPackageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">تعديل الباقة</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('updatePackage', $type->id) }}" method="post">
                                                        @csrf
                                                        <input type="text" name="name" class="form-control" value="{{ $type->name }}">
                                                        <br>
                                                        <input type="text" name="type" class="form-control" value="{{ $type->type }}">
                                                        <br>
                                                        <input type="number" name="cost" class="form-control" value="{{ $type->cost }}">
                                                        <br>
                                                        <input type="number" name="days" class="form-control" value="{{ $type->days }}">
                                                        <br>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                            <button type="submit" class="btn btn-primary">تحديث</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- زر تغير الحالة -->

                                    <button type="button" class="btn btn-sm {{ $type->is_active ? 'btn-danger' : 'btn-success' }}"
                                        data-toggle="modal" data-target="#toggle{{ $type->id }}">
                                        <i class="fa {{ $type->is_active ? 'fa-lock' : 'fa-unlock' }}"></i>
                                    </button>

                                    <!-- نافذة حذف الباقة -->
                                    <div class="modal fade" id="toggle{{ $type->id }}" tabindex="-1" aria-labelledby="deletePackageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">حذف الباقة</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('toggleActive', $type->id) }}" method="post">
                                                    @csrf
                                                    <h4 class="modal-body">
                                                        هل أنت متأكد من أنك تغير حالة هذه الباقة؟
                                                    </h4>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                        <button type="submit" class="btn btn-primary">تغير الحالة </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
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
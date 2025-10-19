@extends('layouts.master')

@section('css')
@endsection

@section('title')
صيانة السيارة
@stop

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">صيانة السيارة</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">
                    <div>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMaintenanceModal">
                            <i class="fa fa-plus"></i> - إضافة صيانة جديدة
                        </button>
                    </div>
                </li>
            </ol>
        </div>
    </div>
</div>
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

<!-- نافذة إضافة صيانة جديدة -->
<div class="modal fade" id="addMaintenanceModal" tabindex="-1" role="dialog" aria-labelledby="addMaintenanceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMaintenanceModalLabel">إضافة صيانة جديدة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storeCarMaintenance', [$car->id, $employee->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="maintenance_type">نوع الصيانة</label>
                        <input type="text" name="maintenance_type" class="form-control" placeholder="نوع الصيانة" required>
                    </div>
                    <div class="form-group">
                        <label for="odometer_reading"> رقم العداد</label>
                        <input type="number" name="odometer_reading" class="form-control" placeholder="رقم العداد وقت الصيانة" required>
                    </div>
                    <div class="form-group">
                        <label for="invoice_image">صورة الفاتورة</label>
                        <input type="file" name="invoice_image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="notes">ملاحظات</label>
                        <textarea name="notes" class="form-control" rows="3" placeholder="ملاحظات"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- عرض بيانات الصيانة -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th>نوع الصيانة</th>
                                <th>رقم العداد</th>
                                <th>صورة الفاتورة</th>
                                <th>الملاحظات</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($maintenances as $maintenance)
                            <tr>
                                <td>{{ $maintenance->maintenance_type }}</td>
                                <td>{{ $maintenance->odometer_reading }}</td>
                                <td>
                                    @if($maintenance->invoice_image)
                                    <a href="{{ asset('storage/' . $maintenance->invoice_image) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $maintenance->invoice_image) }}" alt="Invoice Image" width="100">
                                    </a>
                                    @else
                                    لا توجد صورة
                                    @endif
                                </td>

                                <td>{{ $maintenance->notes }}</td>
                                <td>
                                    <!-- زر تعديل الصيانة -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editMaintenanceModal{{ $maintenance->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <!-- نافذة تعديل الصيانة -->
                                    <div class="modal fade" id="editMaintenanceModal{{ $maintenance->id }}" tabindex="-1" aria-labelledby="editMaintenanceModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">تعديل الصيانة</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('updateCarMaintenance', $maintenance->id) }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="maintenance_type">نوع الصيانة</label>
                                                            <input type="text" name="maintenance_type" class="form-control" value="{{ $maintenance->maintenance_type }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="odometer_reading">رقم العداد</label>
                                                            <input type="number" name="odometer_reading" class="form-control" value="{{ $maintenance->odometer_reading }}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="invoice_image">صورة الفاتورة</label>
                                                            <input type="file" name="invoice_image" class="form-control">
                                                            @if($maintenance->invoice_image)
                                                            <img src="{{ asset('storage/' . $maintenance->invoice_image) }}" alt="Invoice Image" width="100">
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="notes">ملاحظات</label>
                                                            <textarea name="notes" class="form-control" rows="3">{{ $maintenance->notes }}</textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                            <button type="submit" class="btn btn-primary">تحديث</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- زر حذف الصيانة -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteMaintenanceModal{{ $maintenance->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <!-- نافذة حذف الصيانة -->
                                    <div class="modal fade" id="deleteMaintenanceModal{{ $maintenance->id }}" tabindex="-1" aria-labelledby="deleteMaintenanceModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">حذف الصيانة</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('deleteCarMaintenance', $maintenance->id) }}" method="post">
                                                    @csrf
                                                    <h4 class="modal-body">
                                                        هل أنت متأكد من أنك تريد حذف هذه الصيانة؟
                                                    </h4>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                        <button type="submit" class="btn btn-primary">حذف</button>
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
<!-- يمكن إضافة أي جافا سكريبت هنا -->
@endsection
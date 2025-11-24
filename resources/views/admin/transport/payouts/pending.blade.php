@extends('layouts.master')

@section('title')
دفعات السائقين المعلقة
@stop

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">دفعات السائقين المعلقة</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
                <li class="breadcrumb-item active">الدفعات المعلقة</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif

<!-- Quick Navigation -->
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex flex-wrap gap-3">
            <div class="card shadow-sm border rounded text-center p-3" style="min-width: 200px; background-color: #ffc107;">
                <div class="mb-2 fw-bold">قيد الانتظار ({{ $payments->count() }})</div>
                <a href="{{ route('dashboard.pending') }}" class="btn btn-sm btn-warning">
                    <i class="fa fa-clock-o"></i> عرض
                </a>
            </div>

            <div class="card shadow-sm border rounded text-center p-3" style="min-width: 200px; background-color: #6c757d;">
                <div class="mb-2 fw-bold text-white">السجل الكامل</div>
                <a href="{{ route('dashboard.history') }}" class="btn btn-sm btn-secondary text-white">
                    <i class="fa fa-history"></i> عرض
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Statistics -->
<div class="row mb-3">
    <div class="col-md-4">
        <div class="card shadow-sm border">
            <div class="card-body text-center">
                <h5 class="text-primary">{{ $payments->count() }}</h5>
                <p class="mb-0">دفعات معلقة</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border">
            <div class="card-body text-center">
                <h5 class="text-success">{{ number_format($totalPending, 2) }} ريال</h5>
                <p class="mb-0">إجمالي المبالغ للسائقين</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border">
            <div class="card-body text-center">
                <h5 class="text-info">{{ number_format($payments->sum('operating_fee'), 2) }} ريال</h5>
                <p class="mb-0">إجمالي الرسوم</p>
            </div>
        </div>
    </div>
</div>

<!-- Main Table -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card h-100">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>رقم الدفعة</th>
                                <th>اسم السائق</th>
                                <th>رقم الجوال</th>
                                <th>تفاصيل الرحلة</th>
                                <th>مبلغ الرحلة</th>
                                <th>الرسوم</th>
                                <th>مبلغ السائق</th>
                                <th>تاريخ الرحلة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $index => $payment)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><span class="badge badge-info">{{ $payment->payment_id }}</span></td>
                                    <td><strong>{{ $payment->driver->name ?? '-' }}</strong></td>
                                    <td>{{ $payment->driver->mobile ?? '-' }}</td>
                                    <td>
                                        <small>
                                            <strong>من:</strong> {{ $payment->travel->from ?? '-' }}<br>
                                            <strong>إلى:</strong> {{ $payment->travel->to ?? '-' }}
                                        </small>
                                    </td>
                                    <td>{{ number_format($payment->trip_amount, 2) }} ريال</td>
                                    <td><span class="badge badge-warning">{{ number_format($payment->operating_fee, 2) }} ريال</span></td>
                                    <td><strong style="color: #28a745; font-size: 1.1rem;">{{ number_format($payment->driver_amount, 2) }} ريال</strong></td>
                                    <td>{{ $payment->trip_completed_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#markPaidModal{{ $payment->id }}">
                                            <i class="fa fa-check"></i> تأكيد الدفع
                                        </button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#cancelModal{{ $payment->id }}">
                                            <i class="fa fa-times"></i> إلغاء
                                        </button>
                                    </td>
                                </tr>

                                <!-- Mark as Paid Modal -->
                                <div class="modal fade" id="markPaidModal{{ $payment->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{ route('dashboard.mark-paid', $payment->payment_id) }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header bg-success text-white">
                                                    <h5 class="modal-title">تأكيد الدفع</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-warning">
                                                        <strong>تنبيه:</strong> تأكد من إتمام التحويل البنكي أولاً!
                                                    </div>
                                                    
                                                    <div class="mb-3 p-3 border rounded bg-light">
                                                        <div class="row">
                                                            <div class="col-6"><strong>اسم السائق:</strong></div>
                                                            <div class="col-6">{{ $payment->driver->name ?? '-' }}</div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-6"><strong>رقم الجوال:</strong></div>
                                                            <div class="col-6">{{ $payment->driver->mobile ?? '-' }}</div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-6"><strong>المبلغ المحول:</strong></div>
                                                            <div class="col-6"><span class="text-success h5">{{ number_format($payment->driver_amount, 2) }} ريال</span></div>
                                                        </div>
                                                    </div>

                                                    <!-- ❌ REMOVE THESE FIELDS -->
                                                    <!--
                                                    <div class="form-group mt-3">
                                                        <label>رقم مرجع التحويل البنكي: <span class="text-danger">*</span></label>
                                                        <input type="text" name="admin_reference" class="form-control" placeholder="أدخل رقم المرجع من تطبيق البنك" required>
                                                        <small class="form-text text-muted">الرقم المرجعي الموجود في إيصال التحويل</small>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>ملاحظات (اختياري):</label>
                                                        <textarea name="admin_notes" class="form-control" rows="3" placeholder="أي ملاحظات إضافية..."></textarea>
                                                    </div>
                                                    -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fa fa-check"></i> تأكيد الدفع
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Cancel Modal -->
                                <div class="modal fade" id="cancelModal{{ $payment->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog" role="dialog">
                                        <form action="{{ route('dashboard.cancel', $payment->payment_id) }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title">إلغاء الدفعة</h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-danger">
                                                        <strong>تحذير:</strong> هل أنت متأكد من إلغاء هذه الدفعة؟
                                                    </div>

                                                    <!-- ❌ REMOVE THIS FIELD -->
                                                    <!--
                                                    <div class="form-group">
                                                        <label>سبب الإلغاء: <span class="text-danger">*</span></label>
                                                        <textarea name="reason" class="form-control" rows="4" required placeholder="اذكر السبب..."></textarea>
                                                    </div>
                                                    -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-times"></i> تأكيد الإلغاء
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">
                                        <div class="p-4">
                                            <i class="fa fa-check-circle fa-3x text-success mb-3"></i>
                                            <p class="text-muted h5">لا توجد دفعات معلقة حالياً</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
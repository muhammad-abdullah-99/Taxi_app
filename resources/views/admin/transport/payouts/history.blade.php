@extends('layouts.master')

@section('title')
سجل دفعات السائقين
@stop

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">سجل دفعات السائقين</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a></li>
                <li class="breadcrumb-item active">سجل الدفعات</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')

<!-- Quick Navigation -->
<div class="row mb-3">
    <div class="col-12">
        <div class="d-flex flex-wrap gap-3">
            <div class="card shadow-sm border rounded text-center p-3" style="min-width: 200px; background-color: #ffc107;">
                <div class="mb-2 fw-bold">قيد الانتظار</div>
                <a href="{{ route('dashboard.pending') }}" class="btn btn-sm btn-warning">
                    <i class="fa fa-clock-o"></i> عرض
                </a>
            </div>

            <div class="card shadow-sm border rounded text-center p-3" style="min-width: 200px; background-color: #6c757d;">
                <div class="mb-2 fw-bold text-white">السجل الكامل ({{ $payments->total() }})</div>
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
                <h5 class="text-primary">{{ $payments->total() }}</h5>
                <p class="mb-0">إجمالي الدفعات</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border">
            <div class="card-body text-center">
                <h5 class="text-success">{{ number_format($totalPaid, 2) }} ريال</h5>
                <p class="mb-0">إجمالي المدفوع للسائقين</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm border">
            <div class="card-body text-center">
                <h5 class="text-info">{{ number_format($totalFees, 2) }} ريال</h5>
                <p class="mb-0">إجمالي الرسوم</p>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="row mb-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="GET" action="{{ route('dashboard.history') }}" class="form-inline">
                    <div class="form-group mx-2">
                        <label for="from_date" class="mr-2">من تاريخ:</label>
                        <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
                    </div>

                    <div class="form-group mx-2">
                        <label for="to_date" class="mr-2">إلى تاريخ:</label>
                        <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
                    </div>

                    <button type="submit" class="btn btn-primary mx-2">
                        <i class="fa fa-filter"></i> تصفية
                    </button>
                    <a href="{{ route('dashboard.history') }}" class="btn btn-secondary">
                        <i class="fa fa-refresh"></i> إعادة تعيين
                    </a>
                </form>
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
                                <th>السائق</th>
                                <th>تفاصيل الرحلة</th>
                                <th>مبلغ الرحلة</th>
                                <th>الرسوم</th>
                                <th>مبلغ السائق</th>
                                <th>تاريخ الدفع</th>
                                <th>تم بواسطة</th>
                                <th>تفاصيل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $index => $payment)
                                <tr>
                                    <td>{{ ($payments->currentPage() - 1) * $payments->perPage() + $index + 1 }}</td>
                                    <td><span class="badge badge-success">{{ $payment->payment_id }}</span></td>
                                    <td>
                                        <strong>{{ $payment->driver->name ?? '-' }}</strong><br>
                                        <small>{{ $payment->driver->mobile ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <small>
                                            <strong>من:</strong> {{ $payment->travel->from ?? '-' }}<br>
                                            <strong>إلى:</strong> {{ $payment->travel->to ?? '-' }}
                                        </small>
                                    </td>
                                    <td>{{ number_format($payment->trip_amount, 2) }} ريال</td>
                                    <td><span class="badge badge-warning">{{ number_format($payment->operating_fee, 2) }} ريال</span></td>
                                    <td><strong style="color: #28a745;">{{ number_format($payment->driver_amount, 2) }} ريال</strong></td>
                                    <td>{{ $payment->paid_at ? $payment->paid_at->format('Y-m-d H:i') : '-' }}</td>
                                    <td>{{ $payment->markedByAdmin->name ?? '-' }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailsModal{{ $payment->id }}">
                                            <i class="fa fa-eye"></i> عرض
                                        </button>
                                    </td>
                                </tr>

                                <!-- Details Modal -->
                                <div class="modal fade" id="detailsModal{{ $payment->id }}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-success text-white">
                                                <h5 class="modal-title">تفاصيل الدفعة</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <!-- Payment Info -->
                                                    <div class="col-md-6">
                                                        <h6 class="text-primary">معلومات الدفعة</h6>
                                                        <hr>
                                                        <div class="mb-2 d-flex justify-content-between border-bottom pb-2">
                                                            <strong>رقم الدفعة:</strong>
                                                            <span class="badge badge-success">{{ $payment->payment_id }}</span>
                                                        </div>
                                                        <div class="mb-2 d-flex justify-content-between border-bottom pb-2">
                                                            <strong>مبلغ الرحلة:</strong>
                                                            <span>{{ number_format($payment->trip_amount, 2) }} ريال</span>
                                                        </div>
                                                        <div class="mb-2 d-flex justify-content-between border-bottom pb-2">
                                                            <strong>الرسوم:</strong>
                                                            <span class="badge badge-warning">{{ number_format($payment->operating_fee, 2) }} ريال</span>
                                                        </div>
                                                        <div class="mb-2 d-flex justify-content-between border-bottom pb-2">
                                                            <strong>مبلغ السائق:</strong>
                                                            <span class="text-success h5">{{ number_format($payment->driver_amount, 2) }} ريال</span>
                                                        </div>
                                                    </div>

                                                    <!-- Driver Info -->
                                                    <div class="col-md-6">
                                                        <h6 class="text-info">معلومات السائق</h6>
                                                        <hr>
                                                        <div class="mb-2 d-flex justify-content-between border-bottom pb-2">
                                                            <strong>الاسم:</strong>
                                                            <span>{{ $payment->driver->name ?? '-' }}</span>
                                                        </div>
                                                        <div class="mb-2 d-flex justify-content-between border-bottom pb-2">
                                                            <strong>رقم الجوال:</strong>
                                                            <span>{{ $payment->driver->mobile ?? '-' }}</span>
                                                        </div>
                                                    </div>

                                                    <!-- Trip Info -->
                                                    <div class="col-md-12 mt-3">
                                                        <h6 class="text-secondary">معلومات الرحلة</h6>
                                                        <hr>
                                                        <div class="mb-2 d-flex justify-content-between border-bottom pb-2">
                                                            <strong>من:</strong>
                                                            <span>{{ $payment->travel->from ?? '-' }}</span>
                                                        </div>
                                                        <div class="mb-2 d-flex justify-content-between border-bottom pb-2">
                                                            <strong>إلى:</strong>
                                                            <span>{{ $payment->travel->to ?? '-' }}</span>
                                                        </div>
                                                        <div class="mb-2 d-flex justify-content-between border-bottom pb-2">
                                                            <strong>تاريخ اكتمال الرحلة:</strong>
                                                            <span>{{ $payment->trip_completed_at->format('Y-m-d H:i:s') }}</span>
                                                        </div>
                                                    </div>

                                                    <!-- Admin Info -->
                                                    <div class="col-md-12 mt-3">
                                                        <h6 class="text-warning">معلومات التحويل</h6>
                                                        <hr>
                                                        <div class="mb-2 d-flex justify-content-between border-bottom pb-2">
                                                            <strong>تاريخ الدفع:</strong>
                                                            <span>{{ $payment->paid_at ? $payment->paid_at->format('Y-m-d H:i:s') : '-' }}</span>
                                                        </div>
                                                        <div class="mb-2 d-flex justify-content-between border-bottom pb-2">
                                                            <strong>تم بواسطة:</strong>
                                                            <span>{{ $payment->markedByAdmin->name ?? '-' }}</span>
                                                        </div>
                                                        @if($payment->admin_notes)
                                                        <div class="mb-2">
                                                            <strong>ملاحظات الإدارة:</strong>
                                                            <p class="bg-light p-2 rounded mt-1">{{ $payment->admin_notes }}</p>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center">
                                        <p class="text-muted">لا توجد سجلات</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($payments->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $payments->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
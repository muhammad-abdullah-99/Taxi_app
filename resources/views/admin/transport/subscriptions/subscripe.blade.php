@extends('layouts.master')

@section('css')
@endsection

@section('title')
الاشتراكات
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">الاشتراكات</h4>
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

<!-- جدول الاشتراكات -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th>اسم السائق</th>
                                <th>نوع الخدمة</th>
                                <th>تاريخ الاشتراك </th>
                                <th>المدة المتبقية</th>
                                <th>بيانات الشركة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subscriptions as $subscription)
                            <tr>
                                <td>{{ $subscription->appUser->name ?? 'غير متوفر' }}</td>
                                <td>{{ $subscription->package->name ?? 'غير متوفر' }}</td>
                                <td>{{ $subscription->created_at->format('Y-m-d') }}</td>
                                <td>
                                    @php
                                        $expireDate = \Carbon\Carbon::parse($subscription->expire_at)->endOfDay();
                                        $remainingDays = now()->startOfDay()->diffInDays($expireDate, false);
                                    @endphp
                                    @if ($remainingDays > 0)
                                        {{ intval($remainingDays) }} يوم
                                    @elseif ($remainingDays === 0)
                                        <span class="text-warning">ينتهي اليوم</span>
                                    @else
                                        <span class="text-danger">منتهية</span>
                                    @endif
                                </td>
                                <td>{{ $subscription->appUser->company->company_name ?? 'غير متوفر' }}</td>
                                <td>
                                    @if(optional($subscription->package)->name === 'كشف ركاب')
                                        <button class="btn btn-sm btn-primary openPassengerModal"
                                            data-user="{{ $subscription->appUser->id }}">
                                            إصدار كشف ركاب
                                        </button>
                                    @else
                                        -
                                    @endif
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

<!-- مودال كشف الركاب -->
<div class="modal fade" id="passengerModal" tabindex="-1" role="dialog" aria-labelledby="passengerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('passengers.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="passengerModalLabel">إصدار كشف ركاب</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="user_id" id="user_id">

                    <div class="form-group">
                        <label>من</label>
                        <input type="text" name="from" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>إلى</label>
                        <input type="text" name="to" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>عدد الركاب</label>
                        <input type="number" name="count" id="passengerCount" class="form-control" min="1" required>
                    </div>

                    <div id="passengerFields"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-success">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // فتح المودال وتعيين user_id
    $(document).on('click', '.openPassengerModal', function() {
        var userId = $(this).data('user');
        $('#user_id').val(userId);
        $('#passengerModal').modal('show');
    });

    // توليد حقول الركاب عند كتابة العدد
    $('#passengerCount').on('input', function() {
        var count = $(this).val();
        var container = $('#passengerFields');
        container.empty();

        for (let i = 1; i <= count; i++) {
            container.append(`
                <div class="card mb-2 p-3">
                    <h6>الراكب ${i}</h6>
                    <div class="form-group">
                        <label>الاسم</label>
                        <input type="text" name="passenger_list[${i}][name]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>رقم الهوية</label>
                        <input type="text" name="passenger_list[${i}][id_number]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>رقم الجوال</label>
                        <input type="text" name="passenger_list[${i}][Phone_number]" class="form-control" required>
                    </div>
                </div>
            `);
        }
    });
</script>
@endsection

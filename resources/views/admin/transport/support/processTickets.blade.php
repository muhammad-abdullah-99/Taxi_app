@extends('layouts.master')
@section('title', 'تذاكر الدعم الفني')

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">تذاكر الدعم الفني</h4>
        </div>
    </div>
</div>
@endsection

@section('content')
@if (session('success'))
    <div class="alert alert-success text-right">
        {{ session('success') }}
    </div>
@endif

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-statistics">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>رقم الجوال</th>
                                <th>نوع المستخدم</th>
                                <th>الرسالة</th>
                                <th>الصورة</th>
                                <th>اسم الموظف</th>
                                <th>تاريخ الاستلام</th>
                                <th>ملاحظات الموظف</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tickets as $index => $ticket)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $ticket->appUser->name ?? '-' }}</td>
                                    <td>{{ $ticket->appUser->mobile ?? '-' }}</td>
                                    <td>
                                        @if($ticket->appUser->user_type == 1)
                                            سائق
                                        @elseif($ticket->appUser->user_type == 2)
                                            عميل
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $ticket->text }}</td>
                                    <td>
                                        @if($ticket->image)
                                            <a href="{{ asset('storage/' . $ticket->image) }}" target="_blank" class="btn btn-sm btn-info">عرض</a>
                                        @else
                                            لا يوجد
                                        @endif
                                    </td>
                                    <td>{{ $ticket->user->name ?? '-' }}</td>
                                    <td>{{ $ticket->updated_at->format(' H:i - Y-m-d') }}</td>
                                    <td>-</td>
                                    <td>
                                        <button class="btn btn-success btn-sm send-otp" 
                                            data-ticket-id="{{ $ticket->id }}" 
                                            data-phone="{{ $ticket->user->phone ?? '' }}">
                                            اغلاق
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10">لا توجد تذاكر حالياً.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- مودال OTP واحد خارج الجدول -->
<div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="otpModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="verifyOtpForm">
            @csrf
            <input type="hidden" name="ticket_id" id="otp_ticket_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تأكيد الرمز</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>تم إرسال رمز التحقق إلى رقم الهاتف.</p>
                    <input type="text" name="otp" class="form-control" placeholder="ادخل رمز التحقق" required>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">تأكيد</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap + jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function () {
    $('.send-otp').click(function () {
        let ticketId = $(this).data('ticket-id');
        $('#otp_ticket_id').val(ticketId);

        $.ajax({
            url: '{{ route("support.sendOtp") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                ticket_id: ticketId
            },
            success: function (res) {
                if (res.success) {
                    $('#otpModal').modal('show');
                } else {
                    alert('فشل في إرسال رمز التحقق');
                }
            },
error: function (xhr, status, error) {
    console.error('XHR:', xhr);
    console.error('Status:', status);
    console.error('Error:', error);
    alert('فشل الطلب: ' + error);

            }
        });
    });

    $('#verifyOtpForm').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: '{{ route("support.verifyOtp") }}',
            type: 'POST',
            data: formData,
            success: function (res) {
                if (res.success) {
                    $('#otpModal').modal('hide');
                    alert('تم إغلاق التذكرة بنجاح');
                    location.reload();
                } else {
                    alert(res.message || 'رمز التحقق غير صحيح');
                }
            },
            error: function () {
                alert('فشل التحقق من الرمز');
            }
        });
    });
});
</script>
@endsection

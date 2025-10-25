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

@if (session('error'))
    <div class="alert alert-danger text-right">
        {{ session('error') }}
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
                                        @if($ticket->appUser->user_type == 'Driver')
                                            سائق
                                        @elseif($ticket->appUser->user_type == 'Passenger')
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
                                    <td>{{ $ticket->updated_at->format('H:i - Y-m-d') }}</td>
                                    <td>-</td>
                                    <td>
                                        <!-- ✅ DIRECT CLOSE BUTTON - BINA OTP KE -->
                                        <form action="{{ route('support.closeTicketDirect', $ticket->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('هل تريد إغلاق هذه التذكرة؟')">
                                                اغلاق
                                            </button>
                                        </form>
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

<!-- Bootstrap + jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
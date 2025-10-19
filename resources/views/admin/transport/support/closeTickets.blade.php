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
                                <th>اسم الموظف </th>
                                <th>تاريخ الاغلاق</th>
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
                                    <td>{{ $ticket->updated_at->format('  H:i - Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">لا توجد تذاكر حالياً.</td>
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

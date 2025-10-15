@extends('layouts.master')

@section('title')
صفحة الرسائل
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">الرسائل</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMessageModal">
                        <i class="fa fa-paper-plane"></i> إرسال رسالة
                    </button>
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

<!-- عرض نجاح -->
@if(session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- مودال إضافة رسالة -->
<div class="modal fade" id="addMessageModal" tabindex="-1" role="dialog" aria-labelledby="addMessageLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('messages.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إرسال رسالة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>اختر الموظف</label>
                        <select name="employee_id" class="form-control" required>
                            <option value="">-- اختر موظف --</option>
                            @foreach($employees as $emp)
                            <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>نص الرسالة</label>
                        <textarea name="message" class="form-control" rows="4" required placeholder="اكتب الرسالة هنا..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">إرسال</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- جدول عرض الرسائل -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th>اسم الموظف</th>
                                <th>الرسالة</th>
                                <th>تاريخ الإرسال</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $msg)
                            <tr>
                                <td>{{ $msg->employee->name ?? 'غير معروف' }}</td>
                                <td style="word-break: break-word; white-space: normal; max-width: 400px;">
                                    {{ $msg->message }}
                                </td>
                                <td>{{ $msg->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">لا توجد رسائل حالياً.</td>
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
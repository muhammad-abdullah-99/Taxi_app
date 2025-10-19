@extends('layouts.master')
@section('title', 'إدارة رسائل التطبيق')

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">إدارة رسائل التطبيق</h4>
        </div>
        <div class="col-sm-6 text-right">
            <button class="btn btn-info" data-toggle="modal" data-target="#addUserModal">
                <i class="fa fa-plus"></i> إضافة
            </button>
        </div>
    </div>
</div>
@endsection


@section('content')
{{-- Modal إضافة مستخدم --}}
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('app-users.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body text-right">
                    <input type="text" name="name" class="form-control mb-2" placeholder="الاسم" required>
                    <input type="text" name="mobile" class="form-control mb-2" placeholder="رقم الجوال" required>
                    <input type="text" name="address" class="form-control mb-2" placeholder="المدينة" required>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button type="submit" class="btn btn-primary">إضافة</button>
                </div>
            </div>
        </form>
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li> {{-- هنا تظهر رسالة مثل: "رقم الموبايل مسجل بالفعل..." --}}
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif


{{-- جدول المستخدمين --}}
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-statistics">
            <div class="card-body">

                {{-- نموذج إرسال الرسالة --}}
                <form id="send-sms-form" action="{{ route('send.sms.to.users') }}" method="POST">
                    @csrf

                    {{-- زر إرسال أعلى الجدول --}}
                    <div class="mb-3 text-right">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#sendSmsModal">
                            إرسال رسالة للمحددين
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="check-all"></th>
                                    <th>الاسم</th>
                                    <th>رقم الجوال</th>
                                    <th>المدينة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($userApp as $user)
                                <tr>
                                    <td><input type="checkbox" name="selected_users[]" value="{{ $user->mobile }}"></td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->mobile }}</td>
<td>{{ $user->address ?? ($user->company?->company_location ?? '') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">لا توجد بيانات.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- مودال كتابة الرسالة --}}
                    <div class="modal fade" id="sendSmsModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content text-right">
                                <div class="modal-header">
                                    <h5 class="modal-title">إرسال رسالة SMS</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <textarea name="message" class="form-control" form="send-sms-form" placeholder="اكتب الرسالة هنا..." required></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                    <button type="submit" class="btn btn-primary" form="send-sms-form">إرسال</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('check-all').addEventListener('change', function () {
    let checkboxes = document.querySelectorAll('input[name="selected_users[]"]');
    for (let box of checkboxes) {
        box.checked = this.checked;
    }
});
</script>
@endsection

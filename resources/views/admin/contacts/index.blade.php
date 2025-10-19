@extends('layouts.master')

@section('title')
رسائل الموقع
@stop

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">رسائل الموقع</h4>
        </div>
    </div>
</div>
@endsection

@section('content')

<!-- عرض الأخطاء والنجاح -->
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- جدول الرسائل -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                      <thead>
                            <tr>
                                <th>#</th>
                                <th>الاسم</th>
                                <th>رقم الجوال</th>
                                <th>البريد الإلكتروني</th>
                                <th>تاريخ الإرسال</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contacts as $contact)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <!-- زر عرض التفاصيل -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#show{{ $contact->id }}">
                                        <i class="fa fa-eye"></i>
                                    </button>

                                    <!-- نافذة التفاصيل -->
                                    <div class="modal fade" id="show{{ $contact->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">تفاصيل الرسالة</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>الرسالة:</strong> {{ $contact->message }}</p>
                                                </div>
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

@extends('layouts.master')

@section('css')
@endsection

@section('title')
ارشيف الموظفين
@stop

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">إدارة الموظفين</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <!-- <li class="breadcrumb-item">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addEmployeeModal">
                        <i class="fa fa-plus"></i> - إضافة موظف جديد
                    </button>
                </li> -->
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة موظف جديد</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storeEmployee') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label>الاسم</label>
                    <input type="text" name="name" class="form-control" required>
                    <br>
                    <label>الجنسية</label>
                    <input type="text" name="nationality" class="form-control" required>
                    <br>
                    <label>الموبايل</label>
                    <input type="text" name="phone" class="form-control" required>
                    <br>
                    <label>رقم الهوية</label>
                    <input type="text" name="identity_number" class="form-control" required>
                    <br>
                    <label>تاريخ الالتحاق</label>
                    <input type="date" name="joining_date" class="form-control" required>
                    <br>
                    <label>المسمى الوظيفي</label>
                    <input type="text" name="job_title" class="form-control" required>
                    <br>
                    <label>الملفات</label>
                    <input type="file" name="files[]" class="form-control" multiple>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الجنسية</th>
                                <th>رقم الهوية</th>
                                <th>تاريخ الالتحاق</th>
                                <th> اسم الشركة </th>
                                <th> الموبايل  </th>
                                <th>المسمى الوظيفي</th>
                                <th>الملفات</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->nationality }}</td>
                                <td>{{ $employee->identity_number }}</td>
                                <td>{{ $employee->joining_date }}</td>
                                <td>{{ $employee->company }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->job_title }}</td>
                                <td><a href="{{ route('showAllEmployeeFiles', $employee->id) }}" class="btn btn-sمm btn-info">عرض الملفات</a></td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $employee->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    @if (Auth::check() && Auth::user()->role == 'مسؤول')
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#archive{{ $employee->id }}">
                                        <i class="fa fa-undo"></i>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                            <div class="modal fade" id="edit{{ $employee->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">تعديل بيانات الموظف</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('updateEmployee', $employee->id) }}" method="post">
                                                @csrf
                                                <label>الاسم</label>
                                                <input type="text" name="name" class="form-control" value="{{ $employee->name }}">
                                                <br>
                                                <label>الجنسية</label>
                                                <input type="text" name="nationality" class="form-control" value="{{ $employee->nationality }}">
                                                <br>
                                                <label>الموبايل</label>
                                                <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}">
                                                <br>
                                                <label>رقم الهوية</label>
                                                <input type="text" name="identity_number" class="form-control" value="{{ $employee->identity_number }}">
                                                <br>
                                                <label>تاريخ الالتحاق</label>
                                                <input type="date" name="joining_date" class="form-control" value="{{ $employee->joining_date }}">
                                                <br>
                                                <label>المسمى الوظيفي</label>
                                                <input type="text" name="job_title" class="form-control" value="{{ $employee->job_title }}">
                                                <br>
                                                <label>اسم الشركة</label>
                                                <select name="company" class="form-control" required>
                                                    <option value="">-- اختر اسم الشركة --</option>
                                                    <option value="شركة الجواب للنقل البري" {{ $employee->company == 'شركة الجواب للنقل البري' ? 'selected' : '' }}>شركة الجواب للنقل البري</option>
                                                    <option value="مؤسسة الجواب للنقل البري" {{ $employee->company == 'مؤسسة الجواب للنقل البري' ? 'selected' : '' }}>مؤسسة الجواب للنقل البري</option>
                                                    <option value="رواسي التل للمقاولات العامة" {{ $employee->company == 'رواسي التل للمقاولات العامة' ? 'selected' : '' }}>رواسي التل للمقاولات العامة</option>
                                                    <option value="رواسي التلال للمقاولات العامة" {{ $employee->company == 'رواسي التلال للمقاولات العامة' ? 'selected' : '' }}>رواسي التلال للمقاولات العامة</option>
                                                    <option value="رواسي القمم للتشغيل والصيانة" {{ $employee->company == 'رواسي القمم للتشغيل والصيانة' ? 'selected' : '' }}>رواسي القمم للتشغيل والصيانة</option>
                                                    <option value="مؤسسة سميرة" {{ $employee->company == 'مؤسسة سميرة' ? 'selected' : '' }}>مؤسسة سميرة</option>
                                                </select>
                                                <br>

                                                <button type="submit" class="btn btn-primary">تحديث</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="archive{{ $employee->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">استعادة الموظف</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('unarchiveEmployee', $employee->id) }}" method="post">
                                                @csrf
                                                <p>هل أنت متأكد من استعادة هذا الموظف؟</p>
                                                <button type="submit" class="btn btn-warning">استعادة</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
@endsection
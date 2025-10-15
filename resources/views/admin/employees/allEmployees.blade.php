@extends('layouts.master')

@section('css')
@endsection

@section('title')
جميع الموظفين
@stop

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">إدارة الموظفين</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addEmployeeModal">
                        <i class="fa fa-plus"></i> - إضافة موظف جديد
                    </button>
                </li>
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
                    <label>اسم الشركة</label>
                    <select name="company" class="form-control" required>
                        <option value="">-- اختر اسم الشركة --</option>
                        <option value="شركة الجواب للنقل البري">شركة الجواب للنقل البري</option>
                        <option value="مؤسسة الجواب للنقل البري">مؤسسة الجواب للنقل البري</option>
                        <option value="رواسي التل للمقاولات العامة">رواسي التل للمقاولات العامة</option>
                        <option value="رواسي التلال للمقاولات العامة">رواسي التلال للمقاولات العامة</option>
                        <option value="رواسي القمم للتشغيل والصيانة">رواسي القمم للتشغيل والصيانة</option>
                        <option value="مؤسسة سميرة">مؤسسة سميرة</option>
                        <option value="طيبة السبل">طيبة السبل</option>
                        <option value="العملاء">العملاء</option>
                    </select>
                    <br>
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

<div class="row mb-3">
    <div class="col-12">
        <strong class="d-block mb-3 fs-5">الشركات:</strong>

        <div class="d-flex flex-wrap gap-3">
            <!-- زر الكل -->
            <div class="card shadow-sm border rounded text-center p-2" style="min-width: 140px; height: 90px; background-color: #f8f9fa;">
                <a href="{{ route('getEmployee') }}" class="btn btn-sm btn-secondary w-100 py-1 fw-bold">
                    الكل
                </a>
            </div>

            @foreach($companies as $company)
            <div class="card shadow-sm border rounded text-center p-2" style="min-width: 220px; height: 70px; background-color: #ffffff;">
                <div class=" mb-2 fw-bold text-truncate" title="{{ $company->company }}">
                    {{ $company->company }} ({{ $company->count }})
                </div>
                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('getEmployee', ['company' => $company->company]) }}" 
                       class="btn btn-sm btn-primary py-1 px-2">
                        عرض
                    </a>
                    <a href="{{ route('employee.report', ['company' => $company->company]) }}" 
                       target="_blank" 
                       class="btn btn-sm btn-success py-1 px-2">
                        تقرير
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>


/* نصوص البطاقة */
.card .small {
    font-size: 0.85rem;
}

/* لجعل البطاقات تتوزع بالتساوي على الشاشة */
@media (min-width: 992px) {
    .d-flex.flex-wrap .card {
        flex: 1 1 140px;
    }
}
</style>


<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <!-- <th>الجنسية</th>
                                <th>رقم الهوية</th>
                                <th>رقم الهاتف</th>
                                <th>تاريخ الالتحاق</th> -->
                                <th> اسم الشركة </th>
                                <!-- <th>المسمى الوظيفي</th> -->
                                <th>معلومات الموظفين</th>
                                <th>المستندات</th>
                                <th>الملفات</th>
                                <th>بواسطة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>
                                <!-- <td>{{ $employee->nationality }}</td> -->
                                <!-- <td>{{ $employee->identity_number }}</td> -->
                                <!-- <td>{{ $employee->phone }}</td> -->
                                <!-- <td>{{ $employee->joining_date }}</td> -->
                                <td>{{ $employee->company }}</td>
                                <!-- <td>{{ $employee->job_title }}</td> -->
                                <td>
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#employeeModal{{ $employee->id }}">
                                        عرض
                                    </button>
                                </td>

                                <!-- مودال Bootstrap 4 -->

                                <div class="modal fade" id="employeeModal{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="employeeModalLabel{{ $employee->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="employeeModalLabel{{ $employee->id }}">معلومات الموظف</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-2 d-flex justify-content-between border-bottom pb-2">
                                                    <strong>الجنسية:</strong>
                                                    <span>{{ $employee->nationality }}</span>
                                                </div>
                                                <div class="mb-2 d-flex justify-content-between border-bottom pb-2">
                                                    <strong>رقم الهوية:</strong>
                                                    <span>{{ $employee->identity_number }}</span>
                                                </div>
                                                <div class="mb-2 d-flex justify-content-between border-bottom pb-2">
                                                    <strong>تاريخ الالتحاق:</strong>
                                                    <span>{{ $employee->joining_date }}</span>
                                                </div>
                                                <div class="mb-2 d-flex justify-content-between border-bottom pb-2">
                                                    <strong>المسمى الوظيفي:</strong>
                                                    <span>{{ $employee->job_title }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!--  -->
                                <td>
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#employeeModalDocs{{ $employee->id }}">
                                        عرض
                                    </button>
                                </td>
                                <!-- مودال معلومات الموظف -->
                                <div class="modal fade" id="employeeModalDocs{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="employeeModalDocsLabel{{ $employee->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="employeeModalDocsLabel{{ $employee->id }}"> المستندات </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- التواريخ مع زر التحديث -->
                                                @foreach(['moqem_expire_at' => 'انتهاء هوية مقيم', 'mokhalsa_expire_at' => 'انتهاء المخالصة', 'cart_expire_at' => 'انتهاء بطاقة السائق'] as $field => $label)
                                                <div class="mb-2 d-flex justify-content-between border-bottom pb-2 align-items-center">
                                                    <div><strong>{{ $label }}:</strong> {{ $employee->$field ?? 'غير محدد' }}</div>
                                                    <button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#updateModal_{{ $field }}_{{ $employee->id }}">
                                                        تحديث
                                                    </button>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--  -->
                                @foreach(['moqem_expire_at' => 'انتهاء هوية مقيم', 'mokhalsa_expire_at' => 'انتهاء المخالصة', 'cart_expire_at' => 'انتهاء بطاقة السائق'] as $field => $label)
                                <div class="modal fade" id="updateModal_{{ $field }}_{{ $employee->id }}" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel_{{ $field }}_{{ $employee->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form method="POST" action="{{ route('employees.update_expiry', [$employee->id]) }}">
                                            @csrf
                                            <input type="hidden" name="field" value="{{ $field }}">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="updateModalLabel_{{ $field }}_{{ $employee->id }}">تحديث {{ $label }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="value_{{ $field }}_{{ $employee->id }}">التاريخ الجديد:</label>
                                                    <input type="date" name="value" class="form-control" id="value_{{ $field }}_{{ $employee->id }}" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endforeach



                                <td><a href="{{ route('showAllEmployeeFiles', $employee->id) }}" class="btn btn-sمm btn-info">عرض الملفات</a></td>
                                <td>{{ $employee->user_name }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $employee->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <a href="{{ route('showAllPrints', $employee->id) }}" class="btn btn-success btn-sm">
                                        نماذج
                                    </a>

                                    @if (Auth::check() && Auth::user()->role == 'مسؤول')
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#archive{{ $employee->id }}">
                                        <i class="fa fa-archive"></i>
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
                                                    <option value="طيبة السبل" {{ $employee->company == 'مؤسسة سميرة' ? 'selected' : '' }}>طيبة السبل </option>
                                                    <option value="العملاء" {{ $employee->company == 'العملاء' ? 'selected' : '' }}>العملاء</option>

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
                                            <h5 class="modal-title">أرشفة الموظف</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('archiveEmployee', $employee->id) }}" method="post">
                                                @csrf
                                                <p>هل أنت متأكد من أرشفة هذا الموظف؟</p>
                                                <button type="submit" class="btn btn-warning">أرشفة</button>
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
@extends('layouts.master')

@section('title')
إضافة موظف جديد
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">إضافة موظف جديد</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">الموظفين</li>
                <li class="breadcrumb-item active">إضافة موظف جديد</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                 <form action="{{ route('storeEmployee') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                    <label>الاسم</label>
                    <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                    <label>الجنسية</label>
                    <input type="text" name="nationality" class="form-control" required>
                    </div>

                    <div class="form-group">
                    <label>الموبايل</label>
                    <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div class="form-group">
                    <label>رقم الهوية</label>
                    <input type="text" name="identity_number" class="form-control" required>
                    </div>

                    <div class="form-group">
                    <label>تاريخ الالتحاق</label>
                    <input type="date" name="joining_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                    <label>المسمى الوظيفي</label>
                    <input type="text" name="job_title" class="form-control" required>
                    </div>

                    <div class="form-group mb-2">
                    <label>اسم الشركة</label>
                    <select name="company" class="form-control form-control-lg" required>
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
                    </div>

                    <div class="form-group">
                    <label>الملفات</label>
                    <input type="file" name="files[]" class="form-control form-control-lg" multiple>
                    </div>
                    
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-lg">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection

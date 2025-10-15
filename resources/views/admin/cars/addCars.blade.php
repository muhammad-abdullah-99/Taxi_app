@extends('layouts.master')

@section('title')
إضافة موظف جديد
@endsection

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">إضافة سيارة جديدة</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">السيارات</li>
                <li class="breadcrumb-item active">إضافة سيارة جديدة</li>
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
                 <form action="{{ route('storeCar') }}" method="post">
                    @csrf
                    <div class="form-group">
                    <label for="type">نوع المركب</label>
                    <input type="text" name="type" class="form-control" placeholder="النوع">
                    </div>

                    <div class="form-group">
                    <label for="name">الموديل</label>
                    <input type="text" name="name" class="form-control" placeholder="الموديل">
                    </div>

                    <div class="form-group">
                    <label for="plate_number">رقم اللوحة</label>
                    <input type="text" name="plate_number" class="form-control" placeholder="رقم اللوحة">
                    </div>

                    <div class="form-group">
                    <label for="card_number">رقم بطاقة الجمرك</label>
                    <input type="text" name="card_number" class="form-control" placeholder="رقم البطاقة">
                    </div>

                    <div class="form-group">
                    <label for="serial_number">الرقم التسلسلي</label>
                    <input type="text" name="serial_number" class="form-control" placeholder="الرقم التسلسلي">
                    </div>

                    <div class="form-group">
                    <label for="color">اللون</label>
                    <input type="text" name="color" class="form-control" placeholder="اللون">
                    <br>
                    </div>

                    <div class="form-group">
                    <label for="status">الحالة</label>
                    <select name="status" class="form-control form-control-lg">
                        <option value="عاملة">عاملة</option>
                        <option value="متعطلة">متعطلة</option>
                        <option value="انتظار">انتظار</option>
                        <option value="خارج عن الخدمة">خارج عن الخدمة</option>
                    </select>
                    </div>

                    <div class="form-group">
                    <!-- نوع السعر -->
                    <label for="type_price">نوع السعر</label>
                    <select name="type_price" class="form-control form-control-lg">
                        <option value="شهري">شهري</option>
                        <option value="يومي">يومي</option>
                    </select>
                    </div>

                    <div class="form-group">
                    <!-- قيمة السعر -->
                    <label for="price">قيمة السعر</label>
                    <input type="number" name="price" class="form-control" placeholder="مثال: 500">
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

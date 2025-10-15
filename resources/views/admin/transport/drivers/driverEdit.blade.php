@extends('layouts.master')

@section('css')
<style>
    .form-group label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 10px;
        padding: 10px;
        font-size: 16px;
    }

    .btn-success {
        width: 100%;
        padding: 15px;
        font-size: 18px;
        font-weight: bold;
        border-radius: 10px;
    }

    .card-body {
        padding: 30px;
    }
</style>
@endsection

@section('title')
تعديل بيانات السائق
@stop

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> تعديل بيانات السائق </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('showWaitingDrivers') }}" class="btn btn-primary">رجوع</a></li>
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

<div class="row justify-content-center m-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('updateDriver', $driver->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <h5 class="card-title text-center mb-4">بيانات السائق</h5>
                    <div class="form-group">
                        <label>الاسم</label>
                        <input type="text" name="name" class="form-control" value="{{ $driver->name }}" required>
                    </div>
                    <div class="form-group">
                        <label>رقم الهوية</label>
                        <input type="text" name="id_number" class="form-control" value="{{ $driver->id_number }}" required>
                    </div>
                    <div class="form-group">
                        <label>الجوال</label>
                        <input type="text" name="mobile" class="form-control" value="{{ $driver->mobile }}" required>
                    </div>

                    <h5 class="card-title text-center mt-4 mb-4">بيانات الشركة</h5>
                    <div class="form-group">
                        <label>اسم الشركة</label>
                        <input type="text" name="company_name" class="form-control" value="{{ optional($driver->company)->company_name }}">
                    </div>
                    <div class="form-group">
                        <label>موقع الشركة</label>
                        <select name="company_location" class="form-control">
                            <option value="">اختر المدينة</option>
                            <option value="المدينة المنورة" {{ optional($driver->company)->company_location == 'المدينة المنورة' ? 'selected' : '' }}>المدينة</option>
                            <option value="جدة" {{ optional($driver->company)->company_location == 'جدة' ? 'selected' : '' }}>جدة</option>
                            <option value="مكة" {{ optional($driver->company)->company_location == 'مكة' ? 'selected' : '' }}>مكة</option>
                            <option value="ينبع" {{ optional($driver->company)->company_location == 'ينبع' ? 'selected' : '' }}>ينبع</option>
                            <option value="الرياض" {{ optional($driver->company)->company_location == 'الرياض' ? 'selected' : '' }}>الرياض</option>
                            <option value="القصيم" {{ optional($driver->company)->company_location == 'القصيم' ? 'selected' : '' }}>القصيم</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>نوع الشركة</label>
                        <select name="company_type" class="form-control">
                            <option value="">اختر نوع الشركة</option>
                            <option value="الاجرة العامة" {{ optional($driver->company)->company_type == 'الاجرة العامة' ? 'selected' : '' }}>الاجرة العامة</option>
                            <option value="الاجرة الخاصة" {{ optional($driver->company)->company_type == 'الاجرة الخاصة' ? 'selected' : '' }}>الاجرة الخاصة</option>
                            <option value="النقل المتخصص" {{ optional($driver->company)->company_type == 'النقل المتخصص' ? 'selected' : '' }}>النقل المتخصص</option>
                            <option value="السيارات الخاصة للمقيمين" {{ optional($driver->company)->company_type == 'السيارات الخاصة للمقيمين' ? 'selected' : '' }}>السيارات الخاصة للمقيمين</option>
                            <option value="السيارات الخاصة للمواطنين" {{ optional($driver->company)->company_type == 'السيارات الخاصة للمواطنين' ? 'selected' : '' }}>السيارات الخاصة للمواطنين</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label>رقم التسجيل</label>
                        <input type="text" name="company_registration_number" class="form-control" value="{{ optional($driver->company)->company_registration_number }}">
                    </div>

                    <h5 class="card-title text-center mt-4 mb-4">بيانات السيارة</h5>
                    <!-- <div class="form-group">
                        <label>نوع السيارة</label>
                        <input type="text" name="car_type" class="form-control" value="{{ optional($driver->vehicle)->car_type }}">
                    </div> -->
                    <div class="form-group">
    <label>نوع السيارة</label>
    <select name="car_type" class="form-control">
        <option value="">اختر نوع السيارة</option>
        <option value="هايس" {{ optional($driver->vehicle)->car_type == 'هايس' ? 'selected' : '' }}>هايس</option>
        <option value="استاركس" {{ optional($driver->vehicle)->car_type == 'استاركس' ? 'selected' : '' }}>استاركس</option>
        <option value="استاريا" {{ optional($driver->vehicle)->car_type == 'استاريا' ? 'selected' : '' }}>استاريا</option>
        <option value="كامري" {{ optional($driver->vehicle)->car_type == 'كامري' ? 'selected' : '' }}>كامري</option>
        <option value="سوناتا" {{ optional($driver->vehicle)->car_type == 'سوناتا' ? 'selected' : '' }}>سوناتا</option>
        <option value="كيا k5" {{ optional($driver->vehicle)->car_type == 'كيا k5' ? 'selected' : '' }}>كيا k5</option>
        <option value="ميتسويشي اكس باندر" {{ optional($driver->vehicle)->car_type == 'ميتسويشي اكس باندر' ? 'selected' : '' }}>ميتسويشي اكس باندر</option>
        <option value="النترا" {{ optional($driver->vehicle)->car_type == 'النترا' ? 'selected' : '' }}>النترا</option>
        <option value="جمس" {{ optional($driver->vehicle)->car_type == 'جمس' ? 'selected' : '' }}>جمس</option>
    </select>
</div>

                    <div class="form-group">
                        <label>موديل السيارة</label>
                        <input type="text" name="car_model" class="form-control" value="{{ optional($driver->vehicle)->car_model }}">
                    </div>
                    <div class="form-group">
                        <label>لون السيارة</label>
                        <input type="text" name="car_color" class="form-control" value="{{ optional($driver->vehicle)->car_color }}">
                    </div>
                    <div class="form-group">
                        <label>رقم اللوحة</label>
                        <input type="text" name="licence_plate_number" class="form-control" value="{{ optional($driver->vehicle)->licence_plate_number }}">
                    </div>

                    <div class="form-group">
                        <label>التصنيف</label>
                        <select name="number_of_passengers" class="form-control">
                            <option value="اختار التصنيف"> التصنيف </option>
                            <option value="4" {{ optional($driver->vehicle)->number_of_passengers == '11' ? 'selected' : '' }}>4</option>
                            <option value="7" {{ optional($driver->vehicle)->number_of_passengers == '11' ? 'selected' : '' }}>7</option>
                            <option value="8" {{ optional($driver->vehicle)->number_of_passengers == '11' ? 'selected' : '' }}>8</option>
                            <option value="9" {{ optional($driver->vehicle)->number_of_passengers == '11' ? 'selected' : '' }}>9</option>
                            <option value="11" {{ optional($driver->vehicle)->number_of_passengers == '11' ? 'selected' : '' }}>11</option>
                            <option value="12" {{ optional($driver->vehicle)->number_of_passengers == '12' ? 'selected' : '' }}>12</option>
                            <option value="13" {{ optional($driver->vehicle)->number_of_passengers == '13' ? 'selected' : '' }}>13</option>
                            <option value="14" {{ optional($driver->vehicle)->number_of_passengers == '14' ? 'selected' : '' }}>14</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success mt-4">حفظ التعديلات</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection
@extends('layouts.master')

@section('title')
بين المدن
@endsection

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> بين المدن</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addCityModal">
                        <i class="fa fa-plus"></i> إضافة
                    </button>
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')

<!-- الأخطاء -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- مودال الإضافة -->
<div class="modal fade" id="addCityModal" tabindex="-1" role="dialog" aria-labelledby="addCityLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('between_cities.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <input type="text" name="city_one" class="form-control" placeholder="المدينة الأولى" required>
                    <br>
                    <input type="text" name="city_two" class="form-control" placeholder="المدينة الثانية" required>
                    <br>
                    <input type="number" step="0.01" name="amount" class="form-control" placeholder="السعر" required>

                    <input type="number" step="0.01" name="office_commission" class="form-control" placeholder="نسبة المكتب" required>
                    <!-- car_type -->
                    <select name="car_type" class="form-control">
                        <option value="">اختر نوع السيارة</option>
                        <option value="هايس">هايس</option>
                        <option value="استاركس">استاركس</option>
                        <option value="استاريا">استاريا</option>
                        <option value="كامري">كامري</option>
                        <option value="سوناتا">سوناتا</option>
                        <option value="كيا k5">كيا k5</option>
                        <option value="ميتسويشي اكس باندر">ميتسويشي اكس باندر</option>
                        <option value="النترا">النترا</option>
                        <option value="جمس">جمس</option>
                    </select>
                    <br>
                    <!-- code -->
                    <input type="text" name="code" class="form-control" placeholder="الكود">
                    <br>

                    <select name="passengers" class="form-control" required>
                        <option value="4">4</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button class="btn btn-primary" type="submit">إضافة</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- جدول -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>المدينة الأولى</th>
                                <th>المدينة الثانية</th>
                                <th>السعر</th>
                                <th>التصنيف</th>
                                <th>نوع السيارة</th>
                                <th>الكود</th>
                                <th>نسبة المكتب</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($between_cities as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->city_one }}</td>
                                <td>{{ $item->city_two }}</td>
                                <td>{{ number_format((float)$item->amount, 2) }}</td>
                                <td>{{ $item->passengers }}</td>
                                <td>{{ $item->car_type }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ number_format((float)$item->office_commission, 2) }}</td>
                                <td>
                                    <!-- زر تعديل -->
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $item->id }}">
                                        تعديل
                                    </button>

                                    <!-- زر حذف -->
                                    <!-- <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $item->id }}">
                                        حذف
                                    </button> -->
                                </td>
                            </tr>

                            <!-- مودال تعديل -->
                            <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('between_cities.update', $item->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">تعديل </h5>
                                                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="text" name="city_one" class="form-control" value="{{ $item->city_one }}" required>
                                                <br>
                                                <input type="text" name="city_two" class="form-control" value="{{ $item->city_two }}" required>
                                                <br>
                                                <input type="number" step="0.01" name="amount" class="form-control" value="{{ $item->amount }}" required>
                                                <br>
                                                <input type="number" step="0.01" name="office_commission" class="form-control" value="{{ $item->office_commission }}" required>
                                                <br>

                                                <select name="car_type" class="form-control">
                                                    <option value="">اختر نوع السيارة</option>
                                                    <option value="هايس" {{ $item->car_type == 'هايس' ? 'selected' : '' }}>هايس</option>
                                                    <option value="استاركس" {{ $item->car_type == 'استاركس' ? 'selected' : '' }}>استاركس</option>
                                                    <option value="استاريا" {{ $item->car_type == 'استاريا' ? 'selected' : '' }}>استاريا</option>
                                                    <option value="كامري" {{ $item->car_type == 'كامري' ? 'selected' : '' }}>كامري</option>
                                                    <option value="سوناتا" {{ $item->car_type == 'سوناتا' ? 'selected' : '' }}>سوناتا</option>
                                                    <option value="كيا k5" {{ $item->car_type == 'كيا k5' ? 'selected' : '' }}>كيا k5</option>
                                                    <option value="ميتسويشي اكس باندر" {{ $item->car_type == 'ميتسويشي اكس باندر' ? 'selected' : '' }}>ميتسويشي اكس باندر</option>
                                                    <option value="النترا" {{ $item->car_type == 'النترا' ? 'selected' : '' }}>النترا</option>
                                                    <option value="جمس" {{ $item->car_type == 'جمس' ? 'selected' : '' }}>جمس</option>
                                                </select>
                                                <br>
                                                <input type="text" name="code" class="form-control" value="{{ $item->code }}" placeholder="الكود">
                                                <br>
                                                <select name="passengers" class="form-control" required>
                                                    <option value="4" {{ $item->passengers == 4 ? 'selected' : '' }}>4</option>
                                                    <option value="7" {{ $item->passengers == 7 ? 'selected' : '' }}>7</option>
                                                    <option value="8" {{ $item->passengers == 8 ? 'selected' : '' }}>8</option>
                                                    <option value="9" {{ $item->passengers == 9 ? 'selected' : '' }}>9</option>
                                                    <option value="11" {{ $item->passengers == 11 ? 'selected' : '' }}>11</option>
                                                    <option value="12" {{ $item->passengers == 12 ? 'selected' : '' }}>12</option>
                                                    <option value="13" {{ $item->passengers == 13 ? 'selected' : '' }}>13</option>
                                                    <option value="14" {{ $item->passengers == 14 ? 'selected' : '' }}>14</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                <button class="btn btn-primary" type="submit">تحديث</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- مودال حذف -->
                            <div class="modal fade" id="delete{{ $item->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="#" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">حذف المسافة</h5>
                                                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                هل أنت متأكد أنك تريد حذف هذه المسافة؟
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                <button class="btn btn-danger" type="submit">حذف</button>
                                            </div>
                                        </div>
                                    </form>
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
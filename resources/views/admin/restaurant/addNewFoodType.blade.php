@extends('layouts.master')
@section('css')
@section('title')
إضافة صنف

@stop
@endsection
@section('page-header')
<div class="container">

    <h3 class="mb-4 text-dark">إضافة صنف</h3>

    <form action="{{ route('food.store') }}" method="POST">
        @csrf
        <div class="card bg-dark text-white">
            <div class="card-body">
                <!-- نوع الوجبة -->
                <div class="form-group mb-3 ">
                    <label for="type">نوع الوجبة</label>
                    <select class="form-control p-1" name="type" id="type" required>
                        <option value="">-- اختر النوع --</option>
                        <option value="افطار">إفطار</option>
                        <option value="غداء">غداء</option>
                        <option value="عشاء">عشاء</option>
                    </select>
                </div>

                <!-- اسم الصنف -->
                <div class="form-group mb-3">
                    <label for="name">اسم الصنف</label>
                    <input type="text" name="name" id="name" class="form-control  " placeholder="مثال: فول، كبسة..." required>
                </div>

                <!-- جدول الأحجام والأسعار -->
                <div class="form-group mb-3">
                    <label>الأسعار حسب الحجم</label>
                    <table class="table table-white table-bordered text-center">
                        <thead>
                            <tr>
                                <th>الحجم</th>
                                <th>السعر (ريال)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>صغير</td>
                                <td>
                                    <input type="number" step="0.01" name="prices[0][price]" class="form-control  " placeholder="0.00">
                                    <input type="hidden" name="prices[0][size]" value="صغير">
                                </td>
                            </tr>
                            <tr>
                                <td>وسط</td>
                                <td>
                                    <input type="number" step="0.01" name="prices[1][price]" class="form-control " placeholder="0.00">
                                    <input type="hidden" name="prices[1][size]" value="وسط">
                                </td>
                            </tr>
                            <tr>
                                <td>كبير</td>
                                <td>
                                    <input type="number" step="0.01" name="prices[2][price]" class="form-control  " placeholder="0.00">
                                    <input type="hidden" name="prices[2][size]" value="كبير">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- زر الحفظ -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection
@section('js')
@endsection
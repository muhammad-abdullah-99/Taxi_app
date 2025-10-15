@extends('layouts.master')

@section('title') إدارة الجهات @endsection

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">إدارة الجهات</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addGehaModal">
                        <i class="fa fa-plus"></i> إضافة جهة
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

<!-- Modal إضافة جهة -->
<div class="modal fade" id="addGehaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('gehas.store') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة جهة</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <label>اسم الجهة</label>
                    <input type="text" name="name" class="form-control" required><br>
                    <label>رقم الجهة</label>
                    <input type="text" name="number" class="form-control"><br>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">إضافة</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- جدول الجهات -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الرقم</th>
                                <th>بواسطة </th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gehas as $geha)
                            <tr>
                                <td>{{ $geha->name }}</td>
                                <td>{{ $geha->number }}</td>
                                <td>{{ $geha->user_name }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $geha->id }}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <!-- زر حذف بيفتح المودال -->
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $geha->id }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>


                            <!-- Modal تعديل -->
                            <div class="modal fade" id="edit{{ $geha->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <form action="{{ route('gehas.update', $geha->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">تعديل جهة</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <label>اسم الجهة</label>
                                                <input type="text" name="name" class="form-control" value="{{ $geha->name }}">
                                                <br>
                                                <label>رقم الجهة</label>
                                                <input type="text" name="number" class="form-control" value="{{ $geha->number }}">
                                                <br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">تحديث</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- مودال الحذف -->
                            <div class="modal fade" id="delete{{ $geha->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">حذف الجهة</h5>
                                            <button type="button" class="close" data-dismiss="modal">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>هل أنت متأكد من حذف الجهة: <strong>{{ $geha->name }}</strong>؟</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('gehas.destroy', $geha->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">حذف</button>
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
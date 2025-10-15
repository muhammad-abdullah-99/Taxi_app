@extends('layouts.master')
@section('css')
@endsection

@section('title')
    إدارة المشتريات
@stop

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">إدارة المشتريات</h4>
        </div>
        <div class="col-sm-6 text-right">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addPurchaseModal">
                <i class="fa fa-plus"></i> إضافة عملية شراء
            </button>
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

<div class="modal fade" id="addPurchaseModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة عملية شراء</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('purchases.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="description" class="form-control" placeholder="الوصف" required>
                    <br>
                    <input type="number" name="amount" class="form-control" placeholder="المبلغ" required>
                    <br>
                    <input type="number" name="tax" class="form-control" placeholder="الضريبة" required>
                    <br>
                    <input type="number" name="total" class="form-control" placeholder="الإجمالي" required>
                    <br>
                    <input type="file" name="image" class="form-control">
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
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                <thead>
                            <tr>
                                <th>الوصف</th>
                                <th>المبلغ</th>
                                <th>الضريبة</th>
                                <th>الإجمالي</th>
                                <th>المرفقات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td>{{ $purchase->description }}</td>
                                    <td>{{ $purchase->amount }}</td>
                                    <td>{{ $purchase->tax }}</td>
                                    <td>{{ $purchase->total }}</td>
                                    <td>
                                        @if($purchase->image)
                                            <a  class="btn btn-info btn-sm" href="{{ asset('storage/' . $purchase->image) }}" target="_blank" >عرض</a>
                                        @endif
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

@section('js')
@endsection

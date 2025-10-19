@extends('layouts.master')

@section('title', 'Wallets')

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> المحافظ</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addBalanceModal">
                        <i class="fa fa-plus"></i> إضافة رصيد
                    </button>
                </li>
            </ol>
        </div>
    </div>
</div>

<!-- Modal إضافة رصيد -->
<div class="modal fade" id="addBalanceModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
          <form action="{{ route('wallets.chargeOnline') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">شحن رصيد عبر بوابة الدفع</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="driver_id">اختر المسخدم </label>
                        <select name="driver_id" id="driver_id" class="form-control" required>
                            <option value="">-- اختر --</option>
                            @foreach($drivers as $driver)
                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amount">المبلغ</label>
                        <input type="number" step="0.01" name="amount" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="name">اسم حامل البطاقة</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="number">رقم البطاقة</label>
                        <input type="text" name="number" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="month">شهر الانتهاء</label>
                        <input type="text" name="month" class="form-control" required placeholder="MM">
                    </div>

                    <div class="form-group">
                        <label for="year">سنة الانتهاء</label>
                        <input type="text" name="year" class="form-control" required placeholder="YYYY">
                    </div>

                    <div class="form-group">
                        <label for="cvc">CVC</label>
                        <input type="text" name="cvc" class="form-control" required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">ادفع الآن</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal شحن الرصيد عبر بوابة الدفع -->





<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th> رقم </th>
                                <th> اسم المستفيد</th>
                                <th> الرصيد الحالي </th>
                                <th> الاجرات </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wallets as $wallet)
                            <tr>
                                <td>{{ $wallet->id }}</td>
                                <td>{{ $wallet->user->name }}</td>
                                <td>{{ number_format($wallet->current_balance, 2) }} </td>
                                <td>
                                    <a type="button" class="btn btn-success" href="{{route('wallets.details',$wallet->id)}}">
                                         عرض التفاصيل  
                                    </a>
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
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endsection
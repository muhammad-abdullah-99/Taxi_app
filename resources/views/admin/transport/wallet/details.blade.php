@extends('layouts.master')

@section('title', 'Wallets')

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> تفاصيل المحفظة</h4>
        </div>
        <div class="col-sm-6">
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
                                <th> رقم </th>
                                <th> نوع العملية </th>
                                <th> القيمة </th>
                                <th> التفاصيل </th>
                                <th>التاريخ</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($wallet->details as $detail)
                            <tr>
                                <td>{{ $detail->id }}</td>
                                <td>{{ $detail->name }}</td>
                                <td>{{ number_format($detail->amount, 2) }}</td>
                                <td>{{ $detail->details }}</td>
                                <td>{{ $detail->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">لا توجد تفاصيل لهذه المحفظة</td>
                            </tr>
                            @endforelse
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
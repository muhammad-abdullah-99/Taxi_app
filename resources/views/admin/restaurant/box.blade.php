@extends('layouts.master')

@section('title')
تقرير مجموع المبالغ اليومية للصندوق
@endsection

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">تقرير مجموع المبالغ اليومية</h4>
        </div>
    </div>
</div>
@endsection

@section('content')

@if(session()->has('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th>التاريخ</th>
                                <th>إجمالي المبلغ (ريال)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dailyTotals as $total)
                            <tr>
                                <td>{{ $total->date }}</td>
                                <td>{{ number_format($total->total_amount, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2">لا توجد بيانات حالياً.</td>
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

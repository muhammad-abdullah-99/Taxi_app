@extends('layouts.master')

@section('title', 'تفاصيل الباقات')

@section('content')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> تفاصيل الباقات</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الباقة</th>
                                <th>النوع</th>
                                <th>عدد المشتركين</th>
                                <th>إجمالي المبلغ</th>
                                <th>آخر تحديث</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($packages as $package)
                                <tr>
                                    <td>{{ $package->id }}</td>
                                    <td>{{ $package->name }}</td>
                                    <td>{{ $package->type }}</td>
                                    <td>{{ $package->subDetail->count ?? 0 }}</td>
                                    <td>{{ number_format($package->subDetail->amount ?? 0, 2) }}</td>
                                    <td>{{ optional($package->subDetail)->updated_at ? $package->subDetail->updated_at->format('Y-m-d') : '-' }}</td>
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

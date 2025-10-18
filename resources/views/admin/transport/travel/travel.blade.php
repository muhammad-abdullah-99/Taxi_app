@extends('layouts.master')

@section('title', 'تفاصيل الرحلات')

@section('content')
<div class="page-title">
    <div class="row mb-3">
        <div class="col-sm-6">
            <h4 class="mb-0">تفاصيل الرحلات</h4>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('showAllTravels', ['status' => null]) }}" class="btn btn-outline-primary {{ is_null($status) ? 'active' : '' }}">الكل</a>
            <a href="{{ route('showAllTravels', ['status' => 'انتظار']) }}" class="btn btn-outline-warning {{ $status == 'انتظار' ? 'active' : '' }}">انتظار</a>
            <a href="{{ route('showAllTravels', ['status' => 'جارية']) }}" class="btn btn-outline-info {{ $status == 'جارية' ? 'active' : '' }}">جارية</a>
            <a href="{{ route('showAllTravels', ['status' => 'مكتملة']) }}" class="btn btn-outline-success {{ $status == 'مكتملة' ? 'active' : '' }}">مكتملة</a>
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
                                <th>السائق</th>
                                <th>من</th>
                                <th>إلى</th>
                                <th>التاريخ</th>
                                <th>الوقت</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($travels as $travel)
                            <tr>
                                <td>{{ $travel->id }}</td>
                                <td>{{ $travel->appUser->name ?? 'N/A' }}</td>
                                <td>{{ $travel->from }}</td>
                                <td>{{ $travel->to }}</td>
                                <td>{{ $travel->date }}</td>
                                <td>{{ $travel->time }}</td>
                                <td>{{ $travel->status }}</td>
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
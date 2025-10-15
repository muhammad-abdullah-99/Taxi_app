@extends('layouts.master')

@section('title', 'تحديثات  المستند')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">تحديثات المستند: {{ $document->name }}</h3>



    @if($updates->isEmpty())
        <div class="alert alert-warning">لا توجد تحديثات  لهذا المستند.</div>
    @else
    <div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>تاريخ التحديث</th>
                                <th>بواسطة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($updates as $index => $update)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $update->created_at->format('Y-m-d') }}</td>  
                                    <td>{{ $update->user_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    @endif
</div>


@endsection

@extends('layouts.master')
@section('css')

@section('title')
جميع النماذج
@stop
@endsection

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">جميع النماذج</h4>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>اسم النموذج</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>مخالصة مالية</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#moghalsa">
                                        طباعة
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>استلام راتب </td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#ratb">
                                        طباعة
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>تفويض قيادة
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#tafwed">
                                        طباعة
                                    </button>
                                </td>
                            </tr>
                                <tr>
                                <td> 
                                    اقرار تسليم مركبة
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#tasleemMarkba">
                                        طباعة
                                    </button>
                                </td>
                            </tr>
                                <tr>
                                <td>
                                    اقرار اعادة مركبة 
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#a3daMarkba">
                                        طباعة
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- 1 -->
                    @include('admin.prints.print-modal', [
                    'modalId' => 'moghalsa',
                    'route' => 'getMoghalsa',
                    'employee' => $employee ?? null
                    ])
                    <!-- 2 -->
                    @include('admin.prints.print-modal', [
                    'modalId' => 'ratb',
                    'route' => 'getRatb',
                    'employee' => $employee ?? null
                    ])
                    <!-- 3 -->
                    @include('admin.prints.print-tafwed-modal', [
                    'modalId' => 'tafwed',
                    'route' => 'gettafwed',
                    'employee' => $employee ?? null
                    ])
                    <!-- 4 -->
                      @include('admin.prints.print-tasleemMarkba-modal', [
                    'modalId' => 'tasleemMarkba',
                    'route' => 'gettasleemMarkba',
                    'employee' => $employee ?? null
                    ])
                    <!-- 5-->
                      @include('admin.prints.print-a3daMarkba-modal', [
                    'modalId' => 'a3daMarkba',
                    'route' => 'geta3daMarkba',
                    'employee' => $employee ?? null
                    ])
                    <!-- 6-->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection
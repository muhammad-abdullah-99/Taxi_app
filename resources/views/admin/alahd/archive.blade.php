@extends('layouts.master')

@section('css')
@endsection

@section('title')
العهد
@stop

@section('page-header')
<div class="container">
    <h2> ارشيف العهد</h2>


    <!-- جدول عرض العهد (مثال بسيط) -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                            <thead>
                                <tr>
                                    <th>اسم العهدة</th>
                                    <th>الوصف</th>
                                    <th>العدد</th>
                                    <th>بواسطة</th>
                                    <th>عرض البيانات</th>
                                    <th>الاجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alahdas as $alahda)
                                <tr>
                                    <td>{{ $alahda->name }}</td>
                                    <td>{{ $alahda->description }}</td>
                                    <td>{{ $alahda->count }}</td>
                                    <td>{{ $alahda->user_name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#showdata{{ $alahda->id }}">عرض</button>

                                        <!-- Modal عرض البيانات لكل عهدة -->
                                        <div class="modal fade" id="showdata{{ $alahda->id }}" tabindex="-1" role="dialog" aria-labelledby="showSerialsLabel{{ $alahda->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="showSerialsLabel{{ $alahda->id }}">الأرقام التسلسلية للعهدة</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if($alahda->alahdaCounts->count())
                                                        <ul class="list-group">
                                                            @foreach($alahda->alahdaCounts as $c)
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <strong>رقم:</strong> <span>{{ $c->serial_number }}</span>
                                                            </li>
                                                            @endforeach
                                                        </ul>
                                                        @else
                                                        <div class="alert alert-warning text-center">
                                                            لا توجد أرقام تسلسلية مدخلة.
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if (Auth::check() && Auth::user()->role == 'مسؤول')
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#archive{{ $alahda->id }}">
                                            <i class="fa fa-undo"></i>
                                        </button>
                                        @endif
                                        <div class="modal fade" id="archive{{ $alahda->id }}" tabindex="-1" role="dialog" aria-labelledby="archiveCarModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="archiveCarModalLabel">أرشفة العهدة </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('unarchiveAlahda', $alahda->id) }}" method="post">
                                                            @csrf
                                                            <p>هل أنت متأكد من أنك تريد الغاء ارشفة هذه العهده ؟</p>
                                                            <button type="submit" class="btn btn-warning"> حفظ </button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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



</div>

<!-- سكريبتات Bootstrap و jQuery -->

@endsection

@section('js')
@endsection
@extends('layouts.master')

@section('css')
@endsection

@section('title')
 السندات
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"  >  السندات ليوم {{$date}} </h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">
                   
                </li>
            </ol>
        </div>
    </div>
</div>




<!-- breadcrumb -->
@endsection

@section('content')



<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                    <thead>
                            <tr>
                                <th>نوع السند</th>
                                <th> العميل</th>
                                <th>المبلغ الأساسي</th>
                                <th>الضريبة</th>
                                <th>الإجمالي</th>
                                <th>طريقة الدفع</th>
                                <th>التاريخ</th>
                                <th>الوصف</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($snds as $snd)
                            @php
                            $baseAmount = floatval($snd->amount);
                            $taxLabel = $snd->tax;
                            $taxValue = 0;
                            $total = $baseAmount;

                            if ($taxLabel === 'شامل الضريبة') {
                            $baseAmount = $baseAmount / 1.15;
                            $taxValue = $snd->amount - $baseAmount;
                            $total = $snd->amount;
                            } elseif ($taxLabel === 'غير شامل الضريبة') {
                            $taxValue = $baseAmount * 0.15;
                            $total = $baseAmount + $taxValue;
                            } elseif ($taxLabel === ' غير خاضع للضريبة ') {
                            $taxValue = 0;
                            $total = $baseAmount;
                            }
                            @endphp
                            <tr>
                                <td>{{ $snd->type }}</td>




                                <td>
                                    @if($snd->type == 'تحويل داخلي')
                                    <div>
                                        <strong>من:</strong>
                                        @if($snd->client_type !== 'موظف' && $snd->employee)
                                        <strong>موظف:</strong> {{ $snd->employee->name }}
                                        @elseif($snd->client_type !== 'سيارة' && $snd->car)
                                        <strong>سيارة:</strong> {{ $snd->car->name }} <br>
                                        <small>اللوحة: {{ $snd->car->plate_number ?? 'غير متوفر' }}</small><br>
                                        <small>الموديل: {{ $snd->car->model ?? 'غير متوفر' }}</small>

                                        @elseif($snd->client_type !== 'جهة' && $snd->geha)
                                        <strong>جهة:</strong> {{ $snd->geha->name }}
                                        @else
                                        غير معروف
                                        @endif

                                    </div>

                                    <div>
                                        <strong>إلى:</strong>
                                        @if($snd->client_type == 'موظف' && $snd->employee)
                                        موظف: {{ $snd->employee->name }}
                                        @elseif($snd->client_type == 'سيارة' && $snd->car)
                                        سيارة: {{ $snd->car->name }}<br>
                                        <small>اللوحة: {{ $snd->car->plate_number ?? 'غير متوفر' }}</small><br>
                                        <small>الموديل: {{ $snd->car->model ?? 'غير متوفر' }}</small>
                                        @elseif($snd->client_type == 'جهة' && $snd->geha)
                                        <strong>جهة:</strong> {{ $snd->geha->name }}
                                        @else
                                        غير معروف
                                        @endif
                                    </div>
                                    @else
                                    @if($snd->client_type == 'موظف' && $snd->employee)
                                    <strong>موظف:</strong> {{ $snd->employee->name }}
                                    @elseif($snd->client_type == 'سيارة' && $snd->car)
                                    <strong>سيارة:</strong> {{ $snd->car->name }} <br>
                                    <small>اللوحة: {{ $snd->car->plate_number ?? 'غير متوفر' }}</small><br>
                                    <small>الموديل: {{ $snd->car->model ?? 'غير متوفر' }}</small>

                                    @elseif($snd->client_type == 'جهة' && $snd->geha)
                                    <strong>جهة:</strong> {{ $snd->geha->name }}



                                    @else
                                    <span class="text-muted">غير محدد</span>
                                    @endif
                                    @endif

                                </td>

                                <td>{{ number_format($baseAmount, 2) }}</td>
                                <td>{{ number_format($taxValue, 2) }} <br> <small>({{ $taxLabel }})</small></td>
                                <td>{{ number_format($total, 2) }}</td>
                                <td>{{ $snd->payment_method }}</td>
                                <td>{{ $snd->date }}</td>
                                <td>{{ $snd->description }}</td>
                                <td>
                                    <form action="{{ route('print.snd') }}" method="POST" target="_blank">
                                        @csrf
                                        <input type="hidden" name="snd_id" value="{{ $snd->id }}">
                                        <button type="submit" class="btn btn-sm btn-success">طباعة</button>
                                    </form>
                                    </br>
@if ($snd->payment_method == 'كاش' || $snd->payment_method == 'بوابة الدفع')
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#bank{{ $snd->id }}">
                                     تحويل بنك
                                    </button> 
                                    @endif


                                    <!-- @if($snd->type == 'قبض' || $snd->type == 'صرف')
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editSndModal" style="font-size: 16px; font-family:Amiri; line-height: 1.2;">
                                        <i class="fa fa-edit"></i> - تعديل
                                    </button>
                                    @endif

                                    @if($snd->type == 'تحويل داخلي')
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editTransferModal" style="font-size: 16px; font-family:Amiri; line-height: 1.2;">
                                        <i class="fa fa-edit"></i> - تعديل
                                    </button>
                                    @endif -->
                                </td>

                                <div class="modal fade" id="bank{{ $snd->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"> تحويل بنك </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('postSndToBankAlRayad', $snd->id) }}" method="post">
                                                @csrf
                                                <h4 class="modal-body">تحويل الي بنك الرياض  ؟</h4>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                    <button type="submit" class="btn btn-danger">تاكيد</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- نافذة تعديل سند -->
                                <div class="modal fade" id="editSndModal" tabindex="-1" role="dialog" aria-labelledby="editSndModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editSndModalLabel">تعديل سند</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="#" method="post">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" name="id" id="edit_snd_id">
                                                    <div class="form-group">
                                                        <label for="edit_type">نوع السند</label>
                                                        <select name="type" id="edit_type" class="form-control">
                                                            <option value="قبض">قبض</option>
                                                            <option value="صرف">صرف</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="edit_client_type">نوع العميل</label>
                                                        <select name="client_type" id="edit_client_type" class="form-control">
                                                            <option value="سيارة">سيارة</option>
                                                            <option value="موظف">موظف</option>
                                                            <option value="جهة">جهة</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group" id="edit_clientSelect">
                                                        <label for="edit_client">اختر العميل</label>
                                                        <select name="client_id" id="edit_client" class="form-control">
                                                            <option value="">اختر...</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="edit_payment_method">طريقة الدفع</label>
                                                        <select name="payment_method" id="edit_payment_method" class="form-control">
                                                            <option value="كاش">كاش</option>
                                                            <option value="تحويل بنكي">تحويل بنكي</option>
                                                            <option value="نقاط بيع">نقاط بيع</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="edit_amount">المبلغ</label>
                                                        <input type="number" name="amount" id="edit_amount" class="form-control" placeholder="المبلغ">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="edit_tax">الضريبة</label>
                                                        <select name="tax" id="edit_tax" class="form-control">
                                                            <option value="شامل الضريبة">شامل الضريبة</option>
                                                            <option value="غير شامل الضريبة">غير شامل الضريبة</option>
                                                            <option value="غير خاضع للضريبة">غير خاضع للضريبة</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="edit_total">الاجمالي</label>
                                                        <input type="number" id="edit_total" class="form-control" placeholder="الاجمالي" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="edit_description">الوصف</label>
                                                        <textarea name="description" id="edit_description" class="form-control" rows="3" placeholder="الوصف"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="edit_date">التاريخ</label>
                                                        <input type="date" name="date" id="edit_date" class="form-control">
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">تعديل السند</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- نافذة تعديل تحويل داخلي -->
                                <div class="modal fade" id="editTransferModal" tabindex="-1" role="dialog" aria-labelledby="editTransferModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">تعديل تحويل داخلي</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="#" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="id" id="edit_transfer_id">

                                                    <div class="form-group">
                                                        <label>من حساب</label>
                                                        <select name="from_type" id="edit_from_type" class="form-control">
                                                            <option>اختر موظف أو سيارة أو جهة</option>
                                                            <option value="موظف">موظف</option>
                                                            <option value="سيارة">سيارة</option>
                                                            <option value="جهة">جهة</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="from_id" id="edit_from_id" class="form-control">
                                                            <option value="">اختر الحساب الأول</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>إلى حساب</label>
                                                        <select name="to_type" id="edit_to_type" class="form-control">
                                                            <option value="">اختر موظف أو سيارة أو جهة</option>
                                                            <option value="موظف">موظف</option>
                                                            <option value="سيارة">سيارة</option>
                                                            <option value="جهة">جهة</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="to_id" id="edit_to_id" class="form-control">
                                                            <option value="">اختر الحساب الثاني</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>المبلغ</label>
                                                        <input type="number" name="amount" id="edit_transfer_amount" class="form-control" placeholder="المبلغ">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>الضريبة</label>
                                                        <select name="tax" id="edit_transfer_tax" class="form-control">
                                                            <option value="شامل الضريبة">شامل الضريبة</option>
                                                            <option value="غير شامل الضريبة">غير شامل الضريبة</option>
                                                            <option value="غير خاضع للضريبة">غير خاضع للضريبة</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>الإجمالي</label>
                                                        <input type="number" id="edit_transfer_total" class="form-control" readonly>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>الوصف</label>
                                                        <textarea name="description" id="edit_transfer_description" class="form-control" rows="3"></textarea>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>التاريخ</label>
                                                        <input type="date" name="date" id="edit_transfer_date" class="form-control">
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">تعديل التحويل</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>



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
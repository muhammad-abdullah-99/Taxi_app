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
            <h4 class="mb-0"> السندات لشهر {{$month}} </h4>
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
                                <th>حساب بنكي</th>
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
                                <td>{{ $snd->bank_account}}</td>
                                <td>
                                    <div class="d-inline-flex gap-1">
                                        <form action="{{ route('print.snd') }}" method="POST" target="_blank" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="snd_id" value="{{ $snd->id }}">
                                            <button type="submit" class="btn btn-sm btn-success">طباعة</button>
                                        </form>
- 
                                        @if (Auth::check() && Auth::user()->role == 'مسؤول')
                                        <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#account_bank{{ $snd->id }}">
                                            تعديل
                                        </button>
                                        @endif
                                    </div>
                                </td>

                                <!-- Modal تعديل الحساب البنكي -->
                                <div class="modal fade" id="account_bank{{ $snd->id }}" tabindex="-1" role="dialog" aria-labelledby="account_bankLabel{{ $snd->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{route('snd.updateBankAccount')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="snd_id" value="{{ $snd->id }}">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="account_bankLabel{{ $snd->id }}">تعديل الحساب البنكي</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="bank_account">اختر الحساب البنكي:</label>
                                                    <select name="bank_account" class="form-control" required>
                                                        <option value="">-- اختر الحساب --</option>
                                                        <option value="شركة الجواب - بنك الراجحي" {{ $snd->bank_account == 'شركة الجواب - بنك الراجحي' ? 'selected' : '' }}>شركة الجواب - بنك الراجحي</option>
                                                        <option value="شركة الجواب - بنك الرياض" {{ $snd->bank_account == 'شركة الجواب - بنك الرياض' ? 'selected' : '' }}>شركة الجواب - بنك الرياض</option>
                                                        <option value="الراجحي - ابو احمد" {{ $snd->bank_account == 'الراجحي - ابو احمد' ? 'selected' : '' }}>الراجحي - ابو احمد</option>
                                                        <option value="الراجحي - ابو طلال" {{ $snd->bank_account == 'الراجحي - ابو طلال' ? 'selected' : '' }}>الراجحي - ابو طلال</option>
                                                        <option value="مؤسسة الجواب - بنك الراجحي" {{ $snd->bank_account == 'مؤسسة الجواب - بنك الراجحي' ? 'selected' : '' }}>مؤسسة الجواب - بنك الراجحي</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                </div>
                                            </div>
                                        </form>
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
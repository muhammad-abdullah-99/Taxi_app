@extends('layouts.master')

@section('css')
@endsection

@section('title')
إدارة السندات
@stop

@section('page-header')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">إدارة السندات</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addSndModal" style="font-size: 16px; font-family:Amiri; line-height: 1.2;">
                        <i class="fa fa-plus"></i> - إضافة سند (بوابة الدفع )
                    </button>
                </li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')

<!-- عرض الأخطاء -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<!-- نهاية الأخطاء -->


<div class="row text-center mb-4">
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0 bg-light rounded-4">
            <div class="card-body">
                <h5 class="text-primary mb-3">إجمالي المبلغ الأساسي</h5>
                <p class="text-success">القبض: {{ number_format($total_base_qabd, 2) }} ريال</p>
                <p class="text-danger">الصرف: {{ number_format($total_base_sarf, 2) }} ريال</p>
                <p><strong class="text-dark">الرصيد: {{ number_format($total_base_qabd - $total_base_sarf, 2) }} ريال</strong></p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0 bg-light rounded-4">
            <div class="card-body">
                <h5 class="text-primary mb-3">الإجمالي الكلي</h5>
                <p class="text-success">القبض: {{ number_format($total_qabd, 2) }} ريال</p>
                <p class="text-danger">الصرف: {{ number_format($total_sarf, 2) }} ريال</p>
                <p><strong class="text-dark">الرصيد: {{ number_format($total_qabd - $total_sarf, 2) }} ريال</strong></p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0 bg-light rounded-4">
            <div class="card-body">
                <h5 class="text-primary mb-3">إجمالي الضرائب</h5>
                <p class="text-success">ضريبة القبض: {{ number_format($tax_qabd, 2) }} ريال</p>
                <p class="text-danger">ضريبة الصرف: {{ number_format($tax_sarf, 2) }} ريال</p>
                <p><strong class="text-dark"> الفرق : {{ number_format($tax_qabd - $tax_sarf, 2) }} ريال</strong></p>
            </div>
        </div>
    </div>
</div>



<!-- نافذة إضافة سند -->
<div class="modal fade" id="addSndModal" tabindex="-1" role="dialog" aria-labelledby="addSndModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSndModalLabel">إضافة سند جديد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="sndForm" action="{{ route('createPaymentAndRedirect') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="type">نوع السند</label>
                        <select name="type" id="type" class="form-control">
                            <option value="قبض">قبض</option>
                            <option value="صرف">صرف</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="client_type">نوع العميل</label>
                        <select name="client_type" id="client_type" class="form-control">
                            <option value="سيارة">سيارة</option>
                            <option value="موظف">موظف</option>
                            <option value="جهة">جهة</option>
                        </select>
                    </div>

                    <div class="form-group" id="clientSelect">
                        <label for="client">اختر العميل</label>
                        <input type="text" id="clientSearch" class="form-control mb-2" placeholder="ابحث عن العميل...">
                        <select name="client_id" id="client" class="form-control">
                            <option value="">اختر...</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="payment_method">طريقة الدفع</label>
                        <select name="payment_method" id="payment_method" class="form-control">
                            <option value="بوابة الدفع" selected>بوابة الدفع</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="bank_account">اختر الحساب البنكي:</label>
                        <select name="bank_account" class="form-control">
                            <option value="">-- اختر الحساب --</option>
                            <option value="شركة الجواب - بنك الراجحي">شركة الجواب - بنك الراجحي</option>
                            <option value="شركة الجواب - بنك الرياض">شركة الجواب - بنك الرياض</option>
                            <option value="الراجحي - ابو احمد">الراجحي - ابو احمد</option>
                            <option value="الراجحي - ابو طلال">الراجحي - ابو طلال</option>
                            <option value="مؤسسة الجواب - بنك الراجحي">مؤسسة الجواب - بنك الراجحي</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amount">المبلغ</label>
                        <input type="number" name="amount" id="amount" class="form-control" step="any">
                    </div>

                    <div class="form-group">
                        <label for="tax">الضريبة</label>
                        <select name="tax" id="tax" class="form-control">
                            <option value="غير خاضع للضريبة">غير خاضع للضريبة</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="total">الإجمالي</label>
                        <input type="number" id="total" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="description">الوصف</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="date">التاريخ</label>
                        <input type="date" name="date" class="form-control" value="{{ old('date') }}">
                    </div>

                    {{-- نموذج البطاقة البنكية --}}
                    <div>
                        <hr>
                        <h5>بيانات البطاقة</h5>
                        <div class="form-group">
                            <label for="name">الاسم على البطاقة</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="number">رقم البطاقة</label>
                            <input type="text" name="number" class="form-control" maxlength="16">
                        </div>

                        <div class="form-group">
                            <label for="cvc">رمز الأمان (CVC)</label>
                            <input type="text" name="cvc" class="form-control" maxlength="4">
                        </div>

                        <div class="form-group">
                            <label for="month">شهر الانتهاء</label>
                            <input type="text" name="month" class="form-control" placeholder="مثلاً: 08">
                        </div>

                        <div class="form-group">
                            <label for="year">سنة الانتهاء</label>
                            <input type="text" name="year" class="form-control" placeholder="مثلاً: 2026">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">إضافة السند</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!--  تحويل دخلي -->
<!-- جدول عرض السندات -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead class="table-dark">
                            <tr>
                                <th>التاريخ</th>
                                <th>عدد السندات</th>
                                <th>إجمالي القبض</th>
                                <th>إجمالي الصرف</th>
                                <th>إجمالي التحويل الداخلي</th>
                                <th>الرصيد</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($report as $day)
                            <tr>
                                <td>{{ $day['date'] }}</td>
                                <td>{{ $day['count'] }}</td>
                                <td>{{ number_format($day['qabd'], 2) }}</td>
                                <td>{{ number_format($day['sarf'], 2) }}</td>
                                <td>{{ number_format($day['internal'], 2) }}</td>
                                <td>{{ number_format($day['balance'], 2) }}</td>
                                <td>
                                    <a href="{{ route('OnlinePayment.snds.byDate',  $day['date']) }}" class="btn btn-primary btn-sm"> عرض </a>

                                    @if (Auth::check() && Auth::user()->role == 'مسؤول')
                                    <!-- <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#bank{{ $day['date'] }}">
                                        تاكيد
                                    </button> -->
                                    @endif
                                </td>
                                <div class="modal fade" id="bank{{ $day['date'] }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">البنك </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('postSndDateToBank',$day['date'] ) }}" method="post">
                                                @csrf
                                                <h4 class="modal-body">تحويل الي البنك ؟</h4>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                    <button type="submit" class="btn btn-danger">تاكيد</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>



                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">لا توجد بيانات سندات متاحة</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        let fullClientList = [];

        $('#client_type').change(function() {
            var clientType = $(this).val();
            if (clientType === 'سيارة') {
                loadClients('/get-cars', 'cars', function(car) {
                    return {
                        id: car.id,
                        text: car.name + ' - ' + car.plate_number
                    };
                });
            } else if (clientType === 'موظف') {
                loadClients('/get-employees', 'employees', function(emp) {
                    return {
                        id: emp.id,
                        text: emp.name
                    };
                });
            } else if (clientType === 'جهة') {
                loadClients('/get-gehas', 'gehas', function(geha) {
                    return {
                        id: geha.id,
                        text: geha.name
                    };
                });
            } else {
                $('#client').html('<option value="">اختر...</option>');
                fullClientList = [];
            }
        });

        function loadClients(url, key, mapFn) {
            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    fullClientList = data[key].map(mapFn);
                    renderClientOptions(fullClientList);
                }
            });
        }

        function renderClientOptions(list) {
            var options = '<option value="">اختر...</option>';
            list.forEach(function(item) {
                options += '<option value="' + item.id + '">' + item.text + '</option>';
            });
            $('#client').html(options);
        }

        // فلترة عند الكتابة في حقل البحث
        $('#clientSearch').on('input', function() {
            var keyword = $(this).val().toLowerCase();
            var filtered = fullClientList.filter(function(item) {
                return item.text.toLowerCase().includes(keyword);
            });
            renderClientOptions(filtered);
        });
    });
</script>
<script>
    const amountInput = document.getElementById('amount');
    const taxSelect = document.getElementById('tax');
    const totalInput = document.getElementById('total');

    function calculateTotal() {
        const amount = parseFloat(amountInput.value) || 0;
        const tax = taxSelect.value;

        let total = amount;

        if (tax === 'شامل الضريبة') {
            total = amount / 1.15;
        } else if (tax === 'غير شامل الضريبة') {
            total = amount * 1.15;
        } else if (tax === 'خاضع للضريبة') {
            total = amount;
        }

        totalInput.value = total.toFixed(2);
    }

    amountInput.addEventListener('input', calculateTotal);
    taxSelect.addEventListener('change', calculateTotal);
</script>



@endsection

@section('js')
@endsection
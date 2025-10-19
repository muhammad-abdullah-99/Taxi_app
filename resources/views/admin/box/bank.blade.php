@extends('layouts.master')

@section('css')
@endsection

@section('title')
المبالغ النقدية المؤكده
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> البنك</h4>
        </div>
        <!-- <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addSndModal" style="font-size: 16px; font-family:Amiri; line-height: 1.2;">
                        <i class="fa fa-plus"></i> - إضافة سند (قبض - صرف)
                    </button>
                </li>

                <li class="breadcrumb-item">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addTransferModal" style="font-size: 16px; font-family:Amiri; line-height: 1.2;">
                        <i class="fa fa-plus"></i> - إضافة سند (تحويل داخلي )
                    </button>
                </li>
            </ol>
        </div> -->
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



<form method="GET" action="{{ route('getBank') }}" class="mb-3 p-3 bg-info">
    <div class="row">
        <div class="col-md-4 ">
            <label class="text-white">من تاريخ:</label>
            <input type="date" name="from_date" class="form-control" value="{{ request('from_date') }}">
        </div>
        <div class="col-md-4">
            <label class="text-white">إلى تاريخ:</label>
            <input type="date" name="to_date" class="form-control" value="{{ request('to_date') }}">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-light w-100">تصفية</button>
        </div>
    </div>
</form>


</br>



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
                <form action="{{ route('storeSnd') }}" method="post">
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
                        <select name="client_id" id="client" class="form-control">
                            <option value="">اختر...</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="payment_method">طريقة الدفع</label>
                        <select name="payment_method" id="payment_method" class="form-control">
                            <option value="كاش">كاش</option>
                            <option value="تحويل بنكي">تحويل بنكي</option>
                            <option value="نقاط بيع">نقاط بيع</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="amount">المبلغ</label>
                        <input type="number" name="amount" id="amount" class="form-control" placeholder="المبلغ">
                    </div>

                    <div class="form-group">
                        <label for="tax">الضريبة</label>
                        <select name="tax" id="tax" class="form-control">
                            <option value="شامل الضريبة">شامل الضريبة</option>
                            <option value="غير شامل الضريبة">غير شامل الضريبة</option>
                            <option value="غير خاضع للضريبة">غير خاضع للضريبة</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="total">الاجمالي</label>
                        <input type="number" id="total" class="form-control" placeholder="الاجمالي" readonly>
                    </div>

                    <div class="form-group">
                        <label for="description">الوصف</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="الوصف"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="date">التاريخ</label>
                        <input type="date" name="date" class="form-control" value="{{ old('date') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">إضافة السند</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--  تحويل دخلي -->

<!-- نافذة إضافة تحويل داخلي -->
<div class="modal fade" id="addTransferModal" tabindex="-1" role="dialog" aria-labelledby="addTransferModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة تحويل داخلي</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('storeSnd') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="تحويل داخلي">

                    <!-- الحساب الأول -->
                    <div class="form-group">
                        <label>من حساب</label>
                        <select name="from_type" id="from_type" class="form-control">
                            <option>اختر موظف أو سيارة أو جهة</option>
                            <option value="موظف">موظف</option>
                            <option value="سيارة">سيارة</option>
                            <option value="جهة">جهة</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="from_id" id="from_id" class="form-control">
                            <option value="">اختر الحساب الأول</option>
                        </select>
                    </div>

                    <!-- الحساب الثاني -->
                    <div class="form-group">
                        <label>إلى حساب</label>
                        <select name="to_type" id="to_type" class="form-control">
                            <option value="">اختر موظف أو سيارة أو جهة</option>
                            <option value="موظف">موظف</option>
                            <option value="سيارة">سيارة</option>
                            <option value="جهة">جهة</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="to_id" id="to_id" class="form-control">
                            <option value="">اختر الحساب الثاني</option>
                        </select>
                    </div>

                    <!-- المبلغ والضريبة -->
                    <div class="form-group">
                        <label>المبلغ</label>
                        <input type="number" name="amount" id="transfer_amount" class="form-control" placeholder="المبلغ">
                    </div>

                    <div class="form-group">
                        <label>الضريبة</label>
                        <select name="tax" id="transfer_tax" class="form-control">
                            <option value="شامل الضريبة">شامل الضريبة</option>
                            <option value="غير شامل الضريبة">غير شامل الضريبة</option>
                            <option value="غير خاضع للضريبة">غير خاضع للضريبة</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>الإجمالي</label>
                        <input type="number" id="transfer_total" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label>الوصف</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label>التاريخ</label>
                        <input type="date" name="date" class="form-control" value="{{ old('date') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">إضافة التحويل</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- جدول عرض السندات -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead class="thead-dark">
                            <tr>
                                <th>الشهر</th>
                                <th>عدد السندات</th>
                                <th>إجمالي القبض</th>
                                <th>إجمالي الصرف</th>
                                <th>التحويل الداخلي</th>
                                <th>الرصيد</th>
                                <th>الإجراءات</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($report as $row)
                            <tr>
                                <td>{{ $row['month'] }}</td>
                                <td>{{ $row['count'] }}</td>
                                <td>{{ number_format($row['qabd'], 2) }}</td>
                                <td>{{ number_format($row['sarf'], 2) }}</td>
                                <td>{{ number_format($row['internal'], 2) }}</td>
                                <td>{{ number_format($row['balance'], 2) }}</td>
                                <td>
                                    @php
                                    $monthParts = explode('-', $row['month']); // ['04', '2025']
                                    $formattedMonth = $monthParts[1] . '-' . $monthParts[0]; // '2025-04'
                                    @endphp

                                    <a href="{{ route('snds.byDateBank', $formattedMonth) }}" class="btn btn-primary btn-sm">عرض</a>
                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">لا توجد بيانات</td>
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
        $('#client_type').change(function() {
            var clientType = $(this).val();
            if (clientType === 'سيارة') {
                loadCars();
            } else if (clientType === 'موظف') {
                loadEmployees();
            } else if (clientType === 'جهة') {
                loadGehas();
            }
        });

        function loadCars() {
            $.ajax({
                url: '/get-cars',
                method: 'GET',
                success: function(data) {
                    var options = '<option value="">اختر سيارة</option>';
                    data.cars.forEach(function(car) {
                        options += '<option value="' + car.id + '">' + car.name + ' - ' + car.plate_number + '</option>';
                    });
                    $('#client').html(options);
                }
            });
        }

        function loadEmployees() {
            $.ajax({
                url: '/get-employees',
                method: 'GET',
                success: function(data) {
                    var options = '<option value="">اختر موظف</option>';
                    data.employees.forEach(function(emp) {
                        options += '<option value="' + emp.id + '">' + emp.name + '</option>';
                    });
                    $('#client').html(options);
                }
            });
        }

        function loadGehas() {
            $.ajax({
                url: '/get-gehas',
                method: 'GET',
                success: function(data) {
                    var options = '<option value="">اختر جهة</option>';
                    data.gehas.forEach(function(geha) {
                        options += '<option value="' + geha.id + '">' + geha.name + '</option>';
                    });
                    $('#client').html(options);
                }
            });
        }
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

<script>
    $(document).ready(function() {
        // تحميل البيانات بناءً على النوع
        function loadAccounts(type, target) {
            let url = '';

            if (type === 'سيارة') url = '/get-cars';
            else if (type === 'موظف') url = '/get-employees';
            else if (type === 'جهة') url = '/get-gehas';

            $.get(url, function(data) {
                let options = '<option value="">اختر</option>';
                let list = [];

                if (type === 'سيارة') list = data.cars;
                else if (type === 'موظف') list = data.employees;
                else if (type === 'جهة') list = data.gehas;

                list.forEach(function(item) {
                    options += `<option value="${item.id}">${item.name}${item.plate_number ? ' - ' + item.plate_number : ''}</option>`;
                });

                $(target).html(options);
            });
        }

        // تعريف متغيرات لحفظ البيانات للطرفين
        let fromData = {
            type: '',
            id: null
        };

        let toData = {
            type: '',
            id: null
        };

        // عند تغيير نوع "من"
        $('#from_type').change(function() {
            let fromType = $(this).val();
            fromData.type = fromType;
            loadAccounts(fromType, '#from_id');
        });

        // عند اختيار الحساب من
        $('#from_id').change(function() {
            fromData.id = $(this).val();
            console.log("من حساب:", fromData);
        });

        // عند تغيير نوع "إلى"
        $('#to_type').change(function() {
            let toType = $(this).val();
            toData.type = toType;
            loadAccounts(toType, '#to_id');
        });

        // عند اختيار الحساب إلى
        $('#to_id').change(function() {
            toData.id = $(this).val();
            console.log("إلى حساب:", toData);
        });

        // لحساب الإجمالي بعد الضريبة
        document.getElementById('transfer_amount').addEventListener('input', calculateTransferTotal);
        document.getElementById('transfer_tax').addEventListener('change', calculateTransferTotal);

        function calculateTransferTotal() {
            const amount = parseFloat(document.getElementById('transfer_amount').value) || 0;
            const tax = document.getElementById('transfer_tax').value;
            let total = amount;

            if (tax === 'شامل الضريبة') {
                total = amount / 1.15;
            } else if (tax === 'غير شامل الضريبة') {
                total = amount * 1.15;
            }

            document.getElementById('transfer_total').value = total.toFixed(2);
        }

        // لو حابب تطبع البيانات الطرفين بعد الإرسال
        $('form').on('submit', function(e) {
            console.log("بيانات الطرف المحول منه:", fromData);
            console.log("بيانات الطرف المحول إليه:", toData);
        });
    });
</script>



<!-- //طباعه -->







@endsection

@section('js')
@endsection
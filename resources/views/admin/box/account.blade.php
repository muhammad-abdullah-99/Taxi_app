@extends('layouts.master')

@section('title')
كشف حساب
@stop

@section('css')
<style>
    body {
        background-color: #121212;
        color: #f0f0f0;
    }

    .card-box {
        background: #1e1e1e;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
        padding: 25px;
        margin-bottom: 30px;
        color: #fff;
    }

    .card-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 25px;
        color: #fff;
    }

    .form-label,
    label,
    select,
    input,
    h4,
    h5,
    h6,
    p,
    th,
    td {
        color: #f0f0f0;
    }

    .form-select,
    .form-control {
        background-color: #2a2a2a;
        color: #fff;
        border: 1px solid #444;
    }

    .form-select:focus,
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-dark {
        background-color: #007bff;
        border: none;
    }

    .btn-dark:hover {
        background-color: #0056b3;
    }

    .summary-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #2b2b2b;
        border-radius: 12px;
        overflow: hidden;
    }

    .summary-table th,
    .summary-table td {
        padding: 16px;
        text-align: center;
        border: 1px solid #444;
    }

    .summary-table thead {
        background-color: #333;
    }

    .summary-table tbody tr:nth-child(even) {
        background-color: #242424;
    }

    .highlight {
        font-weight: bold;
        font-size: 18px;
    }

    .text-success {
        color: #28a745 !important;
    }

    .text-danger {
        color: #dc3545 !important;
    }

    .text-warning {
        color: #ffc107 !important;
    }

    .text-info {
        color: #17a2b8 !important;
    }

    /* تنسيق عام للجدول والدورك مود */
    .table-responsive {
        overflow-x: auto;
    }

    table.table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background-color: #1e1e2f;
        /* خلفية داكنة للجدول */
        color: #ddd;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
    }

    table.table th,
    table.table td {
        padding: 12px 10px;
        border: 1px solid #333;
        vertical-align: middle;
        text-align: center;
        font-size: 14px;
    }

    table.table thead {
        background-color: #2c2c48;
        color: #a5c8ff;
        font-weight: 600;
    }

    table.table tbody tr:nth-child(odd) {
        background-color: #282838;
    }

    table.table tbody tr:nth-child(even) {
        background-color: #222233;
    }

    table.table tbody tr:hover {
        background-color: #3a3a55;
        cursor: pointer;
    }

    /* زرار العرض */
    .btn-primary {
        background-color: #4a90e2;
        border-color: #4a90e2;
        font-size: 13px;
        padding: 5px 10px;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #357abd;
        border-color: #357abd;
    }

    /* تنسيق المودال */
    .modal-content {
        background-color: #2c2c48;
        color: #ddd;
        border-radius: 12px;
        border: none;
    }

    .modal-header {
        border-bottom: 1px solid #444466;
        padding: 15px 20px;
    }

    .modal-title {
        color: #a5c8ff;
        font-weight: 700;
        font-size: 18px;
    }

    .modal-body {
        padding: 20px;
        max-height: 70vh;
        overflow-y: auto;
    }

    .modal-footer {
        border-top: 1px solid #444466;
        padding: 15px 20px;
    }

    .btn-secondary {
        background-color: #555577;
        border-color: #555577;
        color: #ddd;
    }

    .btn-secondary:hover {
        background-color: #444466;
        border-color: #444466;
    }

    /* تنسيق داخل المودال - الجدول */
    .modal-body .row.font-weight-bold {
        background-color: #3a3a55;
        color: #a5c8ff;
        font-weight: 700;
        border-bottom: 2px solid #5a5a88;
    }

    .modal-body .row.border-bottom {
        border-color: #444466;
        background-color: rgb(49, 49, 63) !important;
    }

    /* اجعل النصوص المختصرة لا تتجاوز الأعمدة */
    .text-truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* ازالة اللون الافتراضي عند اختيار الصف */
    .modal-body .row:hover {
        background-color: #505075 !important;
    }

    /* ألوان حسب نوع الضريبة - لتسهيل القراءة */
    .tax-shamil {
        color: #28a745;
        /* أخضر */
        font-weight: 600;
    }

    .tax-ghair-shamil {
        color: #dc3545;
        /* أحمر */
        font-weight: 600;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="card-box">
        <h2 class="card-title">كشف حساب</h2>


        <form method="GET" action="{{ route('employee.statement') }}" class="mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="filter_type" class="form-label">نوع الحساب:</label>
                    <select name="filter_type" id="filter_type" class="form-select">
                        <option value="">-- اختر النوع --</option>
                        <option value="employee" {{ request('filter_type') == 'employee' ? 'selected' : '' }}>موظف</option>
                        <option value="vehicle" {{ request('filter_type') == 'vehicle' ? 'selected' : '' }}>سيارة</option>
                        <option value="geha" {{ request('filter_type') == 'geha' ? 'selected' : '' }}>جهة</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="search_input" class="form-label">ابحث عن العنصر:</label>
                    <input type="text" id="search_input" class="form-control" placeholder="ابحث عن العنصر ">
                    <label for="item_id" class="form-label mt-2">اختر العنصر:</label>
                    <select name="item_id" id="item_id" class="form-select">
                        <option value="">-- اختر --</option>
                        @foreach($items as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->name ?? $item->plate_number }} {{$item->plate_number}}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="month" class="form-label">الشهر:</label>
                    <select name="month" id="month" class="form-select">
                        <option value="">-- اختر الشهر --</option>
                        @for($m = 1; $m <= 12; $m++)
                            <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ $m }}
                            </option>
                            @endfor
                    </select>
                </div>

                <div class="col-md-2">
                    <label for="year" class="form-label">السنة:</label>
                    <select name="year" id="year" class="form-select">
                        <option value="">-- اختر السنة --</option>
                        @for($y = now()->year; $y >= 2000; $y--)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-1">
                    <button type="submit" class="btn btn-dark w-100">عرض</button>
                </div>
            </div>
        </form>
        @if($selectedItem)
        <div class="mb-4">
            <h4 style="text-align: center; " class="text-white">كشف حساب لـ: <span>{{ $selectedItem->name ?? $selectedItem->plate_number }} {{$selectedItem->plate_number}}</span></h4>
        </div>

        <!-- جدول الملخص -->
        <table class="summary-table">
            <thead>
                <tr>
                    <th>إجمالي القبض</th>
                    <th>إجمالي الصرف</th>
                    <th>التحويل الداخلي</th>
                    <th>المتبقي</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-success highlight">{{ number_format($total_qabd, 2) }} ريال</td>
                    <td class="text-danger highlight">{{ number_format($total_sarf, 2) }} ريال</td>
                    <td class="text-warning highlight">{{ number_format($total_internal_transfer, 2) }} ريال</td>
                    <td class="text-info highlight">{{ number_format($remaining, 2) }} ريال</td>
                </tr>
            </tbody>
        </table>

        <!-- جدول الضرائب -->
        <table class="summary-table mt-4">
            <thead>
                <tr>
                    <th>ضريبة القبض</th>
                    <th>ضريبة الصرف</th>
                    <th>ضريبة التحويل الداخلي</th>
                    <th>إجمالي الضريبة</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-success highlight">{{ number_format($tax_qabd, 2) }} ريال</td>
                    <td class="text-danger highlight">{{ number_format($tax_sarf, 2) }} ريال</td>
                    <td class="text-warning highlight">{{ number_format($tax_internal_transfer, 2) }} ريال</td>
                    <td class="text-info highlight">{{ number_format($total_tax, 2) }} ريال</td>
                </tr>
            </tbody>
        </table>
        @endif
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th>الشهر</th>
                    @if ($filter_type === 'employee')
                    <th>اسم الموظف</th>
                    @endif
                    <th>عدد السندات</th>
                    @if ($filter_type !== 'employee')
                    <th>إجمالي الصرف</th>
                    @endif
                    @if ($filter_type === 'employee')
                    <th>استحقاق المركبة</th>
                    @endif
                    <th>استحقاقات أخرى (تحويلات داخلية)</th>
                    <th>إجمالي القبض</th>
                    <th>المتبقي</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($monthlyStatements as $key => $monthData)
                <tr>
                    <td>{{ $monthData['label'] }}</td>

                    @if ($filter_type === 'employee')
                    <td>
                        @php
                        $employees = collect($monthData['snds'])->pluck('employee.name')->filter()->unique()->implode('<br>');
                        @endphp
                        {!! $employees !!}
                    </td>
                    @endif

                    <td>{{ $monthData['count'] }}</td>

                    @if ($filter_type !== 'employee')
                    <td>{{ number_format($monthData['total_sarf'], 2) }}</td>
                    @endif

                    @if ($filter_type === 'employee')
                    <td>{{ number_format($monthData['vehicle_due'], 2) }}</td>
                    @endif

                    <td>{{ number_format($monthData['other_due'], 2) }}</td>
                    <td>{{ number_format($monthData['total_qabd'], 2) }}</td>
                    <td>{{ number_format($monthData['remaining'], 2) }}</td>
              <td>
    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal_{{ $key }}">عرض</button>

    @php
        $firstSnd = collect($monthData['snds'])->first();
        $employeeId = $firstSnd['employee_id'] ?? null;
        $monthValue = $monthData['label'] ?? null;
    @endphp


    @if($filter_type === 'employee' && $employeeId && $monthValue)
        <a href="{{ route('print.statement', [
            'employee_id' => $employeeId,
            'month' => $monthValue
        ]) }}"
        target="_blank"
        class="btn btn-sm btn-success mt-1">
             طباعة  
        </a>
    @endif
</td>



                </tr>

                <!-- Modal: تفاصيل السندات -->
                <div class="modal fade" id="modal_{{ $key }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel_{{ $key }}" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document" style="max-width: 90%;">
                        <div class="modal-content bg-dark text-white border-0 rounded-lg shadow">
                            <div class="modal-header border-bottom-0">
                                <h5 class="modal-title text-white" id="modalLabel_{{ $key }}">تفاصيل السندات - {{ $monthData['label'] }}</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="إغلاق">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

   


                            <div class="modal-body">
                                <div class="table-responsive">
                                    <div class="table w-100">
                                        <div class="row font-weight-bold border-bottom py-2 text-center bg-secondary">
                                            <div class="col-1">#</div>
                                            @if ($filter_type === 'employee')
                                            <div class="col-1">اسم الموظف</div>
                                            @endif
                                            <div class="col-1">نوع السند</div>
                                            <div class="col-1">المبلغ</div>
                                            <div class="col-3">الوصف</div>
                                            <div class="col-1">التاريخ</div>
                                            <div class="col-1">نوع الضريبة</div>
                                            <div class="col-1">الضريبة</div>
                                            <div class="col-1">الإجمالي</div>
                                            @if (Auth::check() && Auth::user()->role == 'مسؤول')
                                            <div class="col-1">إجراء</div>
                                            @endif


                                        </div>

                                        @foreach($monthData['snds'] as $snd)
                                        @php
                                        $amount = $snd['amount'];
                                        $tax_type = $snd['tax'];
                                        $baseAmount = $amount;
                                        $taxValue = 0;
                                        $total = $amount;

                                        if ($tax_type === 'شامل الضريبة') {
                                        $baseAmount = $amount / 1.15;
                                        $taxValue = $amount - $baseAmount;
                                        } elseif ($tax_type === 'غير شامل الضريبة') {
                                        $taxValue = $amount * 0.15;
                                        $total = $amount + $taxValue;
                                        }
                                        @endphp

                                        <div class="row border-bottom py-2 text-center align-items-center" style="color:#ddd;">
                                            <div class="col-1">{{ $snd['id'] }}</div>
                                            @if ($filter_type === 'employee')
                                            <div class="col-1 text-truncate" title="{{ $snd['employee']['name'] ?? '-' }}">{{ $snd['employee']['name'] ?? '-' }}</div>
                                            @endif
                                            <div class="col-1">{{ $snd['type'] }}</div>
                                            <div class="col-1">{{ number_format($baseAmount, 2) }}</div>
                                            <div class="col-3 text-truncate" title="{{ $snd['description'] }}">{{ $snd['description'] }}</div>
                                            <div class="col-1">{{ \Carbon\Carbon::parse($snd['date'])->format('Y-m-d') }}</div>
                                            <div class="col-1">{{ $tax_type }}</div>
                                            <div class="col-1">{{ number_format($taxValue, 2) }}</div>
                                            <div class="col-1">{{ number_format($total, 2) }}</div>
                                            @if (Auth::check() && Auth::user()->role == 'مسؤول')
                                            <div class="col-1">
                                                <button class="btn btn-sm btn-outline-light" data-toggle="modal" data-target="#editModal_{{ $snd['id'] }}">
                                                    تعديل
                                                </button>
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer border-top-0">
                                <button class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                @foreach($monthData['snds'] as $snd)
                <!-- Edit Modal -->
                <div class="modal fade" id="editModal_{{ $snd['id'] }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel_{{ $snd['id'] }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content bg-secondary text-white">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel_{{ $snd['id'] }}">تعديل السند - رقم {{ $snd['id'] }}</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="إغلاق">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="{{ route('update-snd', $snd['id']) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="description_{{ $snd['id'] }}">الوصف</label>
                                        <input type="text" class="form-control" name="description" id="description_{{ $snd['id'] }}" value="{{ $snd['description'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="date_{{ $snd['id'] }}">التاريخ</label>
                                        <input type="date" class="form-control" name="date" id="date_{{ $snd['id'] }}" value="{{ \Carbon\Carbon::parse($snd['date'])->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-light">حفظ التعديلات</button>
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">إلغاء</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach




                @empty
                <tr>
                    <td colspan="10" class="text-center py-3">لا توجد بيانات لعرضها</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>



<!--  -->


@endsection

@section('js')
<script>
    document.getElementById('filter_type').addEventListener('change', function() {
        this.form.submit();
    });

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search_input');
        const select = document.getElementById('item_id');
        const originalOptions = Array.from(select.options); // نحتفظ بالأوبشنات الأصلية

        searchInput.addEventListener('input', function() {
            const keyword = this.value.trim().toLowerCase();

            // نحذف كل الأوبشنات
            select.innerHTML = '';

            // نرجع أول أوبشن افتراضي
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.textContent = '-- اختر --';
            select.appendChild(defaultOption);

            // نفلتر ونضيف الأوبشنات المطابقة
            originalOptions.forEach(option => {
                if (option.value && option.textContent.toLowerCase().includes(keyword)) {
                    select.appendChild(option.cloneNode(true));
                }
            });
        });
    });
</script>

@endsection
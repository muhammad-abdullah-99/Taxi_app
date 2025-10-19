@extends('layouts.master')

@section('title', 'المركز المالي')

@section('content')

<style>
    /* جدول دارك مود */
    table.table {
        background-color: #121417;
        color: #eee;
        border-color: #444;
    }

    /* رؤوس الجدول */
    thead.thead-dark th {
        background-color: #222731;
        color: #fff;
        border-color: #444;
        font-weight: 600;
        font-size: 1rem;
        padding: 12px 8px;
        text-align: center;
    }

    /* صفوف tbody - تظليل بالتناوب */
    tbody tr:nth-child(odd) {
        background-color: #1e222b;
    }

    tbody tr:nth-child(even) {
        background-color: #282f3a;
    }

    /* الأعمدة بالتناوب ألوان مختلفة مع نص أبيض */
    tbody tr td:nth-child(2),
    tbody tr td:nth-child(4),
    tbody tr td:nth-child(6),
    tbody tr td:nth-child(8) {
        background-color: #2a3140;
        color: #fff;
        /* الكتابة أبيض */
        font-weight: 600;
    }

    tbody tr td:nth-child(3),
    tbody tr td:nth-child(5),
    tbody tr td:nth-child(7) {
        background-color: #35405a;
        color: #fff;
        /* الكتابة أبيض */
        font-weight: 600;
    }

    /* الحدود بين الخلايا */
    table.table td,
    table.table th {
        border: 1px solid #444;
        padding: 10px 12px;
    }
</style>

<div class="container py-5">

    {{-- العنوان --}}
    <div class="text-center mb-4">
        <h2 class="display-4 font-weight-bold text-dark">📊 تقرير المركز المالي</h2>
        <hr class="w-25 mx-auto bg-warning" style="height: 4px; border-radius: 10px;">
    </div>

    {{-- اختيار السنة --}}
    <div class="d-flex justify-content-center mb-4">
        <form method="GET" action="{{ route('moneyCenter') }}" class="form-inline">
            <label for="year" class="mr-2 h5 mb-0 text-dark">اختر السنة:</label>
            <select name="year" id="year" class="form-control p-2" onchange="this.form.submit()">
                @for ($y = 2026; $y >= 2016; $y--)
                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </form>
    </div>

    @php
    $months = [
    1 => 'يناير', 2 => 'فبراير', 3 => 'مارس', 4 => 'أبريل',
    5 => 'مايو', 6 => 'يونيو', 7 => 'يوليو', 8 => 'أغسطس',
    9 => 'سبتمبر', 10 => 'أكتوبر', 11 => 'نوفمبر', 12 => 'ديسمبر',
    ];
    $items = [
    'استحقاقات السيارات' => $yearlyCarEsthqaq,
    'استحقاقات الجهات' => $yearlyGehaEsthqaq,
    'إجمالي الاستحقاقات' => $yearlyTotalEsthqaq,
    'إجمالي القبض' => $yearlyQbd,
    'إجمالي الصرف' => $yearlySrf,
    'الرصيد الحالي' => $yearlyBalance,
    'المبالغ المتعثرة' => $yearlyMuta3ather,
    'ضريبة القيمة المضافة' => $yearlyTaxDiff,
    ];
    @endphp

    {{-- الصف المزدوج --}}
    <div class="row">
        {{-- الكارد الموحد --}}
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow rounded h-100" style="background: linear-gradient(to right, #11141c, #1c1f2b); color: #fff;">
                <div class="card-body py-4 text-right">
                    @foreach ($items as $label => $value)
                    <div class="d-flex justify-content-between align-items-center border-bottom border-secondary py-4 mb-2" style="font-size: 16px;">
                        <span class="text-white-50">{{ $label }}</span>
                        <span class="text-white font-weight-bold">
                            {{ number_format($value) }} <small class="text-white-50">ريال</small>
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- جدول التحصيل الشهري --}}
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow rounded h-100" style="background: linear-gradient(to right, #11141c, #1c1f2b); color: #fff;">
                <div class="card-body py-4 text-right">
                    <h5 class="mb-4 text-center text-light ">معدل التحصيل الشهري</h5>
                    <table class="table table-bordered text-center mb-0">
                        <thead>
                            <tr style="background-color: #1f2230;">
                                <th class="text-white">الشهر</th>
                                <th class="text-white">الرصيد</th>
                                <th class="text-white">معدل التحصيل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($months as $monthNumber => $monthName)
                            @php
                            $row = $monthlyData[$monthNumber] ?? [];
                            $qbd = $row['qbd'] ?? 0;
                            $esthqaq = $row['esthqaq_total'] ?? 0;
                            $rate = $esthqaq > 0 ? round(($qbd / $esthqaq) * 100, 2) : 0;
                            $balance = $qbd - $esthqaq;
                            @endphp
                            <tr style="background-color: {{ $loop->even ? '#1a1d29' : '#252935' }};">
                                <td class="text-white">{{ $monthName }}</td>
                                <td class="text-white">{{ number_format($balance) }} <small class="text-white-50">ريال</small></td>
                                <td class="text-white">{{ $rate }}%</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>





<table class="table table-bordered text-center">
    <thead class="thead-dark">
        <tr>
            <th colspan="8"> تقرير تفصيلي </th>
        </tr>
        <tr>
            <th>#</th>
            <th colspan="3">الاستحقاقات</th>
            <th colspan="3">العمليات المالية</th>
            <th>معلومات عامة</th>
        </tr>
        <tr>
            <th>الشهر</th>
            <th>استحقاق السيارات</th>
            <th>استحقاق الجهات</th>
            <th>إجمالي الاستحقاق</th>
            <th>القبض</th>
            <th>الصرف</th>
            <th>الرصيد</th>
            <th>التعثر</th>
        </tr>
    </thead>
    <tbody>
        @php
        $months = [
        1 => 'يناير', 2 => 'فبراير', 3 => 'مارس', 4 => 'أبريل',
        5 => 'مايو', 6 => 'يونيو', 7 => 'يوليو', 8 => 'أغسطس',
        9 => 'سبتمبر', 10 => 'أكتوبر', 11 => 'نوفمبر', 12 => 'ديسمبر',
        ];
        @endphp

        @foreach ($months as $monthNumber => $monthName)
        @php $row = $monthlyData[$monthNumber] ?? []; @endphp
        <tr>
            <td>{{ $monthName }}</td>
            <td>{{ number_format($row['esthqaq_cars'] ?? 0) }}</td>
            <td>{{ number_format($row['esthqaq_gehat'] ?? 0) }}</td>
            <td>{{ number_format($row['esthqaq_total'] ?? 0) }}</td>
            <td>{{ number_format($row['qbd'] ?? 0) }}</td>
            <td>{{ number_format($row['srf'] ?? 0) }}</td>
            <td>{{ number_format($row['balance'] ?? 0) }} </td>
            <td>{{ number_format(($row['balance'] ?? 0) - ($row['esthqaq_total'] ?? 0)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>





<table class="table table-bordered text-center">
    <thead class="thead-dark">
        <tr>
            <th colspan="9"> تقرير عام </th>
        </tr>
        <tr>
            <th>#</th>
            <th colspan="3">الايرادات</th>
            <th colspan="3">المصروفات </th>
            <th colspan="2">ضريبة القيمة المضافة </th>
        </tr>
        <tr>
            <th>الشهر</th>
            <th> نقط البيع </th>
            <th>الكاش </th>
            <th>البنك </th>
            <th> نقط البيع </th>
            <th>الكاش </th>
            <th>البنك </th>
            <th>الدخل</th>
            <th>المشتريات</th>

        </tr>
    </thead>
    <tbody>
        @php
        $months = [
        1 => 'يناير', 2 => 'فبراير', 3 => 'مارس', 4 => 'أبريل',
        5 => 'مايو', 6 => 'يونيو', 7 => 'يوليو', 8 => 'أغسطس',
        9 => 'سبتمبر', 10 => 'أكتوبر', 11 => 'نوفمبر', 12 => 'ديسمبر',
        ];
        @endphp

        @foreach ($months as $monthNumber => $monthName)
        @php $row = $monthlyData[$monthNumber] ?? []; @endphp
        <tr>
            <td>{{ $monthName }}</td>
            <td>{{ number_format($row['qbd_ngat'] ?? 0) }}</td>
            <td>{{ number_format($row['qbd_cach'] ?? 0) }}</td>
            <td>{{ number_format($row['qbd_bank'] ?? 0) }}</td>
            <td>{{ number_format($row['srf_ngat'] ?? 0) }}</td>
            <td>{{ number_format($row['srf_cach'] ?? 0) }}</td>
            <td>{{ number_format($row['srf_bank'] ?? 0) }} </td>
            <td>{{ number_format($row['eldkhl'] ?? 0) }}</td>
            <td>0</td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection
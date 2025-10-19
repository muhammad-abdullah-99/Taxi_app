<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>طباعة السند</title>
    <style>
        body {
            font-family: 'Arial';
            direction: rtl;
            padding: 40px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        td {
            padding: 10px;
            border: 1px solid #000;
        }
    </style>
</head>

<body>
    <h2>سند مالي</h2>
    <table>
        <tr>
            <td><strong>النوع:</strong></td>
            <td>{{ $snd->type }}</td>
        </tr>
        <tr>
            <td><strong>المستفيد:</strong></td>
            <td>
                @if($snd->client_type == 'موظف' && $snd->employee)
                {{ $snd->employee->name }}
                @elseif($snd->client_type == 'جهة' && $snd->geha)
                {{ $snd->geha->name }}
                @elseif($snd->client_type == 'سيارة' && $snd->car)
                {{ $snd->car->name }} - {{ $snd->car->plate_number ?? 'بدون لوحة' }}
                @else
                غير محدد
                @endif
            </td>
        </tr>
        <tr>
            <td><strong>المبلغ الأساسي:</strong></td>
            <td>{{ number_format($baseAmount, 2) }}</td>
        </tr>
        <tr>
            <td><strong>قيمة الضريبة:</strong></td>
            <td>{{ number_format($taxValue, 2) }} ({{ $snd->tax }})</td>
        </tr>
        <tr>
            <td><strong>الإجمالي:</strong></td>
            <td>{{ number_format($total, 2) }}</td>
        </tr>
        <tr>
            <td><strong>طريقة الدفع:</strong></td>
            <td>{{ $snd->payment_method }}</td>
        </tr>
        <tr>
            <td><strong>التاريخ:</strong></td>
            <td>{{ $snd->date }}</td>
        </tr>
        <tr>
            <td><strong>الوصف:</strong></td>
            <td>{{ $snd->description }}</td>
        </tr>
    </table>
    </br>

    @if($snd->type === 'قبض' && $snd->client_type === 'موظف' && $snd->employee)
    @php
    $total_debit = $snd->employee->snd
    ->filter(fn($q) => $q->type === 'صرف' || ($q->type === 'تحويل داخلي' && in_array($q->client_type, ['سيارة', 'جهة'])))
    ->sum('amount');

    $total_credit = $snd->employee->snd
    ->filter(fn($q) => $q->type === 'قبض' || ($q->type === 'تحويل داخلي' && $q->client_type === 'موظف'))
    ->sum('amount');

    $balance = $total_credit - $total_debit;
    @endphp
    <tr>
        <td><strong>المبلغ المتبقي :</strong></td>
        <td>
            @if($balance > 0)
            {{ number_format($balance, 2) }}
            @elseif($balance < 0)
                -{{ number_format(abs($balance), 2) }}
                @else
                0.00
                @endif
                </td>
    </tr>
    @endif





    <script>
        window.onload = function() {
            window.print();
            setTimeout(() => window.close(), 2000);
        };
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>كشف حساب - {{ \Carbon\Carbon::parse($month)->translatedFormat('F Y') }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap');

        body {
            font-family: 'Cairo', sans-serif;
            direction: rtl;
            padding: 40px;
            background-color: #f7f9fc;
            color: #222;
        }

        h2 {
            text-align: center;
            font-size: 25px;
            color: #0a3d62;
            border-bottom: 2px solid #0a3d62;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .employee-info-table {
            width: 100%;
            margin-top: 20px;
            border: 1px solid #cdd6e0;
            border-radius: 6px;
            border-collapse: collapse;
            background-color: #eaf0f6;
            font-size: 14px;
            box-shadow: 0 0 6px rgba(0, 0, 0, 0.05);
        }

        .employee-info-table th,
        .employee-info-table td {
            border: 1px solid #d2dae2;
            padding: 10px 12px;
            text-align: right;
        }

        .employee-info-table th {
            background-color: #dff0fb;
            color: #0a3d62;
            font-weight: bold;
            width: 20%;
        }

        .employee-info-table td {
            background-color: #ffffff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        th {
            background-color: #0a3d62;
            color: white;
            padding: 12px;
            font-size: 16px;
        }

        td {
            border: 1px solid #ccc;
            padding: 10px;
            font-size: 15px;
        }

        tr:nth-child(even) {
            background-color: #f2f4f7;
        }

        .acknowledgment {
            margin-top: 40px;
            padding: 15px;
            border: 1px dashed #555;
            font-size: 16px;
            background-color: #fff;
        }

        .signature-section {
            margin-top: 40px;
            font-size: 16px;
            direction: rtl;
            text-align: right;
        }

        .signature-section p {
            margin: 8px 0;
        }

        @media print {
            body {
                background-color: white;
                color: black;
                padding: 0;
            }

            .employee-info-table,
            .acknowledgment,
            .signature-section {
                border: none;
                background-color: transparent;
                box-shadow: none;
            }

            h2 {
                border-bottom: none;
            }

            table {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>

    <h2>كشف حساب - شهر {{ \Carbon\Carbon::parse($month)->format('m / Y') }}</h2>

    <table class="employee-info-table">
        <tr>
            <th>الاسم</th>
            <td>{{ $employee->name ?? '........' }}</td>
            <th>رقم الإقامة</th>
            <td>{{ $employee->identity_number ?? '........' }}</td>
        </tr>
        <tr>
            <th>الجوال</th>
            <td>{{ $employee->phone ?? '________' }}</td>
            <th>الرصيد الحالي</th>
            <td>{{ number_format($remaining ?? 0, 2) }} ريال</td>
        </tr>
    </table>

    <h3 style="margin-top: 40px; color: #0a3d62;">العمليات المالية (قبض / صرف)</h3>
    <table>
        <thead>
            <tr>
                <th>م</th>
                <th>قبض</th>
                <th>صرف</th>
                <th>الوصف</th>
                <th>التاريخ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $index => $trx)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($trx['type'] === 'قبض')
                            {{ number_format($trx['amount'], 2) }}
                            @if($trx['original_type'] === 'تحويل داخلي')
                                (تحويل داخلي)
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($trx['type'] === 'صرف')
                            {{ number_format($trx['amount'], 2) }}
                            @if($trx['original_type'] === 'تحويل داخلي')
                                (تحويل داخلي)
                            @endif
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $trx['description'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx['date'])->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="acknowledgment">
        <p>
            أقر أنا الموضحة بياناتي أعلاه بأن جميع البيانات المالية صحيحة، وعلى ذلك أقر وأوقع،،،.
        </p>
    </div>

    <div class="signature-section">
        <p><strong>الاسم:</strong> {{ $employee->name ?? '........' }}</p>
        <p><strong>التوقيع:</strong> .....................................</p>
        <p><strong>البصمة:</strong> ......................................</p>
    </div>

    <script>
        window.print();
    </script>

</body>
</html>

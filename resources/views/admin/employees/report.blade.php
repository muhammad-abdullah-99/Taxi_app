<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تقرير الموظفين - {{ $company }}</title>
    <style>
        body { font-family: "Tahoma", sans-serif; direction: rtl; text-align: right; margin: 20px; }
        h2 { text-align: center; margin-bottom: 5px; font-size: 22px; }
        h4 { text-align: center; margin-top: 0; color: #555; font-size: 16px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; font-size: 14px; }
        th { background: #e0e0e0; font-weight: bold; }
        tr:nth-child(even) { background: #f9f9f9; }
        tr:nth-child(odd) { background: #fff; }
        .print-btn { margin: 20px; display: flex; justify-content: center; }

        @media print {
            .print-btn { display: none; }
        }
    </style>
</head>
<body>
    <h2>تقرير الموظفين - {{ $company }}</h2>
    <h4>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</h4>

    <table>
        <thead>
            <tr>
                <th>م</th>
                <th>الاسم</th>
                <th>الجنسية</th>
                <th>رقم الهوية</th>
                <th>رقم الهاتف</th>
                <th>تاريخ الالتحاق</th>
                <th>المسمى الوظيفي</th>
                <th>تاريخ الاستبعاد</th>
                <th>مدة الخدمة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $index => $employee)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->nationality }}</td>
                <td>{{ $employee->identity_number }}</td>
                <td>{{ $employee->phone }}</td>
                <td>{{ $employee->joining_date }}</td>
                <td>{{ $employee->job_title }}</td>
                <td></td> <!-- تاريخ الاستبعاد فاضي -->
                <td>
                    @php
                        $joining = \Carbon\Carbon::parse($employee->joining_date);
                        $now = \Carbon\Carbon::now();
                        $diff = $joining->diff($now);
                    @endphp
                    {{ $diff->y }} سنة {{ $diff->m }} شهر {{ $diff->d }} يوم
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="print-btn">
        <button onclick="window.print()">🖨️</button>
    </div>

    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>

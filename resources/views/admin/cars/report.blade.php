<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تقرير السيارات</title>
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
            thead { display: table-header-group; } /* تكرار رأس الجدول */
            tfoot { display: table-footer-group; }
            tr { page-break-inside: avoid; }
        }
    </style>
</head>
<body>
    <h2>تقرير السيارات</h2>
    <h4>نوع التقرير: @if($status == 'all') عرض الكل @else {{ $statuses[$status] }} @endif</h4>
    <h4>{{ \Carbon\Carbon::now()->format('Y-m-d') }}</h4>

    <table>
       <thead>
    <tr>
        <th>م</th>
        <th>نوع المركبة</th>
        <th>الموديل</th>
        <th>رقم اللوحة</th>
        <th>اللون</th>
        <th>السائق</th>
        
        <th>التاريخ</th>
        <th>نوع السعر</th>
        <th>قيمة السعر</th>
    </tr>
</thead>
<tbody>
    @foreach($cars as $index => $car)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $car->name }}</td>
        <td>{{ $car->type }}</td>
        <td>{{ $car->plate_number }}</td>
        <td>{{ $car->color }}</td>

        {{-- السائق والتاريخ حسب الحالة --}}
      <td>
    @if($car->status == 'عاملة')
        {{ $car->latestCarDriver?->employee?->name ?? '-' }}
    @else
        {{ $car->latestCarDriver?->employee?->name ?? '-' }}
    @endif
</td>
<td>
    @if($car->status == 'عاملة')
        {{ $car->latestCarDriver?->handover_date ?? '-' }}
    @else
        {{ $car->latestCarDriver?->return_date ?? '-' }}
    @endif
</td>

        <td>{{ $car->type_price }}</td>
        <td>{{ $car->price }}</td>
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

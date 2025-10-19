<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اختيار الرابط</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #e6f7ff;
            padding: 20px;
        }

        .link-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
        }

        .link-box {
            background-color: #007bff;
            color: white;
            padding: 20px 40px;
            border-radius: 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            width: 400px;
            transition: background-color 0.3s ease, transform 0.2s;
            font-weight: bold;
            font-size: 18px;
        }

        .link-box:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        @media (max-width: 576px) {
            .link-container {
                flex-direction: column;
            }

            .link-box {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="link-container">
        @if (Auth::check() && in_array(Auth::user()->role, ['مسؤول']))
        <a href="{{ route('dashboard', ['company' => 'transport']) }}" class="link-box">
            شركة روز لتوجيه مركبات الأجرة / الحافلات
        </a>
        @endif

        @if (Auth::check() && in_array(Auth::user()->role, ['تحديث البيانات','مسؤول', 'موظف']))
        <a href="{{ route('dashboard', ['company' => 'taxi']) }}" class="link-box">
            شركة روز للأجرة العامة / النقل المتخصص
        </a>
        @endif
        
        @if (Auth::check() && in_array(Auth::user()->role, ['مسؤول']))
        <a href="{{ route('dashboard', ['company' => 'restaurantAlawaly']) }}" class="link-box">
            مطعم العوالي للاكلات الشعبية
        </a>
        @endif
        @if (Auth::check() && in_array(Auth::user()->role, ['مسؤول']))
        <a href="{{ route('dashboard', ['company' => 'moneyManagement']) }}" class="link-box">
            الادارة المالية
        </a>
        @endif

    </div>

</body>

</html>
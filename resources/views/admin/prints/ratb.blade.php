<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إقرار استلام راتب</title>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 0;
            }
            body {
                margin: 0;
                padding: 0;
                background-color: #fff;
            }
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            direction: rtl;
        }

        .content {
            padding: 30mm 20mm;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-sizing: border-box;
        }

        .top-section {
            display: flex;
            flex-direction: column;
        }

        .header {
            display: flex;
            justify-content: space-between;
            font-size: 20px;
            font-weight: bold;
        }

        .line-text {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin: 10px 0 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            text-decoration: underline;
            font-size: 22px;
        }

        p {
            font-size: 18px;
            line-height: 2;
            text-align: justify;
            margin: 10px 0;
        }

        .info {
            margin-top: 40px;
            font-size: 18px;
        }

        .info-title {
            font-weight: bold;
            margin-bottom: 10px;
            text-decoration: underline;
        }

        .info span {
            display: inline-block;
            min-width: 140px;
            font-weight: bold;
        }

        .signature {
            margin-top: 60px;
            display: flex;
            justify-content: space-between;
            font-size: 18px;
        }

        .signature div {
            text-align: center;
        }

        .bottom-line-text {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }
    </style>
</head>
<body onload="window.print()">
    <div class="content">
        <div class="top-section">
            <div class="header">
                <div>شركة الجواب للنقل البري<br>السيح - المدينة المنورة</div>
                <div>Taxi Al-Jawab<br>Al-Madina Al-Seeh</div>
            </div>

            <div class="line-text">___________________________________________________________________________</div>

            <h2>إقرار استلام راتب</h2>

            <p>
                أُقِرّ أنا الموقع أدناه / <strong>{{$name}}</strong> - الجنسية / <strong>{{$nationality}}</strong> <br>
                رقم الإقامة / <strong>{{$idNumber}}</strong><br>
                بأنني قد استلمت جميع مستحقاتي المالية من شركة الجواب للنقل البري حتى تاريخ 
                <strong>
                    {{
                        str_replace(
                            ['0','1','2','3','4','5','6','7','8','9'],
                            ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'],
                            \Carbon\Carbon::parse($date)->format('d-m-Y')
                        )
                    }}
                </strong><br>
                وعليه، فإنني أُقِرّ بذلك وأوقع.
            </p>

            <div class="info">
                <div class="info-title">بيانات الموقع:</div>
                <p><span>الاسم:</span> {{$name}}</p>
                <p><span>رقم الإقامة:</span> {{$idNumber}}</p>
            </div>

            <div class="signature">
                <div>
                    <strong>التوقيع:</strong><br><br><br>
                    ________________
                </div>
                <div>
                    <strong>البصمة:</strong><br><br><br>
                    ________________
                </div>
            </div>
        </div>

        <div class="bottom-line-text">___________________________________________________________________________</div>
    </div>
</body>
</html>

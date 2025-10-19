<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>مخالصة مالية</title>
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
            height: 100vh;
            padding: 30mm 20mm;
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
            font-size: 18px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .line {
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

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

    </style>
</head>

<body onload="window.print()">
    <div class="content">
        <div class="top-section">
            <div class="header">
                <div>شركة الجواب<br>للنقل البري</div>
                <div>Taxi AL Jawab<br>AL Madina AL Seeh</div>
            </div>

            <div class="line">___________________________________________________________________________</div>

            <h2>مخالصة مالية</h2>

            <p>
                أقر أنا الموقع أدناه بأنه اعتباراً من تاريخ
                <strong>
                    {{
                        str_replace(
                            ['0','1','2','3','4','5','6','7','8','9'],
                            ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'],
                            \Carbon\Carbon::parse($date)->format('d-m-Y')
                        )
                    }}
                </strong>
                قد وصلني جميع الأموال والمبالغ المستحقة لي وكافة حقوقي عن عملي لدى الشركة، وقد تم تسليمي إياها دفعة واحدة ونهائية بناءً على طلبي، سواء كان مصدرها الرواتب أو البدلات الإضافية أو الإجازات السنوية أو بدل ساعات العمل الإضافية أو مدة الإنذار أو التعويض أو أي مصدر آخر من مصادر الاستحقاق.
            </p>

            <p>
                وبتوقيعي هذا فإنني أبرئ ذمة صاحب العمل إبراءً شاملاً عاماً لا رجوع منه مطلقاً لأي حق أو مطالبة حالية أو مستقبلية سواء من نوع أو شكل كان.
            </p>

            <div class="info">
                <div class="info-title">بيانات الموقع:</div>
                <p><span>اسم الموظف:</span> {{$name}}</p>
                <p><span>رقم الهوية:</span> {{$idNumber}}</p>
                <p><span>التوقيع:</span> ________________________________</p>
                <p><span>البصمة:</span> ________________________________</p>
            </div>
        </div>

        <div class="footer"> ____________________________________________________________________________________________________</div>
    </div>
</body>

</html>

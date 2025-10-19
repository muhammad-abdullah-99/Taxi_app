<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>إقرار تسليم مركبة</title>
  <style>
    @media print {
      @page {
        size: A4;
        margin: 10mm;
      }
    }

    body {
      font-family: 'Arial', sans-serif;
      font-size: 13px;
      margin: 0;
      padding: 0;
      background-color: #fff;
      direction: rtl;
      line-height: 1.8;
    }

    .content {
      padding: 20px;
      box-sizing: border-box;
    }

    .header {
      display: flex;
      justify-content: space-between;
      font-weight: bold;
    }

    h2 {
      text-align: center;
      margin: 15px 0;
      text-decoration: underline;
      font-size: 16px;
    }

    .line-text, .bottom-line-text {
      text-align: center;
      font-weight: bold;
      margin: 10px 0;
    }

    table.info-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table.info-table td {
      padding: 6px 10px;
      border: 1px solid #000;
    }

    ul {
      padding-right: 20px;
      margin: 10px 0;
    }

    ul li {
      margin-bottom: 4px;
    }

    .signature {
      margin-top: 20px;
    }

    .signature-line {
      margin: 4px 0;
    }

    .footer-contact {
      text-align: center;
      margin-top: 15px;
      font-weight: bold;
    }
  </style>
</head>
<body onload="window.print()">
  <div class="content">
    <div class="header">
      <div>شركة الجواب<br>للنقل البري</div>
      <div>Taxi Al Jawab<br>AL Madina AL Seeh</div>
    </div>

    <div class="line-text">______________________________________________________________</div>

    <h2>إقرار تسليم مركبة</h2>

    <table class="info-table">
      <tr>
        <td>رقم جهاز نقاط البيع:</td>
        <td>{{ $nqt_number }}</td>
      </tr>
      <tr>
        <td>رقم العداد القادم لتغيير الزيت:</td>
        <td>{{ $zyt_number }}</td>
      </tr>
      <tr>
        <td>تاريخ نهاية الإقرار:</td>
        <td>31/12/2025</td>
      </tr>
      <tr>
        <td>المبلغ اليومي للمركبة:</td>
        <td>{{ $day_cost }}</td>
      </tr>
    </table>

 <p>
  أقر أنا / <strong>{{ $name }}</strong>، الجنسية / <strong>{{ $nationality }}</strong>، رقم الإقامة / <strong>{{ $idNumber }}</strong><br>
  بأنه تم استلام سيارة من نوع / <strong>{{ $car_type }}</strong>، سنة الصنع / <strong>{{ $year }}</strong>، رقم اللوحة / <strong>{{ $plate_number }}</strong><br>
  من شركة الجواب للنقل البري، برقم عداد (<strong>{{ $adad_number }}</strong>)<br>
  في يوم / <strong>{{ \Carbon\Carbon::parse($start_date)->format('Y/m/d') }}</strong>، واستلام جهاز نقاط بيع برقم / <strong>{{ $nqt_number }}</strong>.
</p>


    <p>كما أقر وأتعهد بما يلي:</p>

    <ul>
      <li>1. الالتزام بالزي الرسمي</li>
      <li>2. عدم تحميل الركاب من المطار</li>
      <li>3. عدم تحميل الركاب من القطار</li>
      <li>4. تشغيل عداد احتساب الأجرة في كل رحلة</li>
      <li>5. تغيير زيت المحرك بعدم تجاوز (5000) كيلو من التغيير السابق وتزويد الشركة بما يثبت ذلك علماً أن عداد تغيير الزيت السابق ( _____________ )</li>
      <li>6. إبلاغ الشركة في حينه عند وجود أي ملاحظة إدارية أو مالية من خلال الواتساب رقم (0551796056)</li>
      <li>7. إصلاح أي أضرار تحدث على السيارة بعد تاريخ الاستلام بمدة لا تتجاوز (3) أيام</li>
      <li>8. سداد جميع الاستحقاقات والمخالفات بمدة لا تتجاوز (3) أيام من تاريخ الإبلاغ من الشركة</li>
      <li>9. الالتزام بكافة التعليمات المرورية والأمنية وهيئة النقل</li>
      <li>10. عدم السماح بقيادة السيارة إلى سائق إضافي دون أخذ الموافقة الخطية من إدارة الشركة</li>
      <li>11. أن السيارة تبقى في عهدتي الشخصية ولا تخلي مسؤوليتي إلى أن يتم إعادتها وتسليمها رسمياً للشركة واستلام ما يثبت ذلك من الموظف المختص</li>
    </ul>

    <div class="signature">
      <p class="signature-line">الاسم: {{ $name }}</p>
      <p class="signature-line">رقم الجوال: _________________________</p>
      <p class="signature-line">التوقيع: __________________________</p>
      <p class="signature-line">البصمة: __________________________</p>
    </div>

    <div class="bottom-line-text">______________________________________________________________</div>
    <div class="footer-contact">Tel: 920015056 - 0509040954</div>
  </div>
</body>
</html>

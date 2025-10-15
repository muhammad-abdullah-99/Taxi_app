<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>إقرار إعادة مركبة</title>
  <style>
    @media print {
      @page {
        size: A4;
        margin: 0;
      }
      body {
        margin: 0;
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

    .container {
      width: 100%;
      height: 100vh;
      padding: 50px 70px;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .header {
      display: flex;
      justify-content: space-between;
      font-weight: bold;
      font-size: 14px;
    }

    h2 {
      text-align: center;
      margin: 20px 0 30px;
      text-decoration: underline;
      font-size: 18px;
    }

    .line {
      text-align: center;
      margin: 10px 0;
      font-weight: bold;
    }

    table.details {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }

    table.details td {
      padding: 8px 5px;
      vertical-align: top;
      font-size: 13px;
    }

    .paragraph {
      margin-bottom: 30px;
    }

    .signature {
      margin-top: 20px;
    }

    .signature p {
      margin: 6px 0;
    }

    .footer {
      text-align: center;
      font-size: 13px;
      margin-top: 40px;
    }

    .bold {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="container">
    <div>
      <div class="header">
        <div>شركة الجواب<br>للنقل البري</div>
        <div>Taxi Al Jawab<br>AL Madina AL Seeh</div>
      </div>

      <div class="line">______________________________________________________________</div>

      <h2>إقرار إعادة مركبة</h2>

      <table class="details">
        <tr>
          <td>الاسم:</td>
          <td class="bold">{{ $name }}</td>
          <td>الجنسية:</td>
          <td class="bold">{{ $nationality }}</td>
        </tr>
        <tr>
          <td>رقم الإقامة:</td>
          <td class="bold">{{ $idNumber }}</td>
          <td>نوع السيارة:</td>
          <td class="bold">{{ $car_type }}</td>
        </tr>
        <tr>
          <td>سنة الصنع:</td>
          <td class="bold">{{ $year }}</td>
          <td>رقم اللوحة:</td>
          <td class="bold">{{ $plate_number }}</td>
        </tr>
        <tr>
          <td>رقم جهاز نقاط البيع:</td>
          <td class="bold">{{ $nqt_number }}</td>
          <td>تاريخ الاستلام:</td>
          <td class="bold">{{ \Carbon\Carbon::parse($start_date)->format('Y-m-d') }}</td>
        </tr>
        <tr>
          <td>سبب الإعادة:</td>
          <td colspan="3" class="bold">{{ $reason }}</td>
        </tr>
        <tr>
          <td>تاريخ تغيير الزيت:</td>
          <td class="bold">{{ \Carbon\Carbon::parse($zyt_date)->format('Y-m-d') }}</td>
          <td>رقم الفاتورة:</td>
          <td class="bold">{{ $reset_number }}</td>
        </tr>
        <tr>
          <td>قراءة العداد وقت تغيير الزيت:</td>
          <td class="bold">{{ $adad_zayt }}</td>
          <td>رقم العداد الحالي:</td>
          <td class="bold">{{ $adad_number }}</td>
        </tr>
      </table>

      <div class="paragraph">
        <p>
          أقر وأتعهد بأنني مسؤول مسؤولية كاملة عن السيارة الموضحة بياناتها أعلاه خلال فترة استلامي، وذلك من مخالفات مرورية أو مخالفات هيئة النقل أو أي مشاكل أمنية أو أعطال أو حوادث.<br>
          وأن المبلغ المتبقي في ذمتي هو (<span class="bold">{{ $price }}</span>) ريال سعودي، ويجب سداده خلال (5) أيام من تاريخ إعادة السيارة.<br>
          وفي حال تأخري عن السداد ورفع دعوى قضائية، أقر وأتعهد بدفع مبلغ (3000) ريال إضافية كغرامة تأخير.
        </p>
      </div>

      <div class="signature">
        <p>الاسم: {{ $name }}</p>
        <p>رقم الجوال: _________________________</p>
        <p>التوقيع: __________________________</p>
        <p>البصمة: __________________________</p>
      </div>
    </div>

    <div>
      <div class="line">______________________________________________________________</div>
      <div class="footer">Tel: 920015056 - 0509040954</div>
    </div>
  </div>

  <script>
    window.onload = function() {
      window.print();
    };
  </script>
</body>
</html>

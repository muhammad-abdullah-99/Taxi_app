<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    
        <title>
        @if(isset($isMobilePDF) && $isMobilePDF)
            {{ $pageTitle }}
        @else
            كشف الركاب
        @endif
        </title>


    <style>
     

        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: sans-serif;
            direction: rtl;
            text-align: right;
            background-color: #fff;
            color: #000;
            margin: 1cm;
        }


        .header {
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #444;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }

        .header div {
            font-size: 14px;
            line-height: 1.8;
        }

        .title {
            text-align: center;
            font-weight: bold;
            margin: 20px 0 20px;
            font-size: 20px;
            border: 2px dashed #333;
            padding: 10px;
            background-color: rgb(222, 222, 222);
        }

        .title2 {
            text-align: center;
            font-weight: bold;
            margin: 40px 0 20px;
            font-size: 16px;
            border: 1px dashed #333;
            padding: 7px;
            background-color: #f5f5f5;
        }

        p {
            margin: 10px 0;
            font-size: 14px;
        }

        .section-title {
            margin-top: 5px;
            font-weight: bold;
            font-size: 14px;
            border-bottom: 1px solid #aaa;
            padding-bottom: 3px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 13px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 10px;
            text-align: center;

        }

        th {
            background-color: #e6f0ff;
            font-weight: bolder;
            font-size: larger;
        }



        /* .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            font-size: 15px;
            text-align: center;
            padding: 10px 0;
            border-top: 1px solid #999;
            background-color: #fff;
        } */
         .footer {
    text-align: center;
    font-size: 14px;
    margin-top: 0px;
    padding-top: 10px;
    border-top: 1px solid #999;
}


        /* بدء صفحة جديدة */
        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body onload="window.print();">

@if(isset($isMobilePDF) && $isMobilePDF)
    <!-- MOBILE: Table Layout -->
    <table class="header" style="width: 100%; border-collapse: collapse; border-bottom: 2px solid #444; margin-bottom: 10px; padding-bottom: 10px; table-layout: fixed;">
        <tr>
            <td style="width: 30%; padding: 10px; text-align: right; vertical-align: top; border: none;">
                <strong>{{ $passenger->appUser->company->company_name ?? '-' }}</strong><br>
                <strong> الرقم الموحد </strong> : {{ $passenger->appUser->company->company_registration_number ?? '-' }}
            </td>
            <td style="width: 40%; padding: 10px; text-align: center; vertical-align: top; border: none;">
                {{-- QR Code هنا --}}
                @php
                $url = "https://aljawabtaxi.rosecaptain.com/api/passengers/download/" . $passenger->id;
                $qrCode = QrCode::format('png')->size(100)->generate($url);
                @endphp
                {{-- {!! QrCode::format('svg')->size(100)->generate($url) !!} --}}
                <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code" style="width: 100px; height: 100px;">
            </td>
            <td style="width: 30%; padding: 10px; text-align: left; vertical-align: top; border: none;">
                <strong>المقر:</strong> {{ $passenger->appUser->company->company_location ?? '-' }} <br>
                <strong>النشاط:</strong> {{ $passenger->appUser->company->company_type ?? '-' }}
            </td>
        </tr>
    </table>
@else
<div class="header">
        <div style="flex: 1;">
            <strong>{{ $passenger->appUser->company->company_name ?? '-' }}</strong><br>
            <strong> الرقم الموحد </strong> : {{ $passenger->appUser->company->company_registration_number ?? '-' }}
        </div>

        <div style="flex: 0 0 130px; text-align: center;">
            {{-- QR Code هنا --}}
            @php
            $url = "https://aljawabtaxi.rosecaptain.com/passengers/data/PDF/" . $passenger->id;
            @endphp
            {!! QrCode::format('svg')->size(100)->generate($url) !!}
        </div>

        <div style="flex: 1; text-align: left;">
            <strong>المقر:</strong> {{ $passenger->appUser->company->company_location ?? '-' }} <br>
            <strong>النشاط:</strong> {{ $passenger->appUser->company->company_type ?? '-' }}
        </div>
    </div>
@endif

    <div class="title"> عقـد نقـل علـى الـطرق البـرية رقم : ({{ $passenger->id ?? '-' }})
    </div>

    <p><strong>التاريخ:</strong> {{ $passenger->created_at->format('d-m-Y') }}</p>

    <p>
        تم إبرام هذا العقد بين المتعاقدين بناء على المادة (39) التاسعة والثلاثون من اللائحة المنظمة لنشاط النقل المتخصص وتأجير وتوجيه الحافلات
        وبناء على الفقرة (1) من المادة (39) التي تنص على ان يجب على الناقل إبرام عقد نقل مع الأطراف المحددين في المادة (40) قبل تنفيذ عمليات
        النقل على الطرق البرية وبما لا يخالف احكام هذه اللائحة ووفقا للآلية التي تحددها هيئة النقل وبناء على ماسبق تم إبرام عقد النقل بين الأطراف
        الآتية:
        </br>
    <p>
        <strong>الطرف الأول:</strong> {{ $passenger->appUser->company->company_name ?? '-' }} <br>
        <strong>الطرف الثاني:</strong> {{ $passenger->list[0]->name ?? '-' }}<br>
    </p>
    </br>

    اتفق الطرفان على ان ينفذ الطرف الأول عملية النقل للطرف الثاني مع مرافقيه وذويهم الموقع المحدد مسبقا مع الطرف الثاني وتوصيلهم الى الجهة
    المحددة في العقد.
    </p>

    <div class="section-title">معلومات النقل</div>

    <table>
        <thead>
            <tr>
                <th>النقل من</th>
                <th>وصولاً إلى</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $passenger->from }}</td>
                <td>{{ $passenger->to }}</td>
            </tr>
        </tbody>
    </table>


    <p>
    </br>  في حالة إلغاء التعاقد الى سبب شخصى او اسباب أخرى تتعلق في الحجوزات أو الأنظمة تكون سياسة الإلغاء و الاستبدال.
    </br> حسب نظام وزارة التجارة السعودي في حالة الحجز وتم الإلغاء قبل موعد الرحلة بأكثر من 24 ساعة يتم استرداد المبلغ كامل. </br>
        وفي حالة طلب الطرف الثاني الحجز من خلال الموقع الإلكتروني للمؤسسة يعتبر هذا الحجز وموافقته على الشروط والأحكام بالموقع الإلكتروني وهو
        موافقة على هذا العقد لتنفيذ عملية النقل المتفق عليها مع الطرف الاول بواسطة حافلات المؤسسة المرخصة المتوافقة مع الاشتراطات المقررة من
        هيئة النقل.
    </p>

    <div class="section-title">بيانات السائق</div>
    <table>
        <thead>
            <tr>
                <th>اسم السائق</th>
                <th>رقم الإقامة</th>
                <th>رقم الجوال</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $passenger->appUser->name ?? '-' }}</td>
                <td>{{ $passenger->appUser->id_number ?? '-' }}</td>
                <td>{{ $passenger->appUser->mobile ?? '-' }}</td>
            </tr>
        </tbody>
    </table>

    <div class="section-title">بيانات المركبة</div>
    <table>
        <thead>
            <tr>
                <th>نوع السيارة</th>
                <th>رقم اللوحة</th>
                <th>عدد الركاب</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $passenger->appUser->vehicle->car_type ?? '-' }} - {{ $passenger->appUser->vehicle->car_model ?? '-' }}</td>
                <td>{{ $passenger->appUser->vehicle->licence_plate_number ?? '-' }}</td>
                <td>{{ count($passenger->list) }}</td>
            </tr>
        </tbody>
    </table>
    <!-- <div class="footer">
         <strong> للتواصل </strong> 0509040954 - <strong>  واتساب </strong>  0551796056 
    </div> -->
    <!-- بداية صفحة جديدة -->

    <div class="page-break"></div>
    </br>
    </br>
@if(isset($isMobilePDF) && $isMobilePDF)
    <!-- MOBILE: Table Layout -->
    <table class="header" style="width: 100%; border-collapse: collapse; border-bottom: 2px solid #444; margin-bottom: 10px; padding-bottom: 10px; table-layout: fixed;">
        <tr>
            <td style="width: 30%; padding: 10px; text-align: right; vertical-align: top; border: none;">
                <strong>{{ $passenger->appUser->company->company_name ?? '-' }}</strong><br>
                <strong> الرقم الموحد </strong> : {{ $passenger->appUser->company->company_registration_number ?? '-' }}
            </td>
            <td style="width: 40%; padding: 10px; text-align: center; vertical-align: top; border: none;">
                {{-- QR Code هنا --}}
                @php
                $url = "https://aljawabtaxi.rosecaptain.com/api/passengers/download/" . $passenger->id;
                $qrCode = QrCode::format('png')->size(100)->generate($url);
                @endphp
                {{-- {!! QrCode::format('svg')->size(100)->generate($url) !!} --}}
                <img src="data:image/png;base64,{{ base64_encode($qrCode) }}" alt="QR Code" style="width: 100px; height: 100px;">
            </td>
            <td style="width: 30%; padding: 10px; text-align: left; vertical-align: top; border: none;">
                <strong>المقر:</strong> {{ $passenger->appUser->company->company_location ?? '-' }} <br>
                <strong>النشاط:</strong> {{ $passenger->appUser->company->company_type ?? '-' }}
            </td>
        </tr>
    </table>
@else
    <!-- WEB: Flex Layout -->
    <div class="header" style="display: flex; justify-content: space-between; border-bottom: 2px solid #444; margin-bottom: 10px; padding-bottom: 10px;">
        
        <div style="flex: 1;">
            <strong>{{ $passenger->appUser->company->company_name ?? '-' }}</strong><br>
            <strong> الرقم الموحد </strong> : {{ $passenger->appUser->company->company_registration_number ?? '-' }}
        </div>

        <div style="flex: 0 0 130px; text-align: center;">
            {{-- QR Code هنا --}}
            @php
            $url = "https://aljawabtaxi.rosecaptain.com/passengers/data/PDF/" . $passenger->id;
            @endphp
            {!! QrCode::format('svg')->size(100)->generate($url) !!}
        </div>

        <div style="flex: 1; text-align: left;">
            <strong>المقر:</strong> {{ $passenger->appUser->company->company_location ?? '-' }} <br>
            <strong>النشاط:</strong> {{ $passenger->appUser->company->company_type ?? '-' }}
        </div>
    </div>
@endif



    <!-- <div class="section-title">بيانات الركاب</div> -->
    <div class="title"> كشف الركاب </div>

    <table>
        <thead>
            <tr>
                <th>م</th> <!-- رقم تسلسلي -->
                <th>اسم الراكب</th>
                <th>رقم الهوية</th>
                <th>رقم الجوال (اختياري)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($passenger->list as $index => $p)
            <tr>
                <td>{{ $index + 1 }}</td> <!-- الرقم التسلسلي يبدأ من 1 -->
                <td>{{ $p->name }}</td>
                <td>{{ $p->id_number }}</td>
                <td>{{ $p->Phone_number ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <strong> للتواصل </strong> 0509040954  -  <strong>  واتساب  </strong>     0551796056 
    </div>

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
<script>
    window.onload = function () {
        // حدد العنصر اللي عايز تطبعه
        const element = document.body;

        const opt = {
            margin:       0,
            filename:     'كشف_الركاب.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'cm', format: 'a4', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(element).save();
    };
</script>



</html>
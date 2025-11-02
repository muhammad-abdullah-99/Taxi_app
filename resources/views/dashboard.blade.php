@extends('layouts.master')
@section('css')
@section('title')
dashboard
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-4">
            <h4 class="mb-0"> الرئيسية </h4>
        </div>
        <div class="col-sm-4">
            <a href="{{ route('page') }}" class="col-md-4 mb-4">
                <div class="card text-center bg-mauve">
                    <h5> اختيار لحة التحكم </h5>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item" class="default-color"> لحة التحكم </li>

                <li class="breadcrumb-item active"> الرئيسية </li>
            </ol>
        </div>

    </div>
</div>

@if (session('company_type') == 'taxi')

    {{-- Performance Index Section  --}}
    <div class="card-body">
        @php
            $isWeak = $company_indicator < 50;
            $rangeColor = $isWeak ? 'bg-danger' : 'bg-success';
            $rangeText = $isWeak ? 'أحمر' : 'أخضر';
            $textColor = $isWeak ? 'text-danger' : 'text-success';
        @endphp

        <h5 class="card-title text-center font-weight-bold {{ $textColor }}">مؤشر أداء الشركة</h5>

        <div class="d-flex align-items-center justify-content-center mt-4 flex-row-reverse">
         

            <!-- الرسم البياني -->
            <div id="companyIndicatorChart" style="height: 180px; width: 180px;"></div>
          <!-- البيانات الجانبية -->
            <div class="mr-4" style="font-size: 16px; min-width: 200px;">
                <p class="mb-3">
                    <strong class="text-muted">📄 إجمالي المستندات:</strong>
                    <span class="text-dark ml-1">{{ $total_documents }}</span>
                </p>
                <p class="mb-3">
                    <strong class="text-muted">📝 إجمالي الملاحظات:</strong>
                    <span class="text-dark ml-1">{{ $deactive_documents }}</span>
                </p>
                <div class="d-flex align-items-center mt-4">
                    <span class="text-muted font-weight-bold">🎯 نطاق الأداء:</span>
                    <div class="rounded-circle {{ $rangeColor }} ml-2" style="width: 14px; height: 14px;"></div>
                    <span class="ml-1 font-weight-bold {{ $textColor }}">{{ $rangeText }}</span>
                </div>
            </div>
        </div>
</div>
{{-- Performance Index Section  --}}

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let percentage = {{ $company_indicator }};
        let color = "#003366"; // أزرق غامق دائم

        var options = {
            chart: {
                height: 180,
                type: "radialBar",
            },
            series: [percentage],
            labels: [""],
            plotOptions: {
                radialBar: {
                    hollow: {
                        size: "60%",
                    },
                    track: {
                        strokeWidth: '65%',
                    },
                    dataLabels: {
                        name: {
                            show: false
                        },
                        value: {
                            fontSize: "20px",
                            fontWeight: "bold",
                            color: color
                        }
                    }
                }
            },
            colors: [color],
        };

        var chart = new ApexCharts(document.querySelector("#companyIndicatorChart"), options);
        chart.render();
    });
</script>

@if (Auth::check() && in_array(Auth::user()->role, ['موظف']))

{{-- Actions Section  --}}
<div class="dashboard_act_sect mb-4">
    <div class="card shadow-lg rounded-3 border-0" style="background-color: #1e1e2f; color: white;">
    <div class="card-header  text-white">
        <h5 class="mb-0 fw-bold text-white "> <i class="fa fa-files me-2 "></i> دعوة للعمل </h5>
    </div>
    <div class="card-body py-4">
    <div class="row">
                <div class="col-md-4">
                    <h6 class="fw-bold mb-3 text-white text-center">
                        <i class="ti-palette" style="font-size: 18px; font-weight: bold;"></i>
                        الموظفين
                    </h6>
                    <div class="d-flex justify-content-center">
                        <a href="{{route('addEmployee')}}" class="btn btn-secondary">إضافة موظف جديد</a>
                    </div>
                </div>

                <div class="col-md-4">
                    <h6 class="fw-bold mb-3 text-white text-center">
                        <i class="fa fa-car" style="font-size: 18px; font-weight: bold;"></i> السيارات
                    </h6>
                    <div class="d-flex justify-content-center">
                        <a href="{{route('addCars')}}" class="btn btn-secondary">إضافة سيارة جديدة</a>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <h6 class="fw-bold mb-3 text-white text-center">
                        <i class="fa fa-list-ul" style="font-size: 18px; font-weight: bold;"></i> المستندات
                    </h6>
                    <div class="d-flex justify-content-center">
                        <a href="{{route('addDocument')}}" class="btn btn-secondary">إضافة مستند</a>
                    </div>
                </div>            

    </div>
    </div>  
    </div>
</div>
{{-- Actions Section  --}}
@endif


@endif
<div class="row">
    <div class="col-sm-12">
        <img src="{{ URL::asset('assets/images/logo-dark.png') }}" alt="" style=" width:100%; margin-bottom: 20px; border-radius: 25px 0px 25px 0px; ">
    </div>
</div>
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row mb-4">
    @if (session('company_type') == 'taxi')

    {{--شركة الجواب --}}
    <div class="col-12 mb-4">
        <div class="card shadow-lg rounded-3 border-0" style="background-color: #1e1e2f; color: white;">
            <div class="card-header  text-white">
                <h5 class="mb-0 fw-bold text-white "> <i class="fa fa-files me-2 "></i> المستندات الادارية لشركة الجواب للنقل البري </h5>
            </div>
            
            <div class="card-body py-4">
                <div class="row text-center">
                    <div class="col-md-4 border-end border-secondary">
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark"
                                data-toggle="modal" data-target="#jawabSareyahModal" style="cursor: pointer;">
                                <span><i class="fa fa-check-circle text-success me-1"></i> سارية</span>
                                <span>{{ $jawab_sareyah->count() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- مودال عرض بطاقات شركة الجواب السارية -->
                    <div class="modal fade" id="jawabSareyahModal" tabindex="-1" role="dialog" aria-labelledby="jawabSareyahModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content bg-dark text-white">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">بطاقات شركة الجواب السارية</h5>
                                </div>
                                <div class="modal-body">
                                    @if($jawab_sareyah->isEmpty())
                                    <p class="text-center text-white">لا توجد بيانات</p>
                                    @else
                                    <table class="table table-dark table-striped table-bordered text-white mb-0">
                                        <thead>
                                            <tr>
                                                <th>اسم البطاقة</th>
                                                <th>تاريخ الانتهاء</th>
                                                <th>عدد الأيام المتبقية</th>
                                                <th>تعديل</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($jawab_sareyah as $item)
                                            @php
                                            $remainingDays = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($item->expire_at));
                                            @endphp
                                            <tr>
                                                <td>{{ $item->document_name ?? 'بدون اسم' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->expire_at)->format('Y-m-d') }}</td>
                                                <td>{{ floor($remainingDays) }}</td>

                                                <td>
                                                    <button class="btn btn-sm btn-warning text-dark"
                                                        data-toggle="modal"
                                                        data-target="#editJawabSareyahModal_{{ $item->id }}">
                                                        تعديل
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- مودالات تعديل تواريخ بطاقات شركة الجواب -->
                    @foreach($jawab_sareyah as $item)
                    <div class="modal fade" id="editJawabSareyahModal_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editJawabSareyahModalLabel_{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="POST" action="{{ route('documents.update_expiry') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <div class="modal-content bg-dark text-white">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">تعديل تاريخ الانتهاء</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>تاريخ الانتهاء الجديد</label>
                                            <input type="date" name="expire_at" class="form-control"
                                                value="{{ \Carbon\Carbon::parse($item->expire_at)->format('Y-m-d') }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                        <button type="submit" class="btn btn-success">حفظ التعديل</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach


                    <!-- البطاقة الجانبية لعدد بطاقات شركة الجواب التي ستنتهي قريباً -->
                    <div class="col-md-4 border-end border-warning">
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark"
                                data-toggle="modal" data-target="#jawabNearExpiryModal" style="cursor: pointer;">
                                <span><i class="fa fa-exclamation-triangle text-warning me-1"></i> قرب الانتهاء</span>
                                <span>{{ $jawab_near_expiry->count() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- مودال عرض بطاقات شركة الجواب التي ستنتهي قريباً -->
                    <div class="modal fade" id="jawabNearExpiryModal" tabindex="-1" role="dialog" aria-labelledby="jawabNearExpiryModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content bg-dark text-white">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">بطاقات شركة الجواب التي ستنتهي خلال 15 يوم</h5>
                                </div>
                                <div class="modal-body">
                                    @if($jawab_near_expiry->isEmpty())
                                    <p class="text-center text-white">لا توجد بيانات</p>
                                    @else
                                    <table class="table table-dark table-striped table-bordered text-white mb-0">
                                        <thead>
                                            <tr>
                                                <th>اسم البطاقة</th>
                                                <th>تاريخ الانتهاء</th>
                                                <th>عدد الأيام المتبقية</th>
                                                <th>تعديل</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($jawab_near_expiry as $item)
                                            @php
                                            $remainingDays = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($item->expire_at));
                                            @endphp
                                            <tr>
                                                <td>{{ $item->document_name ?? 'بدون اسم' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->expire_at)->format('Y-m-d') }}</td>
                                                <td>{{ floor($remainingDays) }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-warning text-dark"
                                                        data-toggle="modal"
                                                        data-target="#editJawabNearExpiryModal_{{ $item->id }}">
                                                        تعديل
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- مودالات تعديل تواريخ بطاقات شركة الجواب قرب الانتهاء -->
                    @foreach($jawab_near_expiry as $item)
                    <div class="modal fade" id="editJawabNearExpiryModal_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editJawabNearExpiryModalLabel_{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="POST" action="{{ route('documents.update_expiry') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <div class="modal-content bg-dark text-white">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">تعديل تاريخ الانتهاء</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>تاريخ الانتهاء الجديد</label>
                                            <input type="date" name="expire_at" class="form-control"
                                                value="{{ \Carbon\Carbon::parse($item->expire_at)->format('Y-m-d') }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                        <button type="submit" class="btn btn-success">حفظ التعديل</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach


                    <!-- البطاقة الجانبية لعدد بطاقات شركة الجواب المنتهية -->
                    <div class="col-md-4 border-end border-danger">
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark"
                                data-toggle="modal" data-target="#jawabExpiredModal" style="cursor: pointer;">
                                <span><i class="fa fa-times-circle text-danger me-1"></i> منتهية</span>
                                <span>{{ $jawab_expired->count() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- مودال عرض بطاقات شركة الجواب المنتهية -->
                    <div class="modal fade" id="jawabExpiredModal" tabindex="-1" role="dialog" aria-labelledby="jawabExpiredModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content bg-dark text-white">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">بطاقات شركة الجواب المنتهية</h5>
                                </div>
                                <div class="modal-body">
                                    @if($jawab_expired->isEmpty())
                                    <p class="text-center text-white">لا توجد بيانات</p>
                                    @else
                                    <table class="table table-dark table-striped table-bordered text-white mb-0">
                                        <thead>
                                            <tr>
                                                <th>اسم البطاقة</th>
                                                <th>تاريخ الانتهاء</th>
                                                <th>عدد الأيام منذ الانتهاء</th>
                                                <th>تعديل</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($jawab_expired as $item)
                                            @php
                                            $expiredDays = \Carbon\Carbon::parse($item->expire_at)->diffInDays(\Carbon\Carbon::now());
                                            @endphp
                                            <tr>
                                                <td>{{ $item->document_name ?? 'بدون اسم' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->expire_at)->format('Y-m-d') }}</td>
                                                <td>{{ floor($expiredDays) }}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-danger text-white"
                                                        data-toggle="modal"
                                                        data-target="#editJawabExpiredModal_{{ $item->id }}">
                                                        تعديل
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @endif
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- مودالات تعديل تواريخ بطاقات شركة الجواب المنتهية -->
                    @foreach($jawab_expired as $item)
                    <div class="modal fade" id="editJawabExpiredModal_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editJawabExpiredModalLabel_{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <form method="POST" action="{{ route('documents.update_expiry') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <div class="modal-content bg-dark text-white">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white">تعديل تاريخ الانتهاء</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>تاريخ الانتهاء الجديد</label>
                                            <input type="date" name="expire_at" class="form-control"
                                                value="{{ \Carbon\Carbon::parse($item->expire_at)->format('Y-m-d') }}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                        <button type="submit" class="btn btn-success">حفظ التعديل</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endforeach



                </div>
            </div>
        </div>
    </div>
    {{-- الموظفين --}}
    <div class="col-12 mb-4">
        <div class="card shadow-lg rounded-3 border-0" style="background-color: #1e1e2f; color: white;">
            <div class="card-header  text-white">
                <h5 class="mb-0 fw-bold text-white "> <i class="fa fa-users me-2 "></i> الموظفين : {{ $employees }} </h5>
            </div>

            <div class="card-body py-4">
                <div class="row text-center">

                    <!-- {{-- هوية مقيم --}}
                    <div class="col-md-4 border-end border-secondary">
                        <h6 class="fw-bold mb-3 text-white"> <i class="fa fa-id-card me-2 "></i> هوية مقيم</h6>
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark">
                                <span> <i class="fa fa-check-circle text-success me-1"></i> سارية </span>
                                <span>{{ $moqem_sareyah->count() }}</span>
                            </div>
                            </br>

                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark">
                                <span> <i class="fa fa-clock-o text-warning me-1"></i> قريبة الانتهاء</span>
                                <span>{{ $moqem_near_expiry->count() }}</span>
                            </div>
                            </br>

                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark">
                                <span> <i class="fa fa-times-circle text-danger me-1"></i> منتهية </span>
                                <span>{{ $moqem_expired->count() }}</span>
                            </div>
                        </div>
                    </div> -->
                    {{-- هوية مقيم --}}
                    <div class="col-md-4 border-end border-secondary">
                        <h6 class="fw-bold mb-3 text-white"> <i class="fa fa-id-card me-2 "></i> هوية مقيم</h6>
                        <div class="d-flex flex-column gap-2">

                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#sareyahModal" style="cursor: pointer;">
                                <span> <i class="fa fa-check-circle text-success me-1"></i> سارية </span>
                                <span>{{ $moqem_sareyah->count() }}</span>
                            </div>
                            <br>

                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#nearExpiryModal" style="cursor: pointer;">
                                <span> <i class="fa fa-clock-o text-warning me-1"></i> قريبة الانتهاء</span>
                                <span>{{ $moqem_near_expiry->count() }}</span>
                            </div>
                            <br>

                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#expiredModal" style="cursor: pointer;">
                                <span> <i class="fa fa-times-circle text-danger me-1"></i> منتهية </span>
                                <span>{{ $moqem_expired->count() }}</span>
                            </div>

                        </div>
                    </div>


                    {{-- المخالصة المالية --}}
                    <div class="col-md-4 border-end border-secondary">
                        <h6 class="fw-bold mb-3 text-white"> <i class="fa fa-money me-2"></i> المخالصة المالية</h6>
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#mokhalasaSareyahModal" style="cursor: pointer;">
                                <span> <i class="fa fa-check-circle text-success me-1"></i> سارية </span>
                                <span>{{ $mokhalasa_sareyah->count() }}</span>
                            </div>
                            <br>
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#mokhalasaNearExpiryModal" style="cursor: pointer;">
                                <span> <i class="fa fa-clock-o text-warning me-1"></i> قريبة الانتهاء </span>
                                <span>{{ $mokhalasa_near_expiry->count() }}</span>
                            </div>
                            <br>
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#mokhalasaExpiredModal" style="cursor: pointer;">
                                <span> <i class="fa fa-times-circle text-danger me-1"></i> منتهية</span>
                                <span>{{ $mokhalasa_expired->count() }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- بطاقات السائقين --}}
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-3 text-white">
                            <i class="fa fa-user me-2"></i> بطاقات السائقين
                        </h6>
                        <div class="d-flex flex-column gap-2">

                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#saiqCardSareyahModal" style="cursor: pointer;">
                                <span> <i class="fa fa-check-circle text-success me-1"></i> سارية</span>
                                <span>{{ $saiq_card_sareyah->count() }}</span>
                            </div>
                            <br>

                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#saiqCardNearExpiryModal" style="cursor: pointer;">
                                <span> <i class="fa fa-clock-o text-warning me-1"></i> قريبة الانتهاء</span>
                                <span>{{ $saiq_card_near_expiry->count() }}</span>
                            </div>
                            <br>

                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#saiqCardExpiredModal" style="cursor: pointer;">
                                <span> <i class="fa fa-times-circle text-danger me-1"></i> منتهية</span>
                                <span>{{ $saiq_card_expired->count() }}</span>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>





    {{-- السيارات --}}
    <div class="col-12 mb-4">
        <div class="card shadow-lg rounded-3 border-0" style="background-color: #1e1e2f; color: white;">
            <div class="card-header text-white">
                <h5 class="mb-0 fw-bold text-white">
                    <i class="fa fa-car me-2"></i> السيارات : {{$cars}}
                </h5>
            </div>
            <div class="card-body py-4">
                <div class="row text-center">

                    {{-- السيارات العاملة --}}
                    <div class="col-md-4 border-end border-secondary">
                        <button type="button" class="w-100 bg-dark text-white border-0 rounded py-3" data-toggle="modal" data-target="#workingModal">
                            <h6 class="fw-bold mb-2 text-white">
                                <i class="fa fa-car me-2 text-white"></i> السيارات العاملة
                            </h6>
                            <div class="fs-5"> العدد : {{$carsWork}}</div>
                        </button>
                    </div>

                    {{-- السيارات في الانتظار --}}
                    <div class="col-md-4 border-end border-secondary">
                        <button type="button" class="w-100 bg-dark text-white border-0 rounded py-3" data-toggle="modal" data-target="#waitingModal">
                            <h6 class="fw-bold mb-2 text-white">
                                <i class="fa fa-clock-o me-2"></i> السيارات في الانتظار
                            </h6>
                            <div class="fs-5"> العدد : {{$carsWaiting}}</div>
                        </button>
                    </div>

                    {{-- السيارات المتعطلة --}}
                    <div class="col-md-4">
                        <button type="button" class="w-100 bg-dark text-white border-0 rounded py-3" data-toggle="modal" data-target="#brokenModal">
                            <h6 class="fw-bold mb-2 text-white">
                                <i class="fa fa-wrench me-2 text-white"></i> السيارات المتعطلة
                            </h6>
                            <div class="fs-5">العدد : {{$carsNotWork}}</div>
                        </button>
                    </div>

                </div>
            </div>

            {{-- مودال السيارات العاملة --}}
            <div class="modal fade" id="workingModal" tabindex="-1" role="dialog" aria-labelledby="workingModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header border-secondary">
                            <h5 class="modal-title text-white">السيارات العاملة</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="table-responsive">
                                <table class="table table-bordered text-center table-dark table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th>رقم اللوحة</th>
                                            <th>اسم السائق</th>
                                            <th>أيام العمل</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carsDriversWork as $info)
                                        <tr>
                                            <td>{{ $info['car_plate'] }}</td>
                                            <td>{{ $info['employee_name'] }}</td>
                                            <td>{{ floor(floatval($info['days_working'])) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- مودال السيارات في الانتظار --}}
            <div class="modal fade" id="waitingModal" tabindex="-1" role="dialog" aria-labelledby="waitingModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header border-secondary">
                            <h5 class="modal-title text-white">السيارات في الانتظار</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span>&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center table-dark table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th>رقم اللوحة</th>
                                            <th>اسم السائق</th>
                                            <th>أيام التوقف</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carsDriversWaiting as $info)
                                        <tr>
                                            <td>{{ $info['car_plate'] }}</td>
                                            <td>{{ $info['employee_name'] }}</td>
                                            <td>{{ floor(floatval($info['days_waiting'])) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



            {{-- مودال السيارات المتعطلة --}}
            <div class="modal fade" id="brokenModal" tabindex="-1" role="dialog" aria-labelledby="brokenModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header border-secondary">
                            <h5 class="modal-title text-white">السيارات المتعطلة</h5>
                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                <span>&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center table-dark table-striped align-middle">
                                    <thead>
                                        <tr>
                                            <th>رقم اللوحة</th>
                                            <th>اسم السائق</th>
                                            <th>أيام التوقف</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carsDriversNotWork as $info)
                                        <tr>
                                            <td>{{ $info['car_plate'] }}</td>
                                            <td>{{ $info['employee_name'] }}</td>
                                            <td>{{ floor(floatval($info['days_waiting'])) }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--  -->

            <div class="card-body py-4">
                <div class="row text-center">
                    {{-- رخص السير --}}
                    <div class="col-md-4 border-end border-secondary">
                        <h6 class="fw-bold mb-3 text-white"><i class="fa fa-id-card me-2"></i> رخص السير</h6>
                        <div class="d-flex flex-column gap-2">
                            <!-- زر فتح المودال -->
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#rukhsaModal" style="cursor: pointer;">
                                <span><i class="fa fa-check-circle text-success me-1"></i> سارية</span>
                                <span>{{ $rukhsa_sareyah->count() }}</span>
                            </div>

                            <!-- مودال عرض الرخص السارية -->
                            <div class="modal fade" id="rukhsaModal" tabindex="-1" role="dialog" aria-labelledby="rukhsaModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">رخص السير السارية</h5>
                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            @if($rukhsa_sareyah->isEmpty())
                                            <p class="text-center">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-bordered text-white">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>باقي أيام</th>
                                                        <th>تحديث</th>
                                                        <th>التسليم والاستلام</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($rukhsa_sareyah as $doc)
                                                    @php
                                                    $remainingDays = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($doc->saer_expire_at), false);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->saer_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($remainingDays) }}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning text-dark" data-toggle="modal" data-target="#editRukhsaExpireModal_{{ $doc->id }}">تحديث</button>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('showHandover', $doc->id) }}" class="btn btn-sm btn-info">
                                                                عرض
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- مودالات التعديل لكل عنصر -->
                            @foreach($rukhsa_sareyah as $doc)
                            @php
        $docId = $doc->id;
        $saerDocuments = \App\Models\CarDocument::where('car_id', $doc->id)
                            ->where('type', 'saer_expire_at')
                            ->get();
    @endphp
                            <div class="modal fade" id="editRukhsaExpireModal_{{ $doc->id }}" tabindex="-1" role="dialog" aria-labelledby="editRukhsaExpireModalLabel_{{ $doc->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $doc->id }}">
                                        <input type="hidden" name="field" value="saer_expire_at">
                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title">تعديل تاريخ الانتهاء</h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->saer_expire_at)->format('Y-m-d') }}" required>
                                                </div>


                            <div class="form-group">
                            <label>إرفاق مرفقات جديدة</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple  required>
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($saerDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <p>لا يوجد مرفقات.</p>
                                @endforelse
                            </ul>
                        </div>



                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ التعديل</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach




                            </br>
                            {{-- بطاقة عرض --}}
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#rukhsaNearModal" style="cursor: pointer;">
                                <span><i class="fa fa-clock-o text-warning me-1"></i> قريبة الانتهاء</span>
                                <span>{{ $rukhsa_near_expiry->count() }}</span>
                            </div>

                            {{-- مودال عرض الرخص القريبة من الانتهاء --}}
                            <div class="modal fade" id="rukhsaNearModal" tabindex="-1" role="dialog" aria-labelledby="rukhsaNearModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">رخص سير قريبة الانتهاء</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($rukhsa_near_expiry->isEmpty())
                                            <p class="text-center text-white">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-striped table-bordered text-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>باقي أيام</th>
                                                        <th>تحديث</th>
                                                        <th>التسليم والاستلام</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($rukhsa_near_expiry as $doc)
                                                    @php
                                                    $remainingDays = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($doc->saer_expire_at), false);
                                                    $docId = $doc->id ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->saer_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($remainingDays) }}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning text-dark"
                                                                data-toggle="modal"
                                                                data-target="#editExpireModal_{{ $docId }}">
                                                                تحديث
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('showHandover', $doc->id) }}" class="btn btn-sm btn-info">
                                                            عرض
                                                            </a>
                                                        </td>                                                        
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- مودالات التعديل لكل وثيقة --}}
                            @foreach($rukhsa_near_expiry as $doc)
                            @php
                            $docId = $doc->id ?? null;
                             $saerDocuments = \App\Models\CarDocument::where('car_id', $doc->id)
                            ->where('type', 'saer_expire_at')
                            ->get();
                            @endphp
                            <div class="modal fade" id="editExpireModal_{{ $docId }}" tabindex="-1" role="dialog" aria-labelledby="editExpireModalLabel_{{ $docId }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $docId }}">
                                        <input type="hidden" name="field" value="saer_expire_at">
                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">تعديل تاريخ الانتهاء</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->saer_expire_at)->format('Y-m-d') }}" required>
                                                </div>


                                                 <div class="form-group">
                            <label>إرفاق مرفقات جديدة</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($saerDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <p>لا يوجد مرفقات.</p>
                                @endforelse
                            </ul>
                        </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ التعديل</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                            </br>
                            {{-- بطاقة عرض الرخص المنتهية --}}
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#rukhsaExpiredModal" style="cursor: pointer;">
                                <span><i class="fa fa-times-circle text-danger me-1"></i> منتهية</span>
                                <span>{{ $rukhsa_expired->count() }}</span>
                            </div>

                            {{-- مودال عرض الرخص المنتهية --}}
                            <div class="modal fade" id="rukhsaExpiredModal" tabindex="-1" role="dialog" aria-labelledby="rukhsaExpiredModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">رخص سير منتهية</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($rukhsa_expired->isEmpty())
                                            <p class="text-center text-white">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-striped table-bordered text-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th> انتهت منذ(يوم) </th>
                                                        <th>تحديث</th>
                                                        <th>التسليم والاستلام</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($rukhsa_expired as $doc)
                                                    @php
                                                    $daysSinceExpired = \Carbon\Carbon::parse($doc->saer_expire_at)->diffInDays(\Carbon\Carbon::now(), false);
                                                    $docId = $doc->id ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->saer_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($daysSinceExpired) }}</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-danger text-white"
                                                                data-toggle="modal"
                                                                data-target="#editExpireModal_{{ $docId }}">
                                                                تحديث
                                                            </button>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('showHandover', $doc->    id) }}" class="btn btn-sm btn-info">
                                                            عرض
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- مودالات تعديل التاريخ لكل وثيقة منتهية --}}
                            @foreach($rukhsa_expired as $doc)
                            @php


                            $docId = $doc->id ?? null;
 $saerDocuments = \App\Models\CarDocument::where('car_id', $doc->id)
                            ->where('type', 'saer_expire_at')
                            ->get();

                            @endphp
                            <div class="modal fade" id="editExpireModal_{{ $docId }}" tabindex="-1" role="dialog" aria-labelledby="editExpireModalLabel_{{ $docId }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $docId }}">
                                        <input type="hidden" name="field" value="saer_expire_at">

                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">تعديل تاريخ الانتهاء</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->saer_expire_at)->format('Y-m-d') }}" required>
                                                </div>

                                                 <div class="form-group">
                            <label>إرفاق مرفقات جديدة</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($saerDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <p>لا يوجد مرفقات.</p>
                                @endforelse
                            </ul>
                        </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ التعديل</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                    {{-- التأمين --}}
                    <div class="col-md-4 border-end border-secondary">
                        <h6 class="fw-bold mb-3 text-white"><i class="fa fa-shield me-2"></i> التأمين</h6>
                        <div class="d-flex flex-column gap-2">
                            {{-- بطاقة عرض التأمينات السارية --}}
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#taamenSareyahModal" style="cursor: pointer;">
                                <span><i class="fa fa-check-circle text-success me-1"></i> سارية</span>
                                <span>{{ $taamen_sareyah->count() }}</span>
                            </div>

                            {{-- مودال عرض التأمينات السارية --}}
                            <div class="modal fade" id="taamenSareyahModal" tabindex="-1" role="dialog" aria-labelledby="taamenSareyahModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">تأمينات سارية</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($taamen_sareyah->isEmpty())
                                            <p class="text-center text-white">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-striped table-bordered text-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>يتبقى</th>
                                                        <th>تعديل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($taamen_sareyah as $doc)
                                                    @php
                                                    $daysRemaining = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($doc->tamen_expire_at), false);
                                                    $docId = $doc->id ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->tamen_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($daysRemaining) }} يوم</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning text-dark"
                                                                data-toggle="modal"
                                                                data-target="#editTaamenModal_{{ $docId }}">
                                                                تعديل
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- مودالات تعديل التاريخ لكل تأمين ساري --}}
                            @foreach($taamen_sareyah as $doc)
                            @php
                            $docId = $doc->id ?? null;
        $tamenDocuments = \App\Models\CarDocument::where('car_id', $docId)
                            ->where('type', 'tamen_expire_at')
                            ->get();
                            @endphp
                            <div class="modal fade" id="editTaamenModal_{{ $docId }}" tabindex="-1" role="dialog" aria-labelledby="editTaamenModalLabel_{{ $docId }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}"  enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $docId }}">
                                        <input type="hidden" name="field" value="tamen_expire_at">
                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">تعديل تاريخ الانتهاء</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->tamen_expire_at)->format('Y-m-d') }}" required>
                                                </div>
                                                <div class="form-group">
                            <label>إرفاق ملفات جديدة (صور أو PDF)</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple  required>
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($tamenDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <p>لا يوجد مرفقات.</p>
                                @endforelse
                            </ul>
                        </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ التعديل</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                            </br>
                            {{-- بطاقة عرض التأمينات قريبة الانتهاء --}}
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#taamenNearExpiryModal" style="cursor: pointer;">
                                <span><i class="fa fa-clock-o text-warning me-1"></i> قريبة الانتهاء</span>
                                <span>{{ $taamen_near_expiry->count() }}</span>
                            </div>

                            {{-- مودال عرض التأمينات قريبة الانتهاء --}}
                            <div class="modal fade" id="taamenNearExpiryModal" tabindex="-1" role="dialog" aria-labelledby="taamenNearExpiryModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">تأمينات قريبة الانتهاء</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($taamen_near_expiry->isEmpty())
                                            <p class="text-center text-white">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-striped table-bordered text-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>يتبقى</th>
                                                        <th>تعديل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($taamen_near_expiry as $doc)
                                                    @php
                                                    $daysRemaining = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($doc->tamen_expire_at), false);
                                                    $docId = $doc->id ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->tamen_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($daysRemaining) }} يوم</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning text-dark"
                                                                data-toggle="modal"
                                                                data-target="#editTaamenModal_{{ $docId }}">
                                                                تعديل
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- مودالات تعديل التاريخ لكل تأمين قريب الانتهاء --}}
                            @foreach($taamen_near_expiry as $doc)
                            @php
                            $docId = $doc->id ?? null;
        $tamenDocuments = \App\Models\CarDocument::where('car_id', $docId)
                            ->where('type', 'tamen_expire_at')
                            ->get();
                            @endphp
                            <div class="modal fade" id="editTaamenModal_{{ $docId }}" tabindex="-1" role="dialog" aria-labelledby="editTaamenModalLabel_{{ $docId }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $docId }}">
                                        <input type="hidden" name="field" value="tamen_expire_at">
                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">تعديل تاريخ الانتهاء</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->tamen_expire_at)->format('Y-m-d') }}" required>
                                                </div>
                                                <div class="form-group">
                            <label>إرفاق ملفات جديدة (صور أو PDF)</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($tamenDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <p>لا يوجد مرفقات.</p>
                                @endforelse
                            </ul>
                        </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ التعديل</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                            </br>
                            {{-- بطاقة عرض التأمينات المنتهية --}}
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#taamenExpiredModal" style="cursor: pointer;">
                                <span><i class="fa fa-times-circle text-danger me-1"></i> منتهية</span>
                                <span>{{ $taamen_expired->count() }}</span>
                            </div>

                            {{-- مودال عرض التأمينات المنتهية --}}
                            <div class="modal fade" id="taamenExpiredModal" tabindex="-1" role="dialog" aria-labelledby="taamenExpiredModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">تأمينات منتهية</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($taamen_expired->isEmpty())
                                            <p class="text-center text-white">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-striped table-bordered text-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>(يوم)انتهت منذ</th>
                                                        <th>تعديل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($taamen_expired as $doc)
                                                    @php
                                                    $daysAgo = \Carbon\Carbon::parse($doc->tamen_expire_at)->diffInDays(\Carbon\Carbon::now(), false);
                                                    $docId = $doc->id ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->tamen_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($daysAgo) }} </td>
                                                        <td>
                                                            <button class="btn btn-sm btn-danger"
                                                                data-toggle="modal"
                                                                data-target="#editTaamenExpiredModal_{{ $docId }}">
                                                                تعديل
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- مودالات تعديل التاريخ لكل تأمين منتهي --}}
                            @foreach($taamen_expired as $doc)
                            @php
                            $docId = $doc->id ?? null;
        $tamenDocuments = \App\Models\CarDocument::where('car_id', $docId)
                            ->where('type', 'tamen_expire_at')
                            ->get();
                            @endphp
                            <div class="modal fade" id="editTaamenExpiredModal_{{ $docId }}" tabindex="-1" role="dialog" aria-labelledby="editTaamenExpiredModalLabel_{{ $docId }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $docId }}">
                                        <input type="hidden" name="field" value="tamen_expire_at">
                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">تعديل تاريخ الانتهاء</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->tamen_expire_at)->format('Y-m-d') }}" required>
                                                </div>
                                                <div class="form-group">
                            <label>إرفاق ملفات جديدة (صور أو PDF)</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple  required>
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($tamenDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <p>لا يوجد مرفقات.</p>
                                @endforelse
                            </ul>
                        </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ التعديل</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                    {{-- الفحص الدوري --}}
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-3 text-white"><i class="fa fa-search me-2"></i> الفحص الدوري</h6>
                        <div class="d-flex flex-column gap-2">
                            {{-- بطاقة الفحص الساري --}}
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#fahesSareyahModal" style="cursor: pointer;">
                                <span><i class="fa fa-check-circle text-success me-1"></i> سارية</span>
                                <span>{{ $fahes_sareyah->count() }}</span>
                            </div>

                            {{-- مودال عرض الفحوصات السارية --}}
                            <div class="modal fade" id="fahesSareyahModal" tabindex="-1" role="dialog" aria-labelledby="fahesSareyahModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">فحوصات سارية</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($fahes_sareyah->isEmpty())
                                            <p class="text-center text-white">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-striped table-bordered text-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>يتبقى</th>
                                                        <th>تعديل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($fahes_sareyah as $doc)
                                                    @php
                                                    $daysRemaining = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($doc->fahs_expire_at), false);
                                                    $docId = $doc->id ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->fahs_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($daysRemaining) }} يوم</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning"
                                                                data-toggle="modal"
                                                                data-target="#editFahesSareyahModal_{{ $docId }}">
                                                                تعديل
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- مودالات تعديل التاريخ لكل فحص --}}
                            @foreach($fahes_sareyah as $doc)
                            @php
                            $docId = $doc->id ?? null;
                            $fahesDocuments = \App\Models\CarDocument::where('car_id', $docId)
                            ->where('type', 'fahs_expire_at')
                            ->get();
                            @endphp
                            <div class="modal fade" id="editFahesSareyahModal_{{ $docId }}" tabindex="-1" role="dialog" aria-labelledby="editFahesSareyahModalLabel_{{ $docId }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $docId }}">
                                        <input type="hidden" name="field" value="fahs_expire_at">

                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">تعديل تاريخ انتهاء الفحص</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->fahs_expire_at)->format('Y-m-d') }}" required>
                                                </div>
                                                <div class="form-group">
                            <label>إرفاق ملفات جديدة (صور أو PDF)</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($fahesDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <p>لا يوجد مرفقات.</p>
                                @endforelse
                            </ul>
                        </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ التعديل</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                            </br>
                            {{-- بطاقة الفحص - قريبة الانتهاء --}}
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#fahesNearExpiryModal" style="cursor: pointer;">
                                <span><i class="fa fa-clock-o text-warning me-1"></i> قريبة الانتهاء</span>
                                <span>{{ $fahes_near_expiry->count() }}</span>
                            </div>

                            {{-- مودال عرض الفحوصات القريبة الانتهاء --}}
                            <div class="modal fade" id="fahesNearExpiryModal" tabindex="-1" role="dialog" aria-labelledby="fahesNearExpiryModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">فحوصات قريبة الانتهاء</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($fahes_near_expiry->isEmpty())
                                            <p class="text-center text-white">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-striped table-bordered text-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>يتبقى</th>
                                                        <th>تعديل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($fahes_near_expiry as $doc)
                                                    @php
                                                    $daysRemaining = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($doc->fahs_expire_at), false);
                                                    $docId = $doc->id ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->fahs_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($daysRemaining)}} يوم</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning"
                                                                data-toggle="modal"
                                                                data-target="#editFahesNearExpiryModal_{{ $docId }}">
                                                                تعديل
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- مودالات تعديل التاريخ لكل فحص --}}
                            @foreach($fahes_near_expiry as $doc)
                            @php
                            $docId = $doc->id ?? null;
                            $fahesDocuments = \App\Models\CarDocument::where('car_id', $docId)
                            ->where('type', 'fahs_expire_at')
                            ->get();
                            @endphp
                            <div class="modal fade" id="editFahesNearExpiryModal_{{ $docId }}" tabindex="-1" role="dialog" aria-labelledby="editFahesNearExpiryModalLabel_{{ $docId }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $docId }}">
                                        <input type="hidden" name="field" value="fahs_expire_at">

                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">تعديل تاريخ انتهاء الفحص</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->fahs_expire_at)->format('Y-m-d') }}" required>
                                                </div>
                                                <div class="form-group">
                            <label>إرفاق ملفات جديدة (صور أو PDF)</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($fahesDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <p>لا يوجد مرفقات.</p>
                                @endforelse
                            </ul>
                        </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ التعديل</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                            </br>
                            {{-- بطاقة الفحص - منتهية --}}
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#fahesExpiredModal" style="cursor: pointer;">
                                <span><i class="fa fa-times-circle text-danger me-1"></i> منتهية</span>
                                <span>{{ $fahes_expired->count() }}</span>
                            </div>

                            {{-- مودال عرض الفحوصات المنتهية --}}
                            <div class="modal fade" id="fahesExpiredModal" tabindex="-1" role="dialog" aria-labelledby="fahesExpiredModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">فحوصات منتهية</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($fahes_expired->isEmpty())
                                            <p class="text-center text-white">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-striped table-bordered text-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>منذ</th>
                                                        <th>تعديل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($fahes_expired as $doc)
                                                    @php
                                                    $daysOverdue = \Carbon\Carbon::parse($doc->fahs_expire_at)->diffInDays(\Carbon\Carbon::now(), false);
                                                    $docId = $doc->id ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->fahs_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($daysOverdue) }} يوم</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-danger"
                                                                data-toggle="modal"
                                                                data-target="#editFahesExpiredModal_{{ $docId }}">
                                                                تعديل
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- مودالات تعديل التاريخ لكل فحص منتهي --}}
                            @foreach($fahes_expired as $doc)
                            @php
                            $docId = $doc->id ?? null;
                            $fahesDocuments = \App\Models\CarDocument::where('car_id', $docId)
                            ->where('type', 'fahs_expire_at')
                            ->get();
                            @endphp
                            <div class="modal fade" id="editFahesExpiredModal_{{ $docId }}" tabindex="-1" role="dialog" aria-labelledby="editFahesExpiredModalLabel_{{ $docId }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $docId }}">
                                        <input type="hidden" name="field" value="fahs_expire_at">
                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">تعديل تاريخ انتهاء الفحص</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->fahs_expire_at)->format('Y-m-d') }}" required>
                                                </div>
                                                <div class="form-group">
                            <label>إرفاق ملفات جديدة (صور أو PDF)</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple  required>
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($fahesDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <p>لا يوجد مرفقات.</p>
                                @endforelse
                            </ul>
                        </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ التعديل</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                    {{-- بطاقة التشغيل --}}
                    <div class="col-md-4 border-end border-secondary mt-4">
                        <h6 class="fw-bold mb-3 text-white"><i class="fa fa-cogs me-2"></i> بطاقات التشغيل</h6>
                        <div class="d-flex flex-column gap-2">
                            {{-- بطاقة تشغيل - سارية --}}
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#tasgheelSareyahModal" style="cursor: pointer;">
                                <span><i class="fa fa-check-circle text-success me-1"></i> سارية</span>
                                <span>{{ $tasgheel_sareyah->count() }}</span>
                            </div>

                            {{-- مودال عرض التشغيلات السارية --}}
                            <div class="modal fade" id="tasgheelSareyahModal" tabindex="-1" role="dialog" aria-labelledby="tasgheelSareyahModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">تشغيل - سارية</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($tasgheel_sareyah->isEmpty())
                                            <p class="text-center text-white">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-striped table-bordered text-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>يتبقى</th>
                                                        <th>تعديل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($tasgheel_sareyah as $doc)
                                                    @php
                                                    $daysLeft = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($doc->cart_expire_at), false);
                                                    $docId = $doc->id ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->cart_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($daysLeft) }} يوم</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning"
                                                                data-toggle="modal"
                                                                data-target="#editTasgheelSareyahModal_{{ $docId }}">
                                                                تعديل
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- مودالات تعديل التاريخ لكل تشغيل ساري --}}
                            @foreach($tasgheel_sareyah as $doc)
                            @php
                            $docId = $doc->id ?? null;
                             $tasgheelDocuments = \App\Models\CarDocument::where('car_id', $docId)
                                ->where('type', 'cart_expire_at')
                                ->get();

                            @endphp
                            <div class="modal fade" id="editTasgheelSareyahModal_{{ $docId }}" tabindex="-1" role="dialog" aria-labelledby="editTasgheelSareyahModalLabel_{{ $docId }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $docId }}">
                                        <input type="hidden" name="field" value="cart_expire_at">

                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">تعديل تاريخ انتهاء التشغيل</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->cart_expire_at)->format('Y-m-d') }}" required>
                                                </div>
                                                <div class="form-group">
                            <label>إرفاق ملفات جديدة (صور أو PDF)</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($tasgheelDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <p>لا يوجد مرفقات.</p>
                                @endforelse
                            </ul>
                        </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ التعديل</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                            </br>
                            {{-- بطاقة تشغيل - قريبة الانتهاء --}}
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#tasgheelNearExpiryModal" style="cursor: pointer;">
                                <span><i class="fa fa-clock-o text-warning me-1"></i> قريبة الانتهاء</span>
                                <span>{{ $tasgheel_near_expiry->count() }}</span>
                            </div>

                            {{-- مودال عرض التشغيلات القريبة من الانتهاء --}}
                            <div class="modal fade" id="tasgheelNearExpiryModal" tabindex="-1" role="dialog" aria-labelledby="tasgheelNearExpiryModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">تشغيل - قريبة الانتهاء</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($tasgheel_near_expiry->isEmpty())
                                            <p class="text-center text-white">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-striped table-bordered text-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>يتبقى</th>
                                                        <th>تعديل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($tasgheel_near_expiry as $doc)
                                                    @php
                                                    $daysLeft = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($doc->cart_expire_at), false);
                                                    $docId = $doc->id ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->cart_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($daysLeft) }} يوم</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning"
                                                                data-toggle="modal"
                                                                data-target="#editTasgheelNearExpiryModal_{{ $docId }}">
                                                                تعديل
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- مودالات تعديل التاريخ لكل تشغيل قريب الانتهاء --}}
                            @foreach($tasgheel_near_expiry as $doc)
                            @php
                            $docId = $doc->id ?? null;
                             $tasgheelDocuments = \App\Models\CarDocument::where('car_id', $docId)
                                ->where('type', 'cart_expire_at')
                                ->get();
                            @endphp
                            <div class="modal fade" id="editTasgheelNearExpiryModal_{{ $docId }}" tabindex="-1" role="dialog" aria-labelledby="editTasgheelNearExpiryModalLabel_{{ $docId }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $docId }}">
                                        <input type="hidden" name="field" value="cart_expire_at">
                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">تعديل تاريخ انتهاء التشغيل</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->cart_expire_at)->format('Y-m-d') }}" required>
                                                </div>
                                                <div class="form-group">
                            <label>إرفاق ملفات جديدة (صور أو PDF)</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple  required> 
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($tasgheelDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <p>لا يوجد مرفقات.</p>
                                @endforelse
                            </ul>
                        </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ التعديل</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                            </br>
                            {{-- بطاقة تشغيل - منتهية --}}
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#tasgheelExpiredModal" style="cursor: pointer;">
                                <span><i class="fa fa-times-circle text-danger me-1"></i> منتهية</span>
                                <span>{{ $tasgheel_expired->count() }}</span>
                            </div>

                            {{-- مودال عرض التشغيلات المنتهية --}}
                            <div class="modal fade" id="tasgheelExpiredModal" tabindex="-1" role="dialog" aria-labelledby="tasgheelExpiredModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">تشغيل - منتهية</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($tasgheel_expired->isEmpty())
                                            <p class="text-center text-white">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-striped table-bordered text-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>منذ</th>
                                                        <th>تعديل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($tasgheel_expired as $doc)
                                                    @php
                                                    $daysAgo = \Carbon\Carbon::parse($doc->cart_expire_at)->diffInDays(\Carbon\Carbon::now(), false);
                                                    $docId = $doc->id ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->cart_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($daysAgo) }} يوم</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning"
                                                                data-toggle="modal"
                                                                data-target="#editTasgheelExpiredModal_{{ $docId }}">
                                                                تعديل
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- مودالات تعديل التاريخ لكل تشغيل منتهية --}}
                            @foreach($tasgheel_expired as $doc)
                            @php
                            $docId = $doc->id ?? null;
                             $tasgheelDocuments = \App\Models\CarDocument::where('car_id', $docId)
                                ->where('type', 'cart_expire_at')
                                ->get();
                            @endphp
                            <div class="modal fade" id="editTasgheelExpiredModal_{{ $docId }}" tabindex="-1" role="dialog" aria-labelledby="editTasgheelExpiredModalLabel_{{ $docId }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $docId }}">
                                        <input type="hidden" name="field" value="cart_expire_at">
                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">تعديل تاريخ انتهاء التشغيل</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->cart_expire_at)->format('Y-m-d') }}" required>
                                                </div>


                                                <div class="form-group">
                            <label>إرفاق ملفات جديدة (صور أو PDF)</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($tasgheelDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <p>لا يوجد مرفقات.</p>
                                @endforelse
                            </ul>
                        </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ التعديل</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                    {{-- تغيير الزيت --}}
                    <div class="col-md-4 border-end border-secondary mt-4">
                        <h6 class="fw-bold mb-3 text-white"><i class="fa fa-cog me-2"></i> تغيير الزيت</h6>
                        <div class="d-flex flex-column gap-2">
                            {{-- كارت زيت - سارية --}}
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#zaytSareyahModal" style="cursor: pointer;">
                                <span><i class="fa fa-check-circle text-success me-1"></i> سارية</span>
                                <span>{{ $zayt_sareyah->count() }}</span>
                            </div>

                            {{-- مودال عرض الزيت الساري --}}
                            <div class="modal fade" id="zaytSareyahModal" tabindex="-1" role="dialog" aria-labelledby="zaytSareyahModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">زيت - سارية</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($zayt_sareyah->isEmpty())
                                            <p class="text-center text-white">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-striped table-bordered text-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>يتبقى</th>
                                                        <th>تعديل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($zayt_sareyah as $doc)
                                                    @php
                                                    $daysLeft = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($doc->zaet_expire_at), false);
                                                    $docId = $doc->id ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->zaet_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($daysLeft) }} يوم</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning"
                                                                data-toggle="modal"
                                                                data-target="#editZaytSareyahModal_{{ $docId }}">
                                                                تعديل
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- مودالات تعديل التاريخ لكل عنصر زيت ساري --}}
                            @foreach($zayt_sareyah as $doc)
                            @php
                            $docId = $doc->id ?? null;
                               $zaytDocuments = \App\Models\CarDocument::where('car_id', $docId)
                            ->where('type', 'zaet_expire_at')
                            ->get();
                            @endphp
                            <div class="modal fade" id="editZaytSareyahModal_{{ $docId }}" tabindex="-1" role="dialog" aria-labelledby="editZaytSareyahModalLabel_{{ $docId }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $docId }}">
                                        <input type="hidden" name="field" value="zaet_expire_at">

                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">تعديل تاريخ انتهاء الزيت</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->zaet_expire_at)->format('Y-m-d') }}" required>
                                                </div>
                                                
                        <div class="form-group">
                            <label>إرفاق ملفات جديدة (PDF أو صور)</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple  required> 
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($zaytDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <li>لا يوجد مرفقات.</li>
                                @endforelse
                            </ul>
                        </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ التعديل</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                            </br>
                            {{-- كارت زيت - قريبة الانتهاء --}}
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#zaytNearExpiryModal" style="cursor: pointer;">
                                <span><i class="fa fa-clock-o text-warning me-1"></i> قريبة الانتهاء</span>
                                <span>{{ $zayt_near_expiry->count() }}</span>
                            </div>

                            {{-- مودال عرض الزيت - قريبة الانتهاء --}}
                            <div class="modal fade" id="zaytNearExpiryModal" tabindex="-1" role="dialog" aria-labelledby="zaytNearExpiryModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">زيت - قريبة الانتهاء</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($zayt_near_expiry->isEmpty())
                                            <p class="text-center text-white">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-striped table-bordered text-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>يتبقى</th>
                                                        <th>تعديل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($zayt_near_expiry as $doc)
                                                    @php
                                                    $daysLeft = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($doc->zaet_expire_at), false);
                                                    $docId = $doc->id ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->zaet_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($daysLeft) }} يوم</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning"
                                                                data-toggle="modal"
                                                                data-target="#editZaytNearExpiryModal_{{ $docId }}">
                                                                تعديل
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- مودالات تعديل التاريخ لكل عنصر زيت قريب الانتهاء --}}
                            @foreach($zayt_near_expiry as $doc)
                            @php $docId = $doc->id ?? null;
                               $zaytDocuments = \App\Models\CarDocument::where('car_id', $docId)
                            ->where('type', 'zaet_expire_at')
                            ->get();
                            @endphp
                            <div class="modal fade" id="editZaytNearExpiryModal_{{ $docId }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $docId }}">
                                        <input type="hidden" name="field" value="zaet_expire_at">

                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">تعديل تاريخ الانتهاء</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->zaet_expire_at)->format('Y-m-d') }}" required>
                                                </div>

                                                
                        <div class="form-group">
                            <label>إرفاق ملفات جديدة (PDF أو صور)</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($zaytDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <li>لا يوجد مرفقات.</li>
                                @endforelse
                            </ul>
                        </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                            </br>
                            {{-- كارت زيت - منتهية --}}
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#zaytExpiredModal" style="cursor: pointer;">
                                <span><i class="fa fa-times-circle text-danger me-1"></i> منتهية</span>
                                <span>{{ $zayt_expired->count() }}</span>
                            </div>

                            {{-- مودال عرض الزيت - منتهية --}}
                            <div class="modal fade" id="zaytExpiredModal" tabindex="-1" role="dialog" aria-labelledby="zaytExpiredModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">زيت - منتهية</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($zayt_expired->isEmpty())
                                            <p class="text-center text-white">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-striped table-bordered text-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>مرت على الانتهاء</th>
                                                        <th>تعديل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($zayt_expired as $doc)
                                                    @php
                                                    $daysAgo = \Carbon\Carbon::parse($doc->zaet_expire_at)->diffInDays(now(), false);
                                                    $docId = $doc->id ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->zaet_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($daysAgo) }} يوم</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning"
                                                                data-toggle="modal"
                                                                data-target="#editZaytExpiredModal_{{ $docId }}">
                                                                تعديل
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- مودالات تعديل التاريخ لكل عنصر زيت منتهي --}}
                            @foreach($zayt_expired as $doc)
                            @php $docId = $doc->id ?? null; 
                               $zaytDocuments = \App\Models\CarDocument::where('car_id', $docId)
                            ->where('type', 'zaet_expire_at')
                            ->get();
                            @endphp
                            <div class="modal fade" id="editZaytExpiredModal_{{ $docId }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $docId }}">
                                        <input type="hidden" name="field" value="zaet_expire_at">

                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">تعديل تاريخ الانتهاء</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->zaet_expire_at)->format('Y-m-d') }}" required>
                                                </div>
                                                
                        <div class="form-group">
                            <label>إرفاق ملفات جديدة (PDF أو صور)</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($zaytDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <li>لا يوجد مرفقات.</li>
                                @endforelse
                            </ul>
                        </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                    {{-- تفويض قيادة --}}
                    <div class="col-md-4 border-end border-secondary mt-4">
                        <h6 class="fw-bold mb-3 text-white"><i class="fa fa-cog me-2"></i> تتبع المركبات  </h6>
                        <div class="d-flex flex-column gap-2">
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#tafweedSareyahModal" style="cursor: pointer;">
                                <span><i class="fa fa-check-circle text-success me-1"></i> سارية</span>
                                <span>{{ $tafwed_sareyah->count() }}</span>
                            </div>

                            <div class="modal fade" id="tafweedSareyahModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title">   سارية</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($tafwed_sareyah->isEmpty())
                                            <p class="text-center">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-bordered text-white">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>يتبقى</th>
                                                        <th>تعديل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($tafwed_sareyah as $doc)
                                                    @php
                                                    $daysLeft = now()->diffInDays(\Carbon\Carbon::parse($doc->tafwed_expire_at), false);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name }} - {{ $doc->type  }} - {{ $doc->plate_number }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->tafwed_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($daysLeft) }} يوم</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editTafweedModal_{{ $doc->id }}">تعديل</button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach($tafwed_sareyah as $doc)
                             @php
        $docId = $doc->id ?? null;
        $tafweedDocuments = \App\Models\CarDocument::where('car_id', $docId)
                                ->where('type', 'tafwed_expire_at')
                                ->get();
    @endphp
                            <div class="modal fade" id="editTafweedModal_{{ $doc->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $doc->id }}">
                                        <input type="hidden" name="field" value="tafwed_expire_at">

                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title">تعديل التاريخ </h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control" value="{{ \Carbon\Carbon::parse($doc->tafwed_expire_at)->format('Y-m-d') }}" required>
                                                </div>
                                                 <div class="form-group">
                            <label>إرفاق ملفات جديدة (PDF أو صور)</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($tafweedDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <li>لا يوجد مرفقات.</li>
                                @endforelse
                            </ul>
                        </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button class="btn btn-success" type="submit">حفظ</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach


                            </br>
                            {{-- كارت تفويض - قريبة الانتهاء --}}
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#tafweedNearExpiryModal" style="cursor: pointer;">
                                <span><i class="fa fa-clock-o text-warning me-1"></i> قريبة الانتهاء</span>
                                <span>{{ $tafwed_near_expiry->count() }}</span>
                            </div>

                            {{-- مودال عرض التفويض - قريبة الانتهاء --}}
                            <div class="modal fade" id="tafweedNearExpiryModal" tabindex="-1" role="dialog" aria-labelledby="tafweedNearExpiryModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">تتبع المركبات  - قريبة الانتهاء</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($tafwed_near_expiry->isEmpty())
                                            <p class="text-center text-white">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-striped table-bordered text-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>يتبقى</th>
                                                        <th>تعديل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($tafwed_near_expiry as $doc)
                                                    @php
                                                    $daysLeft = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($doc->tafwed_expire_at), false);
                                                    $docId = $doc->id ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->tafwed_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($daysLeft) }} يوم</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning"
                                                                data-toggle="modal"
                                                                data-target="#editTafweedNearExpiryModal_{{ $docId }}">
                                                                تعديل
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- مودالات تعديل التاريخ لكل عنصر تفويض قريب الانتهاء --}}
                            @foreach($tafwed_near_expiry as $doc)
 @php
        $docId = $doc->id ?? null;
        $tafweedDocuments = \App\Models\CarDocument::where('car_id', $docId)
                                ->where('type', 'tafwed_expire_at')
                                ->get();
    @endphp                            <div class="modal fade" id="editTafweedNearExpiryModal_{{ $docId }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $docId }}">
                                        <input type="hidden" name="field" value="tafwed_expire_at">

                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">تعديل التاريخ </h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->tafwed_expire_at)->format('Y-m-d') }}" required>
                                                </div>
                                                 <div class="form-group">
                            <label>إرفاق ملفات جديدة (PDF أو صور)</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($tafweedDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <li>لا يوجد مرفقات.</li>
                                @endforelse
                            </ul>
                        </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach


                            </br>
                            {{-- كارت تفويض - منتهية --}}
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#tafwedExpiredModal" style="cursor: pointer;">
                                <span><i class="fa fa-times-circle text-danger me-1"></i> منتهي</span>
                                <span>{{ $tafwed_expired->count() }}</span>
                            </div>

                            {{-- مودال عرض التفويض - منتهية --}}
                            <div class="modal fade" id="tafwedExpiredModal" tabindex="-1" role="dialog" aria-labelledby="tafwedExpiredModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content bg-dark text-white">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-white">   منتهية</h5>
                                        </div>
                                        <div class="modal-body">
                                            @if($tafwed_expired->isEmpty())
                                            <p class="text-center text-white">لا توجد بيانات</p>
                                            @else
                                            <table class="table table-dark table-striped table-bordered text-white mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>تاريخ الانتهاء</th>
                                                        <th>مرت على الانتهاء</th>
                                                        <th>تعديل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($tafwed_expired as $doc)
                                                    @php
                                                    $daysAgo = \Carbon\Carbon::parse($doc->tafwed_expire_at)->diffInDays(now(), false);
                                                    $docId = $doc->id ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $doc->name  }} - {{ $doc->type  }} - {{ $doc->plate_number  }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($doc->tafwed_expire_at)->format('Y-m-d') }}</td>
                                                        <td>{{ floor($daysAgo) }} يوم</td>
                                                        <td>
                                                            <button class="btn btn-sm btn-warning"
                                                                data-toggle="modal"
                                                                data-target="#editTafwedExpiredModal_{{ $docId }}">
                                                                تعديل
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- مودالات تعديل التاريخ لكل عنصر تفويض منتهي --}}
                            @foreach($tafwed_expired as $doc)
 @php
        $docId = $doc->id ?? null;
        $tafweedDocuments = \App\Models\CarDocument::where('car_id', $docId)
                                ->where('type', 'tafwed_expire_at')
                                ->get();
    @endphp                            <div class="modal fade" id="editTafwedExpiredModal_{{ $docId }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form method="POST" action="{{ route('car.update_expiry') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $docId }}">
                                        <input type="hidden" name="field" value="tafwed_expire_at">

                                        <div class="modal-content bg-dark text-white">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-white">تعديل تاريخ انتهاء </h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>تاريخ الانتهاء الجديد</label>
                                                    <input type="date" name="expire_at" class="form-control"
                                                        value="{{ \Carbon\Carbon::parse($doc->tafwed_expire_at)->format('Y-m-d') }}" required>
                                                </div>
                                                 <div class="form-group">
                            <label>إرفاق ملفات جديدة (PDF أو صور)</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple  required>
                        </div>

                        <div class="form-group">
                            <h6>المرفقات السابقة:</h6>
                            <ul>
                                @forelse($tafweedDocuments as $file)
                                    <li>
                                        <a href="{{ asset('storage/' . $file->file_path) }}" target="_blank">
                                            {{ \Illuminate\Support\Str::afterLast($file->file_path, '/') }}
                                        </a>
                                    </li>
                                @empty
                                    <li>لا يوجد مرفقات.</li>
                                @endforelse
                            </ul>
                        </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                <button type="submit" class="btn btn-success">حفظ</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- المخالفات --}}
    <div class="col-12 mb-4">
        <div class="card shadow-lg rounded-3 border-0" style="background-color: #1e1e2f; color: white;">
            <div class="card-header text-white">
                <h5 class="mb-0 fw-bold text-white">
                    <i class="fa fa-exclamation-triangle me-2"></i> المخالفات
                </h5>
            </div>

            <div class="card-body py-4">
                <div class="row text-center">
                    {{-- هيئة النقل --}}
                    <div class="col-md-4 border-end border-secondary">
                        <h6 class="fw-bold mb-3 text-white">
                            <i class="fa fa-bus me-2"></i> هيئة النقل
                        </h6>
                        <div class="d-flex flex-column gap-2">
                            <!-- <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark">
                                <span>عدد المخالفات</span>
                                <span>0</span>
                            </div>
                            </br> -->

                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark">
                                <span>إجمالي المبلغ</span>
                                <span> {{ $sndNaqlAmount }} ريال</span>
                            </div>
                        </div>
                    </div>

                    {{-- المخالفات المرورية --}}
                    <div class="col-md-4 border-end border-secondary">
                        <h6 class="fw-bold mb-3 text-white">
                            <i class="fa fa-exclamation-triangle me-2"></i> المخالفات المرورية
                        </h6>
                        <div class="d-flex flex-column gap-2">
                            <!-- <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark">
                                <span>عدد المخالفات</span>
                                <span>0</span>
                            </div>
                            </br> -->

                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark">
                                <span>إجمالي المبلغ</span>
                                <span>{{$sndMorurAmount}} ريال</span>
                            </div>
                        </div>
                    </div>

                    {{-- مخالفات المواقف --}}
                    <div class="col-md-4">
                        <h6 class="fw-bold mb-3 text-white">
                            <i class="fa fa-car me-2"></i> مخالفات المواقف
                        </h6>
                        <div class="d-flex flex-column gap-2">
                            <!-- <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark">
                                <span>عدد المخالفات</span>
                                <span>0</span>
                            </div>
                            </br> -->
                            <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark">
                                <span>إجمالي المبلغ</span>
                                <span> {{ $sndMoaqefAmount}} ريال</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <!-- 1 -->
<div class="modal fade" id="sareyahModal" tabindex="-1" role="dialog" aria-labelledby="sareyahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document"> <!-- خليه واسع -->
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title text-white">هويات مقيم سارية</h5>
            </div>
            <div class="modal-body">
                @if($moqem_sareyah->isEmpty())
                <p class="text-center text-white">لا توجد بيانات</p>
                @else
                <table class="table table-dark table-striped table-bordered text-white mb-0">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>تاريخ الانتهاء</th>
                            <th>باقي أيام</th>
                            <th>تحديث</th>
                            <th>نماذج</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($moqem_sareyah as $emp)
                        @php
                        $remainingDays = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($emp->moqem_expire_at), false);
                        $empId = $emp->id;
                        @endphp
                        <tr>
                            <td>{{ $emp->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($emp->moqem_expire_at)->format('Y-m-d') }}</td>
                            <td>{{ floor($remainingDays) }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning text-dark"
                                    data-toggle="modal"
                                    data-target="#editExpireModalSareyah_{{ $empId }}">
                                    تحديث
                                </button>
                            </td>
                            <td>
                                <a href="{{ route('showAllPrints', $emp->id) }}" class="btn btn-success btn-sm">
                                    نماذج
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>

<!-- مودالات تعديل التاريخ الخاصة بالسارية -->
@foreach($moqem_sareyah as $emp)
@php $empId = $emp->id; 
// جلب مرفقات الإقامة مباشرة من قاعدة البيانات باستخدام ID الموظف
        $moqemDocuments = \App\Models\EmployeeDocument::where('employee_id', $emp->id)
                            ->where('type', 'moqem')
                            ->get();
@endphp
<div class="modal fade" id="editExpireModalSareyah_{{ $empId }}" tabindex="-1" role="dialog" aria-labelledby="editExpireModalSareyahLabel_{{ $empId }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" action="{{ route('moqem.update_expiry') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $empId }}">
            <input type="hidden" name="type" value="moqem"> <!-- لتحديد نوع التحديث -->
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title text-white">تعديل تاريخ انتهاء الهوية</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>تاريخ الانتهاء الجديد</label>
                        <input type="date" name="expire_at" class="form-control"
                            value="{{ \Carbon\Carbon::parse($emp->moqem_expire_at)->format('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label>إرفاق ملفات </label>
                        <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple  required>
                    </div>
             
 <h5 style="color:white;">مرفقات الإقامة (moqem):</h5>
                        <ul>
                            @forelse ($moqemDocuments as $doc)
                                <li>
                                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" rel="noopener">
                                        {{ \Illuminate\Support\Str::afterLast($doc->file_path, '/') }}
                                    </a>
                                </li>
                            @empty
                                <p>لا يوجد مرفقات للإقامة.</p>
                            @endforelse
                        </ul>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-success">حفظ التعديل</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endforeach
 


    <!-- مودال الهويات القريبة من الانتهاء -->
    <div class="modal fade" id="nearExpiryModal" tabindex="-1" role="dialog" aria-labelledby="nearExpiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document"> <!-- خليه واسع -->
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title text-white">هويات مقيم قريبة من الانتهاء</h5>
                </div>
                <div class="modal-body">
                    @if($moqem_near_expiry->isEmpty())
                    <p class="text-center text-white">لا توجد بيانات</p>
                    @else
                    <table class="table table-dark table-striped table-bordered text-white mb-0">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>تاريخ الانتهاء</th>
                                <th>باقي أيام</th>
                                <th>تحديث</th>
                                <th>نماذج</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($moqem_near_expiry as $emp)
                            @php
                            $remainingDays = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($emp->moqem_expire_at), false);
                            $empId = $emp->id;
                            @endphp
                            <tr>
                                <td>{{ $emp->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($emp->moqem_expire_at)->format('Y-m-d') }}</td>
                                <td>{{ floor($remainingDays) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning text-dark"
                                        data-toggle="modal"
                                        data-target="#editExpireModalNear_{{ $empId }}">
                                        تحديث
                                    </button>
                                </td>
                            <td>
                                <a href="{{ route('showAllPrints', $emp->id) }}" class="btn btn-success btn-sm">
                                    نماذج
                                </a>
                            </td>                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <!-- مودالات تعديل التاريخ -->
    @foreach($moqem_near_expiry as $emp)
    @php $empId = $emp->id; 
    // جلب مرفقات الإقامة مباشرة من قاعدة البيانات باستخدام ID الموظف
        $moqemDocuments = \App\Models\EmployeeDocument::where('employee_id', $emp->id)
                            ->where('type', 'moqem')
                            ->get();
    @endphp
    <div class="modal fade" id="editExpireModalNear_{{ $empId }}" tabindex="-1" role="dialog" aria-labelledby="editExpireModalNearLabel_{{ $empId }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('moqem.update_expiry') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $empId }}">
                <input type="hidden" name="type" value="moqem"> <!-- لتحديد نوع التحديث -->
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title text-white">تعديل تاريخ انتهاء الهوية</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>تاريخ الانتهاء الجديد</label>
                            <input type="date" name="expire_at" class="form-control"
                                value="{{ \Carbon\Carbon::parse($emp->moqem_expire_at)->format('Y-m-d') }}" required>
                        </div>
                    <div class="form-group">
    <label>إرفاق ملفات </label>
    <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple  required>
</div>



 <h5 style="color:white;">مرفقات الإقامة (moqem):</h5>
                        <ul>
                            @forelse ($moqemDocuments as $doc)
                                <li>
                                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" rel="noopener">
                                        {{ \Illuminate\Support\Str::afterLast($doc->file_path, '/') }}
                                    </a>
                                </li>
                            @empty
                                <p>لا يوجد مرفقات للإقامة.</p>
                            @endforelse
                        </ul>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">حفظ التعديل</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach



    <!-- مودال الوثائق المنتهية -->
    <!-- مودال الوثائق المنتهية -->
    <div class="modal fade" id="expiredModal" tabindex="-1" role="dialog" aria-labelledby="expiredModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title text-white">هويات المقيمين المنتهية</h5>
                </div>
                <div class="modal-body">
                    @if($moqem_expired->isEmpty())
                    <p class="text-center text-white">لا توجد بيانات</p>
                    @else
                    <table class="table table-dark table-striped table-bordered text-white mb-0">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>تاريخ الانتهاء</th>
                                <th>انتهت منذ (أيام)</th>
                                <th>تحديث</th>
                                <th>نماذج</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($moqem_expired as $doc)
                            @php
                            $expiredDays = \Carbon\Carbon::parse($doc->moqem_expire_at)->diffInDays(\Carbon\Carbon::now(), false);
                            $docId = $doc->id ?? null;
                            @endphp
                            <tr>
                                <td>{{ $doc->name ?? 'بدون اسم' }}</td>
                                <td>{{ \Carbon\Carbon::parse($doc->moqem_expire_at)->format('Y-m-d') }}</td>
                                <td>{{ floor($expiredDays) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning text-dark"
                                        data-toggle="modal"
                                        data-target="#editExpiredModal_{{ $docId }}">
                                        تحديث
                                    </button>
                                </td>
                            <td>
                                <a href="{{ route('showAllPrints', $doc->id) }}" class="btn btn-success btn-sm">
                                    نماذج
                                </a>
                            </td>                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <!-- مودالات تعديل التاريخ -->
@foreach($moqem_expired as $doc)
    @php 
    $docId = $doc->id;
    
    // Condition HATA DEIN - direct query chalegi
    $moqemDocuments = \App\Models\EmployeeDocument::where('employee_id', $docId)
                        ->where('type', 'moqem')
                        ->get(); 
    @endphp
    
    <div class="modal fade" id="editExpiredModal_{{ $docId }}" tabindex="-1" role="dialog" aria-labelledby="editExpiredModalLabel_{{ $docId }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('moqem.update_expiry') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $docId }}">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title text-white">تعديل تاريخ الانتهاء</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>تاريخ الانتهاء الجديد</label>
                            <input type="date" name="expire_at" class="form-control"
                                value="{{ \Carbon\Carbon::parse($doc->moqem_expire_at)->format('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label>إرفاق ملفات</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <h5 style="color:white;">مرفقات الإقامة (moqem):</h5>
                        <ul>
                            @forelse ($moqemDocuments as $moqemDoc)
                                <li>
                                    <a href="{{ asset('storage/' . $moqemDoc->file_path) }}" target="_blank" rel="noopener">
                                        {{ \Illuminate\Support\Str::afterLast($moqemDoc->file_path, '/') }}
                                    </a>
                                </li>
                            @empty
                                <p>لا يوجد مرفقات للإقامة.</p>
                            @endforelse
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">حفظ التعديل</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endforeach



    <!--  1/  -->


    <!-- 2 -->
    <!-- مودال المخالصة المالية السارية -->
    <!-- مودال عرض المخالصة المالية السارية -->
    <div class="modal fade" id="mokhalasaSareyahModal" tabindex="-1" role="dialog" aria-labelledby="mokhalasaSareyahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title text-white">المخالصة المالية السارية</h5>
                </div>
                <div class="modal-body">
                    @if($mokhalasa_sareyah->isEmpty())
                    <p class="text-center text-white">لا توجد بيانات</p>
                    @else
                    <table class="table table-dark table-striped table-bordered text-white mb-0">
                        <thead>
                            <tr>
                                <th>اسم الموظف</th>
                                <th>تاريخ الانتهاء</th>
                                <th>باقي أيام</th>
                                <th>تعديل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mokhalasa_sareyah as $item)
                            @php
                            $remainingDays = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($item->mokhalsa_expire_at), false);
                            @endphp
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->mokhalsa_expire_at)->format('Y-m-d') }}</td>
                                <td>{{ floor($remainingDays) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning text-dark"
                                        data-toggle="modal"
                                        data-target="#editMokhalasaSareyahModal_{{ $item->id }}">
                                        تعديل
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <!-- مودالات تعديل تواريخ انتهاء المخالصات -->
    @foreach($mokhalasa_sareyah as $item)
    @php $itemId = $item->id; 
     $mokhalsaDocuments = \App\Models\EmployeeDocument::where('employee_id', $item->id)
                                ->where('type', 'mokhalsa')
                                ->get(); 
    
    @endphp
    <div class="modal fade" id="editMokhalasaSareyahModal_{{ $itemId }}" tabindex="-1" role="dialog" aria-labelledby="editMokhalasaSareyahModalLabel_{{ $itemId }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('employees.update_mokhalsa_expiry') }}"  enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $itemId }}">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title text-white">تعديل تاريخ انتهاء المخالصة</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>تاريخ الانتهاء الجديد</label>
                            <input type="date" name="expire_at" class="form-control"
                                value="{{ \Carbon\Carbon::parse($item->mokhalsa_expire_at)->format('Y-m-d') }}" required>
                        </div>
                         <div class="form-group">
                            <label>إرفاق ملفات</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <h5 style="color:white;">مرفقات المخالصة:</h5>
                        <ul>
                            @forelse ($mokhalsaDocuments as $docFile)
                                <li>
                                    <a href="{{ asset('storage/' . $docFile->file_path) }}" target="_blank" rel="noopener">
                                        {{ \Illuminate\Support\Str::afterLast($docFile->file_path, '/') }}
                                    </a>
                                </li>
                            @empty
                                <p>لا يوجد مرفقات للمخالصة.</p>
                            @endforelse
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">حفظ التعديل</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach


    <!-- مودال المخالصة المالية القريبة من الانتهاء -->
    <div class="modal fade" id="mokhalasaNearExpiryModal" tabindex="-1" role="dialog" aria-labelledby="mokhalasaNearExpiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title text-white">المخالصة المالية القريبة من الانتهاء</h5>
                </div>
                <div class="modal-body">
                    @if($mokhalasa_near_expiry->isEmpty())
                    <p class="text-center text-white">لا توجد بيانات</p>
                    @else
                    <table class="table table-dark table-striped table-bordered text-white mb-0">
                        <thead>
                            <tr>
                                <th>اسم الموظف</th>
                                <th>تاريخ الانتهاء</th>
                                <th>باقي أيام</th>
                                <th>تعديل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mokhalasa_near_expiry as $item)
                            @php
                            $remainingDays = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($item->mokhalsa_expire_at), false);
                            @endphp
                            <tr>
                                <td>{{ $item->name ?? 'بدون اسم' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->mokhalsa_expire_at)->format('Y-m-d') }}</td>
                                <td>{{ floor($remainingDays) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning text-dark"
                                        data-toggle="modal"
                                        data-target="#editMokhalasaNearModal_{{ $item->id }}">
                                        تعديل
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <!-- مودالات تعديل تواريخ انتهاء المخالصات القريبة -->
    @foreach($mokhalasa_near_expiry as $item)
    @php $itemId = $item->id ?? null;
     $mokhalsaDocuments = \App\Models\EmployeeDocument::where('employee_id', $item->id)
                                ->where('type', 'mokhalsa')
                                ->get(); 
    
    
    
    @endphp
    <div class="modal fade" id="editMokhalasaNearModal_{{ $itemId }}" tabindex="-1" role="dialog" aria-labelledby="editMokhalasaNearExpiryModalLabel_{{ $itemId }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('employees.update_mokhalsa_expiry') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $itemId }}">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title text-white">تعديل تاريخ انتهاء المخالصة</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>تاريخ الانتهاء الجديد</label>
                            <input type="date" name="expire_at" class="form-control"
                                value="{{ \Carbon\Carbon::parse($item->mokhalsa_expire_at)->format('Y-m-d') }}" required>
                        </div>


                         <div class="form-group">
                            <label>إرفاق ملفات</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <h5 style="color:white;">مرفقات المخالصة:</h5>
                        <ul>
                            @forelse ($mokhalsaDocuments as $docFile)
                                <li>
                                    <a href="{{ asset('storage/' . $docFile->file_path) }}" target="_blank" rel="noopener">
                                        {{ \Illuminate\Support\Str::afterLast($docFile->file_path, '/') }}
                                    </a>
                                </li>
                            @empty
                                <p>لا يوجد مرفقات للمخالصة.</p>
                            @endforelse
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">حفظ التعديل</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach


    <!-- مودال المخالصة المالية المنتهية -->
    <div class="modal fade" id="mokhalasaExpiredModal" tabindex="-1" role="dialog" aria-labelledby="mokhalasaExpiredModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title text-white">المخالصة المالية المنتهية</h5>
                </div>
                <div class="modal-body">
                    @if($mokhalasa_expired->isEmpty())
                    <p class="text-center text-white">لا توجد بيانات</p>
                    @else
                    <table class="table table-dark table-striped table-bordered text-white mb-0">
                        <thead>
                            <tr>
                                <th>اسم الموظف</th>
                                <th>تاريخ الانتهاء</th>
                                <th>انتهت منذ (أيام)</th>
                                <th>تعديل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mokhalasa_expired as $item)
                            @php
                            $expiredDays = floor(\Carbon\Carbon::parse($item->mokhalsa_expire_at)->diffInDays(\Carbon\Carbon::now(), false));
                            @endphp
                            <tr>
                                <td>{{ $item->name ?? 'بدون اسم' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->mokhalsa_expire_at)->format('Y-m-d') }}</td>
                                <td>{{ $expiredDays }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning text-dark"
                                        data-toggle="modal"
                                        data-target="#editMokhalasaExpiredModal_{{ $item->id }}">
                                        تعديل
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>

    @foreach($mokhalasa_expired as $item)
    @php $itemId = $item->id ?? null; 
     $mokhalsaDocuments = \App\Models\EmployeeDocument::where('employee_id', $item->id)
                                ->where('type', 'mokhalsa')
                                ->get(); 
    
    
    
    @endphp
    <div class="modal fade" id="editMokhalasaExpiredModal_{{ $itemId }}" tabindex="-1" role="dialog" aria-labelledby="editMokhalasaExpiredModalLabel_{{ $itemId }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('employees.update_mokhalsa_expiry') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $itemId }}">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title text-white">تعديل تاريخ انتهاء المخالصة المنتهية</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>تاريخ الانتهاء الجديد</label>
                            <input type="date" name="expire_at" class="form-control"
                                value="{{ \Carbon\Carbon::parse($item->mokhalsa_expire_at)->format('Y-m-d') }}" required>
                        </div>


                         <div class="form-group">
                            <label>إرفاق ملفات</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <h5 style="color:white;">مرفقات المخالصة:</h5>
                        <ul>
                            @forelse ($mokhalsaDocuments as $docFile)
                                <li>
                                    <a href="{{ asset('storage/' . $docFile->file_path) }}" target="_blank" rel="noopener">
                                        {{ \Illuminate\Support\Str::afterLast($docFile->file_path, '/') }}
                                    </a>
                                </li>
                            @empty
                                <p>لا يوجد مرفقات للمخالصة.</p>
                            @endforelse
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">حفظ التعديل</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach




    <!-- 2/ -->


    <!-- 3 -->
    <!-- مودال بطاقات السائقين السارية -->
    <div class="modal fade" id="saiqCardSareyahModal" tabindex="-1" role="dialog" aria-labelledby="saiqCardSareyahModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title text-white">بطاقات السائقين السارية</h5>
                </div>
                <div class="modal-body">
                    @if($saiq_card_sareyah->isEmpty())
                    <p class="text-center text-white">لا توجد بيانات</p>
                    @else
                    <table class="table table-dark table-striped table-bordered text-white mb-0">
                        <thead>
                            <tr>
                                <th>اسم الموظف</th>
                                <th>تاريخ الانتهاء</th>
                                <th>باقي أيام</th>
                                <th>تعديل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($saiq_card_sareyah as $item)
                            @php
                            $remainingDays = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($item->cart_expire_at), false);
                            @endphp
                            <tr>
                                <td>{{ $item->name ?? 'بدون اسم' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->cart_expire_at)->format('Y-m-d') }}</td>
                                <td>{{ floor($remainingDays) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning text-dark"
                                        data-toggle="modal"
                                        data-target="#editSaiqCardSareyahModal_{{ $item->id }}">
                                        تعديل
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>
    @foreach($saiq_card_sareyah as $item)
    @php 
        $itemId = $item->id; 
        $cardDocuments = \App\Models\EmployeeDocument::where('employee_id', $item->id)
    ->where('type', 'card')
    ->get();
    @endphp

    <div class="modal fade" id="editSaiqCardSareyahModal_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editSaiqCardSareyahModalLabel_{{ $itemId }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('employees.update_card_expiry') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id }}">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title text-white">تعديل تاريخ انتهاء الكارت</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>تاريخ الانتهاء الجديد</label>
                            <input type="date" name="expire_at" class="form-control"
                                value="{{ \Carbon\Carbon::parse($item->cart_expire_at)->format('Y-m-d') }}" required>
                        </div>

                        <div class="form-group">
                            <label>إرفاق ملفات</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <h5 style="color:white;">مرفقات الكارت:</h5>
                        <ul>
                      @forelse ($cardDocuments as $docFile)
    <li>
        <a href="{{ asset('storage/' . $docFile->file_path) }}" target="_blank" rel="noopener">
            {{ \Illuminate\Support\Str::afterLast($docFile->file_path, '/') }}
        </a>
    </li>
@empty
    <p>لا يوجد مرفقات للكارت.</p>
@endforelse

                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">حفظ التعديل</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endforeach



    <!-- مودال بطاقات السائقين قريبة الانتهاء -->
    <div class="modal fade" id="saiqCardNearExpiryModal" tabindex="-1" role="dialog" aria-labelledby="saiqCardNearExpiryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title text-white">بطاقات السائقين القريبة من الانتهاء</h5>
                </div>
                <div class="modal-body">
                    @if($saiq_card_near_expiry->isEmpty())
                    <p class="text-center text-white">لا توجد بيانات</p>
                    @else
                    <table class="table table-dark table-striped table-bordered text-white mb-0">
                        <thead>
                            <tr>
                                <th>اسم الموظف</th>
                                <th>تاريخ الانتهاء</th>
                                <th>باقي أيام</th>
                                <th>تعديل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($saiq_card_near_expiry as $item)
                            @php
                            $remainingDays = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($item->cart_expire_at), false);
                            @endphp
                            <tr>
                                <td>{{ $item->name ?? 'بدون اسم' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->cart_expire_at)->format('Y-m-d') }}</td>
                                <td>{{ floor($remainingDays) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning text-dark"
                                        data-toggle="modal"
                                        data-target="#editSaiqCardNearExpiryModal_{{ $item->id }}">
                                        تعديل
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>
    @foreach($saiq_card_near_expiry as $item)
    @php $cardId = $item->id; 
        // جلب مرفقات الكارت الخاصة بالموظف ونوع 'card'
        $cardDocuments = \App\Models\EmployeeDocument::where('employee_id', $item->id )
                            ->where('type', 'card')
                            ->get();
    
    @endphp
    <div class="modal fade" id="editSaiqCardNearExpiryModal_{{ $item->id  }}" tabindex="-1" role="dialog" aria-labelledby="editSaiqCardNearExpiryModalLabel_{{ $cardId }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('employees.update_card_expiry') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id  }}">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title text-white">تعديل تاريخ الانتهاء</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>تاريخ الانتهاء الجديد</label>
                            <input type="date" name="expire_at" class="form-control"
                                value="{{ \Carbon\Carbon::parse($item->cart_expire_at)->format('Y-m-d') }}" required>
                        </div>


                         <div class="form-group">
                            <label>إرفاق ملفات</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <h5 style="color:white;">مرفقات الكارت:</h5>
                        <ul>
                            @forelse ($cardDocuments as $docFile)
                                <li>
                                    <a href="{{ asset('storage/' . $docFile->file_path) }}" target="_blank" rel="noopener">
                                        {{ \Illuminate\Support\Str::afterLast($docFile->file_path, '/') }}
                                    </a>
                                </li>
                            @empty
                                <p>لا يوجد مرفقات للكارت.</p>
                            @endforelse
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">حفظ التعديل</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach


    <!-- مودال بطاقات السائقين المنتهية -->
    <!-- مودال عرض بطاقات السائقين المنتهية -->
    <div class="modal fade" id="saiqCardExpiredModal" tabindex="-1" role="dialog" aria-labelledby="saiqCardExpiredModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title text-white">بطاقات السائقين المنتهية</h5>
                </div>
                <div class="modal-body">
                    @if($saiq_card_expired->isEmpty())
                    <p class="text-center text-white">لا توجد بيانات</p>
                    @else
                    <table class="table table-dark table-striped table-bordered text-white mb-0">
                        <thead>
                            <tr>
                                <th>اسم الموظف</th>
                                <th>تاريخ الانتهاء</th>
                                <th>انتهت منذ (أيام)</th>
                                <th>تعديل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($saiq_card_expired as $item)
                            @php
                            $expiredDays = \Carbon\Carbon::parse($item->cart_expire_at)->diffInDays(\Carbon\Carbon::now(), false);
                            @endphp
                            <tr>
                                <td>{{ $item->name ?? 'بدون اسم' }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->cart_expire_at)->format('Y-m-d') }}</td>
                                <td>{{ floor($expiredDays) }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning text-dark"
                                        data-toggle="modal"
                                        data-target="#editSaiqCardSareyahModal_{{ $item->id }}">
                                        تعديل
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <!-- مودالات تعديل تواريخ بطاقات السائقين المنتهية -->
    @foreach($saiq_card_expired as $item)
    @php $cardId = $item->id; 
        // جلب مرفقات الكارت الخاصة بالموظف ونوع 'card'
        $cardDocuments = \App\Models\EmployeeDocument::where('employee_id', $cardId)
                            ->where('type', 'card')
                            ->get();
    
    @endphp
    <div class="modal fade" id="editSaiqCardSareyahModal_{{ $item->id  }}" tabindex="-1" role="dialog" aria-labelledby="editSaiqCardSareyahModalLabel_{{ $cardId }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="{{ route('employees.update_card_expiry') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $item->id  }}">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title text-white">تعديل تاريخ الانتهاء</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>تاريخ الانتهاء الجديد</label>
                            <input type="date" name="expire_at" class="form-control"
                                value="{{ \Carbon\Carbon::parse($item->cart_expire_at)->format('Y-m-d') }}" required>
                        </div>
                         <div class="form-group">
                            <label>إرفاق ملفات</label>
                            <input type="file" name="files[]" class="form-control" accept=".pdf,image/*" multiple required>
                        </div>

                        <h5 style="color:white;">مرفقات الكارت:</h5>
                        <ul>
                            @forelse ($cardDocuments as $docFile)
                                <li>
                                    <a href="{{ asset('storage/' . $docFile->file_path) }}" target="_blank" rel="noopener">
                                        {{ \Illuminate\Support\Str::afterLast($docFile->file_path, '/') }}
                                    </a>
                                </li>
                            @empty
                                <p>لا يوجد مرفقات للكارت.</p>
                            @endforelse
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-success">حفظ التعديل</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endforeach


    <!-- 3/ -->
    <!-- موديل -->








    @elseif (session('company_type') == 'transport')
    @include('transportDashboard')

    @elseif (session('company_type') == 'restaurantAlawaly')
    @include('restaurantAlawaly')

    @endif
</div>

<!-- <script>
    $('#editExpireModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var docId = button.data('id');
        var docName = button.data('name');
        var expireAt = button.data('expire');

        var modal = $(this);
        modal.find('#docId').val(docId);
        modal.find('#docName').val(docName);
        modal.find('#expireAt').val(expireAt);
    });
</script> -->

<!-- row closed -->
@endsection

@section('js')

@endsection
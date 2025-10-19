@extends('layouts.master')

@section('title', 'قائمة الركاب')

@section('content')


<style>
    .passenger-card {
        background: rgb(160, 187, 213);
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .passenger-info {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
    }

    .label {
        font-weight: bold;
        color: #343a40;
    }

    .value {
        color: #6c757d;
    }
</style>
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> كشف الركاب</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0 text-center">
                        <thead>
                            <tr>
                                <th>السائق </th>
                                <th>الشركة </th>
                                <th>السيارة </th>

                                <th>من </th>
                                <th>الي</th>
                                <th>تاريخ الرحلة </th>
                                <th> الركاب</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($passengers as $passenger)
                            <tr>
                                <td>{{ optional($passenger->appUser)->name ?? 'غير متوفر' }}</td>
                                <td>{{ optional(optional($passenger->appUser)->company)->company_name ?? 'غير متوفر' }}</td>
                                <td>
                                    {{ optional(optional($passenger->appUser)->vehicle)->car_type ?? 'غير متوفر' }} -
                                    {{ optional(optional($passenger->appUser)->vehicle)->car_model ?? 'غير متوفر' }} -
                                    {{ optional(optional($passenger->appUser)->vehicle)->licence_plate_number ?? 'غير متوفر' }}
                                </td>
                                <td>{{ $passenger->from ?? 'غير متوفر' }}</td>
                                <td>{{ $passenger->to ?? 'غير متوفر' }}</td>
                                <td>{{ \Carbon\Carbon::parse($passenger->created_at)->setTimezone('Asia/Riyadh')->format('Y-m-d h:i A') }}</td>
                                </td>
                                <td>
                                    <!-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#show{{ $passenger->id }}">
                                        عرض التفاصيل
                                    </button> -->

                                    <a class="btn btn-primary btn-sm" href="{{route('showPassengersDetails',$passenger->id)}}">
                                        عرض التفاصيل
                                    </a>

                                </td>
                            </tr>

                            <!-- مودال عرض تفاصيل الراكب -->
                            <div class="modal fade" id="show{{ $passenger->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">تفاصيل الركاب</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @foreach($passenger->list as $passengerItem)
                                            <div class="passenger-card">
                                                <div class="passenger-info">
                                                    <span class="label">الاسم:</span> <span class="value">{{ $passengerItem->name ?? 'غير متوفر' }}</span>
                                                </div>
                                                <div class="passenger-info">
                                                    <span class="label">رقم الهوية:</span> <span class="value">{{ $passengerItem->id_number ?? 'غير متوفر' }}</span>
                                                </div>
                                                <div class="passenger-info">
                                                    <span class="label">الجنس:</span> <span class="value">{{ $passengerItem->Gender ?? 'غير متوفر' }}</span>
                                                </div>
                                                <div class="passenger-info">
                                                    <span class="label">رقم الهاتف:</span> <span class="value">{{ $passengerItem->Phone_number ?? 'غير متوفر' }}</span>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>



                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
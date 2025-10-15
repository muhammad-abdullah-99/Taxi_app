@extends('layouts.master')

@section('title', 'إدارة التسليم والاعادة')

@section('content')
<div class="container mt-5">
    <h2 class="text-center"> إدارة الاستلام والاعادة للسيارة {{$car->name}} - {{$car->type}}</h2>

    <!-- عرض الأخطاء -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- زر لإضافة عملية تسليم جديدة -->
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addHandoverModal">
        <i class="fa fa-plus"></i> إضافة عملية جديدة
    </button>
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- جدول عرض العمليات -->
                        <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                            <thead>
                                <tr>
                                    <th>اسم الموظف</th>
                                    <th>السيارة</th>
                                    <th>تاريخ الاستلام</th>
                                    <th>قراءة العداد عند الاستلام</th>
                                    <th>تاريخ الاعادة</th>
                                    <th>قراءة العداد عند الاعادة</th>
                                    <th>عدد الكم </th>
                                    <th>عدد الايام </th>
                                    <th>الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($handoverRecords as $record)
                                <tr>
                                    <td>{{ $record->employee->name }}</td>
                                    <td>{{ $record->car->name }} - {{ $record->car->plate_number }}</td>
                                    <td>{{ $record->handover_date }}</td>
                                    <td>{{ $record->initial_meter_reading }}</td>
                                    <td>{{ $record->return_date ?? 'لم يتم الاعادة  بعد' }}</td>
                                    <td>{{ $record->final_meter_reading ?? '---' }}</td>
                                    <td>
                                        @if ($record->return_date && $record->final_meter_reading)
                                        {{ number_format($record->final_meter_reading - $record->initial_meter_reading, 1) }}
                                        @else
                                        —
                                        @endif
                                    </td>

                                    <td>
                                        @if ($record->return_date)
                                        {{ (strtotime($record->return_date) - strtotime($record->handover_date)) / (60 * 60 * 24) }}
                                        @else
                                        —
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#editBasic{{ $record->id }}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-warning btn-lm" data-toggle="modal" data-target="#editHandover{{ $record->id }}">
                                            اعادة
                                        </button>

                                        <a href="{{ route('carMaintenance', ['car' => $record->car->id, 'employee' => $record->employee->id]) }}" class="btn btn-secondary btn-lm">
                                            صيانة
                                        </a>

                                        <!-- //// -->


                                        @php
                                        $hasMonthlySnd = \App\Models\Snd::where('type', 'تحويل داخلي')
                                        ->where('employee_id', $record->employee_id)
                                        ->where('car_id', $record->car_id)
                                        ->where('description', 'استحقاق سيارة')
                                        ->whereMonth('date', now()->month)
                                        ->whereYear('date', now()->year)
                                        ->exists();

                                        $hasReturnDate = !is_null($record->return_date);
                                        @endphp

                                        @if (!$hasMonthlySnd && !$hasReturnDate && \Carbon\Carbon::parse($record->handover_date)->month <= now()->month)
                                            <form action="{{ route('createCarMonthlySnd', ['handover_id' => $record->id]) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                <button class="btn btn-success btn-sm">سند شهري</button>
                                            </form>
                                            @endif



                                            <!-- //// -->



                                            <div class="modal fade" id="editHandover{{ $record->id }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">تحديث بيانات والاعادة والتسلم</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('updateHandover',$record->id)}}" method="POST">
                                                                @csrf
                                                                <label>تاريخ الاعادة</label>
                                                                <input type="date" name="return_date" class="form-control" value="{{ $record->return_date }}">
                                                                <br>
                                                                <label>قراءة العداد عند الاعادة </label>
                                                                <input type="number" name="final_meter_reading" class="form-control" value="{{ $record->final_meter_reading }}" step="0.1">
                                                                <br>
                                                                <button type="submit" class="btn btn-primary">تحديث</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ////edit  -->
                                            <div class="modal fade" id="editBasic{{ $record->id }}" tabindex="-1" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">تعديل البيانات الأساسية</h5>
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                <span>&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('editBasic', $record->id)}}" method="POST">
                                                                @csrf
                                                                <label>الموظف</label>
                                                                <select name="employee_id" class="form-control">
                                                                    @foreach($employees as $employee)
                                                                    <option value="{{ $employee->id }}" {{ $record->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <br>
                                                                <label>تاريخ الاستلام</label>
                                                                <input type="date" name="handover_date" class="form-control" value="{{ $record->handover_date }}" required>
                                                                <br>
                                                                <label>قراءة العداد عند الاستلام</label>
                                                                <input type="number" name="initial_meter_reading" class="form-control" value="{{ $record->initial_meter_reading }}" step="0.1" required>
                                                                <br>
                                                                <button type="submit" class="btn btn-primary">تحديث</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </td>


                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- نافذة إضافة عملية تسليم -->
    <div class="modal fade" id="addHandoverModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة عملية جديدة</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('storeHandover')}}" method="POST">
                        @csrf
                        <label>الموظف</label>
                        <select name="employee_id" class="form-control">
                            @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                        <br>
                        <input type="text" name="car_id" class="form-control" value="{{$car->id}}" hidden>

                        <br>
                        <label>تاريخ الاستلام</label>
                        <input type="date" name="handover_date" class="form-control" required>
                        <br>
                        <label>قراءة العداد عند الاستلام</label>
                        <input type="number" name="initial_meter_reading" class="form-control" step="0.1" required>
                        <br>
                        <button type="submit" class="btn btn-primary">إضافة</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- نافذة تعديل عملية تسليم -->

    @endsection
@extends('layouts.master')

@section('title', 'كشف المتعثرين ')

@section('content')

<div class="container mt-5">
    <h3 class="text-center mb-4"> كشف الموظفين المتعثرين </h3>

    <style>
        /* خلفية داكنة للفورم */
        form.dark-mode-form {
            background-color: #121212;
            padding: 20px;
            border-radius: 8px;
            color: #eee;
        }

        /* تعديل السيليكت */
        form.dark-mode-form select.form-control {
            background-color: #1e1e1e;
            color: #eee;
            border: 1px solid #444;
            transition: border-color 0.3s;
        }

        form.dark-mode-form select.form-control:focus {
            background-color: #292929;
            color: #fff;
            border-color: #007bff;
            box-shadow: 0 0 5px #007bff;
            outline: none;
        }

        /* تعديل الزر */
        form.dark-mode-form button.btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        form.dark-mode-form button.btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>

    <form method="GET" class="mb-4 dark-mode-form">
        <div class="row justify-content-center">
            <div class="col-md-4 mb-3 mb-md-0">
                <select name="month" class="form-control p-2">
                    <option value="">اختر الشهر</option>
                    @foreach(range(1, 12) as $m)
                    <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                        {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
                <select name="year" class="form-control p-2">
                    <option value="">اختر السنة</option>
                    @for ($y = date('Y'); $y >= 2017; $y--)
                    <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">بحث</button>
            </div>
        </div>
    </form>


    @php
    $defaulters = $employees->filter(function($employee) {
    $total_debit = $employee->snd
    ->filter(function($q) {
    return $q->type === 'صرف' ||
    ($q->type === 'تحويل داخلي' && in_array($q->client_type, ['سيارة', 'جهة']));
    })
    ->sum('amount');

    $total_credit = $employee->snd
    ->filter(function($q) {
    return $q->type === 'قبض' ||
    ($q->type === 'تحويل داخلي' && $q->client_type === 'موظف');
    })
    ->sum('amount');

    $balance = $total_credit - $total_debit;

    return $balance < 0;
        });

        $total_defaulters=$defaulters->count();
        $total_deficit_amount = $defaulters->sum(function($employee) {
        $total_debit = $employee->snd
        ->filter(function($q) {
        return $q->type === 'صرف' ||
        ($q->type === 'تحويل داخلي' && in_array($q->client_type, ['سيارة', 'جهة']));
        })
        ->sum('amount');

        $total_credit = $employee->snd
        ->filter(function($q) {
        return $q->type === 'قبض' ||
        ($q->type === 'تحويل داخلي' && $q->client_type === 'موظف');
        })
        ->sum('amount');

        $balance = $total_credit - $total_debit;

        return abs($balance); // القيمة الموجبة للمجموع
        });
        @endphp

        @if($defaulters->isEmpty())
        <div class="alert alert-success text-center">
            لا يوجد موظفين متعثرين.
        </div>
        @else
        <style>
            .custom-large {
                font-size: 1.2rem;
                /* حجم خط كبير */
                font-weight: 700;
                /* عشان يبقى بولد */
            }

            .custom-medium {
                font-size: 1.4rem;
            }

            .divider {
                margin: 0 15px;
                color: #ffc107;
                /* لون أصفر فاتح للفاصل */
                font-weight: 700;
                user-select: none;
                /* منع التحديد */
            }
        </style>

        <div class="bg-dark text-white p-4 rounded shadow-sm mb-3 text-center d-flex justify-content-center align-items-center">
            <span class="custom-medium">عدد الموظفين المتعثرين:</span>
            <span class="custom-large text-warning mx-3">{{ $total_defaulters }}</span>
            <span class="divider"></span>
            <span class="custom-medium">إجمالي مبلغ التعثر:</span>
            <span class="custom-large text-danger mx-3"> - {{ number_format($total_deficit_amount, 2) }} ريال</span>
        </div>


        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>اسم الموظف</th>
                                        <th> التعثر </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $employee)
                                    @php
                                    $total_debit = $employee->snd
                                    ->filter(function($q) {
                                    return $q->type === 'صرف' ||
                                    ($q->type === 'تحويل داخلي' && in_array($q->client_type, ['سيارة', 'جهة']));
                                    })
                                    ->sum('amount');

                                    $total_credit = $employee->snd
                                    ->filter(function($q) {
                                    return $q->type === 'قبض' ||
                                    ($q->type === 'تحويل داخلي' && $q->client_type === 'موظف');
                                    })
                                    ->sum('amount');

                                    $balance = $total_credit - $total_debit;
                                    @endphp

                                    @if($balance < 0)
                                        <tr>
                                        <td>{{ $employee->name }}</td>
                                        <td style="color: red;">{{ number_format($balance, 2) }} ريال</td>
                                        </tr>
                                        @endif
                                        @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
</div>

@endsection
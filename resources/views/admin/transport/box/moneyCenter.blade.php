@extends('layouts.master')

@section('title', 'المركز المالي')

@section('content')

<div class="container py-5">

    {{-- عنوان رئيسي --}}
    <div class="text-center mb-5">
        <h2 class="display-4 fw-bold text-dark">📊 تقرير المركز المالي</h2>
        <hr class="w-25 mx-auto bg-warning" style="height: 4px; border-radius: 10px;">
    </div>

    @php
    $cards = [
    [
    'title' => 'إجمالي عمليات المحفظة من صرف وقبض',
    'qbd' => $totalQbd,
    'srf' => $totalSrf,
    'icon' => '💰'
    ],
    [
    'title' => 'المناديب',
    'qbd' => $totalQbdMandub,
    'srf' => $totalSrfMandub,
    'icon' => '🏦'
    ],

    ];
    @endphp

    <div class="row g-4">
        @foreach($cards as $card)
        <div class="col-md-12 mb-2">
            <div class="card border-0 shadow rounded-4 position-relative overflow-hidden"
                style="background: linear-gradient(to right, #11141c, #1c1f2b); color: #fff;">

                {{-- رمز في الزاوية --}}
                <div class="position-absolute top-0 end-0 p-3  opacity-10" style="font-size: x-large;">
                    {{ $card['icon'] }}
                </div>

                <div class="card-header bg-transparent text-center py-4 border-bottom border-secondary">
                    <h2 class="mb-0 text-white fw-bold fs-3">{{ $card['title'] }}</h2>
                </div>

                <div class="card-body row text-center fw-semibold py-4">

                    {{-- إجمالي القبض --}}
                    <div class="col-md-4 mb-3">
                        <div class="text-white-50 fs-5 mb-1">إجمالي القبض</div>
                        <div class="text-white fs-1 fw-bold">
                            {{ number_format($card['qbd'], 2) }}
                            <small class="fs-5">ريال</small>
                        </div>
                    </div>

                    {{-- إجمالي الصرف --}}
                    <div class="col-md-4 mb-3">
                        <div class="text-white-50 fs-5 mb-1">إجمالي الصرف</div>
                        <div class="text-white fs-1 fw-bold">
                            {{ number_format($card['srf'], 2) }}
                            <small class="fs-5">ريال</small>
                        </div>
                    </div>

                    {{-- الرصيد الحالي --}}
                    <div class="col-md-4">
                        <div class="text-white-50 fs-5 mb-1">الرصيد الحالي</div>
                        @php
                        $balance = $card['qbd'] - $card['srf'];
                        @endphp
                        <div class="fs-1 fw-bold {{ $balance >= 0 ? 'text-info' : 'text-warning' }}">
                            {{ number_format($balance, 2) }}
                            <small class="fs-5">ريال</small>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @endforeach
    </div>

</div>

@endsection
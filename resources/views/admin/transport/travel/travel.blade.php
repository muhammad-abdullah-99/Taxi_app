@extends('layouts.master')

@section('title', 'تفاصيل الرحلات')

@section('content')
<div class="page-title">
    <div class="row mb-3">
        <div class="col-sm-6">
            <h4 class="mb-0">تفاصيل الرحلات</h4>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col">
            <a href="{{ route('showAllTravels', ['status' => null]) }}" 
               class="btn btn-outline-primary {{ is_null($status) ? 'active' : '' }}">الكل</a>
            
            <a href="{{ route('showAllTravels', ['status' => 'انتظار']) }}" 
               class="btn btn-outline-warning {{ $status == 'انتظار' ? 'active' : '' }}">انتظار</a>
            
            <a href="{{ route('showAllTravels', ['status' => 'جارية']) }}" 
               class="btn btn-outline-info {{ $status == 'جارية' ? 'active' : '' }}">جارية</a>
            
            <a href="{{ route('showAllTravels', ['status' => 'مكتملة']) }}" 
               class="btn btn-outline-success {{ $status == 'مكتملة' ? 'active' : '' }}">مكتملة</a>
            
            <a href="{{ route('showAllTravels', ['status' => 'منتهية']) }}" 
               class="btn btn-outline-dark {{ $status == 'منتهية' ? 'active' : '' }}">منتهية</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>السائق</th>
                                <th>الراكب</th>
                                <th>من</th>
                                <th>إلى</th>
                                <th>التاريخ</th>
                                <th>الوقت</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($travels as $travel)
                            <tr>
                                <td>{{ $travel->id }}</td>
                                
                                {{-- ✅ Driver Column --}}
                                <td>
                                    @if($travel->appUser)
                                        <strong>{{ $travel->appUser->name }}</strong>
                                        @if($travel->appUser->phone)
                                            <br><small class="text-muted">{{ $travel->appUser->phone }}</small>
                                        @endif
                                    @else
                                        <span class="badge badge-secondary" style="font-size: 14px; padding: 8px 12px;">غير مخصص</span>
                                    @endif
                                </td>
                                
                                {{-- ✅ Passenger Column --}}
                                <td>
                                    @if($travel->client)
                                        <strong>{{ $travel->client->name }}</strong>
                                        @if($travel->client->phone)
                                            <br><small class="text-muted">{{ $travel->client->phone }}</small>
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                
                                <td>{{ $travel->from }}</td>
                                <td>{{ $travel->to }}</td>
                                <td>{{ $travel->date }}</td>
                                <td>{{ $travel->time }}</td>
                                
                                {{-- ✅ Status Badge with Larger Text --}}
                                <td>
                                    @php
                                        $statusBadges = [
                                            'Waiting' => ['class' => 'warning', 'text' => 'انتظار'],
                                            'DriverAccepted' => ['class' => 'info', 'text' => 'قبول السائق'],
                                            'PassengerAccepted' => ['class' => 'primary', 'text' => 'قبول الراكب'],
                                            'InProgress' => ['class' => 'info', 'text' => 'جارية'],
                                            'Completed' => ['class' => 'success', 'text' => 'مكتملة'],
                                            'Finished' => ['class' => 'dark', 'text' => 'منتهية'],
                                            'CancelledByDriver' => ['class' => 'danger', 'text' => 'ملغاة (السائق)'],
                                            'CancelledByPassenger' => ['class' => 'danger', 'text' => 'ملغاة (الراكب)'],
                                            'CancelledBySystem' => ['class' => 'warning', 'text' => 'ملغاة (النظام)']
                                        ];
                                        $badge = $statusBadges[$travel->status] ?? ['class' => 'secondary', 'text' => $travel->status];
                                    @endphp
                                    <span class="badge badge-{{ $badge['class'] }}" style="font-size: 14px; padding: 8px 12px;">
                                        {{ $badge['text'] }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    <div class="alert alert-info">لا توجد رحلات</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Arabic.json"
            },
            "order": [[0, "desc"]]
        });
    });
</script>
@endsection
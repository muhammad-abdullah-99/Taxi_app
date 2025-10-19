<div class="col-12 mb-4">
    <div class="card shadow-lg rounded-3 border-0" style="background-color: #1e1e2f; color: white;">
        <div class="card-header text-white">
            <h5 class="mb-0 fw-bold text-white">
                <i class="fa fa-users me-2"></i> الكباتن : {{ $allCaptains }}
            </h5>
        </div>

        <div class="card-body py-3">
            <div class="row">

                @foreach($companyTypes as $type)
                <div class="col-md-4 mb-3">
                    <div class="p-3 rounded bg-dark h-100">
                        <h5 class="fw-bold text-white mb-3 text-center">
                            🚖 كباتن {{ $type }}
                        </h5>

                        {{-- نشطين --}}
                        <div class="d-flex justify-content-between align-items-center px-3 py-1 rounded bg-secondary mb-2"
                            data-toggle="modal" data-target="#activeCaptainsModal{{ $loop->index }}" style="cursor: pointer;">
                            <span><i class="fa fa-check-circle text-info me-1"></i> النشطين</span>
                            <span>{{ $data[$type]['active']->count() }}</span>
                        </div>
                        @include('captainsModal', [
                        'id' => 'activeCaptainsModal'.$loop->index,
                        'title' => 'الكباتن النشطين - '.$type,
                        'captains' => $data[$type]['active']
                        ])

                        {{-- قيد الانتظار --}}
                        <div class="d-flex justify-content-between align-items-center px-3 py-1 rounded bg-secondary mb-2"
                            data-toggle="modal" data-target="#pendingCaptainsModal{{ $loop->index }}" style="cursor: pointer;">
                            <span><i class="fa fa-clock-o text-warning me-1"></i> المعلقين</span>
                            <span>{{ $data[$type]['pending']->count() }}</span>
                        </div>
                        @include('captainsModal', [
                        'id' => 'pendingCaptainsModal'.$loop->index,
                        'title' => 'الكباتن المعلقين - '.$type,
                        'captains' => $data[$type]['pending']
                        ])

                        {{-- مؤرشفين --}}
                        <div class="d-flex justify-content-between align-items-center px-3 py-1 rounded bg-secondary"
                            data-toggle="modal" data-target="#archivedCaptainsModal{{ $loop->index }}" style="cursor: pointer;">
                            <span><i class="fa fa-archive text-danger me-1"></i> المؤرشفين</span>
                            <span>{{ $data[$type]['archived']->count() }}</span>
                        </div>
                        @include('captainsModal', [
                        'id' => 'archivedCaptainsModal'.$loop->index,
                        'title' => 'الكباتن المؤرشفين - '.$type,
                        'captains' => $data[$type]['archived']
                        ])
                    </div>
                </div>
                @endforeach

                <!-- إجمالي الكباتن -->
<div class="col-md-4 mb-3">
    <div class="p-3 rounded bg-dark h-100">
        <h5 class="fw-bold text-white mb-3 text-center">
            <i class="fa fa-user-plus me-2"></i> إجمالي كشف الركاب
        </h5>

        <div class="round" data-toggle="modal" data-target="#citySummaryModal" style="cursor: pointer;">
            <div class="d-flex justify-content-between px-3 py-1 rounded bg-secondary mb-2">
                <span>عدد الرحلات</span>
                <span>{{ $passengers }}</span>
            </div>
            <div class="d-flex justify-content-between px-3 py-1 rounded bg-secondary mb-2">
                <span>عدد المدن</span>
                <span>{{ $actual_cities_with_trips_count }}</span>
            </div>
            <div class="d-flex justify-content-between px-3 py-1 rounded bg-secondary mb-2">
                <span>عدد الكباتن</span>
                <span>{{ $active_captains_count }}</span>
            </div>
            <div class="d-flex justify-content-between px-3 py-1 rounded bg-secondary">
                <span>عدد الشركات</span>
                <span>{{ $companies_with_trips_count }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="citySummaryModal" tabindex="-1" role="dialog" aria-labelledby="citySummaryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title text-white">كشف المدن بعدد الكباتن والشركات</h5>
            </div>
            <div class="modal-body">
                <table class="table table-dark table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>المدينة</th>
                            <th>عدد الشركات</th>
                            <th>عدد الكباتن</th>
                            <th>عدد الرحلات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cities_summary as $summary)
                        <tr>
                            <td>{{ $summary['city'] }}</td>
                            <td>{{ $summary['companies_count'] }}</td>
                            <td>{{ $summary['captains_count'] }}</td>
                            <td>{{ $summary['trips_count'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>



            </div>
        </div>
    </div>
</div>

<!-- // -->
<div class="col-12 mb-4">
    <div class="card shadow-lg rounded-3 border-0" style="background-color: #1e1e2f; color: white;">
        <div class="card-header text-white">
            <h5 class="mb-0 fw-bold text-white">
                <i class="fa fa-id-card me-2"></i> الاشتراكات : {{$subscriptions->count()}}
            </h5>
        </div>
        <div class="card-body py-4">
            <div class="row text-center">
                <!-- الباقات المتاحة -->
                <div class="col-md-4 border-end border-secondary">
                    <h6 class="fw-bold mb-3 text-white">
                        <i class="fa fa-gift me-2"></i> الباقات المتاحة
                    </h6>
                    <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#availablePackagesModal" style="cursor: pointer;">
                        <span><i class="fa fa-list text-info me-1"></i> العدد </span>
                        <span>{{ $availablePackages->count() }}</span>
                    </div>
                    <!-- Modal الباقات -->
                    <div class="modal fade" id="availablePackagesModal" tabindex="-1" role="dialog" aria-labelledby="availablePackagesModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content bg-dark text-white">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">الباقات المتاحة</h5>
                                </div>
                                <div class="modal-body">
                                    @if($availablePackages->isEmpty())
                                    <p class="text-center">لا توجد باقات متاحة حالياً</p>
                                    @else
                                    <table class="table table-dark table-striped table-bordered text-white mb-0">
                                        <thead>
                                            <tr>
                                                <th>اسم الباقة</th>
                                                <th>نوع الباقة</th>
                                                <th>السعر</th>
                                                <th>المدة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($availablePackages as $package)
                                            <tr>
                                                <td>{{ $package->name }}</td>
                                                <td>{{ $package->type }}</td>
                                                <td>{{ $package->cost }} ريال</td>
                                                <td>{{ $package->days }} يوم</td>
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
                </div>
                <!-- الاشتراكات المفعلة -->
                <div class="col-md-4 border-end border-secondary">
                    <h6 class="fw-bold mb-3 text-white">
                        <i class="fa fa-check me-2"></i> الاشتراكات المفعلة
                    </h6>
                    <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#activeSubscriptionsModal" style="cursor: pointer;">
                        <span><i class="fa fa-id-card text-success me-1"></i> العدد </span>
                        <span>{{ $activeSubscriptions->count() }}</span>
                    </div>

                    <!-- Modal الاشتراكات المفعلة -->
                    <div class="modal fade" id="activeSubscriptionsModal" tabindex="-1" role="dialog" aria-labelledby="activeSubscriptionsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content bg-dark text-white">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">الاشتراكات المفعلة</h5>
                                </div>
                                <div class="modal-body">
                                    @if($activeSubscriptions->isEmpty())
                                    <p class="text-center">لا توجد اشتراكات مفعلة</p>
                                    @else
                                    <table class="table table-dark table-bordered table-striped text-white">
                                        <thead>
                                            <tr>
                                                <th>اسم المستخدم</th>
                                                <th>الباقة</th>
                                                <th>تاريخ الانتهاء</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($activeSubscriptions as $sub)
                                            <tr>
                                                <td>{{ $sub->appUser->name ?? 'غير معروف' }}</td>
                                                <td>{{ $sub->package->name ?? 'غير معروف' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($sub->expire_at)->format('Y-m-d') }}</td>
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
                </div>

                <!-- الاشتراكات القريبة على الانتهاء -->
                <div class="col-md-4">
                    <h6 class="fw-bold mb-3 text-white">
                        <i class="fa fa-hourglass-end me-2"></i> الاشتراكات القريبة على الانتهاء
                    </h6>
                    <div class="d-flex justify-content-between px-3 py-2 rounded bg-dark" data-toggle="modal" data-target="#expiringSubscriptionsModal" style="cursor: pointer;">
                        <span><i class="fa fa-id-card text-warning me-1"></i> العدد </span>
                        <span>{{ $expiringSoon->count() }}</span>
                    </div>

                    <!-- Modal الاشتراكات القريبة من الانتهاء -->
                    <div class="modal fade" id="expiringSubscriptionsModal" tabindex="-1" role="dialog" aria-labelledby="expiringSubscriptionsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content bg-dark text-white">
                                <div class="modal-header">
                                    <h5 class="modal-title text-white">اشتراكات قريبة من الانتهاء</h5>
                                </div>
                                <div class="modal-body">
                                    @if($expiringSoon->isEmpty())
                                    <p class="text-center">لا توجد اشتراكات قريبة من الانتهاء</p>
                                    @else
                                    <table class="table table-dark table-bordered table-striped text-white">
                                        <thead>
                                            <tr>
                                                <th>اسم المستخدم</th>
                                                <th>الباقة</th>
                                                <th>تاريخ الانتهاء</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($expiringSoon as $sub)
                                            <tr>
                                                <td>{{ $sub->appUser->name ?? 'غير معروف' }}</td>
                                                <td>{{ $sub->package->name ?? 'غير معروف' }}</td>
                                                <td>{{ \Carbon\Carbon::parse($sub->expire_at)->format('Y-m-d') }}</td>
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
                </div>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header">
                <h5 class="modal-title text-white">{{ $title }}</h5>
            </div>
            <div class="modal-body">
                @if($captains->isEmpty())
                    <p class="text-center text-white">لا توجد بيانات</p>
                @else
                    <table class="table table-dark table-striped table-bordered text-white mb-0">
                        <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>تاريخ التسجيل</th>
                            <th>رقم الجوال</th>
                            <th>الشركة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($captains as $captain)
                            <tr>
                                <td>{{ $captain->name ?? 'غير معروف' }}</td>
                                <td>{{ \Carbon\Carbon::parse($captain->created_at)->format('Y-m-d') }}</td>
                                <td>{{ $captain->mobile ?? '-' }}</td>
                                <td>{{ $captain->company->company_type ?? '-' }}</td>
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

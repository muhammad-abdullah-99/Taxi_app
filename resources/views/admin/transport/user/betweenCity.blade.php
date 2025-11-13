@extends('layouts.master')

@section('title')
بين المدن
@endsection

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> بين المدن</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                <li class="breadcrumb-item">
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addCityModal">
                        <i class="fa fa-plus"></i> إضافة
                    </button>
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')

<!-- ✅ JavaScript for Dynamic Max Passengers -->
<script>
function updateMaxPassengers(selectElement, passengersSelectId) {
    const companyTypes = {!! json_encode($companyTypes) !!};
    const selectedType = selectElement.value;
    const passengersSelect = document.getElementById(passengersSelectId);
    
    if (!passengersSelect) return;
    
    // Get max passengers for selected company type
    let maxPassengers = 8; // Default
    if (selectedType && companyTypes[selectedType]) {
        maxPassengers = companyTypes[selectedType].max_passengers;
    }
    
    // Clear and rebuild options
    passengersSelect.innerHTML = '';
    for (let i = 1; i <= maxPassengers; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        passengersSelect.appendChild(option);
    }
}
</script>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- مودال الإضافة -->
<div class="modal fade" id="addCityModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('between_cities.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة مسافة جديدة</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label><strong>المدينة الأولى:</strong></label>
                            <input type="text" name="city_one" class="form-control mb-3" placeholder="المدينة الأولى" required>
                        </div>
                        <div class="col-md-6">
                            <label><strong>المدينة الثانية:</strong></label>
                            <input type="text" name="city_two" class="form-control mb-3" placeholder="المدينة الثانية" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label><strong>السعر:</strong></label>
                            <input type="number" step="0.01" name="amount" class="form-control mb-3" placeholder="السعر" required>
                        </div>
                        <div class="col-md-6">
                            <label><strong>نسبة المكتب:</strong></label>
                            <input type="number" step="0.01" name="office_commission" class="form-control mb-3" placeholder="نسبة المكتب" required>
                        </div>
                    </div>

                    <!-- ✅ نوع الشركة (Single Selection - Dropdown) -->
                    <div class="form-group">
                        <label><strong>نوع الشركة:</strong></label>
                        <select name="company_type" id="add_company_type" class="form-control" 
                                onchange="updateMaxPassengers(this, 'add_passengers')" required>
                            <option value="">اختر نوع الشركة</option>
                            @foreach($companyTypes as $key => $details)
                                <option value="{{ $key }}">
                                    {{ $details['name_ar'] }} - (حد أقصى: {{ $details['max_passengers'] }} راكب)
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- ✅ عدد الركاب (التصنيف) - Dynamic based on company type -->
                    <div class="form-group">
                        <label><strong>التصنيف (عدد الركاب):</strong></label>
                        <select name="passengers" id="add_passengers" class="form-control" required>
                            <option value="">اختر نوع الشركة أولاً</option>
                        </select>
                        <small class="form-text text-muted">سيتم تحديث الخيارات تلقائيًا حسب نوع الشركة</small>
                    </div>

                    <!-- أنواع النقل -->
                    <div class="form-group">
                        <label><strong>أنواع النقل:</strong></label>
                        <div class="row">
                            @foreach($transportTypes as $key => $arabicName)
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" name="transport_types[]" value="{{ $key }}" 
                                           class="form-check-input" id="transport_{{ $key }}">
                                    <label class="form-check-label" for="transport_{{ $key }}">
                                        {{ $arabicName }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label><strong>نوع السيارة:</strong></label>
                            <select name="car_type" class="form-control mb-3">
                                <option value="">Auto</option>
                                <option value="هايس">هايس</option>
                                <option value="استاركس">استاركس</option>
                                <option value="استاريا">استاريا</option>
                                <option value="كامري">كامري</option>
                                <option value="سوناتا">سوناتا</option>
                                <option value="كيا k5">كيا k5</option>
                                <option value="ميتسويشي اكس باندر">ميتسويشي اكس باندر</option>
                                <option value="النترا">النترا</option>
                                <option value="جمس">جمس</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label><strong>الكود:</strong></label>
                            <input type="text" name="code" class="form-control mb-3" placeholder="الكود">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                    <button class="btn btn-primary" type="submit">إضافة</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- جدول -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>المدينة الأولى</th>
                                <th>المدينة الثانية</th>
                                <th>السعر</th>
                                <th>نوع الشركة</th>
                                <th>التصنيف</th>
                                <th>أنواع النقل</th>
                                <th>نوع السيارة</th>
                                <th>الكود</th>
                                <th>نسبة المكتب</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($between_cities as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->city_one }}</td>
                                <td>{{ $item->city_two }}</td>
                                <td>{{ number_format((float)$item->amount, 2) }}</td>
                                <td>
                                    @if($item->company_type && isset($companyTypes[$item->company_type]))
                                        {{ $companyTypes[$item->company_type]['name_ar'] }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $item->passengers }}</td>
                                <td>
                                    @if($item->transport_types_arabic)
                                        {{ implode('، ', $item->transport_types_arabic) }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ $item->car_type ?: 'Auto' }}</td>
                                <td>{{ $item->code }}</td>
                                <td>{{ number_format((float)$item->office_commission, 2) }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $item->id }}">
                                        تعديل
                                    </button>
                                </td>
                            </tr>

                            <!-- مودال تعديل -->
                            <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <form action="{{ route('between_cities.update', $item->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">تعديل المسافة</h5>
                                                <button class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label><strong>المدينة الأولى:</strong></label>
                                                        <input type="text" name="city_one" class="form-control mb-3" value="{{ $item->city_one }}" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label><strong>المدينة الثانية:</strong></label>
                                                        <input type="text" name="city_two" class="form-control mb-3" value="{{ $item->city_two }}" required>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label><strong>السعر:</strong></label>
                                                        <input type="number" step="0.01" name="amount" class="form-control mb-3" value="{{ $item->amount }}" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label><strong>نسبة المكتب:</strong></label>
                                                        <input type="number" step="0.01" name="office_commission" class="form-control mb-3" value="{{ $item->office_commission }}" required>
                                                    </div>
                                                </div>

                                                <!-- نوع الشركة -->
                                                <div class="form-group">
                                                    <label><strong>نوع الشركة:</strong></label>
                                                    <select name="company_type" id="edit_company_type_{{ $item->id }}" class="form-control" 
                                                            onchange="updateMaxPassengers(this, 'edit_passengers_{{ $item->id }}')" required>
                                                        <option value="">اختر نوع الشركة</option>
                                                        @foreach($companyTypes as $key => $details)
                                                            <option value="{{ $key }}" {{ $item->company_type == $key ? 'selected' : '' }}>
                                                                {{ $details['name_ar'] }} - (حد أقصى: {{ $details['max_passengers'] }} راكب)
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- عدد الركاب -->
                                                <div class="form-group">
                                                    <label><strong>التصنيف (عدد الركاب):</strong></label>
                                                    <select name="passengers" id="edit_passengers_{{ $item->id }}" class="form-control" required>
                                                        @php
                                                            $maxPass = 8;
                                                            if($item->company_type && isset($companyTypes[$item->company_type])) {
                                                                $maxPass = $companyTypes[$item->company_type]['max_passengers'];
                                                            }
                                                        @endphp
                                                        @for($i = 1; $i <= $maxPass; $i++)
                                                            <option value="{{ $i }}" {{ $item->passengers == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>

                                                <!-- أنواع النقل -->
                                                <div class="form-group">
                                                    <label><strong>أنواع النقل:</strong></label>
                                                    <div class="row">
                                                        @foreach($transportTypes as $key => $arabicName)
                                                        <div class="col-md-6">
                                                            <div class="form-check">
                                                                <input type="checkbox" name="transport_types[]" value="{{ $key }}" 
                                                                       class="form-check-input" id="edit{{ $item->id }}_transport_{{ $key }}"
                                                                       {{ $item->transport_types && in_array($key, explode(',', $item->transport_types)) ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="edit{{ $item->id }}_transport_{{ $key }}">
                                                                    {{ $arabicName }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label><strong>نوع السيارة:</strong></label>
                                                        <select name="car_type" class="form-control mb-3">
                                                            <option value="">Auto</option>
                                                            <option value="هايس" {{ $item->car_type == 'هايس' ? 'selected' : '' }}>هايس</option>
                                                            <option value="استاركس" {{ $item->car_type == 'استاركس' ? 'selected' : '' }}>استاركس</option>
                                                            <option value="استاريا" {{ $item->car_type == 'استاريا' ? 'selected' : '' }}>استاريا</option>
                                                            <option value="كامري" {{ $item->car_type == 'كامري' ? 'selected' : '' }}>كامري</option>
                                                            <option value="سوناتا" {{ $item->car_type == 'سوناتا' ? 'selected' : '' }}>سوناتا</option>
                                                            <option value="كيا k5" {{ $item->car_type == 'كيا k5' ? 'selected' : '' }}>كيا k5</option>
                                                            <option value="ميتسويشي اكس باندر" {{ $item->car_type == 'ميتسويشي اكس باندر' ? 'selected' : '' }}>ميتسويشي اكس باندر</option>
                                                            <option value="النترا" {{ $item->car_type == 'النترا' ? 'selected' : '' }}>النترا</option>
                                                            <option value="جمس" {{ $item->car_type == 'جمس' ? 'selected' : '' }}>جمس</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label><strong>الكود:</strong></label>
                                                        <input type="text" name="code" class="form-control mb-3" value="{{ $item->code }}" placeholder="الكود">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                <button class="btn btn-primary" type="submit">تحديث</button>
                                            </div>
                                        </div>
                                    </form>
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
@extends('layouts.master')

@section('title') الفطار @stop

@section('css')
<!-- أي ملفات CSS إضافية هنا -->
@endsection

@section('page-header')
<div class="container">

    <div class="row">
        @forelse($foods as $food)
        <div class="col-md-3 mb-4">
            <div class="card bg-dark text-white" style="cursor: pointer;" data-toggle="modal" data-target="#orderModal{{ $food->id }}">
                <div class="card-header d-flex justify-content-between align-items-center py-2 px-3">
                    <strong class="fs-6">{{ $food->name }}</strong>
                    <span class="badge bg-secondary">{{ $food->type }}</span>
                </div>
                <div class="card-body p-0">
                    <table class="table table-dark table-bordered mb-0 text-center table-sm">
                        <thead>
                            <tr>
                                <th>الحجم</th>
                                <th>السعر</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($food->food_price as $price)
                            <tr>
                                <td>{{ $price->size }}</td>
                                <td>{{ number_format($price->price, 2) }} ريال</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2">لا توجد أسعار</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="card-footer text-center">
                <button class="btn btn-dark w-100" data-toggle="modal" data-target="#editModal{{ $food->id }}">
                    تعديل الأسعار
                </button>
            </div>

        </div>

        <!-- مودال الطلب -->
        <div class="modal fade" id="orderModal{{ $food->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content bg-dark text-white">
                    <div class="modal-header">
                        <h5 class="modal-title">طلب: {{ $food->name }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-dismiss="modal"></button>
                    </div>
                    <form method="POST" action="{{ route('addBoxStation') }}">
                        @csrf
                        <input type="hidden" name="food_id" value="{{ $food->id }}">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">الحجم</label>
                                <select name="size" class="form-select" required>
                                    @foreach($food->food_price as $price)
                                    <option value="{{ $price->size }}">{{ $price->size }} - {{ number_format($price->price, 2) }} ريال</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">العدد</label>
                                <input type="number" name="quantity" class="form-control" min="1" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">إضافة للطلب</button>
                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- مودال تعديل السعر لهذا الصنف -->
        <div class="modal fade" id="editModal{{ $food->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form method="POST" action="{{ route('updateFoodPrices', $food->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-content bg-dark text-white">
                        <div class="modal-header">
                            <h5 class="modal-title">تعديل أسعار: {{ $food->name }}</h5>
                            <button type="button" class="btn-close btn-close-white" data-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            @foreach($food->food_price as $price)
                            <div class="mb-3">
                                <label class="form-label">{{ $price->size }}</label>
                                <input type="number" step="0.01" name="prices[{{ $price->id }}]" value="{{ $price->price }}" class="form-control" required>
                            </div>
                            @endforeach
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">حفظ</button>
                            <button type="button" class="btn btn-outline-light" data-dismiss="modal">إغلاق</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @empty
        <div class="col-12">
            <div class="alert alert-info text-center">لا توجد أصناف</div>
        </div>
        @endforelse
    </div>

    <!-- ملخص الطلب -->
    <div class="d-flex justify-content-between align-items-center bg-dark text-white p-3 rounded mb-3">
        <h5 class="mb-0 text-white">إجمالي المبلغ: {{ number_format($box, 2) }} ريال</h5>
        <div class="d-flex gap-2">
            <form action="{{ route('confirmBoxAmount') }}" method="POST" class="mr-2">
                @csrf
                <input type="hidden" name="total_amount" value="{{ $box }}">
                <input type="hidden" name="food_type" value="افطار">
                <button type="submit" class="btn btn-success">تأكيد</button>
            </form>
            <form action="{{ route('cancelBox') }}" method="POST">
                @csrf
                <input type="hidden" name="food_type" value="افطار">
                <button type="submit" class="btn btn-danger">إلغاء</button>
            </form>
        </div>
    </div>

</div>
@endsection

@section('js')
<!-- أي ملفات JS إضافية -->
@endsection
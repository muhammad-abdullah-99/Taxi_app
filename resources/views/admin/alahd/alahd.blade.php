@extends('layouts.master')

@section('css')
@endsection

@section('title')
العهد
@stop

@section('page-header')
<div class="container">
    <h2>قائمة العهد</h2>

    <!-- زر فتح المودال -->
    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addAlahdaModal">
        إضافة عهدة
    </button>

    <!-- جدول عرض العهد (مثال بسيط) -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                            <thead>
                                <tr>
                                    <th>اسم العهدة</th>
                                    <th>الوصف</th>
                                    <th>العدد</th>
                                    <th>بواسطة</th>
                                    <th>عرض البيانات</th>
                                    <th>الاجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alahdas as $alahda)
                                <tr>
                                    <td>{{ $alahda->name }}</td>
                                    <td>{{ $alahda->description }}</td>
                                    <td>{{ $alahda->count }}</td>
                                    <td>{{ $alahda->user_name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#showdata{{ $alahda->id }}">عرض</button>
                                        <div class="modal fade" id="showdata{{ $alahda->id }}" tabindex="-1" role="dialog" aria-labelledby="showSerialsLabel{{ $alahda->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="showSerialsLabel{{ $alahda->id }}">الأرقام التسلسلية للعهدة</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body" style="max-height: 400px; overflow-y: auto;"> <!-- added max-height and overflow -->
                                                        @if($alahda->alahdaCounts->count())
                                                        <ul class="list-group">
                                                            @foreach($alahda->alahdaCounts as $c)
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <strong>رقم:</strong> <span>{{ $c->serial_number }}</span>
                                                                </div>
                                                                @if (Auth::check() && Auth::user()->role == 'مسؤول')

                                                                <button type="button"
                                                                    class="btn btn-sm btn-danger"
                                                                    data-toggle="modal"
                                                                    data-target="#confirmDeleteModal{{ $c->id }}">
                                                                    حذف
                                                                </button>
                                                                @endif

                                                            </li>

                                                            <!-- مودال تأكيد الحذف لكل سيريال -->
                                                            <div class="modal fade" id="confirmDeleteModal{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel{{ $c->id }}" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <form action="{{ route('alahda.deleteSerial', $c->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')

                                                                            <div class="modal-header bg-danger text-white">
                                                                                <h5 class="modal-title" id="confirmDeleteModalLabel{{ $c->id }}">تأكيد الحذف</h5>
                                                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>

                                                                            <div class="modal-body">
                                                                                <p>هل أنت متأكد أنك تريد حذف السيريال التالي؟</p>
                                                                                <p class="text-center font-weight-bold text-danger">{{ $c->serial_number }}</p>
                                                                            </div>

                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                                                <button type="submit" class="btn btn-danger">حذف</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @endforeach
                                                        </ul>
                                                        @else
                                                        <div class="alert alert-warning text-center">
                                                            لا توجد أرقام تسلسلية مدخلة.
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>







                                    </td>

                                    <td>
                                        <!-- زر فتح المودال -->
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#addCountModal{{ $alahda->id }}">إضافة عدد</button>

                                    <!-- مودال إضافة عدد جديد مع الحقول الديناميكية -->
<div class="modal fade" id="addCountModal{{ $alahda->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form action="{{ route('alahda.addCount', $alahda->id) }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة عدد جديد للعهدة</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>عدد القطع الجديدة</label>
                        <input type="number" name="new_count" class="form-control count-input" data-id="{{ $alahda->id }}" min="1" required>
                    </div>
                    <div class="form-group serials-container" id="newSerialsContainer{{ $alahda->id }}" style="display:none;">
                        <label>الأرقام التسلسلية</label>
                        <div id="newSerialInputs{{ $alahda->id }}"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">إضافة</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                </div>
            </div>
        </form>
    </div>
</div>

                                        @if (Auth::check() && Auth::user()->role == 'مسؤول')
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#archive{{ $alahda->id }}">
                                            <i class="fa fa-archive"></i>
                                        </button>
                                        @endif
                                        <div class="modal fade" id="archive{{ $alahda->id }}" tabindex="-1" role="dialog" aria-labelledby="archiveCarModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="archiveCarModalLabel">أرشفة العهدة </h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('archiveAlahda', $alahda->id) }}" method="post">
                                                            @csrf
                                                            <p>هل أنت متأكد من أنك تريد أرشفة هذه العهده ؟</p>
                                                            <button type="submit" class="btn btn-warning">أرشفة</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
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


    <!-- Modal الإضافة -->
    <div class="modal fade" id="addAlahdaModal" tabindex="-1" role="dialog" aria-labelledby="addAlahdaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('storeAlahda') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">إضافة عهدة جديدة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="إغلاق">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label>اسم العهدة</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>الوصف</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <label>عدد القطع</label>
                            <input type="number" name="count" class="form-control" min="1" id="countInput" required>
                        </div>

                        <div class="form-group" id="serialNumbersContainer" style="display:none;">
                            <label>أدخل الأرقام التسلسلية</label>
                            <div id="serialInputs"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">حفظ</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- سكريبتات Bootstrap و jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $('#countInput').on('input', function() {
        let count = parseInt($(this).val());
        let container = $('#serialInputs');
        container.empty();

        if (count > 0) {
            $('#serialNumbersContainer').show();
            for (let i = 1; i <= count; i++) {
                container.append(`
                <div class="form-group">
                    <input type="text" name="serial_numbers[]" class="form-control mb-2" placeholder="سيريال رقم ${i}" required>
                </div>
            `);
            }
        } else {
            $('#serialNumbersContainer').hide();
        }
    });
</script>
<script>
    $(document).ready(function() {
        // أي input من النوع count-input
        $(document).on('input', '.count-input', function () {
            let id = $(this).data('id');
            let count = parseInt($(this).val());
            let container = $('#newSerialInputs' + id);
            container.empty();

            if (count > 0) {
                $('#newSerialsContainer' + id).show();
                for (let i = 1; i <= count; i++) {
                    container.append(`
                        <input type="text" name="serial_numbers[]" class="form-control mb-2" placeholder="سيريال رقم ${i}" required>
                    `);
                }
            } else {
                $('#newSerialsContainer' + id).hide();
            }
        });
    });
</script>




@endsection

@section('js')
@endsection
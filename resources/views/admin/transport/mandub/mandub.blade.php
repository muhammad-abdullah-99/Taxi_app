@extends('layouts.master')
@section('css')
@endsection

@section('title')
إدارة المناديب
@stop

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">إدارة المناديب</h4>
        </div>
        <div class="col-sm-6 text-right">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMandubModal">
                <i class="fa fa-plus"></i> إضافة مندوب
            </button>
        </div>
    </div>
</div>
@endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{-- Modal إضافة --}}
<div class="modal fade" id="addMandubModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة مندوب</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('mandubs.store') }}" method="post">
                    @csrf
                    <input type="text" name="name" class="form-control" placeholder="الاسم" required>
                    <br>
                    <input type="text" name="code" class="form-control" placeholder="الكود" required>
                    <br>
                    <input type="number" name="percentage" class="form-control" placeholder="النسبة" step="0.01" required>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0" style="text-align:center">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>الكود</th>
                                <th>النسبة</th>
                                <th>العدد</th>
                                <th>المبلغ</th>
                                <th>الصرف</th>
                                <th>تاريخ الإضافة</th>
                                <th>أضيف بواسطة</th>
                                <th>الاجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mandubs as $mandub)
                            <tr>
                                <td>{{ $mandub->name }}</td>
                                <td>{{ $mandub->code }}</td>
                                <td>{{ $mandub->percentage }}</td>
                                <td>{{ $mandub->count }}</td>
                                <td>{{ $mandub->amount }}</td>
                                <td>{{ $mandub->spent }}</td>
                                <td>{{ $mandub->created_at->format('Y-m-d') }}</td>
                                <td>{{ $mandub->user_name }}</td>
                                <td>
                                    {{-- زر صرف --}}
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#spendModal{{ $mandub->id }}">
                                        صرف
                                    </button>

                                    {{-- زر تعديل --}}
                                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $mandub->id }}">
                                        تعديل
                                    </button>

                                    {{-- زر أرشفة --}}
                                    <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#archiveModal{{ $mandub->id }}">
                                        أرشيف
                                    </button>

                                    {{-- Modal صرف --}}
                                    <div class="modal fade" id="spendModal{{ $mandub->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('mandubs.spend', $mandub->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">تأكيد صرف المبلغ</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body text-right" style="font-size: 20px;">
                                                        هل أنت متأكد من صرف مبلغ <strong>{{ $mandub->amount }}</strong> للمندوب <strong>{{ $mandub->name }}</strong>؟
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                        <button type="submit" class="btn btn-danger">تأكيد الصرف</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- Modal تعديل --}}
                                    <div class="modal fade" id="editModal{{ $mandub->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('mandubs.update', $mandub->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">تعديل بيانات المندوب</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="text" name="name" class="form-control" value="{{ $mandub->name }}" required>
                                                        <br>
                                                        <input type="text" name="code" class="form-control" value="{{ $mandub->code }}" required>
                                                        <br>
                                                        <input type="number" name="percentage" class="form-control" value="{{ $mandub->percentage }}" step="0.01" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                        <button type="submit" class="btn btn-warning">حفظ التعديلات</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    {{-- Modal أرشفة --}}
                                    <div class="modal fade" id="archiveModal{{ $mandub->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ route('mandubs.archive', $mandub->id) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">أرشفة المندوب</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                    </div>
                                                    <div class="modal-body text-right" style="font-size: 18px;">
                                                        هل أنت متأكد أنك تريد أرشفة المندوب <strong>{{ $mandub->name }}</strong>؟
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                                                        <button type="submit" class="btn btn-secondary">تأكيد الأرشفة</button>
                                                    </div>
                                                </div>
                                            </form>
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
@endsection

@section('js')
@endsection

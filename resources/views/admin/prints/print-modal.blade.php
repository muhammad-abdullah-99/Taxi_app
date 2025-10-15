<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="GET" action="{{ route($route) }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="printModalLabel">بيانات النموذج</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label>اسم الموظف</label>
                        <input type="text" name="name" class="form-control" value="{{ $employee->name ?? '' }}" required>
                    </div>

                    <div class="form-group">
                        <label>الجنسية</label>
                        <input type="text" name="nationality" class="form-control" value="{{ $employee->nationality ?? '' }}" required>
                    </div>

                    <div class="form-group">
                        <label>رقم الهوية</label>
                        <input type="text" name="id_number" class="form-control" value="{{ $employee->identity_number ?? '' }}" required>
                    </div>

                    <div class="form-group">
                        <label>التاريخ</label>
                        <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">اذهب للطباعة</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                </div>
            </div>
        </form>
    </div>
</div>

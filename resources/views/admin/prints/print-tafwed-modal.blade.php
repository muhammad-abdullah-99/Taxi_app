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
                        <label>تاريخ بداية التفويض</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>تاريخ نهاية التفويض</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>سنة الصنع</label>
                        <select name="year" class="form-control" required>
                            <option value="2020">2017</option>
                            <option value="2020">2018</option>
                            <option value="2020">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2020">2025</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>اللون</label>
                        <select name="color" class="form-control" required>
                            <option value="أبيض">أبيض</option>
                            <option value="أسود">أسود</option>
                            <option value="فضي">فضي</option>
                            <option value="رمادي">رمادي</option>
                            <option value="أحمر">أحمر</option>
                            <option value="أخضر">أخضر</option> <!-- تمت الإضافة -->
                        </select>
                    </div>

                    <div class="form-group">
                        <label>الموديل</label>
                        <select name="car_type" class="form-control" required>
                            <option value="تويوتا يارس">تويوتا يارس</option>
                            <option value="تويوتا ">تويوتا </option>
                            <option value="هيونداي إلنترا">هيونداي إلنترا</option>
                            <option value="هونداي اتش وان	 ">هونداي اتش وان </option>
                            <option value="هونداي سوناتا	 ">هونداي سوناتا </option>
                            <option value="هونداي ستاركس	 ">هونداي ستاركس </option>
                            <option value="هونداي فان	 	 ">هونداي فان </option>
                            <option value="هونداي  ستاريا		 ">هونداي ستاريا </option>
                            <option value="كيا كي 5	 	 ">كيا كي 5 </option>
                            <option value="ميسوتبيشي اكسباندر		 	 ">ميسوتبيشي اكسباندر </option>


                        </select>
                    </div>

                    @php
                    $plateNumbers = \App\Models\Car::pluck('plate_number');
                    @endphp

                    <div class="form-group">
                        <label>رقم اللوحة</label>
                        <select name="plate_number" class="form-control" required>
                            <option value="">اختر رقم اللوحة</option>
                            @foreach($plateNumbers as $number)
                            <option value="{{ $number }}">{{ $number }}</option>
                            @endforeach
                        </select>
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
<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- Dashboard menu item-->

                    <!-- menu title -->
                    <!-- Elements menu item-->
                    @if (Auth::check() && in_array(Auth::user()->role, ['مسؤول']))
                    @if (session('company_type') == 'taxi')

                    <li>
                        <a href="{{route('dashboard')}}">
                            <div class="pull-left " style="font-size: 18px; "><i class="ti-home" style="font-size: 18px; font-weight: bold;"></i><span class="right-nav-text">الرئيسية</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('showAllEmployees')}}">
                            <div class="pull-left" style="font-size: 18px;"> <i class="ti-palette" style="font-size: 18px; font-weight: bold;"></i><span
                                    class="right-nav-text">الموظفين</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('getGeha')}}">
                            <div class="pull-left" style="font-size: 18px;"> <i class="ti-briefcase" style="font-size: 18px; font-weight: bold;"></i><span
                                    class="right-nav-text">الجهات</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('showAllCars')}}">
                            <div class="pull-left" style="font-size: 18px;"> <i class="fa fa-car" style="font-size: 18px; font-weight: bold;"></i><span
                                    class="right-nav-text">السيارات</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('getDocs')}}">
                            <div class="pull-left" style="font-size: 18px;"><i class="fa fa-list-ul" style="font-size: 18px; font-weight: bold;"></i><span class="right-nav-text">التنبيهات</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-cogs" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">الخدمات</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <!-- calendar menu item-->
                    <!-- <li>
                    <a href="{{route('getSubCategory')}}"  >
                            <div class="pull-left"><i class="fa fa-sitemap"></i><span
                                    class="right-nav-text">SubCategory</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>  -->
                    <!-- <li>
                    <a href="{{route('getVendor')}}">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">Vendor</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>  -->
                    <li>
                        <a href="{{route('admin.users.index')}}">
                            <div class="pull-left " style="font-size: 18px; "><i class="fa fa-user " style="font-size: 18px; font-weight: bold;"></i><span class="right-nav-text ">المستخدمين</span></div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('getAllAlahda') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-briefcase" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">العهد</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('messages.index') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-commenting-o" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">الرسائل</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
<li>
    <a href="{{ route('admin.contacts') }}">
        <div class="pull-left" style="font-size: 18px;">
            <i class="fa fa-envelope" style="font-size: 18px; font-weight: bold;"></i>
            <span class="right-nav-text">رسائل الموقع</span>
        </div>
        <span class="badge badge-danger pull-right">{{ \App\Models\Contact::count() }}</span>
        <div class="clearfix"></div>
    </a>
</li>

                    @elseif (session('company_type') == 'transport')
                    <li>
                        <a href="{{route('dashboard')}}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="ti-home" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">الرئيسية</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('showAllDrivers')}}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-user" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text"> الكباتن   </span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('mandubs.show')}}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-users" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">المناديب</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('getCompanies')}}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-building" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text"> شركات النقل المتخصص </span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('showSubs')}}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-credit-card" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">الباقات والاشتراكات </span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('showAllPassengers') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-users" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">كشف الركاب</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('showAllTravels') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-send" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">الرحلات</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('showAllUsers') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-user-o " style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">العملاء</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('between_cities.index') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-map-marker " style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">بين المدن</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('messages.app.index') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-commenting-o" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">الرسائل</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- Add this after "الدعم الفني" section -->
                    <li>
                        <a href="{{ route('dashboard.pending') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-money" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">طلبات السحب</span>
                            </div>
                            @if(\App\Models\DriverPayment::where('status', 'pending')->count() > 0)
                                <span class="badge badge-warning pull-right">
                                    {{ \App\Models\DriverPayment::where('status', 'pending')->count() }}
                                </span>
                            @endif
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('support.app.index') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-headphones" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">الدعم الفني </span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="{{ route('showPurchases') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-shopping-cart" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">المشتريات</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li> -->

                    <!-- <li>
                        <a href="{{ route('showAllPassengers') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-percent" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">ضريبة القيمة المضافة</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li> -->

                    <!-- <li>
                        <a href="#">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-file" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">كشف حساب</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('showAllBank') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-university" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">البنك</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('showWallets') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-money" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text"> المحفظه</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li> -->
                    @elseif (session('company_type') == 'restaurantAlawaly')
                    <!-- الزر لفتح المودال -->
                    <li>
                        <a href="{{route('dashboard')}}">
                            <div class="pull-left " style="font-size: 18px; "><i class="ti-home" style="font-size: 18px; font-weight: bold;"></i><span class="right-nav-text">الرئيسية</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('addNewFoodType') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-plus-circle" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text"> اضافة صنف</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>


                    <li>
                        <a href="{{ route('getBreakfast') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-coffee" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text"> الافطار </span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('getLunch') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-cutlery" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text"> الغداء</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('getDinner') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-spoon" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text"> العشاء</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('foodbox.daily_totals') }}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-archive" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text">الصندوق</span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>

                    @elseif (session('company_type') == 'moneyManagement')
                    <li>
                        <a href="{{route('getBox')}}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-archive" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text"> صندوق شركة روز للأجرة العامة / النقل المتخصص </span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('showTransportBox')}}">
                            <div class="pull-left" style="font-size: 18px;">
                                <i class="fa fa-cube" style="font-size: 18px; font-weight: bold;"></i>
                                <span class="right-nav-text"> صندوق شركة روز لتوجيه مركبات الأجرة / الحافلات
 </span>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </li>
                    @endif
                    @endif


                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->
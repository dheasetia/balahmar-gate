@extends('layouts.main')

@section('plugin_styles')
    <link href="{{ asset('assets/layouts/layout3/css/layout-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/layouts/layout3/css/themes/default-rtl.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{ asset('assets/layouts/layout3/css/custom-rtl.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <style>
        .widget-row {
            margin-bottom: 30px;
            margin-top: 15px;
        }
        .chart_content {
            width: 100%;
            height: 900px;
        }
    </style>

@endsection


@section('content')
    <div class="col-md-12" style="margin-bottom: 35px">
        <div class="row widget-row">
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">الجهات المستفيدة</h4>
                    <div class="widget-thumb-wrap">
                        <a href="{{url('admin/offices')}}" class="tooltips" data-original-title="تفاصيل قائمة الجهات المستفيدة"><i class="widget-thumb-icon bg-green fa fa-bank"></i></a>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">جهة</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$offices_count}}">0</span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>

            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">الجهات المعتمدة</h4>
                    <div class="widget-thumb-wrap">
                        <a href="{{url('admin/offices/approved')}}" class="tooltips" data-original-title="تفاصيل قائمة الجهات التي تم اعتمادها"><i class="widget-thumb-icon bg-green fa fa-check"></i></a>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">جهة</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$approved_offices_count}}">0</span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>

            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">الجهات في انتظار الاعتماد</h4>
                    <div class="widget-thumb-wrap">
                        <a href="{{url('admin/offices/unapproved')}}" class="tooltips" data-original-title="تفاصيل قائمة الجهات في انتظار الاعتماد"><i class="widget-thumb-icon bg-green fa fa-clock-o"></i></a>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">جهة</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$unapproved_offices_count}}">0</span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>

            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading"> الجهات تم الاعتذار عنها</h4>
                    <div class="widget-thumb-wrap">
                        <a href="{{url('admin/offices/banned')}}" class="tooltips" data-original-title="تفاصيل قائمة الجهات التي تم رفضها"><i class="widget-thumb-icon bg-green fa fa-ban"></i></a>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">جهة</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$banned_offices_count}}">0</span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>

        </div>
        <div class="row widget-row">
            <div class="col-md-3">
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">إجمالي المشاريع</h4>
                    <div class="widget-thumb-wrap">
                        <a href="{{url('admin/projects')}}" class="tooltips" data-original-title="إجمالي المشاريع">
                            <i class="widget-thumb-icon bg-blue-chambray fa fa-wrench"></i>
                        </a>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">مشروع</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$projects_count}}">0</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">المشاريع المعتمدة</h4>
                    <div class="widget-thumb-wrap">
                        <a href="{{url('admin/projects/approved')}}" class="tooltips" data-original-title="تفاصيل قائمة المشاريع تمت اعتمادها">
                            <i class="widget-thumb-icon bg-blue-chambray fa fa-check"></i>
                        </a>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">مشروع</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$approved_projects_count}}">0</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">المشاريع في انتظار الموافقة</h4>
                    <div class="widget-thumb-wrap">
                        <a href="{{url('admin/projects/unapproved')}}" class="tooltips" data-original-title="تفاصيل قائمة المشاريع في انتظار الموافقة">
                            <i class="widget-thumb-icon bg-blue-chambray fa fa-clock-o"></i>
                        </a>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">مشروع</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$unapproved_projects_count}}">0</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">المشاريع تم الاعتذار عنها</h4>
                    <div class="widget-thumb-wrap">
                        <a href="{{url('admin/projects/banned')}}" class="tooltips" data-original-title="تفاصيل قائمة المشاريع التي تم رفضها">
                            <i class="widget-thumb-icon bg-blue-chambray fa fa-ban"></i>
                        </a>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">مشروع</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="{{$banned_projects_count}}">0</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="portlet light portlet-fit ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bank font-balahmar"></i>
                    <span class="caption-subject bold font-balahmar">  إحصائيات عدد الجهات المستفيدة على حسب المدن<span id="office_count"></span></span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="chart_content" id="chartdiv1"></div>
            </div>
        </div>
        <div class="portlet light portlet-fit ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bank font-balahmar"></i>
                    <span class="caption-subject bold font-balahmar">  إحصائيات إجمالي الدعم بالشهور</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="chart_content" id="chartdiv2"></div>
            </div>
        </div>
    </div>

@endsection

@section('plugin_scripts')
    <script src="{{ asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
    <script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
    <script src="https://www.amcharts.com/lib/3/pie.js"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js"></script>
    <script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
    <script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
    <script src="{{asset('assets/layouts/layout3/scripts/admin_dashboard.js')}}"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="{{ asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
@endsection

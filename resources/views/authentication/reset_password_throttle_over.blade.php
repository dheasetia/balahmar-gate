<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="rtl">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>بوابة المنح - مؤسسة بالحمر الخيرية</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="البوابة الإلكترونية لطلب المنح - مؤسسة سالم بن أحمد بالحمر وعائلته الخيرية" name="description" />
    <meta content="إدارة التقنية بمؤسسة بالحمر الخيرية" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('assets/global/css/components-md-rtl.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{asset('assets/global/css/plugins-md-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('assets/layouts/layout3/css/layout-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/layouts/layout3/css/themes/default-rtl.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{asset('assets/layouts/layout3/css/custom-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <style>
        body{
            font-family: DroidNaskh;
        }
        .page-footer{
            font-family: DroidKufi, DroidNaskh;
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 1rem;
            text-align: center;
        }
        .page-content{
            min-height: 1000px;
            background-image: url("{{asset('assets/global/img/background/sayagata-400px.png')}}")!important;

        }
        .caption{
            font-family: DroidKufi;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: DroidKufi;
        }
        .page-header .page-header-menu .hor-menu .navbar-nav > li {
            color: #ced5de;
            background: #007269;
        }

        .page-header .page-header-menu .hor-menu .navbar-nav > li.active > a{
            color: #f1f1f1;
            background: #014741;
        }
        .page-header .page-header-menu .hor-menu .navbar-nav > li > a:hover{
            color: #f1f1f1;
            background: #014741 !important;
        }
        .page-header .page-header-menu .hor-menu .navbar-nav > li:hover > a {
            background: #014741 !important;
        }
        .dropdown-menu li > a {
            background: #007269 !important;
        }
        .dropdown-menu li > a:hover {
            background: #014741 !important;
        }
        .dropdown-menu li > a > i {
            color: #ced5de !important;
        }
        .hor-menu {
            font-family: DroidKufi, "Helvetica Neue", Helvetica, Arial;
        }
        .page-header .page-header-menu .hor-menu .navbar-nav > li .dropdown-menu li > a {
            font-family: DroidNaskh, "Open Sans", sans-serif;
        }
        .page-header .page-header-top .top-menu .navbar-nav > li.dropdown-dark .dropdown-menu.dropdown-menu-default > li a {
            font-family: DroidNaskh, "Open Sans", sans-serif;
        }

        select.form-control {
            height:36px;
        }
        .img-circle {
            height: 40px;
            width: 40px;
        }
        .page-header {
            background: url("{{asset('assets/layouts/layout3/img/head-background.jpg')}}")
        }
        .page-header .page-header-top {
            height: 90px;
            padding: 10px 0;
        }
        .page-footer {
            color: #60aca6;
            background: #007269;
        }
        .page-header .page-header-menu {
            background: #007269;
        }
        .portlet>.portlet-title>.caption>a {
            text-decoration-line: none;
        }

    </style>
    <link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-md">
<!-- BEGIN HEADER -->
<div class="page-header">
    <!-- BEGIN HEADER TOP -->
    <div class="page-header-top">
        <div class="container">
            <!-- BEGIN LOGO -->
            <div class="head-logo pull-left">
                <a href="{{url('/')}}">
                    <img src="{{asset('assets/layouts/layout3/img/logo_balahmar.png')}}" alt="logo" class="logo-default">
                </a>
            </div>
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler"></a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- END LOGO -->
        </div>
    </div>
    <!-- END HEADER TOP -->
    <!-- BEGIN HEADER MENU -->
    <div class="page-header-menu">
        <div class="container">
            <div class="hor-menu  ">
            </div>
            <!-- END MEGA MENU -->
        </div>
    </div>
    <!-- END HEADER MENU -->
</div>
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->

        <!-- BEGIN PAGE CONTENT BODY -->
        <div class="page-content">
            <div class="container">

                <!-- BEGIN PAGE CONTENT INNER -->
                <div class="page-content-inner">
                    <div class="row">
                        <div class="col-md-12">
                        <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" fa fa-user font-balahmar"></i>
                                        <span class="caption-subject font-balahmar">تفعيل الحساب</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->
                                        {{csrf_field()}}
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p>لقد تجاوزت العدد الأقصى للمحاولة، الرجاء عمل استرجاع كلمة المرور من جديد بعد ساعة من الآن.</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a href="/password/forget" class="btn btn-success pull-right">استرجاع كلمة المرور</a>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <!-- END VALIDATION STATES-->
                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT INNER -->
            </div>
        </div>
        <!-- END PAGE CONTENT BODY -->
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<!-- BEGIN INNER FOOTER -->
<div class="page-footer">
    <div class="container"> &copy; {{date('Y')}} جميع الحقوق محفوظة لمؤسسة بالحمر وعائلته الخيرية.</div>
</div>
<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>
<!-- END INNER FOOTER -->
<!-- END FOOTER -->
<!--[if lt IE 9]>
<script src="{{asset('assets/global/plugins/respond.min.js') }}"></script>
<script src="{{asset('assets/global/plugins/excanvas.min.js') }}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
</body>

</html>
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
    <meta property="og:title" content="بوابة المنح - مؤسسة بالحمر الخيرية" />
    <meta property="og:url" content="https://balahmar-charity.org" />
    <meta property="og:description" content="البوابة الإلكترونية لطلب المنح - مؤسسة سالم بن أحمد بالحمر وعائلته الخيرية">
    <meta property="og:image" content="https://balahmar-charity.org/assets/global/img/balahmar-icon.png">
    <meta property="og:locale" content="ar_SA" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {{--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />--}}
    <link href="{{asset('assets/global/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/plugins/toastr/build/toastr.min.css')}}" rel="stylesheet" type="text/css">

    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    @yield('plugin_styles')
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('assets/global/css/components-md-rtl.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{asset('assets/global/css/plugins-md-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{asset('assets/layouts/layout3/css/layout-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/layouts/layout3/css/themes/default-rtl.min.css')}}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{asset('assets/layouts/layout3/css/custom-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/global/css/custom_abah.css')}}" rel="stylesheet" type="text/css" />
    <style>
        html, body{
            font-family: DroidNaskh;
            height: 100%;
        }
        .page-footer{
            font-family: DroidKufi, DroidNaskh;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0px;
            z-index: 100;
        }
        .page-content{
            background-image: url("{{asset('assets/global/img/background/sayagata-400px.png')}}")!important;
        }
        .page-container-bg-solid{
            background-image: url("{{asset('assets/global/img/background/sayagata-400px.png')}}")!important;
        }
        .font-balahmar{
            color: #007269!important;
        }
        .table.table-light th {
            font-family: DroidKufi, DroidNaskh;
        }
        .caption{
            font-family: DroidKufi;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: DroidKufi !important;
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

        .page-header .page-header-top .top-menu .navbar-nav > li.dropdown-extended .dropdown-menu > li.external > a {
            color: #fffffc;
            font-family: DroidKufi, "Helvetica Neue", Helvetica, Arial;
        }
        .page-header .page-header-top .top-menu .navbar-nav > li.dropdown-extended .dropdown-menu > li.external > a:hover {
            color: #8CD2E5;
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
        .page-header .page-header-menu .hor-menu .navbar-nav > li .dropdown-menu li.active > a{
            background: #014741 !important;
        }
        .page-header .page-header-menu .hor-menu .navbar-nav > li .dropdown-menu li > a {
            background: #007269 !important;
        }
        .page-header .page-header-menu .hor-menu .navbar-nav > li .dropdown-menu li a:hover {
            background: #014741 !important;
        }
        .page-header .page-header-menu .hor-menu .navbar-nav > li .dropdown-menu li > a > i {
            color: #ced5de !important;
        }
        .sweetalert p {
            font-family: DroidNaskh, "Open Sans", sans-serif;
        }
        .label{
            font-family: DroidNaskh, "Open Sans", sans-serif;
        }
        .page-header .page-header-top .top-menu .navbar-nav > li.dropdown-extended .dropdown-menu > li.external > a > h3 {
            font-size: 12px;
            margin: 0;
            color: white;
            padding: 0;
        }

        .page-header .page-header-top .top-menu .navbar-nav > li.dropdown-extended .dropdown-menu > li.external > a > h3:hover {
            background: #007269;
            color: whitesmoke;

        }
        .page-header .page-header-top .top-menu .navbar-nav > li.dropdown-dark .dropdown-menu > li.external {
            background: #007269;
        }
        .page-header .page-header-top .top-menu .navbar-nav > li.dropdown-extended .dropdown-menu::after {
            border-bottom-color: #007269;
        }
        .page-header .page-header-top .top-menu .navbar-nav > li.dropdown.open .dropdown-toggle, .page-header .page-header-top .top-menu .navbar-nav > li.dropdown:active .dropdown-toggle, .page-header .page-header-top .top-menu .navbar-nav > li.dropdown:focus .dropdown-toggle {
            background-color: transparent !important;
        }
        .abah-description {
            white-space: pre-wrap;
            overflow: auto;
            width: 100%;
            padding: 6px 12px;
            border: 1px solid #c2cad8;
            border-radius: 4px;
        }
        @media (max-width: 991px) {
            .page-header .page-header-menu .hor-menu .navbar-nav > li {
                background: none !important;
            }

            .page-header .page-header-top .menu-toggler {
                margin-top: 5px!important;
                margin-bottom: 10px!important;
            }
            img.logo-default {
                width: 160px;
            }
            .page-header .page-header-top .top-menu .navbar-nav > li.dropdown-user .dropdown-toggle > img {
                margin-top: -5px;
                margin-left: 8px;
                height: 30px;
                float: right;
                width: 30px;
            }
            .page-header .page-header-menu > .container {
                padding-bottom: 20px;
            }
            .page-header .page-header-menu .hor-menu .navbar-nav > li .dropdown-menu li > a {
                 background: none !important;
            }
        }
    </style>

    @yield('custom_styles')

    <!-- END THEME LAYOUT STYLES -->
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
                    <img src="{{asset('assets/layouts/layout3/img/logo_header.png')}}" alt="logo" class="logo-default">
                </a>
            </div>
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler"></a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN ADMIN NOTIFICATION DROPDOWN -->
                    @if(Sentinel::getUser()->inRole('admin'))
                        <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="admin_unapproved_offices_notification_bar">
                            <a href="{{url('admin/offices/unapproved')}}" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="fa fa-bank"></i>
                                <span class="badge badge-default" id="admin_unapproved_office_count_badge">{{\App\Libraries\Helpers::unapprovedOffices()->count() > 0 ? \App\Libraries\Helpers::unapprovedOffices()->count() : ''}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    @if(\App\Libraries\Helpers::unapprovedOffices()->count() > 0)
                                        <h3>لديك <strong> {{\App\Libraries\Helpers::unapprovedOffices()->count()}}  جهات </strong>   في انتطار الاعتماد</h3><a href="{{url('admin/offices/unapproved')}}"><h3 class="bold">مشاهدة</h3></a>
                                    @else
                                        <h3>لا توجد جهة في انتظار الاعتماد</h3>
                                    @endif
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="unapproved_projects_notification_bar">
                            <a href="{{url('admin/projects/unapproved')}}" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="fa fa-wrench"></i>
                                @if(\App\Libraries\Helpers::unapprovedProjects()->count() > 0)
                                    <span class="badge badge-default">{{\App\Libraries\Helpers::unapprovedProjects()->count()}}</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    @if(\App\Libraries\Helpers::unapprovedProjects()->count() > 0)
                                        <h3>لديك <span class="bold"> <span id="unapproved_project_count">{{\App\Libraries\Helpers::unapprovedProjects()->count()}}</span>  مشروع </span>   في انتطار الاعتماد</h3><a href="{{url('admin/projects/unapproved')}}"><h3 class="bold">مشاهدة</h3></a>
                                    @else
                                        <h3>لا يوجد مشروع في انتظار الاعتماد</h3>
                                    @endif
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if(!Sentinel::getUser()->inRole('admin'))
                        <li class="dropdown dropdown-extended dropdown-notification dropdown-dark" id="header_notification_bar">
                            <a href="{{url('announcements')}}" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>
                                    @if(\App\Libraries\Helpers::currentUserTotalUnreadAnnouncements() > 0)
                                        <span class="badge badge-default">{{\App\Libraries\Helpers::currentUserTotalUnreadAnnouncements()}}</span>
                                    @endif
                            </a>
                            <ul class="dropdown-menu">
                                <li class="external">
                                    @if(\App\Libraries\Helpers::currentUserTotalUnreadAnnouncements())
                                        <h3>لديك <strong> {{\App\Libraries\Helpers::currentUserTotalUnreadAnnouncements()}}  تعاميم </strong>   غير مقروءة</h3><a href="{{url('announcements')}}"><h3 class="bold">مشاهدة</h3></a>
                                    @else
                                        <h3>لا توجد تعاميم غير مقروءة</h3>
                                    @endif
                                </li>
                            </ul>
                        </li>
                    @endif
                    <!-- END NOTIFICATION DROPDOWN -->
                    <!-- BEGIN MESSAGES DROPDOWN -->
                    <li class="dropdown dropdown-extended dropdown-tasks dropdown-dark" id="header_task_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-envelope"></i>
                            @if(\App\Libraries\Helpers::currentUserTotalUnreadMessages() > 0)
                                <span class="badge badge-default">{{\App\Libraries\Helpers::currentUserTotalUnreadMessages()}}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                @if(\App\Libraries\Helpers::currentUserTotalUnreadMessages() > 0)
                                    <h3>لديك <strong> {{\App\Libraries\Helpers::currentUserTotalUnreadMessages()}}  رسائل </strong>   غير مقروءة</h3><a href="{{url('messages')}}"><h3 class="bold">مشاهدة</h3></a>
                                @else
                                    <h3>لا توجد رسائل غير مقروءة</h3>
                                @endif
                            </li>
                        </ul>
                    </li>
                    <!-- END MESSAGES DROPDOWN -->
                    <li class="droddown dropdown-separator">
                        <span class="separator"></span>
                    </li>
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="{{Sentinel::getUser()->avatar != '' ? asset('files_avatars') . '/' . Sentinel::getUser()->avatar : asset('files_avatars/avatar_blank.jpeg')}}">
                            <span class="username username-hide-mobile">{{Sentinel::getUser()->name}}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{url('/user/edit')}}">
                                    <i class="icon-lock"></i> بياناتي </a>
                            </li>
                            <li>
                                @if(!Sentinel::getUser()->inRole('admin'))
                                    <a href="{{url('/admin/office')}}"><i class="fa fa-bank"></i> جهتي </a>
                                @else
                                    <a href="{{url('/office')}}"><i class="fa fa-bank"></i> جهتي </a>
                                @endif
                            </li>
                            <li>
                                <a href="{{ url('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="icon-key"></i> خروج
                                </a>
                                <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
            <!-- END LOGO -->
        </div>
    </div>
    <!-- END HEADER TOP -->
    <!-- BEGIN HEADER MENU -->
    <div class="page-header-menu">
        <div class="container">
            <div class="hor-menu  ">
                <ul class="nav navbar-nav">
                    @if(!Sentinel::getUser()->inRole('admin'))
                        <li class=" {{Helpers::getCurrentPage() == 'dashboard' ? 'active' : ''}}">
                            <a href="{{url('/')}}"><i class="fa fa-home"></i>  الرئيسية<span class="arrow"></span></a>
                        </li>
                        <li class="{{Helpers::getCurrentPage() == 'offices' ? 'active' : ''}}">
                            <a href="/office"><i class="fa fa-bank"></i>  الجهة التابعة</a>
                        </li>

                        <li class="{{Helpers::getCurrentPage() == 'projects' ? 'active' : ''}}">
                            <a href="/projects"><i class="fa fa-wrench"></i> المشاريع</a>
                        </li>
                        <li class="{{Helpers::getCurrentPage() == 'reports' ? 'active' : ''}}">
                            <a href="/reports"><i class="fa fa-bar-chart"></i> تقارير</a>
                        </li>
                        <li class="{{Helpers::getCurrentPage() == 'announcements' ? 'active' : ''}}">
                            <a href="/announcements"><i class="fa fa-bullhorn"></i> تعاميم</a>
                        </li>
                        <li class="{{Helpers::getCurrentPage() == 'messages' ? 'active' : ''}}">
                            <a href="/messages"><i class="fa fa-envelope"></i> الرسائل الداخلية</a>
                        </li>
                    @endif

                    @if(Sentinel::getUser()->inRole('admin'))
                        <li class="{{Helpers::getCurrentPage() == 'dashboard' ? 'active' : ''}}">
                            <a href="{{url('/admin')}}"><i class="fa fa-home"></i>  الرئيسية<span class="arrow"></span></a>
                        </li>

                        <li class="menu-dropdown classic-menu-dropdown {{Helpers::getCurrentPage() == 'admin-offices-index' | Helpers::getCurrentPage() == 'admin-offices-approved' | Helpers::getCurrentPage() == 'admin-offices-unapproved' | Helpers::getCurrentPage() == 'admin-offices-banned' | Helpers::getCurrentPage() == 'admin-offices-suspended' ? 'active' : ''}}">
                            <a href="javascript:;"><i class="fa fa-bank"></i>  الجهات المستفيدة
                                <span class="arrow"></span>
                            </a>
                            <ul class="dropdown-menu pull-left">
                                <li class="{{Helpers::getCurrentPage() == 'admin-offices-index' ? 'active' : ''}}">
                                    <a href="/admin/offices" class="nav-link  "><i class="fa fa-bank"></i> جميع الجهات</a>
                                </li>
                                <li class="{{Helpers::getCurrentPage() == 'admin-offices-approved' ? 'active' : ''}}">
                                    <a href="/admin/offices/approved" class="nav-link  "><i class="fa fa-gavel"></i> الجهات المعتمدة</a>
                                </li>
                                <li class="{{Helpers::getCurrentPage() == 'admin-offices-unapproved' ? 'active' : ''}}">
                                    <a href="/admin/offices/unapproved" class="nav-link  "><i class="fa fa-warning"></i> تحت انتطار الاعتماد</a>
                                </li>
                                <li class="{{Helpers::getCurrentPage() == 'admin-offices-banned' ? 'active' : ''}}">
                                    <a href="/admin/offices/banned" class="nav-link  "><i class="fa fa-ban"></i> الجهات تم الاعتذار عنها</a>
                                </li>
                                <li class="{{Helpers::getCurrentPage() == 'admin-offices-suspended' ? 'active' : ''}}">
                                    <a href="/admin/offices/suspended" class="nav-link  "><i class="fa fa-stop"></i> الجهات تم إيقاف استقبال المشاريع منها</a>
                                </li>

                            </ul>
                        </li>

                        <li class="menu-dropdown classic-menu-dropdown {{Helpers::getCurrentPage() == 'admin-projects-index' | Helpers::getCurrentPage() == 'admin-projects-approved' | Helpers::getCurrentPage() == 'admin-projects-unapproved' | Helpers::getCurrentPage() == 'admin-projects-banned' | Helpers::getCurrentPage() == 'admin-projects-postponed' | Helpers::getCurrentPage() == 'admin-projects-requested' ? 'active' : ''}}">
                            <a href="javascript:;"><i class="fa fa-wrench"></i>  المشاريع
                                <span class="arrow"></span>
                            </a>
                            <ul class="dropdown-menu pull-left">
                                <li class="{{Helpers::getCurrentPage() == 'admin-projects-index' ? 'active' : ''}}">
                                    <a href="/admin/projects" class="nav-link  "><i class="fa fa-wrench"></i> جيمع المشاريع</a>
                                </li>
                                <li class="{{Helpers::getCurrentPage() == 'admin-projects-approved' ? 'active' : ''}}">
                                    <a href="/admin/projects/approved" class="nav-link  "><i class="fa fa-gavel"></i> المشاريع المعتمدة</a>
                                </li>
                                <li class="{{Helpers::getCurrentPage() == 'admin-projects-unapproved' ? 'active' : ''}}">
                                    <a href="/admin/projects/unapproved" class="nav-link  "><i class="fa fa-warning"></i> تحت انتطار الاعتماد</a>
                                </li>
                                <li class="{{Helpers::getCurrentPage() == 'admin-projects-banned' ? 'active' : ''}}">
                                    <a href="/admin/projects/banned" class="nav-link  "><i class="fa fa-ban"></i> المشاريع تم الاعتذار عنها</a>
                                </li>
                                <li class="{{Helpers::getCurrentPage() == 'admin-projects-postponed' ? 'active' : ''}}">
                                    <a href="/admin/projects/postponed" class="nav-link  "><i class="fa fa-clock-o"></i> المشاريع المؤجلة</a>
                                </li>
                                <li class="{{Helpers::getCurrentPage() == 'admin-projects-requested' ? 'active' : ''}}">
                                    <a href="/admin/projects/requested" class="nav-link  "><i class="fa fa-shopping-cart"></i> المشاريع التي طلب منها طلبات</a>
                                </li>


                            </ul>
                        </li>

                        <li class="{{Helpers::getCurrentPage() == 'reports' ? 'active' : ''}}">
                            <a href="/admin/reports" class="nav-link  "><i class="fa fa-bar-chart"></i>  التقارير</a>
                        </li>
                        <li class="{{Helpers::getCurrentPage() == 'announcements' ? 'active' : ''}}">
                            <a href="/admin/announcements"><i class="fa fa-bullhorn"></i> تعميميات</a>
                        </li>
                        <li class="{{Helpers::getCurrentPage() == 'messages' ? 'active' : ''}}">
                            <a href="/admin/messages"><i class="fa fa-envelope"></i> الرسائل الداخلية</a>
                        </li>
                        <li class="{{Helpers::getCurrentPage() == 'sms' ? 'active' : ''}}">
                            <a href="/admin/sms"><i class="fa fa-mobile"></i> رسائل الجوال</a>
                        </li>

                        <li class="menu-dropdown classic-menu-dropdown {{Helpers::getCurrentPage() == 'admin-users-users' | Helpers::getCurrentPage() == 'admin-users-groups' ? 'active' : ''}}">
                            <a href="javascript:;"><i class="fa fa-shield"></i> إدارة المستخدمين
                                <span class="arrow"></span>
                            </a>
                            <ul class="dropdown-menu pull-left">
                                <li class="{{Helpers::getCurrentPage() == 'admin-users-users' ? 'active' : ''}}">
                                    <a href="/admin/users" class="nav-link  "><i class="fa fa-user"></i> المستخدمون</a>
                                </li>
                                <li class="{{Helpers::getCurrentPage() == 'admin-users-groups' ? 'active' : ''}}">
                                    <a href="/admin/groups" class="nav-link  "><i class="fa fa-users"></i> المجموعات</a>
                                </li>

                            </ul>
                        </li>

                    @endif
                </ul>
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
        @yield('breadcrumb')
        <!-- BEGIN PAGE CONTENT BODY -->
        <div class="page-content">
            <div class="container">
                <!-- BEGIN PAGE CONTENT INNER -->
                <div class="page-content-inner">
                    @yield('content')
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
    <div class="container"> &copy; {{date('Y', time())}} جميع الحقوق محفوظة لمؤسسة بالحمر الخيرية.</div>
</div>
<div class="scroll-to-top">
    <i class="icon-arrow-up"></i>
</div>
<!-- END INNER FOOTER -->
<!-- END FOOTER -->
<!--[if lt IE 9]>
<script src="{{asset('assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/excanvas.min.js')}}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/sweetalert/sweetalert-dev.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/toastr/build/toastr.min.js')}}"></script>

<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
@include('Flash')
@yield('plugin_scripts')
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets/global/scripts/app.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/layouts/layout3/scripts/admin_main.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
@yield('page_scripts')
<!-- END PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/layouts/layout3/scripts/layout.min.js')}}" type="text/javascript"></script>
{!! Toastr::message() !!}
</body>

</html>
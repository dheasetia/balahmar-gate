<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.6
Version: 4.5.6
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
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
    <link href="{{asset('assets/global/plugins/bootstrap/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{asset('assets/global/css/components-md-rtl.css')}}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{asset('assets/global/css/plugins-md-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{asset('assets/pages/css/login-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL STYLES -->
    <style>
        .login {
            background-image: url({{asset('assets/global/img/background/sayagata-400px.png')}});
            font-family: DroidNaskh, "Open Sans", sans-serif;
            background-color: #ffffff!important;
        }
        .login .content {
            background-color: #007269!important ;
        }

        .login .content .rememberme {
            color: #ffffff!important;
        }

        .login .content .forget-password {
            color: #ffffff!important;
        }

        h3.form-title {
            font-family: DroidKufi, "Helvetica Neue", Helvetica, Arial !important;
            color: #ffffff!important;
            font-size: 14pt!important;
        }

        .login .content .form-control {
            background-color: #ffffff!important;
        }

        .login .content .create-account {
            font-family: DroidKufi, "Helvetica Neue", Helvetica, Arial;
            background-color: #02423d!important;
            color: #ffffff!important;
            margin-top: 25px;
        }
        .login .content .form-actions {
            border-bottom: 0!important;
        }
        .mt-radio.mt-radio-outline:hover > input:checked:not([disabled]) ~ span, .mt-radio.mt-radio-outline > input:checked ~ span, .mt-radio.mt-checkbox-outline:hover > input:checked:not([disabled]) ~ span, .mt-radio.mt-checkbox-outline > input:checked ~ span, .mt-checkbox.mt-radio-outline:hover > input:checked:not([disabled]) ~ span, .mt-checkbox.mt-radio-outline > input:checked ~ span, .mt-checkbox.mt-checkbox-outline:hover > input:checked:not([disabled]) ~ span, .mt-checkbox.mt-checkbox-outline > input:checked ~ span {
            background-color: white;
        }
        .judul h2 {
            font-family: DroidKufi, "Helvetica Neue", Helvetica, Arial;
            text-align: center;
            color: #007269;
            font-weight: bold;
        }
    </style>
    <link rel="shortcut icon" href="{{url('favicon.ico')}}" />
</head>
<!-- END HEAD -->

<body class=" login">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="{{url('/')}}">
        <img src="{{asset('assets/layouts/layout3/img/logo_balahmar.png')}}" alt="" /> </a>
</div>
<!-- END LOGO -->
<div class="judul">
    <h2>البـوابـة الإلـكـترونـية</h2>
</div>
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form role="form" action="{{url('/login')}}" class="login-form" method="POST" accept-charset="utf-8">
        {{csrf_field()}}
    <h3 class="form-title">تسجيل الدخول</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> البريد الإلكتروني وكلمة المرور غير صحيحة.</span>
        </div>
        @if(session('message') != '')
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span>البريد الإلكتروني وكلمة المرور غير صحيحة. </span>
            </div>
        @endif
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">البريد الإلكتروني</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="email" placeholder="البريد الإلكتروني" name="email" autofocus/>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">كلمة المرور</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="كلمة المرور" name="password" /> </div>
        <div class="form-actions">
            <label class="rememberme check mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="remember" value="1" />تذكرني
                <span></span>
            </label>
            <a href="{{url('/password/forget')}}" id="forget-password" class="forget-password">نسيت كلمة المرور؟</a>
        </div>
        <div class="submit-button">
            <button type="submit" class="btn default btn-block">دخول</button>
        </div>
        <div class="create-account">
            <p>
                <a href="{{url('/register')}}" id="register-btn" class="uppercase">إنشاء حساب جديد</a>
            </p>
        </div>
    </form>
    <!-- END LOGIN FORM -->
</div>
<div class="copyright"> &copy; {{date('Y', time())}} جميع الحقوق محفوظة لمؤسسة بالحمر الخيرية </div>
<!--[if lt IE 9]>
<script src="{{asset('assets/global/plugins/respond.min.js')}}"></script>
<script src="{{asset('assets/global/plugins/excanvas.min.js')}}"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="{{asset('assets/global/plugins/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/js.cookie.min.js')}}" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="{{asset('assets/global/scripts/app.min.js')}}" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/layouts/layout3/scripts/login.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>
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
        }
        .caption{
            font-family: DroidKufi;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: DroidKufi;
        }
    </style>
    <link rel="shortcut icon" href="favicon.ico" /> </head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-md">
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
                    <div class="m-heading-1 border-green m-bordered">
                        <h3>بيانات الحساب</h3>
                        <p>قبل المشاركة في بوابة المنح لمؤسسة بالحمر وعائلته الخيرية، الرجاء عمل تسجيل حساب العضوية ومن ثم يمكنكم تقديم الجهة التابعة لك. الرجاء حفظ بيانات ليتسنى لك الدخول بالبرنامج.</p>
                        <p>خطوات تقديم المنح من المؤسسة:</p>
                        <ul>
                            <li>تسجيل حساب العضوية </li>
                            <li>تقديم بيانات الجهة</li>
                            <li>الحصول على الموافقة من لجنة المؤسسة</li>
                            <li>تقديم مشروع للحصول على المنح</li>
                            <li>موافقة اللجنة على تقديم المنح</li>
                            <li>تقديم التقرير من قبل الجهة المستفيدةالقائمة على المشروع</li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN VALIDATION STATES-->
                            <div class="portlet light portlet-fit portlet-form ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" fa fa-user font-green"></i>
                                        <span class="caption-subject font-green">تسجيل عضوية</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-cloud-upload"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-wrench"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <!-- BEGIN FORM-->
                                    <form action="#" class="form-horizontal" id="form_sample_1">
                                        <div class="form-body">
                                            <div class="alert alert-danger display-hide">
                                                <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                            <div class="alert alert-success display-hide">
                                                <button class="close" data-close="alert"></button> Your form validation is successful! </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input {{$errors->has('name') ? 'has-error' : ''}}">
                                                        <label class="col-md-4 control-label" for="name">الاسم <span class="required">*</span></label>
                                                        <div class="col-md-8">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-user"></i>
                                                                </span>
                                                                <input type="text" class="form-control" name="name" placeholder="الاسم الكامل">
                                                                <div class="form-control-focus"> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input {{$errors->has('email') ? 'has-error' : ''}}">
                                                        <label class="col-md-4 control-label" for="email">البريد الإلكتروني<span class="required">*</span></label>
                                                        <div class="col-md-8">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-envelope"></i>
                                                                </span>
                                                                <input type="email" class="form-control" name="email" placeholder="">
                                                                <div class="form-control-focus"> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input {{$errors->has('mobile') ? 'has-error' : ''}}">
                                                        <label class="col-md-4 control-label" for="mobile">رقم الجوال <span class="required">*</span></label>
                                                        <div class="col-md-8">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-mobile"></i>
                                                                </span>
                                                                <input type="text" class="form-control" name="mobile" placeholder="">
                                                                <div class="form-control-focus"> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input {{$errors->has('national_id') ? 'has-error' : ''}}">
                                                        <label class="col-md-4 control-label" for="national_id">رقم الهوية الوطنية<span class="required">*</span></label>
                                                        <div class="col-md-8">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-credit-card"></i>
                                                                </span>
                                                                <input type="text" class="form-control" name="national_id" placeholder="">
                                                                <div class="form-control-focus"> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input {{$errors->has('password') ? 'has-error' : ''}}">
                                                        <label class="col-md-4 control-label" for="password">كلمة المرور <span class="required">*</span></label>
                                                        <div class="col-md-8">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-lock"></i>
                                                                </span>
                                                                <input type="password" class="form-control" name="password" placeholder="">
                                                                <div class="form-control-focus"> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group form-md-line-input {{$errors->has('password_confirmation') ? 'has-error' : ''}}">
                                                        <label class="col-md-4 control-label" for="password_confirmation">تأكيد كلمة المرور<span class="required">*</span></label>
                                                        <div class="col-md-8">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="fa fa-lock"></i>
                                                                </span>
                                                                <input type="password" class="form-control" name="password_confirmation" placeholder="">
                                                                <div class="form-control-focus"> </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row pull-right">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn green"> <i class="fa fa-save"></i> تسجيل</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
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
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="../assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="../assets/pages/scripts/form-validation-md.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
@extends('layouts.main')

@section('plugin_styles')
    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <style>
        body{
            font-family: DroidNaskh;
        }

        .caption{
            font-family: DroidKufi;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: DroidKufi;
        }
        .select2-container--bootstrap .select2-selection--single .select2-selection__rendered {
            font-family: DroidNaskh, "Open Sans", sans-serif;
        }
        .photo {
            width: 100%;
        }
        .photo img {
            margin: 30px auto;
            width: 130px;
            height: 130px;
            -webkit-border-radius: 50% !important;
            -moz-border-radius: 50% !important;
            border-radius: 50% !important;
        }
        .img-responsive{
            display: block;
        }
    </style>
@endsection

@section('content')
    <div class="col-md-12">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form ">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" fa fa-user font-green"></i>
                    <span class="caption-subject font-green">بيانات شخصية</span>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form action="{{url('/user')}}" method="post" class="form-horizontal" id="form_user_edit"
                      accept-charset="UTF-8" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-body">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>يوجد أخطاء، الرجاء تصحيح بياناتك.
                        </div>
                        <div class="row text-center">
                            <div class="col-md-12">
                                <div class="photo">
                                    <img src="{{$user->avatar == '' ? asset('/files_avatars/avatar_blank.jpeg') : asset('/files_avatars' . '/' . $user->avatar) }}" alt="" class="img-responsive">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input {{$errors->has('name') ? 'has-error' : ''}}">
                                    <label class="col-md-4 control-label" for="name">الاسم <span
                                                class="required">*</span></label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   placeholder="الاسم الكامل" value="{{old('name', $user->name)}}">
                                            <div class="form-control-focus"></div>
                                            @if($errors->has('name'))
                                                <div class="help-block help-block-error">{{$errors->first('name')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input {{$errors->has('email') ? 'has-error' : ''}}">
                                    <label class="col-md-4 control-label" for="email">البريد الإلكتروني<span
                                                class="required">*</span></label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                            <input type="text" class="form-control" id="email" name="email"
                                                   value="{{old('email', $user->email)}}" placeholder="">
                                            <div class="form-control-focus"></div>
                                            @if($errors->has('email'))
                                                <div class="help-block help-block-error">{{$errors->first('email')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input {{$errors->has('mobile') ? 'has-error' : ''}}">
                                    <label class="col-md-4 control-label" for="mobile">رقم الجوال <span
                                                class="required">*</span></label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-mobile"></i>
                                            </span>
                                            <input type="text" class="form-control" id="mobile" name="mobile"
                                                   value="{{old('mobile', $user->mobile)}}" placeholder="">
                                            <div class="form-control-focus"></div>
                                            @if($errors->has('mobile'))
                                                <div class="help-block help-block-error">{{$errors->first('mobile')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input {{$errors->has('national_id') ? 'has-error' : ''}}">
                                    <label class="col-md-4 control-label" for="national_id">رقم الهوية الوطنية<span
                                                class="required">*</span></label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-credit-card"></i>
                                            </span>
                                            <input type="text" class="form-control" id="national_id" name="national_id"
                                                   value="{{old('national_id', $user->national_id)}}" placeholder="">
                                            <div class="form-control-focus"></div>
                                            @if($errors->has('national_id'))
                                                <div class="help-block help-block-error">{{$errors->first('national_id')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input {{$errors->has('password') ? 'has-error' : ''}}">
                                    <label class="col-md-4 control-label" for="password">كلمة المرور <span
                                                class="required">*</span></label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="password" name="password"
                                                   placeholder="">
                                            <div class="form-control-focus"></div>
                                            @if($errors->has('password'))
                                                <div class="help-block help-block-error">{{$errors->first('password')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input {{$errors->has('password_confirmation') ? 'has-error' : ''}}">
                                    <label class="col-md-4 control-label" for="password_confirmation">تأكيد كلمةالمرور<span class="required">*</span></label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="password_confirmation"
                                                   name="password_confirmation" placeholder="">
                                            <div class="form-control-focus"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="password_confirmation">&nbsp;</label>
                                    <div class="col-md-8">
                                        <div>اترك الحقل فارغا إذا لم ترد التغيير. </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="col-md-4 control-label">صورة شخصية</label>
                                    <div class="col-md-8">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                                 style="width: 200px; height: 150px;"></div>
                                            <div>
                                                <span class="btn blue-chambray btn-file">
                                                    <span class="fileinput-new"> اختيار صورة </span>
                                                    <span class="fileinput-exists"> تغيير </span>
                                                    <input type="file" name="avatar">
                                                </span>
                                                <a href="javascript;" class="btn red fileinput-exists"
                                                   data-dismiss="fileinput"> حذف </a>
                                            </div>
                                        </div>
                                        <div class="clearfix margin-top-20">
                                            <span class="bold">تنبيه ! </span> الرجاء اختيار الصورة بالمحاذاة المناسب وبحجم الملف لا يزيد عن ٢ ميغا.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row pull-right">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green"><i class="fa fa-save"></i> حفظ</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
@endsection

@section('plugin_scripts')
    <script src="{{ asset('assets/global/plugins/bootbox/bootbox_abah_modified.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/registration.js') }}" type="text/javascript"></script>
@endsection
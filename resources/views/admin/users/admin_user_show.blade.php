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
    <div class="modal fade" id="user_access_modal" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="/admin/users/assign">
                    {{csrf_field()}}
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">تعيين صلاحية المستخدم</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group form-md-radios">
                            <label>اختر الصلاحية:</label>

                            <div class="md-radio-list">
                                @if(count($roles) > 0)
                                    @foreach($roles as $role)
                                        <div class="md-radio">
                                            <input type="radio" id="radio-{{$role->slug}}" name="role" value="{{$role->id}}" class="md-radiobtn" checked>
                                            <label for="radio-{{$role->slug}}">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span> {{$role->name}} </label>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn green">حفظ</button>
                    </div>

                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-form ">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" fa fa-bank font-balahmar"></i>
                    @if(count($user->office) > 0)
                        <span class="caption-subject font-balahmar">الجهة التابعة: <strong><a href="{{url('admin/offices', $user->office->id)}}">{{$user->office->name}}</a></strong></span>
                    @else
                        <span class="caption-subject font-balahmar">الجهة التابعة: <strong>لا توجد</strong></span>
                    @endif
                </div>
            </div>
        </div>
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form ">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" fa fa-user font-balahmar"></i>
                    <span class="caption-subject font-balahmar">بيانات شخصية</span>
                </div>
                <div class="actions">
                    <a href="{{url('admin/users')}}" class="btn btn-default btn-circle btn-icon-only tooltips" data-original-title="عودة لقائمة المستخدمين"><i class="fa fa-undo"></i></a>
                    <button data-toggle="modal" data-target="#user_access_modal" class="btn btn-default btn-circle btn-icon-only tooltips" data-original-title="تحديد الصلاحية"><i class="fa fa-shield"></i></button>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form class="form-horizontal">
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
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-4 control-label">الاسم</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-user"></i>
                                            </span>
                                            <p class="form-control">{{$user->name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-4 control-label" for="email">البريد الإلكتروني</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                            <p class="form-control">{{$user->email}}</p>
                                            <div class="form-control-focus"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-4 control-label">رقم الجوال </label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-mobile"></i>
                                            </span>
                                            <p class="form-control">{{$user->mobile}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-4 control-label">رقم الهوية الوطنية</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-credit-card"></i>
                                            </span>
                                            <p class="form-control">{{$user->national_id}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-4 control-label">الصلاحية </label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-shield"></i>
                                            </span>
                                            <p class="form-control">{{$user->roles->first()->name or 'عادي'}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>

    </div>
@endsection

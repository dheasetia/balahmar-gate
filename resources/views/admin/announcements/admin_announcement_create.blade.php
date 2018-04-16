@extends('layouts.main')

@section('plugin_styles')
    <link href="{{asset('assets/global/plugins/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" fa fa-bullhorn font-balahmar"></i>
                        <span class="caption-subject font-balahmar">إنشاء إشعار جديد</span>
                    </div>
                    <div class="actions">
                        <a href="/admin/announcements" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="عودة لقائمة الإشعارات"><i class="fa fa-list"></i></a>
                    </div>
                </div>

                <div class="portlet-body form">
                    <form action="/admin/announcements" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="form_announcement_create" role="form" class="form-horizontal form-bordered form-row-stripped">
                        {{csrf_field()}}
                        <div class="form-body form">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="hijri_created" class="control-label col-md-2">التاريخ</label>
                                    <div class="col-md-10">
                                        <input type="text" name="hijri_created" class="form-control" id="hijri_created" readonly/>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('subject') ? 'has-error' : ''}}">
                                    <label for="subject" class="control-label col-md-2"> الموضوع  <span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" name="subject" class="form-control" id="subject" value="{{old('subject')}}" autofocus/>
                                        @if($errors->has('subject'))
                                            <div class="help-block help-block-error">{{$errors->first('subject')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                                    <label for="subject" class="control-label col-md-2"> نص الإشعار  <span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <textarea id="summernote" class="form-control" name="body"></textarea>
                                        @if($errors->has('body'))
                                            <div class="help-block help-block-error">{{$errors->first('body')}}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">المرفق</label>
                                    <div class="col-md-3">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="input-group input-large">
                                                <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                    <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                    <span class="fileinput-filename"> </span>
                                                </div>
                                                <span class="input-group-addon btn default btn-file">
                                                                    <span class="fileinput-new"> اختيار الملف </span>
                                                                    <span class="fileinput-exists"> تغيير </span>
                                                                    <input type="file" name="attachment"> </span>
                                                <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> إزالة </a>
                                            </div>
                                        </div>
                                        <span class="help-block">بصيغة pdf بالحجم لا يزيد عن ١٠ ميغا.</span>
                                        @if($errors->has('attachment'))
                                            <div class="help-block help-block-error">{{$errors->first('attachment')}}</div>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-2">
                                        <p style="text-align: left">المرسل إليهم <span class="required">*</span></p>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="row" style="padding-right: 20px;">
                                            <div class="mt-radio-list col-md-3">
                                                <label class="mt-radio"> الكل
                                                    <input value="all" name="user_group" data-slug="all" class="users" type="radio" checked>
                                                    <span></span>
                                                </label>
                                            </div>
                                            @if(count($groups) > 0)
                                                @foreach($groups as $group)
                                                    <div class="mt-radio-list col-md-3">
                                                        <label for="{{$group->slug}}" class="mt-radio"> {{$group->name}}
                                                            <input id="{{$group->slug}}" data-slug="{{$group->slug}}" class="user_group" value="{{$group->id}}"  name="user_group" type="radio">
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="row" style="padding-right: 20px;">
                                            @if(count($users) > 0)
                                                @foreach($users as $user)
                                                    @if($user->id != Sentinel::getUser()->id)
                                                        <div class="mt-checkbox-list col-md-12">
                                                            <label for="user-{{$user->id}}" class="mt-checkbox mt-checkbox-outline"> {{$user->name}} (<strong>{{$user->office != null ? $user->office->name : '---'}}</strong>)
                                                                <input id="user-{{$user->id}}" value="{{$user->id}}" name="recipients[]" data-group="@foreach($user->groups as $user_group) {{'"' . $user_group->slug . '",'}} @endforeach" class="user_checkbox"  type="checkbox" checked>
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green pull-right"><i class="fa fa-bullhorn"></i>  نشر</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('plugin_scripts')
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.plus.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.ummalqura.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.ummalqura-ar.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/summernote/dist/summernote.js')}}"></script>
    <script src="{{asset('assets/global/plugins/summernote/dist/lang/summernote-ar-AR.js')}}"></script>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/admin_announcement_create.js')}}"></script>
@endsection
@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-envelope font-balahmar"></i>
                        <span class="caption-subject bold font-balahmar uppercase"> رسائل الجوال</span>
                        <span class="caption-helper">إنشاء رسالة جديدة</span>
                    </div>
                    <div class="actions">
                        <a href="/admin/sms" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="عودة لقائمة الرسائل"><i class="fa fa-list"></i></a>
                    </div>
                </div>

                <div class="portlet-body form">
                    <form action="/admin/sms" method="post" accept-charset="utf-8" id="form_message_create" role="form" class="form-horizontal form-bordered form-row-stripped">
                        {{csrf_field()}}
                        <div class="form-body form">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="hijri_created" class="control-label col-md-2">التاريخ</label>
                                    <div class="col-md-2">
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
                                <div class="form-group {{$errors->has('text') ? 'has-error' : ''}}">
                                    <label for="sms_text" class="control-label col-md-2"> نص الرسالة  <span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <span class="help-block">الرصيد المتوفر حاليا: {{$credit or '0'}} نقطة</span>
                                        <textarea id="sms_text" rows="4" class="form-control" name="text">{{old('text')}}</textarea>
                                    @if($errors->has('text'))
                                            <div class="help-block help-block-error">{{$errors->first('text')}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sms_text" class="control-label col-md-2"> تعداد الأحرف<span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <p>الأحرف المستخدمة: <span class="font-balahmar bold" id="characters">0</span> حرف</p>
                                        <p>الرسالة: <span class="font-balahmar bold" id="point">1</span>  رسالة</p>
                                        <p>يخصم من الرصيد: <span class="font-balahmar bold" id="discounted">1</span> نقطة</p>
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
                                                    <input value="all" name="user_group" data-slug="all" class="users" type="radio" >
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="mt-radio-list col-md-3">
                                                <label class="mt-radio"> إلغاء الكل
                                                    <input value="none" name="user_group" data-slug="none" class="users" type="radio">
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
                                        @if($errors->has('recipients'))
                                            <div class="font-red" style="padding-right: 20px">{{$errors->first('recipients')}}</div>
                                        @endif
                                        <div class="font-red display-hide" id="no_user_selected_warning" style="padding-right: 20px">يجب أن تختار واحدا على الأقل من المرسل إليهم</div>
                                        <hr>
                                        <div class="row" style="padding-right: 20px;">
                                            @if(count($users) > 0)
                                                @foreach($users as $user)
                                                    @if($user->id != Sentinel::getUser()->id)
                                                        <div class="mt-checkbox-list col-md-12">
                                                            <label for="user-{{$user->id}}" class="mt-checkbox mt-checkbox-outline"> {{$user->name}} (<strong>{{$user->office != null ? $user->office->name : '---'}}</strong>)
                                                                <input id="user-{{$user->id}}" value="{{$user->id}}" name="recipients[]" data-group="@foreach($user->groups as $user_group) {{'"' . $user_group->slug . '",'}} @endforeach" class="user_checkbox"  type="checkbox" >
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
                                        <button type="submit" class="btn green pull-right"><i class="fa fa-paper-plane"></i>  إرسال</button>
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
    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.plus.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.ummalqura.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.ummalqura-ar.js')}}" type="text/javascript"></script>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/admin_sms_create.js')}}"></script>
@endsection
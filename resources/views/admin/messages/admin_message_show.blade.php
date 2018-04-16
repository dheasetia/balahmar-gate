@extends('layouts.main')

@section('plugin_styles')
    <link href="{{asset('assets/global/plugins/summernote/dist/summernote.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .portlet-body .title{
            margin: 20px !important;
            border: 1px solid whitesmoke;
            border-radius: 10px;
            padding: 10px;
            background: #f0f9f9;
        }
        .portlet-body .title h5 {
            display: inline-block;
        }
        .portlet-body .title>span{
            display: inline-block;
            float: left;
            padding: 10px;
        }
        .photo img {
            width: 30px;
            height: 30px;
            -webkit-border-radius: 50% !important;
            -moz-border-radius: 50% !important;
            border-radius: 50% !important;
        }
        .timeline-badge .timeline-badge-userpic {
            height: 80px;
        }
        .timeline-body-title{
            font-family: DroidKufi, "Helvetica Neue", Helvetica, Arial;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-envelope font-balahmar"></i>
                        <span class="caption-subject bold font-balahmar uppercase"> الرسائل الداخلية</span>
                        <span class="caption-helper">مشاهدة رسالة</span>
                    </div>
                    <div class="actions">
                        <a href="/admin/messages" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="عودة لقائمة الرسائل"><i class="fa fa-list"></i></a>
                        <a href="{{url('/admin/messages', $message_id)}}" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="تحديث"><i class="fa fa-refresh"></i></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="timeline">
                        @foreach($messages as $message)
                        <!-- TIMELINE ITEM -->
                        <div class="timeline-item">
                            <div class="timeline-badge">
                                <img class="timeline-badge-userpic" src="{{$message->creator->avatar != '' ? asset('files_avatars') . '/' . $message->creator->avatar : asset('files_avatars/avatar_blank.jpeg')}}"> </div>
                            <div class="timeline-body">
                                <div class="timeline-body-arrow"> </div>
                                <div class="timeline-body-head">
                                    <div class="timeline-body-head-caption">
                                        @if($message->creator->id == Sentinel::getUser()->id)
                                            <span class="timeline-body-title font-blue-chambray">{{$message->creator->name}}  (أنت)</span>
                                            <h5>الجهة: {{$message->creator->office->name or '---'}}</h5>
                                        @else
                                            <span class="timeline-body-title font-blue-madison"><a href="{{url('admin/users', $message->creator->id)}}" class="tooltips" data-original-title="تفاصيل الشخص">{{$message->creator->name}}</a></span>
                                            <h5><a href="{{url('admin/offices', $message->creator->office->id)}}" class="tooltips" data-original-title="تفاصيل الجهة">الجهة: {{$message->creator->office->name or '---'}}</a></h5>
                                        @endif

                                    </div>
                                </div>
                                <div class="timeline-body-head-actions">
                                    <span class="font-grey-cascade">{{DateDiff::inArabic($message->created_at)}} ({{$message->created_at->format('Y/m/d - H:i')}})</span>
                                </div>
                                <br>
                                <div class="timeline-body-content">
                                    <span class="font-grey-cascade"><h4 class="bold">{{$message->subject or '(بدون عنوان)'}}</h4></span>
                                    <span class="font-grey-cascade">{!! $message->body !!}</span>
                                </div>
                                @if($message->attachment != '')
                                    <div class="pull-right">
                                        <a href="{{asset('files_messages') . '/' . $message->attachment}}" class="tooltips" data-original-title="مرفقات" target="_blank"><i class="fa fa-paperclip"></i></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- END TIMELINE ITEM -->
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-upload font-balahmar"></i>
                        <span class="caption-subject bold font-balahmar"> إضافة رسالة</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    @if($errors)
                        <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                        </ul>
                    @endif
                    <form action="/admin/messages" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="form_message_create" role="form" class="form-horizontal form-bordered form-row-stripped">
                        {{csrf_field()}}
                        <div class="form-body form">
                            <div class="form-body">
                                <input type="hidden" name="parent_id" value="{{$messages[0]->id}}">
                                <div class="form-group hidden">
                                    <label for="hijri_created" class="control-label col-md-2">التاريخ</label>
                                    <div class="col-md-10">
                                        <input type="text" name="hijri_created" class="form-control" id="hijri_created" readonly/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="subject" class="control-label col-md-2"> الموضوع  <span class="required">*</span></label>
                                    <div class="col-md-10">
                                        <input type="text" name="subject" class="form-control" id="subject" value="{{$messages[0]->subject or 'بدون عنوان'}}"/>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('body') ? 'has-error' : ''}}">
                                    <label for="subject" class="control-label col-md-2"> نص الرسالة  <span class="required">*</span></label>
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
                                <div class="mt-checkbox-list hidden">
                                    <input id="user-{{array_last($messages)->creator_id}}" value="{{array_last($messages)->creator_id}}" name="recipients[]"  type="checkbox" checked>
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
    <br><br><br><br><br>
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
    <script src="{{asset('assets/layouts/layout3/scripts/admin_message_show.js')}}"></script>
@endsection

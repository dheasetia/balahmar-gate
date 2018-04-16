@extends('layouts.main')

@section('plugin_styles')
    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-pie-chart font-balahmar"></i>
                <span class="caption-subject font-balahmar bold">تعديل بيانات التقرير</span>
            </div>
        </div>
        <div class="portlet-body form">
            @if(count($projects) == 0)
                <div class="alert alert-danger">
                    <strong>عذرا !!</strong>لا يمكن لك رفع التقرير لعدم وجود مشروع تمت الموافقة عليه من اللجنة.
                    <a href="{{url('reports')}}" class="alert-link pull-right"> عودة </a>
                </div>
            @else
                @if(count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                @endif
            <!-- BEGIN FORM-->
                <form action="{{url('/reports', $report->id)}}" method="post" class="form-horizontal form-bordered form-row-stripped" id="form_edit_report" accept-charset="utf-8" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('patch')}}
                    <div class="form-body">
                        <div class="form-group {{$errors->has('hijri_created') ? 'has-error' : ''}}">
                            <label for="hijri_created" class="control-label col-md-3"> تاريخ التقرير  <span class="required">*</span></label>
                            <div class="col-md-2">
                                <input type="text" name="hijri_created" class="form-control" id="hijri_created" value="{{old('hijri_created', $report->hijri_created)}}" readonly/>
                                <div class="help-block">تلقائي</div>
                                @if($errors->has('hijri_created'))
                                    <div class="help-block help-block-error">{{$errors->first('hijri_created')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('project_id') ? 'has-error' : ''}}">
                            <label class="control-label col-md-3" for="project_id"> اسم المشروع <span class="required">*</span></label>
                            <div class="col-md-9">
                                <select class="form-control" name="project_id" id="project_id" >
                                    <option value="">اختيار</option>
                                    @foreach($projects as $project)
                                        <option value="{{$project->id}}" {{old('project_id', $project->id) == $project->id ? 'selected' : ''}}>{{$project->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('project_id'))
                                    <div class="help-block help-block-error">{{$errors->first('project_id')}}</div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('nth') ? 'has-error' : ''}}">
                            <label for="nth" class="control-label col-md-3"> تقرير للمرحلة <span class="required">*</span></label>
                            <div class="col-md-2">
                                <select name="nth" class="form-control" id="nth">
                                    @for($i = 1 ; $i < 6; $i++)
                                        <option value="{{$i}}" {{old('nth', $report->nth) == $i ? 'selected' : ''}}>{{$i}}</option>
                                    @endfor
                                </select>
                                <div class="help-block help-block-error">{{$errors->first('nth')}}</div>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('hijri_report_from') ? 'has-error' : ''}}">
                            <label for="hijri_report_from" class="control-label col-md-3"> تاريخ الفترة من <span class="required">*</span></label>
                            <div class="col-md-2">
                                <input type="text" name="hijri_report_from" class="form-control" id="hijri_report_from" value="{{old('hijri_report_from', $report->hijri_report_from)}}"/>
                                @if($errors->has('hijri_report_from'))
                                    <div class="help-block help-block-error">{{$errors->first('hijri_report_from')}}</div>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="report_from" class="form-control" id="report_from" value="{{old('report_from', $report->report_from->format('d/ m/ Y'))}}" readonly/>
                                <div class="help-block">تلقائي</div>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('hijri_report_to') ? 'has-error' : ''}}">
                            <label for="hijri_report_to" class="control-label col-md-3"> لغاية <span class="required">*</span></label>
                            <div class="col-md-2">
                                <input type="text" name="hijri_report_to" class="form-control" id="hijri_report_to" value="{{old('hijri_report_to', $report->hijri_report_to)}}"/>
                                @if($errors->has('hijri_report_to'))
                                    <div class="help-block help-block-error">{{$errors->first('hijri_report_to')}}</div>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input type="text" name="report_to" class="form-control" id="report_to" value="{{old('report_to', $report->report_to->format('d/ m/ Y'))}}" readonly/>
                                <div class="help-block">تلقائي</div>
                            </div>
                        </div>

                        <div class="form-group {{$errors->has('video_link') ? 'has-error' : ''}}">
                            <label for="video_link" class="control-label col-md-3"> رابط فيديو</label>
                            <div class="col-md-9">
                                <input type="text" name="video_link" class="form-control" id="video_link" value="{{old('video_link', $report->video_link)}}"/>
                                @if($errors->has('video_link'))
                                    <div class="help-block help-block-error">{{$errors->first('video_link')}}</div>
                                @endif
                                <span class="help-block">إذا كان لديك مقطع فيديو عن المشروع، ضع الرابط هنا</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">ملف التقرير</label>
                            <div class="col-md-9">
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-file-pdf-o"></i>ملف التقرير </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="expand" data-original-title="" title=""> </a>
                                            <a href="" class="fullscreen" data-original-title="" title=""> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body portlet-collapsed">
                                        <embed src="{{asset('files_reports') . '/' . $report->document_path}}" width="100%" height="1000" type='application/pdf'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">تغيير ملف التقرير</label>
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
                                                                        <input type="file" name="document_path"> </span>
                                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> إزالة </a>
                                    </div>
                                </div>
                                <span class="help-block">بصيغة pdf بالحجم لا يزيد عن ١٠ ميغا.</span>
                                @if($errors->has('document_path'))
                                    <div class="help-block help-block-error">{{$errors->first('document_path')}}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="alert alert-info">يمكنك رفع الصور بعد حفظ هذا التقرير</div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green pull-right"><i class="fa fa-save"></i>  خفظ</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->

            @endif

        </div>
    </div>
@endsection

@section('plugin_scripts')
    <script src="{{ asset('assets/global/plugins/bootbox/bootbox_abah_modified.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.plus.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.ummalqura.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.ummalqura-ar.js')}}" type="text/javascript"></script>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/report_edit.js') }}" type="text/javascript"></script>
@endsection
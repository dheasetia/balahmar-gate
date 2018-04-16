@extends('layouts.main')

@section('plugin_styles')
    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-pie-chart font-balahmar"></i>
                <span class="caption-subject font-balahmar bold">بيانات التقرير</span>
            </div>
            <div class="actions">
                <a href="{{url('projects', $project->id)}}" class="btn btn-default btn-circle btn-icon-only tooltips" data-original-title="إلغاء"><i class="fa fa-undo"></i></a>
            </div>
        </div>
        <div class="portlet-body form">
            @if(count($errors))
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif

        <!-- BEGIN FORM-->
            <form action="{{url('/reports')}}" method="post" class="form-horizontal form-bordered form-row-stripped" id="form_create_report" accept-charset="utf-8" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-body">
                    <input type="hidden" name="project_id" value="{{$project->id}}">
                    <div class="form-group {{$errors->has('hijri_created') ? 'has-error' : ''}}">
                        <label for="hijri_created" class="control-label col-md-3"> تاريخ التقرير  <span class="required">*</span></label>
                        <div class="col-md-2">
                            <input type="text" name="hijri_created" class="form-control" id="hijri_created" value="{{old('hijri_created')}}" readonly/>
                            <div class="help-block">تلقائي</div>
                            @if($errors->has('hijri_created'))
                                <div class="help-block help-block-error">{{$errors->first('hijri_created')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="project_id"> اسم المشروع <span class="required">*</span></label>
                        <div class="col-md-9">
                            <p class="form-control">{{$project->name}}</p>
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('nth') ? 'has-error' : ''}}">
                        <label for="nth" class="control-label col-md-3"> تقرير للمرحلة <span class="required">*</span></label>
                        <div class="col-md-2">
                            <select name="nth" class="form-control" id="nth">
                                @for($i = 1 ; $i <= 10; $i++)
                                    <option value="{{$i}}" {{old('nth') == $i ? 'selected' : ''}}>{{$i}}</option>
                                @endfor
                            </select>
                            <div class="help-block help-block-error">{{$errors->first('nth')}}</div>
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('hijri_report_from') ? 'has-error' : ''}}">
                        <label for="hijri_report_from" class="control-label col-md-3"> تاريخ الفترة من <span class="required">*</span></label>
                        <div class="col-md-2">
                            <input type="text" name="hijri_report_from" class="form-control" id="hijri_report_from" value="{{old('hijri_report_from')}}"/>
                            @if($errors->has('hijri_report_from'))
                                <div class="help-block help-block-error">{{$errors->first('hijri_report_from')}}</div>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="report_from" class="form-control" id="report_from" value="{{old('report_from')}}" readonly/>
                            <div class="help-block">تلقائي</div>
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('hijri_report_to') ? 'has-error' : ''}}">
                        <label for="hijri_report_to" class="control-label col-md-3"> لغاية <span class="required">*</span></label>
                        <div class="col-md-2">
                            <input type="text" name="hijri_report_to" class="form-control" id="hijri_report_to" value="{{old('hijri_report_to')}}"/>
                            @if($errors->has('hijri_report_to'))
                                <div class="help-block help-block-error">{{$errors->first('hijri_report_to')}}</div>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="report_to" class="form-control" id="report_to" value="{{old('report_to')}}" readonly/>
                            <div class="help-block">تلقائي</div>
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('video_link') ? 'has-error' : ''}}">
                        <label for="video_link" class="control-label col-md-3"> رابط فيديو</label>
                        <div class="col-md-9">
                            <input type="text" name="video_link" class="form-control" id="video_link" value="{{old('video_link')}}"/>
                            @if($errors->has('video_link'))
                                <div class="help-block help-block-error">{{$errors->first('video_link')}}</div>
                            @endif
                            <span class="help-block">إذا كان لديك مقطع فيديو عن المشروع، ضع الرابط هنا</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">ملف التقرير</label>
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
    <script src="{{asset('assets/layouts/layout3/scripts/report_create.js') }}" type="text/javascript"></script>
@endsection
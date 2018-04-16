@extends('layouts.main')

@section('plugin_styles')
    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-pie-chart font-balahmar"></i>
                <span class="caption-subject font-balahmar bold">رفع سند استلام </span>
            </div>
            <div class="actions">
                <a href="{{url('projects', $project->id)}}" class="btn font-balahmar btn-circle btn-icon-only tooltips" data-original-title="إلغاء"><i class="fa fa-undo"></i></a>
            </div>
        </div>
        <div class="portlet-body form">
        <!-- BEGIN FORM-->
            <form action="{{url('/projects', $project->id) . '/receipts'}}" method="post" class="form-horizontal form-bordered form-row-stripped" id="form_create_receipt" accept-charset="utf-8" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-body">
                    <input type="hidden" name="project_id" value="{{$project->id}}">
                    <div class="form-group {{$errors->has('hijri_received') ? 'has-error' : ''}}">
                        <label for="hijri_received" class="control-label col-md-3"> تاريخ الاستلام (بالهجري)  <span class="required">*</span></label>
                        <div class="col-md-2">
                            <input type="text" name="hijri_received" class="form-control" id="hijri_received" value="{{old('hijri_received')}}"/>
                            @if($errors->has('hijri_received'))
                                <div class="help-block help-block-error">{{$errors->first('hijri_received')}}</div>
                            @endif
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="date_received" class="form-control" id="date_received" value="{{old('date_received')}}" readonly/>
                            <div class="help-block">تلقائي</div>
                            @if($errors->has('date_received'))
                                <div class="help-block help-block-error">{{$errors->first('date_received')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3" for="project_id"> اسم المشروع <span class="required">*</span></label>
                        <div class="col-md-9">
                            <p class="form-control">{{$project->name}}</p>
                        </div>
                    </div>


                    <div class="form-group {{$errors->has('receiver_name') ? 'has-error' : ''}}">
                        <label for="receiver_name" class="control-label col-md-3"> اسم المستلم<span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="receiver_name" class="form-control" id="receiver_name" value="{{old('receiver_name')}}"/>
                            @if($errors->has('receiver_name'))
                                <div class="help-block help-block-error">{{$errors->first('receiver_name')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('amount') ? 'has-error' : ''}}">
                        <label for="amount" class="control-label col-md-3"> المبلغ بالريال<span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="amount" class="form-control" id="amount" value="{{old('amount')}}"/>
                            @if($errors->has('amount'))
                                <div class="help-block help-block-error">{{$errors->first('amount')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
                        <label for="description" class="control-label col-md-3"> رسالة وملاحظات </label>
                        <div class="col-md-9">
                            <textarea name="description" rows="3" class="form-control" id="description">{{old('description')}}</textarea>
                            @if($errors->has('description'))
                                <div class="help-block help-block-error">{{$errors->first('description')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">صورة سند استلام<span class="required">*</span></label>
                        <div class="col-md-4">
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
                            <span class="help-block">الملف إلزامي ومن نوع صورة بالحجم أقل من ٢ ميغا.</span>
                            @if($errors->has('document_path'))
                                <div class="help-block help-block-error">{{$errors->first('document_path')}}</div>
                            @endif
                        </div>
                    </div>
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
    <script src="{{asset('assets/layouts/layout3/scripts/receipt_create.js') }}" type="text/javascript"></script>
@endsection
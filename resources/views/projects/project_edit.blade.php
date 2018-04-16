@extends('layouts.main')

@section('plugin_styles')
    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('breadcrumb')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>  المشاريع <small> تعديل بيانات المشروع </small> </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
    </div>
    <!-- END PAGE HEAD-->
@endsection

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-wrench font-blue-hoki"></i>
                <span class="caption-subject font-blue-hoki bold">بيانات المشروع المقدم</span>
            </div>
            <div class="actions">
                <a href="{{url('projects', $project->id)}}" class="btn btn-default btn-icon-only btn-circle tooltips" data-original-title="إلغاء"><i class="fa fa-undo"></i></a>
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
            <form action="{{url('projects', $project->id)}}" method="post" class="form-horizontal form-bordered form-row-stripped" id="form_edit_project" accept-charset="utf-8" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field('patch')}}
                <div class="form-body">

                    <div class="form-group {{$errors->has('hijri_created') ? 'has-error' : ''}}">
                        <label for="hijri_created" class="control-label col-md-3"> تاريخ الطلب  <span class="required">*</span></label>
                        <div class="col-md-2">
                            <input type="text" name="hijri_created" class="form-control" id="hijri_created" value="{{old('hijri_created', $project->hijri_created_day . '/ ' . $project->hijri_created_month . '/ ' . $project->hijri_created_year)}}" readonly/>
                            <div class="help-block">تلقائي</div>
                            @if($errors->has('hijri_created'))
                                <div class="help-block help-block-error">{{$errors->first('hijri_created')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                        <label for="name" class="control-label col-md-3">اسم المشروع  <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" id="name" value="{{old('name',  $project->name)}}"/>
                            @if($errors->has('name'))
                                <div class="help-block help-block-error">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
                        <label for="description" class="control-label col-md-3">التعريف بالمشروع<span class="required">*</span></label>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control" id="description" rows="5">{{old('description', $project->description)}}</textarea>
                            @if($errors->has('description'))
                                <div class="help-block help-block-error">{{$errors->first('description')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('donation_requested') ? 'has-error' : ''}}">
                        <label for="donation_requested" class="control-label col-md-3">التكلفة بالريال السعودي  <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="donation_requested" class="form-control" id="donation_requested" value="{{old('donation_requested', $project->donation_requested)}}"/>
                            @if($errors->has('donation_requested'))
                                <div class="help-block help-block-error">{{$errors->first('donation_requested')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('execution_date') ? 'has-error' : ''}}">
                        <label for="execution_date" class="control-label col-md-3">تاريخ التنفيذ <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="execution_date" class="form-control" id="execution_date" value="{{old('execution_date', $project->hijri_execution_day . '/ ' . $project->hijri_execution_month . '/ ' . $project->hijri_execution_year)}}"/>
                            <div class="help-block">بالتاريخ الهجري</div>
                            @if($errors->has('execution_date'))
                                <div class="help-block help-block-error">{{$errors->first('execution_date')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('responsible_person') ? 'has-error' : ''}}">
                        <label for="responsible_person" class="control-label col-md-3">اسم الشحص للتواصل <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="responsible_person" class="form-control" id="responsible_person" value="{{old('responsible_person', $project->responsible_person)}}"/>
                            @if($errors->has('responsible_person'))
                                <div class="help-block help-block-error">{{$errors->first('responsible_person')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('mobile') ? 'has-error' : ''}}">
                        <label for="mobile" class="control-label col-md-3">رقم جواله <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="mobile" class="form-control" id="mobile" value="{{old('mobile', $project->mobile)}}"/>
                            @if($errors->has('mobile'))
                                <div class="help-block help-block-error">{{$errors->first('mobile')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                        <label for="email" class="control-label col-md-3">البريد الإلكتروني <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="email" class="form-control" id="email" value="{{old('email', $project->email)}}"/>
                            @if($errors->has('email'))
                                <div class="help-block help-block-error">{{$errors->first('email')}}</div>
                            @endif
                        </div>
                    </div>



                    <div class="form-group {{$errors->has('kind_id') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3" for="kind_id"> نوع المشروع <span class="required">*</span></label>
                        <div class="col-md-9">
                            <select class="form-control" name="kind_id" id="kind_id" >
                                <option value="">اختيار</option>
                                @foreach($kinds as $kind)
                                    <option value="{{$kind->id}}" {{old('kind_id', $project->kind_id) == $kind->id ? 'selected' : ''}}>{{$kind->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('kind_id'))
                                <div class="help-block help-block-error">{{$errors->first('kind_id')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('city_id') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3" for="city_id"> المدينة <span class="required">*</span></label>
                        <div class="col-md-9">
                            <select class="form-control" name="city_id" id="city_id" >
                                <option value="">اختيار</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}" {{old('city_id', $project->city_id) == $city->id ? 'selected' : ''}}>{{$city->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('city_id'))
                                <div class="help-block help-block-error">{{$errors->first('city_id')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('video_link') ? 'has-error' : ''}}">
                        <label for="video_link" class="control-label col-md-3"> رابط فيديو</label>
                        <div class="col-md-9">
                            <input type="text" name="video_link" class="form-control" id="video_link" value="{{old('video_link', $project->video_link)}}"/>
                            <span class="help-block">إذا كان لديك مقطع فيديو عن المشروع، ضع الرابط عنا</span>
                            @if($errors->has('video_link'))
                                <div class="help-block help-block-error">{{$errors->first('video_link')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">ملف الطلب المرفوع</label>
                        <div class="col-md-9">
                            <div>
                                <embed src="{{asset('projects') . '/' . $project->document_path}}" width="100%" height="1000" type='application/pdf'>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">تغيير ملف الطلب</label>
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
    <script src="{{asset('assets/layouts/layout3/scripts/project_edit.js') }}" type="text/javascript"></script>
@endsection
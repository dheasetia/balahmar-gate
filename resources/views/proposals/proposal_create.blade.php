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
                <h1>  طلبات المشروع <small> تقديم طلب جديد </small> </h1>
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
                <i class="fa fa-shopping-cart font-blue-hoki"></i>
                <span class="caption-subject font-blue-hoki bold">بيانات المشروع المقدم</span>
            </div>
        </div>
        <div class="portlet-body form">
            @if(count($errors))
                <div class="alert alert-danger">Ada Error pak.</div>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
            <!-- BEGIN FORM-->
            <form action="/proposals" method="post" class="form-horizontal form-bordered form-row-stripped" id="form_create_proposal" accept-charset="utf-8" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-body">

                    <div class="form-group {{$errors->has('hijri_created') ? 'has-error' : ''}}">
                        <label for="hijri_created" class="control-label col-md-3"> تاريخ الطلب  <span class="required">*</span></label>
                        <div class="col-md-2">
                            <input type="text" name="hijri_created" class="form-control" id="hijri_created" value="{{old('hijri_created')}}" readonly/>
                            <div class="help-block">تلقائي</div>
                            @if($errors->has('hijri_created'))
                                <div class="help-block help-block-error">{{$errors->first('hijri_created')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('project_name') ? 'has-error' : ''}}">
                        <label for="project_name" class="control-label col-md-3">اسم المشروع  <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="project_name" class="form-control" id="project_name" value="{{old('project_name')}}"/>
                            @if($errors->has('project_name'))
                                <div class="help-block help-block-error">{{$errors->first('project_name')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
                        <label for="description" class="control-label col-md-3">التعريف بالمشروع<span class="required">*</span></label>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control" id="description" rows="5">{{old('description')}}</textarea>
                            @if($errors->has('description'))
                                <div class="help-block help-block-error">{{$errors->first('description')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('execution_date') ? 'has-error' : ''}}">
                        <label for="execution_date" class="control-label col-md-3">تاريخ التنفيذ <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="execution_date" class="form-control" id="execution_date" value="{{old('execution_date')}}"/>
                            <div class="help-block">بالتاريخ الهجري</div>
                            @if($errors->has('execution_date'))
                                <div class="help-block help-block-error">{{$errors->first('execution_date')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('responsible_person') ? 'has-error' : ''}}">
                        <label for="responsible_person" class="control-label col-md-3">اسم الشحص للتواصل <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="responsible_person" class="form-control" id="responsible_person" value="{{old('responsible_person', Sentinel::getUser()->office->representative)}}"/>
                            @if($errors->has('responsible_person'))
                                <div class="help-block help-block-error">{{$errors->first('responsible_person')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('mobile') ? 'has-error' : ''}}">
                        <label for="mobile" class="control-label col-md-3">رقم جواله <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="mobile" class="form-control" id="mobile" value="{{old('mobile', Sentinel::getUser()->office->mobile)}}"/>
                            @if($errors->has('mobile'))
                                <div class="help-block help-block-error">{{$errors->first('mobile')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                        <label for="email" class="control-label col-md-3">البريد الإلكتروني <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="email" class="form-control" id="email" value="{{old('email')}}"/>
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
                                    <option value="{{$kind->id}}" {{old('kind_id') == $kind->id ? 'selected' : ''}}>{{$kind->name}}</option>
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
                                    <option value="{{$city->id}}" {{old('city_id') == $city->id ? 'selected' : ''}}>{{$city->name}}</option>
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
                            <input type="text" name="video_link" class="form-control" id="video_link" value="{{old('video_link')}}"/>
                            <span class="help-block">إذا كان لديك مقطع فيديو عن المشروع، ضع الرابط عنا</span>
                            @if($errors->has('video_link'))
                                <div class="help-block help-block-error">{{$errors->first('video_link')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">ملف الطلب</label>
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
    <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.plus.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.ummalqura.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.ummalqura-ar.js')}}" type="text/javascript"></script>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/proposal_create.js') }}" type="text/javascript"></script>
@endsection
@extends('layouts.main')

@section('plugin_styles')
    <link rel="stylesheet" href="{{asset('assets/global/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/global/plugins/select2/css/select2-bootstrap.min.css')}}">
    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .select2-container--bootstrap .select2-selection--single .select2-selection__rendered {
            font-family: DroidNaskh, "Open Sans", sans-serif;
        }
    </style>
@endsection

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-bank font-balahmar"></i>
                <span class="caption-subject bold font-balahmar uppercase"> الجهات المستفيدة</span>
                <span class="caption-helper">إنشاء جهة جديدة </span>
            </div>
        </div>
        <div class="portlet-body form">
            @if(count(Sentinel::getUser()->office) == 0)
                <div class="alert alert-info">لم تكن لديك جهة مسجلة، الرجاء تعبئة هذا النموذج لتسجيل الجهة المستفيدة الخاصة بك. الحقول المشار إليها بالنجم الأحمر مطلوب تعبئته.</div>
            @endif
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        <h5>توجد أخطاز!! الرجاء تصحيح الأخطاء التالية: </h5>
                        @foreach($errors->all() as $error)
                            <li>
                                {{$error}}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- BEGIN FORM-->
            <form action="/office" method="post" class="form-horizontal form-bordered form-row-stripped" id="form_create_office" accept-charset="utf-8" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-body">
                    <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                        <label for="name" class="control-label col-md-3">اسم الجهة  <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}"/>
                            <span class="help-block"> مطابق لما هو مكتوب بالترخيص </span>
                            @if($errors->has('name'))
                                <div class="help-block help-block-error">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has('description') ? 'has-error' : ''}}">
                        <label for="description" class="control-label col-md-3">التعريف المختصر<span class="required">*</span></label>
                        <div class="col-md-9">
                            <textarea name="description" class="form-control" id="description" rows="5">{{old('description')}}</textarea>
                            @if($errors->has('description'))
                                <div class="help-block help-block-error">{{$errors->first('description')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has('advisor_id') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3" for="advisor_id">الجهة المشرفة <span class="required">*</span></label>
                        <div class="col-md-9">
                            <select class="form-control" name="advisor_id" id="advisor_id" >
                                <option value="">اختيار</option>
                                @foreach($advisors as $advisor)
                                    <option value="{{$advisor->id}}" {{old('advisor_id') == $advisor->id ? 'selected' : ''}}>{{$advisor->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('advisor_id'))
                                <div class="help-block help-block-error">{{$errors->first('advisor_id')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('manager_name') ? 'has-error' : ''}}">
                        <label for="manager_name" class="control-label col-md-3">اسم المدير<span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="manager_name" class="form-control" id="manager_name" value="{{old('manager_name')}}"/>
                            @if($errors->has('manager_name'))
                                <div class="help-block help-block-error">{{$errors->first('manager_name')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('license_no') ? 'has-error' : ''}}">
                        <label for="license_no" class="control-label col-md-3">رقم الترخيص <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="license_no" class="form-control" id="license_no" value="{{old('license_no')}}"/>
                            @if($errors->has('license_no'))
                                <div class="help-block help-block-error">{{$errors->first('license_no')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('license_date') ? 'has-error' : ''}}">
                        <label for="license_date" class="control-label col-md-3">تاريخ الترخيص <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="license_date" class="form-control" id="license_date" value="{{old('license_date')}}"/>
                            <span class="help-error">مثال: 03/ 09/ 1436</span>
                            @if($errors->has('license_date'))
                                <div class="help-block help-block-error">{{$errors->first('license_date')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('license_file') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3"> صورة الترخيص<span class="required">*</span></label>
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
                                                                        <input type="file" name="license_file"> </span>
                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> إزالة </a>
                                </div>
                            </div>
                            <span class="help-block">يلزم أن يكون الملف بصيغة pdf وبحجم أقل من ٢ ميغا</span>
                            @if($errors->has('license_file'))
                                <div class="help-block help-block-error">{{$errors->first('license_file')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('representative') ? 'has-error' : ''}}">
                        <label for="representative" class="control-label col-md-3">اسم ممثل الجهة <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="representative" class="form-control" id="representative" value="{{old('representative')}}"/>
                            @if($errors->has('representative'))
                                <div class="help-block help-block-error">{{$errors->first('representative')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('role') ? 'has-error' : ''}}">
                        <label for="role" class="control-label col-md-3">صفته <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="role" class="form-control" id="role" value="{{old('role')}}"/>
                            @if($errors->has('role'))
                                <div class="help-block help-block-error">{{$errors->first('role')}}</div>
                            @endif
                        </div>
                    </div>



                    <div class="form-group {{$errors->has('mobile') ? 'has-error' : ''}}">
                        <label for="mobile" class="control-label col-md-3">رقم جواله <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="mobile" class="form-control" id="mobile" value="{{old('mobile')}}"/>
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



                    <div class="form-group {{$errors->has('bank_id') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3" for="bank_id"> البنك <span class="required">*</span></label>
                        <div class="col-md-9">
                            <select class="form-control" name="bank_id" id="bank_id" >
                                <option value="">اختيار</option>
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}" {{old('bank_id') == $bank->id ? 'selected' : ''}}>{{$bank->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bank_id'))
                                <div class="help-block help-block-error">{{$errors->first('bank_id')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('iban') ? 'has-error' : ''}}">
                        <label for="iban" class="control-label col-md-3"> رقم الآيبان <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="iban" class="form-control" id="iban" value="{{old('iban')}}"/>
                            <span class="help-block">بالأحرف الكبيرة</span>
                            @if($errors->has('iban'))
                                <div class="help-block help-block-error">{{$errors->first('iban')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('bank_file') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3"> صورة شهادة الحساب البنكي <span class="required">*</span></label>
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
                                                                        <input type="file" name="bank_file"> </span>
                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> إزالة </a>
                                </div>
                            </div>
                            <span class="help-block">يلزم أن يكون الملف بصيغة pdf وبحجم أقل من ٢ ميغا</span>
                            @if($errors->has('bank_file'))
                                <div class="help-block help-block-error">{{$errors->first('bank_file')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('phone') ? 'has-error' : ''}}">
                        <label for="phone" class="control-label col-md-3">الهاتف <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="phone" class="form-control" id="phone" value="{{old('phone')}}"/>
                            @if($errors->has('phone'))
                                <div class="help-block help-block-error">{{$errors->first('phone')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('second_phone') ? 'has-error' : ''}}">
                        <label for="second_phone" class="control-label col-md-3">الهاتف الثاني</label>
                        <div class="col-md-9">
                            <input type="text" name="second_phone" class="form-control" id="second_phone" value="{{old('second_phone')}}"/>
                            @if($errors->has('second_phone'))
                                <div class="help-block help-block-error">{{$errors->first('second_phone')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('fax') ? 'has-error' : ''}}">
                        <label for="fax" class="control-label col-md-3">الفاكس <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="fax" class="form-control" id="fax" value="{{old('fax')}}"/>
                            @if($errors->has('fax'))
                                <div class="help-block help-block-error">{{$errors->first('fax')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('website') ? 'has-error' : ''}}">
                        <label for="fax" class="control-label col-md-3">الموقع الإلكتروني</label>
                        <div class="col-md-9">
                            <input type="text" name="website" class="form-control" id="website" value="{{old('website')}}"/>
                            @if($errors->has('website'))
                                <div class="help-block help-block-error">{{$errors->first('website')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('area_id') ? 'has-error' : ''}}">
                        <label class="control-label col-md-3" for="area_id"> المنطقة <span class="required">*</span></label>
                        <div class="col-md-9">
                            <select class="form-control" name="area_id" id="area_id" >
                                <option value="">اختيار</option>
                                @foreach($areas as $area)
                                    <option value="{{$area->id}}" {{old('area_id') == $area->id ? 'selected' : ''}}>{{$area->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('area_id'))
                                <div class="help-block help-block-error">{{$errors->first('area_id')}}</div>
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


                    <div class="form-group {{$errors->has('street') ? 'has-error' : ''}}">
                        <label for="street" class="control-label col-md-3">الشارع <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="street" class="form-control" id="street" value="{{old('street')}}"/>
                            @if($errors->has('street'))
                                <div class="help-block help-block-error">{{$errors->first('street')}}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{$errors->has('district') ? 'has-error' : ''}}">
                        <label for="district" class="control-label col-md-3">الحي </label>
                        <div class="col-md-9">
                            <input type="text" name="district" class="form-control" id="district" value="{{old('district')}}"/>
                            @if($errors->has('district'))
                                <div class="help-block help-block-error">{{$errors->first('district')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('building_no') ? 'has-error' : ''}}">
                        <label for="building_no" class="control-label col-md-3">رقم العمارة </label>
                        <div class="col-md-9">
                            <input type="text" name="building_no" class="form-control" id="building_no" value="{{old('building_no')}}"/>
                            @if($errors->has('building_no'))
                                <div class="help-block help-block-error">{{$errors->first('building_no')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('additional_no') ? 'has-error' : ''}}">
                        <label for="additional_no" class="control-label col-md-3">الرقم الإضافي </label>
                        <div class="col-md-9">
                            <input type="text" name="additional_no" class="form-control" id="additional_no" value="{{old('additional_no')}}"/>
                            @if($errors->has('additional_no'))
                                <div class="help-block help-block-error">{{$errors->first('additional_no')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('zip_code') ? 'has-error' : ''}}">
                        <label for="zip_code" class="control-label col-md-3">الرمز البريدي  (بريد واصل) <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="zip_code" class="form-control" id="zip_code" value="{{old('zip_code')}}"/>
                            @if($errors->has('zip_code'))
                                <div class="help-block help-block-error">{{$errors->first('zip_code')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('po_box') ? 'has-error' : ''}}">
                        <label for="po_box" class="control-label col-md-3">صندوق البريد </label>
                        <div class="col-md-9">
                            <input type="text" name="po_box" class="form-control" id="po_box" value="{{old('po_box')}}"/>
                            @if($errors->has('po_box'))
                                <div class="help-block help-block-error">{{$errors->first('po_box')}}</div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="control-label col-md-3">صورة الشعار  <span class="required">*</span></label>
                        <div class="col-md-9">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
                                <div>
                                    <span class="btn blue-chambray btn-file">
                                        <span class="fileinput-new"> اختيار صورة </span>
                                        <span class="fileinput-exists"> تغيير </span>
                                        <input type="file" name="logo"> </span>
                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
                                </div>
                            </div>
                            <div class="error_file_input clearfix margin-top-20"></div>
                            @if($errors->has('logo'))
                                <div class="clearfix margin-top-20">
                                    <div class="help-block help-block-error">{{$errors->first('logo')}}</div>
                                </div>
                            @endif
                            <div class="clearfix margin-top-20">
                                <span class="label label-success" style="font-family: DroidKufi; font-size: medium">تنبيه !</span> الرجاء اختيار الملف بصيغة الصورة (jpeg، bmp، png) بالمحاذاة المناسبة وبحجم الملف لا يزيد عن ٢ ميغا.
                            </div>
                        </div>
                    </div>

                    <div class="form-group {{$errors->has('po_box') ? 'has-error' : ''}}">
                        <label for="coordinate" class="control-label col-md-3">إحداثيات الموقع </label>
                        <div class="col-md-9">
                            <input dir="ltr" type="text" name="coordinate" class="form-control" id="coordinate" value="{{old('coordinate')}}" readonly/>
                            <span class="help-bock">لتحديد الموقع، اسحب المؤشر في الخريطة ثم ضعه في موقعك.</span>
                            @if($errors->has('coordinate'))
                                <div class="help-block help-block-error">{{$errors->first('coordinate')}}</div>
                            @endif
                        </div>
                    </div>
                    <div id="office_map" style="height: 400px; width: auto;"></div>

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
    <script src="{{ asset('assets/global/plugins/jquery-validation/js/jquery.validate.file.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXi_ikrgat68ZL6SeidLuihVWh81L6ILc&language=ar"></script>
    <script src="{{ asset('assets/global/plugins/gmaps/gmaps.min.js') }}" type="text/javascript"></script>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/office_create.js') }}" type="text/javascript"></script>
@endsection
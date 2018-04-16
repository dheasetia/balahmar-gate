@extends('layouts.main')

@section('custom_styles')
    <style>
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
        .office-name {
            background-color: #007269;
            padding: 20px;
            color: #ffffff;
        }
        .form-control-static {
            width: 100%;
            padding: 6px 12px;
            background-color: #fff;
            margin: 10px 0;
            border: 1px solid #c2cad8;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        }
        .control-label{
            text-align: left;
        }
        .form-section{
            padding-right: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-bank font-balahmar"></i>
                <span class="caption-subject font-balahmar bold">الجهات المستفيدة</span>
                <span class="caption-helper">تفاصيل الجهة</span>
            </div>
            <div class="actions">
                @if(Sentinel::getUser()->office->is_approved == 1)
                    <a class="btn btn-circle btn-icon-only  tooltips" href="/projects/create" title="تقديم مشروع">
                        <i class="fa fa-upload font-balahmar"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only  tooltips" href="{{url('projects')}}" data-original-title="{{count($office->projects) > 0 ? 'مشاهدة قائمة المشاريع' : 'مشاهدة قائمة المشاريع (لا يوجد)'}}">
                        <i class="fa fa-bar-chart font-balahmar"></i>
                    </a>
                @else
                    <a class="btn btn-circle btn-icon-only  tooltips" href="/office/edit" data-original-title="تعديل بيانات هذه الجهة">
                        <i class="fa fa-pencil font-balahmar"></i>
                    </a>
                @endif
            </div>
        </div>
        <div class="portlet-body form">
            @if($office->is_banned == 1)
            <div class="alert alert-danger">
                <h5>تعتذر المؤسسة على الموافقة لهذه الجهة </h5>
                @if($office->ban_reason != '')
                    <p>وذلك لأسباب منها:</p>
                    <p style="white-space: pre">{{$office->ban_reason}}</p>
                @endif
            </div>
            @else
                @if($office->is_approved == 0)
                    <div class="note note-warning">لم تتم الموافقة على هذه الجهة وهي تحت الدراسة، سوف يأتيك الإشعار بالبريد الإلكتروني إذا تمت الموافقة.</div>
                @endif
            @endif
            <!-- BEGIN FORM-->
                <div class="form-body">
                    <div class="photo">
                        <img src="/files_logos/{{$office->logo}}" alt="" class="img-responsive">
                    </div>
                    <h3 class="text-center margin-bottom-30 office-name"> {{$office->name}} </h3>
                    <h4 class="form-section font-balahmar bold"><i class="fa fa-building font-balahmar"></i> الجهة</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-2">الاسم:</label>
                                <div class="col-md-10">
                                    <p class="form-control-static"> {{$office->name}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-2">التعريف المختصر:</label>
                                <div class="col-md-10">
                                    <p class="abah-description"> {{$office->description or '_____'}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">اسم المدير العام:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->manager_name or '_____'}} </p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">الجهة المشرفة:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->advisor->name}} </p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">رقم الترخيص:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->license_no}} </p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">تاريخ الترخيص:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->license_date}} هـ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($office->license_file != '')
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption font-balahmar bold">
                                        <i class="fa fa-file font-balahmar"></i>صورة الترخيص  {{$office->license_file != '' ? '' : 'لا توجد'}}</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="expand"> </a>
                                        <a href="" class="fullscreen"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body portlet-collapsed">
                                    <div class="row">
                                        <embed src="{{asset('files_licenses') . '/' . $office->license_file}}" width="100%" height="1000" type='application/pdf'>
                                    </div>
                                </div>
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>
                    </div>
                    @endif
                    <hr>

                    <h4 class="form-section font-balahmar bold"> <i class="fa fa-link font-balahmar"></i> التواصل </h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">اسم ممثل الجهة:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->representative}} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">صفته:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->role}} </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">رقم جواله:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->mobile}} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">الهاتف:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->phone}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">الهاتف الثاني:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->second_phone or '_____'}} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">الفكس:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->fax or '_____'}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">البريد الإلكتروني:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->email}} </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">الموقع الإلكتروني:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->website}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4 class="form-section font-balahmar bold"> <i class="fa fa-credit-card font-balahmar"></i> الحساب البنكي</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">اسم البنك:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->bank->name}} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">رقم الآيبان:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static uppercase"> {{$office->iban}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($office->bank_file != '')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption font-balahmar bold">
                                        <i class="fa fa-file font-balahmar"></i>صورة شهادة الحساب البنكي  {{$office->bank_file != '' ? '' : 'لا توجد'}}</div>
                                    <div class="tools">
                                        <a href="javascript:;" class="expand"> </a>
                                        <a href="" class="fullscreen"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body portlet-collapsed">
                                    <div class="row">
                                        <embed src="{{asset('files_banks') . '/' . $office->bank_file}}" width="100%" height="1000" type='application/pdf'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <hr>

                    <h4 class="form-section font-balahmar bold"><i class="fa fa-map-marker font-balahmar"></i> العنوان الوطني</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">المنطقة:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->area->name}} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">المدينة:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->city->name}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">الشارع:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->street }} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">الحي:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->district or '_____'}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">رقم المبنى:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->building_no or '_____'}} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">الرقم الإضافي:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->additional_no or '_____'}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">صندوق البريد:</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->po_box or '_____'}} </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">الرمز البريدي (بريد واصل):</label>
                                <div class="col-md-9">
                                    <p class="form-control-static"> {{$office->zip_code or '_____'}} </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">الإحداثيات:</label>
                                <div class="col-md-9" dir="ltr">
                                    <p class="form-control-static text-right" id="coordinate_value" dir="ltr">{{$office->coordinate or '_____'}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(count($office->coordinate))
                        <h4 class="form-section font-balahmar bold"><i class="fa fa-map font-balahmar"></i> الخريطة</h4>
                        <div class="col-md-12">
                            <!-- BEGIN Portlet PORTLET-->
                            <div class="portlet light">
                                <div class="portlet-body">
                                    <div class="row">
                                        <div id="office_map" style="height: 400px; width: auto;"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Portlet PORTLET-->
                        </div>
                    @endif

                </div>
                <div class="form-actions">
                        <a href="/office/edit" class="btn green pull-right"><i class="fa fa-pencil"></i> تعديل</a>
                </div>
            <!-- END FORM-->
        </div>
    </div>
@endsection

@section('plugin_scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXi_ikrgat68ZL6SeidLuihVWh81L6ILc&language=ar"></script>
    <script src="{{ asset('assets/global/plugins/gmaps/gmaps.min.js') }}" type="text/javascript"></script>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/office_show.js') }}" type="text/javascript"></script>
@endsection
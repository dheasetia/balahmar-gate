@extends('layouts.main')

@section('custom_styles')
    <style>
        p.form-control-static {
            font-weight: bold;
        }
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
                <span class="caption-subject bold font-balahmar uppercase"> جهتي</span>
                <span class="caption-helper">تفاصيل </span>
            </div>
            <div class="actions">
                <a href="{{url('admin/office/edit')}}" class="btn btn-circle btn-icon-only tooltips" data-original-title="تعديل"><i class="fa fa-pencil font-balahmar"></i></a>
            </div>
        </div>
        <div class="portlet-body form">
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
                                <textarea class="form-control form-control-static" rows="5"> {{$office->description or '_____'}} </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
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
                    <!--/span-->
                </div>
                @if($office->license_file != '')
                    <div class="row">
                        <div class="col-md-12">
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
                        </div>
                    </div>
                @endif
                <hr>

                <!--/row-->
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
                            <div class="col-md-7">
                                <p class="form-control-static" id="coordinate_value" style="text-align: right" dir="ltr">{{$office->coordinate or '_____'}}</p>
                            </div>
                            <div class="col-md-2">
                                <a href="https://maps.google.com?q={{$office->coordinate}}" target="_blank" class="btn btn-primary btn-block">خريطة</a>
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
                <div class="actions text-right">
                    @if($office->is_approved == 0)
                        <button type="button" data-toggle="modal" data-target="#approval_modal" class="btn green"> <i class="fa fa-check"></i> تعميد الجهة </button>
                    @else
                        <button type="button" data-toggle="modal" data-target="#unapproval_modal" class="btn purple-seance"><i class="fa fa-undo"></i> إلغاء تعميد الجهة </button>
                    @endif

                </div>
            <!-- END FORM-->
        </div>
    </div>
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-wrench font-balahmar"></i>
                <span class="caption-subject font-balahmar bold">المشاريع لهذه الجهة</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable table-scrollable-borderless">
                <table class="table table-hover table-light margin-bottom-20">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> اسم المشروع </th>
                        <th> تاريخ التقديم </th>
                        <th> الجهة المقدمة </th>
                        <th> نوع المشروع </th>
                        <th> المدينة </th>
                        <th> تاريخ التنفيذ </th>
                        <th>الحالة</th>
                        <th> الملف </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($office->projects) == 0)
                        <tr>
                            <td colspan="9" class="text-center"><h4>لا توجد مشاريع لهذه الجهة</h4></td>
                        </tr>
                    @else
                        @foreach($office->projects as $project)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><a href="{{url('admin/projects', $project->id)}}" class="tooltips" data-original-title="تفاصيل المشروع">{{$project->name}}</a></td>
                                <td>{{$project->hijri_created}} هـ</td>
                                <td><a href="{{url('admin/offices', $project->office->id)}}" class="tooltips" data-original-title="تفاصيل الجهة">{{$project->office->name}}</a></td>
                                <td>{{$project->kind->name}}</td>
                                <td>{{$project->city->name}}</td>
                                <td>{{$project->hijri_execution_day . '/ ' . $project->hijri_execution_month . '/ ' . $project->hijri_execution_year}} هـ</td>
                                <td><span class="label label-{{$project->status_class}}">{{$project->status}}</span></td>
                                <td>
                                    <a href="{{asset('files_projects') . '/' .$project->document_path}}" class="btn btn-icon-only font-balahmar tooltips" data-original-title="مشاهدة ملف طلب المشروع"><i class="fa fa-file-pdf-o"></i></a>
                                    <a href="{{url('admin/projects', $project->id) . '/reports'}}" class="btn btn-icon-only font-balahmar tooltips" data-original-title="{{count($project->reports) > 0 ? 'التقارير المرفوعة لهذا المشروع' : 'التقارير المرفوعة لهذا المشروع (لا يوجد تقرير)'}}"><i class="fa fa-pie-chart"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <br><br><br><br><br>
@endsection

@section('plugin_scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAXi_ikrgat68ZL6SeidLuihVWh81L6ILc&language=ar"></script>
    <script src="{{ asset('assets/global/plugins/gmaps/gmaps.min.js') }}" type="text/javascript"></script>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/admin_office_show.js') }}" type="text/javascript"></script>
@endsection
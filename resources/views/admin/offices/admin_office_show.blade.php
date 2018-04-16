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
    <!-- BEGIN BAN MODAL -->
    <div id="ban_modal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{url('/admin/offices/ban')}}" method="post" accept-charset="utf-8" id="form_ban">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">اعتذار الجهة</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-body">
                            <p>هل تريد الاعتذار لهذه الجهة؟</p>
                            {{csrf_field()}}
                            <input id="office_id" type="hidden" name="office_id" value="{{$office->id}}">
                            <input type="hidden" name="out" value="no" id="is_out">
                            <div class="form-group">
                                <label class="col-md-3 control-label">أسباب الاعتذار: </label>
                                <div class="col-md-9">
                                    <div class="mt-checkbox-list">
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" class="reason_checkbox"> يجب إدخال إحداثيات الجهة.
                                            <span></span>
                                        </label>
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" class="reason_checkbox"> يجب إرفاق التصريح الخاص بالجهة.
                                            <span></span>
                                        </label>
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" class="reason_checkbox"> يجب إرفاق صوره رقم الحساب البنكي.
                                            <span></span>
                                        </label>
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" class="reason_checkbox"> يجب تعبئه بيانات العنوان كاملة.
                                            <span></span>
                                        </label>
                                        <hr>
                                        <label class="mt-checkbox mt-checkbox-outline">
                                            <input type="checkbox" id="out_of_service"> خارج النطاق الجغرافي لخطة عمل المؤسسة.
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="ban_reason" class="control-label">سبب الاعتذار</label>
                                <textarea rows="6" name="ban_reason" class="form-control" id="ban_reason"></textarea>
                            </div>
                        </div>
                        </div>

                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn default"><i class="fa fa-undo"></i> إلغاء</button>
                        <button type="submit" class="btn green"><i class="fa fa-check"></i> موافق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END BAN MODAL -->


    <!-- BEGIN APPROVAL MODAL -->
    <div id="approval_modal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{url('/admin/offices/approve')}}" method="post" accept-charset="utf-8" id="form_approval">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">تعميد الجهة</h4>
                    </div>
                    <div class="modal-body">
                        <p>هل تريد تعميد هذه الجهة؟</p>
                        {{csrf_field()}}
                        <input id="office_id" type="hidden" name="office_id" value="{{$office->id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn default"><i class="fa fa-undo"></i> إلغاء</button>
                        <button type="submit" class="btn green"><i class="fa fa-check"></i> موافق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END APPROVAL MODAL -->

    <!-- BEGIN UNAPPROVAL MODAL -->
    <div id="unapproval_modal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{url('/admin/offices/unapprove')}}" method="post" accept-charset="utf-8" id="form_unapproval">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title font-red-sunglo">إلغاء تعميد الجهة</h4>
                    </div>
                    <div class="modal-body">
                        <p>هل تريد إلغاء تعميد هذه الجهة؟</p>
                        {{csrf_field()}}
                        <input id="unapproval_office_id" type="hidden" value="{{$office->id}}" name="office_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn default"><i class="fa fa-undo"></i> إلغاء</button>
                        <button type="submit" class="btn green"><i class="fa fa-check"></i> موافق</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END APPROVAL MODAL -->

    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-bank font-balahmar"></i>
                <span class="caption-subject bold font-balahmar uppercase"> الجهات</span>
                <span class="caption-helper">تفاصيل بيانات جهة</span>
            </div>
            <div class="actions">
                <div class="actions">
                    <a href="{{url('admin/offices')}}" class="btn btn-icon-only btn-circle tooltips" data-original-title="جميع الجهات"><i class="fa fa-list font-balahmar"></i></a>
                    <a href="{{url('admin/offices/approved')}}" class="btn btn-icon-only btn-circle tooltips" data-original-title="الجهات المعتمدة"><i class="fa fa-gavel font-balahmar"></i></a>
                    <a href="{{url('admin/offices/unapproved')}}" class="btn btn-icon-only btn-circle tooltips" data-original-title="الجهات في انتظار الاعتماد"><i class="fa fa-warning font-balahmar"></i></a>
                    <a href="{{url('admin/offices/banned')}}" class="btn btn-icon-only btn-circle tooltips" data-original-title="الجهات تم الاعتذار عنها"><i class="fa fa-ban font-balahmar"></i></a>
                    @if($office->iban != '' && $office->is_approved == 1)
                        <a href="{{url('https://balahmar-charity.com/offices/fetch/' . $office->iban)}}"  target="_blank" class="btn btn-icon-only btn-circle tooltips" data-original-title="إضافة الجهة إلى برنامج محاسبية"><i class="fa fa-exchange font-balahmar"></i></a>
                    @endif
                </div>
            </div>
        </div>
        <div class="portlet-body form">
            @if($office->is_banned == 1)
            <div class="alert alert-danger">
                <h5> تعتذر المؤسسة عن الموافقة على هذه الجهة، وذلك لأسباب:</h5>
                <p style="white-space: pre">{{$office->ban_reason}}</p>
            </div>
            @else
                @if($office->is_approved == 0)
                    <div class="note note-warning">لم تتم الموافقة على هذه الجهة.</div>
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
                                            <iframe src="https://docs.google.com/gview?url={{url('files_licenses', $office->license_file)}}&embedded=true" style="width: 100%; height: 1000px"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Portlet PORTLET-->
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
                                            <iframe src="https://docs.google.com/gview?url={{url('files_banks', $office->bank_file)}}&embedded=true" style="width: 100%; height: 1000px"></iframe>
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
                    @if($office->is_banned == 0)
                        <button type="button" data-toggle="modal" data-target="#ban_modal" class="btn red-sunglo"><i class="fa fa-ban"></i> اعتذار الجهة </button>
                    @endif
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

{{--@section('plugin_scripts')--}}
    {{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlnVzl3x_ery4B7JDmcXfR4I6W7ouUs3s&language=ar"></script>--}}
    {{--<script src="{{ asset('assets/global/plugins/gmaps/gmaps.min.js') }}" type="text/javascript"></script>--}}
{{--@endsection--}}

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/admin_office_show.js') }}" type="text/javascript"></script>
@endsection
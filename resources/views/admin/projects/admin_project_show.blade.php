@extends('layouts.main')

@section('content')
    <div class="modal fade" id="confirmation_approval_modal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/admin/projects/approve">
                {{csrf_field()}}
                <input type="hidden" name="project_id" value="{{$project->id}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">تعميد الموافقة</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>التاريخ</label>
                                <input type="text" class="form-control" name="hijri_approval" id="hijri_approval" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p>اعتماد حالة المشروع؟</p>
                            <div class="form-group form-md-radios">
                                <label>اختر الحالة:</label>
                                <div class="md-radio-list">
                                    <div class="md-radio col-md-6">
                                        <input type="radio" id="radio1" name="approval_status" value="1" class="md-radiobtn" {{$project->approval_status == 1 ? 'checked' : ''}}>
                                        <label for="radio1">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> مساهمة </label>
                                    </div>
                                    <div class="md-radio col-md-6">
                                        <input type="radio" id="radio3" name="approval_status" value="3" class="md-radiobtn" {{$project->approval_status == 3 ? 'checked' : ''}}>
                                        <label for="radio3">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> موافقة بالكامل </label>
                                    </div>
                                    <div class="md-radio col-md-6">
                                        <input type="radio" id="radio2" name="approval_status" value="2" class="md-radiobtn" {{$project->approval_status == 2 ? 'checked' : ''}}>
                                        <label for="radio2">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> اعتذار </label>
                                    </div>
                                    <div class="md-radio col-md-6">
                                        <input type="radio" id="radio4" name="approval_status" value="4" class="md-radiobtn" {{$project->approval_status == 4 ? 'checked' : ''}}>
                                        <label for="radio4">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> الاكتفاء بدعم مشروع آخر </label>
                                    </div>
                                    <div class="md-radio col-md-6">
                                        <input type="radio" id="radio5" name="approval_status" value="5" class="md-radiobtn" {{$project->approval_status == 5 ? 'checked' : ''}}>
                                        <label for="radio5">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> تأجيل الموافقة </label>
                                    </div>

                                    <div class="md-radio col-md-6">
                                        <input type="radio" id="radio6" name="approval_status" value="6" class="md-radiobtn" {{$project->approval_status == 6 ? 'checked' : ''}}>
                                        <label for="radio6">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> طلب </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="donation_amount_area" class="form-group {{$project->approval_status == 1 ? '' : 'display-hide' }}">
                                <div class="form-group">
                                    <label for="donation_approved">اعتماد المبلغ:</label>
                                    <input name="donation_approved" id="donation_approved" class="form-control" value="{{old('donation_approved', $project->donation_approved)}}">
                                </div>
                                <div class="form-group">
                                    <label for="donation_purpose">المخصص لـ:</label>
                                    <textarea name="donation_purpose" rows="3" id="donation_purpose" class="form-control">{{old('donation_purpose', $project->donation_purpose)}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div id="pended_area" class="form-group {{$project->approval_status == 5 ? '' : 'display-hide' }}">
                                <div class="form-group">
                                    <label for="pending_reason">سبب التأجيل:</label>
                                    <textarea name="pending_reason" rows="3" id="pending_reason" class="form-control">{{old('pending_reason', $project->pending_reason)}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div id="ban_reason_area" class="form-group {{$project->approval_status == 2 ? '' : 'display-hide' }}">
                                <label for="ban_reason">سبب الاعتذار:</label>
                                <textarea name="ban_reason" id="ban_reason" class="form-control">{{$project->approval_status == 2 ? $project->ban_reason : ''}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row"  >
                        <div class="col-md-12">
                            <div class="form-group {{$project->approval_status == 6 ? '' : 'display-hide' }}" id="requested_area">
                                <label for="requested_detail">الأشياء المطلوبة:</label>
                                <textarea name="requested_detail" id="requested_detail" class="form-control">{{$project->approval_status == 6 ? $project->requested_detail : ''}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div id="other_project_area" class="form-group {{$project->approval_status == 4 ? '' : 'display-hide' }}">
                                <div class="form-group">
                                    <label for="donation_approved">المشروع الآخر الذي تم دعمه:</label>
                                    <select name="other_project_donated_id" class="form-control">
                                        @if(count($other_projects) > 0)
                                            @foreach($other_projects as $other_project)
                                                <option value="{{$other_project->id}}">{{$other_project->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn green">حفظ</button>
                </div>

            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
    </div>

    <div class="row">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-wrench font-balahmar"></i>
                    <span class="caption-subject bold font-balahmar"> المشاريع</span>
                    <span class="caption-helper">بيانات مشروع مقدم</span>
                </div>
                <div class="actions">
                    <a href="#confirmation_approval_modal" data-toggle="modal" class="btn font-balahmar btn-icon-only btn-circle font-balahmar tooltips" data-original-title="الموافقة أو الاعتذار لهذا المشروع"> <i class="fa fa-check font-balahmar"></i></a>
                    <a href="{{url('admin/projects')}}" class="btn font-balahmar btn-icon-only btn-circle tooltips" data-original-title="عودة لقائمة المشاريع"><i class="fa fa-list font-balahmar"></i></a>
                    <a href="{{url('admin/projects/unapproved')}}" class="btn font-balahmar btn-icon-only btn-circle tooltips" data-original-title="قائمة المشاريع تحت انتظار الاعتماد"><i class="fa fa-warning font-balahmar"></i></a>

                    @if($project->approval_status == 1 || $project->approval_status == 3)
                        <a href="{{url('http://balahmar.dev/projects/fetch/' . $project->office->id) . '/' . $project->id . '?office_name=' . $project->office->name}}"  target="_blank" class="btn btn-icon-only btn-circle tooltips" data-original-title="إضافة هذا المشروع في البرنامج الداخلي"><i class="fa fa-exchange font-balahmar"></i></a>
                    @endif
                </div>
            </div>
            <div class="portlet-body form">

                <!-- BEGIN FORM-->
                <div class="form-body">
                    <form action="" class="form-horizontal form-bordered form-row-stripped">
                        <div class="form-group">
                            <label class="control-label col-md-3"> الحالة </label>
                            <div class="col-md-9">
                                @if($project->approval_status == 0)
                                    <p class="label label-warning">لم تتم الموافقة</p>
                                @elseif($project->approval_status == 1 || $project->approval_status == 3)
                                    <p class="alert alert-success"> تمت الموافقة على المشروع بتاريخ: {{$project->hijri_approval_day . '/ ' . $project->hijri_approval_month . '/ ' . $project->hijri_approval_year}} هـ</p>
                                @elseif($project->approval_status == 2)
                                    <p class="alert alert-danger">اعتذار</p>
                                @elseif($project->approval_status == 4)
                                    <p class="alert alert-danger">الاكتفاء  بدعم مشروع سابق : {{$project->other_project_donated->name}}</p>
                                @elseif($project->approval_status == 5)
                                    <p class="alert alert-danger">يؤجل</p>
                                @elseif($project->approval_status == 6)
                                    <p class="alert alert-danger">طلب</p>
                                @endif
                            </div>
                        </div>
                        @if($project->donation_approved == 0)
                            @if($project->approval_status == 2)
                                @if($project->ban_reason != '')
                                    <div class="form-group ">
                                        <label class="control-label col-md-3">سبب الاعتذار عن الموافقة  </label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" style="white-space: pre-wrap" rows="4" readonly>{{$project->ban_reason}}</textarea>
                                        </div>
                                    </div>
                                @endif
                            @elseif($project->approval_status == 5)
                                @if($project->pending_reason != '')
                                    <div class="form-group ">
                                        <label class="control-label col-md-3">سبب تأجيل الموافقة  </label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" style="white-space: pre-wrap" rows="4" readonly>{{$project->pending_reason}}</textarea>
                                        </div>
                                    </div>
                                @endif
                            @elseif($project->approval_status == 6)
                                @if($project->requested_detail != '')
                                    <div class="form-group ">
                                        <label class="control-label col-md-3">الأشياء المطلوبة </label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" style="white-space: pre-wrap" rows="4" readonly>{{$project->requested_detail}}</textarea>
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endif
                        <div class="form-group">
                            <label class="control-label col-md-3"> تاريخ الطلب  </label>
                            <div class="col-md-2">
                                <p class="form-control">{{$project->hijri_created_day . '/ ' . $project->hijri_created_month . '/ ' . $project->hijri_created_year}} هـ</p>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3">اسم الجهة  </label>
                            <div class="col-md-7">
                                <p class="form-control">{{$project->office->name}}</p>
                            </div>
                            <div class="col-md-2">
                                <a href="{{url('admin/offices', $project->office->id)}}" class="btn btn-block green"><i class="fa fa-bank"></i> تفاصيل الجهة</a>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3">اسم المشروع  </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$project->name}}</p>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3">التعريف بالمشروع</label>
                            <div class="col-md-9">
                                <p class="abah-description" >{{$project->description}}</p>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3">التكلفة بالريال السعودي</label>
                            <div class="col-md-9">
                                <p class="form-control">{{number_format($project->donation_requested) }} {{$project->donation_requested > 0 ? '  (' . $project->donation_requested_in_words  . ' ريال سعودي)' : '' }} </p>
                            </div>

                        </div>

                        @if($project->donation_approved != 0)
                        <div class="form-group ">
                            <label class="control-label col-md-3">الدعم الممنوح من المؤسسة</label>
                            <div class="col-md-9">
                                <p class="form-control">{{number_format($project->donation_approved) }} {{$project->donation_approved > 0 ? '  (' . $project->donation_approved_in_words  . ' ريال سعودي)' : '' }} </p>
                            </div>
                        </div>

                            @if($project->donation_purpose != '')
                                <div class="form-group ">
                                    <label class="control-label col-md-3">المخصص لـ:</label>
                                    <div class="col-md-9">
                                        <p class="form-control">{{$project->donation_purpose }}</p>
                                    </div>
                                </div>
                            @endif
                        @endif

                        <div class="form-group ">
                            <label class="control-label col-md-3">تاريخ التنفيذ </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$project->hijri_execution_day . '/ ' . $project->hijri_execution_month . '/ ' . $project->hijri_execution_year}} هـ</p>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3">اسم الشحص للتواصل </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$project->responsible_person}}</p>

                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3">رقم جواله </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$project->mobile}}</p>

                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3">البريد الإلكتروني </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$project->email}}</p>

                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3" for="kind_id"> نوع المشروع </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$project->kind->name}}</p>


                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3" for="city_id"> المدينة </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$project->city->name}}</p>


                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3"> رابط فيديو</label>
                            <div class="col-md-9">
                                <p class="form-control">{{$project->video_link}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"> ملف المشروع</label>
                            @if($project->document_path == '')
                                <div class="col-md-9">
                                    <p class="form-control">لا يوجد</p>
                                </div>
                            @else
                            <div class="col-md-9">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-file-pdf-o font-grey-gallery"></i>
                                            <span class="caption-subject bold font-grey-gallery uppercase"> الملف </span>
                                            <span class="caption-helper">انقر السهم للمشاهدة</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="expand tooltips" data-original-title="المشاهدة"> </a>
                                            <a href="" class="fullscreen tooltips" data-original-title="ملء الشاشة"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body portlet-collapsed">
                                        <div class="image-letter">
                                            <iframe src="https://docs.google.com/gview?url={{url('files_projects', $project->document_path)}}&embedded=true" style="width: 100%; height: 800px"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
                <!-- END FORM-->
            </div>
        </div>
    </div>

    @if($project->approval_status == 1 || $project->approval_status == 3)
        <div class="row">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-pie-chart font-balahmar"></i>
                        <span class="caption-subject font-balahmar sbold">التقارير المرفوعة لهذا المشروع</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable table-scrollable-borderless">
                        <table class="table table-hover table-light">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th> التقرير للمرحلة </th>
                                <th> تاريخ الرفع </th>
                                <th> الفترة من </th>
                                <th> إلى </th>
                                <th> تفاصيل </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($reports) == 0)
                                <tr>
                                    <td colspan="7" class="text-center"><h4>لا توجد تقارير مرفوعة</h4></td>
                                </tr>
                            @else
                                @foreach($reports as $report)
                                    <tr>
                                        <td>{{++$report_seq_num}}</td>
                                        <td>{{$report->nth}}</td>
                                        <td>{{$report->hijri_created}} هـ</td>
                                        <td>{{$report->hijri_report_from_day . '/ ' . $report->hijri_report_from_month . '/ ' . $report->hijri_report_from_year}} هـ</td>
                                        <td>{{$report->hijri_report_to_day . '/ ' . $report->hijri_report_to_month . '/ ' . $report->hijri_report_to_year}} هـ</td>
                                        <td>
                                            <a href="{{url('admin/reports', $report->id)}}" class="btn btn-circle btn-icon-only font-balahmar tooltips" data-original-title="تفاصيل التقرير ورفع الصور"><i class="fa fa-file"></i></a>
                                            <a href="{{asset('files_reports') . '/' .$report->document_path}}" class="btn btn-circle btn-icon-only font-balahmar tooltips" data-original-title="ملف التقرير"><i class="fa fa-file-pdf-o"></i></a>
                                            @if($report->video_link != '')
                                                <a href="{{$report->video_link}}" target="_blank" class="btn btn-circle btn-icon-only font-balahmar tooltips" data-original-title="فتح رابط تقرير فيديو{{$report->video_link == '' ? 'لا يوجد تقرير فيديو' : 'فتح ملف تقرير فيديو'}}"><i class="fa fa-file-video-o"></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row margin-bottom-40">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-gift font-balahmar"></i>
                        <span class="caption-subject font-balahmar sbold">سندات استلام لهذا المشروع</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable table-scrollable-borderless">
                        <table class="table table-hover table-light">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th> تاريخ استلام </th>
                                <th> المبلغ </th>
                                <th> المستلم </th>
                                <th> العملية </th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($receipts) == 0)
                                <tr>
                                    <td colspan="7" class="text-center"><h4>لا يوجد سند استلام</h4></td>
                                </tr>
                            @else
                                @foreach($receipts as $receipt)
                                    <tr>
                                        <td>{{++$receipt_seq_num}}</td>
                                        <td>{{$receipt->hijri_received}} هـ</td>
                                        <td>{{number_format($receipt->amount)}} ريال </td>
                                        <td>{{$receipt->receiver_name}}</td>
                                        <td>
                                            <a href="{{url('admin/receipts', $receipt->id)}}" class="btn btn-circle btn-icon-only font-balahmar tooltips" data-original-title="تفاصيل سند استلام"><i class="fa fa-file"></i></a>
                                            <a href="{{asset('files_receipts') . '/' .$receipt->document_path}}" class="btn btn-circle btn-icon-only font-balahmar tooltips" data-original-title="صورة سند استلام"><i class="fa fa-file-image-o"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif


@endsection

@section('plugin_scripts')
    <script src="{{ asset('assets/global/plugins/bootbox/bootbox_abah_modified.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.plus.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.ummalqura.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.ummalqura-ar.js')}}" type="text/javascript"></script>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/admin_project_show.js') }}" type="text/javascript"></script>
@endsection
@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-shopping-cart font-blue-hoki"></i>
                    <span class="caption-subject font-blue-hoki bold">بيانات المشروع المقدم</span>
                </div>
                <div class="actions">
                    @if($project->approval_status != 1)
                        <a href="/projects/{{$project->id}}/edit" class="btn btn-icon-only btn-circle tooltips" data-original-title="تعديل"><i class="fa fa-pencil"></i></a>
                    @endif
                    <a href="/projects" class="btn btn-icon-only btn-circle tooltips" data-original-title="عودة لقائمة المشاريع"><i class="fa fa-list"></i></a>
                    @if($project->approval_status == 1)
                        <a href="{{url('projects', $project->id) .'/reports/create'}}" class="btn btn-icon-only btn-circle tooltips" data-original-title="تقديم تقرير لهذا المشروع"><i class="fa fa-file"></i></a>
                        @if(count($project->reports) > 0)
                            <a href="{{url('projects', $project->id) .'/reports'}}" class="btn btn-icon-only btn-circle tooltips" data-original-title="قائمة التقارير لهذا المشروع"><i class="fa fa-list-alt"></i></a>
                        @endif
                    @endif



                </div>
            </div>
            <div class="portlet-body form">

                <!-- BEGIN FORM-->
                <div class="form-body">
                    <form action="" class="form-horizontal form-bordered form-row-stripped">
                        <div class="form-group">
                            <label for="hijri_created" class="control-label col-md-3"> الحالة </label>
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
                            <label class="control-label col-md-3">اسم المشروع  </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$project->name}}</p>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3">التعريف بالمشروع</label>
                            <div class="col-md-9">
                                <p class="abah-description">{{$project->description}}</p>
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
                            <div class="col-md-9">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-file-pdf-o font-grey-gallery"></i>
                                            <span class="caption-subject bold font-grey-gallery"> الملف </span>
                                            <span class="caption-helper">انقر السهم للمشاهدة</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="expand tooltips" data-original-title="المشاهدة"> </a>
                                            <a href="" class="fullscreen tooltips" data-original-title="ملء الشاشة"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body portlet-collapsed">
                                        <div class="image-letter">
                                            <embed src="{{asset('files_projects') . '/' . $project->document_path}}" width="100%" height="1000" type='application/pdf'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="form-actions">
                    @if($project->approval_status != 1 && $project->approval_status != 3)
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <a href="{{url('/projects', $project->id)}}/edit" class="btn blue pull-right"><i class="fa fa-pencil"></i>  تعديل</a>
                            </div>
                        </div>
                    @endif
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
                    <div class="actions">
                        <a href="/reports/create" class="btn btn-icon-only btn-circle tooltips" data-original-title="إضافة تقرير جديد"><i class="fa fa-plus"></i></a>
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
                                            <a href="{{url('reports', $report->id)}}" class="btn btn-circle btn-icon-only font-balahmar tooltips" data-original-title="تفاصيل التقرير ورفع الصور"><i class="fa fa-file"></i></a>
                                            <a href="{{asset('files_reports') . '/' .$report->document_path}}" target="_blank" class="btn btn-circle btn-icon-only font-balahmar tooltips" data-original-title="ملف التقرير"><i class="fa fa-file-pdf-o"></i></a>
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
                    <div class="actions">
                        <a href="{{url('projects', $project->id) .'/receipts/create'}}" class="btn btn-icon-only btn-circle tooltips" data-original-title="إضافة سند استلام جديد"><i class="fa fa-plus"></i></a>
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
                                            <a href="{{url('receipts', $receipt->id)}}" class="btn btn-circle btn-icon-only font-balahmar tooltips" data-original-title="تفاصيل سند استلام"><i class="fa fa-file"></i></a>
                                            <a href="{{asset('files_receipts') . '/' .$receipt->document_path}}" target="_blank" class="btn btn-circle btn-icon-only font-balahmar tooltips" data-original-title="سورة سند استلام"><i class="fa fa-file-image-o"></i></a>
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
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/project_show.js') }}" type="text/javascript"></script>
@endsection
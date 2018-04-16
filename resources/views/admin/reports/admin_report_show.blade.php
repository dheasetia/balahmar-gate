@extends('layouts.main')

@section('plugin_styles')
    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-pie-chart font-balahmar"></i>
                <span class="caption-subject font-balahmar bold">بيانات التقرير المرفوع</span>
            </div>
            <div class="actions">
                <a href="{{url('admin/projects', $report->project->id) . '/reports'}}" class="btn font-balahmar btn-icon-only btn-circle tooltips" data-original-title="قائمة جميع التقارير الخاصة بهذا المشروع"><i class="fa fa-list"></i></a>
                <a href="{{url('admin/projects', $report->project->id)}}" class="btn font-balahmar btn-icon-only btn-circle tooltips" data-original-title="عودة لتفاصيل المشروع"><i class="fa fa-undo"></i></a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <div class="form-body">
                <div class="form form-horizontal form-bordered form-row-stripped">
                    <div class="form-group">
                        <label class="control-label col-md-3"> تاريخ التقرير  </label>
                        <div class="col-md-2">
                            <p class="form-control">{{$report->hijri_created_day . '/ ' . $report->hijri_created_month . '/ ' . $report->hijri_created_year}} هـ</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label  class="control-label col-md-3">اسم المشروع  </label>
                        <div class="col-md-9">
                            <p class="form-control">{{$report->project->name}}</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label  class="control-label col-md-3">تقرير للمرحلة  </label>
                        <div class="col-md-9">
                            <p class="form-control">{{$report->nth}}</p>
                        </div>
                    </div>


                    <div class="form-group">
                        <label  class="control-label col-md-3"> تقرير الفترة من  </label>
                        <div class="col-md-2">
                            <p class="form-control">{{$report->hijri_report_from_day . '/ ' . $report->hijri_report_from_month . '/ ' . $report->hijri_report_from_year}} هـ</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="control-label col-md-3"> لغاية  </label>
                        <div class="col-md-2">
                            <p class="form-control">{{$report->hijri_report_to_day . '/ ' . $report->hijri_report_to_month . '/ ' . $report->hijri_report_to_year}} هـ</p>
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="control-label col-md-3"> رابط فيديو</label>
                        <div class="col-md-9">
                            <a class="form-control" href="{{$report->video_link}}" target="_blank">{{$report->video_link}}</a>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">ملف التقرير</label>
                        <div class="col-md-9">
                            <div class="portlet">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-file-pdf-o"></i>ملف التقرير </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="expand" data-original-title="" title=""> </a>
                                        <a href="" class="fullscreen" data-original-title="" title=""> </a>
                                    </div>
                                </div>
                                <div class="portlet-body portlet-collapsed">
                                    <embed src="{{asset('files_reports') . '/' . $report->document_path}}" width="100%" height="1000" type='application/pdf'>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">صور مرفوعة</label>
                        <div class="col-md-9">
                            @if(count($report->pictures) > 0)
                                @foreach($report->pictures as $picture)
                                    <div class="col-sm-12 col-md-6">
                                        <div class="thumbnail">
                                            <img src="{{asset('files_pictures/') . '/' . $picture->path}}" alt="صورة" style="width: 100%; height: 200px; display: block;" data-src="{{asset('files_pictures/') . '/' . $picture->path}}">
                                            <div class="caption">
                                                <h4><a href="{{$picture->path}}">{{$picture->title}}</a></h4>
                                                <p> {{$picture->description}} </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="form-control">لا توجد</p>
                            @endif
                            <div class="clearfix"></div>
                                <hr>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END FORM-->
        </div>
    </div>
@endsection

@extends('layouts.main')

@section('content')
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet light portlet-fit ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-pie-chart font-balahmar"></i>
                    <span class="caption-subject font-balahmar sbold">التقارير المرفوعة لجميع المشاريع</span>
                </div>
                <div class="actions">
                    <a href="{{url('reports/create')}}" class="btn btn-default btn-icon-only btn-circle tooltips" data-original-title="رفع تقرير جديد"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable table-scrollable-borderless">
                    <table class="table table-hover table-light">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th>اسم المشروع</th>
                            <th> التقرير للمرحلة </th>
                            <th> تاريخ الرفع </th>
                            <th> الفترة من </th>
                            <th> إلى </th>
                            <th> ملفات </th>
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
                                    <td>{{++$seq_num}}</td>
                                    <td><a href="{{url('/reports', $report->id)}}" class="tooltips" data-original-title="تفاصيل التقرير ورفع الصور">{{$report->project->name}}</a></td>
                                    <td>{{$report->nth}}</td>
                                    <td>{{$report->hijri_created_day . '/ ' . $report->hijri_created_month . '/ ' . $report->hijri_created_year}} هـ</td>
                                    <td>{{$report->hijri_report_from_day . '/ ' . $report->hijri_report_from_month . '/ ' . $report->hijri_report_from_year}} هـ</td>
                                    <td>{{$report->hijri_report_to_day . '/ ' . $report->hijri_report_to_month . '/ ' . $report->hijri_report_to_year}} هـ</td>
                                    <td>
                                        <a href="{{asset('files_reports') . '/' .$report->document_path}}" class="btn btn-icon-only font-red tooltips" data-original-title="ملف التقرير"><i class="fa fa-file-pdf-o"></i></a>
                                        <a href="{{$report->video_link}}" target="_blank" class="btn btn-icon-only font-red tooltips" data-original-title="فتح رابط تقرير فيديو{{$report->video_link == '' ? 'لا يوجد تقرير فيديو' : 'فتح ملف تقرير فيديو'}}"><i class="fa fa-file-video-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>

@endsection
@extends('layouts.main')

@section('content')
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet light portlet-fit ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-pie-chart font-balahmar"></i>
                    <span class="caption-subject font-balahmar">التقارير المرفوعة لجميع المشاريع</span></span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable table-scrollable-borderless">
                    <table class="table table-hover table-light">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> اسم المشروع </th>
                            <th> التقرير للمرحلة </th>
                            <th> تاريخ الرفع </th>
                            <th> الفترة من </th>
                            <th> إلى </th>
                            <th> الملف </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($reports) == 0)
                            <tr>
                                <td colspan="7" class="text-center"><h4>لا يوجد </h4></td>
                            </tr>
                        @else
                            @foreach($reports as $report)
                                <tr>
                                    <td>{{++$seq_num}}</td>
                                    <td><a href="{{url('admin/projects', $report->project->id)}}" class="tooltips" data-original-title="تفاصيل المشروع">{{$report->project->name}}</a></td>
                                    <td>{{$report->nth}}</td>
                                    <td>{{$report->hijri_created_day . '/ ' . $report->hijri_created_month . '/ ' . $report->hijri_created_year}} هـ</td>
                                    <td>{{$report->hijri_report_from_day . '/ ' . $report->hijri_report_from_month . '/ ' . $report->hijri_report_from_year}} هـ</td>
                                    <td>{{$report->hijri_report_to_day . '/ ' . $report->hijri_report_to_month . '/ ' . $report->hijri_report_to_year}} هـ</td>
                                    <td>
                                        <a href="{{url('admin/reports', $report->id)}}" class="btn btn-icon-only font-red tooltips" data-original-title="مشاهدة التقرير"><i class="fa fa-file"></i></a>
                                        @if($report->video_link != '')
                                            <a href="{{$report->video_link}}" target="_blank" class="btn btn-icon-only font-red tooltips" data-original-title="فتح رابط تقرير فيديو{{$report->video_link == '' ? 'لا يوجد تقرير فيديو' : 'فتح ملف تقرير فيديو'}}"><i class="fa fa-file-video-o"></i></a>
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
        <!-- END BORDERED TABLE PORTLET-->
    </div>

@endsection
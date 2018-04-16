@extends('layouts.main')
@section('custom_styles')
    <style>
        .label {
            font-family: DroidNaskh, "Open Sans", sans-serif;
        }
    </style>
@endsection
@section('content')
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet light portlet-fit ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-wrench font-balahmar"></i>
                    <span class="caption-subject font-balahmar sbold">المشاريع التابعة للجهة: {{$office->name}}</span>
                </div>
                <div class="actions">
                    <a href="{{url('admin/offices', $office->id)}}" class="btn btn-icon-only btn-circle tooltips" data-original-title="عودة لبيانات الجهة"><i class="fa fa-building font-balahmar"></i></a>
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
                        @if(count($projects) == 0)
                            <tr>
                                <td colspan="9" class="text-center"><h4>لا توجد مشاريع مقدمة</h4></td>
                            </tr>
                        @else
                            @foreach($projects as $project)
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
        <!-- END BORDERED TABLE PORTLET-->
    </div>

@endsection
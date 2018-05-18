@extends('layouts.main')

@section('content')
    <div class="col-md-12">
        @if($office->is_suspended == 1)
            <div class="alert alert-danger">
                <h5> تعتذر المؤسسة عن استقبال المشاريع لفترة محدودة </h5>
                <p>يمكن للجهة تقديم مشاريعها لاحقا بإذن الله</p>
            </div>
        @endif
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet light portlet-fit ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-wrench font-balahmar"></i>
                    <span class="caption-subject bold font-balahmar"> المشاريع</span>
                    <span class="caption-helper">قائمة المشاريع المقدمة</span>
                </div>
                <div class="actions">
                    @if($office->is_suspended == 0)
                    <a href="{{url('/projects/create')}}" class="btn bt-default btn-circle btn-icon-only tooltips" data-original-title="تقديم مشروع جديد"><i class="fa fa-plus"></i></a>
                    @endif
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable table-bordered">
                    <table class="table table-hover table-light margin-bottom-20">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> اسم المشروع </th>
                            <th> نوع المشروع </th>
                            <th>  تاريخ الطلب </th>
                            <th> تاريخ التنفيذ </th>
                            <th> الحالة </th>
                            <th> مبلغ الدعم </th>
                            <th class="text-center"> الملف </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($projects) == 0)
                            <tr>
                                <td colspan="9" class="text-center"><h4>لا توجد مشروع مقدم</h4></td>
                            </tr>
                        @else
                            @foreach($projects as $project)
                                <tr>
                                    <td>{{++$seq_num}}</td>
                                    <td><a href="{{url('projects', $project->id)}}" class="tooltips" data-original-title="تفاصيل المشروع">{{$project->name}}</a></td>
                                    <td>{{$project->kind->name}}</td>
                                    <td>{{$project->hijri_created_day . '/ ' . $project->hijri_created_month . '/ ' . $project->hijri_created_year}}</td>
                                    <td>{{$project->hijri_execution_day . '/ ' . $project->hijri_execution_month . '/ ' . $project->hijri_execution_year}}</td>
                                    <td><span class="label label-{{$project->status_class}}">{{$project->status}}</span></td>
                                    <td>{{$project->donation_approved > 0 ? number_format($project->donation_approved) : '---'}}</td>
                                    <td>
                                        <a href="{{asset('files_projects') . '/' .$project->document_path}}" class="btn btn-circle btn-icon-only font-balahmar tooltips" data-original-title="مشاهدة ملف طلب المشروع"><i class="fa fa-file-pdf-o"></i></a>
                                        @if(count($project->reports) == 0)
                                            <a href="{{url('reports/create?project_id', $project->id)}}" class="btn btn-sm btn-icon-only btn-circle font-balahmar tooltips" data-original-title="إضافة تقرير لهذا المشروع"><i class="fa fa-calendar-plus-o"></i></a>
                                        @else
                                            <a href="{{url('projects', $project->id) . '/reports'}}" class="btn btn-sm btn-circle btn-icon-only font-balahmar tooltips" data-original-title="{{count($project->reports) > 0 ? 'التقارير المرفوعة لهذا المشروع' : 'التقارير المرفوعة لهذا المشروع (لا يوجد تقرير)'}}"><i class="fa fa-pie-chart"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>

                </div>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>

@endsection
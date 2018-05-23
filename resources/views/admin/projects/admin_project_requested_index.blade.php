@extends('layouts.main')

@section('style_plugins')
    <link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap-rtl.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('custom_styles')
    <style>
        .label {
            font-family: DroidNaskh, "Open Sans", sans-serif;
        }
        .dataTables_filter{
            text-align: left;
        }

        .dataTables_filter input.form-control{
            margin-right: 10px;
        }

        .dataTables_length select.form-control{
            margin-left: 10px;
        }
        .dataTables_info{
            padding: 18px;
            font-weight: bold;
        }
        .dataTables_paginate{
            text-align: left;
        }
        th {
            text-align: center;
            padding: 10px 18px!important;
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
                    <span class="caption-subject bold font-balahmar uppercase"> المشاريع</span>
                    <span class="caption-helper"> التي طلب منها طلبات</span>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-bordered table-striped" id="projects_table">
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
                        <th style="min-width: 100px;"> الملف </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($requested_projects) == 0)
                        <tr>
                            <td colspan="9" class="text-center"><h4>لا توجد مشروع تم اعتماده</h4></td>
                        </tr>
                    @else
                        @foreach($requested_projects as $project)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><a href="{{url('admin/projects', $project->id)}}" class="tooltips" data-original-title="تفاصيل المشروع">{{$project->name}}</a></td>
                                <td>{{$project->hijri_created}}</td>
                                <td><a href="{{url('admin/offices', $project->office->id)}}" class="tooltips" data-original-title="تفاصيل الجهة">{{$project->office->name}}</a></td>
                                <td>{{$project->kind->name}}</td>
                                <td>{{$project->city->name}}</td>
                                <td>{{$project->hijri_execution_day . '/ ' . $project->hijri_execution_month . '/ ' . $project->hijri_execution_year}}</td>
                                <td><span class="label label-{{$project->status_class}}">{{$project->status}}</span></td>
                                <td>
                                    <a href="{{asset('files_projects') . '/' .$project->document_path}}" class="btn btn-circle btn-icon-only font-balahmar tooltips" data-original-title="مشاهدة ملف طلب المشروع"><i class="fa fa-file-pdf-o"></i></a>
                                    <a href="{{url('admin/projects', $project->id) . '/reports'}}" class="btn btn-circle btn-icon-only font-balahmar tooltips" data-original-title="{{count($project->reports) > 0 ? 'التقارير المرفوعة لهذا المشروع' : 'التقارير المرفوعة لهذا المشروع (لا يوجد تقرير)'}}"><i class="fa fa-pie-chart"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>

@endsection

@section('plugin_scripts')
    <script src="{{ asset('assets/global/scripts/datatable.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/admin_project_index.js')}}" type="text/javascript"></script>
@endsection
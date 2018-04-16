@extends('layouts.main')

@section('custom_styles')
    <style>
        .label {
            font-family: DroidNaskh, "Open Sans", sans-serif;
        }
        th {
            text-align: center;
        }
    </style>
@endsection

@section('content')
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet light portlet-fit ">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject bold" id="portlet_title"> المشاريع تحت انتظار الاعتماد</span>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-bordered table-striped" id="projects_table">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> اسم المشروع </th>
                        <th style="min-width: 90px"> التقديم </th>
                        <th> الجهة المقدمة </th>
                        <th> نوعه </th>
                        <th> المدينة </th>
                        <th style="min-width: 90px"> التنفيذ </th>
                        <th>الحالة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($unapproved_projects) == 0)
                        <tr>
                            <td colspan="9" class="text-center"><h4>لا توجد مشاريع تحت انتطار الاعتماد</h4></td>
                        </tr>
                    @else
                        @foreach($unapproved_projects as $project)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$project->name}}</td>
                                <td>{{$project->hijri_created}} </td>
                                <td>{{$project->office->name}}</td>
                                <td>{{$project->kind->name}}</td>
                                <td>{{$project->city->name}}</td>
                                <td>{{$project->hijri_execution_day . '/ ' . $project->hijri_execution_month . '/ ' . $project->hijri_execution_year}} </td>
                                <td>{{$project->status}}</td>
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

@section('page_scripts')
    <script>
        jQuery(document).ready(function () {
            $('#portlet_title').text("قائمة المشاريع تحت انتظار الاعتماد بتاريخ: " + new Date().toLocaleDateString('ar-SA') + ' م');
            $(this).attr("title", "قائمة المشاريع تحت انتظار الاعتماد: " + new Date().toLocaleDateString('ar-SA') + ' م');
            window.print();
            setTimeout(function () {
                window.close();
            }, 500);
        })
    </script>
@endsection
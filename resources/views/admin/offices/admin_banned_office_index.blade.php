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
        .dataTables_info{
            padding: 18px;
            font-weight: bold;
        }
        .dataTables_paginate{
            text-align: left;
        }
        .dataTables_filter input.form-control{
            margin-right: 10px;
        }

        .dataTables_length select.form-control{
            margin-left: 10px;
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
        <div class="portlet light portlet-fit">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bank font-balahmar"></i>
                    <span class="caption-subject bold font-balahmar uppercase"> الجهات</span>
                    <span class="caption-helper">تعتذر المؤسسة عن الموفقة عليها</span>
                </div>
                <div class="actions">
                    <a href="{{url('admin/offices/banned')}}" class="btn btn-icon-only btn-circle tooltips" data-original-title="تحديث"><i class="fa fa-refresh font-balahmar"></i></a>
                    <a href="{{url('admin/offices')}}" class="btn btn-icon-only btn-circle tooltips" data-original-title="جميع الجهات"><i class="fa fa-list font-balahmar"></i></a>
                    <a href="{{url('admin/offices/approved')}}" class="btn btn-icon-only btn-circle tooltips" data-original-title="الجهات المعتمدة"><i class="fa fa-gavel font-balahmar"></i></a>
                    <a href="{{url('admin/offices/unapproved')}}" class="btn btn-icon-only btn-circle tooltips" data-original-title="الجهات في انتظار الاعتماد "><i class="fa fa-warning font-balahmar"></i></a>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-bordered table-striped" id="office_list_table">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> اسم الجهة </th>
                        <th> تاريخ التسجيل </th>
                        <th> المدينة </th>
                        <th> حالة الموافقة </th>
                        <th> ممثل الجهة </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($banned_offices) == 0)
                        <tr>
                            <td colspan="6" class="text-center"><h4>لا توجد جهة تعتذر المؤسسة عن الموافقة عليها</h4></td>
                        </tr>
                    @else
                        @foreach($banned_offices as $office)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><a href="{{url('admin/offices', $office->id)}}" class="tooltips" data-original-title="تفاصيل الجهة">{{$office->name}}</a></td>
                                <td>{{DateDiff::inArabic($office->created_at)}}</td>
                                <td>{{$office->city->name}}</td>
                                <td>
                                    @if($office->is_banned == 1)
                                        <span class="label label-danger">اعتذار</span>
                                    @else
                                        @if($office->is_approved == 1)
                                            <span class="label label-success">اعتمد</span>
                                        @else
                                            <span class="label label-warning">انتظار</span>
                                        @endif
                                    @endif
                                </td>
                                <td>{{$office->representative}}</td>
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
    <script src="{{asset('assets/layouts/layout3/scripts/admin_office_index.js')}}" type="text/javascript"></script>
@endsection
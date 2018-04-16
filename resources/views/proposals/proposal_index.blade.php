@extends('layouts.main')

@section('content')
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet light portlet-fit ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-shopping-cart font-balahmar"></i>
                    <span class="caption-subject font-balahmar sbold">الطلبات المقدمة</span>
                </div>
                <div class="actions">
                    <a href="/proposal/create" class="btn btn-default btn-icon-only btn-circle tooltips" data-original-title="إضافة طلب جديد"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable table-scrollable-borderless">
                    <table class="table table-hover table-light">
                        <thead>
                        <tr>
                            <th> # </th>
                            <th> تاريخ التقديم </th>
                            <th> اسم المشروع </th>
                            <th> نوع المشروع </th>
                            <th> المدينة </th>
                            <th> تاريخ التنفيذ </th>
                            <th> حالة الطلب </th>
                            <th> الملف </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($proposals) == 0)
                            <tr>
                                <td colspan="5" class="text-center"><h4>لا توجد طلبات مقدمة</h4></td>
                            </tr>
                        @else
                            @foreach($proposals as $proposal)
                                <tr>
                                    <td>{{++$seq_num}}</td>
                                    <td>{{$proposal->hijri_created_day . '/ ' . $proposal->hijri_created_month . '/ ' . $proposal->hijri_created_year}} هـ</td>
                                    <td><a href="{{url('proposals', $proposal->id)}}" class="tooltips" data-original-title="تفاصيل الطلبات">{{$proposal->project_name}}</a></td>
                                    <td>{{$proposal->kind->name}}</td>
                                    <td>{{$proposal->city->name}}</td>
                                    <td>{{$proposal->hijri_execution_day . '/ ' . $proposal->hijri_execution_month . '/ ' . $proposal->hijri_execution_year}} هـ</td>
                                    <td>{!! $proposal->status !!}</td>
                                    <td><a href="{{asset('files_proposals') . '/' .$proposal->document_path}}"
                                           class="btn btn-icon-only font-red tooltips" data-original-title="ملف الطلب"><i class="fa fa-file-pdf-o"></i></a>
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
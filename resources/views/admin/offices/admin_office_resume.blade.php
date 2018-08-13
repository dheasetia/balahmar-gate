@extends('layouts.main')

@section('custom_styles')
    <style>
        .detail_label {
            font-family: "DroidKufi", serif;
            text-align: left;
        }

        .office_item_row {
            margin-top: 10px;

        }
        .row_date {
            width: 50px;
        }
        .photo {
            width: 100%;
        }
        .photo img {
            margin: 30px auto;
            width: 130px;
            height: 130px;
            -webkit-border-radius: 50% !important;
            -moz-border-radius: 50% !important;
            border-radius: 50% !important;
        }
        .img-responsive{
            display: block;
        }
        .office-name {
            background-color: #007269;
            padding: 20px;
            color: #ffffff;
        }
        .form-control-static {
            width: 100%;
            padding: 6px 12px;
            background-color: #fff;
            margin: 10px 0;
            border: 1px solid #c2cad8;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
            -webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        }
        .control-label{
            text-align: left;
        }

        .form-section{
            padding-right: 20px;
        }
        @media print {
            .btn {
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject bold">ملخص الجهة المستفيدة</span>
            </div>
            <div class="actions">
                <a href="{{url('admin/offices', $office->id)}}" class="btn btn-icon-only btn-circle tooltips" data-original-title="عودة لتفاصيل الجهة"><i class="fa fa-undo font-balahmar"></i></a>
                <button type="button" class="btn btn-icon-only btn-circle tooltips" onclick="window.print()"><i class="fa fa-print font-balahmar"></i></button>
            </div>
        </div>
        <div class="portlet-body">
            <div class="row">
                <span class="col-xs-3 detail_label">الاسم:</span>
                <span class="col-xs-9">{{$office->name}}</span>
            </div>
            <div class="row office_item_row">
                <span class="col-xs-3 detail_label">التعريف المختصر:</span>
                <span class="col-xs-9">{{$office->description}}</span>
            </div>
            <div class="row office_item_row">
                <span class="col-xs-3 detail_label">اسم المدير العام:</span>
                <span class="col-xs-9">{{$office->manager_name or '_____'}}</span>
            </div>
            <div class="row office_item_row">
                <span class="col-xs-3 detail_label">الجهة المشرفة:</span>
                <span class="col-xs-9">{{$office->advisor->name}}</span>
            </div>
            <div class="row office_item_row">
                <span class="col-xs-3 detail_label">رقم الترخيص:</span>
                <span class="col-xs-9">{{$office->license_no}}</span>
            </div>
            <div class="row office_item_row">
                <span class="col-xs-3 detail_label">تاريخ الترخيص:</span>
                <span class="col-xs-9">{{$office->license_date}} هـ </span>
            </div>
            <div class="row office_item_row">
                <span class="col-xs-3 detail_label">اسم البنك:</span>
                <span class="col-xs-9">{{$office->bank->name}}</span>
            </div>

            <div class="row office_item_row">
                <span class="col-xs-3 detail_label">رقم الأيبان:</span>
                <span class="col-xs-9">{{$office->iban}}</span>
            </div>

            <div class="row office_item_row">
                <span class="col-xs-3 detail_label">اسم ممثل الجهة:</span>
                <span class="col-xs-9">{{$office->representative}}</span>
            </div>
            <div class="row office_item_row">
                <span class="col-xs-3 detail_label">رقم جواله:</span>
                <span class="col-xs-9">{{$office->mobile}}</span>
            </div>
            <div class="row office_item_row">
                <span class="col-xs-3 detail_label">البريد الإلكتروني:</span>
                <span class="col-xs-9">{{$office->email}}</span>
            </div>

            <div class="row office_item_row">
                <span class="col-xs-3 detail_label">العنوان:</span>
                <span class="col-xs-9">{{$office->street}}، {{$office->district}}، {{$office->city->name}}، المنطقة {{$office->area->name}}، {{$office->zip_code}}، ص. ب: {{$office->po_box}} </span>
            </div>

        </div>
    </div>
    <div class="portlet light">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject bold">المشاريع لهذه الجهة</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-bordered">
                <table class="table table-hover table-light margin-bottom-20">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> اسم المشروع </th>
                        <th> تاريخ التقديم </th>
                        <th> نوع المشروع </th>
                        <th> المدينة </th>
                        <th> تاريخ التنفيذ </th>
                        <th>الحالة</th>
                        <th>مبلغ الاعتماد</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($office->projects) == 0)
                        <tr>
                            <td colspan="9" class="text-center"><h4>لا توجد مشاريع لهذه الجهة</h4></td>
                        </tr>
                    @else
                        @foreach($office->projects as $project)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$project->name}}</td>
                                <td>{{$project->hijri_created}} </td>
                                <td>{{$project->kind->name}}</td>
                                <td>{{$project->city->name}}</td>
                                <td>{{$project->hijri_execution_day . '/ ' . $project->hijri_execution_month . '/ ' . $project->hijri_execution_year}} </td>
                                <td>{{$project->status}}</td>
                                <td>{{$project->donation_approved == 0 ? '---' : number_format($project->donation_approved)}}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <br><br><br><br><br>
@endsection


@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/admin_office_show.js') }}" type="text/javascript"></script>
@endsection
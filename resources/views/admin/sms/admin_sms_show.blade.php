@extends('layouts.main')

@section('plugin_styles')
    <link href="{{asset('assets/apps/css/inbox-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/apps/css/inbox-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .message-body {
            margin: 20px !important;
            border: 1px solid whitesmoke;
            border-radius: 10px;
            padding: 10px;
            min-height: 200px;
            background: #f0f9f9;
        }
        .portlet-body .title{
            margin: 20px !important;
            border: 1px solid whitesmoke;
            border-radius: 10px;
            padding: 10px;
            background: #f0f9f9;
        }
        .portlet-body .title h5 {
            display: inline-block;
        }
        .portlet-body .title>span{
            display: inline-block;
            float: left;
            padding: 10px;
        }
        .photo img {
            width: 30px;
            height: 30px;
            -webkit-border-radius: 50% !important;
            -moz-border-radius: 50% !important;
            border-radius: 50% !important;
        }
        .timeline-badge .timeline-badge-userpic {
            height: 80px;
        }
        .timeline-body-title{
            font-family: DroidKufi, "Helvetica Neue", Helvetica, Arial;
        }
    </style>
@endsection

@section('content')
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-envelope font-balahmar"></i>
                <span class="caption-subject bold font-balahmar uppercase"> رسائل الجوال</span>
                <span class="caption-helper">تفاصيل الرسالة النصية</span>
            </div>
            <div class="actions">
                <a href="/admin/sms" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="عودة لقائمة الرسائل"><i class="fa fa-list"></i></a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="title">
                <h5>الموضوع: <span class="bold">{{$sms->subject}}</span></h5>
                <span class="date">{{DateDiff::inArabic($sms->created_at)}} ({{$sms->created_at->format('Y/m/d - H:i')}})</span>
            </div>
            <div class="message-body">{!! $sms->text !!}</div>
        </div>
    </div>
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption">
                <i class=" fa fa-users font-balahmar"></i>
                <span class="caption-subject font-balahmar">المرسل إليهم</span>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable table-scrollable-borderless">
                <table class="table table-hover table-light">
                    <thead>
                    <tr>
                        <th colspan="2"> المستخدم </th>
                        <th colspan="2"> الجهة التابعة </th>
                        <th> حالة الإرسال </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($sms_details) > 0)
                        @foreach($sms_details as $detail)
                            <tr>
                                <td class="photo">
                                    <img class="" src="{{$detail->recipient->avatar != '' ? asset('files_avatars') . '/' . $detail->recipient->avatar : asset('files_avatars/avatar_blank.jpeg')}}"> </td>
                                <td>
                                    <a href="{{url('admin/users', $detail->recipient->id)}}" class="primary-link tooltips" data-original-title="تفاصيل المستخدم">{{$detail->recipient->name}}</a>
                                </td>
                                @if($detail->recipient->office != null)
                                    <td class="photo"><img class="" src="{{$detail->recipient->office->logo != '' ? asset('files_logos') . '/' . $detail->recipient->office->logo : asset('files_logos/logo-blank.png')}}"> </td>
                                    <td><a href="{{url('admin/offices', $detail->recipient->office->id)}}" class="primary-link tooltips" data-original-title="تفصيل الجهة">{{$detail->recipient->office->name}}</a></td>
                                @else
                                    <td>لا توجد</td>
                                    <td>لا توجد</td>
                                @endif
                                <td>
                                    @if($detail->status == 1)
                                        <span class="label label-sm label-success"><i class="fa fa-check"></i> نجاح</span>
                                    @else
                                        <span class="label label-sm label-danger"><i class="fa fa-close"></i> فشل</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td><h4>لا يوجد مرسل إليهم</h4></td>
                    @endif
                    </tbody></table>
            </div>
        </div>
    </div>
    <br><br><br><br>
@endsection

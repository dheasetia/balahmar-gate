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
                <span class="caption-subject bold font-balahmar uppercase"> الرسائل الداخلية</span>
                <span class="caption-helper">تفاصيل الرسالة وقائمة المرسل إليهم</span>
            </div>
            <div class="actions">
                @if($message->attachment != '')
                    <a href="{{asset('files_messages/' . $message->attachment)}}" target="_blank" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="مرفقات"><i class="fa fa-paperclip"></i></a>
                @endif
                <a href="/messages" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="عودة لقائمة الرسائل"><i class="fa fa-list"></i></a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="title">
                <h5>الموضوع: <span class="bold">{{$message->subject}}</span></h5>
                <span class="date">{{DateDiff::inArabic($message->created_at)}} ({{$message->created_at->format('Y/m/d - H:i')}})</span>
            </div>
            <div class="message-body">{!! $message->body !!}</div>
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
                        <th> الجهة التابعة </th>
                        <th> مشاهدة الرسالة </th>
                        <th> وقت المشاهدة </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($message->recipients) > 0)
                        @foreach($message->recipients as $user)
                            <tr>
                                <td class="photo">
                                    <img class="" src="{{$user->avatar != '' ? asset('files_avatars') . '/' . $user->avatar : asset('files_avatars/avatar_blank.jpeg')}}"> </td>
                                <td>
                                    <a href="{{url('users', $user->id)}}" class="primary-link tooltips" data-original-title="تفاصيل المستخدم">{{$user->name}}</a>
                                </td>
                                @if(isset($user->office))
                                    <td><a href="{{url('offices', $user->office->id)}}" class="primary-link tooltips" data-original-title="تفصيل الجهة">{{$user->office->name}}</a></td>
                                @else
                                    <td>---</td>
                                @endif

                                @if(\App\Libraries\Helpers::getMessageRecipientDetail($user->id, $message->id)->is_read == 1)
                                    <td><i class="fa fa-eye font-blue tooltips" data-original-title="تمت المشاهدة"></i></td>
                                @else
                                    <td><i class="fa fa-eye tooltips" data-original-title="لم تتم المشاهدة"></i></td>
                                @endif
                                <td> {{\App\Libraries\Helpers::getMessageRecipientDetail($user->id, $message->id)->read_time == null ? '--' : \App\Libraries\Helpers::getMessageRecipientDetail($user->id, $message->id)->read_time->format('d/ m/ Y')}} </td>
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

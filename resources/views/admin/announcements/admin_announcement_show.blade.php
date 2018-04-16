@extends('layouts.main')

@section('plugin_styles')
    <link href="{{asset('assets/apps/css/inbox-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/apps/css/inbox-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .announcement-body {
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
    </style>
@endsection

@section('content')
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption">
                <i class=" fa fa-bullhorn font-balahmar"></i>
                <span class="caption-subject font-balahmar">إشعارات</span>
            </div>
            <div class="actions">
                @if($announcement->attachment != '')
                    <a href="{{asset('files_announcements/' . $announcement->attachment)}}" target="_blank" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="مرفقات"><i class="fa fa-paperclip"></i></a>
                @endif
                <a href="{{url('/admin/announcements', $announcement->id) . '/edit'}}" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="تعديل هذا الإشعار"><i class="fa fa-pencil"></i></a>
                <a href="/admin/announcements" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="عودة لقائمة الإشعارات"><i class="fa fa-list"></i></a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="title">
                <h5>الموضوع: <span class="bold">{{$announcement->subject}}</span></h5>
                <span class="date">{{$announcement->created_at->format('d/ m/ Y')}}</span>
            </div>
            <div class="announcement-body">{!! $announcement->body !!}</div>
        </div>
    </div>

@endsection

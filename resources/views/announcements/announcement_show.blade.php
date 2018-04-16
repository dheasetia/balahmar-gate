@extends('layouts.main')

@section('plugin_styles')
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
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" fa fa-bullhorn font-balahmar"></i>
                        <span class="caption-subject font-balahmar">إشعارات</span>
                    </div>
                    <div class="actions">
                        <a href="/announcements" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="عودة لقائمة الإشعارات"><i class="fa fa-list"></i></a>
                        @if($announcement->detail->is_favourite == 0)
                            <a href="{{url('announcements', $announcement->id) . '/favourite'}}" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="إدخال في المفضلة"><i class="fa fa-star"></i></a>
                        @else
                            <a href="{{url('announcements', $announcement->id) . '/favourite'}}" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="إلغاء من المفضلة"><i class="fa fa-star font-blue"></i></a>
                        @endif
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
        </div>
    </div>
@endsection

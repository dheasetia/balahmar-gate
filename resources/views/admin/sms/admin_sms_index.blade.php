@extends('layouts.main')

@section('plugin_styles')
    <style>
        th {
            font-family: DroidKufi, "Helvetica Neue", Helvetica, Arial;
            text-align: center;
        }
        .mt-comment-img img {
            margin: 10px 0;
            width: 45px;
            height: 45px;
            -webkit-border-radius: 50% !important;
            -moz-border-radius: 50% !important;
            border-radius: 50% !important;
        }
    </style>
@endsection

@section('content')
<div class="portlet light ">
    <div class="portlet-title tabbable-line">
        <div class="caption">
            <i class="fa fa-mobile font-balahmar"></i>
            <span class="caption-subject bold font-balahmar uppercase"> رسائل الجوال</span>
            <span class="caption-helper">قائمة الرسائل</span>
        </div>
        <div class="actions">
            <a href="{{url('/admin/sms/create')}}" class="btn btn-icon-only btn-circle tooltips" data-original-title="رسالة جديدة"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="portlet-body">
        <div class="mt-comments">
            @if(count($sms) > 0)
                @foreach($sms as $item)
                    <div class="mt-comment">
                        <div class="mt-comment-img">
                            <img src="{{$item->creator->avatar != '' ? asset('files_avatars' . '/' . $item->creator->avatar) : asset('files_logos/logo-blank.png')}}">
                        </div>
                        <div class="mt-comment-body">
                            <div class="mt-comment-info">
                                <span class="mt-comment-author"><h5>{{$item->creator->name}} {{$item->creator_id == Sentinel::getUser()->id ? '(أنت)' : ''}}</h5> {{$item->creator->office->name or '---'}}</span>
                                <span class="mt-comment-date">{{DateDiff::inArabic($item->created_at)}} ({{$item->created_at->format('Y/m/d - H:i')}})</span>
                            </div>
                            <div class="mt-comment-text"><a href="{{url('admin/sms', $item->id)}}" class="tooltips" data-original-title="مشاهدة الرسالة">
                                    <strong class="font-blue-chambray">{{$item->subject}}</strong> [{!! str_limit(strip_tags($item->text), 50) !!}]</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="mt-comment"><h4>لا توجد رسائل </h4></div>
            @endif
        </div>
    </div>
</div>
@endsection
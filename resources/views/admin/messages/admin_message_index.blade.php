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
            <i class="fa fa-envelope font-balahmar"></i>
            <span class="caption-subject bold font-balahmar uppercase"> الرسائل الداخلية</span>
            <span class="caption-helper">قائمة الرسائل</span>
        </div>
        <div class="actions">
            <a href="{{url('/admin/messages/create')}}" class="btn btn-icon-only btn-circle tooltips" data-original-title="رسالة جديدة"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    <div class="portlet-body">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#inbox" data-toggle="tab" aria-expanded="false"><i class="fa fa-download font-balahmar"></i> الرسائل الواردة{{count($inbox) ? '(' . count($inbox) . ')' : ''}}</a>
            </li>
            <li class="">
                <a href="#outbox" data-toggle="tab" aria-expanded="true"><i class="fa fa-upload font-balahmar"></i> الرسائل الصادرة {{count($outbox) ? '(' . count($outbox) . ')' : ''}}</a>
            </li>
            <li class="">
                <a href="#draft" data-toggle="tab" aria-expanded="true"><i class="fa fa-file-text font-balahmar"></i> الرسائل المسودة  {{count($drafts) ? '(' . count($dafts) . ')' : ''}}</a>
            </li>

        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="inbox">
                <div class="mt-comments">
                    @if(count($inbox) > 0)
                        @foreach($inbox as $item)
                            <div class="mt-comment">
                                <div class="mt-comment-img">
                                    <img src="{{$item->creator->avatar != '' ? asset('files_avatars' . '/' . $item->creator->avatar) : asset('files_logos/logo-blank.png')}}">
                                </div>
                                <div class="mt-comment-body">
                                    <div class="mt-comment-info">
                                        <span class="mt-comment-author"><h5>{{$item->creator->name}} {{$item->creator_id == Sentinel::getUser()->id ? '(أنت)' : ''}}</h5> {{$item->creator->office->name or '---'}}</span>
                                        <span class="mt-comment-date">{{DateDiff::inArabic($item->created_at)}} ({{$item->created_at->format('Y/m/d - H:i')}})</span>
                                    </div>
                                    <div class="mt-comment-text"><a href="{{url('admin/messages', $item->id)}}" class="tooltips" data-original-title="مشاهدة الرسالة">
                                            <strong class="font-blue-chambray">{{$item->subject}}</strong> [{!! str_limit(strip_tags($item->body), 50) !!}]</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="mt-comment"><h4>لا توجد رسائل واردة</h4></div>
                    @endif
                </div>
            </div>
            <div class="tab-pane" id="outbox">
                <div class="mt-comments">
                    @if(count($outbox) > 0)
                        @foreach($outbox as $item)
                            <div class="mt-comment">
                                <div class="mt-comment-img">
                                    <img src="{{$item->creator->avatar != '' ? asset('files_avatars' . '/' . $item->creator->avatar) : asset('files_logos/logo-blank.png')}}">
                                </div>
                                <div class="mt-comment-body">
                                    <div class="mt-comment-info">
                                        <span class="mt-comment-author"><h5>{{$item->creator->name}}</h5> {{$item->creator->office->name or '---'}}</span>
                                        <span class="mt-comment-date">{{DateDiff::inArabic($item->created_at)}} ({{$item->created_at->format('Y/m/d - H:i')}})</span>
                                    </div>
                                    <div class="mt-comment-text"><a href="{{url('admin/messages', $item->id)}}" class="tooltips" data-original-title="مشاهدة الرسالة">
                                            <strong class="font-blue-chambray">{{$item->subject}}</strong> [{!! str_limit(strip_tags($item->body), 50) !!}]</a>
                                    </div>
                                    <div class="mt-comment-details">
                                        <ul class="mt-comment-actions">
                                            <li>
                                                <a href="{{url('admin/messages', $item->id) . '/recipients'}}" class="font-grey-cascade tooltips" data-original-title=" المرسل إليهم"><i class="fa fa-users"></i></a>
                                            </li>
                                            <li>&nbsp</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="mt-comment"><h4>لا توجد رسائل صادرة</h4></div>
                    @endif
                </div>
            </div>
            <div class="tab-pane" id="draft">
                <div class="mt-comments">
                    @if(count($drafts) > 0)
                        @foreach($drafts as $item)
                            <div class="mt-comment">
                                <div class="mt-comment-img">
                                    <img src="{{$item->creator->avatar != '' ? asset('files_avatars' . '/' . $item->creator->avatar) : asset('files_logos/logo-blank.png')}}">
                                </div>
                                <div class="mt-comment-body">
                                    <div class="mt-comment-info">
                                        <span class="mt-comment-author"><h5>{{$item->creator->name}}</h5> {{$item->creator->office->name or '---'}}</span>
                                        <span class="mt-comment-date">{{DateDiff::inArabic($item->created_at)}} ({{$item->created_at->format('Y/m/d - H:i')}})</span>
                                    </div>
                                    <div class="mt-comment-text"><a href="{{url('admin/messages', $item->id)}}" class="tooltips" data-original-title="مشاهدة الرسالة">
                                            <strong class="font-blue-chambray">{{$item->subject}}</strong> [{!! str_limit(strip_tags($item->body), 50) !!}]</a>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="mt-comment"><h4>لا توجد رسائل مسودة</h4></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
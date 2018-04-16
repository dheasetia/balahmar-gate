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
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-users font-balahmar"></i>
                        <span class="caption-subject bold font-balahmar uppercase"> المجموعات</span>
                        <span class="caption-helper">تفاصيل مجموعة</span>
                    </div>
                    <div class="actions">
                        <a href="{{url('admin/groups', $group->id) . '/edit'}}" class="btn btn-circle btn-icon-only btn-default tooltips" data-original-title="تعديل المجمعة الحالية"><i class="fa fa-edit"></i></a>
                        <a href="{{url('admin/groups')}}" class="btn btn-circle btn-icon-only btn-default tooltips" data-original-title="قائمة المجموعات"><i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <h4 class="font-grey-cascade">اسم المجموعة: <span class="bold"> {{$group->name}}</span></h4>
                    <hr>
                    <div class="mt-comments">
                        @if(count($group->users) == 0)
                            <tr>
                                <td colspan="3">لا توجد مستخدم لهذهة المجموعة</td>
                            </tr>
                        @else
                            @foreach($group->users as $user)
                                <div class="mt-comment">
                                    <div class="mt-comment-img">
                                        <img src="{{$user->avatar != '' ? asset('files_avatars' . '/' . $user->avatar) : asset('files_logos/logo-blank.png')}}">
                                    </div>
                                    <div class="mt-comment-body">
                                        <div class="mt-comment-info">
                                            <span class="mt-comment-author"><h5>{{$user->name}} {{$user->id == Sentinel::getUser()->id ? '(أنت)' : ''}}</h5> {{$user->office->name or '---'}}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/group_show.js') }}" type="text/javascript"></script>
@endsection
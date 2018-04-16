@extends('layouts.main')

@section('plugin_styles')
    <style>
        th {
            font-family: DroidKufi, "Helvetica Neue", Helvetica, Arial;
            text-align: center;
        }
        .table-small-cells {
            width: 50px;
            text-align: center;
        }
        .table-md-cells {
            width: 130px;
            text-align: center;
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
                        <span class="caption-subject font-balahmar">قائمة الإشعارات</span>
                    </div>
                    <div class="actions">
                        <a href="/admin/announcements" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="تحديث"><i class="fa fa-refresh"></i></a>
                        <a href="/admin/announcements/create" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="إنشاء إشعار جديد"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>التاريخ</th>
                                <th>الموضوع</th>
                                <th>مرفقات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($announcements) > 0)
                            @foreach($announcements as $announcement)
                                <tr class="{{$announcement->is_read ? '' : 'unread'}}" data-messageid="{{$announcement->id}}">
                                    <td class="table-small-cells"> {{++$seq_num}} </td>
                                    <td class="table-md-cells"> {{$announcement->hijri_created_day . '/ ' . $announcement->hijri_created_month . '/ ' . $announcement->hijri_created_year . ' هـ'}} </td>
                                    <td><a href="{{url('admin/announcements', $announcement->id)}}" class="tooltips" data-original-title="تفاصيل الإشعار">{{$announcement->subject}}</a></td>
                                    <td class="table-small-cells">
                                        @if($announcement->attachment != '')
                                            <a href="{{asset('files_announcements/' . $announcement->attachment)}}" target="_blank" class="btn btn-icon-only btn-default tooltips" data-original-title="مرفقات"><i class="fa fa-paperclip"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5"><h5 class="text-center">لا توجد إشعارات</h5></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
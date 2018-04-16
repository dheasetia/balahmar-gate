@extends('layouts.main')

@section('plugin_styles')
    <style>
        th {
            font-family: DroidKufi, "Helvetica Neue", Helvetica, Arial;
            text-align: center;
        }
        .table-small-cells {
            width: 40px;
            text-align: center;
        }
        .table-md-cells {
            width: 100px;
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
                        <i class="fa fa-bullhorn font-balahmar"></i>
                        <span class="caption-subject bold font-balahmar uppercase"> الإشعارات</span>
                        <span class="caption-helper">جميع الإشعارات</span>
                    </div>
                    <div class="actions">
                        <a href="/announcements" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="تحديث القائمة"><i class="fa fa-refresh"></i></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>مفضلة</th>
                            <th>مقروءة</th>
                            <th>الموضوع</th>
                            <th>مرفقات</th>
                            <th>تاريخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($announcements) > 0)
                            @foreach($announcements as $announcement)
                                <tr class="{{$announcement->is_read ? '' : 'unread'}}" data-messageid="{{$announcement->id}}">
                                    <td class="table-small-cells">{{++$seq_num}}</td>
                                    <td class="table-small-cells">
                                        <i class="fa fa-star {{$announcement->detail->is_favourite == 1 ? 'font-blue' : ''}} tooltips" data-original-title="{{$announcement->detail->is_favourite == 1 ? 'مفضلة' : 'غير مفضلة'}}"></i>
                                    </td>
                                    <td class="table-small-cells">
                                        <i class="fa fa-eye {{$announcement->detail->is_read == 1 ? 'font-blue' : ''}} tooltips" data-original-title="{{$announcement->detail->is_read == 1 ? 'تمت القراءة' : 'لم تتم القراءة'}}"></i>
                                    </td>
                                    <td class="view-message ">
                                        <a href="{{url('/announcements', $announcement->id)}}" class="tooltips" data-original-title="مشاهدة">{{$announcement->subject}}</a>
                                    </td>
                                    <td class="table-small-cells">
                                        @if($announcement->attachment != '')
                                            <i class="fa fa-paperclip"></i>
                                        @endif
                                    </td>
                                    <td class="table-md-cells"> {{$announcement->created_at->format('d/ m/ Y')}} </td>
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
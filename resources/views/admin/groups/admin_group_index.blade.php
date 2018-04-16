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
                        <i class="fa fa-users font-balahmar"></i>
                        <span class="caption-subject bold font-balahmar uppercase"> المجموعات</span>
                        <span class="caption-helper">قائمة المجموعات</span>
                    </div>
                    <div class="actions">
                        <a href="/admin/groups" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="تحديث"><i class="fa fa-refresh"></i></a>
                        <a href="/admin/groups/create" class="btn btn-icon-only btn-circle btn-default tooltips" data-original-title="إنشاء  جديد"><i class="fa fa-plus"></i></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>عدد المستخدمين</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($groups) > 0)
                            @foreach($groups as $group)
                                <tr>
                                    <td class="table-small-cells"> {{$loop->iteration}} </td>
                                    <td><a href="{{url('admin/groups', $group->id)}}">{{$group->name}}</a></td>
                                    <td> {{$group->users->count()}} مستخدم</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5"><h5 class="text-center">لا توجد مجموعة</h5></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
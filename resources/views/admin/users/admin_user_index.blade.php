@extends('layouts.main')
@section('plugin_styles')
    <style>
        th {
            font-family: DroidKufi, "Helvetica Neue", Helvetica, Arial;
            text-align: center;
        }
        .mt-comment-img img {
            margin: 10px 0;
            width: 35px;
            height: 35px;
            -webkit-border-radius: 50% !important;
            -moz-border-radius: 50% !important;
            border-radius: 50% !important;
        }
    </style>
@endsection

@section('content')
    <!-- BEGIN APPROVAL MODAL -->
    <div id="user_delete_modal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="" accept-charset="utf-8" id="form_delete_user">
                    {{csrf_field()}}
                    {{method_field('delete')}}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">حذف المستخدم</h4>
                    </div>
                    <div class="modal-body">
                        <p>هل تريد حذف المستخدم: <span id="modal_user_name"></span></p>

                        <div class="alert alert-danger">سوف يحذف معه جميع البيانات المتعلقة به من الجهة والمشاريع والتقارير وغير ذلك.</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn default"><i class="fa fa-undo"></i> إلغاء</button>
                        <button type="submit" class="btn green"><i class="fa fa-check"></i> موافق</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END APPROVAL MODAL -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN BORDERED TABLE PORTLET-->
            <div class="portlet light portlet-fit ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-users font-balahmar"></i>
                        <span class="caption-subject font-balahmar sbold">المستخدمون</span>
                    </div>
                    <div class="actions">

                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table table-bordered">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th> # </th>
                                <th colspan="2"> الاسم الكامل </th>
                                <th> تاريخ التسجيل </th>
                                <th> الأيميل </th>
                                <th> رقم الجوال </th>
                                <th> الجهة التابعة </th>
                                <th> الحالة </th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($users) == 0)
                                <tr>
                                    <td colspan="7" class="text-center"><h4>لا يوجد مستخدم مسجل غيرك</h4></td>
                                </tr>
                            @else
                                @foreach($users as $user)
                                    @if(Sentinel::getUser()->id != $user->id)
                                        <tr>
                                            <td>{{++$seq_num}}</td>
                                            <td>
                                                <div class="mt-comment-img">
                                                    <img src="{{$user->avatar != '' ? asset('files_avatars' . '/' . $user->avatar) : asset('files_logos/logo-blank.png')}}">
                                                </div>
                                            </td>
                                            <td><a href="{{url('admin/users', $user->id)}}" class="tooltips" data-original-title="تفاصيل المستخدم">{{$user->name}}</a></td>
                                            <td>{{DateDiff::inArabic($user->created_at)}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->mobile}}</td>

                                            @if(isset($user->office))
                                                <td><a href="{{url('admin/offices', $user->office->id)}}" class="tooltips" data-original-title="تفاصيل الجهة">{{$user->office->name}}</a></td>
                                            @else
                                                <td>---</td>
                                            @endif
                                            <td>{!! $user->status_label !!}</td>
                                            <td>
                                                <button
                                                        type="button"
                                                        data-toggle="modal"
                                                        data-target="#user_delete_modal"
                                                        class="btn btn-icon-only red-sunglo tooltips"
                                                        data-original-title="حذف المستخدم"
                                                        data-fullname="{{$user->name}}"
                                                        data-id="{{$user->id}}"

                                                    ><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END BORDERED TABLE PORTLET-->
        </div>
    </div>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/admin_user_index.js')}}" type="text/javascript"></script>
@endsection
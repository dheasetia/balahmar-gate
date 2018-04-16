@extends('layouts.main')


@section('breadcrumb')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>  طلبات المشروع <small> تفاصيل الطلب </small> </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
    </div>
    <!-- END PAGE HEAD-->
@endsection

@section('content')
<div class="modal fade" id="confirmation_approval_modal" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/admin/proposal/approve">
                {{csrf_field()}}
                <input type="hidden" name="proposal_id" value="{{$proposal->id}}">
                <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">تعميد الموافقة</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>التاريخ</label>
                        <input type="text" class="form-control" name="hijri_approval" id="hijri_approval" readonly>
                    </div>
                    <p>ماذا تريد أن تكون حالة الطلب؟</p>
                    <div class="form-group form-md-radios">
                        <label>اختر الحالة:</label>
                        <div class="md-radio-list">
                            <div class="md-radio">
                                <input type="radio" id="radio2" name="is_approved" value="1" class="md-radiobtn" {{$proposal->is_approved == 1 ? 'checked' : ''}}>
                                <label for="radio2">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span> موافقة </label>
                            </div>
                            <div class="md-radio">
                                <input type="radio" id="radio3" name="is_approved" value="2" class="md-radiobtn" {{$proposal->is_approved == 2 ? 'checked' : ''}}>
                                <label for="radio3">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span> رفض </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ban_reason">سبب الرفض:</label>
                        <textarea name="ban_reason" id="ban_reason" class="form-control">{{$proposal->is_approved == 2 ? $proposal->ban_reason : ''}}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn green">حفظ</button>
                </div>

            </form>
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="confirmation_project_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="/admin/proposal/make_project">
                {{csrf_field()}}
                <input type="hidden" name="proposal_id" value="{{$proposal->id}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">إنشاء مشروع</h4>
                </div>
                <div class="modal-body">
                    <p>هل تريد إنشاء مشروع استنادا على هذا الطلب؟</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn green">حفظ</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- /.modal -->
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-shopping-cart font-blue-hoki"></i>
                <span class="caption-subject font-blue-hoki bold">بيانات المشروع المقدم</span>
            </div>
            <div class="actions">
                @if ($proposal->is_approved)
                    @if(count($proposal->project) == 0)
                        <a href="#confirmation_project_modal" data-toggle="modal" class="btn btn-default tooltips" data-original-title="إنشاء مشروع استنادا على هذا الطلب"><i class="fa fa-area-chart"></i>إنشاء مشروع </a>
                    @else
                        <a href="{{url('/admin/projects', $proposal->project->id)}}" class="btn blue-chambray tooltips" data-original-title="مشاهدة تفاصيل المشروع لهذا الطلب"><i class="fa fa-area-chart"></i> تفاصيل المشروع</a>
                    @endif
                @else
                    <a href="#confirmation_approval_modal" data-toggle="modal" class="btn btn-default tooltips" data-original-title="الموافقة أو الرفض هذا الطلب"> <i class="fa fa-check"></i>  تعميد حالة</a>
                @endif
            </div>
        </div>
        <div class="portlet-body form">
        <!-- BEGIN FORM-->
                <div class="form-body">
                    <form class="form-horizontal form-bordered form-row-stripped">
                        <div class="form-group">
                            <label class="control-label col-md-3"> الحالة  </label>
                            <div class="col-md-2">
                                <div class="alert alert-{{$proposal->status_class}}">{{$proposal->status}}</div>
                            </div>
                            @if($proposal->is_approved == 1)
                                @if(count($proposal->project) == 0)
                                    <div class="col-md-3">
                                        <div class="alert alert-warning">لم يتم إنشاء للمشروع. </div>
                                    </div>
                                @else
                                    <div class="col-md-3">
                                        <div class="alert alert-success">تم إنشاء المشروع لهذا الطلب. </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                        @if($proposal->is_approved == 2)
                        <div class="form-group">
                            <label class="control-label col-md-3"> سبب الرفض  </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$proposal->ban_reason}}</p>
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="control-label col-md-3"> اسم الجهة  </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$proposal->office->name}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="hijri_created" class="control-label col-md-3"> تاريخ الطلب  </label>
                            <div class="col-md-2">
                                <p class="form-control">{{$proposal->hijri_created_day . '/ ' . $proposal->hijri_created_month . '/ ' . $proposal->hijri_created_year}} هـ</p>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="project_name" class="control-label col-md-3">اسم المشروع  </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$proposal->project_name}}</p>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="description" class="control-label col-md-3">التعريف بالمشروع</label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="4" readonly>{{$proposal->description}}</textarea>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="execution_date" class="control-label col-md-3">تاريخ التنفيذ </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$proposal->hijri_execution_day . '/ ' . $proposal->hijri_execution_month . '/ ' . $proposal->hijri_execution_year}} هـ</p>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="responsible_person" class="control-label col-md-3">اسم الشحص للتواصل </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$proposal->responsible_person}}</p>

                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="mobile" class="control-label col-md-3">رقم جواله </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$proposal->mobile}}</p>

                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="email" class="control-label col-md-3">البريد الإلكتروني </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$proposal->email}}</p>

                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3" for="kind_id"> نوع المشروع </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$proposal->kind->name}}</p>


                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3" for="city_id"> المدينة </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$proposal->city->name}}</p>


                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="video_link" class="control-label col-md-3"> رابط فيديو</label>
                            <div class="col-md-9">
                                <p class="form-control">{{$proposal->video_link}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="image-letter">
                                    <embed src="{{asset('proposals') . '/' . $proposal->document_path}}" width="100%" height="1000" type='application/pdf'>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <!-- END FORM-->
        </div>
    </div>
@endsection

@section('plugin_scripts')
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.plus.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.ummalqura.js')}}" type="text/javascript"></script>
    <script src="{{ asset('assets/global/plugins/jquery-calendars/js/jquery.calendars.ummalqura-ar.js')}}" type="text/javascript"></script>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/admin_proposal_show.js')}}"></script>
@endsection

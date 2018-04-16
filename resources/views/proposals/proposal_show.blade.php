@extends('layouts.main')


@section('breadcrumb')
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>  طلبات المشروع <small> تقديم طلب جديد </small> </h1>
            </div>
            <!-- END PAGE TITLE -->
        </div>
    </div>
    <!-- END PAGE HEAD-->
@endsection

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-shopping-cart font-blue-hoki"></i>
                <span class="caption-subject font-blue-hoki bold">بيانات المشروع المقدم</span>
            </div>
            <div class="actions">
                <a href="/proposals/{{$proposal->id}}/edit" class="btn btn-default btn-icon-only btn-circle tooltips" data-original-title="تعديل"><i class="fa fa-pencil"></i></a>
            </div>
        </div>
        <div class="portlet-body form">

        <!-- BEGIN FORM-->
                <div class="form-body">
                    <form action="" class="form-horizontal form-bordered form-row-stripped">
                        <div class="form-group">
                            <label for="hijri_created" class="control-label col-md-3"> تاريخ الطلب  <span class="required">*</span></label>
                            <div class="col-md-2">
                                <p class="form-control">{{$proposal->hijri_created_day . '/ ' . $proposal->hijri_created_month . '/ ' . $proposal->hijri_created_year}} هـ</p>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="project_name" class="control-label col-md-3">اسم المشروع  <span class="required">*</span></label>
                            <div class="col-md-9">
                                <p class="form-control">{{$proposal->project_name}}</p>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="description" class="control-label col-md-3">التعريف بالمشروع<span class="required">*</span></label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="4" readonly>{{$proposal->description}}</textarea>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="execution_date" class="control-label col-md-3">تاريخ التنفيذ <span class="required">*</span></label>
                            <div class="col-md-9">
                                <p class="form-control">{{$proposal->hijri_execution_day . '/ ' . $proposal->hijri_execution_month . '/ ' . $proposal->hijri_execution_year}} هـ</p>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="responsible_person" class="control-label col-md-3">اسم الشحص للتواصل <span class="required">*</span></label>
                            <div class="col-md-9">
                                <p class="form-control">{{$proposal->responsible_person}}</p>

                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="mobile" class="control-label col-md-3">رقم جواله <span class="required">*</span></label>
                            <div class="col-md-9">
                                <p class="form-control">{{$proposal->mobile}}</p>

                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="email" class="control-label col-md-3">البريد الإلكتروني <span class="required">*</span></label>
                            <div class="col-md-9">
                                <p class="form-control">{{$proposal->email}}</p>

                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3" for="kind_id"> نوع المشروع <span class="required">*</span></label>
                            <div class="col-md-9">
                                <p class="form-control">{{$proposal->kind->name}}</p>


                            </div>
                        </div>

                        <div class="form-group ">
                            <label class="control-label col-md-3" for="city_id"> المدينة <span class="required">*</span></label>
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
                                    <embed src="{{asset('files_proposals') . '/' . $proposal->document_path}}" width="100%" height="1000" type='application/pdf'>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <a href="{{url('/proposals', $proposal->id)}}/edit" class="btn blue pull-right"><i class="fa fa-pencil"></i>  تعديل</a>
                        </div>
                    </div>
                </div>
            <!-- END FORM-->
        </div>
    </div>
@endsection

@section('plugin_scripts')
    <script src="{{ asset('assets/global/plugins/bootbox/bootbox_abah_modified.min.js') }}" type="text/javascript"></script>
@endsection

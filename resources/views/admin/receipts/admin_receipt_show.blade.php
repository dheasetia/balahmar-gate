@extends('layouts.main')

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-pie-chart font-balahmar"></i>
                <span class="caption-subject font-balahmar bold">تفاصيل سند استلام</span>
            </div>
            <div class="actions">
                <a href="{{url('admin/projects', $project->id)}}" class="btn font-balahmar btn-circle btn-icon-only tooltips" data-original-title="عودة"><i class="fa fa-undo"></i></a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
                <div class="form-body">
                    <form class="form-horizontal form-bordered form-row-stripped">
                        <div class="form-group">
                            <label class="control-label col-md-3"> تاريخ الاستلام (بالهجري)  </label>
                            <div class="col-md-2">
                                <p class="form-control">{{$receipt->hijri_received}} هـ </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="project_id"> اسم المشروع </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$project->name}}</p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3"> اسم المستلم</label>
                            <div class="col-md-9">
                                <p class="form-control">{{$receipt->receiver_name}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="control-label col-md-3"> المبلغ</label>
                            <div class="col-md-9">
                                <p class="form-control">{{number_format($receipt->amount)}}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"> رسالة وملاحظات </label>
                            <div class="col-md-9">
                                <textarea name="description" rows="3" class="form-control" style="white-space: pre-wrap">{{$receipt->description}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3"> صورة سند استلام </label>
                            <div class="col-md-9">
                                <img src="{{asset('files_receipts') . '/' . $receipt->document_path}}">
                            </div>
                        </div>
                    </form>
                </div>
            <!-- END FORM-->

        </div>
    </div>
@endsection
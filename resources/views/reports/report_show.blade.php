@extends('layouts.main')

@section('plugin_styles')
    <link href="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="modal fade" id="add_picture_modal" tabindex="-1" aria-hidden="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="/pictures" enctype="multipart/form-data" accept-charset="utf-8" id="add_picture_form" class="form-horizontal form-bordered form-row-stripped">
                    {{csrf_field()}}
                    <input type="hidden" name="report_id" value="{{$report->id}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">رفع صورة</h4>

                    </div>
                    <div class="modal-body form">
                        <div class="form-body">
                            @if(count($errors))
                                <div class="alert alert-danger" id="picture_error">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group ">
                                <label for="title" class="control-label col-md-3">العنوان  </label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" placeholder="عنوان الصورة">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="description" class="control-label col-md-3">بيان الصورة  </label>
                                <div class="col-md-9">
                                    <textarea type="text" class="form-control" id="description" name="description" placeholder="تفاصيل الصورة">{{old('description')}}</textarea>
                                </div>
                            </div>

                            <div class="form-group ">
                                <label class="col-md-3 control-label">رفع الصورة</label>
                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                             style="width: 200px; height: 150px;"></div>
                                        <div>
                                        <span class="btn blue-chambray btn-file">
                                            <span class="fileinput-new"> اختيار صورة </span>
                                            <span class="fileinput-exists"> تغيير </span>
                                            <input type="file" name="path">
                                        </span>
                                            <a href="javascript;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
                                        </div>
                                    </div>
                                    <div class="clearfix margin-top-20">
                                        <span class="bold">تنبيه ! </span> الرجاء اختيار الصورة بالمحاذاة المناسب وبحجم الملف لا يزيد عن ٢ ميغا.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn green"><i class="fa fa-upload"></i> رفع </button>
                    </div>
                </form>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="row">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-pie-chart font-balahmar"></i>
                    <span class="caption-subject font-balahmar bold">بيانات التقرير المرفوع</span>
                </div>
                <div class="actions">
                    <a href="{{url('projects', $report->project->id)}}" class="btn font-balahmar btn-circle btn-icon-only tooltips" data-original-title="عودة لتفاصيل المشروع"><i class="fa fa-undo"></i></a>
                    <a href="{{url('reports', $report->id) . '/edit'}}" class="btn font-balahmar btn-icon-only btn-circle tooltips" data-original-title="تعديل"><i class="fa fa-pencil"></i></a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <div class="form-body">
                    <div class="form form-horizontal form-bordered form-row-stripped">
                        <div class="form-group">
                            <label class="control-label col-md-3"> تاريخ التقرير  </label>
                            <div class="col-md-2">
                                <p class="form-control">{{$report->hijri_created_day . '/ ' . $report->hijri_created_month . '/ ' . $report->hijri_created_year}} هـ</p>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label  class="control-label col-md-3">اسم المشروع  </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$report->project->name}}</p>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label  class="control-label col-md-3">تقرير للمرحلة  </label>
                            <div class="col-md-9">
                                <p class="form-control">{{$report->nth}}</p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label  class="control-label col-md-3"> تقرير الفترة من  </label>
                            <div class="col-md-2">
                                <p class="form-control">{{$report->hijri_report_from_day . '/ ' . $report->hijri_report_from_month . '/ ' . $report->hijri_report_from_year}} هـ</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="control-label col-md-3"> لغاية  </label>
                            <div class="col-md-2">
                                <p class="form-control">{{$report->hijri_report_to_day . '/ ' . $report->hijri_report_to_month . '/ ' . $report->hijri_report_to_year}} هـ</p>
                            </div>
                        </div>
                        @if ($report->video_link != '')
                        <div class="form-group ">
                            <label class="control-label col-md-3"> رابط فيديو</label>
                            <div class="col-md-9">
                                <a class="btn font-balahmar tooltips" href="{{$report->video_link}}" target="_blank" data-original-title="فتح الرابط">فتح</a>
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="control-label col-md-3">ملف التقرير</label>
                            <div class="col-md-9">
                                <div class="portlet light">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-file-pdf-o font-grey-gallery"></i>
                                            <span class="caption-subject bold font-grey-gallery"> ملف التقرير </span>
                                            <span class="caption-helper">انقر السهم للمشاهدة</span>
                                        </div>
                                        <div class="tools">
                                            <a href="" class="expand tooltips" data-original-title="المشاهدة"> </a>
                                            <a href="" class="fullscreen tooltips" data-original-title="ملء الشاشة"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body portlet-collapsed">
                                        @if(substr($report->document_path, -3) === 'pdf')
                                            <embed src="{{asset('files_reports') . '/' . $report->document_path}}" width="100%" height="1000" type='application/pdf'>
                                        @else
                                            <div>
                                                <img style="width: 100%" src="{{asset('files_receipts') . '/' . $report->document_path}}">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3">صور مرفوعة</label>
                            <div class="col-md-9">
                                @if(count($report->pictures) > 0)
                                    @foreach($report->pictures as $picture)
                                        <div class="col-sm-12 col-md-6">
                                            <div class="thumbnail">
                                                <img src="{{asset('files_pictures/') . '/' . $picture->path}}" alt="صورة" style="width: 100%; height: 200px; display: block;" data-src="{{asset('files_pictures/') . '/' . $picture->path}}">
                                                <div class="caption">
                                                    <h4><a href="{{$picture->path}}">{{$picture->title}}</a></h4>
                                                    <p> {{$picture->description}} </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="form-control">لا توجد</p>
                                @endif
                                <div class="clearfix"></div>
                                    <hr>
                                <div class="margin-top-10 pull-right">
                                    <button data-target="#add_picture_modal" class="btn blue-hoki tooltips" data-toggle="modal" data-original-title="إضافة صور للمشروع مصاحبة للتقرير الحالي"><i class="fa fa-plus"></i> إضافة صورة</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END FORM-->
            </div>
        </div>
    </div>
@endsection

@section('plugin_scripts')
    <script src="{{ asset('assets/global/plugins/bootbox/bootbox_abah_modified.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js')}}" type="text/javascript"></script>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/report_show.js') }}" type="text/javascript"></script>
@endsection
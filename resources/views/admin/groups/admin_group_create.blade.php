@extends('layouts.main')

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users font-balahmar"></i>
                <span class="caption-subject bold font-balahmar uppercase"> المجموعات</span>
                <span class="caption-helper">إنشاء مجموعة جديدة</span>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <form action="/admin/groups" method="post" class="form-horizontal form-bordered form-row-stripped" id="form_create_group" accept-charset="utf-8">
                {{csrf_field()}}
                <div class="form-body">
                    <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                        <label for="name" class="control-label col-md-3">اسم المجموعة  <span class="required">*</span></label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control" id="name" value="{{old('name')}}"/>
                            @if($errors->has('name'))
                                <div class="help-block help-block-error">{{$errors->first('name')}}</div>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green pull-right"><i class="fa fa-save"></i>  خفظ</button>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/group_create.js') }}" type="text/javascript"></script>
@endsection
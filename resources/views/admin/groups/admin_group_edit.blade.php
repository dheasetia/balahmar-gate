@extends('layouts.main')

@section('content')
<form action="{{url('admin/groups', $group->id)}}" method="post" class="form-horizontal form-bordered form-row-stripped" id="form_create_group" accept-charset="utf-8">
    {{csrf_field()}}
    {{method_field('patch')}}
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users font-balahmar"></i>
                <span class="caption-subject bold font-balahmar uppercase"> المجموعات</span>
                <span class="caption-helper">تعديل بيانات المجموعة</span>
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">
                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}}">
                    <label for="name" class="control-label col-md-3">اسم المجموعة  <span class="required">*</span></label>
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control" id="name" value="{{old('name', $group->name)}}"/>
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
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN Portlet PORTLET-->
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-puzzle font-grey-gallery"></i>
                        <span class="caption-subject bold font-grey-gallery uppercase"> المستخدمون لهذه المجموعة </span>
                        <span class="caption-helper">يمكنك إدخال المستخدمين أو إلغائهم بالتأشير على الأسماء.</span>
                    </div>
                    <div class="tools">
                        <a href="" class="collapse"> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <div class="form-body form">
                        <div class="form-body">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <div class="row" style="padding-right: 20px;">
                                        @if(count($users) > 0)
                                            @foreach($users as $user)
                                                @if($user->id != Sentinel::getUser()->id)
                                                    <div class="mt-checkbox-list col-md-12">
                                                        <label for="user-{{$user->id}}" class="mt-checkbox mt-checkbox-outline"> {{$user->name}} (<strong>{{$user->office != null ? $user->office->name : '---'}}</strong>)
                                                            <input id="user-{{$user->id}}" value="{{$user->id}}" name="recipients[]" class="user_checkbox"  type="checkbox" {{$members_id->containsStrict($user->id) ? 'checked' : ''}}>
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
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
            </div>
            <!-- END GRID PORTLET-->
        </div>
    </div>
</form>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/group_edit.js') }}" type="text/javascript"></script>
@endsection
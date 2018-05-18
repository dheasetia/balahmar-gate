@extends('layouts.main')

@section('custom_styles')
    <style>
        img.img-responsive {
            float: right;
            height: 60px;
            width: 60px;
            border-radius: 50%;
            margin: 10px;
        }
        #place_info {
            text-align: center;
            color: grey;
            font-family: DroidKufi, "Helvetica Neue", Helvetica, Arial;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light">
                <div class="portlet-title">
                    <img src="/files_logos/{{$office->logo}}" alt="" class="img-responsive">
                    <h3 class="text-center bold font-balahmar">{{$office->name}}</h3>
                    <div id="place_info">{{'شارع ' . $office->street . ' ، ' . $office->city->name . '، هاتف رقم: ' . $office->phone . ' ، الرمز البريدي  ' . $office->zip_code}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 margin-bottom-10">
            <div class="dashboard-stat blue">
                <div class="visual">
                    <i class="fa fa-wrench fa-icon-medium"></i>
                </div>
                <div class="details">
                    <div class="number"> {{$total_projects}} </div>
                    <div class="desc"> عدد المشاريع </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat red">
                <div class="visual">
                    <i class="fa fa-money"></i>
                </div>
                <div class="details">
                    <div class="number"> {{number_format($total_donation)}} </div>
                    <div class="desc"> إجمالي الدعم (ريال سعودي)</div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="dashboard-stat green">
                <div class="visual">
                    <i class="fa fa-send fa-icon-medium"></i>
                </div>
                <div class="details">
                    <div class="number"> 0 </div>
                    <div class="desc"> المبلغ المحول (ريال سعودي)</div>
                </div>
            </div>
        </div>
    </div>
    @if($office->is_suspended == 1)
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    <h5> تعتذر المؤسسة عن استقبال المشاريع لفترة محدودة </h5>
                    <p>يمكن للجهة تقديم مشاريعها لاحقا بإذن الله</p>
                </div>
            </div>
        </div>

    @endif
    <div class="row">
        <div class="col-md-12">
            <!-- Begin: life time stats -->
            <div class="portlet light " style="min-height: 500px">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-wrench font-blue"></i>
                        <span class="caption-subject font-blue bold uppercase">المشاريع </span>
                        <span class="caption-helper">قائمة المشاريع</span>
                    </div>
                    <div class="actions">
                        @if($office->is_suspended == 0)
                        <a href="{{url('projects/create')}}" class="btn btn-circle btn-icon-only btn-default tooltips" data-original-title="تقديم طلب مشروع"><i class="fa fa-plus"></i></a>
                        @endif
                        <a href="{{url('projects')}}" class="btn btn-circle btn-icon-only btn-default tooltips" data-original-title="قائمة جميع المشاريع"><i class="fa fa-list"></i></a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>الرقم</th>
                                <th> اسم المشروع </th>
                                <th> نوع المشروع </th>
                                <th> تاريخ الطلب </th>
                                <th> تاريخ التنفيذ </th>
                                <th>الحالة</th>
                                <th>مبلغ الدعم</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($projects) > 0)
                                @foreach($projects as $project)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td><a href="{{url('projects', $project->id)}}">{{$project->name}}</a></td>
                                        <td>{{$project->kind->name}}</td>
                                        <td>{{$project->hijri_created}}</td>
                                        <td>{{$project->hijri_executed}}</td>
                                        <td><span class="label label-{{$project->status_class}}">{{$project->status}}</span></td>
                                        <td>{{$project->donation_approved > 0 ? number_format($project->donation_approved) : '---'}}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7"><h4 class="text-center">لا يوجد</h4></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End: life time stats -->
        </div>
    </div>
@endsection
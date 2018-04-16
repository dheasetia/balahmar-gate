@extends('layouts.main')

@section('plugin_styles')
    <link href="{{asset('assets/global/plugins/bootstrap-toastr/toastr-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('assets/global/plugins/rate-yo/jquery.rateyo.min.css')}}"/>
    <style>
        li.question{
            margin: 10px 5px 15px 5px;

        }
        .rating {
            margin-bottom: 15px;
            margin-right: 10px;
            display: inline-block;
            position: relative;
        }
        .result {
            font-size: 17pt;
            margin: 10px;
            background: black;
            color: white;
            padding: 4px 10px 0 10px;
            border-radius: 5px;
            float: left;
            position: absolute;
            top: -10px;
            left: -68px;
            display: inline-block;
            width: 48px;
            text-align: center;
        }
        textarea.answer_description {
            width: 98%;
            margin-right: 15px;
        }
        label {
            margin-right: 15px;
        }
        #portlet_questionnaire {
            margin-bottom: 70px;
        }
    </style>
@endsection

@section('content')
    <div class="col-md-12">
        <!-- BEGIN BORDERED TABLE PORTLET-->
        <div class="portlet light portlet-fit " id="portlet_questionnaire">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list-ol font-balahmar"></i>
                    <span class="caption-subject font-balahmar sbold"> الاستبيان عن البوابة الإلكترونية </span>
                </div>
            </div>
            <div class="portlet-body">
                <ol>
                @foreach($questions as $question)
                    <li class="question">{{$question->question}}</li>
                    @if ($question->is_description == 1)
                        <div class="form-group" data-question_id="{{$question->id}}" id="answer_{{$question->id}}">
                            <textarea rows="10" style="white-space: pre-wrap" class="form-control textarea_description">{{\App\Libraries\Helpers::getDescriptionAnswer(\Cartalyst\Sentinel\Laravel\Facades\Sentinel::getUser()->id, $question->id)}}</textarea>
                        </div>
                    @else
                    <div class="row" id="answer_{{$question->id}}">
                        <div class="rating" data-question_id="{{$question->id}}">
                            <div class="rateyo" data-rateyo-rating="{{\App\Libraries\Helpers::getRating(\Cartalyst\Sentinel\Laravel\Facades\Sentinel::getUser()->id, $question->id)}}"></div>
                            <span class="result">{{\App\Libraries\Helpers::getRating(\Cartalyst\Sentinel\Laravel\Facades\Sentinel::getUser()->id, $question->id)}}</span>
                        </div>
                    </div>
                    <hr>
                    @endif
                @endforeach
                </ol>

            </div>
        </div>
        <!-- END BORDERED TABLE PORTLET-->
    </div>

@endsection

@section('plugin_scripts')
    <script type="text/javascript" src="{{asset('assets/global/plugins/rate-yo/jquery.rateyo.js')}}"></script>
@endsection

@section('page_scripts')
    <script src="{{asset('assets/layouts/layout3/scripts/questionnaire.js')}}" type="text/javascript"></script>
@endsection
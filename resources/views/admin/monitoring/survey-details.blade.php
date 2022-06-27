@extends('layouts.admin-layout')
@section('active-page')
    Survey Details
@endsection
@section('title')
    Survey Details
@endsection
@section('extra-styles')
    <link href="/assets/plugins/accordion/accordion.css" rel="stylesheet" />
@endsection

@section('breadcrumb-action-btn')
    <div class="btn-group">
        <a href="{{url()->previous()}}" class="btn btn-secondary btn-icon text-white mr-2">
        <span>
            <i class="ti-back-left"></i>
        </span> Go Back
        </a>
    </div>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            @if(session()->has('success'))
                <div class="alert alert-success mb-4">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Great!</strong>
                    <hr class="message-inner-separator">
                    <p>{!! session()->get('success') !!}</p>
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger mb-4">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>Whoops!</strong>
                    <hr class="message-inner-separator">
                    <p>{!! session()->get('error') !!}</p>
                </div>
            @endif
            @if($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
            @endif
            <div class="card">
                <div class="wideget-user-tab">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu1">
                            <ul class="nav">
                                <li class=""><a href="#tab-51" class="active show" data-toggle="tab">Survey Details</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content">
                <div class="tab-pane active show" id="tab-51">
                    <div class="card">
                        <div class="card-body">
                            <div class="mg-t-15 profile-footer">

                                <button class="btn btn-sm btn-default me-2 mb-1"><i class="fe fe-calendar mr-3"></i>{{date('d M, Y', strtotime($survey->created_at))}}</button>
                                <button class="btn btn-sm btn-default me-2 mb-1"><i class="fe fe-loader mr-3"></i> {{$survey->status == 1 ? 'Active' : 'Inactive' }}</button>
                            </div>
                            <div id="profile-log-switch">
                                <h3 class="card-title mt-3">{{$survey->title ?? '' }}</h3>
                                {!! $survey->question ?? '' !!}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Questions</div>
                        </div>
                        <div class="card-body pb-3">
                            <ul class="demo-accordion m-0" data-active-index="false">
                                @foreach($survey->getSurveyQuestions as $question)
                                    <li class="acc_section">
                                        <div class="acc_head">
                                            <h3>{{$question->question ?? ''}}</h3>
                                        </div>
                                        <div class="acc_content" style="display: none;">
                                            <div class="row">
                                                <div class="rating-stars block col-md-5" id="rating-1" data-stars="2" style="cursor: pointer;">
                                                    <i class="fe fe-star" style="color:#f1c40f"></i>
                                                    <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                                    <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                                    <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                                    <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                                </div>
                                                <div class="col-md-2">
                                                    {{count($question->getSurveyResponses) > 0 ? ceil($question->getSurveyResponses->where('rating',5)->count()/count($question->getSurveyResponses) * 100 ) : 0}}%
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="rating-stars block col-md-5" id="rating-1" data-stars="2" style="cursor: pointer;">
                                                    <i class="fe fe-star" style="color:#f1c40f"></i>
                                                    <i class="fe fe-star" style="color: rgb(255, 207, 16); "></i>
                                                    <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                                    <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                                </div>
                                                <div class="col-md-2">
                                                    {{count($question->getSurveyResponses) > 0 ? ceil($question->getSurveyResponses->where('rating',4)->count()/count($question->getSurveyResponses) * 100 ) : 0}}%
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="rating-stars block col-md-5" id="rating-1" data-stars="2" style="cursor: pointer;">
                                                    <i class="fe fe-star" style="color:#f1c40f"></i>
                                                    <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                                    <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                                </div>
                                                <div class="col-md-2">
                                                    {{count($question->getSurveyResponses) > 0 ? ceil($question->getSurveyResponses->where('rating',3)->count()/count($question->getSurveyResponses) * 100 ) : 0}}%
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="rating-stars block col-md-5" id="rating-1" data-stars="2" style="cursor: pointer;">
                                                    <i class="fe fe-star" style="color:#f1c40f"></i>
                                                    <i class="fe fe-star" style="color: rgb(255, 207, 16);"></i>
                                                </div>
                                                <div class="col-md-2">
                                                    {{count($question->getSurveyResponses) > 0 ? ceil($question->getSurveyResponses->where('rating',2)->count()/count($question->getSurveyResponses) * 100 ) : 0}}%
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="rating-stars block col-md-5" id="rating-1" data-stars="2" style="cursor: pointer;">
                                                    <i class="fe fe-star" style="color:#f1c40f"></i>
                                                </div>
                                                <div class="col-md-2">
                                                    {{count($question->getSurveyResponses) > 0 ? ceil($question->getSurveyResponses->where('rating',1)->count()/count($question->getSurveyResponses) * 100 ) : 0}}%
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extra-scripts')
    <script src="/assets/plugins/accordion/accordion.min.js"></script>
    <script src="/assets/plugins/accordion/accordion.js"></script>
@endsection

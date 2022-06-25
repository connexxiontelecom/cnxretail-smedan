@extends('layouts.admin-layout')
@section('active-page')
    Survey Details
@endsection
@section('title')
    Survey Details
@endsection
@section('extra-styles')

    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
@endsection

@section('breadcrumb-action-btn')
    <div class="btn-group">
        <a href="{{route('show-assessment')}}" class="btn btn-primary btn-icon text-white mr-2">
        <span>
            <i class="ti-briefcase"></i>
        </span> Manage Surveys
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
                        <ol>
                            @foreach($survey->getSurveyQuestions as $question)
                                <li>{{$question->question ?? ''}}</li>
                            @endforeach
                        </ol>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('extra-scripts')
    <script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="/assets/bower_components/tinymce.js"></script>
@endsection

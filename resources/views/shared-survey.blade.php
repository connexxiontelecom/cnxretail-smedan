@extends('layouts.guest-layout')
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
                            <div id="profile-log-switch">
                                <h3 class="card-title mt-3">{{$survey->title ?? '' }}</h3>
                                {!! $survey->question ?? '' !!}
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Survey Questions</div>
                        </div>
                        <div class="card-body pb-3">
                            <form action="">
                                @csrf
                                <ol>
                                    @foreach($survey->getSurveyQuestions as $question)
                                        <li class="acc_section">
                                            <tr>
                                                <td>{{$question->question ?? ''}}</td>
                                                <td>
                                                    <input type="number" max="5" name="rating[]" class="form-control col-md-2" placeholder="Rating">
                                                    <input type="hidden" max="5" name="questionId[]" class="form-control col-md-2" value="{{$question->id}}">
                                                </td>
                                            </tr>
                                        </li>
                                    @endforeach
                                </ol>
                                <hr>
                                <input type="hidden" name="surveyId" value="{{$survey->id}}">
                                <div class="form-group d-flex justify-content-center">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </form>

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

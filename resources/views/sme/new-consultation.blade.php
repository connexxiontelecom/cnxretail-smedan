@extends('layouts.master-layout')
@section('active-page')
    New Consultation Request
@endsection
@section('title')
    New Consultation Request
@endsection
@section('extra-styles')
    <link href="/assets/plugins/select2/select2.min.css" rel="stylesheet"/>
@endsection
@section('breadcrumb-action-btn')
    <a href="{{url()->previous()}}" class="btn btn-secondary btn-icon text-white mr-2">
        <span>
            <i class="ti-back-left"></i>
        </span> Go Back
    </a>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="">
                    @if(session()->has('success'))
                        <div class="alert alert-success mb-4">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Great!</strong>
                            <hr class="message-inner-separator">
                            <p>{!! session()->get('success') !!}</p>
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-warning mb-4">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Whoops!</strong>
                            <hr class="message-inner-separator">
                            <p>{!! session()->get('error') !!}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{route('show-consultation-form')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="mb-0 card-title">Consultation</h3>
                                </div>
                                <div class="card-alert alert alert-success mb-0">
                                    New Request
                                </div>
                                <div class="card-body">
                                    <div class="row" id="from-contact">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Subject</label>
                                                <input type="text" name="subject" placeholder="Subject" class="form-control">
                                                @error('subject') <i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="from-phone-group">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Interests</label>
                                                <select name="interests[]" id="interests" class="form-control select2" data-placeholder="Select interest" multiple>
                                                   @foreach($interests as $interest)
                                                    <option value="{{$interest->id}}">{{$interest->name ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                                @error('interests') <i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="from-phone-numbers">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Attachment(s)</label>
                                                <input type="file" class="form-control-file" name="attachments[]" multiple>
                                                @error('attachments') <i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="from-message">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Body</label>
                                                <textarea name="body" rows="5" id="body" style="resize: none" placeholder="Type content here..."
                                                          class="form-control content">{{old('body')}}</textarea>
                                                @error('body') <i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <a href="{{url()->previous()}}" class="btn btn-danger">Back</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="/assets/plugins/select2/select2.full.min.js"></script>
    <script src="/assets/js/select2.js"></script>
    <script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="/assets/bower_components/tinymce.js"></script>

@endsection

@extends('layouts.guest-layout')
@section('active-page')
    Thank You!
@endsection
@section('title')
    Thank You!
@endsection
@section('extra-styles')

@endsection

@section('breadcrumb-action-btn')
@endsection

@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="wideget-user-tab">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu1">
                            <ul class="nav">
                                <li class=""><a href="#tab-51" class="active show" data-toggle="tab">Thank You!</a></li>
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
                                <div class="alert alert-success mb-4">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <strong>Thank You!</strong>
                                    <hr class="message-inner-separator">
                                    <p>Your response to this survey mean so much to us. We really appreciate your time and effort.</p>
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <a href="{{route('marketplace')}}" class="btn btn-primary">Visit Our Marketplace</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('extra-scripts')

@endsection

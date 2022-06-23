@extends('layouts.admin-layout')
@section('active-page')
    Performance
@endsection
@section('title')
    Performance
@endsection
@section('extra-styles')


@endsection
@section('breadcrumb-action-btn')
    <a href="{{url()->previous()}}" class="btn btn-secondary btn-icon text-white mr-2">
        <span>
            <i class="ti-money"></i>
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
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-primary mr-1">Revenue Growth</a>
                                    <a href="#" class="btn btn-primary mr-1">Revenue per Client</a>
                                    <a href="#" class="btn btn-primary mr-1">Profit Margin</a>
                                    <a href="#" class="btn btn-primary mr-1">Client Retention Rate</a>
                                    <a href="#" class="btn btn-primary mr-1">Customer Satisfaction</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Revenue
                                </div>
                                <div class="card-body">
                                    <div class="chart-wrapper">
                                        <canvas id="devices" class="h-300"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Margin
                                </div>
                                <div class="card-body">
                                    hello
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="/assets/js/axios.min.js"></script>
    <script src="/assets/assets/js/chart.min.js"></script>
    <script>
        $(document).ready(function(){
            let url = "{{route('ajax-performance')}}";
            axios.get(url)
            .then(res=>{
                console.log(res);
            })
            .catch(err=>{
                console.log(err);
            })
        });
    </script>
@endsection

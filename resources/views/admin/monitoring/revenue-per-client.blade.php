@extends('layouts.admin-layout')
@section('active-page')
    Revenue Per Client
@endsection
@section('title')
    Revenue Per Client
@endsection
@section('extra-styles')
    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
@endsection
@section('breadcrumb-action-btn')
    <a href="{{url()->previous()}}" class="btn btn-secondary btn-icon text-white mr-2">
        <span>
            <i class="ti-back-left"></i>
        </span> Go Back
    </a>
@endsection

@section('main-content')
    @if(session()->has('success'))
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="alert alert-success mb-4">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Great!</strong>
                            <hr class="message-inner-separator">
                            <p>{!! session()->get('success') !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12 col-sm-12">
                        <h4>Filter</h4>
                        <form action="{{route('filter-revenue-per-client')}}" class="form-inline" method="get">
                            @csrf
                            <div class="form-group">
                                <label for="">From</label>
                                <input type="date" name="from" class="form-control ml-2" placeholder="From">
                            </div>
                            <div class="ml-2 form-group">
                                <label for="">To</label>
                                <input type="date" class="form-control ml-2" placeholder="To" name="to">
                            </div>
                            <div class="form-group">
                                <button class="btn-primary btn " type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 mt-4">
                        <h5 class="text-uppercase mt-4 "> <strong>Revenue per Client</strong> <small>(Inflow)</small>
                            <label for="" class=""> <span class="label label-primary">From: </span> {{date('d F, Y', strtotime($from))}}</label>
                            <label for="" class=""> <span class="label label-danger">To: </span> {{date('d F, Y', strtotime($to))}}</label>
                        </h5>
                    </div>

                    <div class="table-responsive">
                        <table id="data-table1" class="table table-striped table-bordered text-nowrap w-100">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Client</th>
                                <th>Revenue</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $n = 1; @endphp
                            @foreach ($receipts as $receipt)
                                <tr>
                                    <td>{{$n++}}</td>
                                    <td>{{date('d M, Y', strtotime($receipt->created_at))}}</td>
                                    <td>{{$receipt->getContact->company_name ?? ''}}</td>
                                    <td class="text-right">{{ number_format($receipt->amount,2) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="/assets/plugins/datatable/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatable/datatable.js"></script>
    <script src="/assets/plugins/datatable/dataTables.responsive.min.js"></script>
@endsection

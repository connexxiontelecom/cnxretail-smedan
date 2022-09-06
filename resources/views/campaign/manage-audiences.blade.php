@extends('layouts.master-layout')
@section('active-page')
    Manage Audiences
@endsection
@section('title')
    Manage Audiences
@endsection
@section('extra-styles')

    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
@endsection
@section('breadcrumb-action-btn')
    @include('sales-n-invoice.partials._invoice-menu')
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if(session()->has('error'))
                        <div class="alert alert-warning mb-4">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Whoops!</strong>
                            <hr class="message-inner-separator">
                            <p>{!! session()->get('error') !!}</p>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="data-table1" class="table table-striped table-bordered text-nowrap w-100">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc">S/No.</th>
                                <th class="sorting">Name</th>
                                <th class="sorting">Campaign</th>
                                <th class="sorting">From</th>
                                <th class="sorting_asc">Members</th>
                                <th class="sorting">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $serial = 1;
                            @endphp
                            @for($i = 0; $i<count($audiences->lists); $i++)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$audiences->lists[$i]->name ?? '' }}</td>
                                    <td>{{$audiences->lists[$i]->campaign_defaults->from_name ?? '' }}</td>
                                    <td>{{$audiences->lists[$i]->campaign_defaults->from_email ?? '' }}</td>
                                    <td>{{number_format($audiences->lists[$i]->stats->member_count) ?? '' }}</td>
                                    <td>
                                        <a href="{{route('view-audience',['id'=>$audiences->lists[$i]->id, 'account'=>$account])}}" class="btn btn-sm btn-info"> <i class="ti-eye mr-2"></i> </a>
                                    </td>
                                </tr>
                            @endfor
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

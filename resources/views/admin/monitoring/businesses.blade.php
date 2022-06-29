@extends('layouts.admin-layout')
@section('active-page')
    Businesses
@endsection
@section('title')
     Businesses
@endsection
@section('extra-styles')

    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table1" class="table table-striped table-bordered text-nowrap w-100">
                                <thead>
                                <tr>
                                    <th class="">#</th>
                                    <th class="wd-15p">Business Name</th>
                                    <th class="wd-20p">Email</th>
                                    <th class="wd-15p">Phone No.</th>
                                    <th class="wd-15p">Turnover({{date('Y')}})</th>
                                <!-- Turnover is total revenue for the year -->
                                    <th class="wd-25p">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $serial = 1; @endphp
                                @foreach($tenants as $tenant)
                                    <tr>
                                        <th scope="row">{{$serial++}}</th>
                                        <td>{{$tenant->company_name ?? '' }}</td>
                                        <td>{{$tenant->email ?? ''}}</td>
                                        <td>{{$tenant->phone_no ?? '-'}}</td>
                                        <td class="text-right">
                                            {{number_format($tenant->getTenantTurnover($tenant->id)->sum('amount'),2)}}
                                        </td>
                                        <td>
                                            <a href="{{route('performance-per-client', $tenant->slug)}}" class="btn btn-info btn-sm"><i class="ti-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
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

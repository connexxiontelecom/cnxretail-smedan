@extends('layouts.admin-layout')
@section('active-page')
    Manage Businesses
@endsection
@section('title')
    Manage Businesses
@endsection
@section('extra-styles')

    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-order">
                        <h6 class="mb-2">Businesses</h6>
                        <h2 class="text-right "><i class="mdi mdi-account-multiple icon-size float-left text-primary text-primary-shadow"></i><span>{{ number_format($tenants->count()) }}</span></h2>
                        <p class="mb-0">All time</p>
                    </div>
                </div>
            </div>
        </div><!-- COL END -->
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card ">
                <div class="card-body">
                    <div class="card-widget">
                        <h6 class="mb-2">Businesses</h6>
                        <h2 class="text-right"><i class="mdi mdi-account-multiple icon-size float-left text-success text-success-shadow"></i><span>0</span></h2>
                        <p class="mb-0">Last Month</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="card-widget">
                        <h6 class="mb-2">Businesses</h6>
                        <h2 class="text-right"><i class="icon-size mdi mdi-account-multiple   float-left text-warning text-warning-shadow"></i><span>0</span></h2>
                        <p class="mb-0">This Month</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
            <div class="card ">
                <div class="card-body">
                    <div class="card-widget">
                        <h6 class="mb-2">New Businesses</h6>
                        <h2 class="text-right"><i class="mdi mdi-account-multiple icon-size float-left text-danger text-danger-shadow"></i><span>0</span></h2>
                        <p class="mb-0">This Week</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                    <th class="wd-15p"> Date Enrolled</th>
                                    <th class="wd-15p">Business Name</th>
                                    <th class="wd-20p">Email</th>
                                    <th class="wd-15p">Phone No.</th>
                                    <th class="wd-15p">Location</th>
                                    <th class="wd-25p">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $serial = 1; @endphp
                                @foreach($tenants as $tenant)
                                    <tr>
                                        <th scope="row">{{$serial++}}</th>
                                        <td class="text-success">{{date('d M, Y', strtotime($tenant->start_date))}}</td>
                                        <td>{{$tenant->company_name ?? '' }}</td>
                                        <td>{{$tenant->email ?? ''}}</td>
                                        <td>{{$tenant->phone_no ?? '-'}}</td>
                                        <td>{{$tenant->getLocation->l_name ?? '-'}}</td>
                                        <td>
                                            <a href="{{route('view-tenant', $tenant->slug)}}" class="btn btn-info btn-sm"><i class="ti-eye"></i></a>
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

@extends('layouts.admin-layout')
@section('active-page')
    Surveys
@endsection
@section('title')
    Surveys
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
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-primary br-tr-3 br-tl-3">
                    <h3 class="card-title text-white">Business Info</h3>
                    <div class="card-options ">
                        <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up text-white"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Company Name:</label>
                        <input type="text" readonly value="{{$tenant->company_name ?? '' }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email:</label>
                        <input type="text" readonly value="{{$tenant->email ?? '' }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Phone No.:</label>
                        <input type="text" readonly value="{{$tenant->phone_no ?? '-' }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Company Address:</label>
                        <input type="text" readonly value="{{$tenant->address ?? '-' }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Description:</label>
                        <p>{{$tenant->description ?? '-' }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Member Since:</label>
                        <p class="text-muted">{{ date('d M, Y', strtotime($tenant->created_at))  }}</p>
                    </div>
                    <div class="form-group">
                        <label for="">Account Status:</label>
                        <p class="text-danger">{!! $tenant->account_status == 1 ? "<span class='text-success'>Active</span>" : "<span class='text-danger'>Suspended</span>" !!}</p>
                    </div>
                </div>
                <div class="card-footer">
                    @if(!empty($tenant->website))
                        <a href="http://{{$tenant->website}}" target="_blank">Visit website</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4>Surveys</h4>
                    @if(session()->has('success'))
                        <div class="alert alert-success mb-4">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Great!</strong>
                            <hr class="message-inner-separator">
                            <p>{!! session()->get('success') !!}</p>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="data-table1" class="table table-striped table-bordered text-nowrap w-100">
                            <thead>
                            <tr>
                                <th class="">#</th>
                                <th class="wd-15p">Date</th>
                                <th class="wd-15p">Title</th>
                                <th class="wd-15p">Excerpt</th>
                                <th class="wd-25p">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $serial = 1; @endphp
                            @foreach($surveys as $survey)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{ date('d M, Y', strtotime($survey->created_at)) }}</td>
                                    <td>{{$survey->title ?? ''}}</td>
                                    <td>{{strlen(strip_tags($survey->question)) > 60 ? substr(strip_tags($survey->question),0,57).'...' : strip_tags($survey->question)}}</td>
                                    <td>
                                        <a href="{{route('customer-satisfaction-details', ['survey'=>$survey->slug, 'tenant'=>$tenant->slug])}}" class="btn btn-info btn-sm"><i class="ti-eye"></i></a>
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
@endsection

@section('extra-scripts')
    <script src="/assets/plugins/datatable/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatable/datatable.js"></script>
    <script src="/assets/plugins/datatable/dataTables.responsive.min.js"></script>
@endsection

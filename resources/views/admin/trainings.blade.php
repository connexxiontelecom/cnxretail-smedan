@extends('layouts.admin-layout')
@section('active-page')
    Trainings
@endsection
@section('title')
    Trainings
@endsection
@section('extra-styles')
    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
@endsection
@section('breadcrumb-action-btn')
    <a href="{{route('show-new-training')}}" class="btn btn-primary btn-icon text-white mr-2">
        <span>
            <i class="ti-plus"></i>
        </span> New Training
    </a>
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>Trainings</h4>
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
                                @foreach($trainings as $training)
                                    <tr>
                                        <td>{{$serial++}}</td>
                                        <td>{{ date('d M, Y', strtotime($training->created_at)) }}</td>
                                        <td>{{$training->title ?? '' }}</td>
                                        <td>{{strlen(strip_tags($training->description)) > 60 ? substr(strip_tags($training->description),0,57).'...' : strip_tags($training->description)}}</td>
                                        <td>
                                            <a href="{{route('show-training-details', $training->slug)}}" class="btn btn-info btn-sm"><i class="ti-eye"></i></a>
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

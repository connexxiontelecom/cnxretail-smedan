@extends('layouts.admin-layout')
@section('active-page')
    Manage Business Categories
@endsection
@section('title')
    Manage Business Categories
@endsection
@section('extra-styles')

    <link href="/assets/plugins/datatable/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/datatable/responsivebootstrap4.min.css" rel="stylesheet" />
@endsection
@section('breadcrumb-action-btn')

@endsection

@section('main-content')

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Add New Business Category</div>
                <div class="card-body">
                    <div class="card-body">
                        <form action="{{route('business-categories')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Category Name <span class="text-danger">*</span></label>
                                <input type="text" name="category_name" value="{{old('category_name')}}" placeholder="Enter Business Category"  class="form-control">
                                @error('category_name')
                                <i class="text-danger">{{$message}}</i>
                                @enderror
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <button type="submit" class="btn-primary btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success mb-4">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Great!</strong>
                            <hr class="message-inner-separator">
                            <p>{!! session()->get('success') !!}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="data-table1" class="table table-striped table-bordered text-nowrap w-100">
                                <thead>
                                <tr>
                                    <th class="">#</th>
                                    <th class="wd-15p"> Date</th>
                                    <th class="wd-15p">Category Name</th>
                                    <th class="wd-25p">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $serial = 1; @endphp
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$serial++}}</td>
                                        <td>{{date('d M, Y', strtotime($category->created_at))}}</td>
                                        <td>{{$category->category_name ?? ''}}</td>
                                        <td>
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#cat_{{$category->id}}" class="btn btn-info btn-sm"><i class="ti-eye"></i></a>
                                            <div class="modal" id="cat_{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"  aria-modal="true" role="dialog">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-warning">
                                                            <h5 class="modal-title text-white">Edit Business Category</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true" class="text-white">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('update-business-categories')}}" method="post" autocomplete="off">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="">Category Name <span class="text-danger">*</span></label>
                                                                    <input type="text" name="category_name" value="{{$category->category_name ?? '' }}" placeholder="Enter Business Category"  class="form-control">
                                                                    @error('category_name')
                                                                    <i class="text-danger">{{$message}}</i>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group d-flex justify-content-center">
                                                                    <input type="hidden" name="categoryId" value="{{$category->id}}">
                                                                    <button type="submit" class="btn-primary btn">Save Changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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

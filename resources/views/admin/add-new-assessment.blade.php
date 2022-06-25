@extends('layouts.admin-layout')
@section('active-page')
    New Survey
@endsection
@section('title')
    New Survey
@endsection
@section('extra-styles')


@endsection
@section('breadcrumb-action-btn')
    <a href="{{route('show-assessment')}}" class="btn btn-primary btn-icon text-white mr-2">
        <span>
            <i class="ti-video-clapper"></i>
        </span> Manage Surveys
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
                        <form action="{{route('show-new-assessment')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="mb-0 card-title">Add New Survey</h3>
                                </div>
                                <div class="card-alert alert alert-success mb-0">
                                    Details
                                </div>
                                <p class="mt-3 pl-3">Enter survey details below</p>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="">Title <span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" name="title" placeholder="Enter Survey Title" value="{{old('title')}}">
                                                    @error('title')
                                                    <i class="text-danger">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="">Status <span class="text-danger">*</span></label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option disabled selected>--Select status--</option>
                                                        <option value="1">Active</option>
                                                        <option value="0">Inactive</option>
                                                    </select>
                                                    @error('status')
                                                    <i class="text-danger">{{$message}}</i>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Description <span class="text-danger">*</span></label>
                                                <textarea name="description" id="description" style="resize: none;" placeholder="Type description here..."
                                                          class="form-control content">{{old('description')}}</textarea>
                                                @error('description')
                                                <i class="text-danger">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table card-table table-vcenter text-nowrap mb-0 invoice-detail-table">
                                                <thead>
                                                <tr>
                                                    <th>Question</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="products">
                                                <tr class="item">
                                                    <td >
                                                    <textarea style="resize: none;" name="questions[]" placeholder="Type question here..."
                                                              class="form-control "></textarea>
                                                    </td>
                                                    <td>
                                                        <i class="bx bx-trash text-danger remove-line" style="cursor: pointer;"></i>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <button class="btn btn-sm btn-primary add-line" type="button"> <i class="bx bx-plus mr-2"></i> Add Line</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <a href="{{url()->previous()}}" class="btn btn-danger">Cancel</a>
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
    <script type="text/javascript" src="/assets/bower_components/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="/assets/bower_components/tinymce.js"></script>
    <script>
        $(document).ready(function(){
            $('.invoice-detail-table').on('mouseup keyup', 'input[type=number]', ()=> calculateTotals());


            $(document).on('click', '.add-line', function(e){
                e.preventDefault();
                var new_selection = $('.item').first().clone();
                $('#products').append(new_selection);

                $(".select-product").select2({
                    placeholder: "Select product or service"
                });
                $(".select-product").select2({ width: '100%' });
                $(".select-product").last().next().next().remove();
            });

            $(document).on('click', '.remove-line', function(e){
                e.preventDefault();
                $(this).closest('tr').remove();
            });

        });
    </script>
@endsection

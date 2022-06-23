@extends('layouts.admin-layout')
@section('active-page')
    Onboard New Business
@endsection
@section('title')
    Onboard New Business
@endsection
@section('extra-styles')


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
                        <form action="{{route('add-new-tenant')}}" method="post">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="mb-0 card-title">Add New Business</h3>
                                </div>
                                <p class="mt-3 pl-3"><strong class="text-danger">Note: </strong> A random  <code>password</code> will be generated and sent to the registered email. This can be changed to something else upon login.</p>
                                <div class="card-body">
                                    <div class="card-alert alert alert-success mb-0">
                                        Business Info
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Company Name</label>
                                                <input type="text" class="form-control" value="{{old('company_name') }}" name="company_name" placeholder="Company Name">
                                                @error('company_name') <i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">CAC RC No. <small>(Optional)</small></label>
                                                <input type="text" class="form-control" value="{{old('rc_no') }}" name="rc_no" placeholder="CAC RC No.">
                                                @error('rc_no') <i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Business Category</label>
                                                <select name="business_category" id="business_category" class="form-control">
                                                    <option selected disabled>--Select category--</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->category_name ?? '' }}</option>
                                                    @endforeach
                                                </select>
                                                @error('business_category') <i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Office Address</label>
                                                <textarea name="office_address" style="resize: none;"
                                                          class="form-control" placeholder="Type office address here...">{{old('office_address')}}</textarea>
                                                @error('office_address') <i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-alert alert alert-success mb-0">
                                        Owner Info
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Full Name</label>
                                                <input type="text" class="form-control" value="{{old('full_name') }}" name="full_name" placeholder="Full Name">
                                                @error('full_name') <i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Phone No.</label>
                                                <input type="text" class="form-control" value="{{old('phone_no') }}" name="phone_no" placeholder="Phone No.">
                                                @error('phone_no') <i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Email Address</label>
                                                <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Email Address">
                                                @error('email') <i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">NIN</label>
                                                <input type="text" value="{{old('nin')}}"  class="form-control" name="nin" placeholder="NIN" >
                                                @error('nin') <i class="text-danger">{{$message}}</i>@enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label"> Address</label>
                                                <input type="text" class="form-control" name="address" value="{{old('address')}}" placeholder="Address">
                                                @error('address') <i class="text-danger">{{$message}}</i>@enderror
                                            </div>
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

@endsection

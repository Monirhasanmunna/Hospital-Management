@extends('layouts.backend.main')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Doctor Create</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">List</li>
        <li class="breadcrumb-item active" aria-current="page">Doctor</li>
      </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{route('app.setting.referral.store')}}" method="POST">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-6">
                            <label for="code">Code</label>
                            <input type="number" class="form-control" readonly name="code" id="code" value="{{rand(0,99999)}}" class="@error('code') is-invalid @enderror">
                            @error('code')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group col-6">
                            <label for="referralmobile">Mobile</label>
                            <input type="text" class="form-control" name="mobile" id="referralmobile" class="@error('mobile') is-invalid @enderror">
                            @error('mobile')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        </div>
                        <div class="form-group ">
                          <label for="referralname">Name</label>
                          <input type="text" class="form-control" name="name" id="referralname" class="@error('name') is-invalid @enderror">
                          @error('name')
                              <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
            </div>
          </div>
    </div>
</div>
@endsection
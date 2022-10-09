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
                    <form action="{{route('app.setting.doctor.store')}}" method="POST">
                        @csrf
                      <div class="form-group">
                        <label for="doctorname">Name</label>
                        <input type="text" class="form-control" name="name" id="doctorname" class="@error('name') is-invalid @enderror">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="doctortitle">Title</label>
                        <input type="text" class="form-control" name="title" id="doctortitle" class="@error('title') is-invalid @enderror">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="mobile">Mobile</label>
                        <input type="number" class="form-control" name="mobile" id="mobile" class="@error('mobile') is-invalid @enderror">
                        @error('mobile')
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
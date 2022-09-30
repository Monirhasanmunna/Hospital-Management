@extends('layouts.backend.main')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        @if (isset($category))
            Category Update
        @else
            Category Create
        @endif
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">
            @if (isset($category))
                Update
            @else
                Create
            @endif
        </li>
        <li class="breadcrumb-item active" aria-current="page">Category</li>
      </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{route('app.pathology.category.store')}}" method="POST">
                        @csrf
                      <div class="form-group">
                        <label for="categoryname">Name</label>
                        <input type="text" class="form-control" name="name" id="categoryname" value="{{$category->name ?? old('name')}}" class="@error('name') is-invalid @enderror">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      @if (isset($category))
                      <button type="submit" class="btn btn-primary">Update</button>
                      @else
                      <button type="submit" class="btn btn-primary">Submit</button>
                      @endif
                    </form>
                  </div>
            </div>
          </div>
    </div>
</div>
@endsection
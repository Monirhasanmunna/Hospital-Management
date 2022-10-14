@extends('layouts.backend.main')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">
        @if (isset($supplier))
            Supplier Update
        @else
            Supplier Create
        @endif
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">
            @if (isset($supplier))
                Update
            @else
                Create
            @endif
        </li>
        <li class="breadcrumb-item active" aria-current="page">Supplier</li>
      </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{!isset($supplier) ? route('app.pharmacy.supplier.store') : route('app.pharmacy.supplier.update',$supplier->id)}}" method="POST">
                        @csrf
                        @if (isset($supplier))
                            @method('PUT')
                        @endif
                        
                      <div class="form-group">
                        <label for="suppliername">Name</label>
                        <input type="text" class="form-control" name="name" id="suppliername" value="{{$supplier->name ?? old('name')}}" class="@error('name') is-invalid @enderror">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="form-group">
                        <label for="suppliercode">Code</label>
                        <input type="text" class="form-control" name="code" id="suppliercode" value="{{$supplier->code ?? old('code')}}" class="@error('code') is-invalid @enderror">
                        @error('code')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
                      @if (isset($supplier))
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
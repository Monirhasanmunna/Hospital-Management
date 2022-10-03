@extends('layouts.backend.main')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Test Create</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">Create</li>
        <li class="breadcrumb-item active" aria-current="page">Test</li>
      </ol>
    </div>
    <div class="row">
      <div class="col-lg-12">
          <div class="card mb-4">
              <div class="card-body">
                  <form action="{{route('app.setting.test.store')}}" method="POST">
                      @csrf
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="category">Category</label>
                          <select name="category" class="js-example-placeholder-single js-states form-control" class="@error('category') is-invalid @enderror">
                            <option></option>
                            @foreach ($categories as $category)
                               <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          </select>
                          @error('category')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        
                        <div class="form-group col-md-6">
                          <label for="code">Code</label>
                          <input type="text" class="form-control" name="code" id="code" readonly value="{{$data->code+1}}" class="@error('code') is-invalid @enderror">
                          @error('code')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="name">Name</label>
                          <input type="text" class="form-control" name="name" id="name" class="@error('name') is-invalid @enderror">
                          @error('name')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group col-md-6">
                          <label for="refddiscount">Refd. Fee Rate(%)</label>
                          <input type="number" name="refd_percent" class="form-control" id="refd" class="@error('refd_percent') is-invalid @enderror">
                          @error('refd_percent')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6">
                          <label for="standard_cost">Standard Rate</label>
                          <input type="number" name="standard_rate" class="form-control" id="standard_rate" class="@error('standard_cost') is-invalid @enderror">
                          @error('standard_cost')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group col-md-6">
                          <label for="refdamount">Refd. Fee Amount</label>
                          <input type="number" name="refd_amount" readonly class="form-control" id="refdamount" class="@error('refd_amount') is-invalid @enderror">
                          @error('refd_amount')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                        <button type="submit" class="btn btn-primary">Create</button>
                  </form>
                </div>
          </div>
        </div>
  </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(".js-example-placeholder-single").select2({
            placeholder: "--Select One--",
            allowClear: true
        });
    </script>

    <script>
      $(document).ready(function(){
        $("#refd").on('change keyup',function(){
          var standard_rate = $("#standard_rate").val();
          var refd = $(this).val();

          var reffd_amount = (standard_rate/100)*refd;
          $("#refdamount").val(reffd_amount);
        });
      });
    </script>
@endpush
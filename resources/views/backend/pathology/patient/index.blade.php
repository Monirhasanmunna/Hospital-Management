@extends('layouts.backend.main')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Patients</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">List</li>
        <li class="breadcrumb-item active" aria-current="page">Patient</li>
      </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <thead class="thead-dark">
                    <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>Age</th>
                      <th>Mobile</th>
                      <th>Refd</th>
                      <th>Doctor</th>
                      <th>Test</th>
                      <th>Vat</th>
                      <th>Discount</th>
                      <th>Total</th>
                      <th>Paid</th>
                      <th>Due</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($patients as $key=>$patient)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$patient->name}}</td>
                      <td>{{$patient->age}}</td>
                      <td>{{$patient->mobile}}</td>
                      <td>{{$patient->referral->name}}</td>
                      <td>{{$patient->doctor->name}}</td>
                      <td>
                        @foreach ($patient->tests as $test)
                          <span class="badge badge-primary">{{$test->name}}</span>
                        @endforeach
                      </td>
                      <td>{{$patient->vat_amount}}</td>
                      <td>{{$patient->discount_amount}}</td>
                      <td>{{$patient->total_amount}}</td>
                      <td>{{$patient->paid_amount}}</td>
                      <td>{{$patient->due_amount}}</td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{-- <i class="fa-solid fa-list"></i> --}}
                            Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" onclick="editTest({{$patient->id}})" data-toggle="modal" data-target=".bd-example-modal-lg" href="javascript:void(0)"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                            <a class="dropdown-item"  onclick = 'deleteTest({{$patient->id}})' href="javascript:void(0)"><i class="fa-solid fa-trash"></i>Delete</a>
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

<!-- Large modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header pt-3 pb-2 d-flex flex-row align-items-center justify-content-between bg-primary">
                <h6 class="m-0 font-weight-bold text-white">Edit Test</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="card-body">
                    <form action="{{route('app.setting.test.update',[1])}}" method="POST">
                        @csrf
                        <input name="test_id" hidden type="number" id="test_id">
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" class="@error('name') is-invalid @enderror">
                            @error('name')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="code">Code</label>
                            <input type="text" class="form-control" name="code" id="code" class="@error('code') is-invalid @enderror">
                            @error('code')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        {{-- <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="category">Category</label>
                            <select id="category" name="category" class="form-control" class="@error('category') is-invalid @enderror">
                              @foreach ($categories as $category)
                                 <option value="{{$category->id}}">{{$category->name}}</option> 
                              @endforeach
                            </select>
                            @error('category')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="standard_cost">Standard Cost</label>
                            <input type="number" name="standard_rate" class="form-control" id="standard_rate" class="@error('standard_cost') is-invalid @enderror">
                            @error('standard_cost')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div> --}}
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="refddiscount">Refferd Discount</label>
                            <input type="number" name="refd_percent" class="form-control" id="refd_percent" class="@error('refd_percent') is-invalid @enderror">
                            @error('refd_percent')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group col-md-6">
                            <label for="refdamount">Refferd Amount</label>
                            <input type="number" name="refd_amount" class="form-control" id="refd_amount" class="@error('refd_anount') is-invalid @enderror">
                            @error('refd_anount')
                              <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                        </div>
                        
                          <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                  </div>
            </div>
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
            placeholder: "Choose One",
            allowClear: true
        });
    </script>

<script>
  $(document).ready(function(){
    $("#refd_percent").on('change keyup',function(){
      var standard_rate = $("#standard_rate").val();
      var refd = $(this).val();

      var reffd_amount = (standard_rate/100)*refd;
      $("#refd_amount").val(reffd_amount);
    });
  });
</script>

  <script>
    function editTest(id){
      $.ajax({
        url       : '/app/setting/test/edit/'+id,
        Type      : 'GET',
        dataType  : 'json',
        success   : function(response){
          console.log(response);
          $("#test_id").val(response.id);
          $("#name").val(response.name);
          $("#code").val(response.code);
          $("#standard_rate").val(response.standard_rate);
          $("#refd_percent").val(response.refd_percent);
          $("#refd_amount").val(response.refd_amount);

          var data = `<option selected hidden value='${response.category.id}'>${response.category.name}</option>`;
          $("#category").append(data);
        }
      });
    }

    function deleteTest(id){

      Swal.fire({
          title: 'Are you sure?',
          text: "You will lost this data!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )
            $.ajax({
              url      : '/app/pathology/test/delete/'+id,
              dataType : 'json',
              Type     : 'DELETE',
              success  : function(response){
                setTimeout(function(){
                  window.location.reload();
                },1000);
              }
            });
          }
      })
    }
  </script>
@endpush
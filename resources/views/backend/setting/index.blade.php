@extends('layouts.backend.main')
@push('css')
    
@endpush

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">General Setting</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">General Setting</li>
      </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" >
                  <thead class="thead-dark">
                    <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>Gmail</th>
                      <th>Mobile</th>
                      <th>Address</th>
                      <th>Logo</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach (App\Models\Setting\GeneralSetting::all() as $key=>$row)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$row->name}}</td>
                      <td>{{$row->gmail}}</td>
                      <td>{{$row->mobile}}</td>
                      <td>{{$row->address}}</td>
                      <td><img src="{{ asset('backend/img/logo').'/'.$row->logo }}" alt="" width="50px" height="50px"/></td>
                      <td><a onclick="editSetting({{$row->id}})" href="javascript:void(0)">Edit</a></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
</div>

<!-- Account Model modal -->
<div class="modal fade bd-example-modal-lg" id="ExpenseAddModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header pt-3 pb-2 d-flex flex-row align-items-center justify-content-between bg-primary">
                <h6 class="m-0 font-weight-bold text-white">Expense Add</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="card-body">
                    <form action="{{route('app.general_setting.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <input type="hidden" name="general_setting_id" id="general_setting_id">
                          <div class="form-group col-6">
                            <label for="referralname">Name</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                          </div>
                          <div class="form-group col-6">
                            <label for="referralname">Gmail</label>
                            <input type="email" class="form-control" name="gmail" id="gmail" required>
                          </div>
                          <div class="form-group col-6">
                            <label for="">Mobile</label>
                            <input type="number" class="form-control" name="mobile" id="mobile">
                          </div>
                          <div class="form-group col-6">
                            <label for="">Address</label>
                            <textarea name="address" id="address" cols="30" rows="3" class="form-control"></textarea>
                          </div>
                          <div class="form-group col-6">
                            <label for="">Logo</label>
                            <input type="file" class="form-control" name="logo" id="logo">
                            <div class="logo">

                            </div>
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
  <script>

    function editSetting(id){
      $('#general_setting_id').val(id);
      if (id) {
        $.get("/app/setting/general_setting/edit/"+id,
          function (data) {
            console.log(data);
            $('#name').val(data.name);
            $('#gmail').val(data.gmail);
            $('#mobile').val(data.mobile);
            $('#address').text(data.address);
            $('.logo').append(`<img src="{{ asset('backend/img/logo/${data.logo}')}}" alt="logo" width="50px" height="50px">`);
            $('#ExpenseAddModel').modal('show');
          }
        );
      }
    }
  </script>
@endpush
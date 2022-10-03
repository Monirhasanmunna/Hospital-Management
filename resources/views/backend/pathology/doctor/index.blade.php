@extends('layouts.backend.main')
@push('css')
    
@endpush

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Doctors</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">List</li>
        <li class="breadcrumb-item active" aria-current="page">Units</li>
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
                      <th>Title</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($doctors as $key=>$doctor)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$doctor->name}}</td>
                      <td>{{$doctor->title}}</td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" onclick="editDoctor({{$doctor->id}})" data-toggle="modal" data-target=".bd-example-modal-lg" href="javascript:void(0)"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                            <a class="dropdown-item" onclick ='deleteDoctor({{$doctor->id}})' href="javascript:void(0)"><i class="fa-solid fa-trash"></i>Delete</a>
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
                <h6 class="m-0 font-weight-bold text-white">Edit Unit</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="card-body">
                    <form action="{{route('app.setting.doctor.update',[1])}}" method="POST">
                        @csrf
                        <input name="doctor_id" hidden type="number" id="doctor_id">
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

    function editDoctor(id){
      $.ajax({
        url       : '/app/setting/doctor/edit/'+id,
        Type      : 'GET',
        dataType  : 'json',
        success   : function(response){
          $("#doctor_id").val(response.id);
          $("#doctorname").val(response.name);
          $("#doctortitle").val(response.title);
        }
      });
    }

    function deleteDoctor(id){

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
              url      : '/app/setting/doctor/delete/'+id,
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
@extends('layouts.backend.main')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="text-left mb-3">
      <button class="btn btn-primary" id="floor_add_btn"><i class="fa-solid fa-circle-plus"></i><span class="pl-1">Add New</span></button>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <thead class="thead-dark">
                    <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($floors as $key=>$floor)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td><span class="text-primary">{{$floor->name}}</span></td>
                      <td>{{$floor->description}}</td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-sm btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class=" btn-sm btn-primary dropdown-item" onclick = "editFloor({{$floor->id}})" href="javascript:void(0)"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                            <a class=" btn-sm btn-danger dropdown-item"  onclick = 'deleteFloor({{$floor->id}})' href="javascript:void(0)"><i class="fa-solid fa-trash"></i>Delete</a>
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

{{-- add floor modal --}}
<div class="modal fade bd-example-modal-lg" id="FloorAddModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header pt-3 pb-2 d-flex flex-row align-items-center justify-content-between bg-primary">
                <h6 class="m-0 font-weight-bold text-white">Floor Add</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="card-body">
                    <form action="{{route('app.floor.store')}}" method="POST">
                        @csrf
                          <div class="form-group">
                            <label for="floorName">Name</label>
                            <input id="" type="text" class="form-control" name="name" required>
                          </div>

                          <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="" type="text" class="form-control" name="description"></textarea>
                          </div>
                
                          <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                  </div>
            </div>
          </div>
    </div>
    </div>
  </div>
</div>

{{-- edit floor modal --}}
<div class="modal fade bd-example-modal-lg" id="FlooreditModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header pt-3 pb-2 d-flex flex-row align-items-center justify-content-between bg-primary">
                <h6 class="m-0 font-weight-bold text-white">Floor Edit</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="card-body">
                    <form action="{{route('app.floor.update',[1])}}" method="POST">
                        @csrf
                          <input type="number" hidden name="floor_id" id="floor_id">
                          <div class="form-group">
                            <label for="floorName">Name</label>
                            <input id="floor_name" type="text" class="form-control" name="name" required>
                          </div>

                          <div class="form-group">
                            <label for="description">Description</label>
                            <textarea id="floor_description" type="text" class="form-control" name="description"></textarea>
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
    $("#floor_add_btn").click(function(){
      $("#FloorAddModel").modal('show');
    });
  </script>

  <script>
     function editFloor(id){
        $.ajax({
          url       : '/app/floor/edit/'+id,
          type      : 'GET',
          dataType  : 'json',
          success   : function(response){
            $("#floor_id").val(response.id);
            $("#floor_name").val(response.name);
            $("#floor_description").val(response.description);
            $("#FlooreditModel").modal('show');
          },
        });
      }


    function deleteFloor(id){

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
              url      : '/app/floor/delete/'+id,
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
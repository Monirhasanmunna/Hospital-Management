@extends('backend.bed.main')

@section('bed_content')
<div class="card mb-4">
    <span class="text-right mb-3">
        <button class="btn btn-sm btn-primary mt-2 mr-2" id="bedGroupAdd_btn"><i class="fa-solid fa-circle-plus"></i><span class="pl-1">Add New</span></button>
      </span>
    <div class="table-responsive p-3">
      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead class="thead-dark">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Floor</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bedGroups as $key=>$bedgroup)
          <tr>
            <td>{{$key+1}}</td>
            <td><span class="text-primary">{{$bedgroup->name}}</span></td>
            <td>{{$bedgroup->floor->name}}</td>
            <td>{{$bedgroup->description}}</td>
            <td>
              <div class="dropdown">
                <button class="btn btn-sm btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class=" btn-sm btn-primary dropdown-item" onclick = "editBedGroup({{$bedgroup->id}})" href="javascript:void(0)"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                  <a class=" btn-sm btn-danger dropdown-item"  onclick = 'deleteBedGroup({{$bedgroup->id}})' href="javascript:void(0)"><i class="fa-solid fa-trash"></i>Delete</a>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  {{-- add floor modal --}}
<div class="modal fade bd-example-modal-lg" id="BedGroupAddModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="row">
          <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header pt-3 pb-2 d-flex flex-row align-items-center justify-content-between bg-primary">
                  <h6 class="m-0 font-weight-bold text-white">Bed Group Add</h6>
                  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <div class="card-body">
                      <form action="{{route('app.bed.group.store')}}" method="POST">
                          @csrf
                            <div class="form-group">
                              <label for="bedgroupName">Name</label>
                              <input id="bedgroupName" type="text" class="form-control" name="name" required>
                            </div>

                            <div class="form-group">
                              <label for="floor">Floor</label>
                              <select name="floor_id" class="form-control" id="floor">
                                @foreach ($floors as $floor)
                                <option value="{{$floor->id}}">{{$floor->name}}</option>
                                @endforeach
                              </select>
                            </div>
  
                            <div class="form-group">
                              <label for="description">Description</label>
                              <textarea id="bedGroupdescription" type="text" class="form-control" name="description"></textarea>
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
  <div class="modal fade bd-example-modal-lg" id="BedGroupEditModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                      <form action="{{route('app.bed.group.update',[1])}}" method="POST">
                          @csrf
                            <input type="number" hidden name="bedgroup_id" id="bedgroup_id">
                            <div class="form-group">
                              <label for="bedgroup_name">Name</label>
                              <input id="bedgroup_name" type="text" class="form-control" name="name" required>
                            </div>

                            <div class="form-group">
                              <label for="floor">Floor</label>
                              <select name="floor_id" class="form-control" id="bedGroupIdFloorId">
                                @foreach ($floors as $floor)
                                <option value="{{$floor->id}}">{{$floor->name}}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="description">Description</label>
                              <textarea id="bedgroup_description" type="text" class="form-control" name="description"></textarea>
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
    $("#bedGroupAdd_btn").click(function(){
      $("#BedGroupAddModel").modal('show');
    });
  </script>

  <script>
     function editBedGroup(id){
        $.ajax({
          url       : '/app/setting/bed/group/edit/'+id,
          type      : 'GET',
          dataType  : 'json',
          success   : function(response){
            console.log(response);
            $("#bedgroup_id").val(response.id);
            $("#bedgroup_name").val(response.name);
            $data=`<option selected hidden value='${response.floor.id}'>${response.floor.name}</option>`;
            $("#bedGroupIdFloorId").append($data);
            $("#bedgroup_description").val(response.description);
            $("#BedGroupEditModel").modal('show');
          },
        });
      }


    function deleteBedGroup(id){

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
              url      : '/app/setting/bed/group/delete/'+id,
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
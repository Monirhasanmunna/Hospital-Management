@extends('backend.bed.main')
@push('css')
    <style>
      table.dataTable tbody th, table.dataTable tbody td {
          padding: 3px 10px; /* e.g. change 8x to 4px here */
      }
    </style>
@endpush
@section('bed_content')

<div class="card mb-4">
    <span class="text-right mb-3">
        <button class="btn btn-sm btn-primary mt-2 mr-2" id="bedGroupAdd_btn"><i class="fa-solid fa-circle-plus"></i><span class="pl-1">Add New</span></button>
      </span>
    <div class="table-responsive p-3">
      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead class="">
          <tr>
            <th>Name</th>
            <th>Bed Type</th>
            <th>Bed Group</th>
            <th>Used</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($beds as $key=>$bed)
          <tr>
            <td><span class="text-primary">{{$bed->name}}</span></td>
            <td>{{$bed->bedtype->name}}</td>
            <td>{{$bed->bedgroup->name}} - {{$bed->bedgroup->floor->name}}</td>
            <td>
              @if($bed->status == false)
              <span class="badge badge-primary">Not Use</span>
              @else
              <span class="badge badge-danger">Used</span>
              @endif
            </td>
            <td>
              <div class="dropdown">
                <button class="btn btn-sm btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class=" btn-sm btn-primary dropdown-item" onclick = "editBed({{$bed->id}})" href="javascript:void(0)"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                  <a class=" btn-sm btn-danger dropdown-item"  onclick = 'deleteBed({{$bed->id}})' href="javascript:void(0)"><i class="fa-solid fa-trash"></i>Delete</a>
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
                      <form action="{{route('app.bed.store')}}" method="POST">
                          @csrf
                            <div class="form-group">
                              <label for="bedName">Name</label>
                              <input id="bedName" type="text" class="form-control" name="name" required>
                            </div>

                            <div class="form-group">
                              <label for="bedtype">Bed Type</label>
                              <select name="bed_type" class="form-control" id="bed_type">
                                <option value="" hidden disabled selected>Choose One</option>
                                @foreach ($bedtypes as $bedtype)
                                <option value="{{$bedtype->id}}">{{$bedtype->name}}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="bedgroup">Bed Group</label>
                              <select name="bed_group" class="form-control" id="bed_group">
                                <option value="" hidden disabled selected>Choose One</option>
                                @foreach ($bedgroups as $bedgroup)
                                <option value="{{$bedgroup->id}}">{{$bedgroup->name}}</option>
                                @endforeach
                              </select>
                            </div>
  
                            <div class="form-check mb-3">
                              <input class="form-check-input" type="checkbox" id="status" value="1" name="status">
                              <label class="form-check-label" for="status">
                                Status
                              </label>
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
  <div class="modal fade bd-example-modal-lg" id="BedEditModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                      <form action="{{route('app.bed.update',[1])}}" method="POST">
                          @csrf
                            <input type="number" hidden name="bed_id" id="bed_id">
                            <div class="form-group">
                              <label for="bed_name">Name</label>
                              <input id="bed_name" type="text" class="form-control" name="name" required>
                            </div>

                            <div class="form-group">
                              <label for="bedtype">Bed Type</label>
                              <select name="bed_type" class="form-control" id="bed_type">
                                @foreach ($bedtypes as $bedtype)
                                <option value="{{$bedtype->id}}">{{$bedtype->name}}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="form-group">
                              <label for="bedgroup">Bed Group</label>
                              <select name="bed_group" class="form-control" id="bed_group">
                                @foreach ($bedgroups as $bedgroup)
                                <option value="{{$bedgroup->id}}">{{$bedgroup->name}}</option>
                                @endforeach
                              </select>
                            </div>

                            <div class="form-check mb-3">
                              <input class="form-check-input" type="checkbox" id="bedstatus" value="1"  name="status">
                              <label class="form-check-label" for="status">
                                Status
                              </label>
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
     function editBed(id){
        $.ajax({
          url       : '/app/setting/bed/edit/'+id,
          type      : 'GET',
          dataType  : 'json',
          success   : function(response){
            console.log(response);
            $("#bed_id").val(response.id);
            $("#bed_name").val(response.name);
            $data=`<option selected hidden value='${response.bedtype.id}'>${response.bedtype.name}</option>`;
            $("#bed_type").append($data);
            $datas=`<option selected hidden value='${response.bedgroup.id}'>${response.bedgroup.name}</option>`;
            $("#bed_group").append($datas);
            
            if(response.status == 1){
              $("#bedstatus").attr("checked", true);
              $("#bedstatus").val(response.status);
            }
            $("#BedEditModel").modal('show');
          },
        });
      }


    function deleteBed(id){

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
              url      : '/app/setting/bed/delete/'+id,
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
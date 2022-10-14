@extends('backend.bed.main')

@section('bed_content')
<div class="card mb-4">
    <span class="text-right mb-3">
        <button class="btn btn-sm btn-primary mt-2 mr-2" id="bedTypeBtn"><i class="fa-solid fa-circle-plus"></i><span class="pl-1">Add New</span></button>
      </span>
    <div class="table-responsive p-3">
      <table class="table align-items-center table-flush table-hover" id="dataTableHover">
        <thead class="thead-dark">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th class="text-right">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bedtypes as $key=>$bedtype)
          <tr>
            <td>{{$key+1}}</td>
            <td><span class="text-primary">{{$bedtype->name}}</span></td>
            <td class="text-right">
              <div class="dropdown">
                <button class="btn btn-sm btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class=" btn-sm btn-primary dropdown-item" onclick = "editBedtype({{$bedtype->id}})" href="javascript:void(0)"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                  <a class=" btn-sm btn-danger dropdown-item"  onclick = 'deleteBedtype({{$bedtype->id}})' href="javascript:void(0)"><i class="fa-solid fa-trash"></i>Delete</a>
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
<div class="modal fade bd-example-modal-lg" id="BedTypeAddModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="row">
          <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header pt-3 pb-2 d-flex flex-row align-items-center justify-content-between bg-primary">
                  <h6 class="m-0 font-weight-bold text-white">Bed Type Add</h6>
                  <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <div class="card-body">
                      <form action="{{route('app.bed.type.store')}}" method="POST">
                          @csrf
                            <div class="form-group">
                              <label for="floorName">Name</label>
                              <input id="" type="text" class="form-control" name="name" required>
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
  <div class="modal fade bd-example-modal-lg" id="BedTypeEditModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                      <form action="{{route('app.bed.type.update',[1])}}" method="POST">
                          @csrf
                            <input type="number" hidden name="bedtype_id" id="bedtype_id">

                            <div class="form-group">
                              <label for="bedtypeName">Name</label>
                              <input id="bedtype_name" type="text" class="form-control" name="name" required>
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
    $("#bedTypeBtn").click(function(){
      $("#BedTypeAddModel").modal('show');
    });
  </script>

  <script>
     function editBedtype(id){
        $.ajax({
          url       : '/app/setting/bed/type/edit/'+id,
          type      : 'GET',
          dataType  : 'json',
          success   : function(response){
            $("#bedtype_id").val(response.id);
            $("#bedtype_name").val(response.name);
            $("#BedTypeEditModel").modal('show');
          },
        });
      }


    function deleteBedtype(id){

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
              url      : '/app/setting/bed/type/delete/'+id,
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
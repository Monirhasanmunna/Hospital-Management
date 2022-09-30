@extends('layouts.backend.main')
@push('css')
    
@endpush

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Units</h1>
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
                      <th>#</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($units as $key=>$unit)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$unit->name}}</td>
                      <td>
                        <a class="btn btn-sm btn-primary" onclick="editUnit({{$unit->id}})" data-toggle="modal" data-target=".bd-example-modal-lg" href="javascript:void(0)"><i class="fa-regular fa-pen-to-square"></i></a>
                        <a class="btn btn-sm btn-danger"  onclick = 'deleteUnit({{$unit->id}})' href="javascript:void(0)"><i class="fa-solid fa-trash"></i></a>
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
              <div class="card-header pt-3 pb-2 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Edit Unit</h6>
              </div>
                <div class="card-body">
                    <form action="{{route('app.pathology.unit.update',[1])}}" method="POST">
                        @csrf
                        <input name="unit_id" hidden type="number" id="unit_id">
                        <div class="form-group">
                          <label for="unitname">Name</label>
                          <input type="text" class="form-control" name="name" id="unitname" class="@error('name') is-invalid @enderror">
                          @error('name')
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

    function editUnit(id){
      $.ajax({
        url       : '/app/pathology/unit/edit/'+id,
        Type      : 'GET',
        dataType  : 'json',
        success   : function(response){
          $("#unit_id").val(response.id);
          $("#unitname").val(response.name);
        }
      });
    }

    function deleteUnit(id){

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
              url      : '/app/pathology/unit/delete/'+id,
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
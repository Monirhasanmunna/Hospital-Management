@extends('layouts.backend.main')
@push('css')
    
@endpush

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Categories</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">List</li>
        <li class="breadcrumb-item active" aria-current="page">Categories</li>
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
                    @foreach ($categories as $key=>$category)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$category->name}}</td>
                      <td>
                        <a class="btn btn-sm btn-primary" onclick="editCategory({{$category->id}})" data-toggle="modal" data-target=".bd-example-modal-lg" href="javascript:void(0)"><i class="fa-regular fa-pen-to-square"></i></a>
                        <a class="btn btn-sm btn-danger"  onclick = 'deleteCategory({{$category->id}})' href="javascript:void(0)"><i class="fa-solid fa-trash"></i></a>
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
                <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
              </div>
                <div class="card-body">
                    <form action="{{route('app.pathology.category.update',[1])}}" method="POST">
                      @csrf
                      <input name="category_id" hidden type="number" id="category_id">
                      <div class="form-group">
                        <label for="categoryname">Name</label>
                        <input type="text" class="form-control" name="name" id="categoryname" class="@error('name') is-invalid @enderror">
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

    function editCategory(id){
      $.ajax({
        url       : '/app/pathology/category/edit/'+id,
        Type      : 'GET',
        dataType  : 'json',
        success   : function(response){
          $("#category_id").val(response.id);
          $("#categoryname").val(response.name);
        }
      });
    }

    function deleteCategory(id){

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
              url      : '/app/pathology/category/delete/'+id,
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
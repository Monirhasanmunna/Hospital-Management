@extends('layouts.backend.main')
@push('css')
    
@endpush

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Expense Category <a href="javascript:void(0)" class="btn btn-primary ml-3" id="AddExpenseCategory"><i class="fas fa-plus"></i>Add Expense Category </a></h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">Expense</li>
        <li class="breadcrumb-item active" aria-current="page">Category</li>
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
                      <th>Code</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $key=>$category)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$category->code}}</td>
                      <td>{{$category->name}}</td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" onclick="editExpenseCategory({{$category->id}})" href="javascript:void(0)"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                            <a class="dropdown-item" onclick="deleteCategory({{$category->id}})" href="javascript:void(0)"><i class="fa-solid fa-trash"></i>Delete</a>
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

<!-- Account Model modal -->
<div class="modal fade bd-example-modal-lg" id="ExpenseCategoryAddModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header pt-3 pb-2 d-flex flex-row align-items-center justify-content-between bg-primary">
                <h6 class="m-0 font-weight-bold text-white">Expense Category Add</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="card-body">
                    <form action="{{route('app.expense.category.store')}}" method="POST">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-12">
                            <label for="code">Code</label>
                            <input type="number" class="form-control" name="code" readonly value="{{ rand(0,99999) }}">
                          </div>
                          <div class="form-group col-12">
                            <label for="">Category Name</label>
                            <input type="text" class="form-control" name="name">
                          </div>
                        </div>
                          <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                  </div>
            </div>
          </div>
    </div>
    </div>
  </div>
</div>
<!-- Account Edit Large modal -->
<div class="modal fade bd-example-modal-lg" id="ExpenseCategoryEditModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header pt-3 pb-2 d-flex flex-row align-items-center justify-content-between bg-primary">
                <h6 class="m-0 font-weight-bold text-white">Edit Expense Category</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="card-body">
                    <form action="{{route('app.expense.category.update',1)}}" method="POST">
                        @csrf
                        <div class="form-row">
                          <input type="hidden" name="expense_category_id" id="expense_category_id">
                          <div class="form-group col-12">
                            <label for="code">Code</label>
                            <input type="number" class="form-control" name="code" id="code" readonly value="{{ rand(0,99999) }}">
                          </div>
                          <div class="form-group col-12">
                            <label for="">Category Name</label>
                            <input type="text" class="form-control" name="name" id="name">
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
    $('#AddExpenseCategory').click(function (e) { 
      $('#ExpenseCategoryAddModel').modal('show');
    });
    function editExpenseCategory(id){
      $('#account_id').val(id);
      if (id) {
        $.get("/app/expense/category/edit/"+id,
          function (data) {
            console.log(data.data.name);
            $('#name').val(data.data.name);
            $('#code').val(data.data.code);
            $('#ExpenseCategoryEditModel').modal('show');
          }
        );
      }
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
              url      : '/app/expense/category/delete/'+id,
              dataType : 'json',
              Type     : 'DELETE',
              success  : function(response){
                console.log(response);
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
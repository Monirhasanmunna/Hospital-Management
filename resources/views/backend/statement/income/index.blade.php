@extends('layouts.backend.main')
@push('css')
    
@endpush

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Income <a href="javascript:void(0)" class="btn btn-primary ml-3" id="AddExpense"><i class="fas fa-plus"></i>Add Expense </a></h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">Income</li>
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
                      <th>Amount</th>
                      <th>Date</th>
                      {{-- <th>Action</th> --}}
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($incomes as $key => $income)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$income->name}}</td>
                      <td>{{$income->amount}}</td>
                      <td>{{$income->created_at->format('d-M-Y')}}</td>
                      {{-- <td>
                        <div class="dropdown">
                          <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" onclick="editExpense({{$expense->id}})" href="javascript:void(0)"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                            <a class="dropdown-item" onclick="deleteExpense({{$expense->id}})" href="javascript:void(0)"><i class="fa-solid fa-trash"></i>Delete</a>
                          </div>
                        </div>
                      </td> --}}
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
</div>

{{-- <!-- Account Model modal -->
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
                    <form action="{{route('app.expense.store')}}" method="POST">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-6">
                            <label for="referralname">Date</label>
                            <input type="date" class="form-control" name="date" required>
                          </div>
                          <div class="form-group col-6">
                            <label for="">Category</label>
                            <select name="category_id" class="form-control" required>
                              <option value="">Select Expense Category</option>
                              @foreach (App\Models\Expense\ExpenseCategory::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group col-6">
                            <label for="">Amount</label>
                            <input type="number" class="form-control" name="amount">
                          </div>
                          <div class="form-group col-6">
                            <label for="">Details</label>
                            <textarea name="details" cols="30" rows="3" class="form-control"></textarea>
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
                    <form action="{{route('app.expense.update',1)}}" method="POST">
                        @csrf
                        <input type="hidden" id="expense_id" name="expense_id">
                        <div class="form-row">
                          <div class="form-group col-6">
                            <label for="referralname">Date</label>
                            <input type="date" class="form-control" name="date" id="date" required>
                          </div>
                          <div class="form-group col-6">
                            <label for="">Category</label>
                            <select name="category_id" class="form-control" id="category_id" required>
                              <option value="">Select Expense Category</option>
                              @foreach (App\Models\Expense\ExpenseCategory::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="form-group col-6">
                            <label for="">Amount</label>
                            <input type="number" class="form-control" name="amount" id="amount">
                          </div>
                          <div class="form-group col-6">
                            <label for="">Details</label>
                            <textarea name="details" cols="30" rows="3" class="form-control" id="details"></textarea>
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
</div> --}}
@endsection

{{-- @push('js')
  <script>
    $('#AddExpense').click(function (e) { 
      $('#ExpenseAddModel').modal('show');
    });
    function editExpense(id){
      $('#expense_id').val(id);
      if (id) {
        $.get("/app/expense/edit/"+id,
          function (data) {
            $('#date').val(data.data.date);
            $('#category_id').val(data.data.category_id).change();
            $('#amount').val(data.data.amount);
            $('#details').text(data.data.details);
            console.log(data.data.details);
            $('#ExpenseCategoryEditModel').modal('show');
          }
        );
      }
    }

    function deleteExpense(id){

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
            url      : '/app/expense/delete/'+id,
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
@endpush --}}
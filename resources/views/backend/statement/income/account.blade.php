@extends('layouts.backend.main')
@push('css')
    
@endpush

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Accounts <a href="javascript:void(0)" class="btn btn-primary ml-3" id="AddAccount"><i class="fas fa-plus"></i>Add Account</a></h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">Account</li>
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
                      <th>Debit</th>
                      <th>Credit</th>
                      <th>Balance</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach (App\Models\Expense\Account::all() as $key=>$account)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$account->name}}</td>
                      <td>{{$account->debit}}</td>
                      <td>{{$account->credit}}</td>
                      <td>{{$account->balance}}</td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" onclick="editAccount({{$account->id}})" href="javascript:void(0)"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                            <a class="dropdown-item" onclick="return confirm('Are you sure to delete this data..??')" href="{{ route('app.account.delete',$account->id) }}"><i class="fa-solid fa-trash"></i>Delete</a>
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
<div class="modal fade bd-example-modal-lg" id="AccountAddModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header pt-3 pb-2 d-flex flex-row align-items-center justify-content-between bg-primary">
                <h6 class="m-0 font-weight-bold text-white">Account Add</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="card-body">
                    <form action="{{route('app.account.store')}}" method="POST">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-6">
                            <label for="referralname">Account Name</label>
                            <input type="text" class="form-control" name="name" required>
                          </div>
                          <div class="form-group col-6">
                            <label for="">Debit Amount</label>
                            <input type="number" class="form-control" name="debit">
                          </div>
                          <div class="form-group col-6">
                            <label for="">Credit Amount</label>
                            <input type="number" class="form-control" name="credit">
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
<div class="modal fade bd-example-modal-lg" id="AccountEditModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header pt-3 pb-2 d-flex flex-row align-items-center justify-content-between bg-primary">
                <h6 class="m-0 font-weight-bold text-white">Edit Account</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="card-body">
                    <form action="{{route('app.account.update',1)}}" method="POST">
                        @csrf
                        <div class="form-row">
                          <input type="hidden" name="account_id" id="account_id">
                          <div class="form-group col-6">
                            <label for="referralname">Account Name</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                          </div>
                          <div class="form-group col-6">
                            <label for="">Debit Amount</label>
                            <input type="number" class="form-control debit" name="debit" id="debit">
                          </div>
                          <div class="form-group col-6">
                            <label for="">Credit Amount</label>
                            <input type="number" class="form-control" name="credit" id="credit">
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
    $('#AddAccount').click(function (e) { 
      $('#AccountAddModel').modal('show');
    });
    function editAccount(id){
      if (id) {
        $.get("/app/expense/account/edit/"+id,
          function (data) {
            $('#name').val(data.data.name);
            $('.debit').val(data.data.debit);
            $('#credit').val(data.data.credit);
            $('#account_id').val(data.data.id);
            $('#AccountEditModel').modal('show');
          }
        );
      }
    }
  </script>
@endpush
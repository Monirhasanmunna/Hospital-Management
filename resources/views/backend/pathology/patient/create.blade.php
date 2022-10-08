@extends('layouts.backend.main')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="crossorigin="anonymous" referrerpolicy="no-referrer" />


<link rel="stylesheet" href="/resources/demos/style.css">

@endpush

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Patient Create</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
            <li class="breadcrumb-item">Create</li>
            <li class="breadcrumb-item active" aria-current="page">Patient</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-1">
                <div class="card-body py-3">
                    <form action="{{route('app.pathology.patient.store')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-9 float-left">
                                <div class="card-body px-0">

                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="name">Patient Name</label>
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" autofocus>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="mobile">Mobile</label>
                                            <input id="mobile" type="number"
                                                class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                                autofocus>
                                            @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group col-2">
                                          <label for="age">Age</label>
                                          <input id="age" type="number" class="form-control @error('name') is-invalid @enderror" name="age" autofocus>
                                      </div>
                                    </div>

                                    <div class="form-row">
                                      <div class="form-group col-6">
                                        <label for="referral">Referral</label>
                                        <select name="referral" id="referral" class="js-example-placeholder-single js-states form-control" class="@error('referral') is-invalid @enderror">
                                          <option></option>
                                          @foreach ($referrals as $referral)
                                             <option value="{{$referral->id}}">{{$referral->name}}</option>
                                          @endforeach
                                        </select>
                                        @error('referral')
                                          <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                      </div>

                                      <div class="form-group col-6">
                                        <label for="doctor">Doctor</label>
                                        <select name="doctor" id="doctor" class="js-example-placeholder-single js-states form-control" class="@error('doctor') is-invalid @enderror">
                                          <option></option>
                                          @foreach ($doctors as $doctor)
                                             <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                          @endforeach
                                        </select>
                                        @error('doctor')
                                          <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                      </div>
                                    </div>

                                    <input type="number[]" multiple='multiple' id="set_input" name="set_input" hidden>

                                    <div class="form-row">
                                      <div class="form-group col-12">
                                        <label for="test">Test</label>
                                        <select name="test" id="test" class="js-example-placeholder-single js-states form-control"   class="@error('test') is-invalid @enderror">
                                          <option></option>
                                          @foreach ($tests as $test)
                                             <option value="{{$test->id}}">{{$test->name}}</option>
                                          @endforeach
                                        </select>
                                        @error('test')
                                          <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                      </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <table class="table custom-table table-bordered">
                                                <thead class="thead-dark table-sm">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Rate</th>
                                                        <th>Discount (%)</th>
                                                        <th>Discount Amount</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="t_body">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><small>Invoice Total</small></span>
                                            </div>
                                            <input type="number" id="invoice_total" name="invoice_total"
                                                class="form-control form-control-sm" readonly>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><small>Discount Amount</small></span>
                                            </div>
                                            <input name="discount_amount" type="number" step="any" id="discount_amount"
                                                class="form-control form-control-sm" readonly>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style=""><small>Vat (%)</small></span>
                                            </div>
                                            <div></div>
                                            <input type="number" name="vat" id="vat" placeholder="%"
                                                class="form-control form-control-sm">
                                            <input type="number" name="vat_amount" id="vat_amount" placeholder="Amount"
                                                class="form-control form-control-sm" readonly>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><small>Total</small></span>
                                            </div>
                                            <input type="number" name="total" id="total"
                                                class="form-control form-control-sm" readonly>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><small>Paid Amount</small></span>
                                            </div>
                                            <input type="number" id="paid_amount" name="paid_amount"
                                                class="form-control form-control-sm" required>
                                        </div>
                                        <div class="input-group mb-3">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><small>Due</small></span>
                                          </div>
                                          <input type="number" id="due" name="due"
                                              class="form-control form-control-sm" readonly>
                                      </div>
                                        <div class="row px-3 mt-4">
                                            <div class="col-sm-5" style="padding: 0 !important;">
                                                <button type="submit" class="btn btn-sm btn-primary  save-btn"><i
                                                        class="fa fa-save"></i>
                                                    Save</button>
                                            </div>

                                            <div class="col-sm-5 ml-auto" style="padding: 0 !important;">
                                                <a href="{{route('app.pathology.patient.index')}}" class="btn btn-sm btn-success float-right"><i
                                                        class="fa fa-list"></i>
                                                    List</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $(".js-example-placeholder-single").select2({
      placeholder: "--Select One--",
      allowClear: true
  });
</script>

    <script>
      $(document).ready(function(){
        var tests = [];
        $('#test').on('change',function(){
        var id = $(this).val();
        
        tests.push(id);
        $('#set_input').val(tests);
          
          $.ajax({
            url     : '/app/pathology/patient/test/'+id,
            type    : 'GET',
            success : function(response){
              $data = `
                        <tr>
                          <td class='sl_no'>${'#'}</td>
                          <td>${response.name}</td>
                          <td>
                            <input type='text' class="form-control form-control-sm standard_rate" value='${response.standard_rate}' name='standard_rate' readonly></input>
                          </td>
                          <td>${response.refd_percent}</td>
                          <td><input type='text' class="form-control form-control-sm discountamount" value='${response.refd_amount}' name='discount_amount' readonly></input></td>
                          <td><a href="" class=" btn-danger btn-sm delete-tr"><i class="fa fa-trash"></i></a></td>
                        </tr>
                      `;
              $('#t_body').append($data);
              calculation();
            }
          });
        });
      });

      //Delete Tr
      $(document).on('click','.delete-tr',function(e){
            e.preventDefault();
            $(this).closest('tr').remove();
            calculation();
      });

      
      function calculation(){

        var invoice_total = 0;
        var discount_total = 0;

        //standard rate total calculation 
        $('.standard_rate').each(function(index,item){
          let sub_total = $(item).val();
          invoice_total += parseInt(sub_total);
        });

        $('#invoice_total').val(invoice_total);


        //discount amount calculation 
        $('.discountamount').each(function(index,item){
          let sub_discount_amount = $(item).val();
          discount_total += parseInt(sub_discount_amount);
        });

        $('#discount_amount').val(discount_total);


        //vat and total count
        var subtotal =  $('#invoice_total').val();
        var vat      = $('#vat').val();
        var discount_amount = $('#discount_amount').val();


        var total = (parseInt(subtotal)+parseInt(subtotal/100)*vat)-parseInt(discount_amount);
        $('#total').val(total);
        $('#vat_amount').val(parseInt(subtotal/100)*vat);


        var paid_amount = $('#paid_amount').val();
        $('#due').val(total-paid_amount);


        //error message for paid amount
        if(total < paid_amount){
          iziToast.show({
              title: 'Sorry',
              message: 'Can not paid more than total amount',
              position: 'topRight',
              color: 'red', // blue, red, green, yellow
          });
        }

      }

      $("#vat,#paid_amount").on('change keyup',function(){
        calculation();
      });
    </script>
@endpush

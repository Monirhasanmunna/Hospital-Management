@extends('layouts.backend.main')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
  table.dataTable tbody th, table.dataTable tbody td {
      padding: 2px 10px; /* e.g. change 8x to 4px here */
  }
</style>
@endpush

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Patients</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">List</li>
        <li class="breadcrumb-item active" aria-current="page">Patient</li>
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
                      <th>Age</th>
                      <th>Mobile</th>
                      <th>Refd</th>
                      <th>Doctor</th>
                      <th>Test</th>
                      <th>Tax(%)</th>
                      <th>Tax Amount</th>
                      <th>Discount(%)</th>
                      <th>Discount Amount</th>
                      <th>Total</th>
                      <th>Paid</th>
                      <th>Due</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($patients as $key=>$patient)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{ucwords($patient->name)}}</td>
                      <td>{{ucwords($patient->age)}}</td>
                      <td>{{ucwords($patient->mobile)}}</td>
                      <td>{{ucwords($patient->referral->name)}}</td>
                      <td>{{ucwords($patient->doctor->name)}}</td>
                      <td>
                        @foreach ($patient->tests as $test)
                          <span class="badge badge-primary">{{$test->name}}</span>
                        @endforeach
                      </td>
                      <td>{{$patient->tax}}%</td>
                      <td>{{$patient->tax_amount}}</td>
                      <td>{{$patient->discount}}%</td>
                      <td>{{$patient->discount_amount}}</td>
                      <td>{{$patient->total_amount}}</td>
                      <td>{{$patient->paid_amount}}</td>
                      <td>{{$patient->due_amount}}</td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-sm btn-primary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item"  onclick="editPatient({{$patient->id}})" data-toggle="modal" data-target=".bd-example-modal-lg" href="javascript:void(0)"><i class="fa-regular fa-pen-to-square"></i>Edit</a>
                            <a class="dropdown-item"  onclick = 'deletePatient({{$patient->id}})' href="javascript:void(0)"><i class="fa-solid fa-trash"></i>Delete</a>
                            <a onclick="window.open('{{route('app.pathology.patient.invoice',[$patient->id])}}','popup','width=600,height=600,scrollbars=no,resizable=no'); return false;" class="dropdown-item" target="popup" href="{{route('app.pathology.patient.invoice',[$patient->id])}}"><i class="fa-sharp fa-solid fa-file-lines"></i></i>Parint Invoice</a>
                            @if ($patient->due_amount == 0 && $patient->is_refferel_paid == 0 && $patient->refferel_payment->refd_amount != 0)
                            <a class="dropdown-item"  onclick ="AddDiscount({{$patient->id}})" href="javascript:void(0)"><i class="fa-solid fa-plus"></i>Add Discount</a>
                            @endif
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

<!-- Large modal -->
<div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header pt-3 pb-2 d-flex flex-row align-items-center justify-content-between bg-primary">
                <h6 class="m-0 font-weight-bold text-white">Edit Test</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="card-body py-3">
                <form action="{{route('app.pathology.patient.update',[1])}}" method="POST">
                    @csrf
                    <input hidden id="patient_id" type="number">
                    <div class="row">
                        <div class="col-md-9 float-left">
                            <div class="card-body px-0">
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="name">Patient Name</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" autofocus>
                                    </div>
                                    {{-- patient id from here --}}
                                    <input type="number" id="patient_ids" name="patient_id" hidden>
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
                                      @if(isset($referrals))
                                      @foreach ($referrals as $referral)
                                         <option value="{{$referral->id}}"
                                          @if(isset($patient))
                                          {{($patient->referral->id == $referral->id)? 'selected' : ''}}
                                          @endif
                                          >{{$referral->name}}</option>
                                      @endforeach
                                      @endif
                                    </select>
                                    @error('referral')
                                      <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                  </div>

                                  <div class="form-group col-6">
                                    <label for="doctor">Doctor</label>
                                    <select name="doctor" id="doctor" class="js-example-placeholder-single js-states form-control" class="@error('doctor') is-invalid @enderror">
                                      @foreach ($doctors as $doctor)
                                         <option value="{{$doctor->id}}"
                                          @if(isset($patient))
                                          {{($patient->doctor->id == $doctor->id)? 'selected' : ''}}
                                          @endif
                                          >{{$doctor->name}}</option>
                                      @endforeach
                                    </select>
                                    @error('doctor')
                                      <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                  </div>
                                </div>

                                <input type="number[]" multiple='multiple' id="set_inputs" name="set_input" hidden>

                                <div class="form-row">
                                  <div class="form-group col-12">
                                    <label for="test">Test</label>
                                    <select name="test" id="test" class="js-example-placeholder-single js-states form-control" class="@error('test') is-invalid @enderror">
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
                                          <span class="input-group-text"><small>Discount</small></span>
                                      </div>
                                      <div></div>
                                      <input type="number" name="discount" id="discounts" placeholder="%"
                                          class="form-control form-control-sm">
                                      <input name="discount_amount" type="number" step="any" placeholder="Amount" id="discount_amount"
                                          class="form-control form-control-sm" readonly>
                                  </div>
                                  <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style=""><small>Tax (%)</small></span>
                                    </div>
                                    <div></div>
                                    <input type="number" name="tax" id="tax" placeholder="%"
                                        class="form-control form-control-sm">
                                    <input type="number" name="tax_amount" id="tax_amount" placeholder="Amount"
                                        class="form-control form-control-sm" readonly>
                                </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><small>Total</small></span>
                                        </div>
                                        <input type="number" name="total" id="total_amount"
                                            class="form-control form-control-sm" readonly>
                                    </div>
                                    <input type="hidden" name="refd_amount" id="refd_amount">
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
                                      <input type="number" id="due_amount" name="due"
                                          class="form-control form-control-sm" readonly>
                                  </div>
                                    <div class="row px-3 mt-4">
                                        <div class="col-sm-5" style="padding: 0 !important;">
                                            <button type="submit" class="btn btn-sm btn-primary  save-btn"><i
                                                    class="fa fa-save"></i>
                                                Save</button>
                                        </div>

                                        <div class="col-sm-5 ml-auto" style="padding: 0 !important;">
                                            <a href="" class="btn btn-sm btn-success float-right"><i
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
  </div>
</div>
<!-- Large modal -->
<div class="modal fade bd-example-modal-lg" id="DiscountModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header pt-3 pb-2 d-flex flex-row align-items-center justify-content-between bg-primary">
                <h6 class="m-0 font-weight-bold text-white">Due Payment</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="card-body">
                    <div class="previous_details border rounded p-3 mb-3">
                      
                    </div>
                    <input type="hidden" id="discount_amount" class="discount_amount">
                    <form id="PaymentForm">
                        @csrf
                        <input name="patient_id" hidden type="number" id="patient_id" class="patient_id">
                        <div class="form-group">
                          <label for="categoryname">Discount</label>
                          <input placeholder="enter discount amount" type="text" class="form-control" name="discount" id="discount" class="@error('discount') is-invalid @enderror" required>
                          @error('name')
                              <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <button type="button" class="btn btn-primary" onclick="payment()">Submit Pay</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(".js-example-placeholder-single").select2({
            placeholder: "Choose One",
            allowClear: true,
            width: '100%',
        });
    </script>


  <script>
    // Test input array
    var tests = [];
    function editPatient(id){
      $.ajax({
        url       : '/app/pathology/patient/patient/'+id,
        Type      : 'GET',
        dataType  : 'json',
        success   : function(response){
          console.log(response);
          $("#patient_ids").val(response.id);
          $("#name").val(response.name);
          $("#mobile").val(response.mobile);
          $("#age").val(response.age);
          $("#invoice_total").val(response.invoice_total);
          $("#paid_amount").val(response.paid_amount);
          $("#discounts").val(response.discount);
          $("#discount_amount").val(response.discount_amount);
          $("#tax").val(response.tax);
          $("#tax_amount").val(response.tax_amount);

          $('#t_body').html('');
          $('#test').val('');
          
          $.each(response.tests,function(i,v){
            tests.push(v.id);
            $('#set_inputs').val(tests);

            var t_body = `
                <tr>
                  <td class='sl_no'>${'#'}</td>
                  <td class='name'>${v.name}</td>
                  <td class='tests_id' hidden >${v.id}</td>
                  <td>
                    <input type='text' class="form-control form-control-sm standard_rate" value='${v.standard_rate}' name='standard_rate' readonly></input>
                  </td>
                  <td><a href="" class=" btn-danger btn-sm delete-tr"><i class="fa fa-trash"></i></a></td>
                </tr>
              `;
            $('#t_body').append(t_body);
          });
          calculation();
        }
      });
    }

    //New option selected
    $(document).ready(function(){
        $('#test').on('change',function(){

         var test_id = $(this).val();
         tests.push(test_id);
         $('#set_inputs').val(tests);

          $.ajax({
            url     : '/app/pathology/patient/test/'+test_id,
            type    : 'GET',
            success : function(response){
              $data = `
                        <tr>
                          <td class='tests_id' hidden >${response.id}</td>
                          <td class='sl_no'>${'#'}</td>
                          <td>${response.name}</td>
                          <td>
                            <input type='text' class="form-control form-control-sm standard_rate" value='${response.standard_rate}' name='standard_rate' readonly></input>
                          </td>
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

        
        var item = $("#set_inputs").val();
        var tests = item.split(',').map(Number);

        //Remove selected Tests items
        var tests_id = parseInt($(this).closest('tr').find('.tests_id').html());
        tests = tests.filter(item => item !== tests_id);
        $('#set_inputs').val(tests);

        calculation();
      });

  
    //Calculation function
    function calculation(){

        var invoice_total = 0;
        var discount_total = 0;

        //standard rate total calculation 
        $('.standard_rate').each(function(index,item){
          let sub_total = $(item).val();
          invoice_total += parseInt(sub_total);
        });

        $('#invoice_total').val(invoice_total);


         //discount calculation 
         var disc = $("#discounts").val();
         var disc_amount = (invoice_total/100)*disc;
         $('#discount_amount').val(disc_amount);


        //tax calculation 
        var tax = $("#tax").val();
        var tax_amount = (invoice_total/100)*tax;
        $('#tax_amount').val(tax_amount);


        //net total calculation
        var invoice_total   = parseInt($('#invoice_total').val());
        var discount_amount = parseInt($("#discount_amount").val());
        var tax_amount      = parseInt($("#tax_amount").val());
        $("#total_amount").val((invoice_total+tax_amount)-discount_amount);


        var paid_amount   = parseInt($('#paid_amount').val());
        var total_amount  = parseInt($("#total_amount").val());
        $('#due_amount').val(total_amount-paid_amount);


    }


    $("#tax,#paid_amount,.delete-tr,#discounts").on('change keyup',function(){
        calculation();

        var paid_amount   = parseInt($('#paid_amount').val());
        var total_amount  = parseInt($("#total_amount").val());
        //error message for paid amount
       if(total_amount < paid_amount){
          iziToast.show({
              title: 'Sorry',
              message: 'Can not paid more than total amount',
              position: 'topRight',
              color: 'red', // blue, red, green, yellow
          });
        }

    });



    function deletePatient(id){

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
              url      : '/app/pathology/patient/delete/'+id,
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

    function AddDiscount(id){
      console.log(id);
      $('.patient_id').val(id);
      $('.previous_details').html('');
      if (id) {
        $.get("/app/finance/previous/refferal/details/"+id,
          function (data) {
            console.log(data);
            $('.discount_amount').val(data.refd_amount);
            $('.previous_details').append(`
                  <h3>Your Previous Details</h3>
                  <hr>
                  <span> <b>Your Total Amount : ${data.invoice_total}</b> </span><br>
                  <span><b>Your Total Discount : ${data.discount_amount}</b> </span><br>
                  <span> <b>Your Grant Total Amount : ${data.total_amount}</b> </span><br>
                  <span><b>Your Paid Amount : ${data.paid_amount}</b> </span><br>
                  <span><b>Your Maximam Discount Amount : ${data.refd_amount}</b> </span><br>
            `);
          }
        );
      }
      $('#DiscountModel').modal('show');
    }

    $('input[name="discount"]').on('click keyup', function () {
      const discount_amount = parseInt($('.discount_amount').val());
      var paid = $(this).val();
      if (discount_amount < paid) {
        alert('You can not cross your Maximam Discount Amount');
        $(this).val(0)
      }
    });

    function payment(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      var data = $('#PaymentForm').serialize();
      $.ajax({
        type: "POST",
        url: "{{ route('app.addDiscount') }}",
        data: data,
        dataType: "json",
        success: function (response) {
          $('#DiscountModel').modal('hide');
          console.log(response);
          location.reload();

        }
      });
    }
  </script>
@endpush
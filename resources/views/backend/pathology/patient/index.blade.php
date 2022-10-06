@extends('layouts.backend.main')
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                      <th>Vat</th>
                      <th>Discount</th>
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
                      <td>{{$patient->name}}</td>
                      <td>{{$patient->age}}</td>
                      <td>{{$patient->mobile}}</td>
                      <td>{{$patient->referral->name}}</td>
                      <td>{{$patient->doctor->name}}</td>
                      <td>
                        @foreach ($patient->tests as $test)
                          <span class="badge badge-primary">{{$test->name}}</span>
                        @endforeach
                      </td>
                      <td>{{$patient->vat_amount}}</td>
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
                                    <input type="number" id="patient_id" name="patient_id" hidden>
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
                                      @if(isset($referrals))
                                      @foreach ($referrals as $referral)
                                         <option value="{{$referral->id}}">{{$referral->name}}</option>
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
                                      <option></option>
                                      @if(isset($doctors))
                                      @foreach ($doctors as $doctor)
                                         <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                      @endforeach
                                      @endif
                                    </select>
                                    @error('doctor')
                                      <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                  </div>
                                </div>

                                <div class="form-row">
                                  <div class="form-group col-12">
                                    <label for="test">Test</label>
                                    <select name="test[]" id="test" class="js-example-placeholder-single js-states form-control" multiple="multiple" class="@error('test') is-invalid @enderror">
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
    function editPatient(id){
      $.ajax({
        url       : '/app/pathology/patient/patient/'+id,
        Type      : 'GET',
        dataType  : 'json',
        success   : function(response){

          console.log(response);

          $("#patient_id").val(response.id);
          $("#name").val(response.name);
          $("#mobile").val(response.mobile);
          $("#age").val(response.age);

          var referral = `<option selected hidden value='${response.referral.id}'>${response.referral.name}</option>`;
          $("#referral").append(referral);
          var doctor = `<option selected hidden value='${response.doctor.id}'>${response.doctor.name}</option>`;
          $("#doctor").append(doctor);

          $('#t_body').html('');
          $('#test').val('');
          $.each(response.tests,function(i,v){

          let test = `<option hidden selected value='${v.id}'>${v.name}</option>`;
          $("#test").append(test);

            var t_body = `
                <tr>
                  <td class='sl_no'>${'#'}</td>
                  <td class='name'>${v.name}</td>
                  <td class='tests_id' hidden >${v.id}</td>
                  <td>
                    <input type='text' class="form-control form-control-sm standard_rate" value='${v.standard_rate}' name='standard_rate' readonly></input>
                  </td>
                  <td>${v.refd_percent}</td>
                  <td><input type='text' class="form-control form-control-sm discountamount" value='${v.refd_amount}' name='discount_amount' readonly></input></td>
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


          //Delete selected option 
           var tests_id = parseInt($(this).closest('tr').find('.tests_id').html());
           var selected_items  = $("#test").val();

          $.each(selected_items,function(index,value){
            if(tests_id == value){
              let id = tests_id;
              $("#test").find("option:selected[value="+id+"]").remove();
            }
          });
           
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
  }

  $("#vat,#paid_amount").on('change keyup',function(){
      calculation();
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
  </script>
@endpush
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
      <h1 class="h3 mb-0 text-gray-800">Doctor Payment</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Doctor Payment</li>
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
                      <th>Doctor</th> 
                      <th>Test</th>
                      <th>Total Refd Amount</th>
                      <th>Discount</th>
                      <th>Payable Refd Amount</th>
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
                      <td>{{ucwords($patient->doctor->name)}}</td>
                      <td>
                        @foreach ($patient->tests as $test)
                          <span class="badge badge-primary">{{$test->name}}</span>
                        @endforeach
                      </td>
                      <td>{{$patient->refferel_payment->refd_amount + $patient->discount_amount}}</td>
                      <td>{{$patient->discount_amount}}</td>
                      <td>{{$patient->refferel_payment->refd_amount}}</td>
                      <td>{{$patient->refferel_payment->refd_paid_amount ?? 0}}</td>
                      <td>{{$patient->refferel_payment->refd_amount - $patient->refferel_payment->refd_paid_amount}}</td>
                      <td><a href="javascript:void(0)" class="btn btn-primary" onclick="ReferelPayment({{ $patient->id }})">Pay</a></td>
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
<div class="modal fade bd-example-modal-lg" id="DoctorPaymentModel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
              <div class="card-header pt-3 pb-2 d-flex flex-row align-items-center justify-content-between bg-primary">
                <h6 class="m-0 font-weight-bold text-white">Doctor Payment</h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                <div class="card-body">
                    <div class="previous_details border rounded p-3 mb-3">
                      
                    </div>
                    <input type="hidden" id="previousDue">
                    <form id="PaymentForm">
                        @csrf
                        <input name="patient_id" hidden type="number" id="patient_id">
                        <div class="form-group">
                          <label for="categoryname">Paid Amount</label>
                          <input placeholder="enter your amount" type="text" class="form-control" name="amount" id="amount" class="@error('amount') is-invalid @enderror" required>
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
    <script>
        function ReferelPayment(id){
            $('#patient_id').val(id);
            $('.previous_details').html('');
            if (id) {
              $.get("/app/finance/previous/refferal/details/"+id,
                function (data) {
                  console.log(data);
                  $('#previousDue').val(data.refd_amount - data.refd_paid_amount);
                  $('.previous_details').append(`
                        <h3>Your Previous Details</h3>
                        <hr>
                        <h5>Patient Name :<b> ${data.name}</b></h5>
                        <span> <b>Patinent Refferal Amount : ${data.discount_amount + data.refd_amount}</b> </span><br>
                        <span><b>Patient Discount : ${data.discount_amount}</b> </span><br>
                        <span> <b>Refferal Paid Amount : ${data.refd_paid_amount}</b> </span><br>
                        <span><b>Refferal Payable Amount : ${data.refd_amount - data.refd_paid_amount}</b> </span><br>
                  `);
                }
              );
            }
            $('#DoctorPaymentModel').modal('show');
        }
        $('input[name="amount"]').on('click keyup', function () {
          const previousDue = parseInt($('#previousDue').val());
          var paid = $(this).val();
          if (previousDue < paid) {
            iziToast.show({
              title: 'Sorry',
              message: 'Can not paid more than Refferal amount',
              position: 'topRight',
              color: 'red', // blue, red, green, yellow
            });
            $(this).val(0)
          }
        });

        function payment(){
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          // var properties = "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=500,width=700,height=300";
          var data = $('#PaymentForm').serialize();
          $.ajax({
            type: "POST",
            url: "{{ route('app.doctor_payment') }}",
            data: data,
            dataType: "json",
            success: function (response) {
              $('#DoctorPaymentModel').modal('hide');
              console.log(response);
              // window.open("/app/finance/doctor/payment/invoice/"+response.id+"/"+response.paid,"popup",properties);
              location.reload();

            }
          });
        }
    </script>
@endpush
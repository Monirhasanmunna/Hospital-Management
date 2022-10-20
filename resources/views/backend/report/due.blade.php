@extends('layouts.backend.main')
@push('css')
    
@endpush

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Due Report</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('app.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item">Today's Due</li>
      </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header m-auto">
                    <form class="form-inline">
                        {{-- @csrf --}}
                        <label class="sr-only" for="from_date">Username</label>
                        <div class="input-group mr-sm-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text">From Date</div>
                            </div>
                            <input type="date" name="from_date" value="{{ date("Y-m-d") }}" class="form-control" id="from_date" placeholder="Username" required>
                        </div>

                        <label class="sr-only" for="to_date">Username</label>
                        <div class="input-group mr-sm-2">
                            <div class="input-group-prepend">
                            <div class="input-group-text">To Date</div>
                            </div>
                            <input type="date" name="to_date" value="{{ date("Y-m-d") }}" class="form-control" id="to_date" placeholder="Username" required>
                        </div>
                        
                        <button type="button" class="btn btn-primary ml-2" onclick="showReport()">Search</button>
                        <a href="javascript:void(0)" class="btn btn-primary ml-2" onclick="PrintReport()">Report</a>
                        <a href="{{ route('app.report.due') }}" class="btn btn-primary ml-5">Today</a> 
                    </form>
                </div>
            </div>
            <div class="card mb-4">
                
              <div class="day_show m-auto pt-3">
                @if ($date)
                <p>Report Form {{$date['from_date']}} To {{$date['to_date']}}</p>
                @endif
              </div>
              <div class="table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <thead class="thead-dark">
                    <tr>
                      <th>SL</th>
                      <th>Name</th>
                      <th>Test</th>
                      <th>Due Amount</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($patient as $key => $patient)
                    @php
                        $total += $patient->due_amount;
                    @endphp
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$patient->name}}</td>
                      <td>
                        @foreach ($patient->tests as $test)
                          <span class="badge badge-primary">{{$test->name}}</span>
                        @endforeach
                      </td>
                      <td>{{$patient->due_amount}}/-</td>
                      <td>{{$patient->updated_at->format('d-M-Y')}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                        <th colspan="3">Total</th>
                        <th colspan="2">{{ $total }}/-</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection
@push('js')
    <script>
        function PrintReport(){
            var properties = "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=500,width=700,height=300";
            const from_date = $('#from_date').val();
            const to_date = $('#to_date').val();
            if (from_date && to_date) {
              window.open("/app/report/due_report_print/"+from_date+"/"+to_date,"popup",properties);
            }else{
                alert('Plz selecet the date');
            }
        }

        function showReport(){
          const from_date = $('#from_date').val();
          const to_date = $('#to_date').val();
          if (from_date && to_date) {
              window.open("/app/report/due/"+from_date+"/"+to_date,"_self");
            }else{
                alert('Plz selecet the date');
            }
        }
    </script>
@endpush

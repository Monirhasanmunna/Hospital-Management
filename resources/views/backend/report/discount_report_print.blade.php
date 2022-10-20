
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Laralink">
  <!-- Site Title -->
  <title>Medical Invoice</title>
  <link rel="stylesheet" href="{{asset('backend/invoice/css/style.css')}}">
  
  <style>
    .page-break {
     page-break-after: always;
   }
   </style>
</head>
<body>
  <div class="tm_container">
    <div class="tm_invoice_wrap">
      <div class="tm_invoice_btns tm_hide_print">
        <a href="#" onclick="javascript:window.print()" class="tm_invoice_btn tm_color1">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg>
          </span>
          <span class="tm_btn_text">Print</span>
        </a>
      </div>
      <div class="tm_invoice tm_style2" id="tm_download_section">
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_mb30 tm_invoice_info_in tm_gray_bg">
            <div class="tm_invoice_left">
              <div class="tm_logo"><img src="{{asset('backend/invoice/img/logo.jpg')}}" alt="Logo"></div>
            </div>
            <div class="tm_invoice_right">
              <div class="tm_grid_row tm_col_2 ">
                <div style="text-align: center;"> 
                    <h4 style="margin-bottom: 4px;"><strong>Sheba Diagonostic</strong></h4>
                    <p style="margin: 0px;">Chadur Mor,Dinajpur</p>
                    <p>Mobile: 01764197461</p>
                </div>
              </div>
            </div>
          </div>
          <div class="tm_invoice_head tm_mb30 tm_invoice_info_in tm_gray_bg">
            <div style="text-align: center;width:100%">
              <h4>Discount Report</h4>
              <p><b> Date:</b> {{ $from_date }} to {{ $to_date }}</p>
            </div>
          </div>
          <div class="tm_table tm_style1 tm_mb40">
            <div class="tm_round_border">
              <div class="tm_table_responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="tm_semi_bold tm_primary_color">Patient's Name</th>
                      <th class="tm_semi_bold tm_primary_color">Test Name</th>
                      <th class="tm_semi_bold tm_primary_color">Test Code</th>
                      <th class="tm_width_2 tm_semi_bold tm_primary_color tm_text_right">Discount Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $total = 0;
                    @endphp
                    @foreach ($patient as $patient)
                    <tr>
                      <td class="">{{$patient->name}}</td>
                      <td class="">{{$patient->doctor->name}}</td>
                      <td class="tm_text_right">
                        @foreach ($patient->tests as $test)
                        <span class="badge badge-primary">{{$test->name}}</span>
                        @endforeach  
                      </td>
                      <td class="">{{$patient->discount_amount}}</td>
                    </tr>
                    @php
                      $total += $patient->discount_amount;
                    @endphp
                    @endforeach
                  </tbody>
                  <tfoot style="border-top:1px solid #ddd">
                    <tr>
                      <th class="" colspan="3">Total</th>
                      <th class="">{{ $total }}/-</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
  <script src="{{asset('backend/invoice/js/jquery.min.js')}}"></script>
  <script src="{{asset('backend/invoice/js/jspdf.min.js')}}"></script>
  <script src="{{asset('backend/invoice/js/html2canvas.min.js')}}"></script>
  <script src="{{asset('backend/invoice/js/main.js')}}"></script>
</body>
</html>
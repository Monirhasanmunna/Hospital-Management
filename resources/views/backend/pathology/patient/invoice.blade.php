
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

                <div style="text-align: end;">
                  <b class="tm_primary_color">Doctor:</b> <br>
                  {{$patient->doctor->name}}  <br>
                  {{$patient->doctor->title}} <br>
            +880 {{$patient->doctor->mobile}}
                </div>
              </div>
            </div>
          </div>
          <div class="tm_grid_row tm_col_3 tm_col_2_md tm_invoice_info_in tm_gray_bg tm_mb30 tm_round_border">
            <div>
              <span>Patient Name:</span> <br>
              <span class="tm_primary_color">{{$patient->name}}</span>
            </div>
            <div>
              <span>Patient Number:</span> <br>
              <span class="tm_primary_color">{{$patient->mobile}}</span>
            </div>
            <div>
              <span>Date of Birth:</span> <br>
              <span class="tm_primary_color">{{$patient->age}} Years</span>
            </div>
            <div>
                <span>Date:</span> <br>
                <span class="tm_primary_color">{{$patient->updated_at->format("d.M.Y")}}</span>
              </div>
            <div>
              <span>Address:</span> <br>
              <span class="tm_primary_color">{{$patient->address}}</span>
            </div>
          </div>

          <div class="tm_table tm_style1 tm_mb40">
            <div class="tm_round_border">
              <div class="tm_table_responsive">
                <table>
                  <thead>
                    <tr>
                      <th class="tm_width_4 tm_semi_bold tm_primary_color">Test Name</th>
                      <th class="tm_width_4 tm_semi_bold tm_primary_color">Test Code</th>
                      <th class="tm_width_2 tm_semi_bold tm_primary_color tm_text_right">Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($patient->tests as $test)
                    <tr>
                      <td class="tm_width_4">{{$test->name}}</td>
                      <td class="tm_width_5">{{$test->code}}</td>
                      <td class="tm_width_3 tm_text_right">{{$test->standard_rate}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tm_invoice_footer">
              <div class="tm_left_footer">
                <p class="tm_m0">Due to special reasons, the delivery date of the examination and report may be longer.</p>
              </div>
              <div class="tm_right_footer">
                <table>
                  <tbody>
                    <tr>
                      <td class="tm_width_3 tm_primary_color tm_border_none">Subtoal</td>
                      <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none">${{$patient->invoice_total}}</td>
                    </tr>
                    <tr>
                      <td class="tm_width_3 tm_danger_color tm_border_none tm_pt0">Discount {{$patient->discount}}%</td>
                      <td class="tm_width_3 tm_danger_color tm_text_right tm_border_none tm_pt0">-${{$patient->discount_amount}}</td>
                    </tr>
                    <tr>
                      <td class="tm_width_3 tm_primary_color tm_border_none tm_pt0">Tax {{$patient->tax}}%</td>
                      <td class="tm_width_3 tm_primary_color tm_text_right tm_border_none tm_pt0">+${{$patient->tax_amount}}</td>
                    </tr>
                    <tr>
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_primary_bg tm_radius_6_0_0_6">Grand Total</td>
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_primary_color tm_text_right tm_white_color tm_primary_bg tm_radius_0_6_6_0">${{$patient->total_amount}}</td>
                    </tr>
                    <tr>
                        <td class="tm_width_3  tm_bold tm_f15 tm_primary_color">Paid Amount :</td>
                        <td class="tm_width_3  tm_bold tm_f16 tm_primary_color tm_text_right ">${{$patient->paid_amount}}</td>
                    </tr>
                    <tr>
                        <td class="tm_width_3  tm_bold tm_f15 tm_primary_color">Due Amount :</td>
                        <td class="tm_width_3  tm_bold tm_f16 tm_primary_color tm_text_right ">${{$patient->due_amount}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="tm_padd_15_20 tm_round_border">
            <p class="tm_primary_color tm_mb2 tm_bold">Additional info</p>
            <div>
              Here you can write additional notes for the client to get a better understanding of this invoice.<br>
              Invoice was created on a computer and is valid without the signature and seal. <br>
              Please take all services within 15 days, otherwise, it will be invalid.
            </div>
          </div>
        </div>
      </div>
      <div class="tm_invoice_btns tm_hide_print">
        <a href="{{route('app.pathology.patient.index')}}" onclick="javascript:window.print()" class="tm_invoice_btn tm_color1">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg>
          </span>
          <span class="tm_btn_text">Print</span>
        </a>
      </div>
    </div>
  </div>
  <script src="{{asset('backend/invoice/js/jquery.min.js')}}"></script>
  <script src="{{asset('backend/invoice/js/jspdf.min.js')}}"></script>
  <script src="{{asset('backend/invoice/js/html2canvas.min.js')}}"></script>
  <script src="{{asset('backend/invoice/js/main.js')}}"></script>
</body>
</html>
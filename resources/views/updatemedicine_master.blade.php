@extends('layout')
@section('content')


    <!--start page wrapper -->

    <style>
        table,
        th,
        td {
            border: 1px solid black;

        }

        .text {
            font-size: 10px;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-md-12 mx-auto" style="margin-top: -10%;">
                    <div class="card">
                        <form class="row g-2" method="POST" action="{{ route('update-medicinem') }}">

                            {{ csrf_field() }}
                            {{-- <input type="hidden" name="id" value="{{ $companyedit->id }}"> --}}
                            <input type="hidden" name="id" value="{{ $medicine_edit->id }}">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-center">

                                    <h5 class="mb-0 text-primary">Update Medicine Master</h5>
                                </div>
                                <hr>
                                <div class="row g-2">

                                    <div class="col-md-3">
                                        <label for="inputFirstName" class="form-label">Select Company*</label>

                                        <select class="multiple-select" data-placeholder="Choose anything" name="company"
                                            id="company">
                                            <option value="">Select</option>
                                            @foreach ($company as $company)
                                                <option value="{{ $company->id }}"
                                                    @if ($medicine_edit->select_company_id == $company->id) selected @endif>
                                                    {{ $company->Name }} </option>
                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="col-md-3">
                                        <label for="inputFirstName" class="form-label">Select Medicine*</label>

                                        <select class="multiple-select" data-placeholder="Choose anything" name="medicine"
                                            id="medicine">
                                            <option value="">Select</option>
                                            @foreach ($medicine as $medicine)
                                                <option value="{{ $medicine->medicine_id }}"
                                                    @if ($medicine_edit->medicine_id == $medicine->id) selected @endif>
                                                    {{ $medicine->medicine }} </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="inputFirstName" class="form-label">Batch No*</label>

                                        <select class="multiple-select" data-placeholder="Choose anything" name="batch_no">
                                            <option value="1" selected>1</option>
                                            <option value="2" selected>2</option>
                                            <option value="3" selected>3</option>


                                        </select>

                                    </div>



                                    <div class="col-md-2">
                                        <label for="inputFirstName" class="form-label">MRP*</label>
                                        <input type="text" name="mrp" id="mrp" 
                                            placeholder="Enter MRP" class="form-control" required value="{{$medicine_edit->mrp}}"/>
                                    </div>

                                    <div class="col-md-1">
                                        <label for="inputFirstName" class="form-label">GST (%)*</label>
                                        <input type="text" name="given_gst" id="given_gst" value="{{$medicine_edit->given_gst}}"
                                            placeholder="Enter GST" class="form-control" required />
                                    </div>

                                    <div class="col-md-1">
                                        <label for="inputFirstName" class="form-label">Purchase*</label>
                                        <input type="text" name="purchase" id="purchase" 
                                            placeholder="Enter Purchase" class="form-control" required value="{{$medicine_edit->purchase}}"/>
                                    </div>
                                </div>
                            </div>



                            <div style="overflow-x: scroll;">
                                <table style="width:100%; margin-top:3%;">
                                    <tr align="center">
                                        <th class="text">SCH %</th>
                                        <th class="text">GST(₹)</th>
                                        <th class="text"> GST<br>(inc)</th>
                                        <th class="text">R M</th>
                                        <th class="text">PTR</th>
                                        <th class="text">S M</th>
                                        <th class="text">PTS</th>
                                        <th class="text">MNGT</th>
                                        <th class="text">P C</th>
                                        <th class="text">SCH</th>
                                        <th class="text">S A D</th>
                                        <th class="text">T E B</th>
                                        <th class="text">TOT</th>
                                        <th class="text">M W C</th>
                                        <th class="text">C P</th>
                                        <th class="text">% P T I</th>
                                        <th class="text">M+P+C</th>
                                        <th class="text">% P T PTR</th>
                                    </tr>
                                    <tr>
<input type="hidden" name="zero_scheme" value="{{$medicine_list[0]->id}}">
<input type="hidden" name="ten_scheme" value="{{$medicine_list[1]->id}}">
<input type="hidden" name="twenty_scheme" value="{{$medicine_list[2]->id}}">
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF;color:#030303; " type="text"
                                                class="form-control" name="default_scheme" id="default_scheme"
                                                value="0" readonly />
                                        </td>
                                        <td style="padding:5px;">

                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="gst" id="gst" value="{{ $medicine_list[0]->gst }}" />
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="amount_after_gst" id="amount_after_gst" value="{{ $medicine_list[0]->amount_after_gst}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="retail_margin" id="retail_margin" value="{{ $medicine_list[0]->retail_margin}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="ptr" id="ptr" value="{{ $medicine_list[0]->ptr}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="stockist_margin" id="stockist_margin" value="{{ $medicine_list[0]->stockist_margin}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="pts" id="pts"value="{{ $medicine_list[0]->pts}}" />
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="management" id="management"value="{{ $medicine_list[0]->management}}" />
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="promotion_cost" id="promotion_cost" value="{{ $medicine_list[0]->promotion_cost}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="scheme" id="scheme" value="{{ $medicine_list[0]->scheme}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="scheme_amount_deduct" id="scheme_amount_deduct" value="{{ $medicine_list[0]->scheme_amount_deduct}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="transport_expiry_breakage" id="transport_expiry_breakage" value="{{ $medicine_list[0]->transport_expiry_breakage}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="tot" id="tot" value="{{ $medicine_list[0]->tot}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="marketing_working_cost" id="marketing_working_cost" value="{{ $medicine_list[0]->marketing_working_cost}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="company_profit" id="company_profit" value="{{ $medicine_list[0]->company_profit}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="percent_profit_to_investment" id="percent_profit_to_investment" value="{{ $medicine_list[0]->percent_profit_to_investment}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="marketing_promotion_scheme"
                                                id="marketing_promotion_scheme" value="{{ $medicine_list[0]->marketing_promotion_scheme}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                             name="percent_profit_to_ptr" id="percent_profit_to_ptr"value="{{ $medicine_list[0]->percent_profit_to_ptr}}" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF;color:#030303; " type="text"
                                                class="form-control" name="default_scheme_ten" id="default_scheme_ten"
                                                value="10" readonly />
                                        </td>
                                        <td style="padding:5px;">

                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="gst_ten" id="gst_ten" value="{{ $medicine_list[1]->gst}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="amount_after_gst_ten" id="amount_after_gst_ten" value="{{ $medicine_list[1]->amount_after_gst}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="retail_margin_ten" id="retail_margin_ten" value="{{ $medicine_list[1]->retail_margin}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="ptr_ten" id="ptr_ten" value="{{ $medicine_list[1]->ptr}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="stockist_margin_ten" id="stockist_margin_ten" value="{{ $medicine_list[1]->stockist_margin}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="pts_ten" id="pts_ten" value="{{ $medicine_list[1]->pts}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="management_ten" id="management_ten" value="{{ $medicine_list[1]->management}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="promotion_cost_ten" id="promotion_cost_ten" value="{{ $medicine_list[1]->promotion_cost}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="scheme_ten" id="scheme_ten" value="{{ $medicine_list[1]->scheme}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="scheme_amount_deduct_ten" id="scheme_amount_deduct_ten" value="{{ $medicine_list[1]->scheme_amount_deduct}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="transport_expiry_breakage_ten" id="transport_expiry_breakage_ten" value="{{ $medicine_list[1]->transport_expiry_breakage}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="tot_ten" id="tot_ten" value="{{ $medicine_list[1]->tot}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="marketing_working_cost_ten" id="marketing_working_cost_ten" value="{{ $medicine_list[1]->marketing_working_cost}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="company_profit_ten" id="company_profit_ten" value="{{ $medicine_list[1]->company_profit}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="percent_profit_to_investment_ten"
                                                id="percent_profit_to_investment_ten" value="{{ $medicine_list[1]->percent_profit_to_investment}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                 name="marketing_promotion_scheme_ten"
                                                id="marketing_promotion_scheme_ten" value="{{ $medicine_list[1]->marketing_promotion_scheme}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                 name="percent_profit_to_ptr_ten"
                                                id="percent_profit_to_ptr_ten" value="{{ $medicine_list[1]->percent_profit_to_ptr}}"/>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF;color:#030303; " type="text"
                                                class="form-control" name="default_scheme_twenty"
                                                id="default_scheme_twenty" value="20" readonly />
                                        </td>
                                        <td style="padding:5px;">

                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="gst_twenty" id="gst_twenty" value="{{ $medicine_list[2]->gst}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="amount_after_gst_twenty" id="amount_after_gst_twenty" value="{{ $medicine_list[2]->amount_after_gst}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="retail_margin_twenty" id="retail_margin_twenty" value="{{ $medicine_list[2]->retail_margin}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="ptr_twenty" id="ptr_twenty" value="{{ $medicine_list[2]->ptr}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="stockist_margin_twenty" id="stockist_margin_twenty" value="{{ $medicine_list[2]->stockist_margin}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="pts_twenty" id="pts_twenty" value="{{ $medicine_list[2]->pts}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="management_twenty" id="management_twenty" value="{{ $medicine_list[2]->management}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="promotion_cost_twenty" id="promotion_cost_twenty" value="{{ $medicine_list[2]->promotion_cost}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="scheme_twenty" id="scheme_twenty" value="{{ $medicine_list[2]->scheme}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="scheme_amount_deduct_twenty" id="scheme_amount_deduct_twenty" value="{{ $medicine_list[2]->scheme_amount_deduct}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="transport_expiry_breakage_twenty"
                                                id="transport_expiry_breakage_twenty" value="{{ $medicine_list[2]->transport_expiry_breakage}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="tot_twenty" id="tot_twenty" value="{{ $medicine_list[2]->tot}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="marketing_working_cost_twenty" id="marketing_working_cost_twenty" value="{{ $medicine_list[2]->marketing_working_cost}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="company_profit_twenty" id="company_profit_twenty" value="{{ $medicine_list[2]->company_profit}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                name="percent_profit_to_investment_twenty"
                                                id="percent_profit_to_investment_twenty" value="{{ $medicine_list[2]->percent_profit_to_investment}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                 name="marketing_promotion_scheme_twenty"
                                                id="marketing_promotion_scheme_twenty" value="{{ $medicine_list[2]->marketing_promotion_scheme}}"/>
                                        </td>
                                        <td style="padding:5px;">
                                            <input style="background-color:#FFFFFF" type="text" class="form-control"
                                                 name="percent_profit_to_ptr_twenty"
                                                id="percent_profit_to_ptr_twenty" value="{{ $medicine_list[2]->percent_profit_to_ptr}}"/>
                                        </td>
                                    </tr>
                                </table>

                            </div>






                            <div class="col-md-12">
                                <div class="col-md-2" style="padding:8px; text-align: center; margin-left: 45%;">
                                    <a href=""><button type="submit" class="btn btn-primary px-3"
                                            id="Add"><i class="fadeIn animated bx bx-plus"></i> Update </button></a>
                                </div>
                            </div>
                        </form>



                    </div>
                </div>
            </div>


            <div>
                <img src="assets/images/legend_shubhastu.png">
            </div>
            <!--end page wrapper -->
            <!--start overlay-->


        </div>
    </div>
    <!--end page wrapper -->
@stop
@section('js')
<script> 
     $(document).ready(function(){
        $('#mrp,#given_gst,#purchase,#default_scheme').keyup(function() {

            var default_scheme=parseInt($('#default_scheme').val());
            // alert(default_scheme);

            if(default_scheme==0){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            //Scheme 0% Calculation
            var gst=(parseFloat(mrp/100)*parseFloat(given_gst)).toFixed(2);
             $('#gst').val(gst);
            var amount_after_gst=(parseFloat(mrp)-parseFloat(gst)).toFixed(2)
            $('#amount_after_gst').val(amount_after_gst);
            var retail_margin=parseFloat(amount_after_gst/100)*parseFloat(20);
            var rm=retail_margin.toFixed(2);
            $('#retail_margin').val(rm);
            var ptr=(parseFloat(amount_after_gst)-parseFloat(rm)).toFixed(2);
            $('#ptr').val(ptr);
            var stockist_margin=parseFloat(ptr/100)*parseFloat(10);
            var sm=stockist_margin.toFixed(2);
            $('#stockist_margin').val(sm);
            var pts=(parseFloat(ptr)-parseFloat(sm)).toFixed(2);
            $('#pts').val(pts);
            var management=(parseFloat(pts/100)*parseFloat(10)).toFixed(2);
            $('#management').val(management);
            var promotion_cost=(parseFloat(ptr/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost);
            var scheme=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme);
            $('#scheme_amount_deduct').val(0);
            var transport_expiry_breakage=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage);
            var tot=(parseFloat(pts)-parseFloat(management)-parseFloat(promotion_cost)-parseFloat(purchase)-parseFloat(scheme)-parseFloat(transport_expiry_breakage)).toFixed(2);
            $('#tot').val(tot);
            var marketing_working_cost=(parseFloat(tot/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost);
            var company_profit=(parseFloat(tot)-parseFloat(marketing_working_cost)).toFixed(2);
            $('#company_profit').val(company_profit);
            var percent_profit_to_investment=((parseFloat(company_profit)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme)+parseFloat(transport_expiry_breakage))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment);
            var marketing_promotion_scheme=(parseFloat(promotion_cost)+parseFloat(marketing_working_cost)+parseFloat(scheme)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme);
            var percent_profit_to_ptr=((parseFloat(marketing_promotion_scheme)*parseFloat(100))/parseFloat(ptr)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr);
            }
            if(default_scheme==10){
            //Scheme 10% Calculation
            //alert(10);
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var gst_ten=(parseFloat(mrp/100)*parseFloat(given_gst)).toFixed(2);
             $('#gst').val(gst_ten);
            var amount_after_gst_ten=(parseFloat(mrp)-parseFloat(gst_ten)).toFixed(2)
            $('#amount_after_gst').val(amount_after_gst_ten);
            var retail_margin_ten=parseFloat(amount_after_gst_ten/100)*parseFloat(20);
            var rm_ten=retail_margin_ten.toFixed(2);
            $('#retail_margin').val(rm_ten);
            var ptr_ten=(parseFloat(amount_after_gst_ten)-parseFloat(rm_ten)).toFixed(2);
            $('#ptr').val(ptr_ten);
            var stockist_margin_ten=parseFloat(ptr_ten/100)*parseFloat(10);
            var sm_ten=stockist_margin_ten.toFixed(2);
            $('#stockist_margin').val(sm_ten);
            var pts_ten=(parseFloat(ptr_ten)-parseFloat(sm_ten)).toFixed(2);
            $('#pts').val(pts_ten);
            var management_ten=(parseFloat(pts_ten/100)*parseFloat(10)).toFixed(2);
            $('#management').val(management_ten);
            var promotion_cost_ten=(parseFloat(ptr_ten/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost_ten);
            var scheme_ten=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme_ten);
            var scheme_amount_deduct_ten=(parseFloat(scheme_ten/2)).toFixed(2);
            $('#scheme_amount_deduct').val(scheme_amount_deduct_ten);
            var transport_expiry_breakage_ten=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage_ten);
            var tot_ten=(parseFloat(pts_ten)-parseFloat(management_ten)-parseFloat(promotion_cost_ten)-parseFloat(purchase)-parseFloat(scheme_ten)-parseFloat(transport_expiry_breakage_ten)).toFixed(2);
            $('#tot').val(tot_ten);
            var marketing_working_cost_ten=(parseFloat(tot_ten/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost_ten);
            var company_profit_ten=(parseFloat(tot_ten)-parseFloat(marketing_working_cost_ten)).toFixed(2);
            $('#company_profit').val(company_profit_ten);
            var percent_profit_to_investment_ten=((parseFloat(company_profit_ten)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_ten)+parseFloat(transport_expiry_breakage_ten))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_ten);
            var marketing_promotion_scheme_ten=(parseFloat(promotion_cost_ten)+parseFloat(marketing_working_cost_ten)+parseFloat(scheme_amount_deduct_ten)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_ten);
            var percent_profit_to_ptr_ten=((parseFloat(marketing_promotion_scheme_ten)*parseFloat(100))/parseFloat(ptr_ten)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_ten);
            }

            if(default_scheme==20){
            //Scheme 20% Calculation
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var gst_twenty=(parseFloat(mrp/100)*parseFloat(given_gst)).toFixed(2);
             $('#gst').val(gst_twenty);
            var amount_after_gst_twenty=(parseFloat(mrp)-parseFloat(gst_twenty)).toFixed(2)
            $('#amount_after_gst').val(amount_after_gst_twenty);
            var retail_margin_twenty=parseFloat(amount_after_gst_twenty/100)*parseFloat(20);
            var rm_twenty=retail_margin_twenty.toFixed(2);
            $('#retail_margin').val(rm_twenty);
            var ptr_twenty=(parseFloat(amount_after_gst_twenty)-parseFloat(rm_twenty)).toFixed(2);
            $('#ptr').val(ptr_twenty);
            var stockist_margin_twenty=parseFloat(ptr_twenty/100)*parseFloat(10);
            var sm_twenty=stockist_margin_twenty.toFixed(2);
            $('#stockist_margin').val(sm_twenty);
            var pts_twenty=(parseFloat(ptr_twenty)-parseFloat(sm_twenty)).toFixed(2);
            $('#pts').val(pts_twenty);
            var management_twenty=(parseFloat(pts_twenty/100)*parseFloat(10)).toFixed(2);
            $('#management').val(management_twenty);
            var promotion_cost_twenty=(parseFloat(ptr_twenty/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost_twenty);
            var scheme_twenty=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme_twenty);
            $('#scheme_amount_deduct').val(0);
            var transport_expiry_breakage_twenty=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage_twenty);
            var tot_twenty=(parseFloat(pts_twenty)-parseFloat(management_twenty)-parseFloat(promotion_cost_twenty)-parseFloat(purchase)-parseFloat(scheme_twenty)-parseFloat(transport_expiry_breakage_twenty)).toFixed(2);
            $('#tot').val(tot_twenty);
            var marketing_working_cost_twenty=(parseFloat(tot_twenty/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost_twenty);
            var company_profit_twenty=(parseFloat(tot_twenty)-parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#company_profit').val(company_profit_twenty);
            var percent_profit_to_investment_twenty=((parseFloat(company_profit_twenty)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_twenty)+parseFloat(transport_expiry_breakage_twenty))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_twenty);
            var marketing_promotion_scheme_twenty=(parseFloat(promotion_cost_twenty)+parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_twenty);
            var percent_profit_to_ptr_twenty=((parseFloat(marketing_promotion_scheme_twenty)*parseFloat(100))/parseFloat(ptr_twenty)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_twenty);
            }

        });

        $('#ptr').keyup(function() {
            var default_scheme=parseInt($('#default_scheme').val());
            // alert(default_scheme);

            if(default_scheme==0){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr=parseFloat($('#ptr').val());
           
            var stockist_margin=parseFloat(ptr/100)*parseFloat(10);
            var sm=stockist_margin.toFixed(2);
            $('#stockist_margin').val(sm);
           
            var pts=(parseFloat(ptr)-parseFloat(sm)).toFixed(2);
            $('#pts').val(pts);
            var management=(parseFloat(pts/100)*parseFloat(10)).toFixed(2);
            $('#management').val(management);
            var promotion_cost=(parseFloat(ptr/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost);
            var scheme=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme);
            $('#scheme_amount_deduct').val(0);
            var transport_expiry_breakage=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage);
            var tot=(parseFloat(pts)-parseFloat(management)-parseFloat(promotion_cost)-parseFloat(purchase)-parseFloat(scheme)-parseFloat(transport_expiry_breakage)).toFixed(2);
            $('#tot').val(tot);
            var marketing_working_cost=(parseFloat(tot/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost);
            var company_profit=(parseFloat(tot)-parseFloat(marketing_working_cost)).toFixed(2);
            $('#company_profit').val(company_profit);
            var percent_profit_to_investment=((parseFloat(company_profit)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme)+parseFloat(transport_expiry_breakage))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment);
            var marketing_promotion_scheme=(parseFloat(promotion_cost)+parseFloat(marketing_working_cost)+parseFloat(scheme)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme);
            var percent_profit_to_ptr=((parseFloat(marketing_promotion_scheme)*parseFloat(100))/parseFloat(ptr)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr);
        }
        if(default_scheme==0){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr=parseFloat($('#ptr').val());
           
            var stockist_margin=parseFloat(ptr/100)*parseFloat(10);
            var sm=stockist_margin.toFixed(2);
            $('#stockist_margin').val(sm);
           
            var pts=(parseFloat(ptr)-parseFloat(sm)).toFixed(2);
            $('#pts').val(pts);
            var management=(parseFloat(pts/100)*parseFloat(10)).toFixed(2);
            $('#management').val(management);
            var promotion_cost=(parseFloat(ptr/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost);
            var scheme=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme);
            $('#scheme_amount_deduct').val(0);
            var transport_expiry_breakage=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage);
            var tot=(parseFloat(pts)-parseFloat(management)-parseFloat(promotion_cost)-parseFloat(purchase)-parseFloat(scheme)-parseFloat(transport_expiry_breakage)).toFixed(2);
            $('#tot').val(tot);
            var marketing_working_cost=(parseFloat(tot/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost);
            var company_profit=(parseFloat(tot)-parseFloat(marketing_working_cost)).toFixed(2);
            $('#company_profit').val(company_profit);
            var percent_profit_to_investment=((parseFloat(company_profit)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme)+parseFloat(transport_expiry_breakage))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment);
            var marketing_promotion_scheme=(parseFloat(promotion_cost)+parseFloat(marketing_working_cost)+parseFloat(scheme)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme);
            var percent_profit_to_ptr=((parseFloat(marketing_promotion_scheme)*parseFloat(100))/parseFloat(ptr)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr);
        }
        if(default_scheme==10){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr=parseFloat($('#ptr').val());
           
            var stockist_margin=parseFloat(ptr/100)*parseFloat(10);
            var sm=stockist_margin.toFixed(2);
            $('#stockist_margin').val(sm);
           
            var pts=(parseFloat(ptr)-parseFloat(sm)).toFixed(2);
            $('#pts').val(pts);
            var management=(parseFloat(pts/100)*parseFloat(10)).toFixed(2);
            $('#management').val(management);
            var promotion_cost=(parseFloat(ptr/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost);
            var scheme=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme);
            var scheme_amount_deduct_ten=(parseFloat(scheme/2)).toFixed(2);
            $('#scheme_amount_deduct').val(scheme_amount_deduct_ten);
            var transport_expiry_breakage=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage);
            var tot=(parseFloat(pts)-parseFloat(management)-parseFloat(promotion_cost)-parseFloat(purchase)-parseFloat(scheme)-parseFloat(transport_expiry_breakage)).toFixed(2);
            $('#tot').val(tot);
            var marketing_working_cost=(parseFloat(tot/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost);
            var company_profit=(parseFloat(tot)-parseFloat(marketing_working_cost)).toFixed(2);
            $('#company_profit').val(company_profit);
            var percent_profit_to_investment=((parseFloat(company_profit)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme)+parseFloat(transport_expiry_breakage))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment);
            var marketing_promotion_scheme=(parseFloat(promotion_cost)+parseFloat(marketing_working_cost)+parseFloat(scheme)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme);
            var percent_profit_to_ptr=((parseFloat(marketing_promotion_scheme)*parseFloat(100))/parseFloat(ptr)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr);
        }
        if(default_scheme==20){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr=parseFloat($('#ptr').val());
           
            var stockist_margin=parseFloat(ptr/100)*parseFloat(10);
            var sm=stockist_margin.toFixed(2);
            $('#stockist_margin').val(sm);
           
            var pts=(parseFloat(ptr)-parseFloat(sm)).toFixed(2);
            $('#pts').val(pts);
            var management=(parseFloat(pts/100)*parseFloat(10)).toFixed(2);
            $('#management').val(management);
            var promotion_cost=(parseFloat(ptr/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost);
            var scheme=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme);
            $('#scheme_amount_deduct').val(0);
            var transport_expiry_breakage=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage);
            var tot=(parseFloat(pts)-parseFloat(management)-parseFloat(promotion_cost)-parseFloat(purchase)-parseFloat(scheme)-parseFloat(transport_expiry_breakage)).toFixed(2);
            $('#tot').val(tot);
            var marketing_working_cost=(parseFloat(tot/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost);
            var company_profit=(parseFloat(tot)-parseFloat(marketing_working_cost)).toFixed(2);
            $('#company_profit').val(company_profit);
            var percent_profit_to_investment=((parseFloat(company_profit)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme)+parseFloat(transport_expiry_breakage))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment);
            var marketing_promotion_scheme=(parseFloat(promotion_cost)+parseFloat(marketing_working_cost)+parseFloat(scheme)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme);
            var percent_profit_to_ptr=((parseFloat(marketing_promotion_scheme)*parseFloat(100))/parseFloat(ptr)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr);
        }
        });

        $('#stockist_margin').keyup(function() {
            var default_scheme=parseInt($('#default_scheme').val());
            // alert(default_scheme);

        if(default_scheme==0){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr=parseFloat($('#ptr').val());
            var stockist_margin=parseFloat($('#stockist_margin').val());
           
           
            var sm=stockist_margin.toFixed(2);
           
           
            var pts=(parseFloat(ptr)-parseFloat(sm)).toFixed(2);
            $('#pts').val(pts);
            var management=(parseFloat(pts/100)*parseFloat(10)).toFixed(2);
            $('#management').val(management);
            var promotion_cost=(parseFloat(ptr/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost);
            var scheme=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme);
            $('#scheme_amount_deduct').val(0);
            var transport_expiry_breakage=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage);
            var tot=(parseFloat(pts)-parseFloat(management)-parseFloat(promotion_cost)-parseFloat(purchase)-parseFloat(scheme)-parseFloat(transport_expiry_breakage)).toFixed(2);
            $('#tot').val(tot);
            var marketing_working_cost=(parseFloat(tot/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost);
            var company_profit=(parseFloat(tot)-parseFloat(marketing_working_cost)).toFixed(2);
            $('#company_profit').val(company_profit);
            var percent_profit_to_investment=((parseFloat(company_profit)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme)+parseFloat(transport_expiry_breakage))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment);
            var marketing_promotion_scheme=(parseFloat(promotion_cost)+parseFloat(marketing_working_cost)+parseFloat(scheme)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme);
            var percent_profit_to_ptr=((parseFloat(marketing_promotion_scheme)*parseFloat(100))/parseFloat(ptr)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr);
        }
        if(default_scheme==10){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_ten=parseFloat($('#ptr').val());
            var stockist_margin_ten=parseFloat($('#stockist_margin').val());
            var sm_ten=stockist_margin_ten.toFixed(2);
            var pts_ten=(parseFloat(ptr_ten)-parseFloat(sm_ten)).toFixed(2);
            $('#pts').val(pts_ten);
            var management_ten=(parseFloat(pts_ten/100)*parseFloat(10)).toFixed(2);
            $('#management').val(management_ten);
            var promotion_cost_ten=(parseFloat(ptr_ten/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost_ten);
            var scheme_ten=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme_ten);
            var scheme_amount_deduct_ten=(parseFloat(scheme_ten/2)).toFixed(2);
            $('#scheme_amount_deduct').val(scheme_amount_deduct_ten);
            var transport_expiry_breakage_ten=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage_ten);
            var tot_ten=(parseFloat(pts_ten)-parseFloat(management_ten)-parseFloat(promotion_cost_ten)-parseFloat(purchase)-parseFloat(scheme_ten)-parseFloat(transport_expiry_breakage_ten)).toFixed(2);
            $('#tot').val(tot_ten);
            var marketing_working_cost_ten=(parseFloat(tot_ten/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost_ten);
            var company_profit_ten=(parseFloat(tot_ten)-parseFloat(marketing_working_cost_ten)).toFixed(2);
            $('#company_profit').val(company_profit_ten);
            var percent_profit_to_investment_ten=((parseFloat(company_profit_ten)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_ten)+parseFloat(transport_expiry_breakage_ten))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_ten);
            var marketing_promotion_scheme_ten=(parseFloat(promotion_cost_ten)+parseFloat(marketing_working_cost_ten)+parseFloat(scheme_amount_deduct_ten)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_ten);
            var percent_profit_to_ptr_ten=((parseFloat(marketing_promotion_scheme_ten)*parseFloat(100))/parseFloat(ptr_ten)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_ten);
        }
        if(default_scheme==20){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_twenty=parseFloat($('#ptr').val());
            var stockist_margin_twenty=parseFloat($('#stockist_margin').val());
            var sm_twenty=stockist_margin_twenty.toFixed(2);
            var pts_twenty=(parseFloat(ptr_twenty)-parseFloat(sm_twenty)).toFixed(2);
            $('#pts').val(pts_twenty);
            var management_twenty=(parseFloat(pts_twenty/100)*parseFloat(10)).toFixed(2);
            $('#management').val(management_twenty);
            var promotion_cost_twenty=(parseFloat(ptr_twenty/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost_twenty);
            var scheme_twenty=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme_twenty);
            $('#scheme_amount_deduct').val(0);
            var transport_expiry_breakage_twenty=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage_twenty);
            var tot_twenty=(parseFloat(pts_twenty)-parseFloat(management_twenty)-parseFloat(promotion_cost_twenty)-parseFloat(purchase)-parseFloat(scheme_twenty)-parseFloat(transport_expiry_breakage_twenty)).toFixed(2);
            $('#tot').val(tot_twenty);
            var marketing_working_cost_twenty=(parseFloat(tot_twenty/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost_twenty);
            var company_profit_twenty=(parseFloat(tot_twenty)-parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#company_profit').val(company_profit_twenty);
            var percent_profit_to_investment_twenty=((parseFloat(company_profit_twenty)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_twenty)+parseFloat(transport_expiry_breakage_twenty))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_twenty);
            var marketing_promotion_scheme_twenty=(parseFloat(promotion_cost_twenty)+parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_twenty);
            var percent_profit_to_ptr_twenty=((parseFloat(marketing_promotion_scheme_twenty)*parseFloat(100))/parseFloat(ptr_twenty)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_twenty);
        }
        });

        $('#pts').keyup(function() {
            var default_scheme=parseInt($('#default_scheme').val());
            // alert(default_scheme);

        if(default_scheme==0){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr=parseFloat($('#ptr').val());
            var pts=parseFloat($('#pts').val());
            var management=(parseFloat(pts/100)*parseFloat(10)).toFixed(2);
            $('#management').val(management);
            var promotion_cost=(parseFloat(ptr/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost);
            var scheme=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme);
            $('#scheme_amount_deduct').val(0);
            var transport_expiry_breakage=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage);
            var tot=(parseFloat(pts)-parseFloat(management)-parseFloat(promotion_cost)-parseFloat(purchase)-parseFloat(scheme)-parseFloat(transport_expiry_breakage)).toFixed(2);
            $('#tot').val(tot);
            var marketing_working_cost=(parseFloat(tot/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost);
            var company_profit=(parseFloat(tot)-parseFloat(marketing_working_cost)).toFixed(2);
            $('#company_profit').val(company_profit);
            var percent_profit_to_investment=((parseFloat(company_profit)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme)+parseFloat(transport_expiry_breakage))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment);
            var marketing_promotion_scheme=(parseFloat(promotion_cost)+parseFloat(marketing_working_cost)+parseFloat(scheme)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme);
            var percent_profit_to_ptr=((parseFloat(marketing_promotion_scheme)*parseFloat(100))/parseFloat(ptr)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr);
        }
        if(default_scheme==10){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_ten=parseFloat($('#ptr').val());
            var pts_ten=parseFloat($('#pts').val());
            var management_ten=(parseFloat(pts_ten/100)*parseFloat(10)).toFixed(2);
            $('#management').val(management_ten);
            var promotion_cost_ten=(parseFloat(ptr_ten/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost_ten);
            var scheme_ten=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme_ten);
            var scheme_amount_deduct_ten=(parseFloat(scheme_ten/2)).toFixed(2);
            $('#scheme_amount_deduct').val(scheme_amount_deduct_ten);
            var transport_expiry_breakage_ten=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage_ten);
            var tot_ten=(parseFloat(pts_ten)-parseFloat(management_ten)-parseFloat(promotion_cost_ten)-parseFloat(purchase)-parseFloat(scheme_ten)-parseFloat(transport_expiry_breakage_ten)).toFixed(2);
            $('#tot').val(tot_ten);
            var marketing_working_cost_ten=(parseFloat(tot_ten/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost_ten);
            var company_profit_ten=(parseFloat(tot_ten)-parseFloat(marketing_working_cost_ten)).toFixed(2);
            $('#company_profit').val(company_profit_ten);
            var percent_profit_to_investment_ten=((parseFloat(company_profit_ten)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_ten)+parseFloat(transport_expiry_breakage_ten))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_ten);
            var marketing_promotion_scheme_ten=(parseFloat(promotion_cost_ten)+parseFloat(marketing_working_cost_ten)+parseFloat(scheme_amount_deduct_ten)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_ten);
            var percent_profit_to_ptr_ten=((parseFloat(marketing_promotion_scheme_ten)*parseFloat(100))/parseFloat(ptr_ten)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_ten);
        }
        if(default_scheme==20){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_twenty=parseFloat($('#ptr').val());
            var pts_twenty=parseFloat($('#pts').val());
            var management_twenty=(parseFloat(pts_twenty/100)*parseFloat(10)).toFixed(2);
            $('#management').val(management_twenty);
            var promotion_cost_twenty=(parseFloat(ptr_twenty/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost_twenty);
            var scheme_twenty=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme_twenty);
            $('#scheme_amount_deduct').val(0);
            var transport_expiry_breakage_twenty=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage_twenty);
            var tot_twenty=(parseFloat(pts_twenty)-parseFloat(management_twenty)-parseFloat(promotion_cost_twenty)-parseFloat(purchase)-parseFloat(scheme_twenty)-parseFloat(transport_expiry_breakage_twenty)).toFixed(2);
            $('#tot').val(tot_twenty);
            var marketing_working_cost_twenty=(parseFloat(tot_twenty/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost_twenty);
            var company_profit_twenty=(parseFloat(tot_twenty)-parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#company_profit').val(company_profit_twenty);
            var percent_profit_to_investment_twenty=((parseFloat(company_profit_twenty)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_twenty)+parseFloat(transport_expiry_breakage_twenty))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_twenty);
            var marketing_promotion_scheme_twenty=(parseFloat(promotion_cost_twenty)+parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_twenty);
            var percent_profit_to_ptr_twenty=((parseFloat(marketing_promotion_scheme_twenty)*parseFloat(100))/parseFloat(ptr_twenty)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_twenty);
        }

        });
        $('#management').keyup(function() {
             var default_scheme=parseInt($('#default_scheme').val());
            // alert(default_scheme);

        if(default_scheme==0){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr=parseFloat($('#ptr').val());
            var pts=parseFloat($('#pts').val());
            var management=parseFloat($('#management').val());
            var promotion_cost=(parseFloat(ptr/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost);
            var scheme=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme);
            $('#scheme_amount_deduct').val(0);
            var transport_expiry_breakage=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage);
            var tot=(parseFloat(pts)-parseFloat(management)-parseFloat(promotion_cost)-parseFloat(purchase)-parseFloat(scheme)-parseFloat(transport_expiry_breakage)).toFixed(2);
            $('#tot').val(tot);
            var marketing_working_cost=(parseFloat(tot/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost);
            var company_profit=(parseFloat(tot)-parseFloat(marketing_working_cost)).toFixed(2);
            $('#company_profit').val(company_profit);
            var percent_profit_to_investment=((parseFloat(company_profit)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme)+parseFloat(transport_expiry_breakage))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment);
            var marketing_promotion_scheme=(parseFloat(promotion_cost)+parseFloat(marketing_working_cost)+parseFloat(scheme)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme);
            var percent_profit_to_ptr=((parseFloat(marketing_promotion_scheme)*parseFloat(100))/parseFloat(ptr)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr);
        }
        if(default_scheme==10){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_ten=parseFloat($('#ptr').val());
            var pts_ten=parseFloat($('#pts').val());
            var management_ten=parseFloat($('#management').val());
            var promotion_cost_ten=(parseFloat(ptr_ten/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost_ten);
            var scheme_ten=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme_ten);
            var scheme_amount_deduct_ten=(parseFloat(scheme_ten/2)).toFixed(2);
            $('#scheme_amount_deduct').val(scheme_amount_deduct_ten);
            var transport_expiry_breakage_ten=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage_ten);
            var tot_ten=(parseFloat(pts_ten)-parseFloat(management_ten)-parseFloat(promotion_cost_ten)-parseFloat(purchase)-parseFloat(scheme_ten)-parseFloat(transport_expiry_breakage_ten)).toFixed(2);
            $('#tot').val(tot_ten);
            var marketing_working_cost_ten=(parseFloat(tot_ten/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost_ten);
            var company_profit_ten=(parseFloat(tot_ten)-parseFloat(marketing_working_cost_ten)).toFixed(2);
            $('#company_profit').val(company_profit_ten);
            var percent_profit_to_investment_ten=((parseFloat(company_profit_ten)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_ten)+parseFloat(transport_expiry_breakage_ten))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_ten);
            var marketing_promotion_scheme_ten=(parseFloat(promotion_cost_ten)+parseFloat(marketing_working_cost_ten)+parseFloat(scheme_amount_deduct_ten)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_ten);
            var percent_profit_to_ptr_ten=((parseFloat(marketing_promotion_scheme_ten)*parseFloat(100))/parseFloat(ptr_ten)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_ten);
        }
        if(default_scheme==20){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr=parseFloat($('#ptr').val());
            var pts=parseFloat($('#pts').val());
            var management=parseFloat($('#management').val());
            var promotion_cost=(parseFloat(ptr/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost);
            var scheme=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme);
            $('#scheme_amount_deduct').val(0);
            var transport_expiry_breakage=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage);
            var tot=(parseFloat(pts)-parseFloat(management)-parseFloat(promotion_cost)-parseFloat(purchase)-parseFloat(scheme)-parseFloat(transport_expiry_breakage)).toFixed(2);
            $('#tot').val(tot);
            var marketing_working_cost=(parseFloat(tot/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost);
            var company_profit=(parseFloat(tot)-parseFloat(marketing_working_cost)).toFixed(2);
            $('#company_profit').val(company_profit);
            var percent_profit_to_investment=((parseFloat(company_profit)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme)+parseFloat(transport_expiry_breakage))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment);
            var marketing_promotion_scheme=(parseFloat(promotion_cost)+parseFloat(marketing_working_cost)+parseFloat(scheme)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme);
            var percent_profit_to_ptr=((parseFloat(marketing_promotion_scheme)*parseFloat(100))/parseFloat(ptr)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr);
        }

        });
        $('#promotion_cost').keyup(function() {
            var default_scheme=parseInt($('#default_scheme').val());
            // alert(default_scheme);

        if(default_scheme==0){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr=parseFloat($('#ptr').val());
            var pts=parseFloat($('#pts').val());
            var management=parseFloat($('#management').val());
            var promotion_cost=parseFloat($('#promotion_cost').val());
            var scheme=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme);
            $('#scheme_amount_deduct').val(0);
            var transport_expiry_breakage=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage);
            var tot=(parseFloat(pts)-parseFloat(management)-parseFloat(promotion_cost)-parseFloat(purchase)-parseFloat(scheme)-parseFloat(transport_expiry_breakage)).toFixed(2);
            $('#tot').val(tot);
            var marketing_working_cost=(parseFloat(tot/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost);
            var company_profit=(parseFloat(tot)-parseFloat(marketing_working_cost)).toFixed(2);
            $('#company_profit').val(company_profit);
            var percent_profit_to_investment=((parseFloat(company_profit)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme)+parseFloat(transport_expiry_breakage))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment);
            var marketing_promotion_scheme=(parseFloat(promotion_cost)+parseFloat(marketing_working_cost)+parseFloat(scheme)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme);
            var percent_profit_to_ptr=((parseFloat(marketing_promotion_scheme)*parseFloat(100))/parseFloat(ptr)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr);
        }
        if(default_scheme==10){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_ten=parseFloat($('#ptr').val());
            var pts_ten=parseFloat($('#pts').val());
            var management_ten=parseFloat($('#management').val());
            var promotion_cost_ten=parseFloat($('#promotion_cost').val());
            var scheme_ten=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme_ten);
            var scheme_amount_deduct_ten=(parseFloat(scheme_ten/2)).toFixed(2);
            $('#scheme_amount_deduct').val(scheme_amount_deduct_ten);
            var transport_expiry_breakage_ten=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage_ten);
            var tot_ten=(parseFloat(pts_ten)-parseFloat(management_ten)-parseFloat(promotion_cost_ten)-parseFloat(purchase)-parseFloat(scheme_ten)-parseFloat(transport_expiry_breakage_ten)).toFixed(2);
            $('#tot').val(tot_ten);
            var marketing_working_cost_ten=(parseFloat(tot_ten/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost_ten);
            var company_profit_ten=(parseFloat(tot_ten)-parseFloat(marketing_working_cost_ten)).toFixed(2);
            $('#company_profit').val(company_profit_ten);
            var percent_profit_to_investment_ten=((parseFloat(company_profit_ten)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_ten)+parseFloat(transport_expiry_breakage_ten))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_ten);
            var marketing_promotion_scheme_ten=(parseFloat(promotion_cost_ten)+parseFloat(marketing_working_cost_ten)+parseFloat(scheme_amount_deduct_ten)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_ten);
            var percent_profit_to_ptr_ten=((parseFloat(marketing_promotion_scheme_ten)*parseFloat(100))/parseFloat(ptr_ten)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_ten);
        }
        if(default_scheme==20){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_twenty=parseFloat($('#ptr').val());
            var pts_twenty=parseFloat($('#pts').val());
            var management_twenty=parseFloat($('#management').val());
            var promotion_cost_twenty=parseFloat($('#promotion_cost').val());
            var scheme_twenty=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme_twenty);
            $('#scheme_amount_deduct').val(0);
            var transport_expiry_breakage_twenty=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage_twenty);
            var tot_twenty=(parseFloat(pts_twenty)-parseFloat(management_twenty)-parseFloat(promotion_cost_twenty)-parseFloat(purchase)-parseFloat(scheme_twenty)-parseFloat(transport_expiry_breakage_twenty)).toFixed(2);
            $('#tot').val(tot_twenty);
            var marketing_working_cost_twenty=(parseFloat(tot_twenty/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost_twenty);
            var company_profit_twenty=(parseFloat(tot_twenty)-parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#company_profit').val(company_profit_twenty);
            var percent_profit_to_investment_twenty=((parseFloat(company_profit_twenty)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_twenty)+parseFloat(transport_expiry_breakage_twenty))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_twenty);
            var marketing_promotion_scheme_twenty=(parseFloat(promotion_cost_twenty)+parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_twenty);
            var percent_profit_to_ptr_twenty=((parseFloat(marketing_promotion_scheme_twenty)*parseFloat(100))/parseFloat(ptr_twenty)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_twenty);
        }
            });
        $('#scheme').keyup(function() {
            var default_scheme=parseInt($('#default_scheme').val());
            // alert(default_scheme);

        if(default_scheme==0){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr=parseFloat($('#ptr').val());
            var pts=parseFloat($('#pts').val());
            var management=parseFloat($('#management').val());
            var promotion_cost=parseFloat($('#promotion_cost').val());
            var scheme=parseFloat($('#scheme').val());
            $('#scheme_amount_deduct').val(0);
            var transport_expiry_breakage=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage);
            var tot=(parseFloat(pts)-parseFloat(management)-parseFloat(promotion_cost)-parseFloat(purchase)-parseFloat(scheme)-parseFloat(transport_expiry_breakage)).toFixed(2);
            $('#tot').val(tot);
            var marketing_working_cost=(parseFloat(tot/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost);
            var company_profit=(parseFloat(tot)-parseFloat(marketing_working_cost)).toFixed(2);
            $('#company_profit').val(company_profit);
            var percent_profit_to_investment=((parseFloat(company_profit)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme)+parseFloat(transport_expiry_breakage))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment);
            var marketing_promotion_scheme=(parseFloat(promotion_cost)+parseFloat(marketing_working_cost)+parseFloat(scheme)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme);
            var percent_profit_to_ptr=((parseFloat(marketing_promotion_scheme)*parseFloat(100))/parseFloat(ptr)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr);
        }
         if(default_scheme==10){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_ten=parseFloat($('#ptr').val());
            var pts_ten=parseFloat($('#pts').val());
            var management_ten=parseFloat($('#management').val());
            var promotion_cost_ten=parseFloat($('#promotion_cost').val());
            var scheme_ten=parseFloat($('#scheme').val());
            var scheme_amount_deduct_ten=(parseFloat(scheme_ten/2)).toFixed(2);
            $('#scheme_amount_deduct').val(scheme_amount_deduct_ten);
            var transport_expiry_breakage_ten=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage_ten);
            var tot_ten=(parseFloat(pts_ten)-parseFloat(management_ten)-parseFloat(promotion_cost_ten)-parseFloat(purchase)-parseFloat(scheme_ten)-parseFloat(transport_expiry_breakage_ten)).toFixed(2);
            $('#tot').val(tot_ten);
            var marketing_working_cost_ten=(parseFloat(tot_ten/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost_ten);
            var company_profit_ten=(parseFloat(tot_ten)-parseFloat(marketing_working_cost_ten)).toFixed(2);
            $('#company_profit').val(company_profit_ten);
            var percent_profit_to_investment_ten=((parseFloat(company_profit_ten)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_ten)+parseFloat(transport_expiry_breakage_ten))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_ten);
            var marketing_promotion_scheme_ten=(parseFloat(promotion_cost_ten)+parseFloat(marketing_working_cost_ten)+parseFloat(scheme_amount_deduct_ten)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_ten);
            var percent_profit_to_ptr_ten=((parseFloat(marketing_promotion_scheme_ten)*parseFloat(100))/parseFloat(ptr_ten)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_ten);
        }
         if(default_scheme==20){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_twenty=parseFloat($('#ptr').val());
            var pts_twenty=parseFloat($('#pts').val());
            var management_twenty=parseFloat($('#management').val());
            var promotion_cost_twenty=parseFloat($('#promotion_cost').val());
            var scheme_twenty=parseFloat($('#scheme').val());
            $('#scheme_amount_deduct').val(0);
            var transport_expiry_breakage_twenty=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage_twenty);
            var tot_twenty=(parseFloat(pts_twenty)-parseFloat(management_twenty)-parseFloat(promotion_cost_twenty)-parseFloat(purchase)-parseFloat(scheme_twenty)-parseFloat(transport_expiry_breakage_twenty)).toFixed(2);
            $('#tot').val(tot_twenty);
            var marketing_working_cost_twenty=(parseFloat(tot_twenty/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost_twenty);
            var company_profit_twenty=(parseFloat(tot_twenty)-parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#company_profit').val(company_profit_twenty);
            var percent_profit_to_investment_twenty=((parseFloat(company_profit_twenty)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_twenty)+parseFloat(transport_expiry_breakage_twenty))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_twenty);
            var marketing_promotion_scheme_twenty=(parseFloat(promotion_cost_twenty)+parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_twenty);
            var percent_profit_to_ptr_twenty=((parseFloat(marketing_promotion_scheme_twenty)*parseFloat(100))/parseFloat(ptr_twenty)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_twenty);
        }
        });
        $('#scheme_amount_deduct').keyup(function() {
            var default_scheme=parseInt($('#default_scheme').val());
            // alert(default_scheme);

        if(default_scheme==0 || default_scheme==20){
            $('#scheme_amount_deduct').val(0);
        }
        if(default_scheme==10){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_ten=parseFloat($('#ptr').val());
            var pts_ten=parseFloat($('#pts').val());
            var management_ten=parseFloat($('#management').val());
            var promotion_cost_ten=parseFloat($('#promotion_cost').val());
            var scheme_ten=parseFloat($('#scheme').val());
            var scheme_amount_deduct_ten=parseFloat($('#scheme_amount_deduct').val());
            var transport_expiry_breakage_ten=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage_ten);
            var tot_ten=(parseFloat(pts_ten)-parseFloat(management_ten)-parseFloat(promotion_cost_ten)-parseFloat(purchase)-parseFloat(scheme_ten)-parseFloat(transport_expiry_breakage_ten)).toFixed(2);
            $('#tot').val(tot_ten);
            var marketing_working_cost_ten=(parseFloat(tot_ten/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost_ten);
            var company_profit_ten=(parseFloat(tot_ten)-parseFloat(marketing_working_cost_ten)).toFixed(2);
            $('#company_profit').val(company_profit_ten);
            var percent_profit_to_investment_ten=((parseFloat(company_profit_ten)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_ten)+parseFloat(transport_expiry_breakage_ten))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_ten);
            var marketing_promotion_scheme_ten=(parseFloat(promotion_cost_ten)+parseFloat(marketing_working_cost_ten)+parseFloat(scheme_amount_deduct_ten)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_ten);
            var percent_profit_to_ptr_ten=((parseFloat(marketing_promotion_scheme_ten)*parseFloat(100))/parseFloat(ptr_ten)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_ten);
        }
            });
        $('#transport_expiry_breakage').keyup(function() {
            var default_scheme=parseInt($('#default_scheme').val());
            // alert(default_scheme);

        if(default_scheme==0){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr=parseFloat($('#ptr').val());
            var pts=parseFloat($('#pts').val());
            var management=parseFloat($('#management').val());
            var promotion_cost=parseFloat($('#promotion_cost').val());
            var scheme=parseFloat($('#scheme').val());
            var transport_expiry_breakage=parseFloat($('#transport_expiry_breakage').val());
            var tot=(parseFloat(pts)-parseFloat(management)-parseFloat(promotion_cost)-parseFloat(purchase)-parseFloat(scheme)-parseFloat(transport_expiry_breakage)).toFixed(2);
            $('#tot').val(tot);
            var marketing_working_cost=(parseFloat(tot/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost);
            var company_profit=(parseFloat(tot)-parseFloat(marketing_working_cost)).toFixed(2);
            $('#company_profit').val(company_profit);
            var percent_profit_to_investment=((parseFloat(company_profit)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme)+parseFloat(transport_expiry_breakage))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment);
            var marketing_promotion_scheme=(parseFloat(promotion_cost)+parseFloat(marketing_working_cost)+parseFloat(scheme)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme);
            var percent_profit_to_ptr=((parseFloat(marketing_promotion_scheme)*parseFloat(100))/parseFloat(ptr)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr);
        }
        if(default_scheme==10){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_ten=parseFloat($('#ptr').val());
            var pts_ten=parseFloat($('#pts').val());
            var management_ten=parseFloat($('#management').val());
            var promotion_cost_ten=parseFloat($('#promotion_cost').val());
            var scheme_ten=parseFloat($('#scheme').val());
            var transport_expiry_breakage_ten=parseFloat($('#transport_expiry_breakage').val());
            var tot_ten=(parseFloat(pts_ten)-parseFloat(management_ten)-parseFloat(promotion_cost_ten)-parseFloat(purchase)-parseFloat(scheme_ten)-parseFloat(transport_expiry_breakage_ten)).toFixed(2);
            $('#tot').val(tot_ten);
            var marketing_working_cost_ten=(parseFloat(tot_ten/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost_ten);
            var company_profit_ten=(parseFloat(tot_ten)-parseFloat(marketing_working_cost_ten)).toFixed(2);
            $('#company_profit').val(company_profit_ten);
            var percent_profit_to_investment_ten=((parseFloat(company_profit_ten)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_ten)+parseFloat(transport_expiry_breakage_ten))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_ten);
            var marketing_promotion_scheme_ten=(parseFloat(promotion_cost_ten)+parseFloat(marketing_working_cost_ten)+parseFloat(scheme_amount_deduct_ten)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_ten);
            var percent_profit_to_ptr_ten=((parseFloat(marketing_promotion_scheme_ten)*parseFloat(100))/parseFloat(ptr_ten)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_ten);

        }
        if(default_scheme==20){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_twenty=parseFloat($('#ptr').val());
            var pts_twenty=parseFloat($('#pts').val());
            var management_twenty=parseFloat($('#management').val());
            var promotion_cost_twenty=parseFloat($('#promotion_cost').val());
            var scheme_twenty=parseFloat($('#scheme').val());
            var transport_expiry_breakage_twenty=parseFloat($('#transport_expiry_breakage').val());
            var tot_twenty=(parseFloat(pts_twenty)-parseFloat(management_twenty)-parseFloat(promotion_cost_twenty)-parseFloat(purchase)-parseFloat(scheme_twenty)-parseFloat(transport_expiry_breakage_twenty)).toFixed(2);
            $('#tot').val(tot_twenty);
            var marketing_working_cost_twenty=(parseFloat(tot_twenty/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost_twenty);
            var company_profit_twenty=(parseFloat(tot_twenty)-parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#company_profit').val(company_profit_twenty);
            var percent_profit_to_investment_twenty=((parseFloat(company_profit_twenty)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_twenty)+parseFloat(transport_expiry_breakage_twenty))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_twenty);
            var marketing_promotion_scheme_twenty=(parseFloat(promotion_cost_twenty)+parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_twenty);
            var percent_profit_to_ptr_twenty=((parseFloat(marketing_promotion_scheme_twenty)*parseFloat(100))/parseFloat(ptr_twenty)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_twenty);
        }
            });
        $('#tot').keyup(function() {
            var default_scheme=parseInt($('#default_scheme').val());
            // alert(default_scheme);

        if(default_scheme==0){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr=parseFloat($('#ptr').val());
            var pts=parseFloat($('#pts').val());
            var management=parseFloat($('#management').val());
            var promotion_cost=parseFloat($('#promotion_cost').val());
            var scheme=parseFloat($('#scheme').val());
            var transport_expiry_breakage=parseFloat($('#transport_expiry_breakage').val());
            var tot=parseFloat($('#tot').val());
            var marketing_working_cost=(parseFloat(tot/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost);
            var company_profit=(parseFloat(tot)-parseFloat(marketing_working_cost)).toFixed(2);
            $('#company_profit').val(company_profit);
            var percent_profit_to_investment=((parseFloat(company_profit)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme)+parseFloat(transport_expiry_breakage))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment);
            var marketing_promotion_scheme=(parseFloat(promotion_cost)+parseFloat(marketing_working_cost)+parseFloat(scheme)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme);
            var percent_profit_to_ptr=((parseFloat(marketing_promotion_scheme)*parseFloat(100))/parseFloat(ptr)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr);
        }
        if(default_scheme==10){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_ten=parseFloat($('#ptr').val());
            var pts_ten=parseFloat($('#pts').val());
            var management_ten=parseFloat($('#management').val());
            var promotion_cost_ten=parseFloat($('#promotion_cost').val());
            var scheme_ten=parseFloat($('#scheme').val());
            var transport_expiry_breakage_ten=parseFloat($('#transport_expiry_breakage').val());
            var tot_ten=parseFloat($('#tot').val());
            var marketing_working_cost_ten=(parseFloat(tot_ten/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost_ten);
            var company_profit_ten=(parseFloat(tot_ten)-parseFloat(marketing_working_cost_ten)).toFixed(2);
            $('#company_profit').val(company_profit_ten);
            var percent_profit_to_investment_ten=((parseFloat(company_profit_ten)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_ten)+parseFloat(transport_expiry_breakage_ten))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_ten);
            var marketing_promotion_scheme_ten=(parseFloat(promotion_cost_ten)+parseFloat(marketing_working_cost_ten)+parseFloat(scheme_amount_deduct_ten)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_ten);
            var percent_profit_to_ptr_ten=((parseFloat(marketing_promotion_scheme_ten)*parseFloat(100))/parseFloat(ptr_ten)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_ten);

        }
        if(default_scheme==20){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_twenty=parseFloat($('#ptr').val());
            var pts_twenty=parseFloat($('#pts').val());
            var management_twenty=parseFloat($('#management').val());
            var promotion_cost_twenty=parseFloat($('#promotion_cost').val());
            var scheme_twenty=parseFloat($('#scheme').val());
            var transport_expiry_breakage_twenty=parseFloat($('#transport_expiry_breakage').val());
            var tot_twenty=parseFloat($('#tot').val());
            var marketing_working_cost_twenty=(parseFloat(tot_twenty/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost_twenty);
            var company_profit_twenty=(parseFloat(tot_twenty)-parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#company_profit').val(company_profit_twenty);
            var percent_profit_to_investment_twenty=((parseFloat(company_profit_twenty)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_twenty)+parseFloat(transport_expiry_breakage_twenty))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_twenty);
            var marketing_promotion_scheme_twenty=(parseFloat(promotion_cost_twenty)+parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_twenty);
            var percent_profit_to_ptr_twenty=((parseFloat(marketing_promotion_scheme_twenty)*parseFloat(100))/parseFloat(ptr_twenty)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_twenty);
        }
            });
        $('#marketing_working_cost').keyup(function() {
            var default_scheme=parseInt($('#default_scheme').val());
            // alert(default_scheme);

        if(default_scheme==0){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr=parseFloat($('#ptr').val());
            var pts=parseFloat($('#pts').val());
            var management=parseFloat($('#management').val());
            var promotion_cost=parseFloat($('#promotion_cost').val());
            var scheme=parseFloat($('#scheme').val());
            var transport_expiry_breakage=parseFloat($('#transport_expiry_breakage').val());
            var tot=parseFloat($('#tot').val());
            var marketing_working_cost=parseFloat($('#marketing_working_cost').val());
            var company_profit=(parseFloat(tot)-parseFloat(marketing_working_cost)).toFixed(2);
            $('#company_profit').val(company_profit);
            var percent_profit_to_investment=((parseFloat(company_profit)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme)+parseFloat(transport_expiry_breakage))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment);
            var marketing_promotion_scheme=(parseFloat(promotion_cost)+parseFloat(marketing_working_cost)+parseFloat(scheme)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme);
            var percent_profit_to_ptr=((parseFloat(marketing_promotion_scheme)*parseFloat(100))/parseFloat(ptr)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr);
        }
        if(default_scheme==10){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_ten=parseFloat($('#ptr').val());
            var pts_ten=parseFloat($('#pts').val());
            var management_ten=parseFloat($('#management').val());
            var promotion_cost_ten=parseFloat($('#promotion_cost').val());
            var scheme_ten=parseFloat($('#scheme').val());
            var transport_expiry_breakage_ten=parseFloat($('#transport_expiry_breakage').val());
            var tot_ten=parseFloat($('#tot').val());
            var marketing_working_cost_ten=parseFloat($('#marketing_working_cost').val());
            var company_profit_ten=(parseFloat(tot_ten)-parseFloat(marketing_working_cost_ten)).toFixed(2);
            $('#company_profit').val(company_profit_ten);
            var percent_profit_to_investment_ten=((parseFloat(company_profit_ten)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_ten)+parseFloat(transport_expiry_breakage_ten))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_ten);
            var marketing_promotion_scheme_ten=(parseFloat(promotion_cost_ten)+parseFloat(marketing_working_cost_ten)+parseFloat(scheme_amount_deduct_ten)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_ten);
            var percent_profit_to_ptr_ten=((parseFloat(marketing_promotion_scheme_ten)*parseFloat(100))/parseFloat(ptr_ten)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_ten);
        }
        if(default_scheme==20){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_twenty=parseFloat($('#ptr').val());
            var pts_twenty=parseFloat($('#pts').val());
            var management_twenty=parseFloat($('#management').val());
            var promotion_cost_twenty=parseFloat($('#promotion_cost').val());
            var scheme_twenty=parseFloat($('#scheme').val());
            var transport_expiry_breakage_twenty=parseFloat($('#transport_expiry_breakage').val());
            var tot_twenty=parseFloat($('#tot').val());
            var marketing_working_cost_twenty=parseFloat($('#marketing_working_cost').val());
            var company_profit_twenty=(parseFloat(tot_twenty)-parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#company_profit').val(company_profit_twenty);
            var percent_profit_to_investment_twenty=((parseFloat(company_profit_twenty)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_twenty)+parseFloat(transport_expiry_breakage_twenty))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_twenty);
            var marketing_promotion_scheme_twenty=(parseFloat(promotion_cost_twenty)+parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme_twenty);
            var percent_profit_to_ptr_twenty=((parseFloat(marketing_promotion_scheme_twenty)*parseFloat(100))/parseFloat(ptr_twenty)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_twenty);
        }
            });
        $('#company_profit').keyup(function() {
            var default_scheme=parseInt($('#default_scheme').val());
            // alert(default_scheme);

        if(default_scheme==0){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr=parseFloat($('#ptr').val());
            var pts=parseFloat($('#pts').val());
            var management=parseFloat($('#management').val());
            var promotion_cost=parseFloat($('#promotion_cost').val());
            var scheme=parseFloat($('#scheme').val());
            var transport_expiry_breakage=parseFloat($('#transport_expiry_breakage').val());
            var tot=parseFloat($('#tot').val());
            var marketing_working_cost=parseFloat($('#marketing_working_cost').val());
            var company_profit=parseFloat($('#company_profit').val());
            var percent_profit_to_investment=((parseFloat(company_profit)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme)+parseFloat(transport_expiry_breakage))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment);
        }
        if(default_scheme==10){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_ten=parseFloat($('#ptr').val());
            var pts_ten=parseFloat($('#pts').val());
            var management_ten=parseFloat($('#management').val());
            var promotion_cost_ten=parseFloat($('#promotion_cost').val());
            var scheme_ten=parseFloat($('#scheme').val());
            var transport_expiry_breakage_ten=parseFloat($('#transport_expiry_breakage').val());
            var tot=parseFloat($('#tot').val());
            var marketing_working_cost=parseFloat($('#marketing_working_cost').val());
            var company_profit_ten=parseFloat($('#company_profit').val());
            var percent_profit_to_investment_ten=((parseFloat(company_profit_ten)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_ten)+parseFloat(transport_expiry_breakage_ten))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_ten);

        }
        if(default_scheme==20){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_twenty=parseFloat($('#ptr').val());
            var pts_twenty=parseFloat($('#pts').val());
            var management=parseFloat($('#management').val());
            var promotion_cost=parseFloat($('#promotion_cost').val());
            var scheme_twenty=parseFloat($('#scheme').val());
            var transport_expiry_breakage_twenty=parseFloat($('#transport_expiry_breakage').val());
            var tot=parseFloat($('#tot').val());
            var marketing_working_cost=parseFloat($('#marketing_working_cost').val());
            var company_profit_twenty=parseFloat($('#company_profit').val());
            var percent_profit_to_investment_twenty=((parseFloat(company_profit_twenty)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_twenty)+parseFloat(transport_expiry_breakage_twenty))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment_twenty);
        }
            
            });
        // $('#percent_profit_to_investment').keyup(function() {
        //     var percent_profit_to_investment=parseFloat($('#percent_profit_to_investment').val());
        //     });
        $('#marketing_promotion_scheme').keyup(function() {
            var default_scheme=parseInt($('#default_scheme').val());
            // alert(default_scheme);

        if(default_scheme==0){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr=parseFloat($('#ptr').val());
            var pts=parseFloat($('#pts').val());
            var management=parseFloat($('#management').val());
            var promotion_cost=parseFloat($('#promotion_cost').val());
            var scheme=parseFloat($('#scheme').val());
            var transport_expiry_breakage=parseFloat($('#transport_expiry_breakage').val());
            var tot=parseFloat($('#tot').val());
            var marketing_working_cost=parseFloat($('#marketing_working_cost').val());
            var company_profit=parseFloat($('#company_profit').val());
            var marketing_promotion_scheme=parseFloat($('#marketing_promotion_scheme').val());
            var percent_profit_to_ptr=((parseFloat(marketing_promotion_scheme)*parseFloat(100))/parseFloat(ptr)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr);
        }
        if(default_scheme==10){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_ten=parseFloat($('#ptr').val());
            var pts_ten=parseFloat($('#pts').val());
            var management_ten=parseFloat($('#management').val());
            var promotion_cost_ten=parseFloat($('#promotion_cost').val());
            var scheme_ten=parseFloat($('#scheme').val());
            var transport_expiry_breakage_ten=parseFloat($('#transport_expiry_breakage').val());
            var tot_ten=parseFloat($('#tot').val());
            var marketing_working_cost_ten=parseFloat($('#marketing_working_cost').val());
            var company_profit_ten=parseFloat($('#company_profit').val());
            var marketing_promotion_scheme_ten=parseFloat($('#marketing_promotion_scheme').val());
            var percent_profit_to_ptr_ten=((parseFloat(marketing_promotion_scheme_ten)*parseFloat(100))/parseFloat(ptr_ten)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_ten);
        }
        if(default_scheme==20){
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
            var ptr_twenty=parseFloat($('#ptr').val());
            var pts_twenty=parseFloat($('#pts').val());
            var management=parseFloat($('#management').val());
            var promotion_cost=parseFloat($('#promotion_cost').val());
            var scheme=parseFloat($('#scheme').val());
            var transport_expiry_breakage=parseFloat($('#transport_expiry_breakage').val());
            var tot=parseFloat($('#tot').val());
            var marketing_working_cost=parseFloat($('#marketing_working_cost').val());
            var company_profit=parseFloat($('#company_profit').val());
            var marketing_promotion_scheme_twenty=parseFloat($('#marketing_promotion_scheme').val());
            var percent_profit_to_ptr_twenty=((parseFloat(marketing_promotion_scheme_twenty)*parseFloat(100))/parseFloat(ptr_twenty)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr_twenty);
        }

            });
         // $('#percent_profit_to_ptr').keyup(function() {
         //    var percent_profit_to_ptr=parseFloat($('#percent_profit_to_ptr').val());
         //    });
 });

        $(function() { 
            $("input[type='text']").keyup(function() { 
                this.value = this.value.toLocaleUpperCase(); 
            }); 
        }); 
    </script>  
    @stop
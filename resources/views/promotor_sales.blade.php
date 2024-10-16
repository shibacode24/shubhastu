

@extends('layout')
@section('content')


<style>
    table,
    th,
    td {
        border: 1px solid black;


    }

    .td {
        font-size: 5px;
    }
</style>


<!--start page wrapper -->  
<div class="col">
    <div class="modal fade" id="exampleScrollableModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Stockist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
                <form class="row g-2" action="{{ route('create_stockist_pro') }}" method="post">
                    @csrf
                    
                    <div class="row">
                    	<div class="col-md-6">
                            <label class="form-label">Select City</label>
                            <select class="form-select mb-3 " aria-label="Default select example"  name="select_city_id">
                            <option value="">Select</option>
                                    @foreach ($city as $citys)
                             <option value="{{ $citys->id }}">
                                {{$citys->city}} </option>
                             @endforeach
                            </select>         
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="inputFirstName" class="form-label">Select Company*</label>
                    

                            <select class="form-select mb-3 " aria-label="Default select example"  name="select_company_id[]">
                            <option value="">Select</option>
                                    @foreach ($company as $add)
                             <option value="{{ $add->id }}">
                                {{$add->Name}} </option>
                             @endforeach
                            
                                </select>
                            
                                </select>
                                            
                        </div>
                    

                        
                        <div class="col-md-6">
                            <label for="inputFirstName" class="form-label">Select Stockist*</label>

                            <select class="form-select mb-3 " aria-label="Default select example"  name="select_stockist_id">
                            <option value="">Select</option>
                                    @foreach ($stockist as $Stocks)
                             <option value="{{ $Stocks->id }}">
                                {{$Stocks->stockist}} </option>
                             @endforeach
                            
                                </select>
                            
                            </select>

                        </div>


                        <div class="col-md-6">
                            <label for="inputFirstName" class="form-label">Select Medical*</label>

                            <select class="form-select mb-3 " aria-label="Default select example"  name="select_medical_id[]">
                            <option value="Select">Select</option>
                                    @foreach ($medical as $medicals)
                             <option value="{{ $medicals->id }}">
                                {{$medicals->medical}} </option>
                             @endforeach
                                </select>
                            
                            </select>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    </div>
    
    <div class="col">
        <div class="modal fade" id="exampleExtraLargeModal1" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Medical</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <div class="modal-body">
                    <form class="row g-2" action="{{ route('create_medical_pro') }}" method="post">
                        @csrf
                        
                        {{-- <div class="row"> --}}
                           
                            <div class="col-md-3">
                                <label for="inputFirstName" class="form-label">Select Company</label>

                                <select  class="form-select mb-3 " aria-label="Default select example" name="company"
                                    id="company11111">
                                    <option value="">Select</option>
                                    @foreach ($company as $add)
                                        <option value="{{ $add->id }}">
                                            {{ $add->Name }} </option>
                                    @endforeach

                                </select>

                            </div>
                          

                            <div class="col-md-3">
                                <label for="inputFirstName" class="form-label">Select Medicine*</label>

                                <select  class="form-select mb-3 " aria-label="Default select example" name="medicine"
                                    id="medicine1222">
                                    <option value="">Select</option>
                                    @foreach ($medi as $medic)
                                        <option value="{{ $medic->id }}">
                                            {{ $medic->medicine }} </option>
                                    @endforeach

                                </select>
                            </div>
                           
                            <div class="col-md-3">
                                <label for="inputFirstName" class="form-label">Batch No*</label>

                                <select class="form-select mb-3 " aria-label="Default select example" name="batch_no">
                                    <option value="">Select</option>
                                    @foreach ($batchno as $batch)
                                        <option value="{{$batch->id}}">{{$batch->batch_no}}</option>
                                    @endforeach

                                </select>

                            </div>
                         
                            <div class="col-md-1">
                                <label for="inputFirstName" class="form-label">MRP*</label>
                                <input type="text" name="mrp" id="mrp" value="0"
                                    placeholder="Enter MRP" class="form-control" required />
                            </div>

                            <div class="col-md-1">
                                <label for="inputFirstName" class="form-label">GST (%)*</label>
                                <input type="text" name="given_gst" id="given_gst" value="0"
                                    placeholder="Enter GST" class="form-control" required />
                            </div>

                            <div class="col-md-1">
                                <label for="inputFirstName" class="form-label">Purchase*</label>
                                <input type="text" name="purchase" id="purchase" value="0"
                                    placeholder="Enter Purchase" class="form-control" required />
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
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF;color:#030303; " type="text"
                                        class="form-control" name="default_scheme" id="default_scheme"
                                        value="0" readonly />
                                </td>
                                <td style="padding:5px;">

                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="gst" id="gst" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="amount_after_gst" id="amount_after_gst" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="retail_margin" id="retail_margin" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="ptr" id="ptr" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="stockist_margin" id="stockist_margin" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="pts" id="pts" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="management" id="management" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="promotion_cost" id="promotion_cost" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="scheme" id="scheme" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="scheme_amount_deduct" id="scheme_amount_deduct" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="transport_expiry_breakage" id="transport_expiry_breakage" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="tot" id="tot" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="marketing_working_cost" id="marketing_working_cost" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="company_profit" id="company_profit" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="percent_profit_to_investment" id="percent_profit_to_investment" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        value="" name="marketing_promotion_scheme"
                                        id="marketing_promotion_scheme" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        value="" name="percent_profit_to_ptr" id="percent_profit_to_ptr" />
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
                                        name="gst_ten" id="gst_ten" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="amount_after_gst_ten" id="amount_after_gst_ten" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="retail_margin_ten" id="retail_margin_ten" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="ptr_ten" id="ptr_ten" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="stockist_margin_ten" id="stockist_margin_ten" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="pts_ten" id="pts_ten" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="management_ten" id="management_ten" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="promotion_cost_ten" id="promotion_cost_ten" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="scheme_ten" id="scheme_ten" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="scheme_amount_deduct_ten" id="scheme_amount_deduct_ten" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="transport_expiry_breakage_ten" id="transport_expiry_breakage_ten" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="tot_ten" id="tot_ten" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="marketing_working_cost_ten" id="marketing_working_cost_ten" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="company_profit_ten" id="company_profit_ten" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="percent_profit_to_investment_ten"
                                        id="percent_profit_to_investment_ten" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        value="" name="marketing_promotion_scheme_ten"
                                        id="marketing_promotion_scheme_ten" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        value="" name="percent_profit_to_ptr_ten"
                                        id="percent_profit_to_ptr_ten" />
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
                                        name="gst_twenty" id="gst_twenty" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="amount_after_gst_twenty" id="amount_after_gst_twenty" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="retail_margin_twenty" id="retail_margin_twenty" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="ptr_twenty" id="ptr_twenty" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="stockist_margin_twenty" id="stockist_margin_twenty" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="pts_twenty" id="pts_twenty" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="management_twenty" id="management_twenty" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="promotion_cost_twenty" id="promotion_cost_twenty" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="scheme_twenty" id="scheme_twenty" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="scheme_amount_deduct_twenty" id="scheme_amount_deduct_twenty" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="transport_expiry_breakage_twenty"
                                        id="transport_expiry_breakage_twenty" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="tot_twenty" id="tot_twenty" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="marketing_working_cost_twenty" id="marketing_working_cost_twenty" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="company_profit_twenty" id="company_profit_twenty" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        name="percent_profit_to_investment_twenty"
                                        id="percent_profit_to_investment_twenty" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        value="" name="marketing_promotion_scheme_twenty"
                                        id="marketing_promotion_scheme_twenty" />
                                </td>
                                <td style="padding:5px;">
                                    <input style="background-color:#FFFFFF" type="text" class="form-control"
                                        value="" name="percent_profit_to_ptr_twenty"
                                        id="percent_profit_to_ptr_twenty" />
                                </td>
                            </tr>
                        </table>

                    </div>
                        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        </div>

        <div class="col">
            <div class="modal fade" id="exampleScrollableModal1" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Medicine</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    <div class="modal-body">
                        <form class="row g-2" action="{{ route('create_medicine_pro') }}" method="post">
                            @csrf
                            
                            <div class="row">
                               
                                <div class="col-md-6">
                                    <label class="form-label">Select Company<span style="color:red">*</span></label>
                                    <select class="form-select mb-3 location" aria-label="Default select example"
                                    name="select_company_id" >
                                    <option value="">Select</option>
                                            @foreach ($company as $adds)
                                     <option value="{{ $adds->id }}">
                                        {{$adds->Name}} </option>
                                     @endforeach
                                </select>
                                </div>
                              
                                <div class="col-md-6">
                                    <label for="inputFirstName" class="form-label">Medicine*</label>
                                    <input type="text" class="form-control" id="inputFirstName" placeholder="Medicine" name="medicine">
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            </div>

  <form  method="POST" action="{{route('create_promotor')}}" id="createpromotor_formid">
@csrf


<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 mx-auto" style="margin-top: -10%;">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">

                            <h5 class="mb-0 text-primary">Promotor Sales</h5>
                        </div>
                        <hr>
                        @if(count($errors)>0)
<ul class="alert alert-danger">
    @foreach($errors->all() as $error)
    <li>{{ $error }} </li>
    @endforeach
</ul>
@endif
                  <div class="row g-2">
                            <div class="col-md-1">
                                <label class="form-label">Year</label>
                                <select class="multiple-select" data-placeholder="Choose anything" id="year" name="year_id">
                                 {{-- <option>@php
                                    $currentYear = date('Y');
                               echo $currentYear; // Output: February
                               @endphp</option> --}}
                                 @foreach ($year as $years)
                                 <option value="{{ $years->id }}" 
                               >
                                 {{$years->year}} 
                             </option>
                                 @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label">Sale of Month*</label>
                               
                                
                                <select class="multiple-select" data-placeholder="Choose anything" id="month" name="sale_of_month">
                                  
                                    <option>  @php
                                        $currentMonth = date('F');
                                   echo $currentMonth; // Output: February
                                   @endphp
                                  </option>
                                  
                                    <option value="January">January</option>
                                    <option value="February" >February</option>
                                    <option value="March" >March</option>
                                    <option value="April" >April</option>
                                    <option value="May" >May</option>
                                    <option value="June" >June</option>
                                    <option value="july" >july</option>
                                    <option value="August" >August</option>
                                    <option value="September" >September</option>
                                    <option value="October" >October</option>
                                    <option value="November" >November</option>
                                    <option value="December" >December</option>


                                </select>

                            </div>

                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label">Select Company*</label>

                                <select class="multiple-select companystokist medicaleschme" data-placeholder="Choose anything" id="company" name="company" >
                                    <option value="">Select</option>
                                    @foreach ($company as $companys)
                                    <option value="{{ $companys->id }}">
                                       {{$companys->Name}} </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-md-1" style="margin-top:3%;">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleSmallModal"><i class="fadeIn animated bx bx-plus"></i></button>

                            </div>	

                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label">Select Marketing</label>

                                <select class="multiple-select" data-placeholder="Choose anything" id="market" name="market">
                                    <option value="">Select</option>
                                    
                                </select>

                            </div>

                            <div class="col-md-1" style="margin-top:3%;">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleLargeModal"><i class="fadeIn animated bx bx-plus"></i></button>

                            </div>	
                            

                                                       <div class="col-md-2">
                                <label for="inputFirstName" class="form-label">Select Doctor*</label>

                                <select class="multiple-select" data-placeholder="Choose anything" id="doctor" name="doctor">
                                    <option value="">Select</option>
                                    @foreach ($doctor as $doctors)
                                    <option value="{{ $doctors->id }}">
                                       {{$doctors->allotted_dr_name}} </option>
                                    @endforeach

                                </select>

                            </div>

                            <div class="col-md-1" style="margin-top:3%;">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleLargeModal2"><i class="fadeIn animated bx bx-plus"></i></button>

                            </div>	
                            

                            {{-- <div class="col-md-3">
                                <label for="inputFirstName" class="form-label">Select Stokist*</label>

                                <select class="multiple-select companystokist" data-placeholder="Choose anything" id="stockist" name="stockist">
                                    <option value="">Select</option>
                                    @foreach ($stockist as $stockists)
                                    <option value="{{ $stockists->id }}">
                                       {{$stockists->stockist}} </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-md-3">
                                <label for="inputFirstName" class="form-label">Select Medical*</label>

                                <select class="multiple-select 
								" data-placeholder="Choose anything" id="medical" name="medical">
                                    <option value="">Select</option>
                                    {{-- @foreach ($medical as $medicals)
                                    <option value="{{ $medicals->id }}">
                                       {{$medicals->medical}} </option>
                                    @endforeach --}}
                                {{-- </select>

                            </div> --}}
                     

                            <div class="col-md-2">
                                <label for="inputFirstName" class="form-label">Select Scheme % *</label>

                                 <input type="text" class="form-control" id="scheme1" placeholder="scheme" name="sheme">

                            </div>
                    </div>




                            


<br>
                        <br>
<hr>
<br>
<div class="row g-2">
    <div class="col-md-2">
        <label for="inputFirstName" class="form-label">Select Stokist*</label>

        <select class="multiple-select companystokist" data-placeholder="Choose anything" id="stockist" name="stockist">
            <option value="">Select</option>
            @foreach ($stockist as $stockists)
            <option value="{{ $stockists->id }}">
               {{$stockists->stockist}} </option>
            @endforeach
        </select>

    </div>

    <div class="col-md-1" style="margin-top:3%;">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleScrollableModal"><i class="fadeIn animated bx bx-plus"></i></button>

    </div>	

    <div class="col-md-2">
        <label for="inputFirstName" class="form-label">Select Medical*</label>

        <select class="multiple-select 
        " data-placeholder="Choose anything" id="medical" name="medical">
            <option value="">Select</option>
         
        </select>

    </div>

    <div class="col-md-1" style="margin-top:3%;">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal1
        "><i class="fadeIn animated bx bx-plus"></i></button>

    </div>	

    <div class="col-md-2">
        <label for="inputFirstName" class="form-label">Select Medicine*</label>

        <select class="multiple-select medicines" data-placeholder="Choose anything" id="medicine" >
            <option value="">Select</option>
            
        </select>

    </div>

    <div class="col-md-1" style="margin-top:3%;">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleScrollableModal1"><i class="fadeIn animated bx bx-plus"></i></button>

    </div>	
    <div class="col-md-3">
        <label for="inputFirstName" class="form-label">Select Batch*</label>

        
        <input type="text" class="form-control" id="batch" placeholder="batch" name="batch">
       

    </div>
    
    <div class="col-md-2">
        <label for="inputFirstName" class="form-label">PTR*</label>
        {{-- <input type="text" class="form-control" id="ptr1" placeholder="PTR" name="ptr1"> --}}
        <input type="text" id="ptr1" class="form-control "> 
   
    </div>
    <div class="col-md-2">
        <label for="inputFirstName" class="form-label">M+P+S*</label>
        {{-- <input type="text" class="form-control" id="mps1" placeholder="M+P+S" name="mps1"> --}}
        <input type="text" id="mps1"  class="form-control "> 

    </div>


    <div class="col-md-2">
        <label for="inputFirstName" class="form-label">QNTY*</label>
        <input type="text" class="form-control" id="qnty" placeholder="QNTY" >
    </div>

   

    <div class="col-md-2">
        <label for="inputFirstName" class="form-label">QNTY*(M+P+S) Total 1*</label>
        <input type="text" class="form-control" id="mpsqnty" placeholder="QNTY*(M+P+S) Total 1" >
    </div>

    <div class="col-md-2">
        <label for="inputFirstName" class="form-label">(PTR*QNTY) Total 2*</label>
        <input type="text" class="form-control" id="ptrqnty" placeholder="(PTR*QNTY) Total 2" >
    </div>

    <div class="col-md-2" style="padding:8px" ><br>
        <button type="button" class="btn btn-primary px-3 add-row "><i class="fadeIn animated bx bx-plus"></i>Add </button>
    </div>
</div>


                            <div style="overflow-x: scroll;">
								
								<table style="width:100%; margin-top:4%;" id="table">
									<tr align="center">
										{{-- <th width="5%">Sr. No.</th> --}}
                                        <th width="">Stokist</th>
                                        <th width="10%">Medical</th>
										<th width="10%">Medicine</th>
                                        <th width="10%">Batch No</th>
										<th width="10%"> PTR </th>
										<th width="10%">M+P+S</th>
										<th width="10%">QNTY</th>
										{{-- <th width="10%">Batch No</th> --}}
										<th width="10%">QNTY*(M+P+S)<br> Total 1  </th>
										<th width="10%">(PTR*QNTY)<br> Total 2  </th>
                                        <th width="5%">Action</th>
									</tr>
									{{-- <tr align="center" id="scheme_data"> --}}
                                        <tbody class="add_more">
                                            

                                        </tbody>
                          

							</div>

									   
					
							<div >
								<table class="table table-bordered " style="width:30%; margin-top:2%; margin-left:70%;" id="tablegrand">
									<thead class="t">
										<tr class="t">
											<th scope="col" class="t">Grand Total 1 : <input type="text" value="0" id="grandtotal1" name="grand_total1"></th>
											<th scope="col" class="t">Grand Total 2 : <input type="text" value="0" id="grandtotal2" name="grand_total2"></th>
										</tr>
									</thead>
									{{-- <tbody >
										

									</tbody> --}}
								</table>
							</div>
								
							</div>
							<div class="col-md-12">
								<div class="col-md-2" style="padding:8px; text-align: center; margin-left: 43%;" >
									<button type="button" class="btn btn-primary px-3" data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal" id="preview"><i class="fadeIn animated bx bx-plus"></i> Preview </button>
								</div>
							</div>
						</div>
					</div>
				</div>



				<!--end page wrapper -->
				<!--start overlay-->
				<div class="overlay toggle-icon"></div>

			</div>
        </form>

		


			<div class="modal fade" id="exampleExtraLargeModal" tabindex="-1" aria-hidden="true">
				<div class="modal-dialog modal-xl">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Medicine Sales Entry</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">	
                        <div class="row g-2">

							<div class="col-md-2">
								<label class="form-label">Year</label><br>
								<label style="color: black;" id="previewyear"></label>
							
							</div>
							<div class="col-md-2">
								<label for="inputFirstName" class="form-label">Sale of Month</label><br>
								<label style="color: black;" id="previewmonth"></label>

							</div>

							<div class="col-md-2">
								<label for="inputFirstName" class="form-label">Select Company</label><br>
								<label style="color: black;" id="previewcompany"></label>
					
							</div>

							<div class="col-md-2">
								<label for="inputFirstName" class="form-label">Select Marketing</label><br>
								<label style="color: black;" id="previewmarketing"></label>
							
							</div>
						
							<div class="col-md-2">
								<label for="inputFirstName" class="form-label">Select Doctor</label><br>
								<label style="color: black;" id="previewdoctor"></label>
							</div>


							{{-- <div class="col-md-2">
								<label for="inputFirstName" class="form-label">Select Stokist</label><br>
								<label style="color: black;" id="previewstockist"></label>
							</div>

							<div class="col-md-2">
								<label for="inputFirstName" class="form-label">Select Medical</label><br>
								<label style="color: black;" id="previewmedical"></label>

							</div> --}}
                            <div class="col-md-2">
								<label for="inputFirstName" class="form-label">Select Scheme % </label><br>
								<label style="color: black;" id="previewscheme"></label>
							</div>
                        </div>


							<div style="overflow-x: scroll;">
								<div id="previewtable">

                                </div>
								{{-- <table style="width:100%; margin-top:4%;" id="previewtable">
									<tr align="center">
										<th width="5%">Sr. No.</th>
										<th width="10%">Medicine</th>
										<th width="10%"> PTR </th>
										<th width="10%">M+P+S</th>
										<th width="10%">QTY</th>
										<th width="10%">Batch No</th>
										<th width="10%">ONTY*(M+P+S)<br> Total 1  </th>
										<th width="10%">(PTR*QNTY)<br> Total 2  </th>
									</tr>
								
								  </table> --}}
                                  <div id="previewgrandtable">
                                    {{-- <table class="table table-bordered " style="width:30%; margin-top:2%; margin-left:50%;" id="previewgrandtable">
                                        <thead class="t">
                                            <tr class="t">
                                                <th scope="col" class="t ">Grand Total 1 : <input type="text" value="0" id="previewgrandtotal1"></th>
                                                <th scope="col" class="t">Grand Total 2 : <input type="text" value="0" id="previewgrandtotal2"></th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            
                                        </tbody>
                                    </table> --}}
                                </div>
                                    
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
							<button type="button" class="btn btn-primary" id="confirm">Confirm</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end page wrapper -->
  <!--  -->
  {{-- modal --}}


  
  <div class="col">
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleSmallModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('create_company_pro')}}" method="post">
                    {{csrf_field()}}
                <div class="modal-body">
                    <div class="col-md-8">
                        <label for="inputFirstName" class="form-label">Company Name*</label>
                        <input type="text" class="form-control" id="inputFirstName" placeholder="Enter Name" name="name">
                    </div>
            
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save changes</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>



 
<div class="col">
<div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Marketing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form class="row g-2" action="{{ route('create_marketing_pro') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                   
                    <div class="col-md-3">
                        <label class="form-label">Select City<span style="color:red">*</span></label>
                        <select class="form-select mb-3 " aria-label="Default select example" 
                        name="city_id">
                        <option value="">Select City</option>
                        
                                @foreach ($city as $citys)
                         <option value="{{ $citys->id }}">
                            {{$citys->city}} </option>
                         @endforeach
                        
                            </select>
                                    
                   
                    </div>
                    <div class="col-md-3" >
                        <label class="form-label">Select Company<span style="color:red">*</span></label>
                        <select class="form-select mb-3 location" aria-label="Default select example"
                        name="select_company_id" >
                        <option value="">Select</option>
                                @foreach ($company as $adds)
                         <option value="{{ $adds->id }}">
                            {{$adds->Name}} </option>
                         @endforeach
                    </select>
                    </div>
                    <div class="col-md-3">
										<label for="inputFirstName" class="form-label">Marketing Name</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Enter Name" name="name">
									</div>
                                    <div class="col-md-3">
										<label for="inputFirstName" class="form-label">Mobile*</label>
										<input type="number" class="form-control" id="inputFirstName" placeholder=" Enter Mobile" name="mobile">
									</div>

									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Email*</label>
										<input type="email" class="form-control" id="inputFirstName" placeholder="Enter Email" name="email">
									</div>

									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Address*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder=" Enter Address" name="address">
									</div>

								

									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Username*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder=" Enter Username" name="username">
									</div>

									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Password*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder=" Enter Password" name="password">
									</div>

									<div class="col-md-3">
										<label for="formFile" class="form-label">PAN</label>
										<input class="form-control" type="file" id="formFile" name="image">
									</div>
									<div class="col-md-3">
										<label for="formFile" class="form-label">Aadhar Card</label>
										<input class="form-control" type="file" id="formFile" name="images">
									</div>

                 
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="update">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
<div class="col">
<div class="modal fade" id="exampleLargeModal2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Doctor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form class="row g-2" action="{{ route('create_doctor_pro') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                   
                    <div class="col-md-3">
                        <label for="inputFirstName" class="form-label">Allotted Client Name*</label>
                        <input type="text" class="form-control" id="inputFirstName" placeholder="Enter Allotted Dr. Name" name="allotted_dr_name">
                    </div>

                    
                    <div class="col-md-3">
                        <label for="inputFirstName" class="form-label">Pharmacy Address*</label>
                        <input type="text" class="form-control" id="inputFirstName" placeholder="Enter Address" name="hospital_address">
                    </div>

                    <div class="col-md-3">
                        <label for="inputFirstName" class="form-label">Mobile*</label>
                        <input type="number" class="form-control" id="inputFirstName" placeholder=" Enter Mobile" name="mobile">
                    </div>

                    <div class="col-md-3">
                        <label for="inputFirstName" class="form-label">Email*</label>
                        <input type="email" class="form-control" id="inputFirstName" placeholder="Enter Email" name="email">
                    </div>

                    <div class="col-md-3">
                        <label for="inputFirstName" class="form-label">Promoter Name*</label>
                        <input type="text" class="form-control" id="inputFirstName" placeholder=" Enter Promoter Name" name="promoter_name">
                    </div>

                    <div class="col-md-3">
                        <label for="inputFirstName" class="form-label">Account Number*</label>
                        <input type="number" class="form-control" id="inputFirstName" placeholder=" Enter Account Number" name="account_number">
                    </div>

                    <div class="col-md-3">
                        <label for="inputFirstName" class="form-label">IFSC*</label>
                        <input type="text" class="form-control" id="inputFirstName" placeholder=" Enter IFSC" name="ifsc">
                    </div>

                    <div class="col-md-3">
                        <label for="inputFirstName" class="form-label">PAN No.</label>
                        <input type="text" class="form-control" id="inputFirstName" placeholder=" PAN No." name="pan_no">
                    </div>

                


                    <div class="col-md-3">
                        <label for="inputFirstName" class="form-label">Username*</label>
                        <input type="text" class="form-control" id="inputFirstName" placeholder="  Enter Username" name="username">
                    </div>

                    <div class="col-md-3">
                        <label for="inputFirstName" class="form-label">Password*</label>
                        <input type="text" class="form-control" id="inputFirstName" placeholder=" Enter Password" name="password">
                    </div>
                

                    {{-- <select class="form-select mb-3 " aria-label="Default select example" 
                        name="city_id"> --}}
                    <div class="col-md-3">
                        <label class="form-label">Select City</label>
                        <select class="form-select "  name="city_id">
                        <option value="">Select</option>
                                @foreach ($city as $citys)
                         <option value="{{ $citys->id }}">
                            {{$citys->city}} </option>
                         @endforeach
                        </select>         
                        </select>
                    </div>
                
                
                    <div class="col-md-3">
                        <label for="inputFirstName" class="form-label">Select Medical</label>

                        <select  class="form-select" name="medical_id">
                        <option value="">Select</option>
                                @foreach ($medical as $medicals)
                         <option value="{{ $medicals->id }}">
                            {{$medicals->medical}} </option>
                         @endforeach
                        </select>         
                        
                    </div>
                    
                    
                    <div class="col-md-3" style="margin-top: 4%;">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" id="flexCheckDefault" name="Scheme[]">
                            <label class="form-check-label" for="flexCheckDefault">0% Scheme</label>
                        </div>
                    </div>

                    <div class="col-md-3" style="margin-top: 4%;">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="10" id="flexCheckDefault1" name="Scheme[]">
                            <label class="form-check-label" for="flexCheckDefault1">10% Scheme</label>
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-top: 4%;">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="20" id="flexCheckDefault2" name="Scheme[]">
                            <label class="form-check-label" for="flexCheckDefault2">20% Scheme</label>
                        </div>
                    </div>
                 
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="update">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div>

</div>



@stop
@section('js')

<script>

        $(document).ready(function()
        {
            $("#grandtotal1").val(0);
            $("#grandtotal2").val(0);
            $("#company").on('change',function(){
                $.ajax({
  url: "{{route('get_market_by_id')}}",
  type:'get',
  data:{ 
    id:$(this).val()
    },
  cache: false,
  success: function(result){
    $("#market").empty();
    $("#market").append(' <option value=""> Select </option>');
        $.each(result,function(a,b)
        {
            $("#market").append(' <option value="'+b.id+'">'+b.name+'</option>');
        })
  }
});
            })
   
    

//get medical from company and stokist
        
            $(".companystokist").on('change',function(){
                let doctor_id=$("#doctor").val();
                let stockist_id=$("#stockist").val(); 
                if(doctor_id && stockist_id){
                    $.ajax({
  url: "{{route('get_medical_by_id')}}",
  type:'get',
  data:{ 
    doctor_id:doctor_id,
    stockist_id:stockist_id
    },
  cache: false,
  success: function(result){
    console.log(stockist_id);
    $("#medical").empty();
    $("#medical").append(' <option value=""> Select </option>');
        $.each(result,function(a,b)
        {
            $("#medical").append(' <option value="'+b.id+'">'+b.medical+'</option>');
        })
  }
});
                }

           
            })
        })
        



      
            $(".medicaleschme").on('change',function(){
var company_id=$("#company").val()
var scheme=$("#scheme1").val()
if(company_id==''){
	// alert('please select company');
}


if(scheme==''){
	// alert('please select scheme');
}
		
				
                $.ajax({
  url: "{{route('get_medicine_by_id')}}",
  type:'get',
  data:{ 
    company_id:company_id,
	scheme:scheme//company me jo id hai jiski id hume chahiye wo leni hai
    },
  cache: false,
  success: function(result){
	console.log(result);
    $("#medicine").empty();
    $("#medicine").append(' <option value=""> Select </option>');
        $.each(result,function(a,b)
        {
            $("#medicine").append(' <option value="'+b.id+'">'+b.medicine+'</option>');
			
        })
  }
});
            })
   
			</script>



				<script>
  $(document).ready(function()
        {
	$(".medicines").on('change',function(){
        
var company_id=$("#company").val();
var scheme=$("#scheme1").val();
var medicine=$(this).val();
// alert(company_id);
// alert(scheme);
// alert(medicine);

if(company_id==''){
	// alert('please select company');
}


if(scheme==''){
	// alert('please select scheme');
}
if(medicine==''){
	// alert('please select medicine');
}	
			// alert(medicine);	
                $.ajax({
  url: "{{route('get_ptrmarketing_by_id')}}",
  type:'get',
  data:{ 
    company_id:company_id,
	scheme:scheme,
	medicine:medicine//company me jo id hai jiski id hume chahiye wo leni hai
    },
  cache: false,
  success: function(result){
	console.log(result);
    $("#ptr1").val(result.ptr);
    $("#mps1").val(result.marketing_promotion_scheme);
    $("#batch").val(result.batch_no);


    // $("#batch").empty();
    // $("#batch").append(' <option value=""> Select </option>');
    //     $.each(result,function(a,b)
    //     {
    //         $("#batch").append(' <option value="'+b.id+'">'+b.batch_no+'</option>');
			
    //     })

 
      
  }
});
            })
   


		})

	


    </script>





{{-- <script>
    $(document).ready(function()
          {
      $("#medicine").on('change',function(){
  var company_id=$("#company").val()
  var scheme=$("#scheme").val()
  var medicine=$(this).val()
  
  if(company_id==''){
      // alert('please select company');
  }
  
  
  if(scheme==''){
      // alert('please select scheme');
  }
  if(medicine==''){
      // alert('please select medicine');
  }	
              // alert(medicine);	
                  $.ajax({
    url: "{{route('get_batch_by_id')}}",
    type:'get',
    data:{ 
      company_id:company_id,
      scheme:scheme,
      medicine:medicine
      },
    cache: false,
    success: function(result){
      console.log(result);
    $("#batch").val(result.batch_no);
    //   $("#batch").empty();
    //   $("#batch").append(' <option value=""> Select </option>');
    //       $.each(result,function(a,b)
    //       {
    //           $("#batch").append(' <option value="'+b.id+'">'+b.batch_no+'</option>');
              
    //       })
  
    
    }
  });
              })
     
  
  
          })
  
</script> --}}
  
<script>
    $(document).ready(function()
          {
      $("#qnty,#mps1,#ptr1").on('keyup',function(){
      
     var  qnty= parseFloat($('#qnty').val());
     var mps = parseFloat($('#mps1').val());
     var ptr =parseFloat($('#ptr1').val());
    //  console.log(ptr);
      $('#mpsqnty').val(qnty * mps); 
      $('#ptrqnty').val(qnty * ptr); 
     
  
       } )
      });
      
     </script> 



<script>
$(document).ready(function() {

    $(".add-row").click(function() {
        var stockist = $('#stockist option:selected').text();
        var medical = $('#medical option:selected').text();
        var medicine = $('#medicine option:selected').text();// .text()se text ayega id nh
        var ptr1 = $('#ptr1').val();
        var mps1 = $('#mps1').val();
        var qnty = $('#qnty').val();
        var batch = $('#batch').val();
        var mpsqnty = $('#mpsqnty').val();
        var ptrqnty = $('#ptrqnty').val();
        
        var grandtotal1 =$('#grandtotal1').val();
        var grandtotal2 =$('#grandtotal2').val();

        var total1= parseFloat(grandtotal1)+parseFloat(mpsqnty)
        var total2= parseFloat(grandtotal2)+parseFloat(ptrqnty)
        $('#grandtotal1').val(total1);
        $('#grandtotal2').val(total2);

            var markup =

                '<tr><td><input type="text" name="stockist[]" required="" style="border:none; width: 100%;" value="' + stockist + '"></td><td><input type="text" name="medical[]" required="" style="border:none; width: 100%;" value="' + medical + '"></td><td><input type="text" name="medicine[]" required="" style="border:none; width: 100%;" value="' + medicine + '"></td><td><input type="text" name="batch[]" style="border:none; width: 100%;" value="' +
                batch +
                '"></td><td><input type="text" name="ptr1[]" required="" style="border:none; width: 100%" value="' + ptr1 + '"></td><td><input type="text" name="mps1[]" required="" style="border:none; width: 100%;" value="' +
                mps1 +
                '"></td><td><input type="text" name="qnty[]" required="" style="border:none; width: 100%;" value="' +
                qnty +
                '"></td><td><input type="text" name="mpsqnty[]" required="" style="border:none; width: 100%;" value="' +
                mpsqnty +
                '"></td><td><input type="text" name="ptrqnty[]" required="" style="border:none; width: 100%;" value="' +
                ptrqnty +
                '"></i></td><td><button type="button" class="btn1 btn-outline-danger delete-row"><i class="bx bx-trash me-0"></i></button></td></tr>';


               
            $(".add_more").append(markup);
  
           $('#stockist').val('');
           $('#medical').val('');
           $('#medicine').val('');
          
            $('#batch').val('');
            $('#ptr1').val('');
            $('#mps1').val('');
            $('#qnty').val('');
         
            $('#mpsqnty').val('');
            $('#ptrqnty').val('');
            // $('#total_amount').val('');
            // final_calculations();
    
        }
        
    )
    // Find and remove selected table rows
    $("tbody").delegate(".delete-row", "click", function() {
        var mpsqnty=$(this).parents("tr").find('input[name="mpsqnty[]"]').val()
        var ptrqnty=$(this).parents("tr").find('input[name="ptrqnty[]"]').val()

        var grandtotal1 =$('#grandtotal1').val();
        var grandtotal2 =$('#grandtotal2').val();

        var total1= parseFloat(grandtotal1)-parseFloat(mpsqnty)
        var total2= parseFloat(grandtotal2)-parseFloat(ptrqnty)
        $('#grandtotal1').val(total1);
        $('#grandtotal2').val(total2);

        $(this).parents("tr").remove();

        // final_calculations();


    });

   
    $("#preview").on('click',function(){
var year=$('#year').find(':selected').text();
$('#previewyear').text(year);
var month=$('#month').find(':selected').text();
$('#previewmonth').text(month);
var company=$('#company').find(':selected').text();
$('#previewcompany').text(company);
var market=$('#market').find(':selected').text();
$('#previewmarketing').text(market);
var doctor=$('#doctor').find(':selected').text();
$('#previewdoctor').text(doctor);
// var stockist=$('#stockist').find(':selected').text();
// $('#previewstockist').text(stockist);
// var medical=$('#medical').find(':selected').text();
$('#previewmedical').text(medical);
var scheme=$('#scheme1').val();
$('#previewscheme').text(scheme);

// var table=$('#table').find().text();
// $('#previewtable').text(table);
$("#previewtable").empty();
var table=$("#table").clone();
$("#previewtable").append(table);

$("#previewgrandtable").empty();
var table2=$("#tablegrand").clone();
$("#previewgrandtable").append(table2);
      
    })

    $("#confirm").on('click',function(){
        $("#previewtable").empty();// array me data repeat hora tha islye preview table ko empty kiya
        $("#previewgrandtable").empty();
        $("#createpromotor_formid").submit();
    })


})
</script>


<script>

    $(document).ready(function()
    {
        $("#year option").filter(function(index) { return $(this).text() == new Date().getFullYear(); }).attr('selected', 'selected').change();// current date show hone ke liye 

        $("#doctor").on('change',function(){ // dr ke onchnge pe scheme milne ke liye
            $.ajax({
url: "{{route('get_scheme_by_id')}}",
type:'get',
data:{ 
doctor_id:$(this).val()
},
cache: false,
success: function(result){
    console.log(result);
    $("#scheme1").val(result.Scheme);

}
});
        })
    })
</script>





<script>
    $(document).ready(function() {
        var old_promotion_cost = 0;
        var old_promotion_cost_ten;
        var old_promotion_cost_twenty;

        $('#mrp,#given_gst,#purchase').keyup(function() {
            old_promotion_cost = $('#promotion_cost').val();
            old_promotion_cost_ten = $('#promotion_cost_ten').val();
            old_promotion_cost_twenty = $('#promotion_cost_twenty').val();

            var mrp = $('#mrp').val();
            var given_gst = $('#given_gst').val();
            var purchase = $('#purchase').val();

            var gst = (parseFloat(mrp / 100) * parseFloat(given_gst)).toFixed(2);
            $('#gst').val(gst);
            var amount_after_gst = (parseFloat(mrp) - parseFloat(gst)).toFixed(2);
            $('#amount_after_gst').val(amount_after_gst);
            var retail_margin = parseFloat(amount_after_gst / 100) * parseFloat(20);
            var rm = retail_margin.toFixed(2);
            $('#retail_margin').val(rm);
            var ptr = (parseFloat(amount_after_gst) - parseFloat(rm)).toFixed(2);
            $('#ptr').val(ptr);
            var stockist_margin = parseFloat(ptr / 100) * parseFloat(10);
            var sm = stockist_margin.toFixed(2);
            $('#stockist_margin').val(sm);
            var pts = (parseFloat(ptr) - parseFloat(sm)).toFixed(2);
            $('#pts').val(pts);
            var management = (parseFloat(pts / 100) * parseFloat(10)).toFixed(2);
            $('#management').val(management);
            var promotion_cost = (parseFloat(ptr / 100) * parseFloat(30)).toFixed(2);
            $('#promotion_cost').val(promotion_cost);
            var scheme = (parseFloat(purchase / 100) * parseFloat(20)).toFixed(2);
            $('#scheme').val(scheme);
            $('#scheme_amount_deduct').val(0);
            var transport_expiry_breakage = (parseFloat(purchase / 100) * parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage').val(transport_expiry_breakage);
            var tot = (parseFloat(pts) - parseFloat(management) - parseFloat(promotion_cost) -
                    parseFloat(purchase) - parseFloat(scheme) - parseFloat(transport_expiry_breakage))
                .toFixed(2);
            $('#tot').val(tot);
            var marketing_working_cost = (parseFloat(tot / 100) * parseFloat(75)).toFixed(2);
            $('#marketing_working_cost').val(marketing_working_cost);
            var company_profit = (parseFloat(tot) - parseFloat(marketing_working_cost)).toFixed(2);
            $('#company_profit').val(company_profit);
            var percent_profit_to_investment = ((parseFloat(company_profit) * parseFloat(100)) / (
                parseFloat(purchase) + parseFloat(scheme) + parseFloat(
                    transport_expiry_breakage))).toFixed(2);
            $('#percent_profit_to_investment').val(percent_profit_to_investment);
            var marketing_promotion_scheme = (parseFloat(promotion_cost) + parseFloat(
                marketing_working_cost) + parseFloat(scheme)).toFixed(2);
            $('#marketing_promotion_scheme').val(marketing_promotion_scheme);
            var percent_profit_to_ptr = ((parseFloat(marketing_promotion_scheme) * parseFloat(100)) /
                parseFloat(ptr)).toFixed(2);
            $('#percent_profit_to_ptr').val(percent_profit_to_ptr);
            //Scheme 10% Calculation

            var gst_ten = (parseFloat(mrp / 100) * parseFloat(given_gst)).toFixed(2);
            $('#gst_ten').val(gst_ten);
            var amount_after_gst_ten = (parseFloat(mrp) - parseFloat(gst_ten)).toFixed(2);
            $('#amount_after_gst_ten').val(amount_after_gst_ten);
            var retail_margin_ten = (parseFloat(amount_after_gst_ten / 100) * parseFloat(20));
            var rm_ten = retail_margin_ten.toFixed(2);
            $('#retail_margin_ten').val(rm_ten);
            var ptr_ten = (parseFloat(amount_after_gst_ten) - parseFloat(rm_ten)).toFixed(2);
            $('#ptr_ten').val(ptr_ten);
            var stockist_margin_ten = parseFloat(ptr_ten / 100) * parseFloat(10);
            var sm_ten = stockist_margin_ten.toFixed(2);
            $('#stockist_margin_ten').val(sm_ten);
            var pts_ten = (parseFloat(ptr_ten) - parseFloat(sm_ten)).toFixed(2);
            $('#pts_ten').val(pts_ten);
            var management_ten = (parseFloat(pts_ten / 100) * parseFloat(10)).toFixed(2);
            $('#management_ten').val(management_ten);
            var promotion_cost_ten = (parseFloat(ptr_ten / 100) * parseFloat(30)).toFixed(2);
            $('#promotion_cost_ten').val(promotion_cost_ten);
            var scheme_ten = (parseFloat(purchase / 100) * parseFloat(20)).toFixed(2);
            $('#scheme_ten').val(scheme_ten);
            var scheme_amount_deduct_ten = (parseFloat(scheme_ten / 2)).toFixed(2);
            $('#scheme_amount_deduct_ten').val(scheme_amount_deduct_ten);
            var transport_expiry_breakage_ten = (parseFloat(purchase / 100) * parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage_ten').val(transport_expiry_breakage_ten);
            var tot_ten = (parseFloat(pts_ten) - parseFloat(management_ten) - parseFloat(
                    promotion_cost_ten) - parseFloat(purchase) - parseFloat(scheme_ten) -
                parseFloat(transport_expiry_breakage_ten)).toFixed(2);
            $('#tot_ten').val(tot_ten);
            var marketing_working_cost_ten = (parseFloat(tot_ten / 100) * parseFloat(75)).toFixed(2);
            $('#marketing_working_cost_ten').val(marketing_working_cost_ten);
            var company_profit_ten = (parseFloat(tot_ten) - parseFloat(marketing_working_cost_ten))
                .toFixed(2);
            $('#company_profit_ten').val(company_profit_ten);
            var percent_profit_to_investment_ten = ((parseFloat(company_profit_ten) * parseFloat(100)) /
                (parseFloat(purchase) + parseFloat(scheme_ten) + parseFloat(
                    transport_expiry_breakage_ten))).toFixed(2);
            $('#percent_profit_to_investment_ten').val(percent_profit_to_investment_ten);
            var marketing_promotion_scheme_ten = (parseFloat(promotion_cost_ten) + parseFloat(
                marketing_working_cost_ten) + parseFloat(scheme_amount_deduct_ten)).toFixed(2);
            $('#marketing_promotion_scheme_ten').val(marketing_promotion_scheme_ten);
            var percent_profit_to_ptr_ten = ((parseFloat(marketing_promotion_scheme_ten) * parseFloat(
                100)) / parseFloat(ptr_ten)).toFixed(2);
            $('#percent_profit_to_ptr_ten').val(percent_profit_to_ptr_ten);


            //Scheme 20% Calculation
            var gst_twenty = parseFloat(mrp / 100) * parseFloat(given_gst);
            $('#gst_twenty').val(gst_twenty);
            var amount_after_gst_twenty = (parseFloat(mrp) - parseFloat(gst_twenty)).toFixed(2);
            $('#amount_after_gst_twenty').val(amount_after_gst_twenty);
            var retail_margin_twenty = parseFloat(amount_after_gst_twenty / 100) * parseFloat(20);
            var rm_twenty = retail_margin_twenty.toFixed(2);
            $('#retail_margin_twenty').val(rm_twenty);
            var ptr_twenty = (parseFloat(amount_after_gst_twenty) - parseFloat(rm_twenty)).toFixed(2);
            $('#ptr_twenty').val(ptr_twenty);
            var stockist_margin_twenty = parseFloat(ptr_twenty / 100) * parseFloat(10);
            var sm_twenty = stockist_margin_twenty.toFixed(2);
            $('#stockist_margin_twenty').val(sm_twenty);
            var pts_twenty = (parseFloat(ptr_twenty) - parseFloat(sm_twenty)).toFixed(2);
            $('#pts_twenty').val(pts_twenty);
            var management_twenty = (parseFloat(pts_twenty / 100) * parseFloat(10)).toFixed(2);
            $('#management_twenty').val(management_twenty);
            var promotion_cost_twenty = (parseFloat(ptr_twenty / 100) * parseFloat(30)).toFixed(2);
            $('#promotion_cost_twenty').val(promotion_cost_twenty);
            var scheme_twenty = (parseFloat(purchase / 100) * parseFloat(20)).toFixed(2);
            $('#scheme_twenty').val(scheme_twenty);
            $('#scheme_amount_deduct_twenty').val(0);
            var transport_expiry_breakage_twenty = (parseFloat(purchase / 100) * parseFloat(2)).toFixed(
                2);
            $('#transport_expiry_breakage_twenty').val(transport_expiry_breakage_twenty);
            var tot_twenty = (parseFloat(pts_twenty) - parseFloat(management_twenty) - parseFloat(
                    promotion_cost_twenty) - parseFloat(purchase) - parseFloat(scheme_twenty) -
                parseFloat(transport_expiry_breakage_twenty)).toFixed(2);
            $('#tot_twenty').val(tot_twenty);
            var marketing_working_cost_twenty = (parseFloat(tot_twenty / 100) * parseFloat(75)).toFixed(
                2);
            $('#marketing_working_cost_twenty').val(marketing_working_cost_twenty);
            var company_profit_twenty = (parseFloat(tot_twenty) - parseFloat(
                marketing_working_cost_twenty)).toFixed(2);
            $('#company_profit_twenty').val(company_profit_twenty);
            var percent_profit_to_investment_twenty = ((parseFloat(company_profit_twenty) * parseFloat(
                100)) / (parseFloat(purchase) + parseFloat(scheme_twenty) + parseFloat(
                transport_expiry_breakage_twenty))).toFixed(2);
            $('#percent_profit_to_investment_twenty').val(percent_profit_to_investment_twenty);
            var marketing_promotion_scheme_twenty = (parseFloat(promotion_cost_twenty) + parseFloat(
                marketing_working_cost_twenty)).toFixed(2);
            $('#marketing_promotion_scheme_twenty').val(marketing_promotion_scheme_twenty);
            var percent_profit_to_ptr_twenty = ((parseFloat(marketing_promotion_scheme_twenty) *
                parseFloat(100)) / parseFloat(ptr_twenty)).toFixed(2);
            $('#percent_profit_to_ptr_twenty').val(percent_profit_to_ptr_twenty);

        });

        $('#promotion_cost,#promotion_cost_ten,#promotion_cost_twenty').keyup(function() {

            var new_promotion_cost = $('#promotion_cost').val();
            var new_promotion_cost_ten = $('#promotion_cost_ten').val();
            var new_promotion_cost_twenty = $('#promotion_cost_twenty').val();

            var old_tot = $('#tot').val();
            var old_tot_ten = $('#tot_ten').val();
            var old_tot_twenty = $('#tot_twenty').val();

            var a = (parseFloat(old_promotion_cost) - parseFloat(new_promotion_cost) + parseFloat(
                old_tot)).toFixed(2);
            var b = (parseFloat(old_promotion_cost_ten) - parseFloat(new_promotion_cost_ten) +
                parseFloat(old_tot_ten)).toFixed(2);
            var c = (parseFloat(old_promotion_cost_twenty) - parseFloat(new_promotion_cost_twenty) +
                parseFloat(old_tot_twenty)).toFixed(2);
            //alert(a);
            $('#tot').val(a);
            $('#tot_ten').val(b);
            $('#tot_twenty').val(c);
            old_promotion_cost = new_promotion_cost;
            old_promotion_cost_ten = new_promotion_cost_ten;
            old_promotion_cost_twenty = new_promotion_cost_twenty;




        });

    });
</script>


@stop 

    
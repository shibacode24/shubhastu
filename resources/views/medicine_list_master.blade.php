@extends('layout')
@section('content')


<!--start page wrapper -->

<style>
	/* table, th, td {
	  border: 1px solid black;
	  
	} */

	.text{
font-size: 8px;
	}
	</style>
<div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col-md-12 mx-auto" style="margin-top: -10%;">
						<div class="card">

                            
                        <form class="row g-2"  method="get" action="{{route('medicine_master1')}}" >
									
                                    {{csrf_field()}}
							<div class="card-body">
								<div class="card-title d-flex align-items-center">
								
									<h5 class="mb-0 text-primary">Added Medicine</h5>
								</div>
								<hr>
							<div class="row g-2">

									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Select Company</label>
								
											<select class="multiple-select" data-placeholder="Choose anything" name="company" id="company" >
                                            <option value="">All</option>
                                                @foreach ($addcompanies as $add)
                                         <option value="{{ $add->id }}">
                                            {{$add->Name}} </option>
                                         @endforeach
										
											</select>
                                          
									</div>

									
                                    <div class="col-md-2" style="padding:8px" ><br>
                                        <button type="search" class="btn btn-primary px-3"><i class="lni lni-search-alt" id="search"></i> Search</button>
                                    </div>
        
                                    {{-- <div class="col-md-3" style="padding:8px" ><br>
                                        <button type="download" class="btn btn-primary px-3"><i class="lni lni-file"></i><i class="lni lni-remove-file"></i>Download</button>
                                    </div> --}}
                                    

                                    {{-- <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table id="example" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Sr. No.</th>
                                                            <th>medicine</th>  
                                                          
                                                            <th>company</th>
                                                            <th>default_scheme</th> 
                                                            <th>batch_no</th> 
                                                            <th>given_gst</th>
                                                            <th>purchase</th>  
                                                            <th>gst</th> 
                                                            <th>amount_after_gst</th> 
                                                            <th>retail_margin</th>
                                                            <th>ptr</th>  
                                                            <th>stockist_margin</th> 
                                                            <th>pts</th> 
                                                            <th>management</th>
                                                            <th>promotion_cost</th>  
                                                            <th>scheme</th> 
                                                            <th>mrp</th> 
                                                            <th>scheme_amount_deduct</th> 
                                                            <th>transport_expiry_breakage</th>
                                                            <th>tot</th>
                                                            <th>marketing_working_cost</th>
                                                            <th>company_profit</th>
                                                            <th>percent_profit_to_investment</th>
                                                            <th>marketing_promotion_scheme</th>
                                                            <th>percent_profit_to_ptr</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody> --}}
                                          {{-- @foreach ($medlist as rows($medicine, $Name)) --}}
                                          
                                          {{-- @foreach ($medlist as $medicine=>$rows)
                                           <tr>
                                            <td rowspan="3">{{$loop->index+1}}</td>
                                            <td rowspan="3">{{$medicine}}</td>
                                            @foreach ($rows as $row)
                                            <td>{{$loop->index==0 ? $row->Name : '' }}
                                             </td>         

                                                         
                                                                <td>{{$row->default_scheme}}</td>
                                                               
                                                                <td>{{$row->batch_no}}</td>
                                                                <td>{{$row->given_gst}}</td>
                                                                <td>{{$row->purchase}}</td>
                                                                <td>{{$row->gst}}</td>
                                                                <td>{{$row->amount_after_gst}}</td>
                                                                <td>{{$row->retail_margin}}</td>
                                                                <td>{{$row->ptr}}</td>
                                                                <td>{{$row->stockist_margin}}</td>
                                                                <td>{{$row->pts}}</td>
                                                                <td>{{$row->management}}</td>
                                                                <td>{{$row->promotion_cost}}</td>
                                                                <td>{{$row->scheme}}</td>
                                                                <td>{{$row->mrp}}</td>
                                                                <td>{{$row->scheme_amount_deduct}}</td>
                                                                <td>{{$row->transport_expiry_breakage}}</td>
                                                                <td>{{$row->tot}}</td>
                                                                <td>{{$row->marketing_working_cost}}</td>
                                                                <td>{{$row->company_profit}}</td>
                                                                <td>{{$row->percent_profit_to_investment}}</td>
                                                                <td>{{$row->marketing_promotion_scheme}}</td>
                                                                <td>{{$row->percent_profit_to_ptr}}</td>
                                                           
                                                            <td>
                                                                @if ($loop->index==0)
                                                                <a href="{{route('destroy-anew_medicine_master',$row->newmedicinemaster_id)}}">
                                                             <button type="button" class="btn1 btn-outline-danger"><i class='bx bx-trash me-0'></i></button>
                                                            </a> 
                                                                 @endif	
                                                            </td>
                                                        </tr>

                                                        @endforeach
                                                     

                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                               </div> 
                         </div>
                    </div>
               </div>   
            </div>
     </div>            
</div> --}}




<div class="overlay toggle-icon"></div>
<hr/>
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th ></th>
                        <th>Sr. No.</th>
                                                            <th>medicine</th>  
                                                          
                                                            <th>company</th>
                                                            {{-- <th>expiry_date</th>
                                                            <th>quantity</th>
                                                            <th>mrp</th> --}}
                                                            <th>default_scheme</th> 
                                                            <th>batch_no</th> 
                                                            <th>given_gst</th>
                                                            <th>purchase</th>  
                                                            <th>gst</th> 
                                                            <th>amount_after_gst</th> 
                                                            <th>retail_margin</th>
                                                            <th>ptr</th>  
                                                            <th>stockist_margin</th> 
                                                            <th>pts</th> 
                                                            <th>management</th>
                                                            <th>promotion_cost</th>  
                                                            <th>scheme</th> 
                                                            <th>mrp</th> 
                                                            <th>scheme_amount_deduct</th> 
                                                            <th>transport_expiry_breakage</th>
                                                            <th>tot</th>
                                                            <th>marketing_working_cost</th>
                                                            <th>company_profit</th>
                                                            <th>percent_profit_to_investment</th>
                                                            <th>marketing_promotion_scheme</th>
                                                            <th>percent_profit_to_ptr</th>
                                                            <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=0;
                        $j=1;
                        $k=1;
                    @endphp
                    @foreach ($medlist as $row)
                    <tr> 
                        <td>
                           
                        </td> <td>
                            @if($i==1 || $j==$i)
                            {{$k}} 
                            
                            @endif
                        </td>
                     <td>
                        @if($i==1 || $j==$i)
                        {{$row->medicine_id}} 
                        @endif
                    </td> 
					 {{-- <td>{{$row->medicine}}</td> --}}
                     <td>
                        @if($i==1 || $j==$i)
                        {{$row->Name}} 
                        @php
                            $j=$j+3;      
                            $k=$k+1;

                            @endphp
                        @endif
                        
                    </td>         
{{-- 
                     <td>{{$row->Name}}</td> --}}
                     {{-- <td>
                        @if($i==1 || $j==$i)
                        {{$row->expiry_date}} 
                        @php
                            $j=$j+3;      
                            $k=$k+1;

                            @endphp
                                @endif
                    </td>
                     <td>
                        @if($i==1 || $j==$i)
                        {{$row->quantity}} 
                        @php
                            $j=$j+3;      
                            $k=$k+1;

                            @endphp
                                @endif

                    </td>
                     <td>
                        @if($i==1 || $j==$i)
                        {{$row->mrp}}
                        @php
                            $j=$j+3;      
                            $k=$k+1;

                            @endphp
                                @endif

                    </td> --}}
                        <td>{{$row->default_scheme}}</td>
                                                               
                                                                <td>{{$row->batch_no}}</td>
                                                                <td>{{$row->given_gst}}</td>
                                                                <td>{{$row->purchase}}</td>
                                                                <td>{{$row->gst}}</td>
                                                                <td>{{$row->amount_after_gst}}</td>
                                                                <td>{{$row->retail_margin}}</td>
                                                                <td>{{$row->ptr}}</td>
                                                                <td>{{$row->stockist_margin}}</td>
                                                                <td>{{$row->pts}}</td>
                                                                <td>{{$row->management}}</td>
                                                                <td>{{$row->promotion_cost}}</td>
                                                                <td>{{$row->scheme}}</td>
                                                                <td>{{$row->mrp}}</td>
                                                                <td>{{$row->scheme_amount_deduct}}</td>
                                                                <td>{{$row->transport_expiry_breakage}}</td>
                                                                <td>{{$row->tot}}</td>
                                                                <td>{{$row->marketing_working_cost}}</td>
                                                                <td>{{$row->company_profit}}</td>
                                                                <td>{{$row->percent_profit_to_investment}}</td>
                                                                <td>{{$row->marketing_promotion_scheme}}</td>
                                                                <td>{{$row->percent_profit_to_ptr}}</td>
                                                           
                                                            <td>
                                                                <a href="{{route('edit-update_medicine_master',$row->newmedicinemaster_id)}}">
                                                                    <button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button></a>
                                                              
                                                            <a href="{{route('destroy-new_medicine_master',$row->newmedicinemaster_id)}}">
                                                             <button type="button" class="btn1 btn-outline-danger"><i class='bx bx-trash me-0'></i></button>
                                                              </a>
                                                                         
                                                          
                                                            </td>
                                                       
                                                        </tr>
                                                        @php
                                                        $i=$i+1;
                                                    @endphp
                                                        @endforeach
                                                     

                                                    
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
</div>


            	<!--end page wrapper -->
        @stop
        @section('js')
<script>
    $(document).ready(function(){
            var old_promotion_cost=0;
            var old_promotion_cost_ten;
            var old_promotion_cost_twenty;      
    
        $('#mrp,#given_gst,#purchase').keyup(function() {
            old_promotion_cost=$('#promotion_cost').val();
            old_promotion_cost_ten=$('#promotion_cost_ten').val();
            old_promotion_cost_twenty=$('#promotion_cost_twenty').val();
           
            var mrp=$('#mrp').val();
            var given_gst=$('#given_gst').val();
            var purchase=$('#purchase').val();
        
            var gst=(parseFloat(mrp/100)*parseFloat(given_gst)).toFixed(2);
             $('#gst').val(gst);
            var amount_after_gst=(parseFloat(mrp)-parseFloat(gst)).toFixed(2);
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
            //Scheme 10% Calculation

            var gst_ten=(parseFloat(mrp/100)*parseFloat(given_gst)).toFixed(2);
             $('#gst_ten').val(gst_ten);
            var amount_after_gst_ten=(parseFloat(mrp)-parseFloat(gst_ten)).toFixed(2);
            $('#amount_after_gst_ten').val(amount_after_gst_ten);
            var retail_margin_ten=(parseFloat(amount_after_gst_ten/100)*parseFloat(20));
            var rm_ten=retail_margin_ten.toFixed(2);
            $('#retail_margin_ten').val(rm_ten);
            var ptr_ten=(parseFloat(amount_after_gst_ten)-parseFloat(rm_ten)).toFixed(2);
            $('#ptr_ten').val(ptr_ten);
            var stockist_margin_ten=parseFloat(ptr_ten/100)*parseFloat(10);
            var sm_ten=stockist_margin_ten.toFixed(2);
            $('#stockist_margin_ten').val(sm_ten);
            var pts_ten=(parseFloat(ptr_ten)-parseFloat(sm_ten)).toFixed(2);
            $('#pts_ten').val(pts_ten);
            var management_ten=(parseFloat(pts_ten/100)*parseFloat(10)).toFixed(2);
            $('#management_ten').val(management_ten);
            var promotion_cost_ten=(parseFloat(ptr_ten/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost_ten').val(promotion_cost_ten);
            var scheme_ten=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme_ten').val(scheme_ten);
            var scheme_amount_deduct_ten=(parseFloat(scheme_ten/2)).toFixed(2);
            $('#scheme_amount_deduct_ten').val(scheme_amount_deduct_ten);
            var transport_expiry_breakage_ten=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage_ten').val(transport_expiry_breakage_ten);
            var tot_ten=(parseFloat(pts_ten)-parseFloat(management_ten)-parseFloat(promotion_cost_ten)-parseFloat(purchase)-parseFloat(scheme_ten)-parseFloat(transport_expiry_breakage_ten)).toFixed(2);
            $('#tot_ten').val(tot_ten);
            var marketing_working_cost_ten=(parseFloat(tot_ten/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost_ten').val(marketing_working_cost_ten);
            var company_profit_ten=(parseFloat(tot_ten)-parseFloat(marketing_working_cost_ten)).toFixed(2);
            $('#company_profit_ten').val(company_profit_ten);
            var percent_profit_to_investment_ten=((parseFloat(company_profit_ten)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_ten)+parseFloat(transport_expiry_breakage_ten))).toFixed(2);
            $('#percent_profit_to_investment_ten').val(percent_profit_to_investment_ten);
            var marketing_promotion_scheme_ten=(parseFloat(promotion_cost_ten)+parseFloat(marketing_working_cost_ten)+parseFloat(scheme_amount_deduct_ten)).toFixed(2);
            $('#marketing_promotion_scheme_ten').val(marketing_promotion_scheme_ten);
            var percent_profit_to_ptr_ten=((parseFloat(marketing_promotion_scheme_ten)*parseFloat(100))/parseFloat(ptr_ten)).toFixed(2);
            $('#percent_profit_to_ptr_ten').val(percent_profit_to_ptr_ten);


            //Scheme 20% Calculation
            var gst_twenty=parseFloat(mrp/100)*parseFloat(given_gst);
             $('#gst_twenty').val(gst_twenty);
            var amount_after_gst_twenty=(parseFloat(mrp)-parseFloat(gst_twenty)).toFixed(2);
            $('#amount_after_gst_twenty').val(amount_after_gst_twenty);
            var retail_margin_twenty=parseFloat(amount_after_gst_twenty/100)*parseFloat(20);
            var rm_twenty=retail_margin_twenty.toFixed(2);
            $('#retail_margin_twenty').val(rm_twenty);
            var ptr_twenty=(parseFloat(amount_after_gst_twenty)-parseFloat(rm_twenty)).toFixed(2);
            $('#ptr_twenty').val(ptr_twenty);
            var stockist_margin_twenty=parseFloat(ptr_twenty/100)*parseFloat(10);
            var sm_twenty=stockist_margin_twenty.toFixed(2);
            $('#stockist_margin_twenty').val(sm_twenty);
            var pts_twenty=(parseFloat(ptr_twenty)-parseFloat(sm_twenty)).toFixed(2);
            $('#pts_twenty').val(pts_twenty);
            var management_twenty=(parseFloat(pts_twenty/100)*parseFloat(10)).toFixed(2);
            $('#management_twenty').val(management_twenty);
            var promotion_cost_twenty=(parseFloat(ptr_twenty/100)*parseFloat(30)).toFixed(2);
            $('#promotion_cost_twenty').val(promotion_cost_twenty);
            var scheme_twenty=(parseFloat(purchase/100)*parseFloat(20)).toFixed(2);
            $('#scheme_twenty').val(scheme_twenty);
            $('#scheme_amount_deduct_twenty').val(0);
            var transport_expiry_breakage_twenty=(parseFloat(purchase/100)*parseFloat(2)).toFixed(2);
            $('#transport_expiry_breakage_twenty').val(transport_expiry_breakage_twenty);
            var tot_twenty=(parseFloat(pts_twenty)-parseFloat(management_twenty)-parseFloat(promotion_cost_twenty)-parseFloat(purchase)-parseFloat(scheme_twenty)-parseFloat(transport_expiry_breakage_twenty)).toFixed(2);
            $('#tot_twenty').val(tot_twenty);
            var marketing_working_cost_twenty=(parseFloat(tot_twenty/100)*parseFloat(75)).toFixed(2);
            $('#marketing_working_cost_twenty').val(marketing_working_cost_twenty);
            var company_profit_twenty=(parseFloat(tot_twenty)-parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#company_profit_twenty').val(company_profit_twenty);
            var percent_profit_to_investment_twenty=((parseFloat(company_profit_twenty)*parseFloat(100))/(parseFloat(purchase)+parseFloat(scheme_twenty)+parseFloat(transport_expiry_breakage_twenty))).toFixed(2);
            $('#percent_profit_to_investment_twenty').val(percent_profit_to_investment_twenty);
            var marketing_promotion_scheme_twenty=(parseFloat(promotion_cost_twenty)+parseFloat(marketing_working_cost_twenty)).toFixed(2);
            $('#marketing_promotion_scheme_twenty').val(marketing_promotion_scheme_twenty);
            var percent_profit_to_ptr_twenty=((parseFloat(marketing_promotion_scheme_twenty)*parseFloat(100))/parseFloat(ptr_twenty)).toFixed(2);
            $('#percent_profit_to_ptr_twenty').val(percent_profit_to_ptr_twenty);
            
        });

$('#promotion_cost,#promotion_cost_ten,#promotion_cost_twenty').keyup(function() {

            var new_promotion_cost=$('#promotion_cost').val();
            var new_promotion_cost_ten=$('#promotion_cost_ten').val();
            var new_promotion_cost_twenty=$('#promotion_cost_twenty').val();
           
            var old_tot=$('#tot').val();
            var old_tot_ten=$('#tot_ten').val();
            var old_tot_twenty=$('#tot_twenty').val();
           
            var a=(parseFloat(old_promotion_cost)-parseFloat(new_promotion_cost)+parseFloat(old_tot)).toFixed(2);
            var b=(parseFloat(old_promotion_cost_ten)-parseFloat(new_promotion_cost_ten)+parseFloat(old_tot_ten)).toFixed(2);
            var c=(parseFloat(old_promotion_cost_twenty)-parseFloat(new_promotion_cost_twenty)+parseFloat(old_tot_twenty)).toFixed(2);
            //alert(a);
            $('#tot').val(a);
            $('#tot_ten').val(b);
            $('#tot_twenty').val(c);
            old_promotion_cost=new_promotion_cost;
            old_promotion_cost_ten=new_promotion_cost_ten;
            old_promotion_cost_twenty=new_promotion_cost_twenty;




});

 });
</script>
<!-- <script type="text/javascript">
    $(document).ready( function () {
      var err = $("#success").val();
      $('#successmsg').hide()
      if(err==1)
      {
        $('#successmsg').show()
        $('#successmsg').fadeOut(5000)

     }
     

 } );

</script> -->
<script>
    $(document).ready(function(){
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
// alert(CSRF_TOKEN);
    $('#Add').on('click',function() {
        var company = $("#company").val();
        var medicine = $("#medicine").val();
        var mrp = $("#mrp").val();
        var given_gst = $("#given_gst").val();
        var purchase = $("#purchase").val();
        var gst = $("#gst").val();
        var amount_after_gst = $("#amount_after_gst").val();
        var retail_margin = $("#retail_margin").val();
        var ptr = $("#ptr").val();
        var stockist_margin = $("#stockist_margin").val();
        var pts = $("#pts").val();
        var management = $("#management").val();
        var promotion_cost = $("#promotion_cost").val();
        var scheme = $("#scheme").val();
        var default_scheme = $("#default_scheme").val();
        var scheme_amount_deduct = $("#scheme_amount_deduct").val();
        var transport_expiry_breakage = $("#transport_expiry_breakage").val();
        var tot = $("#tot").val();
        var marketing_working_cost = $("#marketing_working_cost").val();
        var company_profit = $("#company_profit").val();
        var percent_profit_to_investment = $("#percent_profit_to_investment").val();
        var marketing_promotion_scheme = $("#marketing_promotion_scheme").val();
        var percent_profit_to_ptr = $("#percent_profit_to_ptr").val();
        var gst_ten = $("#gst_ten").val();
        var amount_after_gst_ten = $("#amount_after_gst_ten").val();
        var retail_margin_ten = $("#retail_margin_ten").val();
        var ptr_ten = $("#ptr_ten").val();
        var stockist_margin_ten = $("#stockist_margin_ten").val();
        var pts_ten = $("#pts_ten").val();
        var management_ten = $("#management_ten").val();
        var promotion_cost_ten = $("#promotion_cost_ten").val();
        var scheme_ten = $("#scheme_ten").val();
        var default_scheme_ten = $("#default_scheme_ten").val();
        var scheme_amount_deduct_ten = $("#scheme_amount_deduct_ten").val();
        var transport_expiry_breakage_ten = $("#transport_expiry_breakage_ten").val();
        var tot_ten = $("#tot_ten").val();
        var marketing_working_cost_ten = $("#marketing_working_cost_ten").val();
        var company_profit_ten = $("#company_profit_ten").val();
        var percent_profit_to_investment_ten = $("#percent_profit_to_investment_ten").val();
        var marketing_promotion_scheme_ten = $("#marketing_promotion_scheme_ten").val();
        var percent_profit_to_ptr_ten = $("#percent_profit_to_ptr_ten").val();
        var gst_twenty = $("#gst_twenty").val();
        var amount_after_gst_twenty = $("#amount_after_gst_twenty").val();
        var retail_margin_twenty = $("#retail_margin_twenty").val();
        var ptr_twenty = $("#ptr_twenty").val();
        var stockist_margin_twenty = $("#stockist_margin_twenty").val();
        var pts_twenty = $("#pts_twenty").val();
        var management_twenty = $("#management_twenty").val();
        var promotion_cost_twenty = $("#promotion_cost_twenty").val();
        var scheme_twenty = $("#scheme_twenty").val();
        var default_scheme_twenty = $("#default_scheme_twenty").val();
        var scheme_amount_deduct_twenty = $("#scheme_amount_deduct_twenty").val();
        var transport_expiry_breakage_twenty = $("#transport_expiry_breakage_twenty").val();
        var tot_twenty = $("#tot_twenty").val();
        var marketing_working_cost_twenty = $("#marketing_working_cost_twenty").val();
        var company_profit_twenty = $("#company_profit_twenty").val();
        var percent_profit_to_investment_twenty = $("#percent_profit_to_investment_twenty").val();
        var marketing_promotion_scheme_twenty = $("#marketing_promotion_scheme_twenty").val();
        var percent_profit_to_ptr_twenty = $("#percent_profit_to_ptr_twenty").val();
      
$.ajax({
                                    url:'add_medicine',
                                    type:'post',
                                    data:{_token: CSRF_TOKEN,
                                            company:company,
                                            medicine:medicine,
                                            mrp:mrp,
                                            given_gst:given_gst,
                                            purchase:purchase,
                                            gst:gst,
                                            amount_after_gst:amount_after_gst,
                                            retail_margin:retail_margin,
                                            ptr:ptr,
                                            stockist_margin:stockist_margin,
                                            pts:pts,
                                            management:management,
                                            promotion_cost:promotion_cost,
                                            scheme:scheme,
                                            default_scheme:default_scheme,
                                            scheme_amount_deduct:scheme_amount_deduct,
                                            transport_expiry_breakage:transport_expiry_breakage,
                                            tot:tot,
                                            marketing_working_cost:marketing_working_cost,
                                            company_profit:company_profit,
                                            percent_profit_to_investment:percent_profit_to_investment,
                                            marketing_promotion_scheme:marketing_promotion_scheme,
                                            percent_profit_to_ptr:percent_profit_to_ptr,
                                            gst_ten:gst_ten,
                                            amount_after_gst_ten:amount_after_gst_ten,
                                            retail_margin_ten:retail_margin_ten,
                                            ptr_ten:ptr_ten,
                                            stockist_margin_ten:stockist_margin_ten,
                                            pts_ten:pts_ten,
                                            management_ten:management_ten,
                                            promotion_cost_ten:promotion_cost_ten,
                                            scheme_ten:scheme_ten,
                                            default_scheme_ten:default_scheme_ten,
                                            scheme_amount_deduct_ten:scheme_amount_deduct_ten,
                                            transport_expiry_breakage_ten:transport_expiry_breakage_ten,
                                            tot_ten:tot_ten,
                                            marketing_working_cost_ten:marketing_working_cost_ten,
                                            company_profit_ten:company_profit_ten,
                                            percent_profit_to_investment_ten:percent_profit_to_investment_ten,
                                            marketing_promotion_scheme_ten:marketing_promotion_scheme_ten,
                                            percent_profit_to_ptr_ten:percent_profit_to_ptr_ten,
                                            gst_twenty:gst_twenty,
                                            amount_after_gst_twenty:amount_after_gst_twenty,
                                            retail_margin_twenty:retail_margin_twenty,
                                            ptr_twenty:ptr_twenty,
                                            stockist_margin_twenty:stockist_margin_twenty,
                                            pts_twenty:pts_twenty,
                                            management_twenty:management_twenty,
                                            promotion_cost_twenty:promotion_cost_twenty,
                                            scheme_twenty:scheme_twenty,
                                            default_scheme_twenty:default_scheme_twenty,
                                            scheme_amount_deduct_twenty:scheme_amount_deduct_twenty,
                                            transport_expiry_breakage_twenty:transport_expiry_breakage_twenty,
                                            tot_twenty:tot_twenty,
                                            marketing_working_cost_twenty:marketing_working_cost_twenty,
                                            company_profit_twenty:company_profit_twenty,
                                            percent_profit_to_investment_twenty:percent_profit_to_investment_twenty,
                                            marketing_promotion_scheme_twenty:marketing_promotion_scheme_twenty,
                                            percent_profit_to_ptr_twenty:percent_profit_to_ptr_twenty
                                    },
                                    dataType:'json',
                                    success:function(data)
                                    {
                                        
$("#medicine").val('');
$("#mrp").val('');
$("#given_gst").val('');
$("#purchase").val('');
$("#gst").val('');
$("#amount_after_gst").val('');
$("#retail_margin").val('');
$("#ptr").val('');
$("#stockist_margin").val('');
$("#pts").val('');
$("#management").val('');
$("#promotion_cost").val('');
$("#scheme").val('');
$("#scheme_amount_deduct").val('');
$("#transport_expiry_breakage").val('');
$("#tot").val('');
$("#marketing_working_cost").val('');
$("#company_profit").val('');
$("#percent_profit_to_investment").val('');
$("#marketing_promotion_scheme").val('');
$("#percent_profit_to_ptr").val('');
$("#gst_ten").val('');
$("#amount_after_gst_ten").val('');
$("#retail_margin_ten").val('');
$("#ptr_ten").val('');
$("#stockist_margin_ten").val('');
$("#pts_ten").val('');
$("#management_ten").val('');
$("#promotion_cost_ten").val('');
$("#scheme_ten").val('');
$("#scheme_amount_deduct_ten").val('');
$("#transport_expiry_breakage_ten").val('');
$("#tot_ten").val('');
$("#marketing_working_cost_ten").val('');
$("#company_profit_ten").val('');
$("#percent_profit_to_investment_ten").val('');
$("#marketing_promotion_scheme_ten").val('');
$("#percent_profit_to_ptr_ten").val('');
$("#gst_twenty").val('');
$("#amount_after_gst_twenty").val('');
$("#retail_margin_twenty").val('');
$("#ptr_twenty").val('');
$("#stockist_margin_twenty").val('');
$("#pts_twenty").val('');
$("#management_twenty").val('');
$("#promotion_cost_twenty").val('');
$("#scheme_twenty").val('');
$("#scheme_amount_deduct_twenty").val('');
$("#transport_expiry_breakage_twenty").val('');
$("#tot_twenty").val('');
$("#marketing_working_cost_twenty").val('');
$("#company_profit_twenty").val('');
$("#percent_profit_to_investment_twenty").val('');
$("#marketing_promotion_scheme_twenty").val('');
$("#percent_profit_to_ptr_twenty").val('');
                                         
                                      }
                                     

                            });
});
});
</script>
<script> 
        $(function() { 
            $("input[type='text']").keyup(function() { 
                this.value = this.value.toLocaleUpperCase(); 
            }); 
        }); 
    </script>  
    <script> 
        $(function() { 
            $("input[type='text']").keyup(function() { 
                this.value = this.value.toLocaleUpperCase(); 
            }); 
        }); 


    </script> 
<script>
   $(document).ready(function(){
   
    $('#search').on('click',function() {
        var company = $("#company").val();
        // alert(1)
    })}
    )
    
</script>
{{-- <script>
$(document).ready(function() { 
    $('#example').DataTable( { dom: 'Bfrtip', buttons: ['excel']
     } ); } );
</script> --}}
@stop

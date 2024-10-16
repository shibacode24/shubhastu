@extends('layout')
@include('alerts')
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
    .hide-mps {
            display: none;
        }
</style>



<form  method="POST" action="{{route('create_secondary')}}" id="createpromotor_formid" enctype="multipart/form-data">
    @csrf
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-12 mx-auto" style="margin-top: -10%;">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">

                            <h5 class="mb-0 text-primary">Secondary Sales Entry</h5>
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
                            {{-- <option value="">@php
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

                                <select class="multiple-select" data-placeholder="Choose anything" id="month"
                                name="sale_of_month">

                                @php
                                            $selectedMonth = Session::has('sale_of_month') ? Session::get('sale_of_month') : date('F');
                                        @endphp
                                        @foreach (range(1, 12) as $monthNumber)
                                            @php
                                                $monthName = date('F', mktime(0, 0, 0, $monthNumber, 1));
                                            @endphp
                                            <option value="{{ $monthName }}" @if ($selectedMonth == $monthName) selected @endif>
                                                {{ $monthName }}
                                            </option>
                                        @endforeach

                            </select>

                            </div>

                            <div class="col-md-3">
                                <label for="inputFirstName" class="form-label">Select Company*</label>

                                <select class="multiple-select medicaleschme" data-placeholder="Choose anything" id="company" name="company">
                                    <option value="">Select</option>
                                    @foreach ($company as $companys)
                                    <option value="{{ $companys->id }}">
                                       {{$companys->Name}} </option>
                                    @endforeach

                                </select>

                            </div>

                            

                    

                            <div class="col-md-3">
                                <label for="inputFirstName" class="form-label">Select Stockist*</label>

                                <select class="multiple-select" data-placeholder="Choose anything" id="stockist" name="stockist">
                                    <option value="">Select</option>
                                    @foreach ($stockist as $stockists)
                                    <option value="{{ $stockists->id }}">
                                       {{$stockists->stockist}} </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-3">
                                <label for="inputFirstName" class="form-label">Sale Value*</label>
                                <input type="text" class="form-control medicals" placeholder="Enter Sale value" id="medical" name="medical" >
                            </div>
							 <div class="col-md-3">
                                <label for="inputFirstName" class="form-label">Upload PDF</label>
                                <input type="file" class="form-control medicals" placeholder="Upload PDF"  name="pdf" >
                            </div>

                        </div>

                       
            
<hr>

<!-- 
                            <div class="row g-2">

                                <div class="col-md-3">
                                    <label for="inputFirstName" class="form-label">Select Medicine*</label>
                            
                                    <select class="multiple-select medicines" data-placeholder="Choose anything" id="medicine" name="medicine">
                                        <option value="">Select</option>
                                        
                                    </select>
                            
                                </div>

                                <div class="col-md-2">
                                    <label for="inputFirstName" class="form-label">Select Batch*</label>
                            
                                    <select class="multiple-select batchno" data-placeholder="Choose anything" id="batch" name="batch" >
                                        <option value="">Select</option>
                                        
                                    </select>
                            
                                </div>
                                <div class="col-md-2">
                                    <label for="inputFirstName" class="form-label">Purchase Rate*</label>
                                    <input type="text" id="purchase" name="purchase"  class="form-control " placeholder="Purchase Rate"> 
                            
                                </div>
                                
                                <div class="col-md-2">
                                    <label for="inputFirstName" class="form-label">QNTY*</label>
                                    <input type="text" class="form-control" id="qnty" name="qnty" placeholder="QNTY" >
                                </div>

                               
                              
                            
                                <div class="col-md-2">
                                    <label for="inputFirstName" class="form-label">QNTY*Purchase*</label>
                                    <input type="text" class="form-control" id="mpsqnty" name="mpsqnty" placeholder="QNTY*Purchase" >
                                </div>
                             -->
                                
                            
                                <!-- <div class="col-md-1" style="padding:8px" ><br>
                                    <button type="button" class="btn btn-primary px-3 add-row "><i class="fadeIn animated bx bx-plus"></i></button>
                                </div>
                            </div> -->
                            
                            

                    <div style="overflow-x: scroll;">
                        
                        <table style="width:100%; margin-top:4%;" >
                            <tr align="center">
                                
                                <th width="20%">Medicine</th>
                                {{-- <th width="20%"> Batch No </th> --}}
                                @if (auth()->check())
                                <th  width="20%">Purchase Rate</th>    
                                @endif

                                <th width="20%">QTY</th>
                              
                                @if (auth()->check())
                                <th width="20%">QTY*Purchase</th>
                                @endif

                            </tr>
                          

                           <tbody id="medicine_append_row">
                                            

                                        </tbody>
                          

							</div>

									   
					
							<div >
								<table class="table table-bordered " style="width:30%; margin-top:2%; margin-left:65%;" id="">
									<thead class="t">
										<tr class="t">
											{{-- <th scope="col" class="t">Purchase Rate Total 1 : <input type="text" value="0" id="grandtotal2" name="grand_total1"></th> --}}
											<th class="{{ auth()->guard('marketings')->check()? 'hide-mps': '' }}" scope="col" class="t">(QTY*Purchase)Total 2 : <input type="text" value="0" id="grandtotal22" name="grand_total1"></th>
										</tr>
									</thead>
									
								</table>
                                <div class="col-md-2" style="padding:8px;">
                                    <button type="button" class="btn btn-primary px-3 add-row " align="right"><i
                                            class="fadeIn animated bx bx-plus"></i>Add</button>
                                </div>
							</div>
                           
                    </div>
                    
                    <div style="overflow-x: scroll;">

                        <table style="width:100%; margin-top:4%;" id="table">
                            <tr align="center">
                                {{-- <th width="5%">Sr. No.</th> --}}
                                <th width="22%">Stokist</th>
                                <th width="20%">Sale Value</th>
                                {{-- <th width="5%">Grand Total 1</th> --}}
                                <th class="{{ auth()->guard('marketings')->check()? 'hide-mps': '' }}" width="5%">Grand Total 2</th>
                                <th width="15%">Medicine</th>
                              
                                @if (auth()->check())
                                <th width="10%">Purchase Rate</th>
                                @endif
                                <th width="5%"> QTY </th>
                               
                                <th class="{{ auth()->guard('marketings')->check()? 'hide-mps': '' }}" width="8%">QTY*Purchase</th>
                              
                                {{-- <th width="5%">QNTY</th> --}}
                                {{-- <th width="10%">Batch No</th> --}}
                                {{-- <th width="10%">QNTY*(M+P+S)<br> Total 1 </th>
                                <th width="10%">(PTR*QNTY)<br> Total 2 </th> --}}
                                <th width="5%">Action</th>
                            </tr>
                            {{-- <tr align="center" id="scheme_data"> --}}
                            <tbody class="add_more">


                            </tbody>


                    </div>



                    <div>
                        <table class="table table-bordered " style="width:30%; margin-top:2%; margin-left:60%;"
                            id="tablegrand">
                            <thead class="t">
                                <tr class="t">
                                    <th scope="col" class="t">Sale Value Total 1 : <input type="text"
                                            readonly value="0" id="grandtotal2" name="grand_total2"></th>
                                    <th class="{{ auth()->guard('marketings')->check()? 'hide-mps': '' }}" scope="col" class="t">(QTY*Purchase)Total 2 : <input type="text"
                                            value="0" id="grandtotal1" readonly name="grand_total11"></th>
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
                    <div class="row g-2" id="appendbody">
                    </div>
                </div>
            </div>
        </div>



        <!--end page wrapper -->

        <div class="overlay toggle-icon"></div>

    </div>
</form>




  

<div class="modal fade" id="exampleExtraLargeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Secondary Sales Entry</h5>
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

                {{-- <div class="col-md-2">
                    <label for="inputFirstName" class="form-label">Select Stokist</label><br>
                    <label style="color: black;" id="previewstockist"></label>
                </div>

                <div class="col-md-2">
                    <label for="inputFirstName" class="form-label">Sale Value</label><br>
                    <label style="color: black;" id="previewmedical"></label>

                </div> --}}
                
            </div>


                <div style="overflow-x: scroll;">
                    <div id="previewtable">

                    </div>
                  
                      <div id="previewgrandtable">
                       
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


@stop
@section('js')

<script>
	
	$(document).on('focus','.quantity_class',function(){
    $("tr").css("background-color", "");
    $("tr").find("input").css("background-color", "");

// Set the background color of the parent tr to your desired color
$(this).closest("tr").css("background-color", "#adadad");
$(this).closest("tr").find("input").css("background-color", "#adadad");
})

	
    $("#grandtotal2").val(0);
$(document).ready(function()
    {

      
$("#medical").on('keyup',function(){

var company_id=$("#company").val();
// var stockist=$("#stockist").val();

// var medicine=$("#medicine").val()
if(company_id==''){
	// alert('please select company');
}


				
                $.ajax({
  url: "{{route('get_medicine_by_id')}}",
  type:'get',
  data:{ 
    company_id:company_id,
	// stockist:stockist
    },
  cache: false,
  success: function(result){
	console.log(result);


    $("#medicine_append_row").empty();
   
    var i=0;

    
        $.each(result,function(a,b)
        // alert(a);
        {
            
            $("#medicine_append_row").append(' <tr><td><input type="text" name="medicine[]"  class="form-control medicine medicine_' + i + '" value="' + b.medicine_id + '" readonly></td><td class="{{ auth()->guard('marketings')->check()? 'hide-mps': '' }}"><input type="text" class="form-control purchase_class batch_no_' + i + '" name="purchase[]" value="' + b.purchase + '" readonly></td><td><input type="text" value="0" name="qnty[]" class="form-control quantity_class ptr_class_' + i + '" tabindex="1"></td><td class="{{ auth()->guard('marketings')->check()? 'hide-mps': '' }}"><input type="text" value="0" name="qntypurchase[]" id="total_input'+a+'" class="form-control total2_class mps_class_' + i + '" readonly></td></tr>');
			
        
        i=i+1;
    })
  }
});
            })



            $(document).on('keyup','.quantity_class',function(){
        var grand_total=0;
                
        let quanity=parseFloat($(this).val());
        if(quanity>0){
        }else{
            quanity=0;
        }
        var total_row=$(".total2_class");
        $.each(total_row,function(a,b){
            grand_total=parseFloat(grand_total)+parseFloat($("#total_input"+a).val());
        })
        let purchase=$(this).parent().parent().find('.purchase_class').val();
        let total2=parseFloat(quanity)*parseFloat(purchase);
        $(this).parent().parent().find('.total2_class').val(total2.toFixed(2));
        $('#grandtotal22').val(grand_total.toFixed(2));
        $(".quantity_class").trigger('keyup');

    })

        });

</script>

<!-- <script>

    $(document).ready(function()
    {
$(".medicaleschme").on('change',function(){
    var company_id=$("#company").val()
   
    if(company_id==''){
        alert('please select company');
    }
         
                    $.ajax({
      url: "{{route('get_medicine_by_id')}}",
      type:'get',
      data:{ 
        company_id:company_id,
     
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

            })
                </script> -->







<!-- 
				<script>

$(document).ready(function()
{
	$(".medicines").on('change',function(){
var company_id=$("#company").val();

var medicine=$(this).val();

if(company_id==''){
	// alert('please select company');
}

if(medicine==''){
	// alert('please select medicine');
}	
			// alert(medicine);	
                $.ajax({
  url: "{{route('get_batch_no_by_id')}}",
  type:'get',
  data:{ 
    company_id:company_id,

	medicine:medicine//company me jo id hai jiski id hume chahiye wo leni hai
    },
  cache: false,
  success: function(result){
	console.log(result);
    $("#batch").empty();
    $("#batch").append(' <option value=""> Select </option>');
        $.each(result,function(a,b)
        {
            // console.log(b.id);
            $("#batch").append(' <option value="'+b.id+'">'+b.batch_no+'</option>');
			
        })

 
      
  }
});
            })
   


		})

	
       
                </script> -->
    

    {{-- <script>
        $(document).ready(function()
              {
          $(".medicines").on('change',function(){
      var company_id=$("#company").val()

      var medicine=$(this).val()
      
      if(company_id==''){
          // alert('please select company');
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
         
          medicine:medicine//company me jo id hai jiski id hume chahiye wo leni hai
          },
        cache: false,
        success: function(result){
          console.log(result);
      
          $("#batch").empty();
          $("#batch").append(' <option value=""> Select </option>');
              $.each(result,function(a,b)
              {
                  $("#batch").append(' <option value="'+b.id+'">'+b.batch_no+'</option>');
                  
              })
      
        
        }
      });
                  })
         
      
      
              })
      
    </script> --}}

<!-- <script>
    $(document).ready(function()
          {
      $("#qnty,#purchase").on('keyup',function(){
      
     var  qnty= parseFloat($('#qnty').val());
     var purchase = parseFloat($('#purchase').val());
    
    //  console.log(ptr);
      $('#mpsqnty').val(qnty * purchase); 

     
  
       } )
      });
    



          
     </script>  -->

<script>
    // $(document).ready(function() {
        // $("#year option").filter(function(index) { return $(this).text() == new Date().getFullYear(); }).attr('selected', 'selected').change();
        // $(".add-row").click(function() {
        //     var medicine = $('#medicine option:selected').text();// .text()se text ayega id nh
        //     var batch = $('#batch option:selected').text();
        //     var qnty = $('#qnty').val();
            
        //     var purchase = $('#purchase').val();
        //     var mpsqnty = $('#mpsqnty').val();//qnty*purchase
            
        //     var grandtotal1 =$('#grandtotal1').val();
     
    
        //     var total1= parseFloat(grandtotal1)+parseFloat(mpsqnty)
           
        //     $('#grandtotal1').val(total1);
          
    
        //         var markup =
        //             '<tr><td><input type="text" name="medicine[]" required="" style="border:none; width: 100%;" value="' + medicine + '"></td><td><input type="text" name="batch[]" style="border:none; width: 100%;" value="' +
        //             batch +
        //             '"></td><td><input type="text" name="purchase[]" required="" style="border:none; width: 100%" value="' + purchase + '"></td><td><input type="text" name="qnty[]" required="" style="border:none; width: 100%;" value="' +
        //             qnty +
        //             '"></td><td><input type="text" name="mpsqnty[]" required="" style="border:none; width: 100%;" value="' +
        //             mpsqnty +
        //             '"></td><td><button type="button" class="btn1 btn-outline-danger delete-row"><i class="bx bx-trash me-0"></i></button></td></tr>';
    
    
                   
        //         $(".add_more").append(markup);
    
        //         $('#medicine').val('');
        //         $('#batch').val('');
        //         $('#qnty').val('');
        //         $('#purchase').val('');
        //         $('#mpsqnty').val('');
             
        //         // $('#total_amount').val('');
        //         // final_calculations();
        
        //     }
            
        // )
        // // Find and remove selected table rows
        // $("tbody").delegate(".delete-row", "click", function() {
        //     var mpsqnty=$(this).parents("tr").find('input[name="mpsqnty[]"]').val()
          
    
        //     var grandtotal1 =$('#grandtotal1').val();
            
    
        //     var total1= parseFloat(grandtotal1)-parseFloat(mpsqnty)
           
        //     $('#grandtotal1').val(total1);
          
    
        //     $(this).parents("tr").remove();
    
        //     // final_calculations();
    
    
        // });

        // <script>
                $(document).ready(function() {
                    var append_no = 0;
                    $(".add-row").click(function() {
                            append_no++;
                            var dataall = document.getElementById(
                            "medicine_append_row"); // medicine_append_row upper ke table ki id
                            var rowCount = 0;
                            rowCount = dataall.querySelectorAll("tr")
                            .length; //table me jitni row create hori hai uska count milta hai.

                            // console.log(rowCount);
                            //         const myArray =(dataall);
                            // const count = countOccurrences(myArray, 2);
                            // console.log(count);
                            // console.log(dataall)
                            var stockist = $('#stockist option:selected').text();
                            var medical = $('#medical').val();
                            

                            var i;
                            for (i = 0; i < rowCount; i++) {
                                // console.log(i);

                                // var rowsss=$('#medicine_append_row').text();
                                // console.log(rowsss);

                                var medicine = $('.medicine_' + i + '').val();
                                var batch = $('.batch_no_' + i + '').val(); // .text()se text ayega id nh
                                var ptr1 = $('.ptr_class_' + i + '').val();
                                var mps1 = $('.mps_class_' + i + '').val();
                                // var qnty = $('.quantity_class_' + i + '').val();

                                // var mpsqnty = $('.total1_class_' + i + '').val();
                                // var ptrqnty = $('.total2_class_' + i + '').val();

                                var grandtotal1 = $('#grandtotal1').val();
                                // var grandtotal2 = $('#medical').val();

                                var total1 = parseFloat(grandtotal1) + parseFloat(mps1)
                                // var total2 = parseFloat(medical)
                                var grand_total=0;
                                let grandtotal2=$(this).parent().parent().find('.medicals').val();
                                var total_row=$(".medicals");
                              
                                $('#grandtotal1').val(total1.toFixed(2));

                                // program to display text 5 times


                                // looping from i = 1 to 5
                                // let total_input = '';
                                // if (i == 0) {
                                //     total_input = '<td rowspan="' + rowCount +
                                //         '"><input type="text" readonly name="grandtot1[]" required="" style="border:none; text-align:center; width: 100%;" value="' +
                                //         $("#grandtotal11").val() +
                                //         '"></i></td>';
                                // } else {
                                //     total_input =
                                //         '<td style="display:none"><input type="hidden" name="grandtot1[]" required="" style="border:none; text-align:center; width: 100%;" value="' +
                                //         $("#grandtotal11").val() +
                                //         '"></i></td>';
                                // }
                                let stockist_input = '';
                                if (i == 0) {
                                    stockist_input = '<td rowspan="' + rowCount +
                                        '"><input type="text" readonly name="stockist[]" required="" style="border:none; width: 100%;" value="' +
                                        stockist.trim() + ' "></td>'
                                    $("#stockist").val() +
                                        '"></i></td>';
                                } else {
                                    stockist_input =
                                        '<td style="display:none"> <input type=hidden" name="stockist[]" required="" style="border:none; width: 100%;" value="' +
                                        stockist.trim() + ' "></td>'
                                    $("#stockist").val() +
                                        '"></td>';
                                }
                                //ek hi bar name show krwane ke liye
                                let medical_input = '';
                                if (i == 0) {
                                    medical_input = '<td rowspan="' + rowCount +
                                        '"><input type="text" readonly name="medical[]" class="sale_Value" required="" style="border:none; width: 100%;" value="' +
                                        medical + '"></td>'
                                    $("#medical").val() +
                                        '"></i></td>';
                                } else {
                                    medical_input =
                                        '<td style="display:none"><input type="hidden"  name="medical[]" required="" style="border:none; width: 100%;" value="' +
                                        medical + '"></td>'
                                    $("#medical").val() +
                                        '"></i></td>';
                                }

                                let total2_input = '';
                                if (i == 0) {
                                    total2_input = '<td class="{{ auth()->guard('marketings')->check()? 'hide-mps': '' }}" rowspan="' + rowCount +
                                        '"><input type="text" readonly name="grand_total1[]" required="" style="border:none; text-align:center; width: 100%;" value="' +
                                        $("#grandtotal22").val() +
                                        '"></i></td>';
                                    //    $("#grandtotal22").val() +
                                    //             '"></i></td>'; 
                                } else {
                                    total2_input =
                                        '<td class="{{ auth()->guard('marketings')->check()? 'hide-mps': '' }}" style="display:none"><input type="hidden"  name="grand_total1[]" required="" style="border:none; text-align:center; width: 100%;" value="' +
                                        $("#grandtotal22").val() +
                                        '"></i></td>';
                                }


                                var markup =
                                    //trim() whitespace remove krne ke liye
                                    //direct input se read krne ke liye vale me $("#id").val() likhege
                                    //type=number  step="0.01"  stpep 0.01 se . wali value type krsakta hai or . ke bd sirf 2 digit hi type krskta hai
                                    '<tr>' + stockist_input + '' + medical_input +  '' +
                                    total2_input + ' <td><input type="hidden" name="append_no[]" value="' + append_no +
                                    '"><input type="text" readonly name="medicine[]" required="" style="border:none; width: 100%;" value="' +
                                    medicine +
                                    '"></td><td class="{{ auth()->guard('marketings')->check()? 'hide-mps': '' }}"><input type="text" readonly name="purchase[]" style="border:none; width: 100%;" value="' +
                                    batch +
                                    '"></td><td><input type="number" readonly step="0.01" name="qnty[]" required="" style="border:none; width: 100%" value="' +
                                    ptr1 +
                                    '"></td><td class="{{ auth()->guard('marketings')->check()? 'hide-mps': '' }}"><input readonly type="number" step="0.01" name="qntypurchase[]" required="" style="border:none; width: 100%;" value="' +
                                    mps1 +
                                    '"></td><td><button type="button" class="btn1 btn-outline-danger delete-row"><i class="bx bx-trash me-0"></i></button></td></tr>';


                                //                 const n = 5;
                                //                 for (let i = 1; i <= n; i++) {
                                //     console.log(markup);
                                // }

                                $(".add_more").append(markup);
                               

                                //    $('#stockist').val('');
                                // $('#medical').val('');
                                $('.medicine_' + i + '').val('');

                                $('.batch_no_' + i + '').val('');
                                $('.ptr_class_' + i + '').val('');
                                $('.mps_class_' + i + '').val('');
                                // $('quantity_class_' + i + '').val('');

                                // $('total1_class_' + i + '').val('');
                                // $('total2_class_' + i + '').val('');
                                // $('#total_amount').val('');
                                // final_calculations();
                                // $("#table1111").empty();
                            }
console.clear();
                            var total2_new = 0;
                            let total_row_new=$(".sale_Value");
                            $.each(total_row_new,function(a,b){
                                total2_new=parseFloat(total2_new)+parseFloat($(this).val());
                            })
                            $('#grandtotal2').val(total2_new.toFixed(2));

                            $("#medicine_append_row").empty();
                            $('#grandtotal11').val(0);
                            $('#grandtotal22').val(0);
                            //  $("#tablegrand1").empty();
                        })

                    

                    // Find and remove selected table rows
                    $("tbody").delegate(".delete-row", "click", function() {
                        var mpsqnty = $(this).parents("tr").find('input[name="mpsqnty[]"]').val()
                        var ptrqnty = $(this).parents("tr").find('input[name="ptrqnty[]"]').val()

                        var grandtotal1 = $('#grandtotal1').val();
                        var grandtotal2 = $('#grandtotal2').val();

                        var total1 = parseFloat(grandtotal1) - parseFloat(mpsqnty)
                        var total2 = parseFloat(grandtotal2) - parseFloat(ptrqnty)
                        $('#grandtotal1').val(total1);
                        $('#grandtotal2').val(total2);

//                         $(this).closest("tr").find("td[rowspan]").each(function() {
//   var rowspanValue = parseInt($(this).attr("rowspan"));
//   if (rowspanValue > 1) {
//     $(this).attr("rowspan", rowspanValue - 1);
//   } else {
//     $(this).removeAttr("rowspan");
//   }
// });

$(this).closest("tr").remove();

                        // final_calculations();


                    });


    
        $("#preview").on('click',function(){
var year=$('#year').find(':selected').text();
$('#previewyear').text(year);
var month=$('#month').find(':selected').text();
$('#previewmonth').text(month);
var company=$('#company').find(':selected').text();
$('#previewcompany').text(company);

// var stockist=$('#stockist').find(':selected').text();
// $('#previewstockist').text(stockist);
// var medical=$('#medical').val();
// $('#previewmedical').text(medical);//sale value


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


})</script>
   
   <!-- <script>
    $(document).ready(function() {
        // alert(1);
    $(".batchno").on('change',function(){
        
        var batch=$("#batch").val()
        
        var medicine=$("#medicine").val()
        if(batch==''){
          
        }
        
        if(medicine==''){
            // alert('please select scheme');
        }
                
                      $.ajax({
          url: "{{route('get_purchase_by_id')}}",
          type:'get',
          data:{ 
            batch:batch,
            medicine:medicine
            },
          cache: false,
          success: function(result){
            console.log(result);
            $("#purchase").val(result.purchase);
           
           
          }
        });
                    })
                })
             
                    </script> -->
                    <script>
  
                        $(document).ready(function() {
                                        $(document).on('change', '#company', function() {
                                           
                    
                                            var company_id = $("#company").val();
                                            // var stockist_id =$("#stockist option:selected").text();
                                            var sale_of_month = $("#month").val();
                                            var year_id = $("#year").val();
                    
                                            
                                            $.ajax({
                                                url: 'get_previous_added_data_form_secondary_sale',
                                                type: 'get',
                                                data: {
                                                    company_id: company_id,
                                                    // stockist_id: stockist_id,
                                                    year_id: year_id,
                                                    sale_of_month: sale_of_month,
                                                },
                                                dataType: 'json',
                                                success: function(data) {
                                                    $("#appendbody").empty();
                    
                                                    $("#appendbody").html(data);
                                                   
                                                }
                                            });
                    
                                        });
                                    });
                    </script>
    
      @stop
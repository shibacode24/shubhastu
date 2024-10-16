@extends('layout')
@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col-md-12 mx-auto" style="margin-top: -10%;">
						<div class="card">
							<div class="card-body">
								<div class="card-title d-flex align-items-center">
								
									<h5 class="mb-0 text-primary">Expense Entry</h5>
								</div>
								<hr>
								<form class="row g-2" method="post" action="{{route('create_expence_entry')}}">
									@csrf
									<div class="col-md-3">
										<div class="yearWrapper">
											<label class="form-label">Year*</label>
									
											<select class="multiple-select" data-placeholder="Choose anything" name="select_year">
												<option value="Select">Select</option>
												@foreach ($year as $medicals)
													<option value="{{ $medicals->id }}">
														{{ $medicals->year }} </option>
												@endforeach
											</select>
									
											</div>
									</div>
									<div class="col-md-3">
										<label  class="form-label">Month*</label>
								
                                        <select class="multiple-select" data-placeholder="Choose anything" id="month"
                                        name="select_month">

                                        @php
                                            $selectedMonth = Session::has('select_month') ? Session::get('select_month') : date('F');
                                        @endphp
                                        @foreach (range(1, 12) as $monthNumber)
                                            @php
                                                $monthName = date('F', mktime(0, 0, 0, $monthNumber, 1));
                                            @endphp
                                            <option value="{{ $monthName }}"
                                                @if ($selectedMonth == $monthName) selected @endif>
                                                {{ $monthName }}
                                            </option>
                                        @endforeach

                                    </select>

									</div>
								
									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Select Company*</label>
								
											<select class="multiple-select" data-placeholder="Choose anything" name="select_company">
												<option value="Select">Select</option>
												@foreach ($company as $medicals)
													<option value="{{ $medicals->id }}">
														{{ $medicals->Name }} </option>
												@endforeach
											
											</select>
									</div>

									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Select Category*</label>
								
											<select class="multiple-select" data-placeholder="Choose anything" name="select_category" id="category">
												<option value="Select">Select</option>
												@foreach ($category as $medicals)
													<option value="{{ $medicals->id }}">
														{{ $medicals->category }} </option>
												@endforeach
											
											</select>
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Select Expense*</label>
								
											<select class="multiple-select" data-placeholder="Choose anything" name=" " id="expense">
												<option value="Select">Select</option>
												
											</select>
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Amount</label>
										<input type="text" class="form-control" id="amount" placeholder="Amount" name="">

										
									</div>
									
									<div class="col-md-2" style="padding:8px" ><br>
										<button type="button" class="btn btn-primary px-3 add-row "><i class="fadeIn animated bx bx-plus"></i>Add </button>
									</div>
									
									
									<div class="col-md-12">
										<div class="row">
											{{-- <div class="col-md-3"></div> --}}
										<div class="col-md-6 " style="float-left">
											<table class="items_table table table-bordered width80" id="table">
												<thead>
													<tr class="filters">
														
													</tr>
												</thead>
												<tbody class="add_more">
												</tbody>
											</table>
										</div>
										</div>
									</div>
									<div class="col-md-12" style="margin-top:1vh;text-align:right" >
								       <button type="submit" class="btn btn-primary px-3"><i class="fadeIn animated bx bx-plus"></i> Submit  </button>
									</div>
								</form>
		
							</div>
		
						</div>
					</div>
				</div>
				

				
				<!--end page wrapper -->
				<!--start overlay-->
				<div class="overlay toggle-icon"></div>
				<hr/>
				<div class="col-md-12 mx-auto">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Sr. No.</th>
											<th>Year</th>  
											<th>Month</th>
											<th>Company</th>
											<th>Category</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($exp_entry as $exp_entrys)
											
									
										<tr>
											<td>{{$loop->index+1}}</td>
											<td>{{$exp_entrys->year}}</td>	
											<td>{{$exp_entrys->select_month}}</td>	
											<td>{{$exp_entrys->Name}}</td>	
											<td>{{$exp_entrys->category}}</td>							
											<td>
												<button type="button" class="btn btn-primary px-3 viewinfo"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleLargeModal"
                                                            id="{{ $exp_entrys->expense_entry_id }}">show</button>
												{{-- <a href="{{route('edit_expence_entry',$exp_entrys->id)}}">
												<button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button> </a> --}}
												{{-- <a href="{{route('destroy_expence_entry',$exp_entrys->expense_entry_id)}}">
												<button type="button" class="btn1 btn-outline-danger"><i class='bx bx-trash me-0'></i></button> </a> --}}
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
		</div>

		<div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
			<div class="modal-dialog modal-xl">
				<div class="modal-content">
					<div class="modal-header">
						{{-- <h5 class="modal-title">Medicine Sale Report</h5> --}}
						<button type="button" class="btn-close" data-bs-dismiss="modal"
							aria-label="Close"></button>
					</div>
					{{-- <form action="{{route('approvalemis')}}" method="post" >
						@csrf --}}
{{-- <input type="text" id="getrecords" name="loan_idsss"> --}}
					<div class="modal-body">
						<table class="table mb-0 table-striped">
							<thead>
								
								<tr>
									
									<th scope="col">Expense</th>
									<th scope="col">Amount</th>
								
								</tr>
							</thead>
							<tbody id="records">
							</tbody>
						</table>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		@stop
		@section('js')
		<script>

			$(document).ready(function()
			{
			   
				$("#category").on('change',function(){
					$.ajax({
		url: "{{route('get_expense_id')}}",
		type:'get',
		data:{ 
			// mobile_series:$(this).val()
			id:$(this).val()
			
		},
		cache: false,
		success: function(result){
			console.log(result);
			$("#expense").empty();
			$("#expense").append(' <option value=""> Select </option>');
				$.each(result,function(a,b)
				{
					$("#expense").append(' <option value="'+b.id+'">'+b.expense+'</option>');
					
				})
		
		}
		});
				})
			})
		</script>
		   
		

		   <script>
			$(document).ready(function() {
			
				$(".add-row").click(function() {
					var expense = $('#expense option:selected').text();
					var amount = $('#amount').val();
					var markup =
			
							'<tr><td><td><input type="text"  name="expence_head[]" required=""><input type="text"  name="category[]" required="" style="border:none; width: 100%;"><input type="text" name="expense[]" required="" style="border:none; width: 100%;" value="' + expense + '"></td><td><input type="text" name="amount[]" required="" style="border:none; width: 100%;" value="' + amount + '"></td><td><button type="button" class="btn1 btn-outline-danger delete-row"><i class="bx bx-trash me-0"></i></button></td></tr>';
							category
			           $(".add_more").append(markup);
			           $('#expense').val('');
					   $('#amount').val('');
					  
					}
					
				)
				// Find and remove selected table rows
				$("tbody").delegate(".delete-row", "click", function() {
					var mpsqnty=$(this).parents("tr").find('input[name="mpsqnty[]"]').val()
				    var grandtotal1 =$('#grandtotal1').val();
					var total1= parseFloat(grandtotal1)-parseFloat(mpsqnty)
				
					$('#grandtotal1').val(total1);
					$(this).parents("tr").remove();
			});
			
			});
		</script> 
			

			<script>
				$(document).ready(function() {
			$(".viewinfo").on('click',function(){
				 $("#getrecords").val($(this).attr('id'));
					$.ajax({
			url: "{{route('get_record')}}",
			type:'get',
			data:{ 
				expense_entry_id:$(this).attr('id')
			
			},
			cache: false,
			success: function(result){
				var recordss=result.module;
			
				 $("#records").empty();
			$.each(recordss,function(a,b)
			
					  {
						
						  $("#records").append('<tr><td>'+b.select_expense+'</td><td>'+b.amount+'</td></tr>');
						  
					  })
			}
			});
			})
			
			})
			
			</script>
			


    <script type="text/javascript">
        window.onload = function () {
            //Reference the DropDownList.
            var ddlYears = document.getElementById("ddlYears");

            //Determine the Current Year.
            var currentYear = (new Date()).getFullYear();

            //Loop and add the Year values to DropDownList.
            for (var i = 1950; i <= currentYear; i++) {
                var option = document.createElement("OPTION");
                option.innerHTML = i;
                option.value = i;
                ddlYears.appendChild(option);
            }
        };
    </script>
@stop
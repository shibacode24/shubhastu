@extends('layout')	
@section('content')
<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col-md-8 mx-auto" style="margin-top: -10%;">
						<div class="card">
							<div class="card-body">
								<div class="card-title d-flex align-items-center">
								
									<h5 class="mb-0 text-primary">Expense Head</h5>
								</div>
								<hr>
								<form class="row g-2" method="post" action="{{route('create_expence_head')}}">
									@csrf
									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Select Category*</label>
								
											<select class="multiple-select" data-placeholder="Choose anything" name="select_category">
												<option value="Select">Select</option>
												@foreach ($category as $categorys)
													<option value="{{ $categorys->id }}">
														{{ $categorys->category }} </option>
												@endforeach
											
											</select>
									</div>
									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Expense*</label>
										<input type="text" class="form-control" id="expense" placeholder="Expense" >
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
									<div class="col-md-12" style="margin-top:1vh;text-align:right;" >
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
				<div class="col-md-8 mx-auto">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Sr. No.</th>
											<th>category</th>
											{{-- <th>Expense</th>  --}}

											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($exp_head as $expence)
											
										
										<tr>
											<td>{{$loop->index+1}}</td>
											<td>{{$expence->category}}</td>
											{{-- <td>{{$expence->expense}}</td> --}}

											<td>
												<button type="button" class="btn btn-primary px-3 viewinfo"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleLargeModal"
                                                            id="{{ $expence->expense_head_id }}">show</button>
												{{-- <a href="{{route('edit_expence_head',$expence->id)}}">
												<button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button></a> --}}
												<a href="{{route('destroy_expence_head',$expence->expense_head_id)}}">
												<button type="button" class="btn1 btn-outline-danger"><i class='bx bx-trash me-0'></i></button></a> 
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
									{{-- <th scope="col">Amount</th> --}}
								
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
		@stop
		@section('js')
		<script>
			$(document).ready(function() {
			
				$(".add-row").click(function() {
					var expense = $('#expense').val();
					var markup =
			
							'<tr><td><input type="text" name="expense[]" required="" style="border:none; width: 100%;" value="' + expense + '"></td><td><button type="button" class="btn1 btn-outline-danger delete-row"><i class="bx bx-trash me-0"></i></button></td></tr>';

			           $(".add_more").append(markup);
			           $('#expense').val('');
					  
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
			url: "{{route('get_records')}}",
			type:'get',
			data:{ 
				expense_head_id:$(this).attr('id')
			
			},
			cache: false,
			success: function(result){
				var recordss=result.module;
			
				 $("#records").empty();
			$.each(recordss,function(a,b)
			
					  {
						
						  $("#records").append('<tr><td>'+b.expense+'</td></tr>');
						  
					  })
			}
			});
			})
			
			})
			
			</script>
			


		@stop
@extends('layout')
@include('alerts')
@section('content')

<!--start page wrapper -->
    <div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col-md-12 mx-auto" style="margin-top: -10%;">
						<div class="card">
							<div class="card-body">
								<div class="card-title d-flex align-items-center">
								
									<h5 class="mb-0 text-primary">Add Medicine </h5>
								</div>
								<hr>
								
								<form class="row g-2" method="post" action="{{route('create_medicine')}}">
                                    {{csrf_field()}}
									<div class="col-md-2"></div>
									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Select Company*</label>
								
											<select class="multiple-select" data-placeholder="Choose anything" name="select_company_id" >
                                            <option value="">Select</option>
                                                @foreach ($add as $adds)
                                         <option value="{{ $adds->id }}">
                                            {{$adds->Name}} </option>
                                         @endforeach
										
											</select>
										
										
											</select>

									</div>
									{{-- <div class="col-md-1" style="margin-top:3%;">
										<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleSmallModal"><i class="fadeIn animated bx bx-plus"></i></button>

									</div> --}}
									
									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Medicine*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Medicine" name="medicine">
									</div>
									{{-- <div class="col-md-1" style="margin-top:3%;">
										<button type="button" class="btn btn-primary px-3"><i class="fadeIn animated bx bx-plus"></i> </button>
									</div> --}}
						
									<div class="col-md-3" style="margin-top:3%;" >
								       <button type="submit" class="btn btn-primary px-3"><i class="fadeIn animated bx bx-plus"></i> Add  </button>
									</div>
								</form>



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
												<form action="{{route('create_company')}}" method="post">
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


								
							</div>
		
						</div>
					</div>
				</div>
				

				
				<!--end page wrapper -->
				<!--start overlay-->
				<div class="overlay toggle-icon"></div>
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Sr. No.</th>
										<th>Company</th>  
										<th>Medicine</th> 
										<th style="background-color: #fff">Action</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($med as $medi)
									<tr>
										<td>{{$loop->index+1}}</td>
										<td>{{$medi->Name}}</td>
										<td>{{$medi->medicine}}</td>
										
										<td style="background-color: #fff"><a href="{{route('edit-medicine',$medi->id)}}">
                                            <button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button></a>
                                            <a href="{{route('destroy-addedmedicine',$medi->id)}}">
                                             <button type="button" class="btn1 btn-outline-danger"><i class='bx bx-trash me-0'></i></button> </a>
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
		<!--end page wrapper -->
        @stop
		{{-- @section('js')
		<script>
			$(document).ready(function()
				  {
			  $(".save_company").click(function(){
		
						  $.ajax({
			url: "{{route('')}}",
			type:'get',
			data:{ 
			  company_id:company_id,
			  
			  },
		
		  });
					  })
			 
		   })
		   </script> --}}
		  
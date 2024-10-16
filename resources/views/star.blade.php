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
								
									<h5 class="mb-0 text-primary">Star</h5>
								</div>
								<hr>
								<form class="row g-2" method="POST" action="{{route('create_star')}}">
									@csrf
									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Select Company*</label>
								
										<select class="form-select mb-3 location" aria-label="Default select example"
										name="select_company" >
										<option value="">Select</option>
												@foreach ($addcompanies as $adds)
										 <option value="{{ $adds->id }}">
											{{$adds->Name}} </option>
										 @endforeach
										</select>
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Name of Star*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Name of Star" name="name_of_star">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Bank Name*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Bank Name"   name="bank_name">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Account No.*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Account No"  name="account_no">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">IFSC Code*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="IFSC Code" name="ifsc_code">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">PAN No.*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="PAN No" name="pan_no">
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
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Sr. No.</th>
										<th>Company</th>  
										<th>Name of Star</th> 
										<th>Bank Name</th>
										{{-- <th>IFSC Code</th> --}}
										<th>Account No</th>
										<th>IFSC Code</th>
										<th>PAN No</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($star as $st)
										
								
									<tr>
										<td>{{$loop->index+1}}</td>
										<td>{{$st->Name}}</td>
										<td>{{$st->name_of_star}}</td>
										<td>{{$st->bank_name}}</td>
										<td>{{$st->account_no}}</td>
										<td>{{$st->ifsc_code}}</td>
										<td>{{$st->pan_no}}</td>
										{{-- <td>{{$st->}}</td> --}}
										
										<td>
                                            <a href="{{route('edit_star',$st->id)}}">
											<button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button> </a>
											<a href="{{route('destroy_star',$st->id)}}">
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
		<!--start overlay-->
	@stop
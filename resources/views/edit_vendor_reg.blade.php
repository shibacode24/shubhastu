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
								
									<h5 class="mb-0 text-primary">Vendor Registration</h5>
								</div>
								<hr>
								<form class="row g-2" action="{{route('update_vendor')}}" method="POST">
                                    <input type="hidden" name="id" value="{{$ven->id}}">
									@csrf
									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Vendor Name*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Employee Name" name="vendor_name" value="{{$ven->vendor_name}}">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Contact No.*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Contact No." name="contact_no" value="{{$ven->contact_no}}">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Email Id*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Email Id"  name="email_id" value="{{$ven->email_id}}">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Address*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Address" name="address" value="{{$ven->address}}">
									</div>


						
									<div class="col-md-2" style="margin-top:3.4%;" >
								       <button type="submit" class="btn btn-primary px-3"><i class="fadeIn animated bx bx-plus"></i>Update  </button>
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
										<th>Vendor Name</th>  
										<th>Contact No.</th> 
										<th>Email Id</th>
										<th>Address</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($ven_reg as $vend)
										
								
									<tr>
										<td>{{$vend->index+1}}</td>
										<td>{{$vend->vendor_name}}</td>
										<td>{{$vend->contact_no}}</td>
										<td>{{$vend->email_id}}</td>
										<td>{{$vend->address}}</td>
										
										<td>
                                             <a href="{{route('edit_vendor',$vend->id)}}">
											<button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button></a>
											<a href="{{route('destroy_vendor',$vend->id)}}">
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
		<!--end page wrapper -->
	@stop
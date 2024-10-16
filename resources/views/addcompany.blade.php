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
								
									<h5 class="mb-0 text-primary">Add Company </h5>
								</div>
								<hr>

								
								<form class="row g-2" method="post" action="{{route('create-company')}}">
									{{csrf_field()}}
									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Company Name*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Enter Name" name="name">
									</div>

									
									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Address*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Enter Address" name="address">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Contact Person Name*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Enter Contact Person Name" name="contact_person">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Mobile*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder=" Enter Mobile" name="mobile">
									</div>

			
									<div class="col-md-2" style="padding:8px" ><br>
										<button type="submit" class="btn btn-primary px-3"><i class="fadeIn animated bx bx-plus"></i>Add </button>
									</div>
								</form>
		
							</div>
		
						</div>
					</div>
				</div>
				<hr/>

				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Sr. No.</th>
										<th> Company Name</th>  
										<th>Address</th> 
										<th>Contact Person</th> 
										<th>Mobile</th>
										<th style="background-color: #fff">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($company as $companys)
									<tr>
										<td>{{$loop->index+1}}</td>
										<td>{{$companys->Name}}</td>
										<td>{{$companys->Address}} </td>
										<td>{{$companys->Contact_Person}}</td>
										<td>{{$companys->Mobile}}</td>
										<td style="background-color: #fff"> 
											<a href="{{route('edit-company',$companys->id)}}">
											<button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button></a>
											<a href="{{route('destroy-company',$companys->id)}}"> 
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

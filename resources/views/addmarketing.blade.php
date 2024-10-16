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
								
									<h5 class="mb-0 text-primary">Marketing Registration</h5>
								</div>
								<hr>

								
								<form class="row g-2" method="POST" action="{{route('create_marketing')}}" enctype="multipart/form-data">
                                  {{csrf_field()}}
									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Select City*</label>
								
											<select class="multiple-select" data-placeholder="Choose anything" multiple="multiple" name="city_id[]">
											<option value="">Select</option>
                                                @foreach ($city as $citys)
                                         <option value="{{ $citys->id }}" @if (Session::has('city') && in_array($citys->id, Session::get('city'))) selected @endif>
                                            {{$citys->city}} </option>
                                         @endforeach
										
											</select>
														
									</div>

									
									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Select Company*</label>
								
											<select class="multiple-select" data-placeholder="Choose anything" multiple="multiple" name="select_company_id[]">
											<option value="" disabled>Select</option>
                                                @foreach ($addcompanies as $add)
                                         <option value="{{ $add->id }}" @if (Session::has('company') && in_array($add->id, Session::get('company'))) selected @endif>
                                            {{$add->Name}} </option>
                                         @endforeach
										
											</select>
										
											</select>
														
									</div>

									
									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Marketing Name</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Enter Name" name="name">
									</div>

									
									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Mobile*</label>
										<input type="number" class="form-control" id="inputFirstName" placeholder=" Enter Mobile" name="mobile">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Email*</label>
										<input type="email" class="form-control" id="inputFirstName" placeholder="Enter Email" name="email">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Address*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder=" Enter Address" name="address">
									</div>

								

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Username*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder=" Enter Username" name="username">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Password*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder=" Enter Password" name="password">
									</div>

									<div class="col-md-2">
										<label for="formFile" class="form-label">PAN</label>
										<input class="form-control" type="file" id="formFile" name="image">
									</div>
									<div class="col-md-2">
										<label for="formFile" class="form-label">Aadhar Card</label>
										<input class="form-control" type="file" id="formFile" name="images">
									</div>

									<div class="col-md-2" style="padding:8px" ><br>
										<button type="submit" class="btn btn-primary px-3"><i class="fadeIn animated bx bx-plus"></i>Add </button>
									</div>
								</form>
		
							</div>
		
						</div>
					</div>
				</div>
				

				
				<!--end page wrapper -->
				<!--start overlay-->
				<div class="overlay toggle-icon"></div>
				<!--end overlay-->
				<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
				<!--End Back To Top Button-->
				
			
				<!-- <h6 class="mb-0 text-uppercase">DataTable</h6> -->
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Sr. No.</th>
										<th>Select City</th>
										<th>Select Company</th>
										<th>Marketing Name</th>  
										<th>Mobile</th> 
										<th>Email</th>
										<th>Address</th>
										<th>Username</th>
										<th>Password</th>
										<th>PAN</th>
										<th>Aadhar card</th>
										<th style="background-color: #fff">Action</th>
									
									</tr>
								</thead>
								<tbody>
									@foreach($mark as $marks)
									<tr>
										<td>{{$loop->index+1}}</td>
										<td>{{$marks->marketing}} </td>
										<td>{{$marks->marketingr}}</td>
										<td>{{$marks->name}}</td>
										<td>{{$marks->mobile}}</td>
										<td>{{$marks->email}}</td>
										<td>{{$marks->address}}</td>
										<td>{{$marks->username}}</td>
										<td>{{$marks->plain_password}}</td>
										<td><a href="{{asset('/')}}{{$marks->pan}}"> 
																<img height="50px" width="50px" src="{{asset('/')}}{{$marks->pan}}" alt="" /></a>
                                                            </td>
										<td><a href="{{asset('/')}}{{$marks->aadhar_card}}"> 
																<img height="50px" width="50px" src="{{asset('/')}}{{$marks->aadhar_card}}" alt="" /></a>
                                                            </td>
										
										<td style="background-color: #fff">
											<button type="button" class="btn"><div class="form-check form-switch">
												<input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
											</div>	</button> 
											<a href="{{route('edit-marketing',$marks->id)}}">
											<button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button></a>
											<a href="{{route('destroy-marketing',$marks->id)}}">
											 <button type="button" class="btn1 btn-outline-danger"><i class='bx bx-trash me-0'></i></button> </a>
											{{-- <button type="button" class="btn1 btn-outline-primary"><i class="fadeIn animated bx bx-file-blank"></i></button> --}}

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
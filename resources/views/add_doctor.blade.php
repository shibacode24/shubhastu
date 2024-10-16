@extends('layout')
{{-- @include('alerts') --}}
@section('content')

<!--start page wrapper -->
<div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col-md-12 mx-auto" style="margin-top: -10%;">
						<div class="card">
							<div class="card-body">
								<div class="card-title d-flex align-items-center">
								
									<h5 class="mb-0 text-primary">Doctor's Registration</h5>
								</div>
								<hr>

								@if(count($errors)>0)
								<ul class="alert alert-danger">
									@foreach($errors->all() as $error)
									<li>{{ $error }} </li>
									@endforeach
								</ul>
								@endif
								
								<form class="row g-2" method="post" action="{{route('create_doctor')}}">
									{{csrf_field()}}
									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Allotted Client Name*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Enter Allotted Dr. Name" name="allotted_dr_name">
									</div>

									
									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Hospital/Pharmacy Address*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Enter Address" name="hospital_address">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Mobile*</label>
										<input type="number" class="form-control" id="inputFirstName" placeholder=" Enter Mobile" name="mobile" maxlength="10">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Email*</label>
										<input type="email" class="form-control" id="inputFirstName" placeholder="Enter Email" name="email">
									</div>

									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Promoter Name*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder=" Enter Promoter Name" name="promoter_name">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Account Number*</label>
										<input type="number" class="form-control" id="inputFirstName" placeholder=" Enter Account Number" name="account_number">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">IFSC*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder=" Enter IFSC" name="ifsc">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">PAN No.</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder=" PAN No." name="pan_no">
									</div>

								


									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Username*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="  Enter Username" name="username">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Password*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder=" Enter Password" name="password">
									</div>
								
									<div class="col-md-2">
										<label class="form-label">Select City</label>
										<select class="single-select" name="city_id">
										<option value="">Select</option>
                                                @foreach ($city as $citys)
                                         <option value="{{ $citys->id }}"  @if (Session::has('cityvariable') && Session::get('cityvariable')  == $citys->id ) selected @endif>
                                            {{$citys->city}} </option>
                                         @endforeach
                                        </select>         
										</select>
									</div>
								
								
									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Select Medical*</label>

										<select class="multiple-select" data-placeholder="Choose anything" multiple="multiple" name="medical_id[]">
										<option value="">Select</option>
                                                @foreach ($medical as $medicals)
                                         <option value="{{ $medicals->id }}" @if (Session::has('medical') && in_array($medicals->id, Session::get('medical'))) selected @endif>
                                            {{$medicals->medical}} </option>
                                         @endforeach
                                        </select>         
										
									</div>
									
									
									<div class="col-md-2" style="margin-top: 4%;">
										<div class="form-check">
											<input class="form-check-input" type="radio" value="0" id="flexCheckDefault" name="Scheme[]">
											<label class="form-check-label" for="flexCheckDefault">0% Scheme</label>
										</div>
									</div>

									<div class="col-md-2" style="margin-top: 4%;">
										<div class="form-check">
											<input class="form-check-input" type="radio" value="10" id="flexCheckDefault1" name="Scheme[]">
											<label class="form-check-label" for="flexCheckDefault1">10% Scheme</label>
										</div>
									</div>
									<div class="col-md-2" style="margin-top: 4%;">
										<div class="form-check">
											<input class="form-check-input" type="radio" value="20" id="flexCheckDefault2" name="Scheme[]">
											<label class="form-check-label" for="flexCheckDefault2">20% Scheme</label>
										</div>
									</div>
									<div class="col-md-3" style="padding:8px" ><br>
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
										<th>Allotted Dr. Name</th>  
										<th>Hospital/Pharmacy Address</th> 
										<th>Mobile</th> 
										<th>Email</th>
										<th>Promoter Name</th>
										<th>Account Number</th>
										<th>IFSC</th>
										<th>PAN N0.</th>
										<th>Username</th>
										<th>Password</th>
										<th>City</th>
										{{-- <th>Medical Name</th> --}}
										
										<th>Scheme</th>
										
										<th style="background-color: #fff">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($doc as $doct)
									<tr>
										<td>{{$loop->index+1}}</td>
										<td>{{$doct->allotted_dr_name}}</td>
										<td>{{$doct->hospital_address}}</td>
										<td>{{$doct->mobile}}</td>
										<td>{{$doct->email}}</td>
										<td>{{$doct->promoter_name}}</td>
										<td>{{$doct->account_number}}</td>
										<td>{{$doct->ifsc}}</td>
										<td>{{$doct->pan_no}}</td>
										<td>{{$doct->username}}</td>
										<td>{{$doct->plain_password}}</td>
										<td>{{$doct->city}}</td>
										{{-- <td>{{$doct->medical}}</td> --}}
										<td>{{$doct->Scheme}}</td>

										<td style="background-color: #fff">
											
										{{-- <button type="button" class="btn"><div class="form-check form-switch">
											<input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
										</div>	</button> --}}
										<a href="{{route('edit-doctor',$doct->id)}}">
										
										<button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button></a>
										<a href="{{route('destroy-doctor',$doct->id)}}"> <button type="button" class="btn1 btn-outline-danger"><i class='bx bx-trash me-0'></i></button> </a>	
								
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
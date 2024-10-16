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
								
									<h5 class="mb-0 text-primary">Link Stokist Medical </h5>
								</div>
								<hr>
								@if(count($errors)>0)
								<ul class="alert alert-danger">
									@foreach($errors->all() as $error)
									<li>{{ $error }} </li>
									@endforeach
								</ul>
								@endif
								
								<form class="row g-2" method="post" action="{{route('create_linkstockist')}}">
							{{csrf_field()}}
									<div class="col-md-2">
										<label class="form-label">Select City</label>
										<select class="single-select" name="select_city_id">
                                        <option value="">Select</option>
                                                @foreach ($city as $citys)
                                         <option value="{{ $citys->id }}">
                                            {{$citys->city}} </option>
                                         @endforeach
                                        </select>         
										</select>
									</div>
									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Select Company*</label>
								
			
										<select class="multiple-select" data-placeholder="Choose anything" multiple="multiple" name="select_company_id[]">
                                        <option value="">Select</option>
                                                @foreach ($addcompanies as $add)
                                         <option value="{{ $add->id }}">
                                            {{$add->Name}} </option>
                                         @endforeach
										
											</select>
										
											</select>
														
									</div>
								

									
									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Select Stockist*</label>

										<select class="multiple-select" data-placeholder="Choose anything" name="select_stockist_id">
                                        <option value="">Select</option>
                                                @foreach ($stock as $Stocks)
                                         <option value="{{ $Stocks->id }}">
                                            {{$Stocks->stockist}} </option>
                                         @endforeach
										
											</select>
										
										</select>

									</div>


									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Select Medical*</label>

										<select class="multiple-select" data-placeholder="Choose anything" multiple="multiple" name="select_medical_id[]">
										<option value="Select">Select</option>
                                                @foreach ($medica as $medicals)
                                         <option value="{{ $medicals->id }}">
                                            {{$medicals->medical}} </option>
                                         @endforeach
											</select>
										
										</select>
									</div>
									
								
								
									<div class="col-md-2" style="padding:8px;" ><br>
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
										<th>City</th>  
										<th>Company</th> 
										<th>Stokist</th> 
										<th>Medical</th>
								
										<th style="background-color:#fff;">Action</th>
									</tr>
								</thead>
								<tbody>
          @foreach($mark as $stos)
									<tr>
										<td>{{$loop->index+1}}</td>
										<td>{{$stos->city}}</td>
										        <!-- attributename -->
										<td>{{$stos->Linkmedical}}</td>
										<td>{{$stos->stockist}}</td>
										<td>{{$stos->LinkMed}}</td>
									
										<td style="background-color:#fff;"><a href="{{route('edit-linkstockist',$stos->id)}}">
                                            <button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button></a>
                                            <a href="{{route('destroy-linkstockist',$stos->id)}}">
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
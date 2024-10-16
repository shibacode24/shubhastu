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
								
									<h5 class="mb-0 text-primary">Link Stokist-Medical</h5>
								</div>
								<hr>
								<form class="row g-2" method="post" action="{{route('update-linkstockist')}}">
							{{csrf_field()}}
                            <input type="hidden" name="id" value="{{$mededit->id}}">
									<div class="col-md-3">
										<label class="form-label">Select City</label>
										<select class="single-select" name="select_city_id">
                                        <option value="">Select</option>
                                                @foreach ($city as $citys)
                                         <option value="{{ $citys->id }}"  @if($mededit->select_city_id==$citys->id) selected @endif>
                                            {{$citys->city}} </option>
                                         @endforeach
                                        </select>         
										</select>
									</div>
									{{-- @php
                                    echo json_encode($mededit->select_medical_id);
									exit(); 
                                    @endphp--}}
									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Select Company*</label>
								
			
										<select class="multiple-select" data-placeholder="Choose anything" multiple="multiple" name="select_company_id[]"  >
                                        <option value="">Select</option>
                                                @foreach ($addcompanies as $add)
                                         <option value="{{ $add->id }}" @if(in_array($add->id,$mededit->select_company_id)) selected @endif >
                                            {{$add->Name}} </option>
                                         @endforeach
											</select>
										
											</select>
														
									</div>
								

									
									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Select Stockist*</label>

										<select class="multiple-select" data-placeholder="Choose anything" name="select_stockist_id">
                                        <option value="">Select</option>
                                                @foreach ($stock as $Stocks)
                                         <option value="{{ $Stocks->id }}"
                                         @if($mededit->select_stockist_id==$Stocks->id) selected @endif>
                                            {{$Stocks->stockist}} </option>
                                         @endforeach
										
											</select>
										
										</select>

									</div>


									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Select Medical*</label>

										<select class="multiple-select" data-placeholder="Choose anything" multiple="multiple" name="select_medical_id[]">
										<option value="">Select</option>
                                                @foreach ($medica as $medicals)
                                         <option value="{{ $medicals->id }}"  @if(in_array($medicals->id,$mededit->select_medical_id)) selected @endif >
                                            {{$medicals->medical}} </option>
                                         @endforeach
											</select>
										
										</select>
									</div>
									
								
								
									<div class="col-md-3" style="padding:8px; margin-left: 45%;" ><br>
										<button type="submit" class="btn btn-primary px-3"><i class="fadeIn animated bx bx-plus"></i>Update </button>
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
								
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($mark as $stos)
									<tr>
										<td>{{$loop->index+1}}</td>
										<td>{{$stos->city}}</td>
										<td>{{$stos->Linkmedical}}</td>
										<td>{{$stos->stockist}}</td>
										<td>{{$stos->Linkm}}</td>
									
										<td><a href="{{route('edit-linkstockist',$stos->id)}}">
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
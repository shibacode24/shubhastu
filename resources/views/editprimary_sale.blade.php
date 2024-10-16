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
								
									<h5 class="mb-0 text-primary">Primary Sale Entry</h5>
								</div>
								<hr>
								<form class="row g-2" method="post" action="{{route('update-primary')}}">
									{{csrf_field()}}
         <input type="hidden" name="id" value="{{$mededit->id}}">
									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Select Company*</label>
								
											<select class="multiple-select" data-placeholder="Choose anything" name="select_company_id">
           <option value="">Select</option>
                                                @foreach ($addcompanies as $add)
                                         <option value="{{ $add->id }}"@if($mededit->select_company_id==$add->id) selected @endif >
                                            {{$add->Name}} </option>
                                         @endforeach
										
										
											</select>

									</div>

									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Select Medicine*</label>
								
											<select class="multiple-select" data-placeholder="Choose anything" name="medicine">
           <option value="">Select</option>
                                                @foreach ($medi as $medic)
                                         <option value="{{ $medic->id }}"@if($mededit->medicine_id==$medic->id) selected @endif>
                                            {{$medic->medicine}} </option>
                                         @endforeach
										
											</select>

									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Batch No.*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Batch No." name="batch_no" value="{{$mededit->batch_no}}">
									</div>
									<div class="col-md-1">
										<label for="inputFirstName" class="form-label">MRP*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="MRP" name="mrp" value="{{$mededit->mrp}}">
									</div>

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Expiry Date*</label>
										<input type="date" class="form-control" id="inputFirstName" name="expiry_date" value="{{$mededit->expiry_date}}">
									</div>
									<div class="col-md-1">
										<label for="inputFirstName" class="form-label">Quantity*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Quantity" name="quantity"  value="{{$mededit->quantity}}">
									</div>
						
									<div class="col-md-2" style="margin-top:3.7%; margin-left: 45%;" >
								       <button type="submit" class="btn btn-primary px-3"><i class="fadeIn animated bx bx-plus"></i> Update  </button>
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
										<th>Medicine</th> 
										<th>Batch No</th>
										<th>MRP</th>
										<th>Expiry Date</th>
										<th>Quantity</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
         @foreach($med as $medi)
									<tr>
										<td>{{$loop->index+1}}</td>
										<td>{{$medi->company}}</td>
										<td>{{$medi->medicine}}</td>
										<td>{{$medi->batch_no}}</td>
										<td>{{$medi->mrp}}</td>
										<td>{{$medi->expiry_date}}</td>
										<td>{{$medi->quantity}}</td>
										<td>
          <a href="{{route('edit-primary',$medi->id)}}">
           <button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button> </a>
           <a href="{{route('destroy-primary',$medi->id)}}">
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
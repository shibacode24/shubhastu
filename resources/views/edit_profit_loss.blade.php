@section('content')
@extends('layout')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col-md-12 mx-auto" style="margin-top: -10%;">
						<div class="card">
							<div class="card-body">
								<div class="card-title d-flex align-items-center">
								
									<h5 class="mb-0 text-primary">Profit & Loss Statement</h5>
								</div>
								<hr>
								<form class="row g-2" method="post" action="{{route('update_profit_loss')}}">
									@csrf
                                    <input type="hidden" name="id" value="{{$ven->id}}">
									<div class="col-md-2">
										<div class="yearWrapper">
											<label class="form-label">Year*</label>
									
											<select class="multiple-select" data-placeholder="Choose anything" name="select_year">
												<option value="Select">Select</option>
											
                                                @foreach ($year as $add)
                                                <option value="{{ $add->id }}" @if($ven->select_year==$add->id) selected @endif>
                                                   {{$add->year}} </option>
                                                @endforeach
											</select>
									
											</div>
									</div>
									<div class="col-md-2">
										<label  class="form-label">Month*</label>
								
											<select class="multiple-select" data-placeholder="Choose anything" name="select_month">
												<option value="Select">Select</option>
                                                @foreach ($month as $add)
                                                <option value="{{ $add->id }}" @if($ven->select_month==$add->id) selected @endif>
                                                   {{$add->sale_of_month}} </option>
                                                @endforeach
											</select>

									</div>
									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Select Company*</label>
								
											<select class="multiple-select" data-placeholder="Choose anything" name="select_company">
												<option value="Select">Select</option>
                                                @foreach ($company as $add)
                                                <option value="{{ $add->id }}" @if($ven->select_company==$add->id) selected @endif>
                                                   {{$add->Name}} </option>
                                                @endforeach
											</select>
									</div>

								

						
									<div class="col-md-2" style="margin-top:3.4%; " >
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
										<th>Year</th> 
										<th>Month</th>
										<th>Company</th>  
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($exp_entry as $exp_entrys)
										
								
									<tr>
										<td>{{$exp_entrys->index+1}}</td>
										<td>{{$exp_entrys->year}}</td>
										<td>{{$exp_entrys->sale_of_month}}</td>
										<td>{{$exp_entrys->Name}}</td>
										
										
										<td>
                                            <a href="{{route('edit_profit_loss',$exp_entrys->id)}}">
                                            <button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button></a>
                                            <a href="{{route('destroy_profit_loss',$exp_entrys->id)}}">
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
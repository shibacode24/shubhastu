@extends('layout')
@section('content')
<!--start page wrapper -->
@include('alerts')
<div class="page-wrapper">
	
			<div class="page-content">
				
			
				<div class="row">
					<div class="col-md-8 mx-auto" style="margin-top: -10%;">
						<div class="card">
							<div class="card-body">
								<div class="card-title d-flex align-items-center">
								
									<h5 class="mb-0 text-primary">Add City</h5>
								</div>
								<hr>
								{{-- @if(count($errors)>0)
								<ul class="alert alert-danger">
									@foreach($errors->all() as $error)
									<li>{{ $error }} </li>
									@endforeach
								</ul>
								@endif --}}
								
								<form class="row g-2" method="POST" action="{{route('create_city')}}">
									{{csrf_field()}}
									
						
									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">City*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="City" name="city">
									</div>
						
									<div class="col-md-3" style="margin-top:6.4vh;" >
								       <button type="submit" class="btn btn-primary px-3"><i class="fadeIn animated bx bx-plus"></i> Add </button>
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
				<div class="col-md-8 mx-auto">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Sr. No.</th>
										<th>City</th>  
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($city as $citys)
									<tr>
										<td>{{$loop->index+1}}</td>
										<td>{{$citys->city}}</td>										
										<td> <a href="{{route('edit-city',$citys->id)}}"><button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button></a>
										<a href="{{route('destroy-city',$citys->id)}}"> <button type="button" class="btn1 btn-outline-danger"><i class='bx bx-trash me-0'></i></button> </a>
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
		</div>
		<!--end page wrapper -->
        @stop
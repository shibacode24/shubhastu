@extends('layout')
@include('alerts')
@section('content')
<!--start page wrapper -->
<div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col-md-8 mx-auto" style="margin-top: -10%;"> 
						<div class="card">
							<div class="card-body">
								<div class="card-title d-flex align-items-center">
								
									<h5 class="mb-0 text-primary">Add Year</h5>
								</div>
								<hr>
								<form class="row g-2" method="post" action="{{route('update-year')}}">
								{{csrf_field()}}	
                                <input type="hidden"  name="id"  value="{{$years->id}}">
						<div class="col-md-3"></div>
									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">Year*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="Year" name="year" value="{{$years->year}}"  required/>
									</div>
						
									<div class="col-md-3" style="margin-top:5.5%;" >
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
		

			<div class="col-md-8 mx-auto">
		
				<div class="card " align="center">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Sr. No.</th>
										<th>Year</th>  
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($year as $ye)
									<tr>
										<td>{{$loop->index+1}}</td>
										<td>{{$ye->year}}</td>										
										<td><a href="{{route('edit-year',$ye->id)}}">
                                            <button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button> </a><a href="{{route('destroy-year',$ye->id)}}"> <button type="button" class="btn1 btn-outline-danger"><i class='bx bx-trash me-0'></i></button> </a>
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
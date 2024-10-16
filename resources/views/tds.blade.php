@extends('layout')
@section('content')
<!--start page wrapper -->
<div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col-md-8 mx-auto" style="margin-top: -10%;"> 
						<div class="card">
							<div class="card-body">
								<div class="card-title d-flex align-items-center">
								
									<h5 class="mb-0 text-primary">Add TDS</h5>
								</div>
								<hr>
								@if(count($errors)>0)
								<ul class="alert alert-danger">
									@foreach($errors->all() as $error)
									<li>{{ $error }} </li>
									@endforeach
								</ul>
								@endif
								
								<form class="row g-2" method="POST" action="{{route('create_tds')}}">
                                {{csrf_field()}}
								{{-- <input type="hidden"  name="id"  value="{{$tdsedit->id}}"> --}}
						
						 <div class="col-md-3">
							<label for="inputFirstName" class="form-label">Date</label>
							<input type="Date" class="form-control" id="inputFirstName" placeholder="Date" name="date" value="{{$data->date}}" >
						</div>
			
									<div class="col-md-3">
										<label for="inputFirstName" class="form-label">TDS(%)*</label>
										<input type="text" class="form-control" id="inputFirstName" placeholder="TDS(%)" name="td" value="{{$data->tds}}">
									</div>
						
									<div class="col-md-3" style="margin-top:6.5vh;" >
								       <button type="submit" class="btn btn-primary px-3"><i class="lni lni-checkmark"></i>Update</button>
									</div>
								</form>
		
							</div>
		
						</div>
					</div>
				</div>
				
				{{-- <div class="col-md-8 mx-auto">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Sr. No.</th>
											<th>Date</th>  
											<th>Tds</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($data as $citys)
										<tr>
											<td>{{$loop->index+1}}</td>
											<td>{{$citys->date}}</td>	
											<td>{{$citys->tds}}</td>									
											 <td> 
												{{--<a href="{{route('edit-city',$citys->id)}}"><button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button></a> --}}
											{{-- <a href="{{route('destroy-tds',$citys->id)}}"> 
												<button type="button" class="btn1 btn-outline-danger"><i class='bx bx-trash me-0'></i></button> </a>
											</td>
								
										</tr>
								@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div> --}} 
				
				<!--end page wrapper -->
				<!--start overlay-->
	
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		
	</div>
	<!--end wrapper-->
@stop
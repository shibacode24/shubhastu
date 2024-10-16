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
									
						<div class="col-md-2"></div>
                        <div class="col-md-3">
                            <label for="inputFirstName" class="form-label">Select Company</label>
                    
                                <select class="multiple-select" data-placeholder="Choose anything" name="company" id="company" >
                                {{-- <option value="">All</option>
                                    @foreach ($addcompanies as $add)
                             <option value="{{ $add->id }}">
                                {{$add->Name}} </option>
                             @endforeach --}}
                            
                                </select>
                              
                        </div>
                        <div class="col-md-3">
                            <label for="inputFirstName" class="form-label">Select Medicine</label>
                    
                                <select class="multiple-select" data-placeholder="Choose anything" name="company" id="company" >
                                <option value="">All</option>
                                    {{-- @foreach ($addcompanies as $add)
                             <option value="{{ $add->id }}">
                                {{$add->Name}} </option>
                             @endforeach --}}
                            
                                </select>
                              
                        </div>
                        
                        <div class="col-md-2" style="padding:8px" ><br>
                            <button type="search" class="btn btn-primary px-3"><i class="lni lni-search-alt" id="search"></i> Search</button>
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
										<th>Batch Number</th>  
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($city as $citys)
									<tr>
										<td>{{$loop->index+1}}</td>
										<td>{{$citys->}}</td>										
										<td>
                                            <button type="button" class="btn1 btn-outline-primary"><i class="fadeIn animated bx bx-file-blank"></i></button>
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
@extends('layout')
@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<div class="row">
					<div class="col-md-12 mx-auto" style="margin-top: -10%;">
						<div class="card">
							<div class="card-body">
								<div class="card-title d-flex align-items-center">
								
									<h5 class="mb-0 text-primary">Expense Entry</h5>
								</div>
								<hr>
								<form class="row g-2" method="POST" action="{{route('update_expence_entry')}}">
									@csrf
                                    <input type="hidden" name="id" value="{{$ven->id}}">
									<div class="col-md-2">
										<div class="yearWrapper">
											<label class="form-label">Year*</label>
									
											<select class="multiple-select" data-placeholder="Choose anything" name="select_year" id="">
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
								
											<select class="multiple-select" data-placeholder="Choose anything" name="select_month" id="">
												<option value="Select">Select</option>
                                                @foreach ($month as $add)
                                                <option value="{{ $add->id }}" @if($ven->select_month==$add->id) selected @endif>
                                                   {{$add->sale_of_month}} </option>
                                                @endforeach

												{{-- <option value="United States" selected>January</option>
												<option value="United Kingdom" selected> February</option>
												<option value="Afghanistan" selected>March</option>
												<option value="Afghanistan" selected>April</option>
												<option value="Afghanistan" selected>May</option>
												<option value="Afghanistan" selected>June</option>
												<option value="Afghanistan" selected>July</option>
												<option value="Afghanistan" selected>August</option>
												<option value="Afghanistan" selected>September</option>
												<option value="Afghanistan" selected>October</option>
												<option value="Afghanistan" selected>November</option>
												<option value="Afghanistan" selected>December</option> --}}
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

									<div class="col-md-2">
										<label for="inputFirstName" class="form-label">Select Category*</label>
								
											<select class="multiple-select" data-placeholder="Choose anything" name="select_category">
												<option value="Select">Select</option>
                                                @foreach ($category as $add)
                                                <option value="{{ $add->id }}" @if($ven->select_category==$add->id) selected @endif>
                                                   {{$add->category}} </option>
                                                @endforeach
											
											</select>
									</div>
									<div class="col-md-3" style="margin-top:3%;" >
								       <button type="submit" class="btn btn-primary px-3"><i class="fadeIn animated bx bx-plus"></i> Update </button>
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
				<div class="col-md-12 mx-auto">
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
											<th>Category</th>
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
											<td>{{$exp_entrys->category}}</td>							
											<td>
												<a href="{{route('edit_expence_entry',$exp_entrys->id)}}">
												<button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button> </a>
												<a href="{{route('destroy_expence_entry',$exp_entrys->id)}}">
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
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		@stop
		@section('js')
	
    <script type="text/javascript">
        window.onload = function () {
            //Reference the DropDownList.
            var ddlYears = document.getElementById("ddlYears");

            //Determine the Current Year.
            var currentYear = (new Date()).getFullYear();

            //Loop and add the Year values to DropDownList.
            for (var i = 1950; i <= currentYear; i++) {
                var option = document.createElement("OPTION");
                option.innerHTML = i;
                option.value = i;
                ddlYears.appendChild(option);
            }
        };
    </script>
@stop
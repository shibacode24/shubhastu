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
                        
                            <h5 class="mb-0 text-primary">Added Medicine</h5>
                        </div>
                        <hr>
                        <form class="row g-2" method="post" value="{{route('create_addedmedicine')}}">
                            
                            <div class="col-md-2"></div>

                            <div class="col-md-3">
                                <label for="inputFirstName" class="form-label">Select Company*</label>
                        
                                    <select class="multiple-select" data-placeholder="Choose anything" >
                                        <option value="">Select</option>
                                        @foreach ($addcompanies as $company)
                                 <option value="{{ $company->id }}">
                                    {{$company->Name}} </option>
                                 @endforeach
                                
                                    </select>
                                                
                            </div>

                            <div class="col-md-2" ><br>
                                <button type="submit" class="btn btn-primary px-3"><i class="lni lni-search-alt"></i> Search</button>
                            </div>

                            <div class="col-md-3" style="padding:8px" ><br>
                                <button type="submit" class="btn btn-primary px-3"><i class="lni lni-file"></i><i class="lni lni-remove-file"></i>Download</button>
                            </div>

<!-- 								
           <div class="col-md-3">
                                <a href="add-medicine-master.html">	<button type="submit" class="btn btn-primary px-3"><i class="fadeIn animated bx bx-plus"></i>Add Medicine Page</a> </button>
                            </div> -->
                        </form>

                    </div>

                </div>
            </div>
        </div>
        

        
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div id="table-scroll" class="table-scroll">
                        <table id="main-table" class="main-table table table-striped table-bordered"  id="example3" >
                          <thead>
                            <tr>
                              <th scope="col">Medicine Name</th>
                              <th scope="col">Scheme %</th>
                              <th scope="col">Comp Name</th>
                              <th scope="col">MRP</th>
                              <th scope="col">GST(%)</th>
                              <th scope="col">GST(₹)</th>
                              <th scope="col">Purchase</th>
                              <th scope="col">AMNT.GST .AFR</th>
                              <th scope="col">R.M</th>
                              <th scope="col">PTR</th>
                              <th scope="col">ST.MAR</th>
                              <th scope="col">PTS</th>
                              <th scope="col">Managei</th>
                              <th scope="col">Prom Cost</th>
                              <th scope="col">AMNT.GST .AFR</th>
                              <th scope="col">Scheme</th>
                              <th scope="col"> Scheme Amnt. Ded</th>
                              <th scope="col">Train Expiry Break</th>
                              <th scope="col">TOT</th>
                              <th scope="col">Mrkng Wkng Cost</th>
                              <th scope="col">Comp Prof</th>
                              <th scope="col">Prof to Inves</th>
                              <th scope="col">Mark+Promn+Scheme</th>
                              <th scope="col">Prof to Ptr</th>
                            <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($medlist as $row)
                                              
                                         
                            <tr>
                                <td>{{$loop->index+1}}</td>

                                <td>{{$row->medicine_id}}</td>
                                <td>{{$row->default_scheme}}</td>
                                <td>{{$row->Name}}</td>
                                <td>{{$row->batch_no}}</td>
                                <td>{{$row->given_gst}}</td>
                                <td>{{$row->purchase}}</td>
                                <td>{{$row->gst}}</td>
                                <td>{{$row->amount_after_gst}}</td>
                                <td>{{$row->retail_margin}}</td>
                                <td>{{$row->ptr}}</td>
                                <td>{{$row->stockist_margin}}</td>
                                <td>{{$row->pts}}</td>
                                <td>{{$row->management}}</td>
                                <td>{{$row->promotion_cost}}</td>
                                <td>{{$row->scheme}}</td>
                                <td>{{$row->mrp}}</td>
                                <td>{{$row->scheme_amount_deduct}}</td>
                                <td>{{$row->transport_expiry_breakage}}</td>
                                <td>{{$row->tot}}</td>
                                <td>{{$row->marketing_working_cost}}</td>
                                <td>{{$row->company_profit}}</td>
                                <td>{{$row->percent_profit_to_investment}}</td>
                                <td>{{$row->marketing_promotion_scheme}}</td>
                                <td>{{$row->percent_profit_to_ptr}}</td>
                           
                            <td><a href="{{route('edit-medicinem',$row->primary_id)}}">
                                <button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button>
                            </a>
                                <a href="{{route('destroy-medicinem',$row->primary_id)}}">
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
</div>
<!--end page wrapper -->
@stop
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

                            <h5 class="mb-0 text-primary">Stock Adjustment Issue</h5>
                        </div>
                        <hr>
                        @if(count($errors)>0)
                        <ul class="alert alert-danger">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }} </li>
                            @endforeach
                        </ul>
                        @endif
                        
                        <form class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label">Year</label>
                                <select class="multiple-select" data-placeholder="Choose anything">
                                    <option value="Afghanistan" selected>2023</option>
                                    <option value="Afghanistan" selected>2022</option>
                                    <option value="Afghanistan" selected>2021</option>

                                    <option value="Afghanistan" selected>2020</option>
                                    <option value="Afghanistan" selected>2019</option>
                                    <option value="Afghanistan" selected>2018</option>
                                

                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="inputFirstName" class="form-label">Sale of Month*</label>

                                <select class="multiple-select" data-placeholder="Choose anything">
                                    <option value="United States" selected>January</option>
                                    <option value="United Kingdom" selected>February</option>
                                    <option value="Afghanistan" selected>March</option>
                                    <option value="Afghanistan" selected>April</option>
                                    <option value="Afghanistan" selected>May</option>
                                    <option value="Afghanistan" selected>June</option>
                                    <option value="Afghanistan" selected>july</option>
                                    <option value="Afghanistan" selected>August</option>
                                    <option value="Afghanistan" selected>September</option>
                                    <option value="Afghanistan" selected>October</option>
                                    <option value="Afghanistan" selected>November</option>
                                    <option value="Afghanistan" selected>December</option>


                                </select>

                            </div>

                            <div class="col-md-3">
                                <label for="inputFirstName" class="form-label">Select Company*</label>

                                <select class="multiple-select" data-placeholder="Choose anything">
                                    <option value="United States" selected>M.ERA LIFES</option>
                                    <option value="United Kingdom" selected>I CARE PHARMA</option>
                                    <option value="Afghanistan" selected>PURPLEAF HEALTHCARE</option>


                                </select>

                            </div>


                            </form>

                    <div style="overflow-x: scroll;">
                        
                        <table style="width:100%; margin-top:4%;">
                            <tr align="center">
                                <th width="5%">Sr. No.</th>
                                <th width="10%">Medicine</th>
                                <th width="10%">QTY</th>
                                <th width="10%">Batch No</th>
                            
                            </tr>
                            <tr align="center">
                                <td>1 </td>
                                <td></td>
                            
                                <td><input type="text" class="form-control" id="inputFirstName"></td>
                                <td>
                                
                                            <select class="multiple-select" data-placeholder="Choose anything" >
                                                <option value="United States" selected>1</option>
                                                <option value="United Kingdom" selected>2</option>
                                                <option value="Afghanistan" selected>3</option>
                                                
                                        
                                            </select>
                                                        
                                    </td>
                                
                        

                            </tr>
                            
                          </table>

                    </div>

                              
            
                        
                            
                        
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-2" style="padding:8px; text-align: center; margin-left: 43%;" >
                            <a href="#"><button type="submit" class="btn btn-primary px-3" ><i class="fadeIn animated bx bx-plus"></i> Add </button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>

    </div>





</div>
<!--end page wrapper -->
@stop
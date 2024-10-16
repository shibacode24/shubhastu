@extends('layout')
@section('content')



<!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default" style="margin-top:-40px;">
                                
                                    <h5 class="panel-title" style="color:#FFFFFF; background-color:#7e84f7; width:100%; font-size:14px;" align="center"><i class="fa fa-h-square" aria-hidden="true" style="color:white;"></i> Medicine Sale Reports</h5>

                                <div class="panel-body form-group" style="margin-top:-10px; margin-bottom:-15px; margin-left:0; padding-left:0; margin-right:0; padding-right:0;">
                                 <form role="form" method="GET" action="{{url('seacrh_companies_details')}}">  
                                  <div class="col-md-12">

                                            <div class="form-group" style="margin-top:-10px;">   
                                                         <div class="col-md-1"></div> 
                                              
                                                <div class="col-md-2"  style="margin-top:15px;">
                                                    <label>Select Month <font color="#FF0000">*</font></label>    
                                                        <select class="form-control select2"  name="start_date" id="start_date" required="">
                                                        <?php
                                                        if(isset($_GET['start_date']))
                                                        {
                                                            $m_selected = date('F',strtotime($_GET['start_date']));
                                                            $y_selected = date('Y',strtotime($_GET['start_date']));
                                                        ?>
                                                            <option value="{{$m_selected.' '.$y_selected}}" selected="">{{$m_selected.' '.$y_selected}}</option>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                            <option value="">Select</option>
                                                        <?php
                                                        }
                                                        ?>
                                                        @foreach($filter as $row)
                                                        {{$m = date('F',strtotime($row->date))}}
                                                        {{$y = date('Y',strtotime($row->date))}}
                                                        <option value="{{$m.' '.$y}}">{{$m.' '.$y}}</option>
                                                        @endforeach
                                                        </select>
                                                              
                                                    
                                                </div>
                                                
                                                     <!-- <label>End Month <font color="#FF0000">*</font></label> -->    
                                                        <input type="hidden" name="end_date" id="end_date" placeholder="Enter Address" class="form-control" required/>
                                               
                                                <?php
                                                $login_doctor=session()->get('login_data_doctor');
                                                if($login_doctor!='')
                                                { ?>
                                                <!-- <div class="col-md-2"  style="margin-top:15px; margin-left: 20px">
                                                    <label>Select Company <font color="#FF0000">*</font></label>    
                                                        <select multiple class="form-control select" id="select_company" name="select_company">
                                                       <?php if(isset($_GET['select_company'])){
                                                       if($_GET['select_company']!='All'){ 
                                                        ?>
                                                       
                                                        <option value="{{$company_search['id']}}">{{$company_search['name']}}</option>
                                                         <?php } else { ?>
                                                        <option value="All">All</option>
                                                         <?php }?>
                                                   <?php }?>
                                                        <option value="All">All</option>
                                                        @foreach($company_data as $row)
                                                        <option value="{{$row['id']}}">{{$row['name']}}</option>
                                                        @endforeach
                                                        </select>
                                                              
                                                    
                                                </div>  -->
                                                <div class="col-md-5"  style="margin-top:15px;margin-left: 20px">
                                                 <label>Select Companies<font color="#FF0000">*</font></label><br><br>
                                                 @foreach($company_data as $row)
                                                 &nbsp;<input <?php if(isset($_GET['select_company'])){ echo in_array($row['id'], $_GET['select_company'])?"checked":''; } ;?> type="checkbox" id="{{$row['id']}}" name="select_company[]" value="{{$row['id']}}">&nbsp;&nbsp;&nbsp;<label for="{{$row['id']}}">{{$row['name']}}</label>
                                                        @endforeach
                                             </div>

                                             <div class="col-md-2"  style="margin-top:15px;margin-left: 20px">
                                                    <label>Select Medical<font color="#FF0000">*</font></label>              
                                                    <select class="form-control select2" id="select_doctor" name="select_doctor">
                                                       <?php if(isset($_GET['select_doctor'])){ 
                                                        if($_GET['select_doctor']!='All'){
                                                        ?>
                                                       
                                                        <option value="{{$doctor_search['id']}}">{{$doctor_search['medical_name']}}</option>
                                                         <?php } else { ?>
                                                        <option value="All">All</option>
                                                         <?php }?>
                                                   <?php }?>
                                                        <option value="All">All</option>
                                                        @foreach($doctor_data as $row)
                                                        <option value="{{$row['id']}}">{{$row['medical_name']}}</option>
                                                         @endforeach
                                                        </select>
                                                </div>
                                                <?php 
                                            }
                                            else
                                            {
                                                ?>
                                                <div class="col-md-2"  style="margin-top:15px;margin-left: 20px">
                                                    <label>Select Doctor<font color="#FF0000">*</font></label>              
                                                    <select class="form-control select2" id="select_doctor" name="select_doctor">
                                                       <?php if(isset($_GET['select_doctor'])){ 
                                                        if($_GET['select_doctor']!='All'){
                                                        ?>
                                                       
                                                        <option value="{{$doctor_search['id']}}">{{$doctor_search['name']}}</option>
                                                         <?php } else { ?>
                                                        <option value="All">All</option>
                                                         <?php }?>
                                                   <?php }?>
                                                        <option value="All">All</option>
                                                        @foreach($doctor_data as $row)
                                                        <option value="{{$row['id']}}">{{$row['name']}}</option>
                                                         @endforeach
                                                        </select>
                                                </div>
                                                <?php
                                            }
                                             ?>

                                             
                                                 
                                                <!-- <div class="col-md-2"  style="margin-top:15px;margin-left: 20px">
                                                    <label>Select Medicine<font color="#FF0000">*</font></label>              
                                                    <select class="form-control select2" id="select_medicine" name="select_medicine">
                                                       <?php if(isset($_GET['select_medicine'])){ 
                                                        if($_GET['select_medicine']!='All'){
                                                        ?>
                                                       
                                                        <option value="{{$medicine_search['id']}}">{{$medicine_search['medicine']}}</option>
                                                    <?php } else { ?>
                                                        <option value="All">All</option>
                                                         <?php }?>
                                                   <?php }?>
                                                        <option value="All">All</option>
                                                        @foreach($medicine_data as $row)
                                                        <option value="{{$row->id}}">{{$row->medicine}}</option>
                                                         @endforeach
                                                        </select>
                                                </div> -->
                                                <div class="col-md-1" align="center" style="margin-top:30px;padding: 5px;">
                                                                  
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                                        
                                                
                                                </div> 
                                                
                                                </div>        
                                            
                                            
                                                
                                        </div> 
                                        
                                </form>
                                <div class="col-md-12">
                                    <hr>
                                </div>
                                <?php
                                if(isset($_GET['start_date'])){?>
                                <form role="form" method="GET" action="{{ route('export') }}">  
                                  <div class="col-md-6">
                                            <div class="form-group" style="margin-top:-10px;">   
                                                          
                                <input type="hidden" name="start_date_excel" value="<?php
                                echo $_GET['start_date']; ?>">
                                <input type="hidden" name="end_date_excel" value="<?php
                                echo $_GET['end_date']; ?>">
<?php
if($login_doctor!=''){
    ?>
                                <input type="hidden" name="select_company" value="<?php
                                echo implode(',',$_GET['select_company']); ?>">
    <?php
}
?>
                                
    <input type="hidden" name="select_doctor_excel" value="<?php
                                echo $_GET['select_doctor']; ?>">
                                
                                                <div class="col-md-5"></div>
                                                <div class="col-md-1"  style="margin-top:20px;margin-left: 20px">
                                                                  
                                                    <button type="submit" class="btn btn-warning"><i class="fa fa-download" aria-hidden="true"></i> Download Excel</button>
                                                        
                                                
                                                </div> 
                                                </div>        
                                            
                                        </div> 
                                        
                                </form>
                                <form role="form" method="GET" action="{{ route('export_pdf') }}">  
                                  <div class="col-md-6">
                                            <div class="form-group" style="margin-top:-10px;">   
                                                          
                                <input type="hidden" name="start_date_pdf" value="<?php
                                echo $_GET['start_date']; ?>">
                                <input type="hidden" name="end_date_pdf" value="<?php
                                echo $_GET['end_date']; ?>">
                               
                                <input type="hidden" name="select_doctor_pdf" value="<?php
                                echo $_GET['select_doctor']; ?>">
                                
                                                <div class="col-md-5"></div>
                                                 <div class="col-md-1"  style="margin-top:20px;margin-left: 20px">
                                                                  
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-download" aria-hidden="true"></i> Download PDF</button>
                                                        
                                                
                                                </div>  
                                                </div>        
                                                
                                                <div class="col-md-12">
                                                    <div class="col-md-5"></div>
                                                    <div class="col-md-2" align="center" style="margin-top:8px;">
                                                       
                                                        
                                                   
                                                    </div>
                                                </div>
                                            
                                        </div> 
                                        
                                </form>
                            <?php }
                            ?>
                               
                                <div class="col-md-12">      
                                                        <img src="{{asset('public/img/line.png')}}" width="100%"/>
                                                </div>
                            </div>
                        </div>
                        <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default" style="margin-top:0px;">
                                
                                  
                                   
                                <div class="panel-body" style="margin-top:-10px; margin-bottom:-15px;">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>Sale Month</th>
                                                <th>Company</th>
@if($login_doctor!='')
<th>Medical Name</th>
@else
<th>Doctor Name</th>
@endif
                                                
                                                <th>Scheme %</th>
                                                <th>PTR Total</th>
                                                <th>Grand Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($show as $row)
                                            <tr><?php 
                                                $m = date('F',strtotime($row->date));
                                                $y = date('Y',strtotime($row->date));
                                                ?>
                                                <td>{{$m.' '.$y}}</td>
                                                <td>{{$row->company_name}}</td>
                                                <td>
@if($login_doctor!='')
{{$row->medical_name}}
@else
{{$row->doctor_name}}
@endif
                                                    
                                                </td>
                                                <td>{{$row->scheme_select}}</td>
                                                <td>{{$row->grand_total_3}}</td>
                                                <td>{{$row->grand_total_2}}</td>

                                                <td>
                                                    <?php
                                                    $login=session()->get('login_data'); 
                                                    if ($login!='') { ?>
                                                    <a href="" >
                                                    <button style="background-color:#89AD4D; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;" type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil" style="margin-left:5px;"></i></button></a>
                                                    <a href="{{url('delete_add_medicines/'.$row->add_entries_id)}}" onclick="return checkdelete()">
                                                    <button style="background-color:#ff0000; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;" type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o" style="margin-left:5px;"></i></button></a>
                                                <?php } ?>
                                                   
                                                    <button style="background-color:#008724; border:none; max-height:25px; margin-top:-5px; margin-bottom:-5px;" type="button" class="btn btn-info viewinfo" data-toggle="modal" data-target="#sale_modal" data-placement="top" id="{{$row->add_entries_id}}" title="Show"><b>Show</b></button>
                                                    
                                                </td>

                                            </tr>
                                           
                                                @endforeach
                                           
                                        </tbody>
                                    </table>
                             
                            <!-- END DEFAULT DATATABLE -->
                             </div>
                    </div>  

                    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="sale_modal"  aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <div class="row">
            <div class="col-md-8">
                        <h5 class="modal-title" id="exampleModalLabel">Medicine Sales Details</h5>

            </div>
            <div class="col-md-4">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
            </div>
        </div>
        
      </div>
      <div class="modal-body pt-4 " style="background-color: #F5F5F5;padding-top: 50px">
  <div class=" col-md-12">
    <div class="col-md-1"></div>
    <div class="col-md-2">
        <label for="exampleFormControlInput1">Sale Month</label><br>
        <label for="exampleFormControlInput1" id="date_of_invoice"></label>
    </div>
    <div class="col-md-2">
        <label for="exampleFormControlInput1">Company</label><br>
        <label for="exampleFormControlInput1" id="company"></label>
    </div>
    <div class="col-md-2">
        <label for="exampleFormControlInput1">Doctor's Name</label><br>
        <label for="exampleFormControlInput1" id="doctors_name"></label>
    </div>
    <div class="col-md-2">
        <label for="exampleFormControlInput1">Scheme %</label><br>
        <label for="exampleFormControlInput1" id="scheme"></label>
    </div>
    <div class="col-md-2">
        <label for="exampleFormControlInput1">Marketing</label><br>
        <label for="exampleFormControlInput1" id="marketing"></label>
    </div>
  </div>
  
  <div class=" col-md-12">
    <div class="" style="margin-top:0px; margin-bottom:px;">
                                    <table class="table" border="1" id="appendtable">
                                        <thead>
                                            <tr width="100%">
                                                 <th width="10%">Medicine</th>
                                                 <th width="10%">PTR</th>
                                                 <th width="10%">MARKETING+ PROMOTION+ SCHEME</th>
                                                 <th width="10%">Quantity</th>
                                                 <th width="10%">Total 1 (QUANTITY * MARK.PROM.SCHE)</th>
                                                 <th width="10%">Total 2 (PTR * QUANTITY)</th>
                                            </tr>
                                        </thead>
                                        <tbody id="appendbody">
                                            
                                            
                                           
                                        </tbody>
                                    </table>
                             
                            <!-- END DEFAULT DATATABLE -->
                             </div>
  </div>
  <div class="form-group col-md-12">
    <div class="col-md-4"></div>
    <div class="col-md-2">
    <label for="exampleFormControlSelect1">Grand Total 1:</label>
    <label for="exampleFormControlSelect1" id="grand_total_2"> </label>
    </div>
    <div class="col-md-2">
    <label for="exampleFormControlSelect1">PTR Total:</label>
    <label for="exampleFormControlSelect1" id="grand_total_3"> </label>
    </div>
  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
         




@stop
@section('js')
<script>

$(document).ready(function(){
    // $('.viewinfo').on('click',function() {
        $( "table" ).delegate( ".viewinfo", "click", function() {// this delegate function is use for dynamic database ajax for every page
       
  var entry_id = $(this).attr('id');
  //alert(entry_id);
   $.ajax({
                                    url:'sale_entry_details',
                                    type:'get',
                                    data:{
                                            entry_id:entry_id
                                    },
                                    dataType:'json',
                                    success:function(data)
                                    {
                                         // console.log(data);
                                        $("#appendbody").empty();
                                        $("#date_of_invoice").text(data[0].date);
                                        $("#company").text(data[0].company_name);
                                        $("#doctors_name").text(data[0].doctor_name);
                                        $("#scheme").text(data[0].scheme_select);
                                        $("#marketing").text(data[0].marketing_name);
                                        $("#grand_total").text(data[0].grand_total);
                                        $("#grand_total_2").text(data[0].grand_total_2);
                                        $("#grand_total_3").text(data[0].grand_total_3);
                                        $.each(data,function(a,b) {
                                             $("#appendbody").append('<tr><td>'+b.medicine_name+'</td><td>'+b.ptr+'</td> <td>'+b.marketing_promotion_scheme+'</td> <td>'+b.quantity+'</td><td>'+b.total_2+'</td><td>'+b.total_3+'</td></tr>');
                                        });
                                     
                                    }

                            });
   });
    $('#start_date').on('change',function() {
        // alert(0);
        var start_date=$('#start_date').val();
        var end_date=$('#end_date').val();
        $("#end_date").val(start_date);
});
    function checkdelete()
        {
            return confirm('Are you sure you want to delete this data ?');
        }

    });
</script>

<script> 
        $(function() { 
            $("input[type='text']").keyup(function() { 
                this.value = this.value.toLocaleUpperCase(); 
            }); 
        }); 
    </script>  

@stop
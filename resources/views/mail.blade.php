<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" 
          href=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
    <style>
#contentss{
    font-size: 5px;
}
table,th,tr,td{
    border-top: solid 0.1px;
    border: solid 0.1px;
    text-align: center;
    border-collapse: collapse;
}

</style>
</head>
 <body id="contentss">


<div class=" col-md-12">
    <div class="" style="margin-top:0px; margin-bottom:px;">
                                    <table class="table" border="1" id="appendtable">
                                        <thead>
                                            <tr width="100%">
                                                 <!-- <th width="12%" style="font-size: 15px;">Date of Invoice</th> -->
                                                 <th width="12%" style="font-size: 15px;">Company</th>
                                                 <th width="12%" style="font-size: 15px;">Doctor's Name</th>
                                                 <th width="12%" style="font-size: 15px;">Scheme %</th>
                                                 <th width="12%" style="font-size: 15px;">Marketing</th>
                                            </tr>
                                        </thead>
                                        <tr width="100%">
                                       
                                        <td style="font-size: 15px;">{{$stocmed[0]->Name}}</td>
                                        <td style="font-size: 15px;">{{$stocmed[0]->allotted_dr_name}}</td>
                                        <td style="font-size: 15px;">{{$stocmed[0]->select_scheme}}</td>
                                        <td style="font-size: 15px;">{{$stocmed[0]->name}}</td> 
                                        </tr>                                      
                                        </tbody>
                                    </table>
                             
                            <!-- END DEFAULT DATATABLE -->
                             </div>
  </div>
  


  <div class="card">
    <div class="card-body">
        <p style="font-size: 20px; text-align:center;"><b>SUMMARY</b></p>
        <table class="table mb-0 table-striped">
            <thead>

                <tr>
                    <th scope="col" style="font-size: 15px;">Medicine </th>
                 
                    <th scope="col" style="font-size: 15px;">Quntity </th>
                  
                    <!-- <th scope="col" style="font-size: 15px;">grandtot1 </th>
                    <th scope="col" style="font-size: 15px;">grandtot2 </th> -->
                  
                </tr>
            </thead>

            <tbody >


@php



    $collection = collect($stocmed);
    $grouped = $collection->groupBy('select_medicine1');
    $result = collect();
    $grouped->each(function ($group) use ($result) {
        $qntys_sum = $group->sum('qntys');
        $grandtot1_sum = $group->sum('grandtot1');
        $grandtot2_sum = $group->sum('grandtot2');
        $qntys_sum = $group->sum('qntys');
        $name = $group->first()->select_medicine1;
        $item = [
            'select_medicine1' => $name, 
            'qntys' => $qntys_sum,
            'grandtot1'=>$grandtot1_sum,
            'grandtot2'=>$grandtot2_sum
        ];
        $result->push($item);
        
        
});
//$resultArray = $result->all();
$result=json_decode($result,true);

@endphp

         @for ($i=0;$i<count($result);$i++)
                            <tr>
                             
                               <td style="font-size: 15px;">{{$result[$i]['select_medicine1']}}</td>
                               <td style="font-size: 15px;">{{$result[$i]['qntys']}}</td>
                               <!-- <td style="font-size: 15px;">{{$result[$i]['grandtot1']}}</td>
                               <td style="font-size: 15px;">{{$result[$i]['grandtot2']}}</td> -->
                            </tr>

                            
                            @endfor
                            
            </tbody>

        </table>
    </div>
</div>



  <div class=" col-md-12">
    <p style="font-size: 20px; text-align:center;"><b>REPORT</b></p>
    <div class="" style="margin-top:10px; margin-bottom:px;">
                                    <table class="table" border="1" id="appendtable">
                                        <thead>
                                            <tr width="100%">
                                                <th width="10%" style="font-size: 15px;">Stockist</th>
                                                <th width="10%" style="font-size: 15px;">Medical</th>
                                                 <th width="10%" style="font-size: 15px;">Medicine</th>
                                                 <th width="10%" style="font-size: 15px;">PTR</th>
                                                 <th width="10%" style="font-size: 15px;">MARKETING+ PROMOTION+ SCHEME</th>
                                                 <th width="10%" style="font-size: 15px;">Quantity</th>
                                                 <th width="10%" style="font-size: 15px;">Batch No</th>
                                                 <th width="10%" style="font-size: 15px;">QUANTITY * MARK.PROM.SCHE</th>
                                                 <th width="10%" style="font-size: 15px;">PTR * QUANTITY</th>
                                                 <th width="10%" style="font-size: 15px;">Scheme</th>
                                            <th width="10%" style="font-size: 15px;">Total 1(QUANTITY * MARK.PROM.SCHE)</th>
                                            <th width="10%" style="font-size: 15px;">Total 2(PTR * QUANTITY)</th>
                                            </tr>
                                            <!-- <th scope="col">Stockist</th>
                                            <th scope="col">Medical</th>
                                            <th scope="col">Medicine</th>
                                            <th scope="col">PTR</th>
                                            <th scope="col">MPS</th>
                                            <th scope="col">Quntity</th>
                                            <th scope="col">Batch No</th>
                                            <th scope="col">Qnty_mps_total</th>
                                            <th scope="col">Qnty_ptr_total</th>
                                            <th scope="col">Scheme</th>
                                            <th scope="col">grandtot1</th>
                                            <th scope="col">grandtot2</th> -->
                                        </thead>

                                        @if(isset($stocmed) && !empty($stocmed))
                                        @foreach($stocmed as $row)
                                            <tr width="100%">
                                            <td style="font-size: 15px;">{{$row->select_stokist_id }}</td>
                                            <td style="font-size: 15px;">{{$row->select_medical_id }}</td>
                                            <td style="font-size: 15px;">{{$row->select_medicine1 ?? ''}}</td>
                                            <td style="font-size: 15px;">{{$row->ptrs ?? ''}}</td>
                                            <td style="font-size: 15px;">{{$row->mpss ?? ''}}</td>
                                            <td style="font-size: 15px;">{{$row->qntys ?? ''}}</td>
                                            <td style="font-size: 15px;">{{$row->select_batchs ?? ''}}</td>
                                            <td style="font-size: 15px;">{{$row->qnty_mps_total ?? ''}}</td>
                                            <td style="font-size: 15px;">{{$row->qnty_ptr_total ?? ''}}</td>
                                            <td style="font-size: 15px;">{{$row->select_scheme }}</td>
                                            <td style="font-size: 15px;">{{$row->grandtot1 ?? ''}}</td> 
                                            <td style="font-size: 15px;">{{$row->grandtot2 ?? ''}}</td> 
                                        </tr>    
                                        @endforeach 
                                        @endif  
                                        {{-- <tr width="100%">
                                            <td style="font-size: 15px;">{{$stocmed->select_medicine1}}</td>
                                            <td style="font-size: 15px;">{{$stocmed->ptrs}}</td>
                                            <td style="font-size: 15px;">{{$stocmed->mpss}}</td>
                                            <td style="font-size: 15px;">{{$stocmed->qntys}}</td>
                                            <td style="font-size: 15px;">{{$stocmed->select_batchs }}</td>
                                            <td style="font-size: 15px;">{{$stocmed->qnty_mps_total }}</td>
                                            <td style="font-size: 15px;">{{$stocmed->qnty_ptr_total }}</td>
                                            <td style="font-size: 15px;">{{$stocmed->grandtot1 }}</td> 
                                            <td style="font-size: 15px;">{{$stocmed->grandtot2 }}</td> 
                                            </tr>     --}}
                                        </tbody>
                                    </table>
                             
                            <!-- END DEFAULT DATATABLE -->
                             </div>
  </div>
  <div class=" col-md-12">
    <div class="" style="margin-top:0px; margin-bottom:px;">
                                    <table class="table" border="1" id="appendtable">
                                        <thead>
                                            <tr width="100%">
                                                 <th width="12%" style="font-size: 15px;">MPS Total</th>
                                                 <th width="12%" style="font-size: 15px;">PTR Total</th>
                                            </tr>
                                        </thead>
                                        <tr width="100%">
                                        <td style="font-size: 15px;">{{$stocmed[0]->total_grand_total1}}</td>
                                        <td style="font-size: 15px;">{{$stocmed[0]->total_grand_total2}}</td> 
                                        </tr>                                      
                                        </tbody>
                                    </table>
                             
                            <!-- END DEFAULT DATATABLE -->
                             </div>
  </div>
  

   <script src=
"https://code.jquery.com/jquery-3.2.1.slim.min.js">
  </script>
    <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js">
  </script>    
 </body>
 </html>

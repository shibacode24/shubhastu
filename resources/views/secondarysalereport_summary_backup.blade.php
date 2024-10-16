
@php
$data = json_decode($proreport, true);


$groupedData = collect($data)->groupBy(function ($item) {
    return $item['select_stokist_id'].  '|'  . $item['sale_of_month'];
})->map(function ($group) {
    $firstItem = $group->first();


    return [
        'sale_of_month' => $firstItem['sale_of_month'],
        'select_stokist_id' => $firstItem['select_stokist_id'],
        // 'select_medical_id' => $firstItem['select_medical_id'],
        'secondary__sales_id' => $firstItem['secondary__sales_id'],
        'append_no' => $firstItem['append_no'],
        'pdf' => $firstItem['pdf'],
        'medicine_array' => $group->pluck('select_medicine')->unique()->values()->all(),
        'ptrs' => $group->unique('select_medicine')->pluck('ptrs')->values()->all(),
        // 'purchase_rate' => $group->pluck('purchase_rate')->unique()->values()->all(),
    ];
})->values()->all();
//  'purchase_rate' =>pluck('purchase_rate')->values()->all(),

@endphp
{{-- @json($groupedData) --}}


<div class="row g-2">


    <div class="col-md-2">
        <label class="form-label" style="font-size: 15px;"><b>Year</b></label><br>
        <label style="color: black;" id="yearmodal">{{$proreport[0]->year}}</label>

    </div>
    <div class="col-md-2">
        <label class="form-label" style="font-size: 15px;"><b>Month</b></label><br>
        <label style="color: black;" id="monthmodal">{{$proreport[0]->sale_of_month}}</label>

    </div>
    <div class="col-md-2">
        <label class="form-label" style="font-size: 15px;"><b>Company</b>
        </label><br>
        <label style="color: black;" id="companymodal">{{$proreport[0]->Name}}</label>

    </div>
    {{-- <div class="col-md-3">
        <label for="inputFirstName" class="form-label" style="font-size: 15px;"><b>Stockist</b></label><br>
        <label style="color: black;" id="marketmodal">{{$proreport[0]->stockist}}</label>

    </div> --}}

   
   <div class="col-md-2">
        <label for="inputFirstName" class="form-label" style="font-size: 20px"><b>Sale Value</b> </label><br>
        <label style="color: black; font-size: 20px;" id="salevalue">{{preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $proreport[0]->total_grand_total2)}}
            </label>

    </div>

    <div class="col-md-2">
        <label for="inputFirstName" class="form-label" style="font-size: 20px"><b>Grand Total 1</b></label><br>
        <label style="color:  black; font-size: 20px;" id="Grandtotal1">{{preg_replace("/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i", "$1,", $proreport[0]->total_grand_total1)}}
        </label>
    </div>
 
 
</div>
<br>


<h2>Summary</h2>

                    <div class="card">
                        <div class="card-body">
                            <table class="table mb-0 table-striped">
                                <thead>
                    
                                    <tr>
                                        <th scope="col">Medicine </th>
                                       
                                        <th scope="col">Quntity </th>
                                 
                                        <th scope="col">Qnty*Purchase </th>
                                        {{-- <th scope="col">grandtot2 </th> --}}
                                      
                                    </tr>
                                </thead>
                    
                                <tbody >


                    @php



                        $collection = collect($proreport);
                        $grouped = $collection->groupBy('select_medicine');
                        $result = collect();
                        $grouped->each(function ($group) use ($result) {
                            $qntys_sum = $group->sum('qnty');
                            $grandtot1_sum = $group->sum('qntypurchase');
                            // $grandtot2_sum = $group->sum('grandtot2');
                            $qntys_sum = $group->sum('qnty');
                            $name = $group->first()->select_medicine;
                            $item = [
                                'select_medicine' => $name, 
                                'qnty' => $qntys_sum,
                                'qntypurchase'=>$grandtot1_sum,
                                // 'grandtot2'=>$grandtot2_sum
                            ];
                            $result->push($item);
                            
                            
});
//$resultArray = $result->all();
$result=json_decode($result,true);

                    @endphp
                    
                             @for ($i=0;$i<count($result);$i++)
                                                <tr>
                                                 
                                                   <td>{{$result[$i]['select_medicine']}}</td>
                                                   <td>{{$result[$i]['qnty']}}</td>
                                                   <td>{{$result[$i]['qntypurchase']}}</td>
                                                   {{-- <td>{{$result[$i]['grandtot2']}}</td> --}}
                                                </tr>

                                                
                                                @endfor
                                                
                                </tbody>
                    
                            </table>
                        </div>
                    </div>
 
                    <div class="card">
                        <div class="card-body">
                        <div class="row g-2">
                    
                    
{{-- @json($groupedData) --}}

                            @for($i=0;$i<count($groupedData);$i++)
                            <br>
                            <div class="col-md-2">
                                <label class="form-label" style="font-size: 15px;"><b>Stockist</b></label><br>
                                <label style="color: black;" id="yearmodal">{{$groupedData[$i]['select_stokist_id']}}</label>
                            
                            </div>
                           
                            @php
                            $grandtot1=0;
                            $grandtot2=0;
                            $query=DB::table('secondary_medicines')
                            ->where(
                                ['secondary__sales_id'=>$groupedData[$i]['secondary__sales_id'],
                                'select_stokist_id'=>$groupedData[$i]['select_stokist_id'],
                                // 'select_medical_id'=>$groupedData[$i]['select_medical_id'],
                                ])
                                ->groupby('append_no');
                                $grandtot1=$query->pluck('sale_value')->toArray();
                            $grandtot1=array_sum($grandtot1);
                            
                            $grandtot2=$query->pluck('grand_total2')->toArray();
                            $grandtot2=array_sum($grandtot2);
                            
                            
                            @endphp
                            <div class="col-md-2">
                                <label class="form-label" style="font-size: 15px;"><b>Grand Total 1</b></label><br>
                                <label style="color: black;" id="yearmodal">{{number_format($grandtot1,2)}}</label>
                            
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" style="font-size: 15px;"><b>Grand Total 2</b></label><br>
                                <label style="color: black;" id="yearmodal">{{number_format($grandtot2,2)}}</label>
                            
                            </div>

                            <div class="col-md-2">
                                <label class="form-label" style="font-size: 15px;"><b>Download PDF</b></label><br>
                                <a download href="{{ asset('images/pdf/' . $groupedData[$i]['pdf']) }}">  <label style="color: black;" id="yearmodal"> {{$groupedData[$i]['pdf']}}</</label>
                                </a>
                            </div>
                            
                            <table class="table mb-0 table-striped">
                                <thead>
                    
                                    <tr>
                                   
                                        <th scope="col">Medicine</th>
                                        <th scope="col">Purchase Rate</th>
                                        <th scope="col">Quntity</th>
                                   
                                    
                                        <th scope="col">Qnty*purchase</th>
                                       
                                    </tr>
                                </thead>
                    
                                <tbody >
                                    
                                    {{-- @php
                                    dd($groupedData); // Add this line to debug
                                @endphp --}}
                                
                                {{-- @if(empty($groupedData[$i]['medicine_array'])) --}}

                                    @foreach($groupedData[$i]['medicine_array'] as $key=> $med)
                                    <tr>
                                      
                                       <td>{{$med}}</td>
                                     
                                       
                                      
                                       @php
                                            $qntys=0;
                                            $query=DB::table('secondary_medicines')
                                                ->where(
                                                    ['secondary__sales_id'=>$groupedData[$i]['secondary__sales_id'],
                                                    'select_stokist_id'=>$groupedData[$i]['select_stokist_id'],
                                                    // 'select_medical_id'=>$groupedData[$i]['select_medical_id'],
                                                    'select_medicine'=>$med,
                                                    // 'purchase_rate'=>$med,
                                    ]);
                                            // ->get();
                                            // echo json_encode($query);
                                            $qnty=$query->sum('qnty');
                                            // $purchase_rate=$query->sum('qnty_mps_total');
                                            $qntypurchase=$query->sum('qntypurchase');
                                             $purchase_rate=$query->sum('purchase_rate');
                                            // $purchase_rate = isset($groupedData[$i]['purchase_rates'][$key]) ? $groupedData[$i]['purchase_rates'][$key] : null;
                                            
                                        @endphp
                                        {{-- @json($groupedData[$i]['secondary__sales_id']) --}}
                                        {{-- <td>{{}}</td> --}}
                                         {{-- <td>{{isset($groupedData[$i]['purchase_rate'][$key]) ? $groupedData[$i]['purchase_rate'][$key]: " "}}</td> --}}
                                       <td>{{$purchase_rate}}</td>
                                       <td>{{$qnty}}</td>
                                       <td>{{$qntypurchase}}</td>
                                 
                                    </tr>
                                @endforeach  
                               
                                {{-- @endif --}}




                                    {{-- @foreach ($proreport as $user1)
                    
                                                <tr>
                                                  
                                                   <td>{{ $user1->select_medicine }}</td>
                                              
                                                   <td>{{ $user1->purchase_rate }}</td>
                    
                                                   <td>{{ $user1->qnty }}</td>
                                               
                                                   <td>{{ $user1->qntypurchase }}</td>
                                             
                                                </tr>
                                                @endforeach 
                     --}}
                    
                                </tbody>
                    
                            </table>
                          
@endfor
                          
                         
                        </div>
                    </div>
                    </div>


</form>

@php
    $data = json_decode($proreport, true);

    $groupedData = collect($data)
        ->groupBy(function ($item) {
            // return $item['select_stokist_id'] . '|' . $item['sale_of_month'];
            return $item['select_stokist_id'] . '|' . $item['master_id'] . '|' . $item['sale_of_month'];
        })
        ->map(function ($group) {
            $firstItem = $group->first();

            $medicineArray = $group
                ->groupBy(function ($item) {
                    return $item['purchase_rate'];
                })
                ->map(function ($groupedItems) {
                    // Assuming you want to keep the first occurrence of 'select_medicine1'
                    $firstItem = $groupedItems->first();

                    return [
                        'medicine' => $firstItem['select_medicine'],
                        'purchase_rate' => $firstItem['purchase_rate'],
                    ];
                })
                // ->pluck('medicine')
                ->values()
                ->all();

            $medicine = $group
                ->groupBy(function ($item) {
                    return $item['purchase_rate'];
                })
                ->map(function ($groupedItems) {
                    // Assuming you want to keep the first occurrence of 'select_medicine1'
                    $firstItem = $groupedItems->first();

                    return [
                        'medicine' => $firstItem['select_medicine'],
                    ];
                })
                // ->pluck('medicine')
                ->values()
                ->all();

            return [
                'select_stokist_id' => $firstItem['select_stokist_id'],
                'secondary__sales_id' => $firstItem['secondary__sales_id'],
                'append_no' => $firstItem['append_no'],
                'pdf' => $firstItem['pdf'],
                'secondary__sales' => $firstItem['secondary__sales'],
                'sale_of_month' => $firstItem['sale_of_month'],
                'year_id' => $firstItem['year_id'],
                'qntypurchase' => $firstItem['qntypurchase'],
                'master_id' => $firstItem['master_id'],
                'medicine_array' => $medicineArray,
                'medicine' => $medicine,
            ];
        })
        ->values()
        ->all();

@endphp

<div class="row g-2">


    <div class="col-md-2">
        <label class="form-label" style="font-size: 15px;"><b>Year</b></label><br>
        <label style="color: black;" id="yearmodal">{{ $proreport[0]->year }}</label>

    </div>
    <div class="col-md-2">
        <label class="form-label" style="font-size: 15px;"><b>Month</b></label><br>
        <label style="color: black;" id="monthmodal">{{ $proreport[0]->sale_of_month }}</label>

    </div>
    <div class="col-md-2">
        <label class="form-label" style="font-size: 15px;"><b>Company</b>
        </label><br>
        <label style="color: black;" id="companymodal">{{ $proreport[0]->Name }}</label>

    </div>

    <div class="col-md-2">
        <label for="inputFirstName" class="form-label" style="font-size: 20px"><b>Sale Value</b> </label><br>
        <label style="color: black; font-size: 20px;"
            id="salevalue">{{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", $proreport[0]->total_grand_total2) }}
        </label>

    </div>
    @if (auth()->check())
        <div class="col-md-2">
            <label for="inputFirstName" class="form-label" style="font-size: 20px"><b>Grand Total 1</b></label><br>
            <label style="color:  black; font-size: 20px;"
                id="Grandtotal1">{{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", $proreport[0]->total_grand_total1) }}
            </label>
        </div>
    @endif

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
                    @if (auth()->check())
                        <th scope="col">Qnty*Purchase </th>
                    @endif

                    {{-- <th scope="col">grandtot2 </th> --}}

                </tr>
            </thead>

            <tbody>


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
                            'qntypurchase' => $grandtot1_sum,
                            // 'grandtot2'=>$grandtot2_sum
                        ];
                        $result->push($item);
                    });
                    //$resultArray = $result->all();
                    $result = json_decode($result, true);

                @endphp

                @for ($i = 0; $i < count($result); $i++)
                    <tr>

                        <td>{{ $result[$i]['select_medicine'] }}</td>
                        <td>{{ $result[$i]['qnty'] }}</td>
                        @if (auth()->check())
                            <td>{{ $result[$i]['qntypurchase'] }}</td>
                        @endif
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
            {{-- @php
            $qntypurchase=0;
                
            @endphp --}}
            @for ($i = 0; $i < count($groupedData); $i++)
                <br>
                @if (empty(auth()->guard('marketings')->user()->id) ||
                        auth()->guard('marketings')->user()->id == $groupedData[$i]['master_id']
                )
                    <div class="col-md-2">
                        <label class="form-label" style="font-size: 15px;"><b>Stockist</b></label><br>
                        <label style="color: black;" id="yearmodal">{{ $groupedData[$i]['select_stokist_id'] }}</label>

                    </div>

                    @php
                        if ($groupedData[$i]['master_id'] == 1) {
                            $marketing_name = 'Admin';
                        } else {
                            $marketing_name = DB::table('marketings')
                                ->where('id', $groupedData[$i]['master_id'])
                                ->value('name');
                        }
                    @endphp
                    <div class="col-md-2">
                        <label class="form-label" style="font-size: 15px;"><b>Marketing Name</b></label><br>
                        <label style="color: black;" id="yearmodal">{{ $marketing_name }} </label>

                    </div>

                    {{-- @php
                $grandtot1 = 0;
                $grandtot2 = 0;
            
                $med_array = $groupedData[$i]['medicine'];
                //$purchase_rate_array = $groupedData[$i]['purchase_rate'];
            
                // echo json_encode($med_array);
                $query22 = DB::table('secondary_medicines')
                    ->join('secondary__sales', 'secondary__sales.id', '=', 'secondary_medicines.secondary__sales_id')
                    ->where([
                        'secondary__sales.sale_of_month' => $groupedData[$i]['sale_of_month'],
                        'secondary_medicines.select_stokist_id' => $groupedData[$i]['select_stokist_id'],
                       // 'secondary_medicines.secondary__sales_id' => $groupedData[$i]['secondary__sales_id'],
                        //'select_medical_id' => $groupedData[$i]['select_medical_id']
                    ])
                    ->whereIn('select_medicine', $med_array);
                   // ->whereIn('purchase_rate', $purchase_rate_array);
    
             $results = $query22->select('secondary__sales.id','sale_value', 'grand_total2')->get();
                   $grandtot1 = $results->pluck('sale_value')->first();
                   $grandtot2 = $results->pluck('grand_total2')->first(); 
                echo "$results";
            @endphp --}}
                    {{-- @php
                    $grandtot1 = 0;
                    $grandtot2 = 0;

                    $med_array = $groupedData[$i]['medicine'];

                    $query22 = DB::table('secondary_medicines')
                        ->join('secondary__sales', 'secondary__sales.id', '=', 'secondary_medicines.secondary__sales_id')
                        ->where([
                            'secondary__sales.sale_of_month' => $groupedData[$i]['sale_of_month'],
                            'secondary_medicines.select_stokist_id' => $groupedData[$i]['select_stokist_id'],
                        ])
                        ->whereIn('select_medicine', $med_array)
                        ->groupBy('secondary_medicines.id') // Group by id
                        ->selectRaw('min(sale_value) as sale_value, min(grand_total2) as grand_total2');

                    $results = $query22->get();
                    $grandtot1 = $results->sum('sale_value');
                    $grandtot2 = $results->sum('grand_total2');
                @endphp --}}




                    @php
                        $grandSumQntypurchase = 0; // Initialize the grand sum

                        foreach ($groupedData[$i]['medicine_array'] as $key => $med) {
                            $query = DB::table('secondary_medicines')
                                ->join(
                                    'secondary__sales',
                                    'secondary__sales.id',
                                    '=',
                                    'secondary_medicines.secondary__sales_id',
                                )
                                ->where([
                                    'secondary__sales.sale_of_month' => $groupedData[$i]['sale_of_month'],
                                    'secondary__sales.year_id' => $groupedData[$i]['year_id'],
                                    'secondary__sales.master_id' => $groupedData[$i]['master_id'],
                                    'secondary_medicines.select_stokist_id' => $groupedData[$i]['select_stokist_id'],
                                    'select_medicine' => $med['medicine'],
                                    'purchase_rate' => $med['purchase_rate'],
                                ]);

                            $result = $query->get();
                            // echo json_encode($result);
                            $qntypurchase = $result->sum('qntypurchase');

                            $salevalue = $result->sum('sale_value');

                            // Accumulate the qntypurchase values
                            $grandSumQntypurchase += $qntypurchase;
                            // $grandSumsalevalue += $salevalue;
                        }
                    @endphp

                    <div class="col-md-2">
                        <label class="form-label" style="font-size: 15px;"><b>Grand Total 1</b></label><br>
                        <label style="color: black;"
                            id="yearmodal">{{ number_format($grandSumQntypurchase, 2) }}</label>

                    </div>
                    <div class="col-md-2">
                        <label class="form-label" style="font-size: 15px;"><b>Grand Total 2</b></label><br>
                        <label style="color: black;" id="yearmodal">{{ number_format($salevalue, 2) }}</label>

                    </div>

                    <div class="col-md-2">
                        <label class="form-label" style="font-size: 15px;"><b>Download PDF</b></label><br>
                        <a download href="{{ asset('images/pdf/' . $groupedData[$i]['pdf']) }}"> <label
                                style="color: black;" id="yearmodal"> {{ $groupedData[$i]['pdf'] }}</label>
                        </a>
                    </div>

                    <div class="col-md-2">
                        <a href="{{ route('edit_secondary_sale', $groupedData[$i]['secondary__sales']) }}">
                            <button type="button" class="btn1 btn-outline-success"><i
                                    class='bx bx-edit-alt me-0'></i> Edit</button> </a>
                        {{-- <a href="{{ route('edit_secondary_sale', $groupedData[$i]['secondary__sales']) }}"> <label
                                class="form-label" style="font-size: 15px;color:black;"><b>Edit <i
                                        class='bx bx-edit me-0'></i></b></label><br>
                            <a href="{{ route('edit_secondary_sale', $groupedData[$i]['secondary__sales']) }}"><label
                                    class="form-label" style="font-size: 15px;"><b>Edit</b><i
                                        class='bx bx-edit me-0'></i></label>
                            </a> --}}
                    </div>

                    <table class="table mb-0 table-striped">
                        <thead>

                            <tr>

                                <th scope="col">Medicine</th>
                                @if (auth()->check())
                                    <th scope="col">Purchase Rate</th>
                                @endif
                                <th scope="col">Quntity</th>
                                @if (auth()->check())
                                    <th scope="col">Qnty*purchase</th>
                                @endif

                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($groupedData[$i]['medicine_array'] as $key => $med)
                                <tr>

                                    <td>{{ $med['medicine'] }}</td>

                                    @php
                                        $query = DB::table('secondary_medicines')
                                            ->join(
                                                'secondary__sales',
                                                'secondary__sales.id',
                                                '=',
                                                'secondary_medicines.secondary__sales_id',
                                            )
                                            ->where([
                                                'secondary__sales.sale_of_month' => $groupedData[$i]['sale_of_month'],
                                                'secondary__sales.year_id' => $groupedData[$i]['year_id'],
                                                'secondary__sales.master_id' => $groupedData[$i]['master_id'],
                                                'secondary_medicines.select_stokist_id' =>
                                                    $groupedData[$i]['select_stokist_id'],
                                                'select_medicine' => $med['medicine'],
                                                'purchase_rate' => $med['purchase_rate'],
                                            ]);
                                        $result = $query->get();
                                        $qnty = $result->sum('qnty');
                                        $qntypurchase = $result->sum('qntypurchase');
                                        $purchase_rate = $med['purchase_rate'];
                                        // echo json_encode($result);
                                    @endphp

                                    @if (auth()->check())
                                        <td>{{ $purchase_rate }}</td>
                                    @endif

                                    <td>{{ $qnty }}</td>
                                    @if (auth()->check())
                                        <td>{{ $qntypurchase }}</td>
                                    @endif

                                </tr>
                            @endforeach

                            {{-- {{$qntypurchase}} --}}
                        </tbody>

                    </table>
                @endif
            @endfor


        </div>
    </div>
</div>


</form>

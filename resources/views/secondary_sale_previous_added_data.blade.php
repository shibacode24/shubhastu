@php
    $data = json_decode($proreport, true);

    $groupedData = collect($data)
        ->groupBy(function ($item) {
            return $item['select_stokist_id'] . '|' . $item['sale_of_month'];
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
                'master_id' => $firstItem['master_id'],
                'pdf' => $firstItem['pdf'],
                'sale_of_month' => $firstItem['sale_of_month'],
                'total_grand_total1' => $firstItem['total_grand_total1'],
                'total_grand_total2' => $firstItem['total_grand_total2'],
                'qntypurchase' => $firstItem['qntypurchase'],
                'medicine_array' => $medicineArray,
                'medicine' => $medicine,
            ];
        })
        ->values()
        ->all();

@endphp

{{-- @json($groupedData) --}}
<h6>Previously Added Medicine</h6>

<div class="card">
    <div class="card-body">
        <div class="row g-2">

            @if (auth()->check())

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
                @php
                    $grandtot1 = 0;
                    $grandtot2 = 0;

                    $med_array = $groupedData[0]['medicine'];
                    //$purchase_rate_array = $groupedData[$i]['purchase_rate'];

                    // echo json_encode($med_array);
                    $query22 = DB::table('secondary_medicines')
                        ->join('secondary__sales', 'secondary__sales.id', '=', 'secondary_medicines.secondary__sales_id')
                        ->where([
                            'secondary__sales.sale_of_month' => $groupedData[0]['sale_of_month'],
                            // 'secondary__sales.master_id' => $groupedData[0]['master_id'],
                            'secondary_medicines.select_stokist_id' => $groupedData[0]['select_stokist_id'],
                            //'select_medical_id' => $groupedData[$i]['select_medical_id']
                        ])
                        ->whereIn('select_medicine', $med_array);
                    // ->whereIn('purchase_rate', $purchase_rate_array);

                    $results = $query22->select('sale_value', 'grand_total2')->get();
                    $grandtot1 = $results->pluck('sale_value')->first();
                    $grandtot2 = $results->pluck('grand_total2')->first();
                    $total_grand_total1 = $groupedData[0]['total_grand_total1'];
                    $total_grand_total2 = $groupedData[0]['total_grand_total2'];

                    // echo "$qnty_mps_total";

                @endphp


                <div class="col-md-2">
                    <label class="form-label" style="font-size: 15px;"><b>Grand Total 1</b></label><br>
                    <label style="color: black;" id="yearmodal">{{ number_format($total_grand_total1, 2) }}</label>

                </div>
                <div class="col-md-2">
                    <label class="form-label" style="font-size: 15px;"><b>Grand Total 2</b></label><br>
                    <label style="color: black;" id="yearmodal">{{ number_format($total_grand_total2, 2) }}</label>

                </div>
                <br>

                <table class="table mb-0 table-striped">
                    <thead>

                        <tr>

                            <th scope="col">Medicine</th>
                            @if (auth()->check())
                                <th scope="col">Purchase Rate</th>
                            @endif
                            <th scope="col">Quntity</th>


                            <th scope="col">Qnty*purchase</th>

                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($groupedData as $group)
                            @foreach ($group['medicine_array'] as $med)
                                <tr>

                                    <td>{{ $med['medicine'] }}</td>

                                    @php
                                        $query = DB::table('secondary_medicines')
                                            ->join('secondary__sales', 'secondary__sales.id', '=', 'secondary_medicines.secondary__sales_id')
                                            ->where([
                                                'secondary__sales.sale_of_month' => $group['sale_of_month'],
                                                'secondary_medicines.select_stokist_id' => $group['select_stokist_id'],
                                                'select_medicine' => $med['medicine'],
                                                'purchase_rate' => $med['purchase_rate'],
                                            ]);
                                        $result = $query->get();
                                        $qnty = $result->sum('qnty');
                                        $qntypurchase = $result->sum('qntypurchase');
                                        $purchase_rate = $med['purchase_rate'];
                                        //echo json_encode($qnty);
                                    @endphp


                                    <td>{{ $purchase_rate }}</td>
                                    <td>{{ $qnty }}</td>
                                    <td>{{ $qntypurchase }}</td>

                                </tr>
                            @endforeach
                        @endforeach

                        {{-- {{$qntypurchase}} --}}
                    </tbody>

                </table>
            @else
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
                @php
                    $grandtot1 = 0;
                    $grandtot2 = 0;

                    $med_array = $groupedData[0]['medicine'];
                    //$purchase_rate_array = $groupedData[$i]['purchase_rate'];

                    // echo json_encode($med_array);
                    $query22 = DB::table('secondary_medicines')
                        ->join('secondary__sales', 'secondary__sales.id', '=', 'secondary_medicines.secondary__sales_id')
                        ->where([
                            'secondary__sales.sale_of_month' => $groupedData[0]['sale_of_month'],
                            'secondary__sales.master_id' => $groupedData[0]['master_id'],
                            'secondary_medicines.select_stokist_id' => $groupedData[0]['select_stokist_id'],
                        ])
                        ->whereIn('select_medicine', $med_array);
                    // ->whereIn('purchase_rate', $purchase_rate_array);

                    $results = $query22->select('sale_value', 'grand_total2')->get();

                    // echo json_encode($results);
                    $grandtot1 = $results->pluck('sale_value')->first();
                    $grandtot2 = $results->pluck('grand_total2')->first();
                    // echo "$qnty_mps_total";
                @endphp

            


                <div class="col-md-2">
                    <label class="form-label" style="font-size: 15px;"><b>Grand Total 1</b></label><br>
                    <label style="color: black;" id="yearmodal">{{ number_format($grandtot1, 2) }}</label>

                </div>
                <div class="col-md-2">
                    <label class="form-label" style="font-size: 15px;"><b>Grand Total 2</b></label><br>
                    <label style="color: black;" id="yearmodal">{{ number_format($grandtot2, 2) }}</label>

                </div>
                <br>

                <table class="table mb-0 table-striped">
                    <thead>

                        <tr>

                            <th scope="col">Medicine</th>
                            @if (auth()->check())
                                <th scope="col">Purchase Rate</th>
                            @endif
                            <th scope="col">Quntity</th>


                            <th scope="col">Qnty*purchase</th>

                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($groupedData as $group)
                            @foreach ($group['medicine_array'] as $med)
                                <tr>

                                    <td>{{ $med['medicine'] }}</td>

                                    @php
                                        $query = DB::table('secondary_medicines')
                                            ->join('secondary__sales', 'secondary__sales.id', '=', 'secondary_medicines.secondary__sales_id')
                                            ->where([
                                                'secondary__sales.sale_of_month' => $group['sale_of_month'],
                                                'secondary__sales.master_id' => $group['master_id'],
                                                'secondary_medicines.select_stokist_id' => $group['select_stokist_id'],
                                                'select_medicine' => $med['medicine'],
                                                'purchase_rate' => $med['purchase_rate'],
                                            ]);
                                        $result = $query->get();
                                        $qnty = $result->sum('qnty');
                                        $qntypurchase = $result->sum('qntypurchase');
                                        $purchase_rate = $med['purchase_rate'];
                                        //echo json_encode($qnty);
                                    @endphp

                                    @if (auth()->check())
                                        <td>{{ $purchase_rate }}</td>
                                    @endif
                                    <td>{{ $qnty }}</td>
                                    <td>{{ $qntypurchase }}</td>

                                </tr>
                            @endforeach
                        @endforeach

                        {{-- {{$qntypurchase}} --}}
                    </tbody>

                </table>
            @endif

        </div>
    </div>

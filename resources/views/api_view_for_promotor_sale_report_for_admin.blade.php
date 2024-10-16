@php
    $data = json_decode($proreport, true);

    $groupedData = collect($data)
        ->groupBy(function ($item) {
            return $item['select_stokist_id'] . '|' . $item['select_medical_id'] . '|' . $item['select_marketing_id'] . '|' . $item['sale_of_month'];
        })
        ->map(function ($group) {
            $firstItem = $group->first();

            $medicineArray = $group
                ->groupBy(function ($item) {
                    return $item['ptrs'] . '|' . $item['mpss'];
                })
                ->map(function ($groupedItems) {
                    // Assuming you want to keep the first occurrence of 'select_medicine1'
                    $firstItem = $groupedItems->first();

                    return [
                        'medicine' => $firstItem['select_medicine1'],
                        'ptrs' => $firstItem['ptrs'],
                        'mpss' => $firstItem['mpss'],
                    ];
                })
                // ->pluck('medicine')
                ->values()
                ->all();


                $medicine = $group
                ->groupBy(function ($item) {
                    return $item['ptrs'] . '|' . $item['mpss'];
                })
                ->map(function ($groupedItems) {
                    // Assuming you want to keep the first occurrence of 'select_medicine1'
                    $firstItem = $groupedItems->first();

                    return [
                        'medicine' => $firstItem['select_medicine1'],
                       
                    ];
                })
                 ->pluck('medicine')
                ->values()
                ->all();
            // echo json_encode($medicineArray);

            return [
                'select_stokist_id' => $firstItem['select_stokist_id'],
                'select_medical_id' => $firstItem['select_medical_id'],
                'select_marketing_id' => $firstItem['select_marketing_id'],
                'promotor__sales_id' => $firstItem['promotor__sales_id'],
                'select_batchs' => $firstItem['select_batchs'],
                'append_no' => $firstItem['append_no'],
                'sale_of_month' => $firstItem['sale_of_month'],
                'medicine_array' => $medicineArray,
                'medicine' => $medicine,
            ];
        })
        ->values()
        ->all();

@endphp



{{-- @json($groupedData) --}}
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
    {{-- <div class="col-md-3">
        <label for="inputFirstName" class="form-label" style="font-size: 15px;"><b>Marketing</b></label><br>
        <label style="color: black;" id="marketmodal">{{ $proreport[0]->name }}</label>

    </div> --}}
    {{-- @json($proreport) --}}

    <div class="col-md-3">
        <label for="inputFirstName" class="form-label" style="font-size: 15px;">
            <b>Client</b></label><br>
        <label style="color: black;" id="doctorclientmodal">{{ $proreport[0]->allotted_dr_name }}</label>

    </div>



    @if (auth()->check())
        <div class="col-md-2">
            <label for="inputFirstName" class="form-label" style="font-size: 20px"><b>MPS Total</b></label><br>
            <label style="color:  black; font-size: 20px;"
                id="Grandtotal1">{{ $proreport[0]->total_grand_total1 }}</label>
        </div>
    @endif

    <div class="col-md-2">
        <label for="inputFirstName" class="form-label" style="font-size: 20px"><b>PTR Total</b> </label><br>
        <label style="color: black; font-size: 20px;" id="Grandtotal2">{{ $proreport[0]->total_grand_total2 }}</label>

    </div>
    @if (auth()->check())
        <div class="col-md-2">
            @php
                $tds_value = ((float) $proreport[0]->tds / 100) * (float) $proreport[0]->total_grand_total1;
            @endphp
            <label for="inputFirstName" class="form-label" style="font-size: 20px"><b>TDS</b></label><br>
            <label style="color:  black; font-size: 20px;">
                {{ number_format($tds_value, 2) }}</label>
        </div>
        <div class="col-md-2">
            @php
                $count = ((float) $proreport[0]->total_grand_total1) - ((float) $proreport[0]->tds / 100) * (float) $proreport[0]->total_grand_total1;

            @endphp
            <label for="inputFirstName" class="form-label" style="font-size: 20px"><b>Payable Amount</b></label><br>
            <label style="color:  black; font-size: 20px;">
                {{ number_format($count, 2) }}</label>
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

                    <th scope="col">Quantity </th>
                        <th scope="col">Quantity X MPS(Total) </th>

                    <th scope="col">Quantity X PTR(Total) </th>

                </tr>
            </thead>

            <tbody>


                @php

                    $collection = collect($proreport);
                    $grouped = $collection->groupBy('select_medicine1');
                    $result = collect();
                    $grouped->each(function ($group) use ($result) {
                        $qntys_sum = $group->sum('qntys');
                        $grandtot1_sum = $group->sum('qnty_mps_total');
                        $grandtot2_sum = $group->sum('qnty_ptr_total');
                        $qntys_sum = $group->sum('qntys');
                        $grandtot1_sum = $group->sum('qnty_mps_total');
                        $grandtot2_sum = $group->sum('qnty_ptr_total');
                        $name = $group->first()->select_medicine1;
                        $item = [
                            'select_medicine1' => $name,
                            'qntys' => $qntys_sum,
                            'qnty_mps_total' => $grandtot1_sum,
                            'qnty_ptr_total' => $grandtot2_sum,
                        ];
                        $result->push($item);
                    });
                    $result = json_decode($result, true);
                    // echo json_encode($proreport)
                @endphp

                @for ($i = 0; $i < count($result); $i++)
                    <tr>

                        <td>{{ $result[$i]['select_medicine1'] }}</td>
                        <td>{{ $result[$i]['qntys'] }}</td>
                            <td>{{ $result[$i]['qnty_mps_total'] }}</td>
                        <td>{{ $result[$i]['qnty_ptr_total'] }}</td>
                    </tr>
                @endfor

            </tbody>

        </table>
    </div>
</div>
<br>
{{-- @json($groupedData) --}}



<div class="card">
    <div class="card-body">
        <div class="row g-2">

            @for ($i = 0; $i < count($groupedData); $i++)
                <br>
            
                    <div class="col-md-2">
                        <label class="form-label" style="font-size: 15px;"><b>Stockist</b></label><br>
                        <label style="color: black;" id="yearmodal">{{ $groupedData[$i]['select_stokist_id'] }}
                        </label>

                    </div>
                    @php
                        $marketing_name = DB::table('marketings')
                            ->where('id', $groupedData[$i]['select_marketing_id'])
                            // ->where('medicine_id', $med->select_medicine1)
                            ->value('name');
                    @endphp
                    <div class="col-md-2">
                        <label class="form-label" style="font-size: 15px;"><b>Marketing</b></label><br>
                        <label style="color: black;" id="yearmodal">{{ $marketing_name }} </label>

                    </div>
                    <div class="col-md-2">
                        <label class="form-label" style="font-size: 15px;"><b>Medical</b></label><br>
                        <label style="color: black;" id="yearmodal">{{ $groupedData[$i]['select_medical_id'] }}
                        </label>

                    </div>
                    @php
                        $grandtot1 = 0;
                        $grandtot2 = 0;
                       
                        // $med_array = $groupedData[$i]['medicine_array'];
                        $med_array = $groupedData[$i]['medicine'];

                        // echo json_encode($med_array);
                        $query22 = DB::table('promotorsalemedicine')
                            ->join('promotor__sales', 'promotor__sales.id', '=', 'promotorsalemedicine.promotor__sales_id')
                            ->where([
                                'promotor__sales.sale_of_month' => $groupedData[$i]['sale_of_month'],
                                'select_stokist_id' => $groupedData[$i]['select_stokist_id'],
                                'select_medical_id' => $groupedData[$i]['select_medical_id'],
                                // 'select_batchs' => $groupedData[$i]['select_batchs'],
                            ])
                            ->whereIn('select_medicine1', $med_array);
                        $grandtot1 = $query22->sum('qnty_mps_total');
                        $grandtot2 = $query22->sum('qnty_ptr_total');

                        //    echo "$qnty_mps_total";

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
                    <hr>

                    <table class="table mb-0 table-striped">
                        <thead>

                            <tr>

                                <th scope="col">Medicine</th>
                                <th scope="col">PTR</th>
                                    <th scope="col">MPS</th>
                                <th scope="col">Quantity</th>
                                    <th scope="col">Qnty_mps_total</th>
                                <th scope="col">Qnty_ptr_total</th>

                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($groupedData[$i]['medicine_array'] as $key => $med)
                                {{-- @json($med) --}}
                                <tr>
                                    <td>{{ $med['medicine'] }}</td>
                                  
                                    @php
                                        $query = DB::table('promotorsalemedicine')
                                        ->leftjoin('promotor__sales', 'promotor__sales.id', '=', 'promotorsalemedicine.promotor__sales_id')
                                            ->where([
                                                'select_stokist_id' => $groupedData[$i]['select_stokist_id'],
                                                'select_medical_id' => $groupedData[$i]['select_medical_id'],
                                                 'select_medicine1' => $med['medicine'],
                                                 'ptrs' => $med['ptrs'],
                                                 'mpss' => $med['mpss'],
                                                'promotor__sales.sale_of_month' => $groupedData[$i]['sale_of_month'],
                                ]);

                                        $result = $query->get();
                                        $qnty_mps_total = $result->sum('qnty_mps_total');
                                        $qnty_ptr_total = $result->sum('qnty_ptr_total');
                                        $qntys = $result->sum('qntys');
                                        $ptrs = $med['ptrs'];
                                        $mpss = $med['mpss'];
                                    @endphp

                                    <td>{{ $ptrs }}</td>
                                    <td>{{ $mpss }}</td>
                                    <td>{{ $qntys }}</td>
                                    <td>{{ $qnty_mps_total }}</td>
                                    <td>{{ $qnty_ptr_total }}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
            @endfor


            <br>
            <br>
            <hr>

        </div>
    </div>
</div>






</form>

{{-- @php

$collection = collect($proreport);
$grouped = $collection->groupBy('select_medicine1');
$result = collect();

$grouped->each(function ($group) use ($result) {
    // Debugging: Inspect the structure of each group
    // echo json_encode($group);

    $qntys_sum = $group->sum('qntys');
    $ptrs_sum = $group->avg('ptrs');
    $mpss_sum = $group->avg('mpss');
    $grandtot1_sum = $group->sum('qnty_mps_total');
    $grandtot2_sum = $group->sum('qnty_ptr_total');
    $name = $group->first()->select_medicine1;

    // Fetch the batch number for each medicine
    $batch_no = DB::table('newmedicinemaster')
        ->where('select_company_id', $group[0]['select_company_id'])
        ->where('medicine_id', $name)
        ->value('batch_no');

    $item = [
        'select_medicine1' => $name,
        'batch_no' => $batch_no, // Add batch number to the result
        'qntys' => $qntys_sum,
        'ptrs' => $ptrs_sum,
        'mpss' => $mpss_sum,
        'qnty_mps_total' => $grandtot1_sum,
        'qnty_ptr_total' => $grandtot2_sum,
    ];

    $result->push($item);
});

// Sorting the result by 'select_medicine1'
$result = $result->sortBy('select_medicine1')->values()->toArray();

// Output the final result
// echo json_encode($result);


@endphp --}}

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
                        'select_batchs' => $firstItem['select_batchs'],
                    ];
                })
                ->values()
                ->all();
            // echo json_encode($medicineArray);

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

            return [
                'select_stokist_id' => $firstItem['select_stokist_id'],
                'select_medical_id' => $firstItem['select_medical_id'],
                'select_marketing_id' => $firstItem['select_marketing_id'],
                'promotor__sales_id' => $firstItem['promotor__sales_id'],
                'select_company_id' => $firstItem['select_company_id'],
                // 'select_batchs' => $firstItem['select_batchs'],
                'append_no' => $firstItem['append_no'],
                'sale_of_month' => $firstItem['sale_of_month'],
                'medicine_array' => $medicineArray,
                'medicine' => $medicine,
            ];
        })
        ->values()
        ->all();

@endphp

{{-- @json($groupedData['medicine_array']); --}}


<h6>Previously Added Medicine</h6>

<div class="card">
    <div class="card-body">
        <div class="row g-2">
        
            @if (empty(auth()->guard('marketings')->user()->id
                ))
                <div class="col-md-2">
                    <label for="inputFirstName" class="form-label" style="font-size: 15px;"><b>Stockist</b></label><br>
                    <label style="color: black;" id="marketmodal">{{ $proreport[0]->select_stokist_id }}</label>

                </div>


                <div class="col-md-2">
                    <label class="form-label" style="font-size: 15px;"><b>Company</b>
                    </label><br>
                    <label style="color: black;" id="companymodal">{{ $proreport[0]->Name }}</label>

                </div>
                <div class="col-md-4">
                    <label for="inputFirstName" class="form-label" style="font-size: 15px;"><b>Medical</b></label><br>
                    <label style="color: black;" id="marketmodal">{{ $proreport[0]->select_medical_id }}</label>

                </div>
                @php

                    $med_array = $groupedData[0]['medicine'];
                    $query22 = DB::table('promotorsalemedicine')
                        ->join('promotor__sales', 'promotor__sales.id', '=', 'promotorsalemedicine.promotor__sales_id')
                        ->where([
                            'promotor__sales.sale_of_month' => $groupedData[0]['sale_of_month'],
                            'select_stokist_id' => $groupedData[0]['select_stokist_id'],
                            'select_medical_id' => $groupedData[0]['select_medical_id'],
                        ])
                        ->whereIn('select_medicine1', $med_array);

                    $total_grand_total1 = $query22->sum('qnty_mps_total');
                    $total_grand_total2 = $query22->sum('qnty_ptr_total');

                @endphp


                @if (auth()->check())
                    <div class="col-md-2">
                        <label for="inputFirstName" class="form-label" style="font-size: 15px"><b>MPS
                                Total</b></label><br>
                        <label style="color:  black; font-size: 15px;"
                            id="Grandtotal1">{{ $total_grand_total1 }}</label>
                    </div>
                @endif

                <div class="col-md-2">
                    <label for="inputFirstName" class="form-label" style="font-size: 15px"><b>PTR Total</b>
                    </label><br>
                    <label style="color: black; font-size: 15px;" id="Grandtotal2">{{ $total_grand_total2 }}</label>

                </div>
        </div>

        <br>
        <table class="table mb-0 table-striped">
            <thead>

                <tr>
                    <th scope="col">Medicine </th>
                    <th scope="col">Batch No </th>
                    <th scope="col">PTR </th>
                    @if (auth()->check())
                        <th scope="col">MPS </th>
                    @endif
                    <th scope="col">Quantity </th>
                    @if (auth()->check())
                        <th scope="col">Quantity X MPS(Total) </th>
                    @endif

                    <th scope="col">Quantity X PTR(Total) </th>

                </tr>
            </thead>


            <tbody>
                @foreach ($groupedData as $group)
                    @foreach ($group['medicine_array'] as $medicineGroup)
                        @php
                            $query = DB::table('promotorsalemedicine')
                                ->leftjoin('promotor__sales', 'promotor__sales.id', '=', 'promotorsalemedicine.promotor__sales_id')
                                ->where([
                                    'select_stokist_id' => $group['select_stokist_id'],
                                    'select_medical_id' => $group['select_medical_id'],
                                    'select_medicine1' => $medicineGroup['medicine'],
                                    'ptrs' => $medicineGroup['ptrs'],
                                    'mpss' => $medicineGroup['mpss'],
                                    'promotor__sales.sale_of_month' => $group['sale_of_month'],
                                ]);

                            $result = $query->get();
                            // echo json_encode($result);

                            $qnty_mps_total = $result->sum('qnty_mps_total');
                            $qnty_ptr_total = $result->sum('qnty_ptr_total');
                            $qntys = $result->sum('qntys');
                            $ptrs = $medicineGroup['ptrs'];
                            $mpss = $medicineGroup['mpss'];
                        @endphp
                        <tr>
                            <td>{{ $medicineGroup['medicine'] }}</td>
                            <td>{{ $medicineGroup['select_batchs'] }}</td>
                            <td>{{ $medicineGroup['ptrs'] }}</td>
                            @if (auth()->check())
                                <td>{{ $medicineGroup['mpss'] }}</td>
                            @endif
                            <td>{{ $qntys }}</td>
                            @if (auth()->check())
                                <td>{{ $qnty_mps_total }}</td>
                            @endif
                            <td>{{ $qnty_ptr_total }}</td>
                            <!-- Add more columns as needed -->
                        </tr>
                    @endforeach
                @endforeach

            </tbody>

        </table>
    @else
        <div class="col-md-2">
            <label for="inputFirstName" class="form-label" style="font-size: 15px;"><b>Stockist</b></label><br>
            <label style="color: black;" id="marketmodal">{{ $proreport[0]->select_stokist_id }}</label>

        </div>


        <div class="col-md-2">
            <label class="form-label" style="font-size: 15px;"><b>Company</b>
            </label><br>
            <label style="color: black;" id="companymodal">{{ $proreport[0]->Name }}</label>

        </div>
        <div class="col-md-4">
            <label for="inputFirstName" class="form-label" style="font-size: 15px;"><b>Medical</b></label><br>
            <label style="color: black;" id="marketmodal">{{ $proreport[0]->select_medical_id }}</label>

        </div>
        @php

            $med_array = $groupedData[0]['medicine'];
            $query22 = DB::table('promotorsalemedicine')
                ->join('promotor__sales', 'promotor__sales.id', '=', 'promotorsalemedicine.promotor__sales_id')
                ->where([
                    'promotor__sales.sale_of_month' => $groupedData[0]['sale_of_month'],
                    'select_stokist_id' => $groupedData[0]['select_stokist_id'],
                    'select_medical_id' => $groupedData[0]['select_medical_id'],
                    'select_marketing_id' => $groupedData[0]['select_marketing_id'],
                ])
                ->whereIn('select_medicine1', $med_array);

            $total_grand_total1 = $query22->sum('qnty_mps_total');
            $total_grand_total2 = $query22->sum('qnty_ptr_total');

        @endphp


        @if (auth()->check())
            <div class="col-md-2">
                <label for="inputFirstName" class="form-label" style="font-size: 15px"><b>MPS
                        Total</b></label><br>
                <label style="color:  black; font-size: 15px;" id="Grandtotal1">{{ $total_grand_total1 }}</label>
            </div>
        @endif

        <div class="col-md-2">
            <label for="inputFirstName" class="form-label" style="font-size: 15px"><b>PTR Total</b>
            </label><br>
            <label style="color: black; font-size: 15px;" id="Grandtotal2">{{ $total_grand_total2 }}</label>

        </div>
    </div>

    <br>
    <table class="table mb-0 table-striped">
        <thead>

            <tr>
                <th scope="col">Medicine </th>
                <th scope="col">Batch No </th>
                <th scope="col">PTR </th>
                @if (auth()->check())
                    <th scope="col">MPS </th>
                @endif
                <th scope="col">Quantity </th>
                @if (auth()->check())
                    <th scope="col">Quantity X MPS(Total) </th>
                @endif

                <th scope="col">Quantity X PTR(Total) </th>

            </tr>
        </thead>


        <tbody>
            @foreach ($groupedData as $group)
                @foreach ($group['medicine_array'] as $medicineGroup)
                    @php
                        $query = DB::table('promotorsalemedicine')
                            ->leftjoin('promotor__sales', 'promotor__sales.id', '=', 'promotorsalemedicine.promotor__sales_id')
                            ->where([
                                'select_stokist_id' => $group['select_stokist_id'],
                                'select_medical_id' => $group['select_medical_id'],
                                'select_marketing_id' => $group['select_marketing_id'],
                                'select_medicine1' => $medicineGroup['medicine'],
                                'ptrs' => $medicineGroup['ptrs'],
                                'mpss' => $medicineGroup['mpss'],
                                'promotor__sales.sale_of_month' => $group['sale_of_month'],
                            ]);

                        $result = $query->get();
                        // echo json_encode($result);

                        $qnty_mps_total = $result->sum('qnty_mps_total');
                        $qnty_ptr_total = $result->sum('qnty_ptr_total');
                        $qntys = $result->sum('qntys');
                        $ptrs = $medicineGroup['ptrs'];
                        $mpss = $medicineGroup['mpss'];
                    @endphp
                    <tr>
                        <td>{{ $medicineGroup['medicine'] }}</td>
                        <td>{{ $medicineGroup['select_batchs'] }}</td>
                        <td>{{ $medicineGroup['ptrs'] }}</td>
                        @if (auth()->check())
                            <td>{{ $medicineGroup['mpss'] }}</td>
                        @endif
                        <td>{{ $qntys }}</td>
                        @if (auth()->check())
                            <td>{{ $qnty_mps_total }}</td>
                        @endif
                        <td>{{ $qnty_ptr_total }}</td>
                        <!-- Add more columns as needed -->
                    </tr>
                @endforeach
            @endforeach

        </tbody>

    </table>
    @endif

</div>
</div>

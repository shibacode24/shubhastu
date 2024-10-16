{{-- @php
    $data = json_decode($proreport, true);

    $groupedData = collect($data)
        ->groupBy(function ($item) {
            return $item['select_stokist_id'] . '|' . $item['select_medical_id']  . '|' . $item['select_marketing_id']. '|' . $item['sale_of_month'];
        })
        ->map(function ($group) {
            $firstItem = $group->first();

            return [
                'select_stokist_id' => $firstItem['select_stokist_id'],
                'select_medical_id' => $firstItem['select_medical_id'],
                'select_marketing_id' => $firstItem['select_marketing_id'],
                'promotor__sales_id' => $firstItem['promotor__sales_id'],
                'select_batchs' => $firstItem['select_batchs'],
                'append_no' => $firstItem['append_no'],
                'sale_of_month' => $firstItem['sale_of_month'],
                'medicine_array' => $group
                    ->pluck('select_medicine1')
                    ->unique()
                    ->values()
                    ->all(),
                // 'ptrs' => $group->unique('select_medicine1')->pluck('ptrs')->values()->all(),
                // 'mpss' => $group->pluck('mpss')->unique()->values()->all(),
            ];
        })
        ->values()
        ->all();

@endphp --}}

{{-- @php
    $data = json_decode($proreport, true);

    $groupedData = collect($data)
        ->groupBy(function ($item) {
            return $item['select_stokist_id'] . '|' . $item['select_medical_id'] . '|' . $item['select_marketing_id'] . '|' . $item['sale_of_month'];
        })
        ->map(function ($group) {
            $firstItem = $group->first();

            $medicineArray = $group
                ->map(function ($item) {
                    return [
                        'medicine' => $item['select_medicine1'],
                        'ptrs' => $item['ptrs'],
                        'mpss' => $item['mpss'],
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
            ];
        })
        ->values()
        ->all();

    //echo json_encode($groupedData);
@endphp --}}
@php
    $data = json_decode($proreport, true);

    $groupedData = collect($data)
        ->groupBy(function ($item) {
            return $item['select_stokist_id'] . '|' . $item['select_medical_id'] . '|' . $item['select_marketing_id'] . '|' . $item['sale_of_month'] ;
        })
        ->map(function ($group) {
            $firstItem = $group->first();

            $medicineArray = $group
                ->map(function ($item) {
                    return [
                        'medicine' => $item['select_medicine1'],
                        'ptrs' => $item['ptrs'],
                        'mpss' => $item['mpss'],
                        'qntys' => $item['qntys'],
                        'qnty_mps_total' => $item['qnty_mps_total'],
                        'qnty_ptr_total' => $item['qnty_ptr_total'],
                    ];
                })
                ->values()
                ->all();

            // Calculate sums for each group
            $qntysSum = $group->sum('qntys');
            $qntyMpsTotalSum = $group->sum('qnty_mps_total');
            $qntyPtrTotalSum = $group->sum('qnty_ptr_total');

            return [
                'select_stokist_id' => $firstItem['select_stokist_id'],
                'select_medical_id' => $firstItem['select_medical_id'],
                'select_marketing_id' => $firstItem['select_marketing_id'],
                'promotor__sales_id' => $firstItem['promotor__sales_id'],
                'select_batchs' => $firstItem['select_batchs'],
                'append_no' => $firstItem['append_no'],
                'sale_of_month' => $firstItem['sale_of_month'],
                'medicine_array' => $medicineArray,
                'qntys_sum' => $qntysSum,
                'qnty_mps_total_sum' => $qntyMpsTotalSum,
                'qnty_ptr_total_sum' => $qntyPtrTotalSum,
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
                    @if (auth()->check())
                        <th scope="col">Quantity X MPS(Total) </th>
                    @endif

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


                @if (auth()->guard('marketings')->check())
                    @php
                        $collection = collect($proreport);
                        $grouped = $collection->groupBy('select_medicine1');
                        $result = collect();

                        $authUser = auth()
                            ->guard('marketings')
                            ->user();

                        if ($authUser) {
                            $grouped->each(function ($group) use ($result, $authUser) {
                                // Filter records where select_marketing_id matches the authenticated user's ID
        $matchingRecords = $group->filter(function ($item) use ($authUser) {
            return $item->select_marketing_id == $authUser->id;
        });

        if ($matchingRecords->isNotEmpty()) {
            $qntys_sum = $matchingRecords->sum('qntys');
            $grandtot1_sum = $matchingRecords->sum('qnty_mps_total');
            $grandtot2_sum = $matchingRecords->sum('qnty_ptr_total');
            $name = $matchingRecords->first()->select_medicine1;

            $item = [
                'select_medicine1' => $name,
                'qntys' => $qntys_sum,
                'qnty_mps_total' => $grandtot1_sum,
                'qnty_ptr_total' => $grandtot2_sum,
                                    ];

                                    $result->push($item);
                                }
                            });
                        }

                        $result = $result->toArray();
                    @endphp
                @endif




                @for ($i = 0; $i < count($result); $i++)
                    <tr>

                        <td>{{ $result[$i]['select_medicine1'] }}</td>
                        <td>{{ $result[$i]['qntys'] }}</td>
                        @if (auth()->check())
                            <td>{{ $result[$i]['qnty_mps_total'] }}</td>
                        @endif
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
            @foreach ($groupedData as $group)
                <br>
                <div class="col-md-2">
                    <label class="form-label" style="font-size: 15px;"><b>Stockist</b></label><br>
                    <label style="color: black;" id="yearmodal">{{ $group['select_stokist_id'] }}</label>
                </div>
                <div class="col-md-2">
                    <label class="form-label" style="font-size: 15px;"><b>Marketing</b></label><br>
                    <label style="color: black;" id="yearmodal">{{ $group['select_marketing_id'] }}</label>
                </div>
                <div class="col-md-2">
                    <label class="form-label" style="font-size: 15px;"><b>Medical</b></label><br>
                    <label style="color: black;" id="yearmodal">{{ $group['select_medical_id'] }}</label>
                </div>
                <div class="col-md-2">
                    <label class="form-label" style="font-size: 15px;"><b>Grand Total 1</b></label><br>
                    <label style="color: black;" id="yearmodal">{{ number_format($group['qnty_mps_total_sum'], 2) }}</label>
                </div>
                <div class="col-md-2">
                    <label class="form-label" style="font-size: 15px;"><b>Grand Total 2</b></label><br>
                    <label style="color: black;" id="yearmodal">{{ number_format($group['qnty_ptr_total_sum'], 2) }}</label>
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
                        @foreach ($group['medicine_array'] as $med)
                            <tr>
                                <td>{{ $med['medicine'] }}</td>
                                <td>{{ $med['ptrs'] }}</td>
                                <td>{{ $med['mpss'] }}</td>
                                <td>{{ $med['qntys'] }}</td>
                                <td>{{ $med['qnty_mps_total'] }}</td>
                                <td>{{ $med['qnty_ptr_total'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach

            <br>
            <br>
            <hr>

        </div>
    </div>
</div>







</form>

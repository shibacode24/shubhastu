{{-- @php
    $data = json_decode($proreport, true);
    
    $groupedData = collect($data)
        ->groupBy(function ($item) {
            return $item['select_stokist_id'] . '|' . $item['select_medical_id'];
        })
        ->map(function ($group) {
            $firstItem = $group->first();
    
            return [
                'select_stokist_id' => $firstItem['select_stokist_id'],
                'select_medical_id' => $firstItem['select_medical_id'],
                'promotor__sales_id' => $firstItem['promotor__sales_id'],
                'append_no' => $firstItem['append_no'],
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

@php
    $data = json_decode($proreport, true);
    
    $groupedData = collect($data)
        ->groupBy(function ($item) {
            return $item['select_stokist_id'] . '|' . $item['select_medical_id'] . '|' . $item['promotor__sales_id'];
        })
        ->map(function ($group) {
            $firstItem = $group->first();
    
            return [
                'select_stokist_id' => $firstItem['select_stokist_id'],
                'select_medical_id' => $firstItem['select_medical_id'],
                'promotor__sales_id' => $firstItem['promotor__sales_id'],
                'select_batchs' => $firstItem['select_batchs'],
                'append_no' => $firstItem['append_no'],
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
    
@endphp



{{-- @php
    echo json_encode($groupedData);
@endphp --}}

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
    <div class="col-md-3">
        <label for="inputFirstName" class="form-label" style="font-size: 15px;"><b>Marketing</b></label><br>
        <label style="color: black;" id="marketmodal">{{ $proreport[0]->name }}</label>

    </div>


    <div class="col-md-3">
        <label for="inputFirstName" class="form-label" style="font-size: 15px;">
            <b>Client</b></label><br>
        <label style="color: black;" id="doctorclientmodal">{{ $proreport[0]->allotted_dr_name }}</label>

    </div>




    <div class="col-md-2">
        <label for="inputFirstName" class="form-label" style="font-size: 20px"><b>MPS Total</b></label><br>
        <label style="color:  black; font-size: 20px;" id="Grandtotal1">{{ $proreport[0]->total_grand_total1 }}</label>
    </div>
    <div class="col-md-2">
        <label for="inputFirstName" class="form-label" style="font-size: 20px"><b>PTR Total</b> </label><br>
        <label style="color: black; font-size: 20px;" id="Grandtotal2">{{ $proreport[0]->total_grand_total2 }}</label>

    </div>
	 <div class="col-md-2">
        @php
        $tds_value = (((float)$proreport[0]->tds / 100) * (float)$proreport[0]->total_grand_total1);
        @endphp
        <label for="inputFirstName" class="form-label" style="font-size: 20px"><b>TDS</b></label><br>
        <label style="color:  black; font-size: 20px;">
            {{ number_format($tds_value,2) }}</label>
    </div>
    <div class="col-md-2">
        @php
        $count=(((float)$proreport[0]->total_grand_total1)-((float)$proreport[0]->tds/100)*(float)$proreport[0]->total_grand_total1);

        @endphp
        <label for="inputFirstName" class="form-label" style="font-size: 20px"><b>Payable Amount</b></label><br>
        <label style="color:  black; font-size: 20px;">
            {{ number_format($count,2)}}</label>
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
                    //$resultArray = $result->all();
                    $result = json_decode($result, true);
                    
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
<div class="card">
    <div class="card-body">
        <div class="row g-2">

            @for ($i = 0; $i < count($groupedData); $i++)
                <br>
                <div class="col-md-2">
                    <label class="form-label" style="font-size: 15px;"><b>Stockist</b></label><br>
                    <label style="color: black;" id="yearmodal">{{ $groupedData[$i]['select_stokist_id'] }}</label>

                </div>
                <div class="col-md-2">
                    <label class="form-label" style="font-size: 15px;"><b>Medical</b></label><br>
                    <label style="color: black;" id="yearmodal">{{ $groupedData[$i]['select_medical_id'] }}</label>

                </div>
                @php
                    $grandtot1 = 0;
                    $grandtot2 = 0;
                    $query = DB::table('promotorsalemedicine')
                        ->where(['promotor__sales_id' => $groupedData[$i]['promotor__sales_id'], 'select_stokist_id' => $groupedData[$i]['select_stokist_id'], 'select_medical_id' => $groupedData[$i]['select_medical_id']])
                        ->groupby('append_no');
                    $grandtot1 = $query->pluck('grandtot1')->toArray();
                    $grandtot1 = array_sum($grandtot1);
                    
                    $grandtot2 = $query->pluck('grandtot2')->toArray();
                    $grandtot2 = array_sum($grandtot2);
                    
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

                        {{-- 
   @json($groupedData[$i]['ptrs'])
   <br>
   @json($groupedData[$i]['mpss']) --}}

   @json($groupedData)
                        @foreach ($groupedData[$i]['medicine_array'] as $key => $med)
                            <tr>

                                <td>{{ $med }}</td>

                                {{-- <td>{{$groupedData[$i]['ptrs'][$key]}}</td>
                       <td>{{$groupedData[$i]['mpss'][$key]}}</td> --}}
                                {{-- @php
                                    $qntys = 0;
                                    $query = DB::table('promotorsalemedicine')->where(['promotor__sales_id' => $groupedData[$i]['promotor__sales_id'], 'select_stokist_id' => $groupedData[$i]['select_stokist_id'], 'select_medical_id' => $groupedData[$i]['select_medical_id'], 'select_medicine1' => $med]);
                                    $qntys = $query->sum('qntys');
                                    $qnty_mps_total =  $query->sum('qnty_mps_total');
                                    $qnty_ptr_total = $query->sum('qnty_ptr_total');
                                    $ptrs =(clone $query)->select('ptrs')->first();
                                    $mpss = $query->sum('mpss');
                                @endphp --}}
                                @php
                                $qntys = 0;
                                $query = DB::table('promotorsalemedicine')->where([
                                    'promotor__sales_id' => $groupedData[$i]['promotor__sales_id'],
                                    'select_stokist_id' => $groupedData[$i]['select_stokist_id'],
                                    'select_medical_id' => $groupedData[$i]['select_medical_id'],
                                    // 'select_batchs' => $groupedData[$i]['select_batchs'],
                                    'select_medicine1' => $med
                                ]);
                            
                                $qntys = $query->sum('qntys');
                                $qnty_mps_total = $query->sum('qnty_mps_total');
                                $qnty_ptr_total = $query->sum('qnty_ptr_total');
                            
                                // Use first() to fetch a single result as an object
                                $ptrsObject = $query->select('ptrs')->first();
                                $ptrs = $ptrsObject->ptrs;

                                $mpssObject = $query->select('mpss')->first();
                                $mpss = $mpssObject->mpss;
                            


                                // $mpss = $query->sum('mpss');
                            @endphp
                            {{-- @json($groupedData[$i]) --}}
     
                                {{-- <td>@json($ptrs['ptrs'])</td> --}}
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

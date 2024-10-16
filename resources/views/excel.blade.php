<style>
    table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 6px;
 
}
</style>


@php
$groupedData = [];

foreach ($stocmed as $record) {
    // Calculate the sales for the current record
    // $count = (((float)$record->total_grand_total1) - ((float)$record->tds/100) * (float)$record->total_grand_total1);
    $count = $record->grand_total1;
    // echo number_format($count, 2);
    // echo ("<br>");
    $tds_value=(((float)$record->tds/100)*(float)$record->total_grand_total1);

    $key = $record["select_company_id"] . "-" . $record["select_doctor_id"];
    
    if (!isset($groupedData[$key])) {
        $groupedData[$key] = [
            "select_doctor_id" => $record["allotted_dr_name"],
            "pan_no" => $record["pan_no"],
            // "select_company_id" => $record["select_company_id"],
             "tds_value" => $tds_value,
            // Initialize an array to store sales for each month
            "sales_by_month" => [
                "$month[0]" => 0.00,
                "$month[1]" => 0.00,
                "$month[2]" => 0.00,
            ],
        ];
    }
    
    // Update the corresponding month's sales
   $dd= $groupedData[$key]["sales_by_month"][$record["sale_of_month"]] += $count;
}
 echo json_encode($month);
// echo json_encode($record->total_grand_total1);
@endphp

<h4>TDS Report</h4>
<table>
    <thead>
        <tr>
            <th>Doctor Name</th>
            {{-- <th>Company ID</th> --}}
            {{-- <th>Name</th> --}}
            <th>Pan No</th>
            @foreach ($month as $monthName)
                <th>{{ $monthName }}</th>
            @endforeach
            <th>Total</th>
            <th>TDS</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($groupedData as $group)
            <tr>
                <td>{{ $group['select_doctor_id'] }}</td>
                <td>{{ $group['pan_no'] }}</td>

                {{-- <td>{{ $group['select_company_id'] }}</td> --}}
                
                @php
                    $totalSales = 0;
                @endphp
                @foreach ($month as $monthName)
                    <td>{{ number_format($group["sales_by_month"][$monthName], 2) }}</td>
                    @php
                        $totalSales += $group["sales_by_month"][$monthName];
                    @endphp
                @endforeach
                <td>{{ number_format($totalSales, 2) }}</td>
                <td>{{ number_format($group['tds_value'],2) }}</td>
            </tr>
        @endforeach
    </tbody>
    
</table>
@section('js')
<script>
    // Get the current URL
var currentURL = window.location.href;

// Parse the query parameters from the URL
var urlParams = new URLSearchParams('http://localhost/shubhastu/public/tdsreport');

// Create an object to store the data
var urlData = {
    saleOfMonth: urlParams.get('sale_of_month'),
    company: urlParams.get('company'),
    doctor: urlParams.get('doctor')
};

// Pass the object to the next function
nextFunction(urlData);

    </script>
@stop

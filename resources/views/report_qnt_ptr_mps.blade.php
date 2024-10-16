{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Quantity Report</title>
</head>
<body>


<table style="width: 70%; margin-left: 18%; border-collapse: collapse; border: 1px solid black;">
    <thead>
        <tr>
           
            <th style="border: 1px solid black; padding: 5px;">Medicine Name</th>
            <th style="border: 1px solid black; padding: 5px;">Total Quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach($proreport as $item)
            <tr>
                <td style="border: 1px solid black; padding: 5px;">{{ $item->select_medicine1 }}</td>
                <td style="border: 1px solid black; padding: 5px;">{{ $item->total_quantity }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Quantity Report</title>
</head>
<body>

<table style="width: 70%; margin-left: 18%; border-collapse: collapse; border: 1px solid black;">
    <thead>
        <tr>
            <th style="border: 1px solid black; padding: 5px;">Month</th>
            <th style="border: 1px solid black; padding: 5px;">Medicine Name</th>
            <th style="border: 1px solid black; padding: 5px;">Total Quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach($saleMonths as $month)
            @foreach($proreport as $item)
                @if($item->sale_of_month == $month)
                    <tr>
                        @if($loop->first)
                            <td rowspan="{{ $medicinesCount[$month] }}" style="border: 1px solid black; padding: 5px;">{{ $month }}</td>
                        @endif
                        <td style="border: 1px solid black; padding: 5px;">{{ $item->select_medicine1 }}</td>
                        <td style="border: 1px solid black; padding: 5px;">{{ $item->total_quantity }}</td>
                    </tr>
                @endif
            @endforeach
        @endforeach
    </tbody>
</table>

</body>
</html>



{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Quantity Report</title>
</head>
<body>

<table style="width: 70%; margin-left: 18%; border-collapse: collapse; border: 1px solid black;">
    <thead>
        <tr>
            <th style="border: 1px solid black; padding: 5px;">Month</th>
            <th style="border: 1px solid black; padding: 5px;">Medicine Name</th>
            <th style="border: 1px solid black; padding: 5px;">Total Quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach($monthlyReports as $month => $medicines)
            @foreach($medicines as $item)
                <tr>
                    @if($loop->first)
                        <td rowspan="{{ count($medicines) }}" style="border: 1px solid black; padding: 5px;">{{ $month }}</td>
                    @endif
                    <td style="border: 1px solid black; padding: 5px;">{{ $item->select_medicine1 }}</td>
                    <td style="border: 1px solid black; padding: 5px;">{{ $item->total_quantity }}</td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

</body>
</html> --}}

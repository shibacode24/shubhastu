@extends('layout')
@section('content')

    <style>
        .td {
            width: 40%;
        }
    </style>
    <div class="page-wrapper">
        <div class="page-content">

            <div class="card" style="width: 70%;margin-left:15%;margin-top:-8%">
            {{-- @json($profit) --}}
                <div class="card-body">
                    <h6 class="mb-0 text-uppercase">Profit & Loss</h6>
                    <br>
                    {{-- @if ($profit->isEmpty())

                    <p>No data available</p>

                   @else --}}
                   @if (count($profit) > 0)
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th scope="col">Perticular</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody class="td">
                            <tr>
                                <td class="td">Secondary sales</td>
                                <td>{{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", $profit[0]->total_grand_total2) }}
                                </td>
                            </tr>
                            <tr>
                                <td>Stockist Margin (10%)</td>
                                @php
                                    $stockist_value = ((float) 10 / 100) * (float) $profit[0]->total_grand_total2;
                                @endphp
                                <td>{{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", $stockist_value)}}</td>
                            </tr>
                            <tr>
                                <td>Receivable Amount</td>
                                @php
                                    $receivable_value =  $profit[0]->total_grand_total2 - $stockist_value;
                                @endphp
                                <td>{{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", $receivable_value)}}</td>
                            </tr>
                            <tr>
                                <td>Purchase</td>
                                <td>{{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", $profit[0]->total_grand_total1) }}</td>
                            </tr>
                          
                            <tr>
                                <td>Tds ({{$tds->tds}}%)</td>
                                @php
                                $tds=(((float)$tds->tds/100)*(float)$tds_sum);
                                @endphp
                                <td>{{ number_format($tds,2) }}</td>
                            </tr>
                            <tr>
                                @php
                                //    $count=(((float)$tds_sum)-((float)$tds->tds/100)*(float)$tds_sum);
                                   $Payable_amt=(((float)$tds_sum)-$tds);
                                @endphp
                                <td>Payable Amount</td>
                                <td>{{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", number_format($Payable_amt, 2, '.', '')) }}</td>
                            </tr>
                            <tr>
                                <td>Expenses</td>
                                <td>{{preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,",$expense_sum)}}</td>
                            </tr>
                            <tr>
                                @php
                                // $tds_minus_payable =  $Payable_amt -  $tds;
                                $total = $receivable_value -$Payable_amt -($profit[0]->total_grand_total1) - $expense_sum - $tds;
                                // $total = $Payable_amt -  $count - $expense_sum;
                
                           // $total = round($total, 2);
                            // $formattedTotal = number_format($total, 2, '.', ''); //for number format like 1,79,469.54
                             @endphp
                                <td>Total P & L</td>
                                <td>{{preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", number_format($total, 2, '.', ''))}}</td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                    <p style="color: red;">Data not available.</p>
                    @endif
                </div>
            </div>
            <div style="margin-left: 80%;">
            <a href="{{ route('getdata_profitloss') }}" class="btn btn-primary" >Back</a>
            </div>
        </div>
    </div>
@stop

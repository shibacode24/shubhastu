@extends('layout')
@section('content')

    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-md-12 mx-auto" style="margin-top: -10%;">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center">

                                <h5 class="mb-0 text-primary"> Profit And Loss Mix Report</h5>
                            </div>
                      
                            <hr>
                            @if (count($errors) > 0)
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }} </li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="row g-2">
                                <form class="row g-2" action="{{ route('profit_and_loss_mix_report') }}" method="get">

                                    <div class="col-md-3">
                                        <label class="form-label">Company</label>
                                        <select class="multiple-select" data-placeholder="Choose anything" 
                                            name="company_id">
                                            <option disabled selected>Select</option>
                                            @foreach ($company as $companys)
                                                <option value="{{ $companys->id }}"
                                                    @if (app()->request->company_id == $companys->id) selected @endif>
                                                    {{ $companys->Name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Year</label>
                                        <select class="multiple-select" data-placeholder="Choose anything" id="year"
                                            name="year_id">

                                            @foreach ($year as $years)
                                                <option value="{{ $years->id }}"
                                                    @if (app()->request->year_id == $years->id) selected @endif>
                                                    {{ $years->year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- <div class="col-md-2">
                                        <label for="inputFirstName" class="form-label">Month</label> --}}
{{-- 
                                    <select class="multiple-select" data-placeholder="Choose anything" id="month" name="sale_of_month[]" multiple>
                                        @php
                                            $selectedMonths = app()->request->input('sale_of_month');
                                        @endphp
                                        @foreach (range(1, 12) as $monthNumber)
                                            @php
                                                $monthName = date('F', mktime(0, 0, 0, $monthNumber, 1));
                                            @endphp
                                            <option value="{{ $monthName }}" @if(!empty(app()->request->input('sale_of_month')) && (in_array($monthName, $selectedMonths))) selected @endif>
                                                {{ $monthName }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div> --}}
                                    
              

                                    {{-- <div class="col-md-3">
                                        <label for="inputFirstName" class="form-label">Type</label>
                                        <select class="multiple-select" data-placeholder="Choose anything" id="type"
                                            name="type">
                                            <option value="qty" @if (app()->request->type == 'qty') selected @endif>QTY</option>
                                            @if (auth()->check())
                                            <option value="purchase" @if (app()->request->type == 'purchase') selected @endif>Purchase</option> 
                                            @endif
                                            
                                        </select>

                                    </div> --}}
                               
                                    <div class="col-md-12">
                                        <label><b>Select Month :</b></label>
                                    </div>
                                        <div class="col-md-1">
                                            <div class="month-checkbox">
                                                <input type="checkbox" id="january" name="sale_of_month[]" value="January" {{ in_array('January', app('request')->input('sale_of_month') ?? []) ? 'checked' : '' }}>
                                                <label for="january">January</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="month-checkbox">
                                                <input type="checkbox" id="february" name="sale_of_month[]" value="February" {{ in_array('February', app('request')->input('sale_of_month') ?? []) ? 'checked' : '' }}>
                                                <label for="february">February</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="month-checkbox">
                                                <input type="checkbox" id="march" name="sale_of_month[]" value="March" {{ in_array('March', app('request')->input('sale_of_month') ?? []) ? 'checked' : '' }}>
                                                <label for="march">March</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="month-checkbox">
                                                <input type="checkbox" id="april" name="sale_of_month[]" value="April" {{ in_array('April', app('request')->input('sale_of_month') ?? []) ? 'checked' : '' }}>
                                                <label for="april">April</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="month-checkbox">
                                                <input type="checkbox" id="may" name="sale_of_month[]" value="May" {{ in_array('May', app('request')->input('sale_of_month') ?? []) ? 'checked' : '' }}>
                                                <label for="may">May</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="month-checkbox">
                                                <input type="checkbox" id="june" name="sale_of_month[]" value="June" {{ in_array('June', app('request')->input('sale_of_month') ?? []) ? 'checked' : '' }}>
                                                <label for="june">June</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="month-checkbox">
                                                <input type="checkbox" id="july" name="sale_of_month[]" value="July" {{ in_array('July', app('request')->input('sale_of_month') ?? []) ? 'checked' : '' }}>
                                                <label for="july">July</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="month-checkbox">
                                                <input type="checkbox" id="august" name="sale_of_month[]" value="August" {{ in_array('August', app('request')->input('sale_of_month') ?? []) ? 'checked' : '' }}>
                                                <label for="august">August</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="month-checkbox">
                                                <input type="checkbox" id="september" name="sale_of_month[]" value="September" {{ in_array('September', app('request')->input('sale_of_month') ?? []) ? 'checked' : '' }}>
                                                <label for="september">September</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="month-checkbox">
                                                <input type="checkbox" id="october" name="sale_of_month[]" value="October" {{ in_array('October', app('request')->input('sale_of_month') ?? []) ? 'checked' : '' }}>
                                                <label for="october">October</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="month-checkbox">
                                                <input type="checkbox" id="november" name="sale_of_month[]" value="November" {{ in_array('November', app('request')->input('sale_of_month') ?? []) ? 'checked' : '' }}>
                                                <label for="november">November</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="month-checkbox">
                                                <input type="checkbox" id="december" name="sale_of_month[]" value="December" {{ in_array('December', app('request')->input('sale_of_month') ?? []) ? 'checked' : '' }}>
                                                <label for="december">December</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12" style="margin-top:5vh;margin-bottom:3vh;text-align:center;">
                                        <button type="submit" class="btn btn-primary px-2"><i class="lni lni-search-alt"
                                                id="search"></i>
                                            Search</button>
                                        <a href="{{ route('profit_and_loss_mix_report') }}" class="btn btn-primary px-3"><i
                                                class='bx bx-refresh me-0'></i>
                                            Refresh</a>
                                    </div>
                                </form>

                                <hr>

                                <table id="example9" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Month</th>
                                            <th>Secondary Sales</th>
                                            <th>Stockist Margin (10%)</th>
                                            <th>Receivable Value</th>
                                            <th>Purchase</th>
                                            <th>TDS (5%)</th>
                                            <th>Payable</th>
                                            <th>Expenses </th>
                                            <th>Total Profit/Loss</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($monthwise_profits as $month => $profits)
                                            @foreach ($profits as $profit)
                                                @php
                                                    $stockist_value = ((float) 10 / 100) * (float) $profit->total_grand_total2;
                                                    $receivable_value = $profit->total_grand_total2 - $stockist_value;
                                                    $td = (($tds->tds / 100) * ($profit->tds_sum));
                                                    $Payable = ((float)$profit->tds_sum - $td);
                                                    $total_pl = $receivable_value - $Payable - $profit->total_grand_total1 - $profit->expense_sum - $td;
                                                @endphp
                                                <tr>
                                                    <td>{{ $month }}</td>
                                                    <td>
                                                        {{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", $profit->total_grand_total2) }}
                                                    </td>
                                                    <td>{{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,",$stockist_value) }}</td>
                                                    <td>{{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,",$receivable_value) }}</td>
                                                    <td>{{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,",$profit->total_grand_total1) }}</td>
                                                    <td>{{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,",$td) }}</td>
                                                    <td>{{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,",$Payable) }}</td>
                                                    <td>{{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,",$profit->expense_sum) }}</td>
                                                    <td>{{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,",$total_pl) }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                                
                                {{-- <table id="example9" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Metric</th>
                                            @foreach ($monthwise_profits as $month => $profits)
                                                <th>{{ $month }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            // Initialize arrays to store metric values
                                            $total_grand_total1 = [];
                                            $total_grand_total2 = [];
                                            $tds_sum = [];
                                            $expense_sum = [];
                                            $receivable_values = [];
                                            $payables = [];
                                            $total_pls = [];
                                        @endphp
                                
                                        @foreach ($monthwise_profits as $month => $profits)
                                            @foreach ($profits as $profit)
                                                @php
                                                    $stockist_value = ((float) 10 / 100) * (float) $profit->total_grand_total2;
                                                    $receivable_value = $profit->total_grand_total2 - $stockist_value;
                                                    $td = (($tds->tds / 100) * ($profit->tds_sum));
                                                    $Payable = ((float)$profit->tds_sum - $td);
                                                    $total_pl = $receivable_value - $Payable - $profit->total_grand_total1 - $profit->expense_sum - $td;
                                
                                                    $total_grand_total1[] = $profit->total_grand_total1;
                                                    $total_grand_total2[] = $profit->total_grand_total2;
                                                    $tds_sum[] = $profit->tds_sum;
                                                    $expense_sum[] = $profit->expense_sum;
                                                    $receivable_values[] = $receivable_value;
                                                    $payables[] = $Payable;
                                                    $total_pls[] = $total_pl;
                                                @endphp
                                            @endforeach
                                        @endforeach
                                
                                        <tr>
                                            <td>Total Grand Total 1</td>
                                            @foreach ($total_grand_total1 as $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Total Grand Total 2</td>
                                            @foreach ($total_grand_total2 as $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>TDS Sum</td>
                                            @foreach ($tds_sum as $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Expense Sum</td>
                                            @foreach ($expense_sum as $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Receivable Value</td>
                                            @foreach ($receivable_values as $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Payable</td>
                                            @foreach ($payables as $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Total Profit/Loss</td>
                                            @foreach ($total_pls as $value)
                                                <td>{{ $value }}</td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table> --}}
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@stop
@section('js')

<script>
    $(document).ready(function() {
        if ($('#example9').length) {
            var table = $('#example9').DataTable({
                lengthChange: true,
                ordering: true,
                "columnDefs": [
                    { "orderable": false, "targets": [0] }
                ],
                buttons: [
                    // {
                    //     extend: 'copyHtml5',
                    //     title: 'Custom Copy Title' // Custom title for copied data
                    // },
                    {
                        extend: 'excelHtml5',
                        title: 'Profit And Loss Mix Report', // Custom title for Excel file
                        filename: 'profit_and_loss_mix_report' // Custom file name for Excel
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Profit And Loss Mix Report', // Custom title for PDF document
                        filename: 'profit_and_loss_mix_report' // Custom file name for PDF
                    },
                    {
                        extend: 'print',
                        title: 'profit_and_loss_mix_report' // Custom title for printed document
                    }
                ]
            });

            table.buttons().container()
                .appendTo('#example9_wrapper .col-md-6:eq(0)');
        }
    });
</script>
@stop
@section('content')
    @extends('layout')
	{{-- <style>
        .border {
            border: 1px solid #000 !important; /* Border width and color */
            padding: 2px; /* Padding */
            border-collapse: collapse !important;
        }
    </style> --}}
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-md-12 mx-auto" style="margin-top: -10%;">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center">

                                <h5 class="mb-0 text-primary">Profit & Loss Statement</h5>
                            </div>
                            <hr>
                            <form class="row g-2" method="get" action="">
                                @csrf

                                <div class="col-md-2">
                                    <div class="yearWrapper">
                                        <label class="form-label">Year</label>

                                        <select class="multiple-select" data-placeholder="Choose anything" name="year"
                                            id="year">
                                            {{-- <option value="Select">Select</option> --}}
                                            @foreach ($year as $years)
                                                <option value="{{ $years->id }}"
                                                    @if (app()->request->year == $years->id) selected @endif>
                                                    {{ $years->year }}
                                                    {{-- @if (app('request')->input('year') == $years->id) selected @endif>
                                                    {{ $years->year }} --}}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Month</label>

                                    <select class="multiple-select" data-placeholder="Choose anything" id="month"
                                        name="month">

                                        @php
                                            // $selectedMonth = Session::has('month') ? Session::get('month') : date('F', strtotime('-1 month'));

                                            $selectedMonth = app()->request->input('month') ? app()->request->input('month') : date('F', strtotime('-1 month'));
                                        @endphp
                                        @foreach (range(1, 12) as $monthNumber)
                                            @php
                                                $monthName = date('F', mktime(0, 0, 0, $monthNumber, 1));
                                            @endphp
                                            <option value="{{ $monthName }}"
                                                @if ($selectedMonth == $monthName) selected @endif>
                                                {{ $monthName }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-2">
                                    <label for="inputFirstName" class="form-label">Select Company</label>

                                    <select class="multiple-select" data-placeholder="Choose anything" name="company"
                                        id="company">
                                        <option value="">All</option>
                                        @foreach ($company as $medicals)
                                            <option value="{{ $medicals->id }}">
                                                {{ $medicals->Name }} </option>
                                        @endforeach
                                    </select>
                                </div>




                                <div class="col-md-4" style="margin-top:3.4%; ">
                                    <button type="submit" class="btn btn-primary px-3" id="search"><i
                                            class="fadeIn animated bx bx-plus"></i> Search </button>
                                    <a href="{{ route('getdata_profitloss') }}" class="btn btn-primary px-3"><i
                                            class='bx bx-refresh me-0'></i> Refresh</a>
                                </div>

                            </form>

                        </div>

                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Sr. No.</th>
                                            <th>Year</th>
                                            <th>Month</th>
                                            <th>Company</th>
                                            <th>Total P & L</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($profit as $profits)

                                       
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $profits->year }}</td>
                                                <td>{{ $profits->sale_of_month }}</td>
                                                <td>{{ $profits->Name }}</td>
                                                @php
                                                    $stockist_value = ((float) 10 / 100) * (float) $profits->total_grand_total2;

                                                    $receivable_value =  $profits->total_grand_total2 - $stockist_value;

                                                    $td=(($tds->tds/100)* ($profits->tds_sum));

                                                    $Payable=(((float)$profits->tds_sum)-$td);

                                                    $total_pl = $receivable_value -$Payable -($profits->total_grand_total1) - ($profits->expense_sum) - $td; 

                                                    // echo $total;
                                                @endphp
                                                <td> {{ number_format($total_pl, 2) }}</td>
                                                <td> <button type="button" class="btn btn-primary px-3 viewinfo"
                                                        data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal{{$loop->index}}">Show</button></td>


                                            </tr>
                                       
                                        <div class="modal fade" id="exampleExtraLargeModal{{$loop->index}}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Profit & Loss</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body" style="width: 70%;margin-left:18%;">
                        
                                                        {{-- <div class="card" style="width: 70%;"> --}}
                        
                                                            <div class="container">
                                                                <div class="row border">
                                                                    <div class="col">
                                                                        <div class="row border">
                                                                            <div class="col-6 border">
                                                                             
                                                                                <h6>Perticular</h6>
                                                                            </div>
                                                                            <div class="col-6 border">
                                                                                <h6>Amount</h6>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row border">
                                                                            <div class="col-6 border">Secondary sales</div>
                                                                            <div class="col-6 border">
                                                                                {{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", $profits->total_grand_total2) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row border">
                                                                            <div class="col-6 border">Stockist Margin (10%)</div>
                                                                            <div class="col-6 border">
                                                                                @php
                                                                                $stockist_value = ((float) 10 / 100) * (float) $profits->total_grand_total2;
                                                                                @endphp
                                                                                {{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", $stockist_value)}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row border">
                                                                            <div class="col-6 border">Receivable Amount</div>
                                                                            <div class="col-6 border">
                                                                                @php
                                                                                $receivable_value =  $profits->total_grand_total2 - $stockist_value;
                                                                                @endphp
                                                                                {{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", $receivable_value)}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row border">
                                                                            <div class="col-6 border">Purchase</div>
                                                                            <div class="col-6 border">
                                                                                {{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", $profits->total_grand_total1) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row border">
                                                                            <div class="col-6 border">TDS ({{$tds->tds}}%)</div>
                                                                            <div class="col-6 border">
                                                                                @php
                                                                                $tds2 = (((float)$tds->tds / 100) * ($profits->tds_sum));
  
                                                                                @endphp
                                                                                {{ number_format($tds2, 2) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row border">
                                                                            @php
                                                                            $Payable_amt = (((float)$profits->tds_sum) - $tds2);
                                                                            @endphp
                                                                            <div class="col-6 border">Payable Amount</div>
                                                                            <div class="col-6 border">
                                                                                {{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", number_format($Payable_amt, 2, '.', '')) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row border">
                                                                            <div class="col-6 border">Expenses</div>
                                                                            <div class="col-6 border">
                                                                                {{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", $profits->expense_sum) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row border">
                                                                            @php
                                                                            $total = $receivable_value - $Payable_amt - ($profits->total_grand_total1) - ($profits->expense_sum) - $tds2;
                                                                            @endphp
                                                                            <div class="col-6 border">Total P & L</div>
                                                                            <div class="col-6 border">
                                                                                {{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", number_format($total, 2, '.', '')) }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                        
                                                        {{-- </div> --}}
                        
                                                        {{-- <div style="margin-left: 80%;">
                                                                <a href="{{ route('getdata_profitloss') }}" class="btn btn-primary" >Back</a>
                                                                </div> --}}
                        
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                           
                                        @endforeach
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			{{-- @json($profit) --}}
            {{-- @if (count($profit) > 0)
              
            @endif --}}

            <!--end page wrapper -->
            <!--start overlay-->

        @stop

        @section('js')
            <script>
                $(document).ready(function() {

                    $('#search').on('click', function() {
                        // alert(1)
                        var year = $("#year").val();
                        var month = $("#month").val();
                        var company = $("#company").val();
                        // var stockist = $("#stockist").val();
                        // var salevalue = $("#salevalue").val();


                    })
                })
            </script>
        @stop

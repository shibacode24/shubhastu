@extends('layout')
@section('content')


    {{-- <style>
    table,
    th,
    td {
        border: 1px solid black;


    }

    .td {
        font-size: 5px;
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

                                <h5 class="mb-0 text-primary">Secondary Sales Report</h5>
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
                                <form class="row g-2" action="{{ route('secondaryreport') }}" method="get">
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
                                    <div class="col-md-3">
                                        <label for="inputFirstName" class="form-label">Month</label>


                                        <select class="multiple-select" data-placeholder="Choose anything" id="month"
                                            name="sale_of_month">

                                            @php
                                                // $selectedMonth = Session::has('sale_of_month') ? Session::get('sale_of_month') :date('F', strtotime('-1 month'));

                                                 $selectedMonth = app()->request->input('sale_of_month') ? app()->request->input('sale_of_month') :date('F', strtotime('-1 month'));
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

                                    <div class="col-md-3">
                                        <label for="inputFirstName" class="form-label">Select Company</label>

                                        <select class="multiple-select companystokist medicaleschme"
                                            data-placeholder="Choose anything" id="company" name="company">
                                            <option value="">All</option>
                                            @foreach ($company as $companys)
                                                <option value="{{ $companys->id }}">
                                                    {{ $companys->Name }} </option>
                                            @endforeach
                                        </select>

                                    </div>

                                    {{-- <div class="col-md-3">
                                        <label for="inputFirstName" class="form-label">Select Stockist</label>

                                        <select class="multiple-select" data-placeholder="Choose anything" id="stockist"
                                            name="stockist">
                                            <option value="">All</option>

                                            @foreach ($stockist as $companys)
                                                <option value="{{ $companys->id }}">
                                                    {{ $companys->stockist }} </option>
                                            @endforeach

                                        </select>

                                    </div> --}}
                                    <div class="row">
                                        <div class="col-md-12" style="padding:8px;text-align:right"><br>
                                            <button type="submit" class="btn btn-primary px-3"><i
                                                    class="lni lni-search-alt" id="search"></i> Search</button>
                                            <a href="{{ route('secondaryreport') }}" class="btn btn-primary px-3"><i
                                                    class='bx bx-refresh me-0'></i> Refresh</a>
                                        </div>

                                    </div>


                                </form>
                            </div>
                        </div>
                    </div>

                    <hr />
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('secondarymail') }}" method="post">
                                @csrf
                                <div class="table-responsive">

                                    {{-- <button type="submit" style="padding:6px" class="btn1  btn-primary px-3" name="action"
                                        value="pdf">Download PDF</button> --}}

                                    {{-- <button type="submit" style="padding:6px" class="btn1  btn-primary px-3" name="action"
                                        value="mail">Mail</button> --}}
                                    <table id="example9" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                {{-- <th>Check Box</th> --}}
                                                <th>Sr. No</th>
                                                <th>Year</th>
                                                <th>Month</th>
                                                <th>Company</th>
                                                {{-- <th>Stockist</th> --}}
                                                {{-- <th>Purchase Rate</th> --}}
                                                @if (auth()->check())
                                                    <th>Grand Total</th>
                                                @endif
                                                <th>Sale value</th>
                                                
                                                <th style="background-color: #fff">Action</th>
                                                
                                            </tr>
                                        </thead>
                                        {{-- @json($secondary) --}}
                                        <tbody>
                                            @foreach ($secondary as $report)
                                                <tr>
                                                    {{-- <td><input type="checkbox" value="{{ $report->id }}"
                                                            name="record_id[]"></td> --}}
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $report->year }}</td>
                                                    <td>{{ $report->sale_of_month }}</td>
                                                    <td>{{ $report->Name }}</td>
                                                    {{-- <td>{{ $report->stockist }}</td> --}}
                                                    {{-- <td> --}}

                                                    {{-- 
                                                        <?php
                                                        
                                                        // $count=(((float)$report->purchase_rate)+((float)$report->tds/100)*(float)$report->grand_total1);
                                                        
                                                        // echo $count ;
                                                        // $count = DB::table('secondary_medicines')
                                                        //         ->where('secondary__sales_id', 'secondary__sales_id')
                                                        //         ->where('purchase_rate')
                                                        //         ->SUM('purchase_rate');
                                                        
                                                        //         echo  $count;
                                                        
                                                        //  $purchase_rate = $promotor->where('secondary__sales_id',$report->id)
                                                        //  ->sum('purchase_rate');
                                                        
                                                        //  echo $purchase_rate;
                                                        
                                                        //
                                                        ?>   
                                                    
                                                    
                                                    </td> --}}
                                                    @if (auth()->check())
                                                        <td>{{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", $report->total_grand_total1) }}
                                                        </td>
                                                    @endif

                                                    <td>{{ preg_replace('/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/i', "$1,", $report->total_grand_total2) }}
                                                    </td>
                                                   
                                                    <td style="background-color: #fff">

                                                        <button type="button" class="btn btn-primary px-3 viewinfo"
                                                            data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal"
                                                            id="{{ $report->secondary__sales }}">Show</button>
                                                            @if (auth()->guard('marketings')->check() || (auth()->check()) && auth()->user()->role == 0)
                                                        {{-- <a
                                                            href="{{ route('edit-secondarysalesreport', $report->secondary__sales) }}">
                                                            <button type="button" class="btn1 btn-outline-success"><i
                                                                    class='bx bx-edit-alt me-0'></i></button></a> --}}
{{-- @json($report->master_id) --}}
                                                                    {{-- <a
                                                                    href="{{ route('edit-secondarysalesreport_for_marketing', ['id' => $report->secondary__sales]) }}">
                                                                    <button type="button" class="btn1 btn-outline-success"><i
                                                                            class='bx bx-edit-alt me-0'></i>ffg</button></a> --}}

                                                        <a
                                                            href="{{ route('destroy-secondary_sale', $report->secondary__sales) }}">
                                                            <button type="button" class="btn1 btn-outline-danger"
                                                                onclick="return confirm('Are You Sure To Delete This?')"><i
                                                                    class='bx bx-trash me-0'></i></button>
                                                        </a>
                                                        @endif
                                                    </td>
                                                
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--end page wrapper -->

            <!-- Button trigger modal -->

            <!-- Modal -->
            <div class="modal fade" id="exampleExtraLargeModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Secondary Sale Report</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2" id="appendbody">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="exampleExtraLargeModal11" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Secondary Sale Report</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-2" id="appendbody">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

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
                                title: 'Secondary Sales Report', // Custom title for Excel file
                                filename: 'Secondary_Sales_Report' // Custom file name for Excel
                            },
                            {
                                extend: 'pdfHtml5',
                                title: 'Secondary Sales Report', // Custom title for PDF document
                                filename: 'Secondary_Sales_Report' // Custom file name for PDF
                            },
                            {
                                extend: 'print',
                                title: 'Secondary_Sales_Report' // Custom title for printed document
                            }
                        ]
                    });
    
                    table.buttons().container()
                        .appendTo('#example9_wrapper .col-md-6:eq(0)');
                }
            });
        </script>

            <script>
                $(document).ready(function() {
                    $(document).on('click', '.viewinfo', function() {


                        var entry_id = $(this).attr('id');

                        $.ajax({
                            url: 'secondary_sale_entry_details',
                            type: 'get',
                            data: {
                                entry_id: entry_id
                                // summary_id:summary_id
                            },
                            dataType: 'json',
                            success: function(data) {
                                $("#appendbody").empty();

                                $("#appendbody").html(data);

                            }
                        });

                    });




                    $("#company").on('change', function() {
                        $.ajax({
                            url: "{{ route('stockist') }}",
                            type: 'get',
                            data: {
                                id: $(this).val()
                            },
                            cache: false,
                            success: function(result) {
                                $("#stockist").empty();
                                $("#stockist").append(' <option value=""> Select </option>');
                                $.each(result, function(a, b) {
                                    $("#stockist").append(' <option value="' + b.id + '">' + b
                                        .stockist + '</option>');
                                })
                            }
                        });
                    })

                })
            </script>

            <script>
                $(document).ready(function() {

                    $('#search').on('click', function() {
                        // alert(1)
                        var year = $("#year").val();
                        var month = $("#month").val();
                        var company = $("#company").val();
                        var stockist = $("#stockist").val();
                        // var salevalue = $("#salevalue").val();


                    })
                })
            </script>


        @stop

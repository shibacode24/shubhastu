

@extends('layout')
@section('content')




    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-md-12 mx-auto" style="margin-top: -10%;">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center">

                                <h5 class="mb-0 text-primary"> Promoter Sales Report</h5>
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
                                <form class="row g-2" action="{{ route('medicinesalereport') }}" method="get">

                                    <div class="col-md-1">
                                        <label class="form-label">Year</label>
                                        <select class="multiple-select" data-placeholder="Choose anything" id="year"
                                            name="year_id">

                                            @foreach ($year as $years)
                                                <option value="{{ $years->id }}" @if (app()->request->year_id == $years->id) selected @endif>
                                                    {{ $years->year }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="inputFirstName" class="form-label">Month</label>


                                        <select class="multiple-select" data-placeholder="Choose anything" id="month"
                                            name="sale_of_month">

                                            @php
                                                // $selectedMonth = Session::has('sale_of_month') ? Session::get('sale_of_month') : date('F', strtotime('-1 month'));
                                                $selectedMonth = app()->request->input('sale_of_month') ?  app()->request->input('sale_of_month') : date('F', strtotime('-1 month'));
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

                                        <select class="multiple-select companystokist medicaleschme"
                                            data-placeholder="Choose anything" id="company" name="company">
                                            <option value="">All</option>
                                            @foreach ($company as $companys)
                                                <option value="{{ $companys->id }}">
                                                    {{ $companys->Name }} </option>
                                            @endforeach
                                        </select>

                                    </div>


                                    <div class="col-md-2">
                                        <label for="inputFirstName" class="form-label">Select Doctor</label>

                                        <select class="multiple-select" data-placeholder="Choose anything" id="doctor"
                                            name="doctor">
                                            <option value="">All</option>
                                            @foreach ($doctor as $doctors)
                                                <option value="{{ $doctors->id }}">
                                                    {{ $doctors->allotted_dr_name }} </option>
                                            @endforeach

                                        </select>

                                    </div>
                                    <div class="col-md-4" style="margin-top:3vh"><br>
                                        <button type="submit" class="btn btn-primary px-2"><i class="lni lni-search-alt"
                                                id="search"></i> Search</button>
                                        <a href="{{ route('medicinesalereport') }}" class="btn btn-primary px-3"><i
                                                class='bx bx-refresh me-0'></i> Refresh</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <hr />
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('mail') }}" method="post">
                                @csrf
                                <div class="table-responsive">

                                    {{-- <button type="submit" style="padding:6px" class="btn1  btn-primary px-3" name="action"
                                        value="pdf">Download PDF</button> --}}

                                    <button type="submit" style="padding:6px" class="btn1  btn-primary px-3" name="action"
                                        value="mail">Mail</button>
                                    <table id="example9" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                @if (auth()->guard('marketings')->check() || (auth()->check()) && auth()->user()->role == 0)
                                                <th><input type="checkbox" value="" id="select_all_check_box"> Select
                                                    All</th>
                                                    @endif
                                                <th>Sr. No</th>
                                                <th>Year</th>
                                                <th>Month</th>
                                                <th>Doctor Name</th>
                                                <th>Promotor Name</th>
                                                <th>Company</th>
                                                @if (auth()->check())
                                                    <th>MPS Total 1</th>
                                                @endif

                                                <th>PTR Total 2</th>
                                                @if (auth()->check())
                                                    <th>TDS(MPS)</th>
                                                    <th>Payable Amount</th>
                                                @endif
                                                {{-- @if (auth()->guard('marketings')->check() || (auth()->check()) && auth()->user()->role == 0) --}}
                                                <th style="background-color: #fff">Action</th>
                                                {{-- @endif --}}
                                            </tr>
                                        </thead>
                                        {{-- @json($stocmed) --}}
                                        <tbody>
                                            @foreach ($stocmed as $report)
                                                <tr>
                                                    @if (auth()->guard('marketings')->check() || (auth()->check()) && auth()->user()->role == 0)
                                                    <td><input type="checkbox" value="{{ $report->id }}"
                                                            name="record_id[]" class="record_id"></td>
                                                            @endif
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $report->year }}</td>
                                                    <td>{{ $report->sale_of_month }}</td>
                                                    <td>{{ $report->allotted_dr_name }}</td>
                                                    <td>{{ $report->promoter_name }}</td>
                                                    <td>{{ $report->Name }}</td>
                                                    @if (auth()->check())
                                                        <td>{{ number_format($report->total_grand_total1, 2) }}</td>
                                                    @endif

                                                    <td>{{ number_format($report->total_grand_total2, 2) }}</td>
                                                    @if (auth()->check())
                                                        <td>

                                                            <?php
                                                            
                                                            $tds_value = ((float) $report->tds / 100) * (float) $report->total_grand_total1;
                                                            
                                                            echo number_format($tds_value, 2);
                                                            ?>

                                                        </td>
                                                    @endif
                                                    @if (auth()->check())
                                                        <td>
                                                            <?php
                                                            
                                                            $count = ((float) $report->total_grand_total1) - ((float) $report->tds / 100) * (float) $report->total_grand_total1;
                                                            
                                                            echo number_format($count, 2);
                                                            ?>

                                                        </td>
                                                    @endif
                                                   
                                                    <td style="background-color: #fff">
                                                        {{-- @if (!empty($report->mobile))
                                                        <a href="{{ 'https://api.whatsapp.com/send/?phone=' . $report->mobile }}"
                                                           target="_blank">
                                                            <img src="{{ asset('images/wa.png') }}" alt="" class="img-responsive"
                                                                 style="height: 40px; width: 40px;" />
                                                        </a>
                                                        @endif --}}
                                                        @if (auth()->guard('marketings')->check() || (auth()->check()) && auth()->user()->role == 0)
                                                        <a href="{{ route('pdf', $report->id) }}">
                                                            <button type="button" class="btn1 btn-outline-secondary"><i
                                                                    class='bx bx-download me-0'></i></button>
                                                        </a>
                                                        @endif
                                                        <button type="button" class="btn btn-primary px-3 viewinfo"
                                                            data-bs-toggle="modal" data-bs-target="#exampleExtraLargeModal"
                                                            id="{{ $report->id }}">Show</button>
                                                            
                                                            @if (auth()->guard('marketings')->check() || (auth()->check()) && auth()->user()->role == 0)
                                                        <a href="{{ route('edit-promotorsalereport', $report->id) }}">
                                                            <button type="button" class="btn1 btn-outline-success"><i
                                                                    class='bx bx-edit-alt me-0'></i></button></a>
                                                        <a href="{{ route('destroy-medicinesalereport', $report->id) }}">
                                                            <button type="button" class="btn1 btn-outline-danger"
                                                                onclick="return confirm('Are You Sure To Delete This?')"><i
                                                                    class='bx bx-trash me-0'></i></button>
                                                        </a>
                                                        @endif
                                                    </td>
                                                   
                                                </tr>
                                                {{-- @json($report->id) --}}
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
                            <h5 class="modal-title">Medicine Sale Report</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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
                                title: 'Promotor Sales Report', // Custom title for Excel file
                                filename: 'Promotor_Sales_Report' // Custom file name for Excel
                            },
                            {
                                extend: 'pdfHtml5',
                                title: 'Promotor Sales Report', // Custom title for PDF document
                                filename: 'Promotor_Sales_Report' // Custom file name for PDF
                            },
                            {
                                extend: 'print',
                                title: 'Promotor_Sales_Report' // Custom title for printed document
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
                        $("#appendbody").empty();

                        $.ajax({
                            url: 'sale_entry_details',
                            type: 'get',
                            data: {
                                entry_id: entry_id
                                // summary_id:summary_id
                            },
                            dataType: 'json',
                            success: function(data) {

                                $("#appendbody").html(data);

                            }
                        });

                    });



                    $("#company").on('change', function() {
                        $.ajax({
                            url: "{{ route('market') }}",
                            type: 'get',
                            data: {
                                id: $(this).val()
                            },
                            cache: false,
                            success: function(result) {
                                $("#market").empty();
                                $("#market").append(' <option value=""> Select </option>');
                                $.each(result, function(a, b) {
                                    $("#market").append(' <option value="' + b.id + '">' + b
                                        .name + '</option>');
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
                        var market = $("#market").val();
                        var doctor = $("#doctor").val();
                        //  var stockist = $("#stockist").val();
                        //  var medical = $("#medical").val();
                        //  var company = $("#company").val();
                        //  var company = $("#company").val();
                        //  var company = $("#company").val();

                    })

                    $('#select_all_check_box').on('click', function() {
                        if ($(this).is(':checked')) {
                            $('.record_id').prop('checked', true);

                        } else {
                            $('.record_id').prop('checked', false);

                        }
                    })
                })
            </script>


        @stop

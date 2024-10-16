@extends('layout')
@section('content')




    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-md-12 mx-auto" style="margin-top: -10%;">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center">

                                <h5 class="mb-0 text-primary">Tds Report</h5>
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
                                <form class="row g-2" action="{{ route('tdsreport') }}" method="get">

                                    <div class="col-md-3">
                                        <label class="form-label">Year</label>
                                        <select class="multiple-select" data-placeholder="Choose anything" id="year"
                                            name="year">

                                            @foreach ($year as $years)
                                                <option value="{{ $years->id }}" @if (app()->request->year_id == $years->id ) selected @endif>
                                                    {{ $years->year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="inputFirstName" class="form-label">Month</label>

                                        <select class="multiple-select" data-placeholder="Choose anything" id="month"
                                            name="sale_of_month">

                                            <option value="" disabled selected>Select Quarter</option>
                                            <option value="1" @if (app()->request->sale_of_month == 1 || in_array('January',$month)) selected @endif>
                                                Jan-Feb-Mar</option>
                                            <option value="2" @if (app()->request->sale_of_month == 2 || in_array('April',$month)) selected @endif>
                                                Apr-May-June</option>
                                            <option value="3" @if (app()->request->sale_of_month == 3 || in_array('July',$month)) selected @endif>
                                                July-Aug-Sept</option>
                                            <option value="4" @if (app()->request->sale_of_month == 4 || in_array('October',$month)) selected @endif>
                                                Oct-Nov-Dec</option>

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


                                    <div class="col-md-3">
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
                                    <div class="col-md-4" style="padding:8px"><br>
                                        <button type="submit" class="btn btn-primary px-3"><i class="lni lni-search-alt"
                                                id="search"></i> Search</button>
                                        <a href="{{ route('tdsreport') }}" class="btn btn-primary px-3"><i
                                                class='bx bx-refresh me-0'></i> Refresh</a>
                                    </div>
                                    {{-- <a href="{{ route('tdsreport_ecxel') }}">

                                        <button formaction="{{ route('tdsreport_ecxel') }}" type="submit"
                                            style="padding:6px" class="btn  btn-primary px-3" value="excel">Excel</button>
                                    </a> --}}
                                </form>
                            </div>
                        </div>
                    </div>

                    <hr />
                    <div class="card">
                        <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example9" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                {{-- <th>Check Box</th> --}}
                                                <th>Sr. No</th>
                                                <th>Doctor Name</th>
                                                <th>Beneficiary Name</th>
                                                <th>Pan No</th>
                                                {{-- <th>Year</th> --}}
                                                @foreach ($month as $monthName)
                                                    <th>{{ $monthName }}</th>
                                                @endforeach
                                                <th>Total</th>
                                                <th>TDS</th>

                                                {{-- <th style="background-color: #fff">Action</th> --}}
                                            </tr>
                                        </thead>
                                        {{-- @json($stocmed) --}}
                                        <tbody>
                                            @php
                                                $groupedData = [];
                                                $tds_value = 0;
                                                foreach ($stocmed as $record) {
                                                    $count = $record->grand_total1;
                
                                                    // $tds_value = ((float) $record->tds / 100) * (float) $record->total_grand_total1;
                                                
                                                    $key = $record['select_company_id'] . '-' . $record['select_doctor_id'];
                                                
                                                    if (!isset($groupedData[$key])) {
                                                        $groupedData[$key] = [
                                                            'select_doctor_id' => $record['allotted_dr_name'],
                                                            'promoter_name' => $record['promoter_name'],
                                                            'pan_no' => $record['pan_no'],
                                                            'id' => $record['id'],
                                                            // 'year' => $record['year'],
                                                            'tds_value' => $tds_value,
                                                            'sales_by_month' => [
                                                                "$month[0]" => 0.0,
                                                                "$month[1]" => 0.0,
                                                                "$month[2]" => 0.0,
                                                            ],
                                                        ];
                                                    }
                                    $groupedData[$key]['sales_by_month'][$record['sale_of_month']] += $count;
                                                }
                                            @endphp

                                            @foreach ($groupedData as $group)
                                                <tr>
                                                    {{-- <td><input type="checkbox" value="{{ $group['id'] }}"
                                                        name="record_id[]"></td> --}}
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $group['select_doctor_id'] }}</td>
                                                    <td>{{ $group['promoter_name'] }}</td>
                                                    <td>{{ $group['pan_no'] }}</td>
                                                    {{-- <td>{{ $group['year'] }}</td> --}}
                                                    @php
                                                        $totalSales = 0;
                                                        $tds_value1 = 0;
                                                    @endphp
                                                    @foreach ($month as $monthName)
                                                        <td>{{ number_format($group['sales_by_month'][$monthName], 2) }}
                                                        </td>
                                                        @php
                                                            $totalSales += $group['sales_by_month'][$monthName];
                                                            
                                                    $tds_value1 = ((float) $record->tds / 100) * (float) $totalSales;
                                                        @endphp
                                                    @endforeach

                                    
                                                    <td>{{ number_format($totalSales, 2) }}</td>
                                                    <td>{{ number_format($tds_value1, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
                                title: 'Custom Excel Title', // Custom title for Excel file
                                filename: 'TDS_Report' // Custom file name for Excel
                            },
                            {
                                extend: 'pdfHtml5',
                                title: 'Custom PDF Title', // Custom title for PDF document
                                filename: 'TDS_Report' // Custom file name for PDF
                            },
                            {
                                extend: 'print',
                                title: 'TDS_Report' // Custom title for printed document
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
                            url: 'sale_entry_details',
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
                        // var market = $("#market").val();
                        // var doctor = $("#doctor").val();
                        //  var stockist = $("#stockist").val();
                        //  var medical = $("#medical").val();
                        //  var company = $("#company").val();
                        //  var company = $("#company").val();
                        //  var company = $("#company").val();

                    })
                })
            </script>



        @stop

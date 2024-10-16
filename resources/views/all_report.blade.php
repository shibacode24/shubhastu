@extends('layout')
@section('content')

<style>
    .multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}
</style>

    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <div class="col-md-12 mx-auto" style="margin-top: -10%;">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center">

                                <h5 class="mb-0 text-primary"> DoctorWise Mix Report</h5>
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
                                <form class="row g-2" action="{{ route('report') }}" method="get">

                                    {{-- <div class="col-md-2">
                                        <label for="inputFirstName" class="form-label">Month</label>


                                        <select class="multiple-select" data-placeholder="Choose anything" id="month"
                                            name="sale_of_month[]" multiple>

                                            @php
                                                $selectedMonth = Session::has('sale_of_month') ? Session::get('sale_of_month') : date('F', strtotime('-1 month'));
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

                                    </div> --}}

                                    <div class="col-md-3">
                                        <label class="form-label">Doctor</label>
                                        <select class="multiple-select" data-placeholder="Choose anything" name="doctor_id">
                                            <option disabled selected>Select</option>
                                            @foreach ($doctor as $doctors)
                                                <option value="{{ $doctors->id }}"
                                                    @if (app()->request->doctor_id == $doctors->id) selected @endif>
                                                    {{ $doctors->allotted_dr_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

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

                                    <div class="col-md-3">
                                        <label for="inputFirstName" class="form-label">Type</label>
                                        <select class="multiple-select" data-placeholder="Choose anything" id="type"
                                            name="type">
                                            <option value="qty" @if (app()->request->type == 'qty') selected @endif>QTY</option>
                                            <option value="ptr" @if (app()->request->type == 'ptr') selected @endif>PTR</option>
                                            @if (auth()->check())
                                            <option value="mps" @if (app()->request->type == 'mps') selected @endif>MPS</option>
                                            <option value="tds" @if (app()->request->type == 'tds') selected @endif>TDS</option>
                                            @endif
                                        </select>
        
                                    </div>

                                    {{-- <div class="col-md-2">
                                        <label for="inputFirstName" class="form-label">Month</label> --}}

                                        {{-- @json(Session::get('sale_of_month'))
@json(app('request')->input('sale_of_month')) --}}

                                        {{-- <select class="multiple-select" data-placeholder="Choose anything" id="month"
                                            name="sale_of_month[]" multiple>

                                            @php
                                                $selectedMonth = Session::has('sale_of_month') ? Session::get('sale_of_month') : date('F', strtotime('-1 month'));
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

                                        </select> --}}
                                        {{-- <select class="multiple-select" data-placeholder="Choose anything" id="month"
                                        name="sale_of_month[]" multiple>
                                        <option value="January" @if (!empty(app()->request->input('sale_of_month')) && in_array('January', app()->request->input('sale_of_month'))) selected @endif>January</option>
                                        <option value="February" @if (!empty(app()->request->input('sale_of_month')) && in_array('February', app()->request->input('sale_of_month'))) selected @endif>February</option>
                                        <option value="March" @if (!empty(app()->request->input('sale_of_month')) && in_array('March', app()->request->input('sale_of_month'))) selected @endif>March</option>
                                        <option value="April" @if (!empty(app()->request->input('sale_of_month')) && in_array('April', app()->request->input('sale_of_month'))) selected @endif>April</option>
                                        <option value="May" @if (!empty(app()->request->input('sale_of_month')) && in_array('May', app()->request->input('sale_of_month'))) selected @endif>May</option>
                                        <option value="June" @if (!empty(app()->request->input('sale_of_month')) && in_array('June', app()->request->input('sale_of_month'))) selected @endif>June</option>
                                        <option value="July" @if (!empty(app()->request->input('sale_of_month')) && in_array('July', app()->request->input('sale_of_month'))) selected @endif>July</option>
                                        <option value="August" @if (!empty(app()->request->input('sale_of_month')) && in_array('August', app()->request->input('sale_of_month'))) selected @endif>August</option>
                                        <option value="September" @if (!empty(app()->request->input('sale_of_month')) && in_array('September', app()->request->input('sale_of_month'))) selected @endif>September</option>
                                        <option value="October" @if (!empty(app()->request->input('sale_of_month')) && in_array('October', app()->request->input('sale_of_month'))) selected @endif>October</option>
                                        <option value="November" @if (!empty(app()->request->input('sale_of_month')) && in_array('November', app()->request->input('sale_of_month'))) selected @endif>November</option>
                                        <option value="December" @if (!empty(app()->request->input('sale_of_month')) && in_array('December', app()->request->input('sale_of_month'))) selected @endif>December</option>
                                    </select> --}}
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
                                        
                            
                            </div>
                            {{-- <div class="col-md-1">
                                <label for="inputFirstName" class="form-label">Type</label>
                                <select class="multiple-select" data-placeholder="Choose anything" id="type"
                                    name="type">
                                    <option value="qty" @if (app()->request->type == 'qty') selected @endif>QTY</option>
                                    <option value="ptr" @if (app()->request->type == 'ptr') selected @endif>PTR</option>
                                    <option value="mps" @if (app()->request->type == 'mps') selected @endif>MPS</option>
                                    <option value="tds" @if (app()->request->type == 'tds') selected @endif>TDS</option>
                                </select>

                            </div> --}}
                           
                            <div class="col-md-12" style="margin-top:5vh;margin-bottom:3vh;text-align:center;">
                                <button type="submit" class="btn btn-primary px-2"><i class="lni lni-search-alt"
                                        id="search"></i>
                                    Search</button>
                                <a href="{{ route('report') }}" class="btn btn-primary px-3"><i
                                        class='bx bx-refresh me-0'></i>
                                    Refresh</a>
                            </div>
                            </form>
                            <hr>
                            <table id="example9" class="table table-striped table-bordered" >
                                <thead>
                                    {{-- @json($type) --}}
                                    <tr>
                                        <th>Total</th>
                                        <th>Medicine Name</th>
                                        @foreach ($month as $monthName)
                                            <th>{{ $monthName }}</th>
                                        @endforeach


                                    </tr>
                                </thead>
                                @if ($type == 'qty')
                                    @php

                                        $groupedData = [];
                                        foreach ($stocmed as $record) {
                                            $count = $record->qntys;

                                            $key = $record['select_medicine1'];
                                            if (!isset($groupedData[$key])) {
                                                $groupedData[$key] = [
                                                    'select_medicine1' => $record['select_medicine1'],
                                                    'sales_by_month' => [],
                                                ];

                                                // Initialize sales_by_month array based on $month
                                                foreach ($month as $monthName) {
                                                    $groupedData[$key]['sales_by_month'][$monthName] = 0;
                                                }
                                            }
                                            $groupedData[$key]['sales_by_month'][$record['sale_of_month']] += $count;
                                        }
                                    @endphp
                                @elseif ($type == 'mps')
                                    @php
                                        $groupedData = [];
                                        foreach ($stocmed as $record) {
                                            $count = $record->qnty_mps_total;

                                            $key = $record['select_medicine1'];
                                            if (!isset($groupedData[$key])) {
                                                $groupedData[$key] = [
                                                    'select_medicine1' => $record['select_medicine1'],
                                                    'sales_by_month' => [],
                                                ];

                                                // Initialize sales_by_month array based on $month
                                                foreach ($month as $monthName) {
                                                    $groupedData[$key]['sales_by_month'][$monthName] = 0;
                                                }
                                            }
                                            $groupedData[$key]['sales_by_month'][$record['sale_of_month']] += $count;
                                        }
                                    @endphp
                                @elseif ($type == 'ptr')
                                    @php
                                        $groupedData = [];
                                        foreach ($stocmed as $record) {
                                            $count = $record->qnty_ptr_total;

                                            $key = $record['select_medicine1'];
                                            if (!isset($groupedData[$key])) {
                                                $groupedData[$key] = [
                                                    'select_medicine1' => $record['select_medicine1'],
                                                    'sales_by_month' => [],
                                                ];

                                                // Initialize sales_by_month array based on $month
                                                foreach ($month as $monthName) {
                                                    $groupedData[$key]['sales_by_month'][$monthName] = 0;
                                                }
                                            }
                                            $groupedData[$key]['sales_by_month'][$record['sale_of_month']] += $count;
                                        }
                                    @endphp
                                @elseif ($type == 'tds')
                                    @php
                                        $groupedData = [];
                                        foreach ($stocmed as $record) {
                                            $result = ((float) $record->tds / 100) * (float) $record->qnty_mps_total;
                                            $count = number_format($result, 2);
                                            $key = $record['select_medicine1'];
                                            if (!isset($groupedData[$key])) {
                                                $groupedData[$key] = [
                                                    'select_medicine1' => $record['select_medicine1'],
                                                    'sales_by_month' => [],
                                                ];

                                                // Initialize sales_by_month array based on $month
                                                foreach ($month as $monthName) {
                                                    $groupedData[$key]['sales_by_month'][$monthName] = 0;
                                                }
                                            }
                                            $groupedData[$key]['sales_by_month'][$record['sale_of_month']] += $count;
                                        }
                                    @endphp
                                @endif

                                <tbody>
                                    @foreach ($groupedData as $data)
                                        <tr>
                                            @php
                                                $month = array_values($month); // Reset array keys to start from 0
                                                $totalSales = 0;
                                                $tds_value1 = 0;
                                            @endphp
                                            @foreach ($month as $monthKey => $monthName)
                                                @php
                                                    $totalSales += $data['sales_by_month'][$monthName];

                                                @endphp
                                            @endforeach

                                            <td>{{ number_format($totalSales, 2) }}</td>
                                            <td>{{ $data['select_medicine1'] }}</td>


                                            @foreach ($month as $monthKey => $monthName)
                                                <td>{{ $data['sales_by_month'][$monthName] }}</td>
                                            @endforeach

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <div class="modal fade" id="exampleExtraLargeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Medicine Quantity Report</h5>
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
                        title: 'DoctorWise Mix Report', // Custom title for Excel file
                        filename: 'DoctorWise_Mix_Report' // Custom file name for Excel
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'DoctorWise Mix Report', // Custom title for PDF document
                        filename: 'DoctorWise_Mix_Report' // Custom file name for PDF
                    },
                    {
                        extend: 'print',
                        title: 'DoctorWise_Mix_Report' // Custom title for printed document
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

                var type = $('#type').val(); // Get the selected value from the dropdown

                // Now you have the selected type, and you can use it as needed

                console.log('Type:', type);
                var entry_id = $(this).attr('id');
                $("#appendbody").empty();

                $.ajax({
                    url: 'report_qnt_ptr_mps',
                    type: 'get',
                    data: {
                        entry_id: entry_id,
                        type: type
                        // summary_id:summary_id
                    },
                    dataType: 'json',
                    success: function(data) {

                        $("#appendbody").html(data);

                    }
                });

            });

        })
    </script>

@stop

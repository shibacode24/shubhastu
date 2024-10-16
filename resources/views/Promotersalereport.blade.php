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

                                <h5 class="mb-0 text-primary">Promotor Sales Report</h5>
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
                                <form class="row g-2" action="{{ route('promotorreport') }}" method="get">
                                    <div class="col-md-2">
                                        <label class="form-label">Year</label>
                                        <select class="multiple-select" data-placeholder="Choose anything" id="year"
                                            name="year_id">

                                            @foreach ($year as $years)
                                                <option value="{{ $years->id }}"  @if (app()->request->year_id == $years->id ) selected @endif>
                                                    {{ $years->year }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <label for="inputFirstName" class="form-label">Month</label>


                                        <select class="multiple-select" data-placeholder="Choose anything" id="month"
                                            name="sale_of_month">

                                            <option> @php
                                                $currentMonth = date('F');
                                                echo $currentMonth; // Output: February
                                            @endphp
                                            </option>

                                            <option value="January">January</option>
                                            <option value="February">February</option>
                                            <option value="March">March</option>
                                            <option value="April">April</option>
                                            <option value="May">May</option>
                                            <option value="June">June</option>
                                            <option value="july">july</option>
                                            <option value="August">August</option>
                                            <option value="September">September</option>
                                            <option value="October">October</option>
                                            <option value="November">November</option>
                                            <option value="December">December</option>


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
                                        <label for="inputFirstName" class="form-label">Select Marketing</label>

                                        <select class="multiple-select" data-placeholder="Choose anything" id="market"
                                            name="market">
                                            <option value="">All</option>

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



                                  
                                    <div class="row">
                                        <div class="col-md-2" style="padding:8px"><br>
                                            <button type="submit" class="btn btn-primary px-3"><i
                                                    class="lni lni-search-alt" id="search"></i> Search</button>
                                        </div>
                                        <div class="col-md-2" style="padding:8px"><br>
                                            <a href="{{ route('promotorreport') }}" class="btn btn-primary px-3"><i
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
                            <form action="{{ route('mail') }}" method="post">
                                @csrf
                                <div class="table-responsive">

                                    <button type="submit" style="padding:6px" class="btn1  btn-primary px-3" name="action"
                                        value="pdf">Download PDF</button>
                              
                                    <button type="submit" style="padding:6px" class="btn1  btn-primary px-3" name="action"
                                        value="mail">Mail</button>
                                    <table id="example2" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Check Box</th>
                                                <th>Sr. No</th>
                                                <th>Year</th>
                                                <th>Month</th>
                                                <th>Company</th>
                                                <th>Marketing</th>
                                                <th>Client</th>
                                               
                                                <th style="background-color: #fff">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($stocmed as $report)
                                                <tr>
                                                    <td><input type="checkbox" value="{{ $report->id }}"
                                                            name="record_id[]"></td>
                                                    <td>{{ $loop->index + 1 }}</td>
                                                    <td>{{ $report->year }}</td>
                                                    <td>{{ $report->sale_of_month }}</td>
                                                    <td>{{ $report->Name }}</td>
                                                    <td>{{ $report->name }}</td>
                                                    <td>{{ $report->allotted_dr_name }}</td>
                                            
                                                    <td style="background-color: #fff">
                                                 
                                                        <button type="button" class="btn btn-primary px-3 viewinfo"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleExtraLargeModal"
                                                            id="{{ $report->id }}">show</button>
                                                            <a href="{{route('edit-promotorsalereport',$report->id)}}">
                                                                <button type="button" class="btn1 btn-outline-success"><i class='bx bx-edit-alt me-0'></i></button></a>
                                                            <a href="{{route('destroy-promotor_Sale',$report->id)}}">
                                                                <button type="button" class="btn1 btn-outline-danger"><i class='bx bx-trash me-0'></i></button>
                                                                 </a>
                                                    </td>
                                                </tr>
                                                
                                            @endforeach
                                            {{$users->withQueryString()->links('pagination::bootstrap-5')}}
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
                            <h5 class="modal-title">Promoter Sale Report</h5>
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
                })
            </script>
<script>

    $(document).ready(function()
    {
        // $("#year option").filter(function(index) { return $(this).text() == new Date().getFullYear(); }).attr('selected', 'selected').change();// current date show hone ke liye 

        $("#doctor").on('change',function(){ // dr ke onchnge pe scheme milne ke liye
            $.ajax({
url: "{{route('get_market_by_id')}}",
type:'get',
data:{ 
id:$(this).val()
},
cache: false,
success: function(result){
    console.log(result);
    $("#market").val(result.name);

}
});
        })
    })
</script>



        @stop

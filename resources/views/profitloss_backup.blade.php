@section('content')
    @extends('layout')
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
                            <form class="row g-2" method="get" action="{{ route('getdata_profitloss') }}">
                                @csrf

                                <div class="col-md-2">
                                    <div class="yearWrapper">
                                        <label class="form-label">Year</label>

                                        <select class="multiple-select" data-placeholder="Choose anything" name="year"
                                            id="year">
                                            <option value="Select">Select</option>
                                            @foreach ($year as $medicals)
                                                <option value="{{ $medicals->id }}">
                                                    {{ $medicals->year }} </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Month</label>

                                    <select class="multiple-select" data-placeholder="Choose anything" name="month"
                                        id="month">
                                        <option value="Select">Select</option>
                                        @foreach ($month as $medicals)
                                            <option value="{{ $medicals->id }}">
                                                {{ $medicals->sale_of_month }} </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-2">
                                    <label for="inputFirstName" class="form-label">Select Company</label>

                                    <select class="multiple-select" data-placeholder="Choose anything" name="company"
                                        id="company">
                                        <option value="Select">Select</option>
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
                </div>
            </div>



            <!--end page wrapper -->
            <!--start overlay-->
            <div class="overlay toggle-icon"></div>
            <hr />
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
                                    <th>Total Purchase</th>
                                    <th>Total Sale(secondary sale)</th>
                                    <th>Doctor Payout</th>

                                    <th>Total Sale(promotor sale)</th>
                                    <th>Expense Amount</th>
                                    <th>Profit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exp_entry as $exp_entrys)
                                    <tr>

                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            @if (property_exists($exp_entrys, 'year'))
                                                {{ $exp_entrys->year }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if (property_exists($exp_entrys, 'select_month'))
                                                {{ $exp_entrys->sale_of_month }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if (property_exists($exp_entrys, 'Name'))
                                                {{ $exp_entrys->Name }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if (property_exists($exp_entrys, 'grand_total1'))
                                                {{ $exp_entrys->grand_total1 }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if (property_exists($exp_entrys, 'sale_value_total1'))
                                                {{ $exp_entrys->sale_value_total1 }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            @if (property_exists($exp_entrys, 'total'))
                                                {{ $exp_entrys->total }}
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        @if (property_exists($exp_entrys, 'grand_total2'))
                                            <td>{{ $exp_entrys->grand_total2 }}</td>
                                        @else
                                            <td>N/A</td>
                                        @endif
                                        @if (property_exists($exp_entrys, 'amount'))
                                            <td>{{ $exp_entrys->amount }}</td>
                                        @else
                                            <td>N/A</td>
                                        @endif
                                        <td>
                                            <?php
                                            
                                            $count = ((float) $exp_entrys->grand_total1) + 0.1 * (float) $exp_entrys->sale_value_total1 + ((float) $exp_entrys->total) + ((float) $exp_entrys->amount) - (float) $exp_entrys->grand_total2;
                                            //                                                         $tenPercentOfSaleValue = 0.1 * ((float)$exp_entrys->sale_value_total1);
                                            
                                            // // Add the 10 percent to the $count
                                            // $count += $tenPercentOfSaleValue;
                                            echo $count;
                                            ?>
                                        </td>
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

@extends('layout')
@include('alerts')
@section('content')

    <style>
        table,
        th,
        td {
            border: 1px solid black;


        }

        .td {
            font-size: 5px;

        }

        .hide-mps {
            display: none;
        }
    </style>



    <form method="POST" action="{{ route('update-secondarysalesreport') }}" id="createpromotor_formid">
        <input type="hidden" name="s_id" value="{{ $prosalereportedit->id }}">
        <input type="hidden" id="secmed_id" value="{{ $stocmed[0]->secondary__sales_id }}" name="secmed_id">
        @csrf
        <div class="page-wrapper">
            <div class="page-content">
                <div class="row">
                    <div class="col-md-12 mx-auto" style="margin-top: -10%;">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-center">

                                    <h5 class="mb-0 text-primary">Secondary Sales Entry</h5>
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
                                    <div class="col-md-2">
                                        <label class="form-label">Year</label>
                                        {{-- <select class="multiple-select" data-placeholder="Choose anything" id="year"
                                            name="year_id">
                                            
                                            @foreach ($year as $years)
                                                <option value="{{ $years->id }}">
                                                    {{ $years->year }}
                                                </option>
                                            @endforeach

                                        </select> --}}

                                        <input type="text" name="year_id" class="form-control "
                                            value={{ $stocmed[0]->year }} readonly>
                                    </div>
                                    {{-- <input type="hidden" name="year_id" class="form-control "
                                    value={{ $stocmed[0]->year_id }} readonly> --}}
                                    <div class="col-md-2">
                                        <label for="inputFirstName" class="form-label">Sale of Month*</label>

                                        {{-- <select class="multiple-select" data-placeholder="Choose anything" id="month"
                                            name="sale_of_month" @readonly(true)>
                                           
                                            <option value="{{ date('F') }}">
                                                {{ date('F') }}
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


                                        </select> --}}
                                        <input type="text" name="sale_of_month" class="form-control "
                                            value={{ $stocmed[0]->sale_of_month }} readonly>


                                    </div>

                                    <div class="col-md-3">
                                        <label for="inputFirstName" class="form-label">Select Company*</label>

                                        <select class="multiple-select medicaleschme" data-placeholder="Choose anything"
                                            id="company" name="company" disabled>
                                            @foreach ($company as $companys)
                                                <option value="{{ $companys->id }}"
                                                    @if ($prosalereportedit->select_company_id == $companys->id) selected @endif>
                                                    {{ $companys->Name }} </option>
                                            @endforeach

                                        </select>
                                        {{-- <input type="text" name="company" class="form-control " value={{ $stocmed[0]->Name }}> --}}
                                    </div>


                                    <hr>


                                    <div style="overflow-x: scroll;">

                                        <table style="width:100%; " id="table">
                                            <tr align="center">
                                                {{-- <th width="5%">Sr. No.</th> --}}
                                                <th width="22%">Stokist</th>
                                                <th width="12%">Sale Value</th>
                                                {{-- <th width="5%">Grand Total 1</th> --}}
                                                <th width="8%">Grand Total 2</th>
                                                <th width="15%">Medicine</th>
                                                @if (auth()->check())
                                                    <th width="10%">Purchase Rate</th>
                                                @endif
                                                <th width="5%"> QTY </th>
                                                <th width="8%">QTY*Purchase</th>

                                            </tr>
                                            @php
                                                $countConditionMet = [];
                                            @endphp

                                            @foreach ($stocmed as $stoc)
                                                @php
                                                    $secondarySalesId = $stoc->secondary__sales_id;
                                                    $appendNo = $stoc->append_no;
                                                    $selectStokistId = $stoc->select_stokist_id;

                                                    // Concatenate the values to create a unique identifier for each combination
                                                    $combination = $secondarySalesId . '_' . $appendNo . '_' . $selectStokistId;

                                                    // Increment count for the combination
                                                    if (!isset($countConditionMet[$combination])) {
                                                        $countConditionMet[$combination] = 1;
                                                    } else {
                                                        $countConditionMet[$combination]++;
                                                    }
                                                @endphp
                                            @endforeach



                                            {{-- @php
                                                dump($countConditionMet[$combination]);
                                                dump($countConditionMet);
                                            @endphp --}}


                                            <tbody>

                                                @php
                                                    $rowid = 0;
                                                @endphp
                                                @foreach ($stocmed as $stocmed[0])
                                                    <tr>
                                                        @php
                                                            $stock_name = str_replace(' ', '_', $stocmed[0]->select_stokist_id);

                                                        @endphp
                                                        <td record_id="{{ $stocmed[0]->id }}">
                                                            <input type="hidden" readonly
                                                                value="{{ $stocmed[0]->append_no }}" id="append_no"
                                                                name="append_no[]">
                                                            <input type="hidden" name="id[]" class="form-control"
                                                                value="{{ $stocmed[0]->id }}">
                                                            <input type="hidden" class="form-control"
                                                                value="{{ $stocmed[0]->secondary__sales_id }}">
                                                            <input type="text" class="form-control" readonly
                                                                name="stockist[]" required=""
                                                                value="{{ $stocmed[0]->select_stokist_id }}">
                                                        </td>
                                                        @if ($rowid != $stocmed[0]->secondary__sales_id . '_' . $stocmed[0]->append_no . '_' . $stocmed[0]->select_stokist_id)
                                                            @php
                                                                $rowid = $stocmed[0]->secondary__sales_id . '_' . $stocmed[0]->append_no . '_' . $stocmed[0]->select_stokist_id;
                                                            @endphp
                                                            <td record_id="{{ $stocmed[0]->id }}"
                                                                rowspan="{{ $countConditionMet[$stocmed[0]->secondary__sales_id . '_' . $stocmed[0]->append_no . '_' . $stocmed[0]->select_stokist_id] }}">
                                                                <input type="text" name="sale_value[]"
                                                                    class="form-control sale_value"
                                                                    unique_class="{{ str_replace(' ', '_', $stocmed[0]->secondary__sales_id . '_' . $stocmed[0]->append_no . '_' . $stocmed[0]->select_stokist_id) }}"
                                                                    required="" value="{{ $stocmed[0]->sale_value }}">
                                                            </td>
                                                        @else
                                                            <input type="hidden" name="sale_value[]"
                                                                class="{{ str_replace(' ', '_', $stocmed[0]->secondary__sales_id . '_' . $stocmed[0]->append_no . '_' . $stocmed[0]->select_stokist_id) }}"
                                                                required="" value="{{ $stocmed[0]->sale_value }}">
                                                        @endif

                                                        <td record_id="{{ $stocmed[0]->id }}">
                                                            <input type="text" readonly name="grand_total1[]"
                                                                required="" value="{{ $stocmed[0]->grand_total2 }}"
                                                                class="form-control filtered_grand_total{{ $stock_name }}"></i>

                                                        </td>

                                                        <td><input type="text" class="form-control" readonly
                                                                name="medicine[]" required=""
                                                                value="{{ $stocmed[0]->select_medicine }}">
                                                        </td>
                                                        <td
                                                            class="{{ auth()->guard('marketings')->check() ? 'hide-mps' : '' }}">
                                                            <input type="text" readonly name="purchase[]"
                                                                class="form-control purchase_class"
                                                                value="{{ $stocmed[0]->purchase_rate }}">
                                                        </td>
                                                        <td><input type="text" name="qnty[]" tabindex="1"
                                                                id="quantity_{{ $loop->index }}"
                                                                data-sid="{{ $stocmed[0]->select_stokist_id }}"
                                                                class="form-control quantity_class"
                                                                value="{{ $stocmed[0]->qnty }}"></td>
                                                        <td><input type="number" readonly name="qntypurchase[]"
                                                                class="form-control total2_class"
                                                                value="{{ $stocmed[0]->qntypurchase }}"></td>
                                                        {{-- <td></td> --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>


                                    </div>



                                    <div>
                                        <table class="table table-bordered "
                                            style="width:30%; margin-top:2%; margin-left:60%;" id="">
                                            <thead class="t">
                                                <tr class="t">

                                                    <th scope="col" class=" t">Sale Value Total 1 : <input
                                                            type="text" value="{{ $stocmed[0]->total_grand_total2 }}"
                                                            id="sale_value_total1" name="sale_value_total1" readonly></th>
                                                    <th scope="col" class="t">(QTY*Purchase)Total 2 :
                                                        <input type="text"
                                                            value="{{ $stocmed[0]->total_grand_total1 }}"
                                                            id="grandtotal211" class="grandtotal211" name="grand_total11"
                                                            readonly>

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- <td>
                                    <input type="number" step="0.01" readonly name="grand_total11" required="" style="border:none; width: 100%;" class=""  value="0">
                                </td> --}}

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="col-md-2" style="padding:8px; text-align: center; margin-left: 43%;">
                                    <button type="submit" class="btn btn-primary px-3"><i
                                            class="fadeIn animated bx bx-plus"></i> Update </button>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!--end page wrapper -->

                    <div class="overlay toggle-icon"></div>

                </div>
    </form>







    <!--end page wrapper -->
    <!--  -->


@stop
@section('js')
    {{-- <script>
    $(document).ready(function() {
        // Event listener for keyup on sale inputs
        $(document).on('keyup', '.sale_value', function() {
            var inputValue = 0;
            // var currentTotal = 0;
            // Get the input value
            var inputValue = parseFloat($(this).val()) || 0;

            // Update the total value
            var totalValueElement = $('#sale_value_total1');
            var currentTotal = parseFloat(totalValueElement.val()) || 0;
            var newTotal = currentTotal + inputValue;
            totalValueElement.val(newTotal);
        console.log(totalValueElement);
        console.log(inputValue);

        });
        console.log('Script loaded successfully.');
    });
</script> --}}
    {{-- <script>
    $(document).ready(function() {
        var inputValue = 0;

        // Event listener for keyup on sale inputs
        $(document).on('keyup', '.sale_value', function() {
            
            // Get the input value
            var inputValue = parseFloat($(this).val());

            // Update the total value
            var totalValueElement = $('#sale_value_total1');
            var currentTotal = parseFloat(totalValueElement.val());
            var newTotal = currentTotal + inputValue;
            totalValueElement.val(newTotal);

            console.log('Current Total: ' + currentTotal);
            console.log('Input Value: ' + inputValue);
            console.log('New Total: ' + newTotal);
        });

        console.log('Script loaded successfully.');
    });
</script> --}}



    {{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}

    {{-- <script>
    $(document).ready(function() {
        // Initialize total value
        var totalValue = 0;

        // Event listener for input on sale inputs
        $(document).on('input', '.sale_value', function() {
            // Get the input value
            var inputValue = parseFloat($(this).val()) || 0;

            // Update the total value
            totalValue = 0; // Reset total value
            $('.sale_value').each(function() {
                var value = parseFloat($(this).val()) || 0;
                if (!isNaN(value)) {
                    totalValue += value;
                }
            });

            // Update the total value element
            var totalValueElement = $('#sale_value_total1');
            totalValueElement.val(totalValue);

            console.log('Total Value: ' + totalValue);
            console.log('Input Value: ' + inputValue);
        });

        console.log('Script loaded successfully.');
    });
</script> --}}

    <script>
        // $(document).ready(function() {
        //     // Event listener for keyup on sale inputs
        //     $(document).on('keyup', '.sale_class', function() {
        //         var sale = parseFloat($(this).closest('tr').find('.sale_class').val());
        //     });

        //     // Event listener for click on sale_value button
        //     $(document).on('click', '.sale_value', function() {
        //         updateSaleTotal();
        //     });

        //     // Function to update sale total based on sale inputs
        //     function updateSaleTotal() {
        //         var saleTotal = 0;

        //         $('.sale_class').each(function(index, element) {
        //             var sale = parseFloat($(element).val()) || 0;
        //             saleTotal += sale;
        //         });

        //         $('#sale_value_total1').val(saleTotal.toFixed(2));
        //     }
        // });

        // $(document).ready(function() {
        //     $(document).on('keyup', '.sale_vlue', function() {
        //         var grand_total = 0;
        //         // var sid = $(this).attr('data-sid');

        //         $('.sale_vlue').each(function(index, element) {
        //             var sale_value = parseFloat($(element).val()) || 0;

        //             var total2 = sale_value;
        //              console.log(grand_total);
        //             grand_total += total2
        //             console.log(grand_total);

        //         });

        // $('#sale_value_total1').val(grand_total.toFixed(2));
        // console.log(sale_value_total1)
        // var filteredGrandTotal1 = 0;
        // $('.filtered_grand_total1').each(function(index, element) {
        //     var sale_value = parseFloat($(element).val()) || 0;

        //         filteredGrandTotal1 += sale_value;
        //     console.log(filteredGrandTotal1);

        //         $('.filtered_grand_total1').val(filteredGrandTotal1.toFixed(2));

        // });
        // });
        //     $(document).ready(function() {
        //     $(document).on('keyup', '.sale_vlue', function() {
        //         var grand_total1 = 0;
        //         var sid = $(this).attr('data-sid');

        //         // var grandtot = 0;
        //         $('.sale_vlue').each(function(index, element) {
        //             var sale_value = parseFloat($(element).val()) || 0;
        //             // var purchase = parseFloat($(element).closest('tr').find('.purchase_class')
        //             //     .val());

        //             // var total2 = quantity * purchase;
        //             // var tot1 = quantity * purchase;
        //             $(element).closest('tr').find('.sale_vlue').val(sale_value.toFixed(2));
        //             // $(element).closest('tr').find('.total2_class').val(tot1.toFixed(2));

        //             grand_total1 += sale_value;
        //             // console.log(grand_total);
        //             // grandtot += tot1
        //         });

        //         // $('.filtered_grand_total1').val(grand_total1.toFixed(2));
        //         // $('#grandtot211').val(grandtot.toFixed(2));
        //         // console.log(filtered_grand_total1)
        //         var filteredGrandTotal1 = 0;
        //         $('.sale_vlue').each(function(index, element) {
        //             var takensid = $(this).attr('data-sid')
        //             // var takenmid=$(this).attr('data-mid')
        //             var stringsid = takensid;
        //             // alert($('.filtered_grand_total2'+stringsid).val());
        //             var fgt2 = $('.filtered_grand_total2' + stringsid).val();

        //             // alert(takensid);

        //             var sale_value = parseFloat($(element).val()) || 0;
        //             // var purchase = parseFloat($(element).closest('tr').find('.purchase_class')
        //             //     .val());

        //             // Apply the WHERE condition
        //             if (sid === takensid) {
        //                 filteredGrandTotal1 += sale_value;
        //                 $('.filtered_grand_total1' + stringsid).val(filteredGrandTotal1.toFixed(2));

        //             }

        //         });


        //     });
        // });
        // });
        $(document).ready(function() {

        });
    </script>


    <script>
        $(document).ready(function() {

            $(document).on('keyup', '.sale_value', function() {
                let sale_value_total = 0;

                $('.sale_value').each(function(index, element) {
                    sale_value_total = parseFloat(sale_value_total) + ($(this).val() ? parseFloat($(
                        this).val()) : 0);
                    console.warn(parseFloat($(this).val()));
                })
                $('#sale_value_total1').val(sale_value_total);
                let unique_class_by_attr = $(this).attr(
                'unique_class'); //here we are reading the class name by single input which is displayed on td that has rowspan.
                $("." + unique_class_by_attr).val($(this)
            .val()); //in the else part there are hidden inputs which has same class of visible attribute. we are setting the value here on hidden input


            });

            $(document).on('focus', '.quantity_class', function() {
                $("tr").css("background-color", "");
                $("tr").find("input").css("background-color", "");

                // Set the background color of the parent tr to your desired color
                $(this).closest("tr").css("background-color", "#adadad");
                $(this).closest("tr").find("input").css("background-color", "#adadad");

            })
        })

        $(document).ready(function() {
            $(document).on('keyup', '.quantity_class', function() {
                var grand_total = 0;
                var sid = $(this).attr('data-sid');

                // var grandtot = 0;
                $('.quantity_class').each(function(index, element) {
                    var quantity = parseFloat($(element).val()) || 0;
                    var purchase = parseFloat($(element).closest('tr').find('.purchase_class')
                        .val());

                    var total2 = quantity * purchase;
                    // var tot1 = quantity * purchase;
                    $(element).closest('tr').find('.total2_class').val(total2.toFixed(2));
                    // $(element).closest('tr').find('.total2_class').val(tot1.toFixed(2));

                    grand_total += total2;
                    // console.log(grand_total);
                    // grandtot += tot1
                });

                $('#grandtotal211').val(grand_total.toFixed(2));
                // $('#grandtot211').val(grandtot.toFixed(2));
                console.log(grandtotal211)
                var filteredGrandTotal = 0;
                $('.quantity_class').each(function(index, element) {
                    var takensid = $(this).attr('data-sid')
                    // var takenmid=$(this).attr('data-mid')
                    var stringsid = (takensid).replace(/ /g, "_")
                    // alert($('.filtered_grand_total2'+stringsid).val());
                    var fgt2 = $('.filtered_grand_total2' + stringsid).val();

                    // alert(takensid);

                    var quantity = parseFloat($(element).val()) || 0;
                    var purchase = parseFloat($(element).closest('tr').find('.purchase_class')
                        .val());

                    // Apply the WHERE condition
                    if (sid === takensid) {
                        filteredGrandTotal += quantity * purchase;
                        $('.filtered_grand_total' + stringsid).val(filteredGrandTotal.toFixed(2));

                    }

                });

                // $('#filtered_grand_total').val(filteredGrandTotal.toFixed(2));
                //  console.log(filteredGrandTotal.toFixed(2));

            });
        });
    </script>



    {{-- <script>
    
                $(document).ready(function() {
                    var append_no = 0;
                    $(".add-row").click(function() {
                            append_no++;
                            var dataall = document.getElementById(
                            "medicine_append_row"); // medicine_append_row upper ke table ki id
                            var rowCount = 0;
                            rowCount = dataall.querySelectorAll("tr")
                            .length; //table me jitni row create hori hai uska count milta hai.

                         
                            var stockist = $('#stockist option:selected').text();
                            var medical = $('#medical').val();
                            

                            var i;
                            for (i = 0; i < rowCount; i++) {
                                

                                var medicine = $('.medicine_' + i + '').val();
                                var batch = $('.batch_no_' + i + '').val(); // .text()se text ayega id nh
                                var ptr1 = $('.ptr_class_' + i + '').val();
                                var mps1 = $('.mps_class_' + i + '').val();
                               

                                var grandtotal1 = $('#grandtotal1').val();
                                // var grandtotal2 = $('#medical').val();

                                var total1 = parseFloat(grandtotal1) + parseFloat(mps1)
                                // var total2 = parseFloat(medical)
                                var grand_total=0;
                                let grandtotal2=$(this).parent().parent().find('.medicals').val();
                                var total_row=$(".medicals");
                              
                                $('#grandtotal1').val(total1.toFixed(2));

                              
                                let stockist_input = '';
                                if (i == 0) {
                                    stockist_input = '<td rowspan="' + rowCount +
                                        '"><input type="text" readonly name="stockist[]" required="" style="border:none; width: 100%;" value="' +
                                         + ' value="{{$stocmed[0]->stockist}}"  "></td>'
                                    $("#stockist").val() +
                                        '"></i></td>';
                                    stockist_input = '<td rowspan="' + rowCount +
                                        '"><input type="text" readonly name="stockist[]" required="" style="border:none; width: 100%;" value="' +
                                         + ' value="{{$stocmed[0]->stockist}}"  "></td>'
                                    $("#stockist").val() +
                                        '"></i></td>';
                                } else {
                                    stockist_input =
                                        '<td style="display:none"> <input type=hidden" name="stockist[]" required="" style="border:none; width: 100%;" value="' +
                                        stockist.trim() + ' "></td>'
                                    $("#stockist").val() +
                                        '"></td>';
                                }
                                //ek hi bar name show krwane ke liye
                                let medical_input = '';
                                if (i == 0) {
                                    medical_input = '<td rowspan="' + rowCount +
                                        '"><input type="text" readonly name="medical[]" class="sale_Value" required="" style="border:none; width: 100%;" value="' +
                                    medical_input = '<td rowspan="' + rowCount +
                                        '"><input type="text" readonly name="medical[]" class="sale_Value" required="" style="border:none; width: 100%;" value="' +
                                        medical + '"></td>'
                                    $("#medical").val() +
                                        '"></i></td>';
                                } else {
                                    medical_input =
                                        '<td style="display:none"><input type="hidden"  name="medical[]" required="" style="border:none; width: 100%;" value="' +
                                        medical + '"></td>'
                                    $("#medical").val() +
                                        '"></i></td>';
                                }

                                let total2_input = '';
                                if (i == 0) {
                                    total2_input = '<td rowspan="' + rowCount +
                                        '"><input type="text" readonly name="grand_total1[]" required="" style="border:none; text-align:center; width: 100%;" value="' +
                                        $("#grandtotal22").val() +
                                        '"></i></td>';
                                    //    $("#grandtotal22").val() +
                                    //             '"></i></td>'; 
                                } else {
                                    total2_input =
                                        '<td style="display:none"><input type="hidden"  name="grand_total1[]" required="" style="border:none; text-align:center; width: 100%;" value="' +
                                        $("#grandtotal22").val() +
                                        '"></i></td>';
                                }


                                var markup =
                                    //trim() whitespace remove krne ke liye
                                    //direct input se read krne ke liye vale me $("#id").val() likhege
                                    //type=number  step="0.01"  stpep 0.01 se . wali value type krsakta hai or . ke bd sirf 2 digit hi type krskta hai
                                    '<tr>' + stockist_input + '' + medical_input +  '' +
                                    total2_input + ' <td><input type="hidden" name="append_no[]" value="' + append_no +
                                    '"><input type="text" readonly name="medicine[]" required="" style="border:none; width: 100%;" value="' +
                                    medicine +
                                    '"></td><td><input type="text" readonly name="purchase[]" style="border:none; width: 100%;" value="' +
                                    batch +
                                    '"></td><td><input type="number" readonly step="0.01" name="qnty[]" required="" style="border:none; width: 100%" value="' +
                                    ptr1 +
                                    '"></td><td><input readonly type="number" step="0.01" name="qntypurchase[]" required="" style="border:none; width: 100%;" value="' +
                                    mps1 +
                                    '"></td><td><button type="button" class="btn1 btn-outline-danger delete-row"><i class="bx bx-trash me-0"></i></button></td></tr>';


                                //                 const n = 5;
                                //                 for (let i = 1; i <= n; i++) {
                                //     console.log(markup);
                                // }

                                $(".add_more").append(markup);
                               

                                //    $('#stockist').val('');
                                // $('#medical').val('');
                                $('.medicine_' + i + '').val('');

                                $('.batch_no_' + i + '').val('');
                                $('.ptr_class_' + i + '').val('');
                                $('.mps_class_' + i + '').val('');
                              
                            }
console.clear();
                            var total2_new = 0;
                            let total_row_new=$(".sale_Value");
                            $.each(total_row_new,function(a,b){
                                total2_new=parseFloat(total2_new)+parseFloat($(this).val());
                            })
                            $('#grandtotal2').val(total2_new.toFixed(2));

                            $("#medicine_append_row").empty();
                            $('#grandtotal11').val(0);
                            $('#grandtotal22').val(0);
                            
                        })

                    

                    // Find and remove selected table rows
                    $("tbody").delegate(".delete-row", "click", function() {
                        var mpsqnty = $(this).parents("tr").find('input[name="mpsqnty[]"]').val()
                        var ptrqnty = $(this).parents("tr").find('input[name="ptrqnty[]"]').val()

                        var grandtotal1 = $('#grandtotal1').val();
                        var grandtotal2 = $('#grandtotal2').val();

                        var total1 = parseFloat(grandtotal1) - parseFloat(mpsqnty)
                        var total2 = parseFloat(grandtotal2) - parseFloat(ptrqnty)
                        $('#grandtotal1').val(total1);
                        $('#grandtotal2').val(total2);



$(this).closest("tr").remove();

                      

                    });


    
        $("#preview").on('click',function(){
var year=$('#year').find(':selected').text();
$('#previewyear').text(year);
var month=$('#month').find(':selected').text();
$('#previewmonth').text(month);
var company=$('#company').find(':selected').text();
$('#previewcompany').text(company);

$("#previewtable").empty();
var table=$("#table").clone();
$("#previewtable").append(table);

$("#previewgrandtable").empty();
var table2=$("#tablegrand").clone();
$("#previewgrandtable").append(table2);
      
    })

    $("#confirm").on('click',function(){
        $("#previewtable").empty();// array me data repeat hora tha islye preview table ko empty kiya
        $("#previewgrandtable").empty();
        $("#createpromotor_formid").submit();
    })


})</script>
    --}}


@stop

@extends('layout')
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


    <!--start page wrapper -->



    <form method="POST" action="{{ route('update-promotorsalereport') }}" >
         @csrf
        <input type="hidden" id="grandtotal11_input" name="grand_total1">
        <input type="hidden" id="grandtotal22_input" name="grand_total2">
        <input type="hidden" name="p_id" value="{{ $prosalereportedit->id }}">
        {{-- <input type="hidden" id="promed_id" value="{{ $stocmed[0]->promotor__sales_id }}" name="promed_id"> --}}

      


        <div class="page-wrapper">
            <div class="page-content">
                <div class="row">
                    <div class="col-md-12 mx-auto" style="margin-top: -10%;">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-center">

                                    <h5 class="mb-0 text-primary">Promotor Sales</h5>
                                    {{-- <input type="text" name="id" id="id"> --}}
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
                                    <div class="col-md-1">
                                        <label class="form-label">Year</label>
                                        <select class="multiple-select" data-placeholder="Choose anything" id="year"
                                            name="year_id">

                                            @foreach ($year as $years)
                                                <option value="{{ $years->id }}"
                                                    @if ($prosalereportedit->year_id == $years->id) selected @endif>
                                                    {{ $years->year }}


                                                </option>


                                                {{-- echo $year; --}}
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="inputFirstName" class="form-label">Sale of Month*</label>


                                        <select class="multiple-select" data-placeholder="Choose anything" id="month"
                                            name="sale_of_month">
                                            <option value="{{ $prosalereportedit->sale_of_month }}" selected>
                                                {{ $prosalereportedit->sale_of_month }}
                                            </option>
                                            {{-- <option value="{{date('F')}}" > 
                                        {{date('F')}}
                                  </option> --}}

                                            {{-- <option value="January" >January</option>
                                    <option value="February" >February</option>
                                    <option value="March" >March</option>
                                    <option value="April" >April</option>
                                    <option value="May" >May</option>
                                    <option value="June" >June</option>
                                    <option value="july" >july</option>
                                    <option value="August" >August</option>
                                    <option value="September" >September</option>
                                    <option value="October" >October</option>
                                    <option value="November" >November</option>
                                    <option value="December" >December</option> --}}


                                        </select>

                                    </div>

                                    <div class="col-md-2">
                                        <label for="inputFirstName" class="form-label">Select Company*</label>

                                        <select class="multiple-select companystokist medicaleschme1"
                                            data-placeholder="Choose anything" id="company1" name="company" disabled>
                                            <option value="">Select</option>
                                            @foreach ($company as $companys)
                                                <option value="{{ $companys->id }}"
                                                    @if ($prosalereportedit->select_company_id == $companys->id) selected @endif>
                                                    {{ $companys->Name }} </option>
                                            @endforeach
                                        </select>

                                    </div>



                                    <div class="col-md-2">
                                        <label for="inputFirstName" class="form-label">Select Marketing</label>
                                        <select class="multiple-select" data-placeholder="Choose anything" id="market"
                                            name="market" disabled>
                                            <option value="">Select</option>
                                            @foreach ($market as $option)
                                                <option value="{{ $option->id }}"
                                                    @if (old('market', $prosalereportedit->select_marketing_id) == $option->id) selected @endif>
                                                    {{ $option->name }}
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="col-md-2">
                                        <label for="inputFirstName" class="form-label">Select Doctor*</label>

                                        <select class="multiple-select" data-placeholder="Choose anything" id="doctor"
                                            name="doctor" disabled>
                                            <option value="">Select</option>
                                            @foreach ($doctor as $doctors)
                                                <option value="{{ $doctors->id }}"
                                                    @if ($prosalereportedit->select_doctor_id == $doctors->id) selected @endif>
                                                    {{ $doctors->allotted_dr_name }} </option>
                                            @endforeach

                                        </select>

                                    </div>

                                    {{-- <div class="col-md-1" style="margin-top:3%;">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleLargeModal2"><i class="fadeIn animated bx bx-plus"></i></button>

                                 </div>	 --}}


                                    <div class="col-md-2">
                                        <label for="inputFirstName" class="form-label">Select Scheme % *</label>

                                        <input type="text" class="form-control" id="" placeholder="scheme"
                                            name="sheme" value="{{ $prosalereportedit->select_scheme }}" disabled>

                                    </div>

                                </div>



                            </div>


                            <div style="overflow-x: scroll;">

                                <table style="width:100%; margin-top:4%;" id="table">
                                    <tr align="center">
                                        {{-- <th width="5%">Sr. No.</th> --}}
                                        <th width="22%">Stokist</th>
                                        <th width="20%">Medical</th>
                                        <th width="5%">Grand Total 1</th>
                                        <th width="5%">Grand Total 2</th>
                                        <th width="15%">Medicine</th>
                                        <th width="10%">Batch No</th>
                                        <th width="5%"> PTR </th>
                                        @if (auth()->check())
                                            <th width="8%">M+P+S</th>
                                        @endif
                                        <th width="5%">QNTY</th>
                                        {{-- <th width="10%">Batch No</th> --}}
                                        @if (auth()->check())
                                            <th width="10%">QNTY*(M+P+S)<br> Total 1 </th>
                                        @endif
                                        <th width="10%">(PTR*QNTY)<br> Total 2 </th>
                                        {{-- <th width="5%">Action</th> --}}
                                    </tr>
                                    {{-- <tr align="center" id="scheme_data"> --}}
                              

                                        <tbody class="">
                                            {{-- @json($stocmed) --}}
    
                                            @foreach ($stocmed as $key => $stocmed[0])
                                                <tr>
                                                    @php
                                                        $stock_name = str_replace(' ', '_', $stocmed[0]->select_stokist_id . $stocmed[0]->select_medical_id);
                                                    @endphp
                                                    <td>
														
                                                        <input type="hidden" readonly value="{{ $stocmed[0]->append_no }}"
                                                            id="append_no" name="append_no[]">
    
    
                                                        <input type="hidden" name="id[]"
                                                            value="{{ $stocmed[0]->id }}"><input type="text" readonly
                                                            class="form-control "
                                                            value="{{ $stocmed[0]->select_stokist_id }}" name="stockist[]">
                                                    </td>
    
                                                    <td><input type="text" readonly class="form-control "
                                                            value="{{ $stocmed[0]->select_medical_id }}" name="medical[]">
                                                    </td>
                                                    <td><input type="text" readonly
                                                            class="form-control "
                                                            value="{{ $stocmed[0]->grandtot1 }}" name="grandtot1[]"></td>
                                                    <td>
    
                                                        <input type="text" readonly
                                                            class="form-control filtered_grand_total2{{ $stock_name }}"
                                                            value="{{ $stocmed[0]->grandtot2 }}" name="grandtot2[]">
    
                                                    </td>
                                                    <td><input type="text" readonly class="form-control "
                                                            value="{{ $stocmed[0]->select_medicine1 }}" name="medicine[]">
                                                    </td>
                                                    <td><input type="text" readonly class="form-control "
                                                            value="{{ $stocmed[0]->select_batchs }}" name="batch[]"></td>
    
                                                    <td><input type="text" readonly class="form-control ptr_class "
                                                            value="{{ $stocmed[0]->ptrs }}" name="ptr1[]">
                                                    </td>
                                                    <td class="{{ auth()->guard('marketings')->check()? 'hide-mps': '' }}">
                                                        <input type="text" readonly class="form-control mps_class"
                                                            value="{{ $stocmed[0]->mpss }}" name="mps1[]">
                                                    </td>
                                                    <td><input type="text" value="{{ $stocmed[0]->qntys }}"
                                                            class="form-control quantity_class" name="qnty[]" tabindex="1"
                                                            id="quantity_{{ $loop->index }}"
                                                            data-sid="{{ $stocmed[0]->select_stokist_id }}"
                                                            data-mid="{{ $stocmed[0]->select_medical_id }}"></td>
                                                    <td class="{{ auth()->guard('marketings')->check()? 'hide-mps': '' }}">
                                                        <input readonly type="text"
                                                            value="{{ $stocmed[0]->qnty_mps_total }}" id="total_input"
                                                            class="form-control total1_class "name="mpsqnty[]">
                                                    </td>
                                                    <td><input readonly type="text"
                                                            value="{{ $stocmed[0]->qnty_ptr_total }}" id="total2_input"
                                                            class="form-control  total2_class" name="ptrqnty[]"></td>
                                                </tr>
                                            @endforeach
    
    
                                        </tbody>
                                </table>
                                    
                            </div>



                            <div>
                                <table class="table table-bordered " style="width:30%; margin-top:2%; margin-left:65%;"
                                    id="tablegrand">
                                    <thead class="t">
                                        <tr class="t">
                                            <th scope="col" class="t">Grand Total 1 : <input type="text"
                                                    readonly id="grandtotal11" name="grand_total1"
                                                    value="{{ $stocmed[0]->total_grand_total1 }}"></th>
                                            <th scope="col" class="t">Grand Total 2 : <input type="text"
                                                    id="grandtotal22" readonly name="grand_total2"
                                                    value="{{ $stocmed[0]->total_grand_total2 }}"></th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody >
										

									</tbody> --}}
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
            <!--start overlay-->
            <div class="overlay toggle-icon"></div>

        </div>
    </form>


@stop
@section('js')

    <script>
        $(document).ready(function() {

            $(".companystokist").on('change', function() {
                let doctor_id = $("#doctor").val();
                let stockist_id = $("#stockist").val();
                if (doctor_id && stockist_id) {
                    $.ajax({
                        url: "{{ route('get_medical_by_id') }}",
                        type: 'get',
                        data: {
                            doctor_id: doctor_id,
                            stockist_id: stockist_id
                        },
                        cache: false,
                        success: function(result) {
                            console.log(stockist_id);
                            $("#medical").empty();
                            $("#medical").append(' <option value=""> Select </option>');
                            $.each(result, function(a, b) {
                                $("#medical").append(' <option value="' + b.id + '">' +
                                    b.medical + '</option>');
                            })
                        }
                    });
                }


            })
        })





        //here
        //             $(document).on('keyup','.quantity_class',function(){


        // // var test=$(this);
        // // console.log(test);
        //         var grand_total=0;
        //         var grand_tota2=0;

        //                 let quanity=parseFloat($(this).val());
        //                 if(quanity>0){
        //                 }else{
        //                     quanity=0;
        //                 }
        //                 var total_row=$(".total2_class");

        //                 let ptrqty=$(this).parent().parent().find('.ptr_class').val();
        //                 let mpsqnty=$(this).parent().parent().find('.mps_class').val();
        //                 let total2=parseFloat(quanity)*parseFloat(ptrqty);
        //                 let total1=parseFloat(quanity)*parseFloat(mpsqnty);
        //                 $(this).parent().parent().find('.total2_class').val(total2.toFixed(2));
        //                 $(this).parent().parent().find('.total1_class').val(total1.toFixed(2));
        //                 $.each(total_row,function(a,b){
        //                     grand_total=parseFloat(grand_total)+parseFloat($(".total_input").val());
        //                     grand_tota2=parseFloat(grand_tota2)+parseFloat($(".total2_input").val());
        //                 })
        //                 $('#grandtotal11').val(grand_total.toFixed(2));
        //                 $('#grandtotal22').val(grand_tota2.toFixed(2));
        //                 //$(".quantity_class").trigger('keyup');

        //        } )


        // 			
    </script>
    {{-- <script>
    $(document).ready(function() {
        $(document).on('keyup', '.quantity_class', function() {
            var grand_total = 0;
            var grand_total2 = 0;

            $('.quantity_class').each(function(index, element) {
                var quantity = parseFloat($(element).val()) || 0;
                var ptrqty = parseFloat($(element).closest('tr').find('.ptr_class').val());
                var mpsqnty = parseFloat($(element).closest('tr').find('.mps_class').val());

                var total2 = quantity * ptrqty;
                var total1 = quantity * mpsqnty;
//  var grand;
                $(element).closest('tr').find('.total2_class').val(total2.toFixed(2));
                $(element).closest('tr').find('.total1_class').val(total1.toFixed(2));

                grand_total += total1;
                grand_total2 += total2;
            });


//             $total_counts = DB::table('promotorsalemedicine')
// ->where('promotor__sales_id',$stocmed[0]->promotor__sales_id)
// ->where('select_stokist_id',$stocmed[0]->select_stokist_id)

// ->sum('total1');
// echo $total_counts;

            $('#grandtotal11').val(grand_total.toFixed(2));
            $('#grandtotal22').val(grand_total2.toFixed(2));


           
        });
        });
    
</script>
 --}}


    <script>
        //     function demo(m){
        //         alert(m);
        //     }


        // function mayur(m){
        //     // alert(m);

        //             var quantity = parseFloat($('#quantity_'+m).val()) || 0;

        //                 var ptrqty = parseFloat($('#ptr1'+m).val())|| 0;
        //                 var mpsqnty = parseFloat($('#mps1'+m).val())|| 0;
        //                 var total2 = quantity * ptrqty;
        //                 var total1 = quantity * mpsqnty;
        //              $('#total_input'+m).val(total2);
        //             $('#total2_input'+m).val(total2);
        //            
        //             

        //         }

        $(document).ready(function() {

            $(document).on('focus', '.quantity_class', function() {
                $("tr").css("background-color", "");
                $("tr").find("input").css("background-color", "");

                // Set the background color of the parent tr to your desired color
                $(this).closest("tr").css("background-color", "#adadad");
                $(this).closest("tr").find("input").css("background-color", "#adadad");

            })

            $(document).on('keyup', '.quantity_class', function() {
                // console.log(1);
                var grand_total = 0;
                var grand_total2 = 0;
                var sid = $(this).attr('data-sid');
                var mid = $(this).attr('data-mid');


                // alert(sid);
                $('.quantity_class').each(function(index, element) {
                    // console.log(1);
                    var quantity = parseFloat($(element).val()) || 0;
                    var ptrqty = parseFloat($(element).closest('tr').find('.ptr_class').val());
                    var mpsqnty = parseFloat($(element).closest('tr').find('.mps_class').val());

                    var total2 = quantity * ptrqty;
                    var total1 = quantity * mpsqnty;

                    // console.log(total2);
                    // console.log(total1);

                    $(element).closest('tr').find('.total2_class').val(total2.toFixed(2));
                    $(element).closest('tr').find('.total1_class').val(total1.toFixed(2));

                    grand_total += total1;
                    grand_total2 += total2;

                    //console.log(grand_total);
                    //console.log(grand_total2);
                });

                $('#grandtotal11').val(grand_total.toFixed(2));
                $('#grandtotal22').val(grand_total2.toFixed(2));

                console.log($('#grandtotal11').val());
                console.log(grandtotal22);
                // Apply WHERE condition and calculate filtered grand total
                var filteredGrandTotal = 0;
                var filteredGrandTotal2 = 0;
                // var promotorSaleId =
                //     '{{ $stocmed[0]->promotor__sales_id }}'; // Replace with the actual value
                // var stockistId = '{{ $stocmed[0]->select_stokist_id }}'; // Replace with the actual value
                // var pro=promotor__sales_id;
                // var sec=select_stokist_id;
                $('.quantity_class').each(function(index, element) {
                    var takensid = $(this).attr('data-sid')
                    var takenmid = $(this).attr('data-mid')
                    var stringsid = (takensid + takenmid).replace(/ /g, "_")
                    // alert($('.filtered_grand_total2'+stringsid).val());
                    var fgt2 = $('.filtered_grand_total2' + stringsid).val();
                    var fgt = $('.filtered_grand_total' + stringsid).val();


                    var quantity = parseFloat($(element).val()) || 0;
                    var mpsqnty = parseFloat($(element).closest('tr').find('.mps_class').val());
                    var ptrqty = parseFloat($(element).closest('tr').find('.ptr_class').val());

                    // Apply the WHERE condition
                    if (sid === takensid && mid === takenmid) {
                        // alert(stringsid)
                        filteredGrandTotal += quantity * mpsqnty;
                        filteredGrandTotal2 += quantity * ptrqty;

                        // console.log(filteredGrandTotal);
                        // console.log(filteredGrandTotal2);

                        $('.filtered_grand_total2' + stringsid).val(filteredGrandTotal2.toFixed(2));
                        $('.filtered_grand_total' + stringsid).val(filteredGrandTotal.toFixed(2));


                    }

                });
                $('#grandtotal11_input').val(grand_total.toFixed(2));
                $('#grandtotal22_input').val(grand_total2.toFixed(2));

                // $('#filtered_grand_total').val(filteredGrandTotal.toFixed(2));

                // $('.filtered_grand_total2').val(filteredGrandTotal2.toFixed(2));

                //console.log(grand_total);
                //console.log(grand_total2);
            });
        });
    </script>




    <script>
        $(document).ready(function() {
            $("#year option").filter(function(index) {
                return $(this).text() == new Date().getFullYear();
            }).attr('selected', 'selected').change(); // current date show hone ke liye 

            $("#doctor").on('change', function() { // dr ke onchnge pe scheme milne ke liye
                $.ajax({
                    url: "{{ route('get_scheme_by_id') }}",
                    type: 'get',
                    data: {
                        doctor_id: $(this).val()
                    },
                    cache: false,
                    success: function(result) {
                        console.log(result);
                        $("#scheme1").val(result.Scheme);

                    }
                });
            })
        })
    </script>





    <script>
        $(document).ready(function() {
            $("#company1").on('change', function() {
                var selectedCompanyId = $(this).val();

                $.ajax({
                    url: "{{ route('get_market_by_id1') }}",
                    type: 'get',
                    data: {
                        id: selectedCompanyId
                    },
                    cache: false,
                    success: function(result) {
                        console.log(result);

                        // Clear existing options and add the new options
                        var marketSelect = $("#market");
                        marketSelect.empty();
                        marketSelect.append($('<option>', {
                            value: '',
                            text: 'Select'
                        }));
                        $.each(result, function(index, market) {
                            marketSelect.append($('<option>', {
                                value: market.id,
                                text: market.name,
                                selected: (market.id ==
                                    {{ $prosalereportedit->selected_market_id }}
                                ) // Select the matched market
                            }));
                        });
                    }
                });
            });

            // Trigger the 'change' event initially to populate the 'Select Marketing' dropdown
            $("#company1").trigger('change');
        });
    </script>

@stop

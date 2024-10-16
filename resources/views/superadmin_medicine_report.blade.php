@extends('layout')
@section('content')




    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
            
                <div class="col-md-12 mx-auto" style="margin-top: -10%;">
                    <div class="card-title d-flex align-items-center">

                        <h5 class="mb-0 text-primary">Medicine Report</h5>
                    </div>
                    <div class="card">
                       
                        <div class="card-body">
                            <div class="table-responsive">

                                {{-- <button type="submit" style="padding:6px" class="btn1  btn-primary px-3" name="action"
                                        value="pdf">Download PDF</button> --}}

                                <table id="example" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Sr. No.</th>
                                            <th>medicine</th>

                                            <th>company</th>
                                            {{-- <th>expiry_date</th>
                                                                <th>quantity</th>
                                                                <th>mrp</th> --}}
                                            <th>default_scheme</th>
                                            <th>batch_no</th>
                                            <th>given_gst</th>
                                            <th>purchase</th>
                                            <th>gst</th>
                                            <th>amount_after_gst</th>
                                            <th>retail_margin</th>
                                            <th>ptr</th>
                                            <th>stockist_margin</th>
                                            <th>pts</th>
                                            <th>management</th>
                                            <th>promotion_cost</th>
                                            <th>scheme</th>
                                            <th>mrp</th>
                                            <th>scheme_amount_deduct</th>
                                            <th>transport_expiry_breakage</th>
                                            <th>tot</th>
                                            <th>marketing_working_cost</th>
                                            <th>company_profit</th>
                                            <th>percent_profit_to_investment</th>
                                            <th>marketing_promotion_scheme</th>
                                            <th>percent_profit_to_ptr</th>
                                            {{-- <th style="background-color:#fff;">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 0;
                                            $j = 1;
                                            $k = 1;
                                        @endphp
                                        @foreach ($medlist as $row)
                                            <tr>
                                                <td>

                                                </td>
                                                <td>
                                                    @if ($i == 1 || $j == $i)
                                                        {{ $k }}
                                                    @endif
                                                </td>
                                                <td class="hov">
                                                    @if ($i == 1 || $j == $i)
                                                        {{ $row->medicine_id }}
                                                    @endif
                                                </td>
                                                {{-- <td>{{$row->medicine}}</td> --}}
                                                <td>
                                                    @if ($i == 1 || $j == $i)
                                                        {{ $row->Name }}
                                                        @php
                                                            $j = $j + 3;
                                                            $k = $k + 1;

                                                        @endphp
                                                    @endif

                                                </td>

                                                <td>{{ $row->default_scheme }}</td>

                                                <td>{{ $row->batch_no }}</td>
                                                <td>{{ $row->given_gst }}</td>
                                                <td>{{ $row->purchase }}</td>
                                                <td>{{ $row->gst }}</td>
                                                <td>{{ $row->amount_after_gst }}</td>
                                                <td>{{ $row->retail_margin }}</td>
                                                <td>{{ $row->ptr }}</td>
                                                <td>{{ $row->stockist_margin }}</td>
                                                <td>{{ $row->pts }}</td>
                                                <td>{{ $row->management }}</td>
                                                <td>{{ $row->promotion_cost }}</td>
                                                <td>{{ $row->scheme }}</td>
                                                <td>{{ $row->mrp }}</td>
                                                <td>{{ $row->scheme_amount_deduct }}</td>
                                                <td>{{ $row->transport_expiry_breakage }}</td>
                                                <td>{{ $row->tot }}</td>
                                                <td>{{ $row->marketing_working_cost }}</td>
                                                <td>{{ $row->company_profit }}</td>
                                                <td>{{ $row->percent_profit_to_investment }}</td>
                                                <td>{{ $row->marketing_promotion_scheme }}</td>
                                                <td>{{ $row->percent_profit_to_ptr }}</td>

                                                {{-- <td style="background-color:#fff;">
                                                    @if ($row->status == 1)
                                                        <a
                                                            href="{{ route('disable_medicine', $row->newmedicinemaster_id) }}">
                                                            <button type="button"
                                                                class="btn1 btn-outline-primary">Disable</button></a>
                                                    @endif

                                                    <a
                                                        href="{{ route('edit-update_medicine_master', $row->newmedicinemaster_id) }}">
                                                        <button type="button" class="btn1 btn-outline-success"><i
                                                                class='bx bx-edit-alt me-0'></i></button></a>

                                                    <a
                                                        href="{{ route('destroy-new_medicine_master', $row->newmedicinemaster_id) }}">
                                                        <button type="button" class="btn1 btn-outline-danger"><i
                                                                class='bx bx-trash me-0'></i></button>
                                                    </a>


                                                </td> --}}

                                            </tr>
                                            @php
                                                $i = $i + 1;
                                            @endphp
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

@stop
@section('js')
<script>
    $(function() {
        $("input[type='text']").keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });
</script>
<script>
    $(function() {
        $("input[type='text']").keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });
</script>

<script>
$(document).ready(function(){

$('#search').on('click',function() {
    var company = $("#company1").val();
    // alert(1)
})}
)

</script>

@stop
@extends('layout')
@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card-title d-flex align-items-center"  style="margin-top: -10%;">

                <h5 class="mb-0 text-primary">Expense Entry</h5>
            </div>
            <div class="overlay toggle-icon"></div>
            <hr />
            <div class="col-md-12 mx-auto" >
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
                                        {{-- <th>Category</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                {{-- @json($exp_entry) --}}
                                <tbody>
                                    @foreach ($exp_entry as $exp_entrys)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $exp_entrys->year }}</td>
                                            <td>{{ $exp_entrys->select_month }}</td>
                                            <td>{{ $exp_entrys->Name }}</td>
                                            {{-- <td>{{ $exp_entrys->category }}</td> --}}
                                            <td>
                                                <button type="button" class="btn btn-primary px-3 viewinfo"
                                                    data-bs-toggle="modal" data-bs-target="#exampleLargeModal"
                                                    id="{{ $exp_entrys->expense_entry_id }}">show</button>
                                                {{-- <a
                                                    href="{{ route('edit_expence_entry', $exp_entrys->expense_entries_id) }}">
                                                    <button type="button" class="btn1 btn-outline-success"><i
                                                            class='bx bx-edit-alt me-0'></i></button> </a>
                                                <a
                                                    href="{{ route('destroy_expence_entry', $exp_entrys->expense_entries_id) }}">
                                                    <button type="button" class="btn1 btn-outline-danger"><i
                                                            class='bx bx-trash me-0'></i></button> </a> --}}
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
    </div>

    <div class="modal fade" id="exampleLargeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title">Medicine Sale Report</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {{-- <form action="{{route('approvalemis')}}" method="post" >
						@csrf --}}
                {{-- <input type="text" id="getrecords" name="loan_idsss"> --}}
                <div class="modal-body">
                    <table class="table mb-0 table-striped">
                        <thead>

                            <tr>
                                <th scope="col">Category</th>
                                <th scope="col">Expense</th>
                                <th scope="col">Amount</th>

                            </tr>
                        </thead>
                        <tbody id="records">
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

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
                    $(".viewinfo").on('click', function() {
                            $("#getrecords").val($(this).attr('id'));
                            // let category = e.target.files[0];

                            $.ajax({
                                    url: "{{ route('get_record') }}",
                                    type: 'get',
                                    data: {
                                        expense_entry_id: $(this).attr('id')

                                    },
                                    cache: false,
                                    success: function(result) {
                                        var recordss = result.module;

                                        // console.clear();
                                        // console.warn('kuch bhi msg');
                                        // console.error('kuch bhi msg');
                                        // console.table(recordss);
                                        $("#records").empty();
                                        
                                            
                                            $.each(recordss, function(a, b)

                                                {
                                                if (b.expence_head == 'Vendor') {
                                                category = b.expence_head ;
                                            
                                            } else if(b.expence_head == 'Star'){
                                                category =  b.expence_head ;
                                            }
                                            else{
                                                category = b.category ;
                                            }
                                                    $("#records").append('<tr><td>' + category +
                                                        '</td><td>' + b.select_expense + '</td><td>' + b
                                                        .amount + '</td></tr>');

                                                })
                                        }
                                    });
                            })

                    })
    </script>

@stop

@extends('layout')

@section('content')
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-md-8 mx-auto" style="margin-top: -10%;">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-center">
                            <h5 class="mb-0 text-primary">Adverbs</h5>
                        </div>
                        <hr>
                        <br>
                        <form class="row g-2" method="post" action="{{route('update_msg')}}">
                            @csrf <!-- CSRF Token -->
                            <input type="hidden" name="id" value="{{$msg->id}}" >

                            <div class="col-md-2"></div>
                            <div class="col-md-3">
                                <label for="inputFirstName" class="form-label">Scrolling Message*</label>
                            </div>
                            <div class="col-md-5">
                                <textarea class="form-control" name="textarea" id="inputAddress" placeholder="Message..." rows="3">{{$msg->message}}</textarea>
                            </div>
                            <div class="col-md-2" style="margin-top:5%;">
                                <button type="submit" class="btn btn-primary px-3">
                                    <i class="lni lni-circle-plus"></i>Update
                                </button>
                            </div>
                        </form>
                        <hr>
                        <br>
                        <form class="row g-2" method="post" action="{{route('create_image')}}" enctype="multipart/form-data">
                            @csrf 
                            <div class="col-md-2"></div>
                            <div class="col-md-3">
                                <label for="inputFirstName" class="form-label">Promotional Images*</label>
                            </div>
                            <div class="col-md-3">
                                {{-- <label for="inputFirstName" class="form-label">Upload (400x200px)*</label> --}}
                                <input type="file" name="file" class="form-control" id="inputFirstName" placeholder="">
                            </div>
                            {{-- <div class="col-md-2" style="margin-top:5%;"> --}}
                                <div class="col-md-2" >
                                <button type="submit" class="btn btn-primary px-3">
                                    <i class="fadeIn animated bx bx-arrow-from-bottom"></i>Upload
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="overlay toggle-icon"></div>
        <hr/>
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Images</th>  
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($get_img as $img)    
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td> <a target="_black" href="{{ asset('images/slider_img/' . $img->image) }}">
                                        <img src="{{ asset('images/slider_img/' . $img->image) }}"
                                            style="height:50px;width:auto;" alt="">
                                    </a></td>
                                    <td>
                                       <a href="{{route('delete_img',$img->id)}}"> <button type="button" class="btn1 btn-outline-danger"><i class='bx bx-trash me-0'></i></button></a>
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
@stop

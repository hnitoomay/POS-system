@extends('admin.layouts.master')
@section('title','ProductEdit')

@section('content')
 <!-- MAIN CONTENT-->
            <div class="main-content">
                @if (session('updateSuccess'))
                <div class="custom-alert">
                    <div class="custom-alert-content">
                        <p>{{session('updateSuccess')}}</p>
                        <button class="close-alert">&times;</button>
                    </div>
                </div>
                @endif

                <script>
                    document.querySelector('.close-alert').addEventListener('click', function() {
                        // Hide the alert box by setting its display to 'none'
                        document.querySelector('.custom-alert').style.display = 'none';
                    });
                </script>

                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">

                        </div>
                        <div class="col-8 offset-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">

                                        <h3 class="text-center title-2">Product Details</h3>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-5 my-4" >
                                            @if ($productshow->image == null)
                                                <img src="{{asset('image/food.png')}}"  alt="Blank Profile">
                                                @else
                                                <img src="{{asset('Storage/'.$productshow->image)}}" class=" img-thumbnail shadow-sm" alt="Cool Admin" />
                                            @endif
                                        </div>
                                        <div class="col-6  offset-1">
                                            <div class="my-3"><b>Name:</b> <span class="text-dark">{{$productshow->name}}</span> </div>
                                            <div class="my-3"><b>Category:</b> <span class="text-dark"> {{$productshow->category_name}}</span> </div>
                                            <div class=""><b>Description:</b> </div>
                                            <div class=""><span  class="text-dark">{{$productshow->description}} </span></div>
                                            <div class="my-3"><b>Price:</b> <span class="text-dark">{{$productshow->price}} Kyat</span> </div>
                                            <div class="my-3"><b>View_Count: </b> <span class="text-dark">{{$productshow->view_count}}</span> </div>

                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <a href="{{route('product#list')}}" class=" col-2 mt-1  text-dark ml-2 text-decoration-none" ><- Back</a>
                                        <div class="col-8 offset-7 ">
                                            <a href="{{route('productupdate#page',$productshow->product_id)}}"> <button class="btn btn-dark ">Edit Product</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection




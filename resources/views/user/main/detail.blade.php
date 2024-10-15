@extends('user.layouts.master')

@section('content')
  <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('user#home')}}"><- Home</a>

                </nav>
            </div>
        </div>
    </div>
      <!-- Shop Detail Start -->
      <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{asset('storage/'.$menu->image)}}" alt="Image">
                        </div>

                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">

                <div class="h-100 bg-light p-30">
                    <h3>{{$menu->name}}</h3>
                    <div class="d-flex mb-3">

                        <small class="pt-1 h6">View - {{$menu->view_count + 1}}</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{$menu->price}} MMK</h3>
                    <p class="mb-4">{{$menu->description}}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" id="countValue" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" id="AddToCart" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                    <input type="hidden" id="userId" class="" value="{{Auth::user()->id}}">
                    <input type="hidden" id="productId" class="" value="{{$menu->product_id}}">
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($menulist as $item)
                    <div class="product-item bg-light">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{asset('storage/'.$item->image)}}" style="height: 230px" alt="">
                            <div class="product-action">

                                <a class="btn btn-outline-dark btn-square" href="{{ route('user#menuDetail', $item->product_id) }}"><i class="bi bi-info-circle-fill"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="{{ route('user#menuDetail', $item->product_id) }}">{{$item->name}}</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>{{$item->price}} MMK</h5><h6 class="text-muted ml-2"><del></del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small>View - {{$item->view_count}}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
    <!-- Products End -->
@endsection

@section('scriptSource')
    <script>
          $(document).ready(function() {
            let productId = $('#productId').val();
            console.log(productId);

            //for view count
            $.ajax({
                        type : 'get',
                        url : '/user/ajax/viewCount',
                        data : { 'productId' : productId},
                        dataType : 'json',

                    })

                $('#AddToCart').click(function(){
                     let source = {
                        'userId' : $('#userId').val(),
                        'productId' : $('#productId').val(),
                        'count' : $('#countValue').val()
                     }

                    $.ajax({
                        type : 'get',
                        url : '/user/ajax/insertCart',
                        data : source,
                        dataType : 'json',
                        success : function (response) {
                            //console.log(response);
                            if(response.status == 'success'){
                                window.location.href = "http://127.0.0.1:8000/user/home";
                            }

                         }
                    })
                })
          });
    </script>
@endsection

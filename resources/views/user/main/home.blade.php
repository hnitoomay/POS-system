@extends('user.layouts.master')

@section('content')

    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <!-- Price Start -->
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter by
                        category</span></h5>
                <div class="bg-light p-4 mb-30">
                    <form>
                        <div class="custom-control d-flex align-items-center justify-content-between mb-3 bg-dark text-white py-1 px-3">

                            <label class="mt-1">Categories</label>
                            <span class="badge border font-weight-normal">{{ Count($category) }}</span>
                        </div>
                        <div class="custom-control d-flex align-items-center justify-content-between mb-3 shadow-sm">
                            <a href="{{route('user#home')}}"> <p class="text-dark text-decoration-none">Available Menus</p></a>
                        </div>
                        @foreach ($category as $item)
                            <div class="custom-control d-flex align-items-center justify-content-between mb-3 shadow-sm">

                               <a href="{{route('filter#category',$item->category_id)}}"> <p class="text-dark text-decoration-none">{{ $item->name }}</p></a>

                            </div>
                        @endforeach

                    </form>
                </div>
                <!-- Price End -->
            </div>
            <!-- Shop Sidebar End -->
            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>

                                <a href="{{route('cart#list')}}" class="btn px-0 ml-3">
                                    <button class="btn btn-sm btn-dark py-2"> <i class="fas fa-shopping-cart text-primary"></i>
                                        <span class="badge border rounded-circle" style="padding-bottom: 2px;font-size: 14px;">  {{ count($cart)}}</span>
                                    </button>

                                </a>
                                {{-- <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button> --}}
                            </div>
                            <div class="">
                                <div class="btn-group ml-3">

                                    <select name="sorting" class="form-control " id="sortingOption">
                                        <option value="">Choose Sorting</option>
                                        <option value="asc">Ascending</option>
                                        <option value="desc">Descending</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                        <span class="row" id="dataList">
                            @foreach ($product as $item)
                                <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                    <div class="product-item bg-light mb-4" >
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" style="height: 230px" src="{{ asset('storage/' . $item->image) }}" alt="">

                                            <div class="product-action">

                                                <a class="btn btn-outline-dark btn-square" href="{{route('user#menuDetail',$item->product_id)}}"><i class="bi bi-info-circle-fill"></i></a>
                                            </div>
                                        </div>

                                        <div class="text-center py-4">
                                            <a class="h5 text-decoration-none text-truncate"
                                                href="{{route('user#menuDetail',$item->product_id)}}">{{ $item->name }}</a>
                                            <div class="d-flex align-items-center justify-content-center mt-2 text-danger">
                                                <h6>{{ $item->price }} MMK</h6>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </span>


                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('scriptSource')
    {{-- <script>
        $(document).ready(function() {

            $('#sortingOption').change(function() {
                $eventOption = $('#sortingOption').val();
                console.log($eventOption);

                if ($eventOption == 'asc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/productlist',
                        data: {
                            'status': 'asc'
                        },
                        dataType: 'json',
                        success: function(response) {
                             $list = '';

                                for ($i = 0; $i < response.length; $i++) {
                                    //console.log(`${response[$i].name}`);
                                    $list += `
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                        <div class="product-item bg-light mb-4">
                                            <div class="product-img position-relative overflow-hidden">
                                                <img class="img-fluid w-100" style="height: 230px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                                <div class="product-action">

                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="bi bi-info-circle-fill"></i></a>

                                                </div>
                                            </div>
                                            <div class="text-center py-4">
                                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                                <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5>${response[$i].price} Kyat</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    `;
                                }
                                $('#dataList').html($list);
                        }
                    })
                } else if ($eventOption == 'desc') {
                    $.ajax({
                        type: 'get',
                        url: '/user/ajax/productlist',
                        data: {
                            'status': 'desc'
                        },
                        dataType: 'json',
                        success: function(response) {
                             $list = '';


                                for ($i = 0; $i < response.length; $i++) {
                                //console.log(`${response[$i].name}`);
                                    $list += `
                                    <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                        <div class="product-item bg-light mb-4">
                                            <div class="product-img position-relative overflow-hidden">
                                                <img class="img-fluid w-100" style="height: 230px" src="{{ asset('storage/${response[$i].image}') }}" alt="">
                                                <div class="product-action">

                                                    <a class="btn btn-outline-dark btn-square" href=""><i class="bi bi-info-circle-fill"></i></a>

                                                </div>
                                            </div>
                                            <div class="text-center py-4">
                                                <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
                                                <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5>${response[$i].price} Kyat</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                }
                                $('#dataList').html($list);
                        }
                    })
                }
            })
        });
    </script> --}}
    <script>
        $(document).ready(function() {
        $('#sortingOption').change(function() {
        let eventOption = $('#sortingOption').val();

        if (eventOption === 'asc' || eventOption === 'desc') {
            $.ajax({
                type: 'get',
                url: 'http://127.0.0.1:8000/user/ajax/productlist',
                data: { 'status': eventOption },
                dataType: 'json',
                success: function(response) {
                    let list = '';
                    let baseUrl = '{{ url('user/menuDetail') }}'; // Get the base URL for the menu detail page

                    for (let i = 0; i < response.length; i++) {
                        list += `
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" style="height: 230px" src="{{ asset('storage') }}/${response[i].image}" alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" href="${baseUrl}/${response[i].product_id}">
                                                <i class="bi bi-info-circle-fill"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate" href="${baseUrl}/${response[i].product_id}">${response[i].name}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${response[i].price} Kyat</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                    $('#dataList').html(list);
                }
            });
        }
        });
        });

    </script>
@endsection

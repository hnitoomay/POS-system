@extends('user.layouts.master')

@section('content')
      <!-- Breadcrumb Start -->
      <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('user#home')}}"><- Shop</a>

                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="align-middle">
                       @foreach ($cartList as $item)
                       <tr>
                        <td><img src="{{asset('storage/'.$item->menu_image)}}" alt="" style="width: 80px;"> </td>
                        <td class="align-middle">{{$item->menu_name}}
                            <input type="hidden" class="cartId" value="{{$item->cart_id}}">
                            <input type="hidden" class="productId" value="{{$item->product_id}}">
                            <input type="hidden" class="userId" value="{{$item->user_id}}">
                        </td>
                        <td class="align-middle" id="price" >{{$item->menu_price}} MMK</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus" >
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" id="qty" class="form-control form-control-sm bg-secondary border-0 text-center" value="{{$item->quantity}}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle col-2" id="total">{{$item->menu_price*$item->quantity}}MMK</td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger  btnRemove"><i class="fa fa-times"></i></button></td>
                    </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="subtotal"> {{$totalPrice}}  MMK</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium"> 3000 MMK</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="finalPrice">{{$totalPrice+3000}} MMK </h5>
                        </div>
                        <button id="orderBtn" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                        <button id="cancelBtn" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Cancel Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

@endsection

@section('scriptSource')
    <script>
        $(document).ready(function(){
            $('.btn-plus').click(function(){
                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#price').html().replace('MMK',''));
                $quantity = Number($parentNode.find('#qty').val()) ;
                //console.log($price);
                //console.log($quantity);
                $total = $price*$quantity;
                //console.log($total);
                $parentNode.find('#total').html($total+'MMK'); //adding value to total field

                summaryCalculation();
            })

            $('.btn-minus').click(function(){
                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#price').html().replace('MMK',''));
                $quantity = Number($parentNode.find('#qty').val());
                 //console.log($price);
                //console.log($quantity);
                $total = $price*$quantity;
                $parentNode.find('#total').html($total+'MMK'); //adding value to total field

                summaryCalculation();
            })

            $('.btnRemove').click(function(){

                $parentNode = $(this).parents('tr');
                $productId = $parentNode.find('.productId').val();
                $cartId = $parentNode.find('.cartId').val();
                $.ajax({
                        type: 'get',
                        url: '/user/ajax/cart/rowClear',
                        data: {'productId': $productId , 'cartId' : $cartId},
                        dataType: 'json',

                    })

                $parentNode.remove();

                summaryCalculation();
            })

            function summaryCalculation(){
                $totalPrice = 0;
                //taking total price of all menus
                $('#tableBody tr').each(function(index, row){
                    $totalPrice += Number($(row).find('#total').text().replace('MMK',''));
                    //console.log($totalPrice);
                })

                $('#subtotal').html($totalPrice+'MMK');
                $('#finalPrice').html(($totalPrice + 3000) + 'MMK');
            }

            //this work for adding order list to orderlist table after customer clicked order btn
            $('#orderBtn').click(function(){
                $orderList = [];
                $random = Math.floor((Math.random() * 9000000) + 1000000);
                $('#tableBody tr').each(function(index, row){
                    $orderList.push({
                        'user_id' : $(row).find('.userId').val(),
                        'product_id' : $(row).find('.productId').val(),
                        'quantity' : $(row).find('#qty').val(),
                        'total' : Number($(row).find('#total').text().replace('MMK','')),
                        'order_code' : 0000 + $random
                    })
                })
                $.ajax({
                        type: 'get',
                        url: '/user/ajax/orderList',
                        data: Object.assign({}, $orderList),  //must be object
                        dataType: 'json',
                        success: function(response) {
                            if(response.status == 'true'){
                                window.location.href = "/user/home";
                            }
                        }
                    })
            })

            $('#cancelBtn').click(function(){

                 $('#tableBody tr').remove();
                 summaryCalculation();
                 $.ajax({
                        type: 'get',
                        url: '/user/ajax/cartClear',
                        dataType: 'json',
                    })
            })
        })

    </script>
@endsection

{{-- before cart list are showed, data are stored in cart table. to store data in cart table,
 we obtain product data from detail page by clicking AddtoCart buton. through button,
 Ajax collect data and send them to insert conroller and controller receive data sent by ajax through request
 , and insert them in cart table. after that, it response with json format which return to home page. --}}

 {{-- cart list and addtocart part can be seen seperately. because cart list can bee seen ony after data are inserted in cart table,
 rows in cart list page are retrieved from cart table. --}}

 {{-- adding product to cart table happen only if customer add product to cart through button,
 so we use ajax when sending data from client side to server side and store them in database--}}

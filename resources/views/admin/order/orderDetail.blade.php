@extends('admin.layouts.master')
@section('title','Order Detail')
@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <a href="javascript:history.back()" class="col-4 text-decoration-none text-dark"><- Back</a>
                <div class="col-3 card">
                    <p class="card-header mb-3 fw-bold">Order Voucher</p>
                    <p>Name: {{$data[0]->user_name}}</p>
                    <p>Order_code: {{$data[0]->order_code}}</p>
                    <p>Date: {{$data[0]->created_at->format('d-M-y')}}</p>
                    <p>Total_amount: {{$order->total_price}}MMK</p>
                    <small class="text-warning"><i class="bi bi-check-circle-fill me-2"></i>included delivery charges</small>
                </div>

                  <div class="table-responsive table-responsive-data2">

                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Order ID</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody id="datalist">
                            @foreach ($data as $item)
                            <tr class="tr-shadow">
                                <td></td>
                                <td>{{$item->id}}</td>
                                <td class="col-2"><img src="{{asset('storage/'.$item->product_image)}}" class=" img-thumbnail" alt=""></td>
                                <td>{{$item ->product_name}}</td>
                                <td>{{$item ->quantity}}</td>
                                <td>{{$item->unit_price}}</td>
                                <td>{{$item ->created_at->format('d-M-y')}}</td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>


                </div>
                <div class="my-2">
                    {{-- {{$order->appends(request()->query())->links()}} --}}

                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
@endsection

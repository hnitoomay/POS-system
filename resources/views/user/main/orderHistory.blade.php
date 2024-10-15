@extends('user.layouts.master')

@section('content')
      <!-- Breadcrumb Start -->
      <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{route('user#home')}}"><- Shop</a>
                    <div class=" col-6 offset-5 text-dark fw-bold">
                        Order History
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-8 offset-2 table-responsive mb-5">
                @if (Count($history) == 0)
                <div class=" empty col-6 offset-3">
                    <i class="bi bi-file-earmark-text"></i>
                    <h3 class="text-center">Order history is empty!</h3>
                    <p class="text-center">Your order history will appear here</p>
                </div>

                @else
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Date</th>
                            <th>Order_ID</th>
                            <th>Total Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="align-middle">
                        @foreach ($history as $item)
                        <tr>
                            <td>{{$item->created_at->format('d-M-y')}}</td>
                            <td class="align-middle">
                                {{$item->order_code}}
                            </td>
                            <td class="align-middle" >{{$item->total_price}} MMK</td>

                            <td class="align-middle">
                                @if ($item->status == 0)
                                <span class="text-info">Pending...</span>
                                @elseif ($item->status == 1)
                                    <span class="text-primary">Success...</span>
                                @elseif ($item->status == 2)
                                    <span class="text-danger">Reject...</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif

            </div>

        </div>
    </div>
    <!-- Cart End -->

@endsection


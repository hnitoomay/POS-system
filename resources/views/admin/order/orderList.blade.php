@extends('admin.layouts.master')
@section('title','Order List')

@section('content')
 <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <h4 class=" mb-3 fw-bold">Order List</h4>
                            <div class="d-flex">
                                <div class="col-10 ">
                                   <form action="{{route('adminOrder#status')}}" method="get">
                                    @csrf

                                    <div class="d-flex col-3 input-group">
                                        <select class="custom-select border border-dark " name="status">
                                            <option value="">All</option>
                                            <option value="0" @if (request('status')== '0') selected @endif>Pending...</option>
                                            <option value="1" @if (request('status')== '1') selected @endif>Accepted...</option>
                                            <option value="2" @if (request('status')== '2') selected @endif>Rejected...</option>
                                        </select>
                                        <button type="submit" class="btn  btn-dark "><i class="bi bi-search"></i></button>
                                    </div>

                                   </form>
                                </div>
                                <div class="col-2 mb-4" ><button class=" rounded bg-dark text-white p-2">Total - <b>{{Count($order)}}</b></button></div>
                            </div>

                              <div class="table-responsive table-responsive-data2">
                                @if ($order->isEmpty())
                                    <p class="text-center">No orders found for the selected status.</p>
                                    <div class="col-6 offset-3">
                                        <img src="{{asset('image/no-order.svg')}}" alt="">
                                    </div>
                                @else
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>User Name</th>
                                            <th>Order_Code</th>
                                            <th>Amount</th>

                                            <th>Date</th>
                                            <th>Status</th>


                                        </tr>
                                    </thead>

                                    <tbody id="datalist">
                                    @foreach ($order as $o)
                                       <tr class="tr-shadow">
                                        <input type="hidden" class="orderId" name="orderId" value="{{$o->id}}">
                                            <td>{{$o->user_id}}</td>
                                            <td>{{$o->user_name}}</td>
                                            <td><a href="{{route('adminOrder#detail',$o->order_code)}}" class="text-primary text-decoration-none">{{$o->order_code}}</a></td>
                                            <td>{{$o->total_price}} MMK</td>
                                            <td>{{$o->created_at->format('d-M-y')}}</td>
                                            <td>
                                                <select class="changeStatus border no-border text-primary">
                                                    <option  value="0" @if ($o->status == 0) selected @endif>Pending...</option>
                                                    <option  value="1" {{$o->status == 1 ? 'selected':''}}>Accepted...</option>
                                                    <option  value="2" @if ($o->status == 2) selected @endif>Rejected...</option>
                                                </select>
                                            </td>

                                       </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                @endif

                            </div>
                            <div class="my-2">
                                {{-- {{$order->appends(request()->query())->links()}} --}}

                            </div>
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
            </div>
<!-- END MAIN CONTENT-->
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function(){
            // $('.orderStatus').change(function(){
            //     $status = $('.orderStatus').val();
            //     console.log($status);
            //     $.ajax({
            //             type : 'get',
            //             url : 'http://127.0.0.1:8000/adminOrder/ajax/orderStatus',
            //             data : {'status': $status},
            //             dataType : 'json',
            //             success : function (response) {
            //                 $list = '';
            //                 for($i = 0; $i < response.length; $i++){

            //                     $newDate = new Date(response[$i].created_at); //date from database changing js format
            //                     $month = ['January','February','March','April','May','June','July','August','September','October','November','December'];
            //                     $newFormat = $newDate.getDate()+'-'+$month[$newDate.getMonth()]+'-'+$newDate.getFullYear();
            //                     console.log($newFormat);

            //                     //old data selected
            //                     if(response[$i].status == 0){
            //                         $statusMessage = `
            //                          <select class="changeStatus border no-border text-primary">
            //                                 <option  value="0" selected>Pending...</option>
            //                                 <option  value="1" >Accept...</option>
            //                                 <option  value="2">Reject...</option>
            //                         </select>
            //                         `;

            //                     }
            //                     else if(response[$i].status == 1){
            //                         $statusMessage = `
            //                          <select class="changeStatus border no-border text-primary">
            //                                 <option  value="0" >Pending...</option>
            //                                 <option  value="1" selected>Accept...</option>
            //                                 <option  value="2">Reject...</option>
            //                         </select>
            //                         `;
            //                     }
            //                     else if(response[$i].status == 2){
            //                         $statusMessage = `
            //                          <select class="changeStatus border no-border text-primary">
            //                                 <option  value="0" >Pending...</option>
            //                                 <option  value="1" >Accept...</option>
            //                                 <option  value="2" selected>Reject...</option>
            //                         </select>
            //                         `;
            //                     }

            //                 $list +=  `
            //                    <tr class="tr-shadow">
            //                         <input type="hidden" class="orderId" name="orderId" value="${response[$i].id}">
            //                         <td>${response[$i].user_id}</td>
            //                         <td>${response[$i].user_name} </td>
            //                         <td>${response[$i].order_code}</td>
            //                         <td>${response[$i].total_price} MMK</td>
            //                         <td>${$newFormat}</td>
            //                         <td>
            //                             ${$statusMessage}
            //                         </td>
            //                    </tr>
            //                 `;
            //                 }
            //                 $('#datalist').html($list);
            //              }
            //         })
            // })

            $('.changeStatus').change(function(){
                $parentNode = $(this).parents('tr');
                $changeStatus = $(this).val();
                console.log($changeStatus);
                $orderId = $parentNode.find('.orderId').val();
                console.log($orderId);  //after this stage, we have to sent them to server by Ajax

                $.ajax({
                        type : 'get',
                        url : 'http://127.0.0.1:8000/adminOrder/ajax/changeStatus',
                        data : {
                            'changeStatus':$changeStatus,
                            'orderId' : $orderId
                        },
                        dataType : 'json',
                })
                location.reload();

            })
        })
    </script>
@endsection



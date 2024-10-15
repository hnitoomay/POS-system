@extends('admin.layouts.master')
@section('title','Product List')

@section('content')
 <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <h4 class=" text-indigo mb-3 fw-bold">Product List</h4>

                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="overview-wrap">
                                        <form action="{{route('product#list')}}" method="get">
                                            @csrf
                                           <div class="input-group">
                                            <input type="text" class="form-control border-light" name="key" value="{{request('key')}}" placeholder="Search...">
                                            <button class="btn btn-dark" type="submit"><i class="bi bi-search"></i></button>
                                           </div>
                                        </form>
                                    </div>

                                </div>

                                <div class="table-data__tool-right">
                                    <a href="{{route('product#create')}}">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>Add Product
                                        </button>
                                    </a>

                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="  mb-2" ><button class=" rounded bg-dark text-white p-2">Total - <b>{{$products->total()}}</b></button></div>
                                <div class="col-3 offset-8">
                                        @if (session('deleteSuccess'))
                                        <div class="">
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>{{session('deleteSuccess')}}</strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                        </div>
                                        @endif
                                </div>
                            </div>
                              @if (count($products) != 0)
                              <div class="table-responsive table-responsive-data2">
                                <table class="table table-data2">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>View_Count</th>
                                            <th>CRUD</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($products as $p)
                                       <tr class="tr-shadow">
                                       <td class="product-image">
                                        @if ($p->image!= null)
                                        <img src="{{asset('storage/'.$p->image)}}"   alt="">

                                        @else
                                        <img src="{{asset('image/food.png')}}"  alt="Blank Profile">
                                        @endif
                                         </td>

                                        <td>{{$p->name}}</td>
                                        <td>
                                            {{$p->category_name}}
                                        </td>

                                        <td>{{$p->description}}</td>

                                        <td>{{$p->price}}</td>
                                        <td>{{$p->view_count}}</td>
                                        <td>
                                            <div class="table-data-feature">

                                                <a href="{{route('product#edit',$p->product_id)}}" class="me-2">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="View">
                                                        <i class="zmdi zmdi-eye text-primary"></i>
                                                    </button>
                                                </a>
                                                <a href="{{route('product#delete',$p->product_id)}}" class="mr-1">
                                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                        <i class="zmdi zmdi-delete text-danger"></i>
                                                    </button>
                                                </a>

                                            </div>
                                        </td>
                                       </tr>
                                       @endforeach
                                    </tbody>
                                </table>
                            </div>
                              @else
                              <h3 class="text-black mt-4">There is no product.....</h3>
                              @endif

                            <div class="my-2">
                                {{$products->appends(request()->query())->links()}}

                            </div>
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection



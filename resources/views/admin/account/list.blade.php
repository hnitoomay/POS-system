@extends('admin.layouts.master')
@section('title','Admin List')

@section('content')
 <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <h4 class=" text-indigo mb-3 fw-bold">Admin List</h4>

                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="overview-wrap">

                                        <form action="{{route('admin#list')}}" method="get">
                                            @csrf
                                           <div class="input-group">
                                            <input type="text" class="form-control border-light" name="key" value="{{request('key')}}" placeholder="Search...">
                                            <button class="btn btn-dark" type="submit"><i class="bi bi-search"></i></button>
                                           </div>
                                        </form>
                                    </div>

                                </div>

                                <div class="table-data__tool-right">
                                    <div class="  mb-2" ><button class=" rounded bg-dark text-white p-2">Total - <b>{{$adminlist->total()}}</b></button></div>

                                </div>

                            </div>
                            <div class="d-flex">

                                <div class="col-3 offset-8">

                                    @if(session('deleteSuccess'))
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


                            @if (count($adminlist) != 0)
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>Image</th>
                                                <th> Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Gender</th>
                                                <th>CRUD</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($adminlist as $a)
                                            <tr class="tr-shadow">
                                                <td class="col-2">
                                                    @if ($a->image == null)
                                                        @if ($a->gender == 'male')
                                                            <img src="{{asset('image/male.jpg')}}" alt="">
                                                        @else
                                                            <img src="{{asset('image/female.jpg')}}" alt="">
                                                        @endif
                                                    @else
                                                        <img src="{{asset('storage/'. $a->image)}}" class="" alt="">

                                                    @endif
                                                </td>
                                                <td>{{$a->id}}</td>
                                                <td>{{$a->email}}</td>
                                                <td>
                                                    {{$a->phone}}
                                                </td>
                                                <td>{{$a->address}}</td>
                                                <td>{{$a->gender}}</td>
                                                <td>
                                                    <div class="table-data-feature">

                                                        @if (Auth::user()->id == $a->id )
                                                        <a href="{{route('admin#detail',$a->id)}}" class="me-2">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="zmdi zmdi-edit text-info"></i>
                                                            </button>
                                                        </a>
                                                        @else
                                                        <a href="{{route('change#role',$a->id)}}" class="me-2">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="zmdi zmdi-edit text-info"></i>
                                                            </button>
                                                        </a>
                                                            <a href="{{route('admin#delete',$a->id)}}" class="mr-1">
                                                                <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                                    <i class="zmdi zmdi-delete text-danger"></i>
                                                                </button>
                                                            </a>
                                                        @endif



                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach




                                        </tbody>
                                    </table>
                                </div>

                            @else
                                <h3 class="text-black mt-4">There is no data.....</h3>

                            @endif

                            <div class="my-2">

                                {{$adminlist->appends(request()->query())->links()}}

                            </div>
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection



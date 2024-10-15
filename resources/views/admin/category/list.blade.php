@extends('admin.layouts.master')
@section('title','Category List')

@section('content')
 <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <!-- DATA TABLE -->
                            <h4 class=" text-indigo mb-3 fw-bold">Category List</h4>

                            <div class="table-data__tool">
                                <div class="table-data__tool-left">
                                    <div class="overview-wrap">

                                        <form action="{{route('category#list')}}" method="get">
                                            @csrf
                                           <div class="input-group">
                                            <input type="text" class="form-control border-light" name="key" value="{{request('key')}}" placeholder="Search...">
                                            <button class="btn btn-dark" type="submit"><i class="bi bi-search"></i></button>
                                           </div>
                                        </form>
                                    </div>

                                </div>

                                <div class="table-data__tool-right">
                                    <a href="{{route('category#create')}}">
                                        <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                            <i class="zmdi zmdi-plus"></i>Add Category
                                        </button>
                                    </a>

                                </div>

                            </div>
                            <div class="d-flex">

                                <div class="  mb-2" ><button class=" rounded bg-dark text-white p-2">Total - <b>{{$category->total()}}</b></button></div>
                                <div class="col-3 offset-8">
                                    @if (session('insertSuccess'))
                                    <div class="">
                                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                            <strong>{{session('insertSuccess')}}</strong>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    </div>
                                    @endif
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


                            @if (count($category) != 0)
                                <div class="table-responsive table-responsive-data2">
                                    <table class="table table-data2">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category Name</th>
                                                <th>Created Date</th>
                                                <th>CRUD</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($category as $item)
                                            <tr class="tr-shadow">
                                                <td>{{$item->category_id}}</td>
                                                <td>
                                                    {{$item->name}}
                                                </td>
                                                <td>{{$item->created_at->format('d-M-y')}}</td>
                                                <td>
                                                    <div class="table-data-feature">

                                                        <a href="{{route('category#edit',$item->category_id)}}">
                                                            <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                                <i class="zmdi zmdi-edit text-info"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{route('category#delete', $item->category_id)}}" class="mr-1">
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
                                <h3 class="text-black mt-4">There is no category.....</h3>

                            @endif

                            <div class="my-2">
                                {{$category->appends(request()->query())->links()}}

                            </div>
                            <!-- END DATA TABLE -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection



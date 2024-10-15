@extends('admin.layouts.master')
@section('title','Product Update')

@section('content')
 <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">

                        </div>
                        <div class="col-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{route('product#update',$productcarry->product_id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-title d-flex">
                                            <a href="{{route('product#edit',$productcarry->product_id)}}" class=" col-4   text-dark text-decoration-none" ><- Back</a>
                                            <h3 class="text-center title-2">Product Edit Form</h3>
                                        </div>
                                        <hr>
                                        <div class="">
                                            <div class="col-10 offset-1" style="background-color: rgb(254, 246, 234)">
                                                <div class="col-8 offset-2 mb-1 "  >
                                                    @if ($productcarry->image != null)
                                                    <img src="{{ asset('Storage/' . $productcarry->image) }}" class=" shadow-sm" alt="Cool Admin" />
                                                    @else
                                                        <img src="{{ asset('image/food.png') }}" alt="Blank Profile">
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-10 offset-1 ">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Image</label>
                                                    <input type="file" name="image" class="form-control @error('image')
                                                        is-invalid
                                                    @enderror" id="">
                                                    @error('image')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Name</label>
                                                    <input id="" name="name" value="{{old('name',$productcarry->name)}}" type="text" class="form-control @error('name')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="">
                                                    @error('name')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Category</label>
                                                   <select name="category" class="form-control @error('category')
                                                        is-invalid
                                                    @enderror" id="">
                                                    <option value="">Choose category....</option>
                                                    @foreach ($category as $item)
                                                        <option value="{{$item->category_id}}" {{$productcarry->category_id == $item->category_id ? 'selected':''}}>{{$item->name}}</option>
                                                    @endforeach

                                                   </select>
                                                    @error('category')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Description</label>
                                                    <textarea name="description" class="form-control @error('description')
                                                        is-invalid
                                                    @enderror" id="" cols="30" rows="10">{{old('description',$productcarry->description)}}</textarea>
                                                    @error('description')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                     @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Price</label>
                                                    <input id="" name="price" value="{{old('price',$productcarry->price)}}" type="text" class="form-control @error('price')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="">
                                                    @error('price')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                     @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row col-6 offset-3">
                                            <button type="submit" class="btn btn-info">Update Detail</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection



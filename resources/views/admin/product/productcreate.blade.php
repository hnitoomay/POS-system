@extends('admin.layouts.master')
@section('title','Product Create')

@section('content')
 <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3 offset-8">
                                <a href="{{route('product#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                            </div>
                        </div>
                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">
                                        <h3 class="text-center title-2">Product Form</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('product#insert')}}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group">
                                            <label class="control-label mb-1">Name</label>
                                            <input id="" name="name" value="{{old('name')}}" type="text" class="form-control @error('name')
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
                                               <option value="">Choose category...</option>
                                               @foreach ($category as $item)
                                               <option class="" value="{{$item->category_id}}" {{old('category') == $item->category_id ? 'selected':''}}>{{$item->name}}</option>

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
                                            @enderror" id="" cols="30" rows="10">{{old('description')}}</textarea>
                                            @error('description')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Image</label>
                                            <input id="" name="image" type="file" class="form-control @error('image')
                                                is-invalid
                                            @enderror" aria-required="true" aria-invalid="false" placeholder="">
                                            @error('image')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label mb-1">Price</label>
                                            <input id="" name="price" value="{{old('price')}}" type="text" class="form-control @error('price')
                                                is-invalid
                                            @enderror" aria-required="true" aria-invalid="false" placeholder="">
                                            @error('price')
                                            <div class="invalid-feedback">
                                                {{$message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="col-7 offset-4">
                                            <button id="payment-button" type="submit" class="btn btn-dark col-6">
                                                <span id="payment-button-amount">Create</span>
                                                <span id="payment-button-sending" style="display:none;">Sending…</span>
                                                <i class="fa-solid fa-circle-right"></i>
                                            </button>
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



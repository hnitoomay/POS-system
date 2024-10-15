@extends('admin.layouts.master')
@section('title','Account Change')

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
                                    <form action="{{route('detail#update',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-title d-flex">
                                            <a href="{{route('admin#detail')}}" class="col-4 text-decoration-none text-dark"><- Back</a>
                                            <h3 class="text-center title-2">Account Edit Form</h3>
                                        </div>
                                        <hr>
                                        <div class="">
                                            <div class="col-10 offset-1 bg-light bg-gradiend">
                                                <div class="col-8 offset-2 mb-1 " >
                                                    @if (Auth::user()->image == null)
                                                            @if (Auth::user()->gender == 'male')
                                                            <img src="{{asset('image/male.jpg')}}" alt="">
                                                        @else
                                                            <img src="{{asset('image/female.jpg')}}" alt="">
                                                        @endif
                                                    @else
                                                    <img src="{{asset('Storage/'.Auth::user()->image)}}" class="img-thumbnail profile-image" alt="Cool Admin" />
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-10 offset-1 ">
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Image</label>
                                                    <input type="file" name="detailFile" class="form-control @error('detailFile')
                                                        is-invalid
                                                    @enderror" id="">
                                                    @error('detailFile')
                                                        <div class="invalid-feedback">
                                                            {{$message}}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Name</label>
                                                    <input id="" name="detailName" value="{{old('detailName',Auth::user()->name)}}" type="text" class="form-control @error('detailName')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="">
                                                    @error('detailName')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Role</label>
                                                    <input id="" name="detailRole" value="{{old('detailRole',Auth::user()->role)}}" type="text" class="form-control @error('detailRole')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="" disabled>

                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Email</label>
                                                    <input id="" name="detailEmail" value="{{old('detailEmail',Auth::user()->email)}}" type="text" class="form-control @error('detailEmail')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="">
                                                    @error('detailEmail')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                     @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Gender</label>
                                                    <select name="detailGender" class="form-control @error('detailGender')
                                                        is-invalid
                                                    @enderror" id="" >

                                                        <option value="male" {{old('detailGender', Auth::user()->gender) == 'male' ? 'selected' : ''}}>Male</option>
                                                        <option value="female"  {{old('detailGender', Auth::user()->gender) == 'female' ? 'selected' : ''}}> Female</option>
                                                    </select>
                                                    @error('detailGender')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                     @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Address</label>
                                                    <input id="" name="detailAddress" value="{{old('detailAddress',Auth::user()->address)}}" type="text" class="form-control @error('detailAddress')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="">
                                                    @error('detailAddress')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                     @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Phone</label>
                                                    <input id="" name="detailPhone" value="{{old('detailPhone',Auth::user()->phone)}}" type="text" class="form-control @error('detailPhone')
                                                        is-invalid
                                                    @enderror" aria-required="true" aria-invalid="false" placeholder="" >
                                                    @error('detailPhone')
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



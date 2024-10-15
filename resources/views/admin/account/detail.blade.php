@extends('admin.layouts.master')
@section('title','Account Change')

@section('content')
 <!-- MAIN CONTENT-->
            <div class="main-content">
                @if (session('updateSuccess'))
                <div class="custom-alert">
                    <div class="custom-alert-content">
                        <p>{{session('updateSuccess')}}</p>
                        <button class="close-alert">&times;</button>
                    </div>
                </div>
                @endif

                <script>
                    document.querySelector('.close-alert').addEventListener('click', function() {
                        // Hide the alert box by setting its display to 'none'
                        document.querySelector('.custom-alert').style.display = 'none';
                    });
                </script>

                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">

                        </div>
                        <div class="col-8 offset-2">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex">
                                        <a href="{{route('admin#list')}}" class="col-4 text-decoration-none text-dark"><- Back</a>
                                        <h3 class="text-center title-2">Account Detail Form</h3>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-4 offset-1 my-4" style="width: 200px; height: 200px; overflow: hidden;">
                                            @if (Auth::user()->image == null)

                                                        @if (Auth::user()->gender == 'male')
                                                            <img src="{{asset('image/male.jpg')}}" class="profile-image img-thumbnail shadow-sm" alt="">
                                                        @else
                                                            <img src="{{asset('image/female.jpg')}}" class="profile-image img-thumbnail shadow-sm" alt="">
                                                        @endif

                                            @else
                                                <img src="{{asset('Storage/'.Auth::user()->image)}}" class="profile-image img-thumbnail shadow-sm" width="100%" height="100%" alt="Cool Admin" />
                                            @endif
                                        </div>
                                        <div class="col-6 offset-1 ">
                                            <p class="my-3">Name:    <b>{{Auth::user()->name}}</b></p>
                                            <p class="my-3">Role:    <b>{{Auth::user()->role}}</b></p>
                                            <p class="my-3">Email:   <b>{{Auth::user()->email}}</b></p>
                                            <p class="my-3">Gender:   <b>{{Auth::user()->gender}}</b></p>
                                            <p class="my-3">Address: <b>{{Auth::user()->address}}</b></p>
                                            <p class="my-3">Phone: <b>{{Auth::user()->phone}}</b></p>
                                        </div>
                                    </div>
                                    <div class=" col-4 offset-6 ">
                                        <a href="{{route('detail#edit')}}"> <button class="btn btn-dark">Edit Profile</button></a>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
@endsection




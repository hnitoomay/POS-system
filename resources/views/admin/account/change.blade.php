@extends('admin.layouts.master')
@section('title','Password Change')

@section('content')
 <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">

                        </div>
                        <div class="col-lg-6 offset-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex">
                                        <a href="{{route('admin#list')}}" class="col-4 text-decoration-none text-dark"><- Back</a>
                                        <h3 class="text-center title-2">Password Form</h3>
                                    </div>
                                    <hr>
                                    <form action="{{route('adminpassword#change')}}" method="post" novalidate="novalidate">
                                        @csrf
                                        @if (session('successPassword'))
                                        <div class="">
                                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                                <strong>{{session('successPassword')}}</strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        @endif
                                        @if (session('failPassword'))
                                        <div class="">
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>{{session('failPassword')}}</strong>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Old Password</label>
                                            <input id="" name="oldPassword" type="password" class="form-control @error('oldPassword')
                                                is-invalid
                                            @enderror" aria-required="true" aria-invalid="false" placeholder="">

                                            @error('oldPassword')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">New Password</label>
                                            <input id="" name="newPassword"  type="password" class="form-control  @error('newPassword')
                                                is-invalid
                                            @enderror" aria-required="true" aria-invalid="false" placeholder="">

                                            @error('newPassword')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror

                                        </div>
                                        <div class="form-group">
                                            <label for="" class="control-label mb-1">Confirm password</label>
                                            <input id="" name="confirmPassword"  type="password" class="form-control @error('confirmPassword')
                                                is-invalid
                                            @enderror" aria-required="true" aria-invalid="false" placeholder="confirm...">

                                            @error('confirmPassword')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div>
                                            <button id="payment-button" type="submit" class="btn btn-dark btn-block">
                                                <span id="payment-button-amount">Change Password</span>
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



@extends('user.layouts.master')

@section('content')
<div class="col-4 offset-4">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h3 class="text-center title-2">Change Your Password</h3>
            </div>
            <hr>
            <form action="{{route('user#updatePassword',Auth::user()->id)}}" method="post" novalidate="novalidate">
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
                    <label class="control-label mb-1">Old Password</label>
                    <input name="oldPassword" type="password" class="form-control @error('oldPassword')
                        is-invalid
                    @enderror" aria-required="true" aria-invalid="false" placeholder="">

                    @error('oldPassword')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror

                </div>
                <div class="form-group">
                    <label class="control-label mb-1">New Password</label>
                    <input name="newPassword"  type="password" class="form-control  @error('newPassword')
                        is-invalid
                    @enderror" aria-required="true" aria-invalid="false" placeholder="">

                    @error('newPassword')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror

                </div>
                <div class="form-group">
                    <label class="control-label mb-1">Confirm password</label>
                    <input name="confirmPassword"  type="password" class="form-control @error('confirmPassword')
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

                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

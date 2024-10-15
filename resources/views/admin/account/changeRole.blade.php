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
                                    <form action="{{route('role#update',$account->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-title d-flex">
                                            <a href="{{route('admin#list')}}" class="col-4 text-decoration-none text-dark"><- Back</a>
                                            <h3 class="text-center title-2">Role Edit Form</h3>
                                        </div>
                                        <hr>
                                        <div class="">

                                            <div class="form-group bg-light">

                                                <div class="col-6 offset-3 mb-1 bg-secondary">
                                                    @if ($account->image == null)
                                                    @if ($account->gender == 'male')
                                                        <img src="{{asset('image/male.jpg')}}" class="profile-image" alt="">
                                                    @else
                                                        <img src="{{asset('image/female.jpg')}}" class="profile-image" alt="">
                                                    @endif
                                                @else
                                                    <img src="{{asset('storage/'. $account->image)}}" class="profile-image" alt="">
                                                @endif
                                                </div>

                                            </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Name</label>
                                                    <input id="" name="detailName" value="{{old('detailName',$account->name)}}" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="" disabled>

                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Role</label>
                                                    <select name="detailRole" class="form-control " id="">
                                                        <option value="admin" {{old('detailRole') == 'Admin'? 'selected':''}}>Admin</option>
                                                        <option value="user" {{old('detailRole') == 'User'? 'selected':''}}>User</option>
                                                    </select>

                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label mb-1">Created Date</label>
                                                    <input id="" name="detailCreate" value="{{old('detailCreate',$account->created_at->format('d-M-y'))}}" type="text" class="form-control" aria-required="true" aria-invalid="false" placeholder="" disabled>

                                                </div>
                                                <div class="row col-6 offset-3">
                                                    <button type="submit" class="btn btn-info">Update Detail</button>
                                                </div>
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



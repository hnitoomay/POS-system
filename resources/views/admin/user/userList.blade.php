@extends('admin.layouts.master')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="  mb-2" ><button class=" rounded bg-dark text-white p-2">Total - <b>{{$userList->total()}}</b></button></div>
                  <div class="table-responsive table-responsive-data2">

                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Profile</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="datalist">
                            @foreach ($userList as $item)
                                <tr>
                                    <td class="col-2">
                                        @if ($item->image == null)

                                        @if ($item->gender == 'male')
                                            <img src="{{asset('image/male.jpg')}}" class="profile-image img-thumbnail shadow-sm" alt="">
                                        @else
                                            <img src="{{asset('image/female.jpg')}}" class="profile-image img-thumbnail shadow-sm" alt="">
                                        @endif

                                        @else
                                            <img src="{{asset('Storage/'.$item->image)}}" class="profile-image img-thumbnail shadow-sm" width="100%" height="100%" alt="Cool Admin" />
                                        @endif
                                    </td>
                                    <td class="userId">{{$item->id}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>
                                        <select name="role" class="roleChange">
                                            <option value="admin" @if($item->role == 'admin') selected @endif>Admin</option>
                                            <option value="user" @if($item->role == 'user') selected @endif>User</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="{{route('admin#userDelete',$item->id)}}" class="me-2">
                                            <button class="btn btn-light">
                                                <i class="bi bi-trash3-fill text-danger"></i>
                                            </button>

                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="my-2">
                        {{$userList->appends(request()->query())->links()}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function(){
            $('.roleChange').change(function(){
                $roleChange = $(this).val();
                $parentNode = $(this).parents('tr');
                $userId = $parentNode.find('.userId').html();
                console.log($userId);

                $.ajax({
                        type : 'get',
                        url : '/adminUser/ajax/changeRole',
                        data : {
                            'userId': $userId,
                            'role' : $roleChange
                        },
                        dataType : 'json',
                })
                location.reload();

            })
        })
    </script>
@endsection

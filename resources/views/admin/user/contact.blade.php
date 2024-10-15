@extends('admin.layouts.master')
@section('title', 'Customer Contact')

@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <h4 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="pr-3">Customer Contact</span></h4>
                  <div class="table-responsive table-responsive-data2">

                    <table class="table table-data2">

                        <tbody id="datalist">
                            @foreach ($contact as $item)
                               <tr class="mt-3">
                                <td></td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td class="col-4">{{$item->message}}</td>
                                <td><span class="text-danger fs-5 me-2"><i class="bi bi-alarm"></i></span>{{$item->created_at->format('d-M-y H:i A')}}</td>

                               </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="my-2">
                        {{-- {{$userList->appends(request()->query())->links()}} --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

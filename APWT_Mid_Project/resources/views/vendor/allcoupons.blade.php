@extends('layouts.main')
@section('title')
    Coupons
@endsection
@section('content')
    <h1 align="center">All Coupon</h1>
        <center>
        <h3 style="color: red;">{{Session::get('msg')}}</h3>
                <table border="2" style="width: 70%;">
                {{@csrf_field()}}
                    <tr>
                        <th>Coupon Id</th>
                        <th>Coupon Code</th>
                        <th>Discount Amount</th>
                        <th>Option</th>
                        <th>Assign Coupon</th>
                    </tr>
                    @foreach ($coupons as $c)
                    <tr align="center">
                        <td>{{$c->id}}</td>
                        <td>{{$c->code}}</td>
                        <td>{{$c->amount}} Taka</td>
                        <td><a href="{{route('vendor.editcoupon',['id'=>$c->id])}}">Edit</a> <a href="{{route('vendor.deletecoupon',['id'=>$c->id])}}">Delete</a></td>
                        <td>
                            <br>
                            <form align="center" action="{{route('vendor.assigncoupon')}}" method="POST">
                                {{@csrf_field()}}
                                    <input type="search" name="id" id="id" placeholder=" Enter Customer Id">
                                    <input type="hidden" name="co_id" id="co_id" value="{{$c->id}}">
                                    <input type="submit" name="assign" value="Assign">
                                    <br>@error('id')
                                            {{$message}}
                                        @enderror<br>
                            </form>
                        </td>
                        </tr>
                        
                    @endforeach
                </table>
    </center>
@endsection
@extends('layouts.main')
@section('title')
    Coupons
@endsection
@section('content')
<div>
        <center>
            <table>
                <tr>
                    <td>
                        <a href="{{route('admin.aapprovecoupon')}}" style="font-size: 20px;">Approve Coupon</a> |
                        <a href="{{route('admin.acoupons')}}" style="font-size: 20px;">Coupons List</a> |
                        <a href="{{route('admin.addcoupon')}}" style="font-size: 20px;">Add Coupon</a>
                    </td>
                </tr>
            </table>
        </center>
    </div>
    <h1 align="center">Coupon List</h1>
        <center>
        <h3 style="color: red;">{{Session::get('msg')}}</h3>
                <table border="2" style="width: 70%;">
                {{@csrf_field()}}
                    <tr>
                        <th>Coupon Id</th>
                        <th>Coupon Code</th>
                        <th>Discount Amount</th>
                        <th>Action</th>
                        <th>Assign Coupon</th>
                    </tr>
                    @foreach ($coupons as $c)
                    <tr align="center">
                        <td>{{$c->id}}</td>
                        <td>{{$c->code}}</td>
                        <td>{{$c->amount}} Taka</td>
                        <td><a href="{{route('admin.aeditcoupon',['id'=>$c->id])}}"><input type="button" value="Edit"></a>
                        <a href="{{route('admin.adeletecoupon',['id'=>$c->id])}}"><input type="button" value="Delete"></a></td>
                        <td>
                            <br>
                            <form align="center" action="{{route('admin.aassigncoupon')}}" method="POST">
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
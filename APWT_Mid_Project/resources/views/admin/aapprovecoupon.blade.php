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
                <table border="2" style="width: 50%;">
                {{@csrf_field()}}
                    <tr>
                        <th>Coupon Id</th>
                        <th>Coupon Code</th>
                        <th>Discount Amount</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($c as $coupons)
                    <tr align="center">
                        <td>{{$coupons->id}}</td>
                        <td>{{$coupons->code}}</td>
                        <td>{{$coupons->amount}} Taka</td>
                        <td><a href="{{route('admin.acouponapprove',['id'=>$coupons->id])}}"><input type="button" value="Approve"></a>
                        <a href="{{route('admin.acancelcoupon',['id'=>$coupons->id])}}"><input type="button" value="Delete"></a></td>
                        </tr>
                        
                    @endforeach
                </table>
    </center>
@endsection
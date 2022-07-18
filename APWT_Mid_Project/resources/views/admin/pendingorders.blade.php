@extends('layouts.main')
@section('title')
Delivered Order List
@endsection
@section('content')
<div>
        <center>
            <table>
                <tr>
                    <td>
                        <a href="{{route('admin.deliveredorders')}}" style="font-size: 20px;">Delivered Orders</a> |
                        <a href="{{route('admin.pendingorders')}}" style="font-size: 20px;">Pending Orders</a>
                    </td>
                </tr>
            </table>
        </center>
</div>
<h1 align="center">Pending Order List</h1>
<!-- <h3 align="center" style="color: red;">{{Session::get('msg')}}</h3> -->
<div class="main-section">
    <center>

    <table border="1" style="width: 100%;">
                {{@csrf_field()}}
                @foreach ($customers as $customer)
                    <tr align="center">
                        <th colspan='2'>Customer Name: </th>
                        <td colspan='5'>{{$customer->name}}</td>
                        <th>Customer ID: </th>
                        <td>{{$customer->id}}</td>
                    <tr align="center">
                        <th colspan='2'>Phone Number: </th>
                        <td>+880{{$customer->phone}}</td>
                    <tr align="center">
                        <th colspan='2'>Customer Address: </th>
                        <td colspan='8'>{{$customer->address}}</td>
                    </tr>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Total Quantity</th>
                        <th>Price</th>
                        <th>Purchase Quantity</th>
                        <th>Purchase Price</th>
                        <th>Order Status</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                    </tr>
                    <?php
                        $order=$customer->orders;
                    ?>

                    @foreach ($order as $o)
                    @if($o->status=='Pending')
                    <tr align="center">
                        <td>{{$o->product->id}}</td>
                        <td>{{$o->product->name}}</td>
                        <td>{{$o->product->stock}}</td>
                        <td>{{$o->product->price}}</td>
                        <td>{{$o->quantity}}</td>
                        <td>{{$o->product->price*$o->quantity}}</td>
                        <td>{{$o->status}}</td>
                        <td>{{$o->payment_method}}</td>
                        <td>{{$o->payment_status}}</td>
                    </tr>
                    @endif
                    @endforeach
                @endforeach
                     
                </table>
    </center>
<br><br>
</div>
@endsection
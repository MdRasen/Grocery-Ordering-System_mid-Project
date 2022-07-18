@extends('layouts.main')
@section('title')
Customer Cart
@endsection
@section('content')
<h1 align="center">Customer Cart</h1>

<div class="main-section">
    <center>

        <h3 style="color: red;">{{Session::get('Msg')}}</h3>

        <table border="2px" style="width: 80%; border-collapse: collapse;">
            <tr>
                <th colspan="7">-- Products In Cart --</th>
            </tr>
            <tr>
                {{-- <th>Product ID</th> --}}
                <th>Product</th>
                <th>Product Name</th>
                <th>Product Category</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>

            @foreach ($carts as $item) 
            <tr>
                {{-- <td style="text-align: center;">{{$item->id}}</td> --}}
                <td style="text-align: center;"><img src="{{asset('storage/product_images')}}/{{$item->product->thumbnail}}" alt="Product Image" height="50px" width="50px"></td>
                <td style="text-align: center;">{{$item->product->name}}</td>
                <td style="text-align: center;">{{$item->product->category}}</td>
                <td style="text-align: center;">{{$item->product->price}}</td>
                <td style="text-align: center;">{{$item->quantity}}</td>
                <td style="text-align: center;">{{$item->product->price * $item->quantity}}</td>
                <td style="text-align: center;"><a href="{{route('customer.cartproductremove',['p_id'=>$item->product->id])}}">Remove Product</a></td>
            </tr>
            @endforeach

            <tr>
                <th colspan="7" style="padding: 5px;"><a href="{{route('customer.cdashboard')}}">Browse More</a> | <a href="{{route('customer.corder')}}">Continue To Order</a></th>
            </tr>
        </table>
    </center>

</div>
@endsection

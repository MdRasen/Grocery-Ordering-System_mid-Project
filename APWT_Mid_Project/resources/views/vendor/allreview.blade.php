@extends('layouts.main')
@section('title')
    Rewiews
@endsection
@section('content')
<br><br>
<form align="center" action="{{route('vendor.searchreview')}}" method="POST">
        {{@csrf_field()}}
            <input type="search" name="id" id="id" placeholder="Search using Product Id">
                @error('id')
                    {{$message}}
                @enderror
            <input type="submit" name="search" value="Search">
    </form>
<h1 align="center">All Rewiew</h1>
    <h3 align="center" style="color: red;">{{Session::get('msg')}}</h3>
<table border="1" style="width: 100%;">
    <tr>
        <td style="width: 30%;">
            <center>
                <img style="width: 40%;" src="{{asset('storage/product_images')}}/{{$product->thumbnail}}" alt="Product Thumbnail">
            <center>
        </td>
        <td style="width: 70%; padding: 20px;">
            <table border="1">
                <tr><th>Product id: </th><td>{{$product->id}}</td></tr>
                <tr><th>Product Name: </th><td>{{$product->name}}</td></tr>
                <tr><th>Product Description: </th><td>{{$product->description}}</td></tr>
            </table>
                        
        </td>
    </tr>
    @foreach ($product->reviews as $r)
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr><th>Customer Name: </th><td>{{$r->customer->name}}</td></tr>
    <tr><th>Delivery Date: </th><td>{{$r->created_at}}</td></tr>
    <tr><th>Review Date: </th><td>{{$r->updated_at}}</td></tr>
    <tr><th>Review: </th><td>{{$r->message}}</td></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr></tr>
    @endforeach
</table>
<br><br>
   
@endsection
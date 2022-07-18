@extends('layouts.main')
@section('title')
    Delete Product
@endsection
@section('content')
    <h1 align="center">Delete Product</h1>
<div class="container">
    <table border="2" style="width: 100%;">
    <tr>
        <td>
        <table border="2" style="width: 100%;">
        <tr><th>Product Picture</th></tr>
        <tr><td align="center"><img src="{{asset('storage/product_images')}}/{{$product->thumbnail}}" alt="Product Image" height="120px" width="120px"></td></tr>
        </table>
        </td>
        <td>
        <table border="2" style="width: 100%;">
        <tr>
            <th>Product Id</th>
            <td>{{$product->id}}</td>
        </tr>
        <tr>
            <th>Product Name</th>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <th>Product Category</th>
            <td>{{$product->category}}</td>
        </tr>
        <tr>
            <th>Product Price</th>
            <td>{{$product->price}}</td>
        </tr>
        <tr>
            <th>Product Stock</th>
            <td>{{$product->stock}}</td>
        </tr>
        <tr>
            <th>Product Size</th>
            <td>{{$product->size}}</td>
        </tr>
        <tr>
            <th>Product Description</th>
            <td>{{$product->description}}</td>
        </tr>
        <tr>
            <th colspan="2"><a href="{{route('vendor.deleteproductConfirm',['id'=>$product->id])}}"><input type="button" value="Delete"></a></tH>
        </tr>
    </table>
</td>
</tr>
</table>
</div>
@endsection
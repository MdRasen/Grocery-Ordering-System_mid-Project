@extends('layouts.main')
@section('title')
    dashboard
@endsection
@section('content')
<br>
    <form align="center" action="{{route('vendor.searchproduct')}}" method="POST">
        {{@csrf_field()}}
            <input type="search" name="search_name" id="search_name" placeholder="Search here">
                @error('search_name')
                    {{$message}}
                @enderror
            <input type="submit" name="search" value="Search">
    </form>
    <h1 align="center">All Product</h1> 
    <h3 align="center" style="color: red;">{{Session::get('msg')}}</h3>
<div class="container">
{{@csrf_field()}}
    @foreach ($p as $product)
    <table border="2" style="width: 100%;">
    <tr>
        <td>
        <table border="1" style="width: 100%;">
        <tr><th colspan="3">Product Picture</th></tr>
        <tr><td colspan="2" align="center"><img src="{{asset('storage/product_images')}}/{{$product->thumbnail}}" alt="Product Image" height="120px" width="120px"></td></tr>
        <tr>
            <td align="center"><a href="{{route('vendor.editproduct',['id'=>$product->id])}}"><input type="button" value="Edit Product"></a></td>
            <td align="center"><a href="{{route('vendor.deleteproduct',['id'=>$product->id])}}"><input type="button" value="Delete Product"></a></td>
        </tr>
        </table>
        </td>
            <td>
            <form action="" method="POST">
                <table border="1" style="width: 100%;">
                    <tr>
                        <th>Product Name:</th>
                        <td><input value="{{$product->name}}"disabled></td>
                    </tr>
                    <tr>
                        <th>Product Id:</th>
                        <td><input value="{{$product->id}}" disabled></td>
                    </tr>
                    <tr>
                        <th>Product Category:</th>
                        <td><input value="{{$product->category}}"disabled></td>
                    </tr>
                    <tr>
                        <th>Product Price:</th>
                        <td><input value="{{$product->price}}"disabled></td>
                    </tr> 
                    <tr>
                        <th>Product Stock:</th>
                        <td><input value="{{$product->stock}}"disabled></td>
                    </tr> 
                    <tr>
                        <th>Product Size:</th>
                        <td><input  value="{{$product->size}}"disabled></td>
                    </tr>   
                    <tr>
                        <th>Product Description:</th>
                        <td><input value="{{$product->description}}"disabled></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    @endforeach
</div>
<div align="center">
{{$p->links()}}
</div>
@endsection
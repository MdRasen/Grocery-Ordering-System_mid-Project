@extends('layouts.main')
@section('title')
    Products
@endsection
@section('content')
<div>
        <center>
            <table>
                <tr>
                    <td>
                        <a href="{{route('admin.aproducts')}}" style="font-size: 20px;">Products List</a> |
                        <a href="{{route('admin.aaddproduct')}}" style="font-size: 20px;">Add Product</a>
                    </td>
                </tr>
            </table>
        </center>
    </div>
    <h1 align="center">Products</h1>
    <form align="center" action="{{route('public.searchproduct')}}" method="POST">
        {{@csrf_field()}}
            <input type="search" name="search_name" id="search_name" placeholder="Search here">
                @error('search_name')
                    {{$message}}
                @enderror
            <input type="submit" name="search" value="Search">
    </form>
    <h3 align="center" style="color: red;">{{Session::get('msg')}}</h3>   
    <div>
    <center>
        <table border="2px" style="width: 80%; ">
            <tr>
                <th colspan="10">-- Products Details --</th>
            </tr>
            <tr>
                <th>Product Id</th>
                <th>Product Picture</th>
                <th>Product Name</th>
                <th>Product Category</th>
                <th>Product Price</th>
                <th>Product Stock</th>
                <th>Product Size</th>
                <th>Product Description:</th>
                <th colspan="2">Action</th>
            </tr>
            @foreach ($products as $product)
            <tr>
                <td style="text-align: center;">{{$product->id}}</td>
                <td style="text-align: center;"><img src="{{asset('storage/product_images')}}/{{$product->thumbnail}}" alt="Product Image" height="120px" width="120px"></td>
                <td style="text-align: center;">{{$product->name}}</td>
                <td style="text-align: center;">{{$product->category}}</td>
                <td style="text-align: center;">{{$product->price}}</td>
                <td style="text-align: center;">{{$product->stock}}</td>
                <td style="text-align: center;">{{$product->size}}</td>
                <td style="text-align: center;">{{$product->description}}</td>
                <td style="text-align: center;"><a href="{{route('vendor.editproduct',['id'=>$product->id])}}">
                    <input type="button" value="Edit Product"></a>  <a href="{{route('vendor.deleteproduct',['id'=>$product->id])}}">
                        <input type="button" value="Delete Product"></a></td>
            </tr>
            @endforeach
            <tr>
                <th align="center" colspan="9" style="padding: 5px;">{{$products->links()}}</th>
            </tr>
        </table>
    </center>
</div>

@endsection
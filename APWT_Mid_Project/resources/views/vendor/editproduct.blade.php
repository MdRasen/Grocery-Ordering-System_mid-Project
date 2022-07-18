@extends('layouts.main')
@section('title')
    Edit Product
@endsection
@section('content')
    <h1 align="center">Edit Product</h1> 
    <h3 align="center" style="color: red;">{{Session::get('msg')}}</h3>
<div class="container">

    <table style="width: 100%;">
    <tr>
        <td style="width: 35%;">
        <table align="center" border="1" style="width: 100%;">
        <tr><th colspan="2">Product Picture</th></tr>
        <tr><td align="center"style="width: 100%;"><img src="{{asset('storage/product_images')}}/{{$product->thumbnail}}" alt="Product Image" height="120px" width="120px"></td>
            <td><form action="{{route('vendor.productpicupload')}}" method="POST" enctype="multipart/form-data">
            {{@csrf_field()}}<br>
                    <label for="thumbnail"><b>&ensp;Select Thumbnail: </b></label>
                    <input type="file" name="thumbnail"> <br> @error('pic'){{$message}}<br>@enderror 
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <input align="center" type="submit" name="submit" value="Upload">
                </form>
            </td>
        </table>
        </td>
        <td style="width: 65%;">
            <form action="" method="POST">
            {{@csrf_field()}}
                <table align="center" border="1" style="width:100%;">
                    <tr>
                        <th><label for="name">Product Name:</label></th>
                        <td><input type="text" id='name' name="name" placeholder="Write Product Name" value="{{$product->name}}">
                        @error('name'){{$message}}@enderror</td>
                    </tr>
                    <tr>
                        <th><label for="id">Product Id:</label></th>
                        <td><input type="number" id='id' name="id" placeholder="Write Product id" value="{{$product->id}}" disabled></td>
                    </tr>
                    <tr>
                        <th><label for="category">Product Category:</label></th>
                        <td>
                            <select name="category">
                                <option value="Fruits & Vegetables">Fruits & Vegetables</option>
                                <option value="Meat & Fish">Meat & Fish</option>
                                <option value="Cooking">Cooking</option>
                                <option value="Baking">Baking</option>
                                <option value="Dairy">Dairy</option>
                                <option value="Candy & Chocolate">Candy & Chocolate</option>
                                <option value="Frozen & Canned">Frozen & Canned</option>
                                <option value="Snacks">Snacks</option>
                                <option value="Beverages">Beverages</option>
                                <option value="Others">Others</option>
                                <option value="{{$product->category}}" selected >{{$product->category}}</option>
                            </select>
                        @error('category'){{$message}}@enderror</td>
                    </tr>
                    <tr>
                        <th><label for="price">Product Price:</label></th>
                        <td><input type="number" id='price' name="price" placeholder="Write Product Price" value="{{$product->price}}">
                        @error('price'){{$message}}@enderror</td>
                    </tr> 
                    <tr>
                        <th><label for="stock">Product Stock:</label></th>
                        <td><input type="number" id='stock' name="stock" placeholder="Write Product Stock" value="{{$product->stock}}">
                        @error('stock'){{$message}}@enderror</td>
                    </tr> 
                    <tr>
                        <th><label for="size">Product Size:</label></th>
                        <td><input type="number" id='size' name="size" placeholder="Write Product Size" value="{{$product->size}}">
                        @error('size'){{$message}}@enderror</td>
                    </tr>   
                    <tr>
                        <th><label for="description">Product Description:</label></th>
                        <td><input type="textarea" id='description' name="description" placeholder="Write Product Description" value="{{$product->description}}">
                        @error('description'){{$message}}@enderror</td>
                    </tr>
                    <tr>
                        <th colspan="2"><input type="submit"value="Update"></tH>
                    </tr>
                </table>
                </form>
            </td>
        </tr>
    </table>
</div>
@endsection
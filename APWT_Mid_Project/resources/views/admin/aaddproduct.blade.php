@extends('layouts.main')
@section('title')
    Add Product
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
    <h1 align="center">Add Product</h1>
    <center>
    <h3 style="color: red;">{{Session::get('msg')}}</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <table border="2" style="width: 30%;">
                {{@csrf_field()}}
                    <tr>
                        <th><label for="name">Product Name:</label></th>
                        <td><input type="text" id='name' name="name" placeholder="Write Product Name" value="{{old('name')}}">
                        @error('name'){{$message}}@enderror</td>
                    </tr>
                    <tr>
                        <th><label for="category">Product Category:</label></th>
                        <td>
                            <select name="category" >
                                <option value="Fruits & Vegetables">Fruits & Vegetables</option>
                                <option value="Meat & Fish">Meat & Fish</option>
                                <option value="Cooking">Cooking</option>
                                <option value="Baking">Baking</option>
                                <option value="Dairy">Dairy</option>
                                <option value="Candy & Chocolate">Candy & Chocolate</option>
                                <option value="Frozen & Canned">Frozen & Canned</option>
                                <option value="Snacks">Snacks</option>
                                <option value="Beverages">Beverages</option>
                                <option value="Others" selected >Others</option>
                            </select>
                        </td>
                    </tr>

                    {{-- <tr>
                        <th><label for="category">Product Category:</label></th>
                        <td><input type="text" id='category' name="category" placeholder="Write Product Category" value="{{old('category')}}">
                        @error('category'){{$message}}@enderror</td>
                    </tr> --}}

                    <tr>
                        <th><label for="p_thumbnail">Product Thumbnail:</label></th>
                        <td><input type="file" name="p_thumbnail">
                        @error('p_thumbnail'){{$message}}@enderror
                        </td>
                    </tr>
                    <tr>
                        <th><label for="price">Product Price:</label></th>
                        <td><input type="number" id='price' name="price" placeholder="Write Product Price" value="{{old('price')}}">
                        @error('price'){{$message}}@enderror</td>
                    </tr> 
                    <tr>
                        <th><label for="stock">Product Stock:</label></th>
                        <td><input type="number" id='stock' name="stock" placeholder="Write Product Stock" value="{{old('stock')}}">
                        @error('stock'){{$message}}@enderror</td>
                    </tr>  
                    <tr>
                        <th><label for="size">Product Size:</label></th>
                        <td><input type="number" id='size' name="size" placeholder="Write Product Size" value="{{old('size')}}">
                        @error('size'){{$message}}@enderror</td>
                    </tr>   
                    <tr>
                        <th><label for="description">Product Description:</label></th>
                        <td><input type="textarea" id='description' name="description" placeholder="Write Product Description" value="{{old('description')}}">
                        @error('description'){{$message}}@enderror</td>
                    </tr>
                    <tr>
                        <th colspan="3"><input type="submit"value="Add"></tH>
                    </tr>               
                </table>
            </form>  
    </center>
@endsection
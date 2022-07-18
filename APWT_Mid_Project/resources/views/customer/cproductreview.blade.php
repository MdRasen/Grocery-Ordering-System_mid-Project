@extends('layouts.main')
@section('title')
Customer Product Review
@endsection
@section('content')
<h1 align="center">Customer Product Review</h1>

<div class="main-section">
    <center>
        
        <h3 style="color: red;">{{Session::get('msg')}}</h3>

        <h3>-- Pending Reviews --</h3>

        <?php
        if(count($reviews) == 0){
    ?>
            <h3 style="color: red;"><?php echo "You do not have any Pending Reviews!" ?></h3>
    <?php
        }

        ?>

        @foreach ($reviews as $item)

        <form action="{{route('customer.creviewForm')}}" method="POST">
            {{@csrf_field()}}
            <table border="1px" style="width:40%; border-collapse: collapse;">

                <input type="hidden" name="r_id" value="{{$item->id}}" style="width: 100%">

                <tr>
                    <th>Product ID</th>
                    <th>
                        <input type="text" name="p_id" value="{{$item->product->id}}" style="width: 100%" disabled>
                    </th>
                </tr>

                <tr>
                    <th>Product Name</th>
                    <th>
                        <input type="text" name="p_name" value="{{$item->product->name}}" style="width: 100%" disabled>
                    </th>
                </tr>

                <tr>
                    <th>
                        <img src="{{asset('storage/product_images')}}/{{$item->product->thumbnail}}" alt="Product Image" height="120px" width="120px">
                    </th>
                    <th>
                        <textarea name="r_message" cols="20" rows="4" style="width: 100%" placeholder="Write Your Review Here">{{$item->message}}</textarea>
                        <br> @error('r_message')
                        {{$message}} <br> <br> 
                        @enderror
                    </th>
                </tr>

                <tr>
                    <th colspan="2"><input type="submit" name="update" value="Update" style="width: 100%"></th>
                </tr>
            
            </table>
        </form>
            
        @endforeach

        <h3>-- Previous Reviews --</h3>

        <?php
        if(count($previews) == 0){
    ?>
            <h3 style="color: red;"><?php echo "You do not have any Previous Reviews!" ?></h3>
    <?php
        }

        ?>
        @foreach ($previews as $item)

        <form action="{{route('customer.creviewForm')}}" method="POST">
            {{@csrf_field()}}
            <table border="1px" style="width:40%; border-collapse: collapse;">

                <input type="hidden" name="r_id" value="{{$item->id}}" style="width: 100%">

                <tr>
                    <th>Product ID</th>
                    <th>
                        <input type="text" name="p_id" value="{{$item->product->id}}" style="width: 100%" disabled>
                    </th>
                </tr>

                <tr>
                    <th>Product Name</th>
                    <th>
                        <input type="text" name="p_name" value="{{$item->product->name}}" style="width: 100%" disabled>
                    </th>
                </tr>

                <tr>
                    <th>
                        <img src="{{asset('storage/product_images')}}/{{$item->product->thumbnail}}" alt="Product Image" height="120px" width="120px">
                    </th>
                    <th>
                        <textarea name="r_message" cols="20" rows="4" style="width: 100%" placeholder="Write Your Review Here">{{$item->message}}</textarea>
                        <br> @error('r_message')
                        {{$message}} <br> <br> 
                        @enderror
                    </th>
                </tr>

                <tr>
                    <th colspan="2"><input type="submit" name="update" value="Update" style="width: 100%"></th>
                </tr>
            
            </table>
        </form>
            
        @endforeach
    </center>

</div>
@endsection

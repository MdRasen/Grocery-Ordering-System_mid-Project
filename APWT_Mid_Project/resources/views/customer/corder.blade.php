@extends('layouts.main')
@section('title')
Customer Order
@endsection
@section('content')
<h1 align="center">Customer Order</h1>

<div class="main-section">
    <center>

        <h3 style="color: red;">{{Session::get('Msg')}}</h3>
        
        <form action="{{route('customer.corderForm');}}" method="POST">
            {{@csrf_field()}}

            <table style="width: 80%; margin:5px; border: 1px solid black; border-collapse: collapse;">
                @foreach ($products as $item) 
                <tr>
                    <th>Product ID:</th>
                    <td><input type="number" name="p_id" id="p_id" value="{{$item->id}}" style="width: 30px;" disabled></td>
                    <th></th>
                    <td style="text-align: center; width: 150px;"><img src="{{asset('storage/product_images')}}/{{$item->product->thumbnail}}" alt="Product Image" height="50px" width="50px"></td>
                    <th>Product Name:</th>
                    <td><input type="text" name="p_name" value="{{$item->product->name}}" disabled></td>
                    <th>Price:</th>
                    <td><input type="number" name="p_price" value="{{$item->product->price}}" style="width: 50px;" disabled> Taka</td>
                    <th>Quantity:</th>
                    <td><input type="number" name="p_qunatity" value="{{$item->quantity}}" style="width: 30px;"  disabled></td>
                    <th>Total Price:</th>
                    <td><input type="number" name="p_price" value="{{$item->quantity*$item->product->price}}" style="width: 50px;" disabled> Taka</td>
                </tr>
                @endforeach

                <tr>
                    <th colspan="8"></th>
                    <td colspan="3" style="padding-top: 5px;"><b>+ Delivery charge:</b> 80 Taka</td>
                </tr>

                <tr>
                    <th colspan="7"></th>
                    <th style="padding-top: 5px;">Coupon:</th>
                    <td colspan="3" style="padding-top: 5px;"><input type="text" name="coupon" placeholder="Enter coupon code" value="{{old('coupon')}}"> <br>
                        @error('coupon'){{$message}}@enderror
                    </td>
                    
                </tr>

                <tr>
                    <th colspan="7"></th>
                    <th style="padding-top: 5px;">Payment Option:</th>
                    <td colspan="3" style="padding-top: 5px;">
                        <select name="payment_option" id="payment_option">
                            <option value="Cash On Delivery">Cash On Delivery</option>
                            <option value="Bkash/Nagad">Bkash/Nagad</option>
                        </select> <br>
                        @error('payment_option'){{$message}}@enderror
                    </td>
                </tr>

                <tr>
                    <th colspan="7"></th>
                    <th style="padding-top: 5px;">Delivery Address:</th>
                    <td colspan="3" style="padding-top: 5px;">
                        <textarea name="delivery_address" placeholder="Write Delivery Address" cols="22" rows="4" value="{{old('delivery_address')}}">{{$customer->address}}</textarea>
                        <br>
                        @error('delivery_address'){{$message}}@enderror
                    </td>
                </tr>

                <tr>
                    <th colspan="9" style="text-align: end; padding: 8px;"><input type="submit" value="Place Order"></th>
                </tr>
            
            </table>
        </form>
    </center>

</div>
@endsection

@extends('layouts.main')
@section('title')
    All Orders
@endsection
@section('content')
<br><br>
<form align="center" action="{{route('vendor.searchorder')}}" method="POST">
        {{@csrf_field()}}
            <input type="search" name="id" id="id" placeholder="Search using Customer Id">
                @error('id')
                    {{$message}}
                @enderror
            <input type="submit" name="search" value="Search">
    </form>
        <center>
        <h3 style="color: red;">{{Session::get('msg')}}</h3>
        <!-- Not Delivered -->
            <h1 align="center">Pending Orders</h1>
            <?php 
            $nodelivery=0;
            foreach ($customers as $customer){
            $state='';
            if(count($customer->products)!=0){
                foreach ($customer->orders as $o){
                    if($o->status!='Delivered'){$state='Not Delivered';}
                }
                if($state=='Not Delivered'){
                    $order_status=0;
                    $total_price=0; 
                    $discount_amount=0; 
                    $delevery_status=0;
                    $pay_money=0;
                    $coupon=0;
            ?>  
                <table border="1" style="width: 100%;">
                {{@csrf_field()}}
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
                    foreach ($customer->orders as $o){
                        if($o->status!='Delivered'){
                           $nodelivery=1;
                    ?>   
                    <tr align="center">
                        <td>{{$o->product->id}}</td>
                        <td>{{$o->product->name}}</td>
                        <td>{{$o->product->stock}}</td>
                        <td>{{$o->product->price}}</td>
                        <td>{{$o->quantity}}</td>
                        <td>{{$o->product->price*$o->quantity}}</td>
                        <?php
                            if($o->coupon==NUll){}
                            else{
                                $coupon=$o->coupon->amount;
                            }
                            
                        ?>
                        <td>{{$o->status}}
                            @if($o->status=='Pending')
                                <a href="{{route('vendor.changeorderstatus',['id'=>$o->id])}}">Change</a> 
                            @endif
                        </td>
                        <td>{{$o->payment_method}}</td>
                        <td>{{$o->payment_status}}
                            @if($o->status=='Confirmed' && $o->payment_status!='Confirmed')
                                <a href="{{route('vendor.changepaymentstatus',['id'=>$o->id])}}">Change</a> 
                            @endif
                        </td>
                    </tr>   
                    <?php
                        if($o->status=='Confirmed' && $o->payment_status=='Confirmed'){$order_status=1;}
                        else{$order_status=0;}
                        $total_price = $total_price + ($o->quantity * $o->product->price);
                        if($o->coupon!=null){$discount_amount=$coupon;}                        
                        $pay_money = $total_price + 60 - $discount_amount;
                        }
                    }
                    ?>  
                     <tr>
                <th colspan="4">Total Price:</th>
                <th colspan="5">{{$total_price}} Taka</td>
            </tr>
            <tr>
                <th colspan="4">Delivery Charge:</th>
                <th colspan="5"> 60 Taka</th>
            </tr>

            <tr>
                <th colspan="4">Coupon Discount:</th>
                <th colspan="5">{{$discount_amount}} Taka</th>
            </tr>

            <tr>
                <th colspan="4">Delevery:
                    @if($order_status==1)
                        Pending <a href="{{route('vendor.orderstatus',['id'=>$customer->id])}}">Change</a>        
                    @else
                        Pending
                    @endif
                </th>
                <th colspan="5">Total Payment: {{$pay_money}} Taka</th>
            </tr>
                </table><br><br>
                <?php
                        }
                    }
                }
                ?> 
            @if($nodelivery == 0)
                <h3 style="color: red;"><?php echo "No Pending Orders" ?></h3>
            @endif
            <!-- Delivered -->
            <h1 align="center">Delivered Orders</h1>
            <?php 
            $nodelivery=0;
            foreach ($customers as $customer){
            $state='';
            if(count($customer->products)!=0){
                foreach ($customer->orders as $o){
                    if($o->status=='Delivered'){$state='Delivered';}
                }
                if($state=='Delivered'){
            ?>  
                <table border="1" style="width: 100%;">
                {{@csrf_field()}}
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
                    foreach ($customer->orders as $o){
                        $p=$o->product;
                        if($o->status=='Delivered'){
                            $nodelivery=1;
                    ?>   
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
                    <?php
                    }
                    }
                    ?>  
                     
                </table><br><br>
                <?php
                        }
                    }
                }
                ?> 
            @if($nodelivery == 0)
                <h3 style="color: red;"><?php echo "No Delivery Orders" ?></h3>
            @endif
            
    </center>
@endsection
<?php

$total_price = 0;
$discount_amount = 0;

foreach($orders as $item){
    $total_price = $total_price + ($item->quantity * $item->product->price);
}
if($coupon!=null){
    $discount_amount=$coupon->amount;
}
$pay_money = $total_price + 60 - $discount_amount;

?>

<div class="main-section">
    <center>

        <h3>Hi! {{$username}}</h3>
        <h4>Your order has been received and is being processed!</h4>

        <table border="2px" style="width: 90%; border-collapse: collapse;">
            <tr>
                <th colspan="8">-- Customer Order List --</th>
            </tr>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price (Tk)</th>
                <th>Total Price (Tk)</th>
                <th>Order Status</th>

            </tr>

            @foreach ($orders as $item) 
            @if($item->status!='Delivered')
            <tr>
                <td style="text-align: center;">{{$item->id}}</td>
                <td style="text-align: center;">{{$item->product->name}}</td>
                <td style="text-align: center;">{{$item->quantity}}</td>
                <td style="text-align: center;">{{$item->product->price}}</td>
                <td style="text-align: center;">{{$item->quantity * $item->product->price}}</td>
                <td style="text-align: center;">{{$item->status}}</td>
            </tr>
            @endif
            @endforeach

            <tr>
                <th colspan="4">Total Price:</th>
                <th colspan="4"><?php echo $total_price; ?> Taka</td>
            </tr>
            <tr>
                <th colspan="4">Delivery Charge:</th>
                <th colspan="4"> 60 Taka</th>
            </tr>

            <tr>
                <th colspan="4">Coupon Discount:</th>
                <th colspan="4"><?php echo $discount_amount; ?> Taka</th>
            </tr>

            <tr>
                <th colspan="8">Money To Pay: <?php echo $pay_money; ?> Taka</th>
            </tr>
        </table>

        <br> <br>

        <table border="2px" style="width: 90%; border-collapse: collapse;">
            <tr>
                <th colspan="8">-- Delivery Details --</th>
            </tr>
            <tr>
                <td colspan="8" style="text-align: center;"><b>Delivery Date:</b> Within 3-5 Days | <b>DeliveryMan:</b> <a href="#">{{$item->d_id}}</a></td>
            </tr>
        </table>

        <h4>Thank You! <br>- Grocery OS</h4>
    </center>

</div>

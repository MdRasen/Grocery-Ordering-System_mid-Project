@extends('layouts.main')
@section('title')
Customer Coupons
@endsection
@section('content')
<h1 align="center">Customer Coupons</h1>

<div class="main-section">
    <center>

        <table border="2px" style="width: 70%; border-collapse: collapse;">
            <tr>
                <th colspan="8">-- Customer Coupon List --</th>
            </tr>
            <tr>
                <th>Coupon ID</th>
                <th>Coupon Code</th>
                <th>Discount Amount (Tk)</th>
            </tr>

            @foreach ($coupons as $item) 
            <tr>
                <td style="text-align: center;">{{$item->coupon->id}}</td>
                <td style="text-align: center;">{{$item->coupon->code}}</td>
                <td style="text-align: center;">{{$item->coupon->amount}}</td>
            </tr>
            @endforeach
        </table>

        <?php
            if(count($coupons) == 0){
        ?>
                <h3 style="color: red;"><?php echo "You do not have any Coupons!" ?></h3>
        <?php
            }

            ?>
            
    </center>

</div>
@endsection

@extends('layouts.main')
@section('title')
View Order Details
@endsection
@section('content')
<h1 align="center">View Order Details</h1>
<div class="main-section">
    <center>

            <table style="padding: 10px; margin:15px; border: 1px solid black; border-collapse: collapse;">
                <tr>
                    <th align="left" style="padding: 10px;"><sup>Order Date & Time</sup></th>
                    <td style="padding: 10px;"><sup>: {{$orders->updated_at}}</sup></td>
                </tr>
                <tr>
                    <th align="left" style="padding: 10px;">Order ID</th>
                    <td style="padding: 10px;">: {{$orders->id}}</td>
                </tr>
                <tr>
                    <th align="left" style="padding: 10px;">Customer Name</th>
                    <td style="padding: 10px;">: {{$orders->customer->name}}</td>
                    <th align="left" style="padding: 10px;">Phone Number</th>
                    <td style="padding: 10px;">: +88-0{{$orders->customer->phone}}</td>
                </tr>
                <tr>
                    <th align="left" style="padding: 10px;">Address</th>
                    <td style="padding: 10px;">: {{$orders->customer->address}}</td>
                </tr>
                <tr>
                    <td colspan="4">
                    <table border="2px" style="width: 100%; border: 1px solid black; border-collapse: collapse;">
                    <tr>
                        <th style="padding: 10px;">Product ID</th>
                        <th style="padding: 10px;">Product Name</th>
                        <th style="padding: 10px;">Total Quantity</th>
                        <th style="padding: 10px;">Price</th>
                        <th style="padding: 10px;">Purchase Quantity</th>
                        <th style="padding: 10px;">Purchase Price</th>
                        <th style="padding: 10px;">Order Status</th>
                        <th style="padding: 10px;">Payment Method</th>
                        <th style="padding: 10px;">Payment Status</th>
                    </tr>
                    
                    </table>
                <!-- </td>
                </tr>
                <tr>
                </tr>
                <tr>

                </tr> -->
            </table>
    </center>
</div>
@endsection

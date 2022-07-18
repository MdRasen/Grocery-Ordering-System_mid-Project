@extends('layouts.main')
@section('title')
Delivered Order List
@endsection
@section('content')
<div>
        <center>
            <table>
                <tr>
                    <td>
                        <a href="{{route('admin.adeliveredorders')}}" style="font-size: 20px;">Delivered Orders</a> |
                        <a href="#" style="font-size: 20px;">Pending Orders</a>
                    </td>
                </tr>
            </table>
        </center>
</div>
<h1 align="center">Delivered Order List</h1>
<!-- <h3 align="center" style="color: red;">{{Session::get('msg')}}</h3> -->
<div class="main-section">
    <center>

            <table border="2px" style="width: 60%; margin:15px; border: 1px solid black; border-collapse: collapse;">
                <tr>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Phone Number</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                </tr>
                @foreach ($orders as $o)
                <tr align="center">
                    <td><a href="{{route('admin.adeliveredorderdetails',['id'=>$o->c_id])}}" style="font-size: 15px;">{{$o->c_id}}</a></td>
                    <td>{{$o->customer->name}}</td>
                    <td>+88-0{{$o->customer->phone}}</td>
                    <td>{{$o->payment_method}}</td>
                    <td>{{$o->payment_status}}</td>
                </tr>
                @endforeach
            </table>
    </center>

</div>
@endsection

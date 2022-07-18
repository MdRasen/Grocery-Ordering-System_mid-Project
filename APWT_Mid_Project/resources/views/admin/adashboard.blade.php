@extends('layouts.main')
@section('title')
    Welcome
@endsection
@section('content')
    <h1 align="center">Welcome</h1>
    <div>
            <table style="margin-left: 200px; margin-top: 100px">
                <tr>
                    <td>
                        <a href="{{route('admin.aviewcustomer')}}" style="font-size: 20px;">View Customers</a><br>
                        <a href="{{route('admin.aviewvendor')}}" style="font-size: 20px;">View Vendor Profile</a><br>
                        <a href="{{route('admin.aviewdeliveryman')}}" style="font-size: 20px;">View Deliverymen</a><br>
                        <a href="{{route('admin.aaprovedeliveryman')}}" style="font-size: 20px;">Approve Deliveryman</a><br>
                        <a href="{{route('admin.asendnotice')}}" style="font-size: 20px;">Send Notice</a><br>
                        <a href="{{route('admin.aviewallnotice')}}" style="font-size: 20px;">View Notice</a><br>
                        <a href="{{route('admin.adeliveredorders')}}" style="font-size: 20px;">Delivered Orders</a><br>
                    </td>
                </tr>
            </table>
    </div>
@endsection
@extends('layouts.main')
@section('title')
    Coupon
@endsection
@section('content')
    <h1 align="center">Create Coupon</h1>
    <center>
    <h3 style="color: red;">{{Session::get('msg')}}</h3>
             <form action="" method="POST">
                <table style="width: 30%;">
                {{@csrf_field()}}
                    <tr>
                        <th><label for="code">Coupon id:</label></th>
                        <td><input type="text" id='code' name="code" placeholder="Generate Coupon Code" value="{{$c->id}}" disabled></td>
                    </tr>
                    <tr>
                        <th><label for="code">Coupon Code:</label></th>
                        <td><input type="text" id='code' name="code" placeholder="Generate Coupon Code" value="{{$c->code}}"></td>
                    </tr>
                    <tr>
                        <th><label for="amount">Discount Amount:</label></th>
                        <td><input type="number" id='amount' name="amount" placeholder="Enter Discount Amount" value="{{$c->amount}}"></td>
                    </tr>
                    <tr>
                        <th colspan="2"><input type="submit"value="Update"></tH>
                    </tr>               
                </table>
            </form>
    </center>
@endsection
@extends('layouts.main')
@section('title')
    Coupon
@endsection
@section('content')
    <h1 align="center">Create Coupon</h1>
    <center>
    <h3 style="color: red;">{{Session::get('msg')}}</h3>
            <form action="" method="POST">
                <table style="width: 50%;">
                {{@csrf_field()}}
                    <tr>
                        <th><label for="codetype">Code Generation:</label></th>
                        <td>
                            <input type="radio" id="auto" name="codetype" value="auto"><label for="auto">Auto</label>
                            <input type="radio" id="manual" name="codetype" value="manual"><label for="manual">Manual</label>
                            @error('codetype'){{$message}}@enderror 
                        </td>
                    </tr>
                    <tr>
                        <th><label for="code">Coupon Code / Size:</label></th>
                        <td><input type="text" id='code' name="code" placeholder="Generate Coupon Code" value="{{old('code')}}">
                            @error('code'){{$message}}@enderror 
                        </td>
                    </tr>
                    <tr>
                        <th><label for="amount">Discount Amount:</label></th>
                        <td><input type="number" id='amount' name="amount" placeholder="Enter Discount Amount" value="{{old('amount')}}">
                            @error('amount'){{$message}}@enderror 
                        </td>
                    </tr>
                    <tr>
                    <td><input type="hidden" id='v_id' name="v_id" value="{{Session::get('id')}}"> <td><input type="submit"value="Create"></td>
                    </tr>               
                </table>
            </form>  
    </center>
@endsection
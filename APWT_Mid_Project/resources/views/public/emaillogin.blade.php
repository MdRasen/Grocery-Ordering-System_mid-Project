@extends('layouts.main')
@section('title')
    Email Login
@endsection
@section('content')
<form method="post" action="" align="center">
<fieldset>
    <legend>Email Login</legend>
    <h1>{{Session::get('msg')}}</h1>
    {{@csrf_field()}}
    User Type:  <input type="radio" id="admin" name="user_type" value="Admin"><label for="admin">Admin</label>
                <input type="radio" id="vendor" name="user_type" value="Vendor"><label for="vendor">Vendor</label>
                 <input type="radio" id="customer" name="user_type" value="Customer"><label for="customer">Customer</label>
                <input type="radio" id="deliveryman" name="user_type" value="Deliveryman"><label for="deliveryman">Deliveryman</label> @error('user_type'){{$message}}@enderror<br><br>
    Email: <input type="text" name="email" placeholder="Write Your Email" value="{{old('email')}}"> @error('email'){{$message}}@enderror<br><br>
    <input type="submit" value="Login">
</fieldset>
</form> 
@endsection
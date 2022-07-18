@extends('layouts.main')
@section('title')
    Enter New Password
@endsection
@section('content')
<form method="post" action="" align="center">
<fieldset>
    <legend>Enter New Password</legend>
    <h1>{{Session::get('msg')}}</h1>
    {{@csrf_field()}}<br>
    User Type: <input type="text" name="user_type" value="{{session()->get('user_type')}}" disabled><br><br>
    User name: <input type="text" name="uname" value="{{session()->get('username')}}" disabled><br><br>
    Email: <input type="text" name="email" value="{{session()->get('email')}}" disabled> <br><br>
    Enter New Password: <input type="password" name="new_pass" placeholder="Enter New Password">@error('new_pass'){{$message}}@enderror <br><br>
    Confirm New Password: <input type="password" name="conf_new_pass" placeholder="confirm New Password">@error('conf_new_pass'){{$message}}@enderror <br><br>
    <input type="submit" value="Submit">
</fieldset>
</form> 
@endsection
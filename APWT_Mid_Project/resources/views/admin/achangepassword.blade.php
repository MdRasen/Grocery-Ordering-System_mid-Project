@extends('layouts.main')
@section('title')
    Password
@endsection
@section('content')
<form method="post" action="{{route('admin.achangepasswordupdate');}}" align="center">
<center>
<fieldset style="width: 50%;">
    <legend><h3>Change Password</h3></legend>
    <h1>{{Session::get('msg')}}</h1>
    {{@csrf_field()}}
    User name: <input type="text" name="uname" value="{{session()->get('username')}}" disabled><br><br>
    Enter Old Password: <input type="password" name="cur_pass" placeholder="Enter Old Password">@error('cur_pass'){{$message}}@enderror <br><br>
    Enter New Password: <input type="password" name="new_pass" placeholder="Enter New Password">@error('new_pass'){{$message}}@enderror <br><br>
    Confirm New Password: <input type="password" name="conf_new_pass" placeholder="Confirm New Password">@error('conf_new_pass'){{$message}}@enderror <br><br>
    <input type="submit" value="Submit">
</fieldset>
</center>
</form> 
@endsection
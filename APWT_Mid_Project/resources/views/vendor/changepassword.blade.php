@extends('layouts.main')
@section('title')
    Change Password
@endsection
@section('content')
<form method="post" action="" align="center">
<fieldset>
    <legend>Change Password</legend>
    <h3 style="color: red;">{{Session::get('msg')}}</h3>
    {{@csrf_field()}}
    Enter Current Password: <input type="password" name="cur_pass" placeholder="Enter Current Password">@error('cur_pass'){{$message}}@enderror <br><br>
    Enter New Password: <input type="password" name="new_pass" placeholder="Enter New Password">@error('new_pass'){{$message}}@enderror <br><br>
    Confirm New Password: <input type="password" name="conf_new_pass" placeholder="confirm New Password">@error('conf_new_pass'){{$message}}@enderror <br><br>
    <input type="submit" value="Update">    <a href="{{route('public.forgotpassword')}}"> <input type="button" value="Forgot Password"></a>
</fieldset>
</form> 
@endsection
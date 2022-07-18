@extends('layouts.main')
@section('title')
    Login
@endsection
@section('content')

<form method="post" action="">

    <center>
        <h3 style="color: red;">{{Session::get('logoutMsg')}}</h3>
        <h3 style="color: red;">{{Session::get('msg')}}</h3>

        <fieldset>
            <legend>Login</legend>
            {{@csrf_field()}}
            
            <table>
                <tr>
                    <th><label for="user_type">User_Type:</label></th>

                    <td>
                        <select name="user_type">
                            <option value="Admin">Admin</option>
                            <option value="Vendor">Vendor</option>
                            <option value="Customer">Customer</option>
                            <option value="Deliveryman">Deliveryman</option>
                        </select>
                        <br> @error('user_type'){{$message}}@enderror
                    </td>
                </tr>

                <tr></tr>
    
                <tr>
                    <th><label for="email">Email:</label></th>
                    <td>
                        <input type="text" name="email" placeholder="Write Your Email" value="{{old('email')}}">
                        <br> @error('email'){{$message}}@enderror
                    </td>
                </tr>

                <tr></tr>
    
                <tr>
                    <th><label for="email">Password:</label></th>
                    <td>
                        <input type="password" name="password" placeholder="Write Your Password" value="{{old('password')}}">
                        <br> @error('password'){{$message}}@enderror
                    </td>
                </tr>

                <tr></tr>
    
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="Login"> | 
                        <a href="{{route('public.forgotpassword')}}">Forgot Password?</a>
                        
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <th>
                        <a href="{{route('public.emaillogin')}}"><input type="button" value="Login using Email"></a>
                    </th>
                </tr>
            </table>
    
        </fieldset>
    </center>
</form> 
@endsection
@extends('layouts.main')
@section('title')
Registration
@endsection
@section('content')
<form method="post" action="" align="center">
    <center>
        <fieldset>
            <legend>Registration</legend>
            <h1>{{Session::get('msg')}}</h1>
            {{@csrf_field()}}
    
            <table>
                <tr>
                    <th>Register as:</th>
                    <td>
                        <input type="radio" id="vendor" name="user_type" value="Vendor"><label for="vendor">Vendor</label>
                        <input type="radio" id="customer" name="user_type" value="Customer"><label for="customer">Customer</label>
                        <input type="radio" id="deliveryman" name="user_type" value="Deliveryman"><label
                for="deliveryman">Deliveryman</label>
                @error('user_type'){{$message}}@enderror
                    </td>
                </tr>
    
                <tr>
                    <th>Name:</th>
                    <td>
                        <input type="text" name="name" placeholder="Write Your Name" value="{{old('name')}}">
                        @error('name'){{$message}}@enderror
                    </td>
                </tr>

                <tr>
                    <th>User Name:</th>
                    <td>
                        <input type="text" name="username" placeholder="Write Your User Name" value="{{old('username')}}">
                        @error('username'){{$message}}@enderror
                    </td>
                </tr>

                <tr>
                    <th>Email:</th>
                    <td>
                        <input type="text" name="email" placeholder="Write Your Email" value="{{old('email')}}">
                        @error('email'){{$message}}@enderror
                    </td>
                </tr>

                <tr>
                    <th>Phone Number:</th>
                    <td>
                        <input type="text" name="phone" placeholder="Write Your Phone Number" value="{{old('phone')}}">
                        @error('phone'){{$message}}@enderror
                    </td>
                </tr>

                <tr>
                    <th>Password:</th>
                    <td>
                        <input type="password" name="password" placeholder="Write Your Password">
                        @error('password'){{$message}}@enderror
                    </td>
                </tr>

                <tr>
                    <th>Confirm Password:</th>
                    <td>
                        <input type="password" name="conf_password" placeholder="Re-Write Your Password">
                        @error('conf_password'){{$message}}@enderror
                    </td>
                </tr>

                <tr>
                    <th>Gender:</th>
                    <td>
                        <input type="radio" id="male" name="gender" value="Male"><label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="Female"><label for="female">Female</label>
                        <input type="radio" id="others" name="gender" value="Others"><label for="others">Others</label>
                        @error('gender'){{$message}}@enderror
                    </td>
                </tr>

                <tr>
                    <th>Date of Birth:</th>
                    <td>
                        <input type="date" id="dob" name="dob" value="{{old('dob')}}">
                        @error('dob'){{$message}}@enderror
                    </td>
                </tr>

                <tr>
                    <th>Address:</th>
                    <td>
                        {{-- <input type="text" name="address" placeholder="Write Your Address" value="{{old('address')}}">
                        @error('address'){{$message}}@enderror --}}

                        <textarea name="address" placeholder="Write Your Address" cols="22" rows="4" value="{{old('address')}}"></textarea>
                        @error('address'){{$message}}@enderror

                    </td>
                </tr>

                <tr>
                    <th colspan="2"><input type="submit" value="Registration"></th>
                </tr>

            </table>
        </fieldset>
    </center>
</form>
@endsection

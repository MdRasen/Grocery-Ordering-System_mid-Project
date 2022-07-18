@extends('layouts.main')
@section('title')
Customer Profile Info
@endsection
@section('content')
<h1 align="center">Customer Profile Info</h1>

<div class="main-section">
    <center>
        <table border="2" style="width: 100%;">
            <tr>

                <td style="width: 50%; padding: 10px; padding-left: 170px;">

                    <img src="{{asset('storage/cprofile_images')}}/{{$customer->propic}}" alt="Customer icon" style="width: 300px;">
                    <br> <br>

                </td>
                <td style="width: 50%; padding: 20px;">
                        
                        <fieldset>
                            <legend>My Profile</legend>

                            <table>

                                <tr>
                                    <td><label for="id"><b>ID:</b></label></td>
                                    <td><input type="text" name="id" value="{{$customer->id}}" disabled style="width: 100%"></td>
                                </tr>

                                <tr>
                                    <td><label for="username"><b>Username:</b></label></td>
                                    <td><input type="text" name="username" value="{{$customer->username}}" disabled style="width: 100%">
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="name"><b>Name:</b></label></td>
                                    <td><input type="text" name="name" value="{{$customer->name}}" disabled style="width: 100%">
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="email"><b>Email:</b></label></td>
                                    <td><input type="email" name="email" value="{{$customer->email}}" disabled style="width: 100%">
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="phone"><b>Phone:</b></label></td>
                                    <td><input type="text" name="phone" value="{{$customer->phone}}" disabled style="width: 100%">
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="password"><b>Password:</b></label></td>
                                    <td><input type="password" name="password" value="{{$customer->password}}" disabled style="width: 100%">
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="gender"><b>Gender:</b></label></td>
                                    <td><input type="text" name="gender" value="{{$customer->gender}}" disabled style="width: 100%">
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="dob"><b>DOB:</b></label></td>
                                    <td><input type="date" name="dob" value="{{$customer->dob}}" disabled style="width: 100%">
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="address"><b>Address:</b></label></td>
                                    <td><input type="text" name="address" value="{{$customer->address}}" disabled style="width: 100%">
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="{{route('customer.cprofile');}}" style="font-size: 20px;"> <input type="button" value="Edit Profile"></a>
                                        <a href="{{route('customer.cchangepass')}}"><input type="button" value="Change Password"></a>
                                    </td>
                                </tr>

                            </table>

                        </fieldset>

                </td>
            </tr>
        </table>
    </center>

</div>
@endsection

@extends('layouts.main')
@section('title')
Profile
@endsection
@section('content')
<h1 align="center">Profile</h1>

<div class="main-section">

    <h3>{{Session::get('msg')}}</h3>

    <center>
        <table border="2" style="width: 100%;">
            <tr>
                <td style="width: 30%; padding: 10px;">
                <center>
                    <img src="{{asset('storage/admin_profile_images')}}/{{$admin->propic}}" alt="Admin Icon" style="width: 300px;">
                    <br> <br>
                <center>
                </td>
                <td style="width: 70%; padding: 20px;">
                        {{@csrf_field()}}
                        <fieldset>
                            <legend>My Profile</legend>
                            <table>
                                <tr>
                                    <td><label for="id"><b>ID:</b></label></td>
                                    <td><input type="text" name="id" value="{{$admin->id}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><label for="username"><b>User Name:</b></label></td>
                                    <td><input type="text" name="username" value="{{$admin->username}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><label for="name"><b>Name:</b></label></td>
                                    <td><input type="text" name="name" value="{{$admin->name}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><label for="email"><b>Email:</b></label></td>
                                    <td><input type="email" name="email" value="{{$admin->email}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><label for="phone"><b>Phone:</b></label></td>
                                    <td><input type="text" name="phone" value="{{$admin->phone}}" disabled></td>
                                </tr>
                                <tr>
                                    <td><label for="gender"><b>Gender:</b></label></td>
                                    <td><input type="text" name="gender" value="{{$admin->gender}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><label for="dob"><b>DOB:</b></label></td>
                                    <td><input name="dob" value="{{$admin->dob}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><label for="address"><b>Address:</b></label></td>
                                    <td><input type="text" name="address" value="{{$admin->address}}" disabled></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="{{route('admin.achangepassword');}}" style="font-size: 20px;"> <input type="button" value="Change Password"></a>
                                        <a href="{{route('admin.aeditprofile');}}" style="font-size: 20px;"> <input type="button" value="Edit Profile"></a>
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

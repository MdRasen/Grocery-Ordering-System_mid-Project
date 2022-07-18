@extends('layouts.main')
@section('title')
Account
@endsection
@section('content')
<h1 align="center">Account</h1>

<div class="main-section">

<h3 align="center" style="color: red;">{{Session::get('msg')}}</h3>

    <center>
        <table border="2" style="width: 100%;">
            <tr>
                <td style="width: 50%;">
                <br>
                <center>
                    <img src="{{asset('storage/vendor_profile_images')}}/{{$vendor->propic}}" alt="Customer icon" style="width: 350px;">
                    <br> <br>
                <center>
                </td>
                <td style="width: 50%; padding: 20px;">
                        {{@csrf_field()}}
                        <fieldset>
                            <legend>My Profile</legend>
                            <table>
                                <tr>
                                    <td><b>ID:</b></td>
                                    <td><input value="{{$vendor->id}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><b>User Name:</b></td>
                                    <td><input value="{{$vendor->username}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><b>Name:</b></td>
                                    <td><input value="{{$vendor->name}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><b>Email:</b></td>
                                    <td><input value="{{$vendor->email}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><b>Phone:</b></td>
                                    <td><input value="+880{{$vendor->phone}}" disabled></td>
                                </tr>
                                <tr>
                                    <td><b>Gender:</b></td>
                                    <td><input value="{{$vendor->gender}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><b>DOB:</b></td>
                                    <td><input value="{{$vendor->dob}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><b>Address:</b></td>
                                    <td><input value="{{$vendor->address}}" disabled></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <a href="{{route('vendor.editprofile');}}" style="font-size: 20px;"> <input type="button" value="Edit Profile"></a>
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

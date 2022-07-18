@extends('layouts.main')
@section('title')
Account
@endsection
@section('content')
<h1 align="center">Account</h1>

<div class="main-section">

    <center>
    <h3 style="color: red;">{{Session::get('msg')}}</h3>
        <table border="2" style="width: 100%;">
            <tr>
                <td style="width: 40%;">
                <center><br><br>
                    <img src="{{asset('storage/vendor_profile_images')}}/{{$vendor->propic}}" alt="Customer icon" style="width: 200px;">
                    <br> <br>
                    <form action="{{route('vendor.picupload');}}" method="POST" enctype="multipart/form-data">
                    {{@csrf_field()}}<br>
                        <label for="pic"><b>&ensp;Select image: </b></label>
                        <input type="file" name="pic"> <br><br> @error('pic'){{$message}}<br><br>@enderror 
                        <input type="submit" name="submit" value="Upload">
                    </form>
                </center>
                </td>
                <td style="width: 60%; padding: 20px;">

                    <form action="" method="POST">

                        {{@csrf_field()}}<br>
                        
                        <fieldset>
                            <legend>My Profile</legend>

                            <table>

                                <tr>
                                    <td><label for="id"><b>ID:</b></label></td>
                                    <td><input type="number" name="id" value="{{$vendor->id}}" disabled></td>
                                </tr>

                                <tr>
                                    <td><label for="username"><b>Username:</b></label></td>
                                    <td><input type="text" name="username" value="{{$vendor->username}}">
                                        @error('username')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="name"><b>Name:</b></label></td>
                                    <td><input type="text" name="name" value="{{$vendor->name}}">
                                        @error('name')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="email"><b>Email:</b></label></td>
                                    <td><input type="email" name="email" value="{{$vendor->email}}">
                                        @error('email')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="phone"><b>Phone:</b></label></td>
                                    <td><input type="text" name="phone" value="{{$vendor->phone}}">
                                        @error('phone')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="gender"><b>Gender:</b></label></td>
                                    <td><input type="text" name="gender" value="{{$vendor->gender}}">
                                        @error('gender')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="dob"><b>DOB:</b></label></td>
                                    <td><input type="date" name="dob" value="{{$vendor->dob}}">
                                        @error('dob')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="address"><b>Address:</b></label></td>
                                    <td><input type="text" name="address" value="{{$vendor->address}}">
                                        @error('address')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="submit" name="update" value="Update">&ensp;
                                        <a href="{{route('vendor.changepassword')}}"><input type="button" value="Change Password"></a>
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </form>
                </td>
            </tr>
        </table>
    </center>
</div>
@endsection

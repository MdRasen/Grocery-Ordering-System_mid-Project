@extends('layouts.main')
@section('title')
Account
@endsection
@section('content')
<h1 align="center">Edit Profile</h1>

<div class="main-section">
<h2>{{Session::get('msg')}}</h2>
    <center>
        <table border="2" style="width: 100%;">
            <tr>
                <td style="width: 30%; padding: 10px;">
                <center>
                    <img src="{{asset('storage/admin_profile_images')}}/{{$admin->propic}}" alt="Admin Icon" style="width: 200px;">
                    <br> <br>
                <center>
                    <form action="{{route('admin.apicupload');}}" method="POST" enctype="multipart/form-data">
                    {{@csrf_field()}}<br>
                        <label for="pic"><b>Select image</b></label>
                        <input type="file" name="pic"> <br> @error('pic'){{$message}}@enderror <br>
                        <input type="submit" name="submit" value="Upload">
                    </form>
                </td>
                <td style="width: 70%; padding: 20px;">
                    <form action="" method="POST">
                        {{@csrf_field()}}<br>       
                        <fieldset>
                            <legend>My Profile</legend>
                            <table>
                                <tr>
                                    <td><label for="id"><b>ID:</b></label></td>
                                    <td><input type="text" name="id" value="{{$admin->id}}" disabled></td>
                                </tr>
                                <tr>
                                    <td><label for="username"><b>Username:</b></label></td>
                                    <td><input type="text" name="username" value="{{$admin->username}}">
                                        @error('username')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="name"><b>Name:</b></label></td>
                                    <td><input type="text" name="name" value="{{$admin->name}}">
                                        @error('name')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="email"><b>Email:</b></label></td>
                                    <td><input type="email" name="email" value="{{$admin->email}}">
                                        @error('email')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="phone"><b>Phone:</b></label></td>
                                    <td><input type="text" name="phone" value="{{$admin->phone}}">
                                        @error('phone')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="gender"><b>Gender:</b></label></td>
                                    <td><input type="text" name="gender" value="{{$admin->gender}}">
                                        @error('gender')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="dob"><b>DOB:</b></label></td>
                                    <td><input type="date" name="dob" value="{{$admin->dob}}">
                                        @error('dob')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="address"><b>Address:</b></label></td>
                                    <td><input type="text" name="address" value="{{$admin->address}}">
                                        @error('address')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="submit" name="update" value="Update">
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

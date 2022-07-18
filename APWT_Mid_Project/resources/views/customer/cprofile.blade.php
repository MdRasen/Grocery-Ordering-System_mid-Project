@extends('layouts.main')
@section('title')
Customer Profile Edit
@endsection
@section('content')
<h1 align="center">Customer Profile Edit</h1>

<div class="main-section">
    <center>

        <h3 style="color: red;">{{Session::get('Msg')}}</h3>

        <table border="2" style="width: 100%;">
            <tr>

                <td style="width: 50%; padding: 10px; padding-left: 220px;">

                    <img src="{{asset('storage/cprofile_images')}}/{{$customer->propic}}" alt="Customer icon" style="width: 200px;">
                    <br>

                    <form action="{{route('customer.cppupload');}}" method="POST" enctype="multipart/form-data">
                        {{@csrf_field()}}

                        <label for="myPP"><b>Select image:</b></label> <br>
                        <input type="file" name="myPP"> <br> <br> 
                        @error('myPP')
                                {{$message}} <br> <br> 
                                @enderror
                        <input type="submit" name="submit" value="Update">
                    </form>
                </td>
                <td style="width: 50%; padding: 20px;">

                    <form action="#" method="POST">

                        {{@csrf_field()}}<br>
                        
                        <fieldset>
                            <legend>My Profile Edit</legend>

                            <table>

                                <tr>
                                    <td><label for="id"><b>ID:</b></label></td>
                                    <td><input type="text" name="id" value="{{$customer->id}}" disabled style="width:100%;"></td>
                                </tr>

                                <tr>
                                    <td><label for="username"><b>Username:</b></label></td>
                                    <td><input type="text" name="username" value="{{$customer->username}}" style="width:100%;">
                                        @error('username')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="name"><b>Name:</b></label></td>
                                    <td><input type="text" name="name" value="{{$customer->name}}" style="width:100%;">
                                        @error('name')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="email"><b>Email:</b></label></td>
                                    <td><input type="email" name="email" value="{{$customer->email}}" style="width:100%;">
                                        @error('email')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="phone"><b>Phone:</b></label></td>
                                    <td><input type="text" name="phone" value="{{$customer->phone}}" style="width:100%;">
                                        @error('phone')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="gender"><b>Gender:</b></label></td>
                                    <td><input type="text" name="gender" value="{{$customer->gender}}" style="width:100%;">
                                        @error('gender')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="dob"><b>DOB:</b></label></td>
                                    <td><input type="date" name="dob" value="{{$customer->dob}}" style="width:100%;">
                                        @error('dob')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>

                                <tr>
                                    <td><label for="address"><b>Address:</b></label></td>
                                    <td><input type="text" name="address" value="{{$customer->address}}" style="width:100%;">
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

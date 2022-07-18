@extends('layouts.main')
@section('title')
Account
@endsection
@section('content')
<div>
        <center>
            <table>
                <tr>
                    <td>
                        <a href="{{route('admin.aviewvendor')}}" style="font-size: 20px;">Vendor Profile</a> |
                        <a href="{{route('admin.aviewcustomer')}}" style="font-size: 20px;">Customers List</a> |
                        <a href="{{route('admin.aviewdeliveryman')}}" style="font-size: 20px;">Deliverymen List</a>
                    </td>
                </tr>
            </table>
        </center>
</div>
<h1 align="center">Edit Deliveryman Profile</h1>

<div class="main-section">
<h2>{{Session::get('msg')}}</h2>
    <center>
        <table border="2" style="width: 60%;">
            <tr>
                <td style="width: 40%; padding: 10px;">
                <center>
                    <img src="{{asset('storage/dprofile_images')}}/{{$deliveryman->propic}}" alt="Deliveryman Icon" style="width: 200px;">
                    <br> <br>
                <center>
                    <form action="{{route('admin.deliverymanppupload');}}" method="POST" enctype="multipart/form-data">
                    {{@csrf_field()}}<br>
                        <label for="pic"><b>Select image</b></label>
                        <input type="file" name="pic"> <br> @error('pic'){{$message}}@enderror <br>
                        <input type="hidden" name="id" value="{{$deliveryman->id}}">
                        <input type="submit" name="submit" value="Upload">
                    </form>
                </td>
                <td style="width: 60%; padding: 20px;">
                    <form action="" method="POST">
                        {{@csrf_field()}}<br>       
                        <fieldset>
                            <legend>Deliveryman Profile</legend>
                            <table>
                                <tr>
                                    <td><label for="id"><b>ID:</b></label></td>
                                    <td><input type="text" name="id" value="{{$deliveryman->id}}" disabled></td>
                                </tr>
                                <tr>
                                    <td><label for="username"><b>Username:</b></label></td>
                                    <td><input type="text" name="username" value="{{$deliveryman->username}}">
                                        @error('username')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="name"><b>Name:</b></label></td>
                                    <td><input type="text" name="name" value="{{$deliveryman->name}}">
                                        @error('name')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="email"><b>Email:</b></label></td>
                                    <td><input type="email" name="email" value="{{$deliveryman->email}}">
                                        @error('email')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="phone"><b>Phone:</b></label></td>
                                    <td><input type="text" name="phone" value="{{$deliveryman->phone}}">
                                        @error('phone')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="gender"><b>Gender:</b></label></td>
                                    <td><input type="text" name="gender" value="{{$deliveryman->gender}}">
                                        @error('gender')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="dob"><b>DOB:</b></label></td>
                                    <td><input type="date" name="dob" value="{{$deliveryman->dob}}">
                                        @error('dob')
                                {{$message}} <br>
                                @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td><label for="address"><b>Address:</b></label></td>
                                    <td><input type="text" name="address" value="{{$deliveryman->address}}">
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

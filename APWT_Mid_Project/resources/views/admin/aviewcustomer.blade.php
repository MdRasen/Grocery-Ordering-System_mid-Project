@extends('layouts.main')
@section('title')
Profile
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
<h2 align="center">Customer</h2><center>
<div>
    <form action="{{route('admin.searchcustomer')}}" method="POST">
        {{@csrf_field()}}
        <input type="search" name="search_name" id="search_name" placeholder="Search here">
            @error('search_name')
            {{$message}}
            @enderror
        <input type="submit" name="search" value="Search">
    </form>
</div>
<h3 style="color: red;">{{Session::get('customerRemove')}}</h3>
<div>
    <center>
        <table border="2px" style="width: 80%; ">
            <tr>
                <th colspan="9">-- Customers Details --</th>
            </tr>
            <tr>
                <th>Customer ID</th>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Gender</th>
                <th>DOB</th>
                <th>Address</th>
                <th colspan="2">Action</th>
            </tr>

            @foreach ($user as $u) 
            <tr>
                <td style="text-align: center;">{{$u->id}}</td>
                <td style="text-align: center;">{{$u->name}}</td>
                <td style="text-align: center;">{{$u->email}}</td>
                <td style="text-align: center;">{{$u->phone}}</td>
                <td style="text-align: center;">{{$u->gender}}</td>
                <td style="text-align: center;">{{$u->dob}}</td>
                <td style="text-align: center;">{{$u->address}}</td>
                <td style="text-align: center;"><a href="{{route('admin.editcustomer',['id'=>$u->id])}}">Edit Customer Profile</a></td>
                <td style="text-align: center;"><a href="{{route('admin.customerremove',['id'=>$u->id])}}">Delete Customer Profile</a></td>
            </tr>
            @endforeach

            <tr>
                <th align="center" colspan="9" style="padding: 5px;">{{$user->links()}}</th>
            </tr>
        </table>
    </center>
</div>

@endsection

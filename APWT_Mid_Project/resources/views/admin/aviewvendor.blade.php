@extends('layouts.main')
@section('title')
    dashboard
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
    <h1 align="center">Vendor</h1> 
    <h1 align="center">{{Session::get('msg')}}</h1>
<div class="container">
    @foreach ($user as $u)
    <center>
    <table border="1" style="width: 60%; height: 400px;">
    <tr>
        <td>
        <center>
        <table border="1" style="width: 100%; height: 395px;">
        <tr><th colspan="2">Vendor Picture</th></tr>
        <tr><td align="center" colspan="2"><img src="{{asset('storage/vendor_profile_images')}}/{{$u->propic}}" alt="Vendor Image" height="180px" width="240px"></td></tr>
        <tr>
            
        </tr>
        </table>
        </center>
        </td>
        <td>
        <table border="1" style="width: 100%; height: 395px;">
        <tr>
            <th >Vendor Id</th>
            <td>{{$u->id}}</td>
        </tr>
        <tr>
            <th>Vendor Name</th>
            <td>{{ $u->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $u->email}}</td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>{{$u->phone}}</td>
        </tr>
        <tr>
            <th>Gender</th>
            <td>{{$u->gender}}</td>
        </tr>
        <tr>
            <th>Date of Birth</th>
            <td>{{$u->dob}}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{$u->address}}</td>
        </tr>
    </table>
</td>
</tr>
</table>
</center>
    @endforeach
</div>

@endsection
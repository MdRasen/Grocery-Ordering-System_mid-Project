@extends('layouts.main')
@section('title')
View Notice
@endsection
@section('content')
<div>
        <center>
            <table>
                <tr>
                    <td>
                        <a href="{{route('admin.asendnotice')}}" style="font-size: 20px;">Send Notice</a> |
                        <a href="{{route('admin.aviewallnotice')}}" style="font-size: 20px;">View Notice</a>
                    </td>
                </tr>
            </table>
        </center>
</div>
<h1 align="center">View Notice</h1>
<!-- <h3 align="center" style="color: red;">{{Session::get('msg')}}</h3> -->
<div class="main-section">
    <center>

            <table border="2px" style="width: 60%; margin:15px; border: 1px solid black; border-collapse: collapse;">
                <tr>
                    <th>Notice ID</th>
                    <th>User Type</th>
                    <th>Mail To</th>
                    <th>Email</th>
                    <th>Subject</th>
                </tr>
                @foreach ($notices as $n)
                <tr align="center">
                    <td>{{$n->id}}</td>
                    @if($n->c_id!=null)
                    <td>Customer</td>
                    <td><a href="{{route('admin.aviewnotice',['id'=>$n->id])}}" style="font-size: 15px;">{{$n->customer->name}}</a></td>
                    <td>{{$n->customer->email}}</td>
                    @elseif($n->v_id!=null)
                    <td>Vendor</td>
                    <td><a href="{{route('admin.aviewnotice',['id'=>$n->id])}}" style="font-size: 15px;">{{$n->vendor->name}}</a></td>
                    <td>{{$n->vendor->email}}</td>
                    @endif
                    <td>{{$n->subject}}</td>
                </tr>
                @endforeach
            </table>
    </center>

</div>
@endsection

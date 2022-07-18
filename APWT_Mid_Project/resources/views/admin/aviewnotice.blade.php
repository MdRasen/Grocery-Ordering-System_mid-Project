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
<h3 align="center" style="color: red;">{{Session::get('msg')}}</h3>
<div class="main-section">
    <center>

            <table style="padding: 10px; width: 40%; margin:15px; border: 1px solid black; border-collapse: collapse;">
                <tr>
                    <th style="padding-top: 10px;">Date & Time:</th>
                    <td style="padding-top: 10px;">{{$notices->updated_at}}</td>
                </tr>
                <tr>
                    <th style="padding-top: 10px;">ID</th>
                    @if($notices->user_type=="Vendor")
                    <td style="padding-top: 10px;">{{$notices->v_id}}</td>
                    @elseif($notices->user_type=="Customer")
                    <td style="padding-top: 10px;">{{$notices->c_id}}</td>
                    @endif
                </tr>
                <tr>
                    <th style="padding-top: 10px;">To:</th>
                    @if($notices->user_type=="Vendor")
                    <td style="padding-top: 10px;">{{$notices->vendor->name}}</td>
                    @elseif($notices->user_type=="Customer")
                    <td style="padding-top: 10px;">{{$notices->customer->name}}</td>
                    @endif
                </tr>
                <tr>
                    <th style="padding-top: 10px;">Email:</th>
                    <td style="padding-top: 10px;">{{$notices->email}}</td>
                </tr>
                <tr>
                    <th style="padding-top: 10px;">Subject:</th>
                    <td style="padding-top: 10px;">{{$notices->subject}}</td>
                </tr>
                <tr>
                    <th style="padding-top: 10px;">Message:</th>
                    <td style="padding-top: 10px;">{{$notices->message}}</td>
                </tr>
                <tr>
                    <th align="right" colspan="2" style="padding: 20px;padding-right: 40px;">
                    <a href="{{route('admin.aeditnotice',['id'=>$notices->id])}}">Update Notice</a>
                    </th>
                </tr>
            </table>
    </center>
</div>
@endsection

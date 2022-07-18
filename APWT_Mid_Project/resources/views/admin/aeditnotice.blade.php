@extends('layouts.main')
@section('title')
Edit Notice
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
<h1 align="center">Edit Notice</h1>
<h3 align="center" style="color: red;">{{Session::get('msg')}}</h3>
<div class="main-section">
    <center>
    <form action="#" method="POST">
            {{@csrf_field()}}
            <table style="padding: 10px; width: 40%; margin:15px; border: 1px solid black; border-collapse: collapse;">
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
                    <td style="padding-top: 10px;"><input cols="22" rows="2" style="width: 80%;" type="text" name="subject" value="{{$notices->subject}}"></td>
                    @error('subject'){{$message}}@enderror
                </tr>

                <tr>
                    <th style="padding-top: 10px;">Message:</th>
                    <td style="padding-top: 10px;"><input style="width: 80%;" name="message"cols="22" rows="8" value="{{$notices->message}}"></td>
                        @error('message'){{$message}}@enderror
                </tr>

                <tr>
                    <th colspan="9" style="padding-left: 450px; padding-top: 10px; padding-bottom: 15px;"><input type="submit" value="Update"></th>
                </tr>
            </table>
        </form>
    </center>
</div>
@endsection

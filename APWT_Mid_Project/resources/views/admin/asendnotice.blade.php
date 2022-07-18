@extends('layouts.main')
@section('title')
Admin Notice
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
<h1 align="center">Send Mail</h1>
<h3 align="center" style="color: red;">{{Session::get('msg')}}</h3>
<div class="main-section">
    <center>
        <form action="{{route('admin.asendnoticeupdate');}}" method="POST">
            {{@csrf_field()}}

            <table style="width: 45%; margin:5px; border: 1px solid black; border-collapse: collapse;">
                <tr>
                    <th style="padding-top: 25px;">Send Notice To:</th>
                    <td style="padding-top: 25px;"><input type="radio" id="vendor" name="user_type" value="Vendor"><label for="vendor">Vendor</label>
                        <input type="radio" id="customer" name="user_type" value="Customer"><label for="customer">Customer</label></td>
                        @error('user_type'){{$message}}@enderror
                </tr>
                <tr>
                    <input type="hidden" name="a_id" value="{{session()->get('id')}}" style="width:100%;">
                    <th style="padding-top: 10px;">Email:</th>
                    <td style="padding-top: 10px;"><input style="width: 80%;" type="text" name="email" value="{{old('email')}}"></td>
                    @error('email'){{$message}}@enderror
                </tr>
                <tr>
                    <th style="padding-top: 10px;">Subject:</th>
                    <td style="padding-top: 10px;"><textarea cols="22" rows="2" style="width: 80%;" type="text" name="subject" value="{{old('subject')}}"></textarea></td>
                    @error('subject'){{$message}}@enderror
                </tr>

                <tr>
                    <th style="padding-top: 10px;">Message:</th>
                    <td style="padding-top: 10px;"><textarea style="width: 80%;" name="message"cols="22" rows="8" value="{{old('message')}}"></textarea></td>
                        @error('message'){{$message}}@enderror
                </tr>

                <tr>
                    <th colspan="9" style="padding-left: 450px; padding-top: 10px; padding-bottom: 15px;"><input type="submit" value="Send"></th>
                </tr>
            
            </table>
        </form>
    </center>

</div>
@endsection

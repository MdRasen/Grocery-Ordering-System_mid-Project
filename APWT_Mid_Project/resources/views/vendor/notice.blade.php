@extends('layouts.main')
@section('title')
Notice
@endsection
@section('content')
<h1 align="center">Notices</h1>
<div class="main-section">
    <center>
            <table style="width: 45%; margin:5px;" border="2px">
            <tr style="padding: 10px;">
            <th>Notice From</th>
            <th>Mail</th>
            </tr>
            @foreach ($notices as $n)
            <tr>
                <td style="text-align: center;padding: 10px;">{{$n->admin->name}}</td>
                <td style="padding: 10px;"><sup>Date & Time: {{$n->updated_at}}</sup><br><br><b>Subject:</b> {{$n->subject}}<br><b>Message:</b> {{$n->message}} </td>
            </tr>
            @endforeach
            </table>
    </center>

</div>
@endsection

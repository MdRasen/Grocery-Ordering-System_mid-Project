@extends('layouts.main')
@section('title')
    Customer Password Change
@endsection
@section('content')
    
<div class="main-section">
    
<center>

        <h3 style="color: red;">{{Session::get('msg')}}</h3>
        
    <form action="{{route('customer.cpasschangeForm')}}" method="POST">
        {{@csrf_field()}}

        <fieldset>
            <legend>Password Change</legend>
            <table>
                <tr>
                    <th>Current Password:</th>
                    <td>
                        <input type="password" name="current_pass" placeholder="Enter Current Password" value="{{old('current_pass')}}">
                        <br> @error('current_pass'){{$message}}@enderror
                    </td>
                </tr>
                <tr>
                    <th>New Password:</th>
                    <td>
                        <input type="password" name="new_pass" placeholder="Enter New Password" value="{{old('new_pass')}}">
                        <br> @error('new_pass'){{$message}}@enderror
                    </td>
                </tr>
                <tr>
                    <th>Confirm New Password:</th>
                    <td>
                        <input type="password" name="confirm_pass" placeholder="Enter New Password" value="{{old('confirm_pass')}}">
                        <br> @error('confirm_pass'){{$message}}@enderror
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="Update"> <a href="{{route('public.forgotpassword')}}"> <input type="button" value="Forgot Password"></a>
                    </td>
                </tr>
            </table>
        </fieldset>

    </form>
</center>

</div>

@endsection
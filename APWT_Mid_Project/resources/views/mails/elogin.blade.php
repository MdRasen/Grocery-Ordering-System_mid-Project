{{-- http://127.0.0.1:8000/elogin/{{$user_type}}/{{$username}}/{{$id}} --}}



<h3>Hi! {{$username}}</h3>
<p>You asked us to send you a magic link for quickly signing into your Grocery OS account.</P>

<center>
    <button type="submit"><a href="http://127.0.0.1:8000/elogin/{{$user_type}}/{{$username}}/{{$id}}">Click Here To Login</a></button>
</center>

<p>The above link is magic link, Only meant for you. Please don't share it with anyone.</p>
<h4>Thank You! <br>- Grocery OS</h4>

</div>
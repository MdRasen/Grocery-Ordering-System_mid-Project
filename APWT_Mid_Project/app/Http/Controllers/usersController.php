<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\vendor;
use App\Models\customer;
use App\Models\deliveryman;
use App\Models\req_deliveryman;
use App\Models\coupon;
use App\Models\customer_coupon;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendOTP;
use App\Mail\elogin;
use App\Models\product;
use Illuminate\Support\Facades\DB;

class usersController extends Controller
{
    function registrationConfirm(Request $vali){
        $this->validate($vali,
            [
                "user_type"=>"required",
                "name"=>"required|regex:/^[A-Z a-z,.-]+$/i",
                "username"=>"required|unique:vendors|unique:customers|unique:deliverymen",
                "email"=>"required|email|unique:vendors|unique:customers|unique:deliverymen",
                "phone"=>"required|numeric|digits:10",
                "password"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
                "conf_password"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/|same:password",
                "gender"=>"required",
                "dob"=>"required|before:-10 years",
                "address"=>"required"
            ],
            [
                'name.regex' => 'Name cannot contain special characters or numbers.',
                'password.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
                'conf_password.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
                'dob.before' => 'User must be 10 years or older.',
            ]
        );
        if($vali->user_type=="Vendor"){$user = new vendor();}
        elseif($vali->user_type=="Customer"){$user = new customer();}
        elseif($vali->user_type=="Deliveryman"){$user = new req_deliveryman();}
        
        $user->name = $vali->name;
        $user->username = $vali->username;
        $user->email =$vali->email;
        $user->phone = $vali->phone;
        $user->password = $vali->password;
        $user->gender = $vali->gender;
        $user->dob = $vali->dob;
        $user->address = $vali->address;
        $user->save();
        if($user){
            $co=coupon::all()->first();
            if($co){
                if($vali->user_type=="Customer"){
                    $c=customer::where('username','=',$vali->username)->first();
                    $cco = new customer_coupon();
                    $cco->c_id=$c->id;
                    $cco->co_id=$co->id;
                    $cco->save();
                }
            }
        }
        session()->flash('msg','Registration Completed!');
        return redirect()->route("public.login");
    }

    function loginConfirm(Request $vali){
        $this->validate($vali,
            [
                "user_type"=>"required",
                "email"=>"required|email",
                "password"=>"required|min:8"
            ],
            [
                'password.regex' => 'Must contain special character, number, uppercase and lowercase letter.'
            ]
        );
        if($vali->user_type=="Admin"){$user=admin::where('email','=',$vali->email)->where('password',$vali->password)->first();}
        elseif($vali->user_type=="Vendor"){$user=vendor::where('email','=',$vali->email)->where('password',$vali->password)->first();}
        elseif($vali->user_type=="Customer"){$user=customer::where('email','=',$vali->email)->where('password',$vali->password)->first();}
        elseif($vali->user_type=="Deliveryman"){$user=deliveryman::where('email','=',$vali->email)->where('password',$vali->password)->first();}
       
        if($user){
            session()->put('id',$user->id);
            session()->put('user_type',$vali->user_type);
            session()->put('username', $user->username);
            session()->put('propic', $user->propic);

            if($vali->user_type == "Admin"){
                return redirect()->route("public.products");
            }

            elseif($vali->user_type == "Customer"){
                return redirect()->route("customer.cdashboard");
            }

            elseif($vali->user_type == "Vendor"){
                return redirect()->route("vendor.dashboard");
            }
            elseif($vali->user_type == "Deliveryman"){
                return redirect()->route("deliveryman.dashboard");
            }
        }
        else {
            session()->flash('msg','User not valid!');
            return back();
        }
    }
    function emailloginConfirm(Request $vali){
        $this->validate($vali,
            [
                "user_type"=>"required",
                "email"=>"required|email"
            ],
            []
        );
        if($vali->user_type=="Admin"){$user=admin::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Vendor"){$user=vendor::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Customer"){$user=customer::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Deliveryman"){$user=deliveryman::where('email','=',$vali->email)->first();}
       
        if($user){
            Mail::to($vali->email)->send(new elogin("Email Login",$vali->user_type,$user->username,$user->password,));
            session()->flash('msg','Check Your Email for Fearther Information');
            return back();
        }
        else {
            session()->flash('msg','User not valid!');
            return back();
        }
    }
    function elogin($user_type,$username,$id){
        
        if($user_type=="Admin"){$user=admin::where('username','=',$username)->where('password',$id)->first();}
        elseif($user_type=="Vendor"){$user=vendor::where('username','=',$username)->where('password',$id)->first();}
        elseif($user_type=="Customer"){$user=customer::where('username','=',$username)->where('password',$id)->first();}
        elseif($user_type=="Deliveryman"){$user=deliveryman::where('username','=',$username)->where('password',$id)->first();}
       
        if($user){
            session()->put('id',$user->id);
            session()->put('user_type',$user_type);
            session()->put('username', $user->username);
            session()->put('propic', $user->propic);

            if($user_type == "Admin"){
                return redirect()->route("admin.adashboard");
            }

            elseif($user_type == "Customer"){
                return redirect()->route("customer.cdashboard");
            }

            elseif($user_type == "Vendor"){
                return redirect()->route("vendor.dashboard");
            }
            elseif($user_type == "Deliveryman"){
                return redirect()->route("deliveryman.dashboard");
            }
        }
        else {
            session()->flash('msg','User not valid!');
            return back();
        }
    }
    function forgotpassword(Request $vali){
        $this->validate($vali,
            [
                "user_type"=>"required",
                "email"=>"required|email"
            ],
            []
        );
        if($vali->user_type=="Admin"){$user=admin::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Vendor"){$user=vendor::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Customer"){$user=customer::where('email','=',$vali->email)->first();}
        elseif($vali->user_type=="Deliveryman"){$user=deliveryman::where('email','=',$vali->email)->first();}
       
        if($user){
            session()->put('user_type',$vali->user_type);
            session()->put('email',$user->email);
            session()->put('username',$user->username);
            session()->put('resetpass','yes');
            return redirect()->route("public.sendOTP");
        }
        else {
            session()->flash('msg','User not valid!');
            return back();
        }
    }
    function mail(){
        $otp = random_int(100000, 999999);
        session()->put('otp',$otp);
        Mail::to([Session()->get('email')])->send(new sendOTP("Access OTP",Session()->get('user_type'),Session()->get('username'),Session()->get('email'),Session()->get('otp')));
        return redirect()->route("public.enterOTP");
    }
    function enterOTP(Request $vali){
        if(Session()->get('otp')==$vali->otp){
            session()->put('checkotp','yes');
            return redirect()->route("public.enternewpassword");
        }
        else {
            session()->flash('msg','OTP not valid!');
            return back();
        }
    }
    function enternewpassword(Request $vali){
        $this->validate($vali,
            [
                "new_pass"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
                "conf_new_pass"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/|same:new_pass",
            ],
            [
                'new_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
                'conf_new_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
            ]
        );
        if(session()->get('user_type')=="Admin"){$user=admin::where('email','=',session()->get('email'))->first();}
        elseif(session()->get('user_type')=="Vendor"){$user=vendor::where('email','=',session()->get('email'))->first();}
        elseif(session()->get('user_type')=="Customer"){$user=customer::where('email','=',session()->get('email'))->first();}
        elseif(session()->get('user_type')=="Deliveryman"){$user=deliveryman::where('email','=',session()->get('email'))->first();}
       
        if($user){
            $user->password = $vali->new_pass;
        $user->update();
        session()->flush();
        // session()->flash('msg','Password Change Completed');
        return redirect()->route("public.login");
        }
        else{
            session()->flash('msg','Password Change Failed!');
            return back();
        }
        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\cart;
use Illuminate\Http\Request;
use App\Models\customer;
use App\Models\order;
use App\Models\product_order;
use App\Models\customer_product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\placeOrder;
use App\Models\coupon;
use App\Models\customer_coupon;
use App\Models\review;
use App\Models\notice;

class customersController extends Controller
{
    function __construct(){
        $this->middleware("logged");
        $this->middleware("customer");
    }
    
    function cdashboard(){
        $p = DB::table('products')->simplePaginate(5);
        return view('customer.cdashboard', compact('p'));
    }

    function cprofileinfo(){
        $id = session()->get('id');
        $customer = [];
        $customer = customer::where('id', '=', $id)->first();

        return view("customer.cprofileinfo")->with('customer', $customer);
    }

    function cprofile(){
        $id = session()->get('id');
        $customer = [];
        $customer = customer::where('id', '=', $id)->first();

        return view("customer.cprofile")->with('customer', $customer);
    }

    function cprofileupdate(Request $req){
        $id = session()->get('id');
        $this->validate($req, [
            "username" => "required|unique:customers,username,$id",
            "name" => "required|regex:/^[a-z ,.'-]+$/i",
            "email" => "required|email|unique:customers,email,$id",
            "phone"=>"required|numeric|digits:10",
            "gender" => "required",
            "dob" => "required|before:-10 years",
            "address" => "required"
        ],
        [
            'name.regex' => 'Name cannot contain special characters or numbers.',
            'dob.before' => 'User must be 10 years or older.',
        ]
        );
        
        $id = session()->get('id');

        $customer = customer::find($id);

        $customer->username = $req->username;
        $customer->name = $req->name;
        $customer->email = $req->email;
        $customer->phone = $req->phone;
        $customer->gender = $req->gender;
        $customer->dob = $req->dob;
        $customer->address = $req->address;

        $customer->update();
        session()->put('username', $customer->username);
        session()->flash('Msg','Customer details has been successfully updated!');
        return redirect()->route('customer.cprofile');
    }

    function cchangepass(){
        return view("customer.cpasschange");
    }

    function cpasschangeForm(Request $req){

        $this->validate($req, [
            "current_pass" => "required",
            "new_pass" => "required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
            "confirm_pass" => "required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/|same:new_pass",
        ],

        [
            'new_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
            'confirm_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
        ]
    );

        $id = session()->get('id');
        $customer = customer::find($id);

        if($customer->password == $req->current_pass){
        $customer->password = $req->new_pass;

        $customer->update();

        session()->flush();
        session()->flash('msg','Customer password has been successfully updated!');
        return redirect()->route('public.login');
        }

        else{
            session()->flash('msg','Customer current password does not match!');
        return redirect()->route('customer.cchangepass');
        }

    }

    function cppupload(Request $req){

        $this->validate($req, [
            "myPP" => "required|mimes:jpg,png,jpeg",
        ],
        [
            'myPP.required' => 'Please select a picture!',
            'myPP.mimes' => 'The profile pic must be a jpg, png or jpeg!',
        ]
    );
        $id = session()->get('id');
        $username = session()->get('username');

        $extension = $req->file('myPP')->getClientOriginalExtension();
        $ppname = $username.time().".".$extension;

        $req->file('myPP')->storeAs('public/cprofile_images', $ppname);

        $customer = customer::find($id);
        $customer->propic = $ppname;
        $customer->update();

        session()->flash('Msg','Customer profile picture has been successfully updated!');
        return redirect()->route('customer.cprofile');
    }

    function caddcart(Request $req){
        $id = session()->get('id');

        $cart = cart::where('p_id', $req->p_id)->where('c_id', $id)->get();

        if(count($cart) != null){
            $cart = cart::where('p_id', $req->p_id)->where('c_id', $id)->first();
            $cart->quantity = $cart->quantity + $req->quantity;
            $cart->update();
            
            session()->flash('Msg','Product has been added in the card!');
            return redirect()->route('customer.cdashboard');
        }

        else{
            $cart = new cart();
            $cart->quantity = $req->quantity;
            $cart->c_id = $id;
            $cart->p_id = $req->p_id;
            $cart->save();

            session()->flash('Msg','Product has been added in the card!');
            return redirect()->route('customer.cdashboard');
        }
        
    }

    function ccart(){

        $id = session()->get('id');
        $carts = cart::where('c_id', $id)->get();
        return view("customer.ccart")->with('carts', $carts);
    }

    function cartproductremove($p_id){

        $carts = cart::where('p_id', $p_id)->delete();
        session()->flash('Msg', "Product has been removed from the cart!");
        return redirect()->route('customer.ccart');

    }

    function corder(){

        $id = session()->get('id');

        $products = cart::where('c_id', $id)->get();
        $customer = customer::find($id);

        if(count($products) !== 0){
            return view("customer.corder")->with('products', $products)->with('customer', $customer);
        }

        else{
            session()->flash('Msg','Your products cart is empty!');
            return redirect()->route('customer.ccart');
        } 
    }

    function corderForm(Request $req){

        $this->validate($req, [
            "payment_option" => "required",
            "delivery_address" => "required",
        ]);

        $c_id = session()->get('id');

        if(isset($req->coupon)){

            $coupon = customer_coupon::where('c_id', $c_id)->first();
            if($coupon != null){
                $checkcoupon = coupon::where('id', $coupon->co_id)->where('code', $req->coupon)->first();

                if($checkcoupon  != null){

                    $carts = cart::where('c_id', $c_id)->get();
            
                foreach($carts as $item){
                
                $order = new order();
                $order->p_id=$item->p_id;
                $order->quantity=$item->quantity;
                $order->c_id=$item->c_id;
                $order->status="Pending";
                $order->payment_method=$req->payment_option;
                $order->payment_status="Unpaid";
                $order->delivery_address=$req->delivery_address;
                $order->co_id=$checkcoupon->id;
                $order->save();
    
                //
                $o=order::where('p_id','=',$item->p_id)->where('c_id','=',$item->c_id)->where('quantity','=',$item->quantity)->first();
                $po = new product_order();
                $po->p_id=$item->p_id;
                $po->o_id=$o->id;
                $po->save();
    
                $cp = new customer_product();
                $cp->p_id=$item->p_id;
                $cp->c_id=$item->c_id;
                $cp->save();
                //
    
                cart::where('c_id', $c_id)->delete();
            }
    
            return redirect()->route('customer.placeOrder');
                }
        
                else{
                    session()->flash('Msg', "Invalid Coupon Code!");
                    return redirect()->route('customer.corder');
                }
            }

            else{
                session()->flash('Msg', "p Invalid Coupon Code!");
                    return redirect()->route('customer.corder');
            }

            
        }

        else{
            $carts = cart::where('c_id', $c_id)->get();
        
            foreach($carts as $item){
            
            $order = new order();
            $order->p_id=$item->p_id;
            $order->quantity=$item->quantity;
            $order->c_id=$item->c_id;
            $order->status="Pending";
            $order->payment_method=$req->payment_option;
            $order->payment_status="Unpaid";
            $order->delivery_address=$req->delivery_address;
            $order->save();
            
            //
            $o=order::where('p_id','=',$item->p_id)->where('c_id','=',$item->c_id)->where('quantity','=',$item->quantity)->first();
            $po = new product_order();
            $po->p_id=$item->p_id;
            $po->o_id=$o->id;

            $cp = new customer_product();
            $cp->p_id=$item->p_id;
            $cp->c_id=$item->c_id;
            $cp->save();
            //

            cart::where('c_id', $c_id)->delete();
        }
        return redirect()->route('customer.placeOrder');
        }
    
    }

    function placeOrderMail(){
        
        $c_id = session()->get('id');
        $customer = customer::find($c_id);

        $orders = order::where('c_id', $c_id)->get(); 

        $coupon = DB::table('orders')
            ->join('coupons', 'coupons.id', '=', 'orders.co_id')
            ->first();
        
        Mail::to([$customer->email])->send(new placeOrder("Your Order has been placed!",Session()->get('user_type'),Session()->get('username'), $orders, $coupon));

        session()->flash('msg','Your Order has been successfully placed!');
        return redirect()->route('customer.cvieworder');
    }

    function cvieworder(){

        $c_id = session()->get('id');

        $orders = order::where('c_id', $c_id)->where('status', '!=', "Delivered")->get();
        $dorders = order::where('c_id', $c_id)->where('status', '=', "Delivered")->get();

        $coupon = DB::table('orders')
            ->join('coupons', 'coupons.id', '=', 'orders.co_id')
            ->first();

        if(count($orders) != 0 || count($dorders) != 0 ){
            return view("customer.cvieworder")->with('orders', $orders)->with('dorders', $dorders)->with('coupon', $coupon);
            }
    
        else{
                session()->flash('Msg','You do not have any order, Order first!');
                return redirect()->route('customer.ccart');
            } 
    }

    function cProductReview(){

        $c_id = session()->get('id');

        $reviews = review::where('c_id', $c_id)->where('message', '=', null)->get();
        $previews = review::where('c_id', $c_id)->where('message', '!=', null)->get();
        
            if(count($reviews) !== 0 || count($previews) !== 0){
                return view("customer.cProductReview")->with('reviews', $reviews)->with('previews', $previews);
            }
    
            else{
                session()->flash('Msg','Your do not have any product for review!');
                return redirect()->route('customer.cdashboard');
            } 
    }

    function creviewForm(Request $req){
        $this->validate($req, [
            "r_message" => "required",
        ],
    );

        $review = review::find($req->r_id);

        $review->message = $req->r_message;
        $review->update();

        session()->flash('msg','Product review has been successfully updated!');
        return redirect()->route('customer.cProductReview');
    }

    function cCoupons(){

        $c_id = session()->get('id');
        $coupons = customer_coupon::where('c_id', $c_id)->get();
        return view("customer.ccoupon")->with('coupons', $coupons);
    }
    function notices(){
        $n = notice::where('c_id','=',session()->get('id'))->get();
        return view('customer.cnotices')->with('notices',$n);
    }
}

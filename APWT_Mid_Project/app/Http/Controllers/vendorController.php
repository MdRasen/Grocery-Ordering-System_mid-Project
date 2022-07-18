<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vendor;
use App\Models\product;
use App\Models\coupon;
use App\Models\requested_coupon;
use App\Models\order;
use App\Models\review;
use App\Models\customer;
use App\Models\cart;
use App\Models\notice;
use App\Models\customer_product;
use App\Models\customer_coupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\confirmOrder;
use App\Mail\confirmDelivery;

class vendorController extends Controller
{
    function __construct(){
        $this->middleware("logged");
        $this->middleware("vendor");
    }
    // function welcome(){return view("public.welcome");}
    public function dashboard(){
        session()->put('product_navbar','yes');
        // $p=product::where('v_id','=',session()->get('id'))->simplePaginate(4);pa
        $p = DB::table('products')->simplePaginate(5);
        return view('vendor.dashboard', compact('p'));
    }
    function profile(){
        session()->forget('product_navbar');
        session()->forget('coupon_navbar');
        $user=vendor::where('id','=',session()->get('id'))->first();
        if($user){return view("vendor.profile")->with('vendor',$user);}
        else {redirect()->route('vendor.dashboard');}
    }
    function editprofile(){
        $user=vendor::where('id','=',session()->get('id'))->first();
        if($user){return view("vendor.editprofile")->with('vendor',$user);}
        else {redirect()->route('vendor.dashboard');}
    }
    function editprofileupdate(Request $vali){
        
        $id = session()->get('id');
        $this->validate($vali, [
            "username" => "required|unique:vendors,username,$id",
            "name" => "required|regex:/^[a-z ,.'-]+$/i",
            "email" => "required|email|unique:vendors,email,$id",
            "phone"=>"required|numeric|digits:10",
            "gender" => "required",
            "dob" => "required||before:-18 years",
            "address" => "required"
        ],
        [
            'name.regex' => 'Name cannot contain special characters or numbers.',
            'dob.before' => 'User must be 18 years or older.',
        ]
        );
        $user=vendor::where('id','=',$id)->first();
        // if($user){return view("vendor.profile")->with('vendor',$user);}
        // else {return view("vendor.dashboard");}
        $user->name = $vali->name;
        $user->username = $vali->username;
        $user->email =$vali->email;
        $user->phone = $vali->phone;
        $user->gender = $vali->gender;
        $user->dob = $vali->dob;
        $user->address = $vali->address;
        $user->update();
        session()->put('username', $user->username);
        session()->flash('msg','Update Completed');
        return back();
    }
    function changepassword(){
        $user=vendor::where('id','=',session()->get('id'))->first();
        if($user){return view("vendor.changepassword")->with('vendor',$user);}
        else {return redirect()->route('vendor.dashboard');}
    }
    function changepasswordupdated(Request $vali){
        $this->validate($vali, [
            "cur_pass" => "required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
            "new_pass" => "required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
            "conf_new_pass" => "required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/|same:new_pass",
        ],
        [
            'new_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
            'conf_new_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
        ]
        );
        $user=vendor::where('id','=',session()->get('id'))->first();
        if($user->password == $vali->cur_pass){
            $user->password = $vali->new_pass;
            $user->update();
            session()->flash('msg','Password Update Completed');
            return back();
        }
        else {
            session()->flash('msg',"Current Password Dosen't Match");
            return back();
        }
    }
    function picupload(Request $req){
        $this->validate($req, [
            "pic" => "required|mimes:jpg,png,jpeg",
        ],
        [
            'pic.required' => 'Please select a picture!',
            'pic.mimes' => 'The profile pic must be a jpg, png or jpeg!',
        ]
        );
        $id = session()->get('id');
        $username = session()->get('username');
        $extension = $req->file('pic')->getClientOriginalExtension();
        $picname = $username.time().".".$extension;
        $req->file('pic')->storeAs('public/vendor_profile_images', $picname);
        $user = vendor::find($id);
        $user->propic = $picname;
        $user->update();

        session()->flash('msg','profile picture has been successfully updated!');
        return redirect()->route('vendor.editprofile');
    }    
    function productNavbar(){
        session()->put('product_navbar','yes');
        return view('vendor.addproduct');
    }
    function addproductConfirm(Request $vali){
        $this->validate($vali, [
            "name" => "required",
            "category" => "required",
            "p_thumbnail" => "required|mimes:jpg,png,jpeg",
            "price" => "required",
            "stock" => "required",
        ],
        [
            'p_thumbnail.required' => 'Please select a picture!',
            'p_thumbnail.mimes' => 'Product Thumbnail must be a jpg, png or jpeg!',
        ]
        );

        $extension = $vali->file('p_thumbnail')->getClientOriginalExtension();
        $thumbnail = $vali->name.time().".".$extension;
        $vali->file('p_thumbnail')->storeAs('public/product_images', $thumbnail);

        $p=new product();
        $p->name = $vali->name;
        $p->category = $vali->category;
        $p->thumbnail = $thumbnail;
        $p->price = $vali->price;
        $p->stock = $vali->stock;
        // $p->color = $vali->color;
        $p->size = $vali->size;
        $p->description = $vali->description;
        $p->v_id = Session()->get('id');
        $p->save();
        session()->flash('msg','Product Added');
        return redirect()->route('vendor.dashboard');
    }
    function productpicupload(Request $req){
        $this->validate($req, [
            "thumbnail" => "required|mimes:jpg,png,jpeg",
        ],
        [
            'thumbnail.required' => 'Please select a picture!',
            'thumbnail.mimes' => 'The profile pic must be a jpg, png or jpeg!',
        ]
        );
        $product = product::find($req->id);
        $extension = $req->file('thumbnail')->getClientOriginalExtension();
        $picname = $product->name.time().".".$extension;
        $req->file('thumbnail')->storeAs('public/product_images', $picname);
        $product->thumbnail = $picname;
        $product->update();

        session()->flash('msg','Thumbnail Updated');
        return back();
    }    
    function editproduct($id){
        $p = product::find($id);
        // $p = product::where('id','=',$id)->first();
        if($p){return view("vendor.editProduct")->with('product',$p);}
        else {return redirect()->route("vendor.dashboard");}
    }
    function editproductConfirm(Request $vali){
        $this->validate($vali, [
            "name" => "required",
            "category" => "required",
            "price" => "required",
            "stock" => "required",
        ],
        []
        );

        $p = product::find($vali->id);
        $p->name = $vali->name;
        $p->category = $vali->category;
        $p->price = $vali->price;
        $p->stock = $vali->stock;
        $p->size = $vali->size;
        $p->description = $vali->description;
        $p->update();
        session()->flash('msg','Product Updated');
        return back();
    }
    function deleteproduct($id){
        // $p = product::find($p_id);
        $p = product::where('id','=',$id)->first();
        if($p){return view("vendor.deleteproduct")->with('product',$p);}
        else {return redirect()->route('vendor.dashboard');}
    }
    function deleteproductConfirm($id){
        $cart = cart::where('p_id','=',$id)->first();
        if($cart){
            session()->flash('msg','Product Id '.$id.' is in cart, remove it from cart before Deleting the Product');
            return redirect()->route("vendor.dashboard");
        }
        $o = order::where('p_id','=',$id)->first();
        if($o){
            if($o->status!='Delivered'){
                session()->flash('msg','Product Id '.$id.' can not be deleted');
                return redirect()->route("vendor.dashboard");
            }
        }
        $cp = customer_product::where('p_id','=',$id)->first();
        if($cp){
            session()->flash('msg','Product Id '.$id.' can not be deleted');
            return redirect()->route("vendor.dashboard");
        }
        // DB::delete('delete from customer_products where p_id = ?',[$id]);
        DB::delete('delete from products where id = ?',[$id]);
        session()->flash('msg','Product Id '.$id.' Deletion Successful');
        return redirect()->route("vendor.dashboard");
    }
    function searchproduct(Request $req){
        $this->validate($req, [
            "search_name" => "required",
        ],
        [
            'search_name.required' => 'Please enter valid product Id',
        ]
    );
    $search_name = $req->search_name;
    $p= product::where('name', 'like', '%'.$search_name.'%')->simplePaginate(5);
    return view('vendor.dashboard', compact('p'));
    }
    function couponNavbar(){
        session()->forget('product_navbar');
        session()->put('coupon_navbar','yes');
        return view('vendor.coupon');
    }
    function createcoupon(Request $value){
        $this->validate($value, [
            "codetype" => "required",
            "code" => "required",
            "amount" => "required"
        ],
        []
        );
        $c=new requested_coupon();
        if($value->codetype=='auto'){
            if(is_numeric($value->code)){
                $c->code=Str::random($value->code);
            }
            else{
                session()->flash('msg','Undefined Coupon Size');
                return back();
            }
        }
        elseif($value->codetype=='manual'){
            $c->code=$value->code;
        }
        $c->amount=$value->amount;
        $c->v_id =$value->v_id;
        $c->save();
        session()->flash('msg','Coupon request has been sent!!');
        return redirect()->route("vendor.allcoupons");
    }
    function allcoupons(){
        session()->forget('product_navbar');
        session()->put('coupon_navbar','yes');
        $c = coupon::all();
        return view('vendor.allcoupons')->with('coupons',$c);
    }
    function editcoupon($id){
        $c = coupon::where('id','=',$id)->first();
        return view('vendor.editcoupon')->with('c',$c);
    }
    function deletecoupon($id){
        $cco = customer_coupon::where('co_id','=',$id)->first();
        if($cco){
            session()->flash('msg','Coupon Id '.$id.' belongs to customer, remove or wait for the customer to use it before Deleting the Coupon');
            return redirect()->route("vendor.allcoupons");
        }
        DB::delete('delete from customer_coupons where co_id = ?',[$id]);
        DB::delete('delete from coupons where id = ?',[$id]);
        $c = coupon::where('id','=',$id)->first();
        session()->flash('msg','Coupon Id '.$id.' Deletion Successful');
        return redirect()->route("vendor.allcoupons");
    }
    function editcouponconfirm(Request $value){
        $c = coupon::where('id','=',$value->id)->first();
        $c->code=$value->code;
        $c->amount=$value->amount;
        $c->save();
        session()->flash('msg','Coupon Id '.$value->id.' Updated');
        return redirect()->route("vendor.allcoupons");;
    }
    function assigncoupon(Request $req){
        $this->validate($req, [
            "id" => "required",
        ],
        [
            'id.required' => 'Enter Valid Customer Id',
        ]
    );
    $c = customer::where('id','=',$req->id)->first();
    if(!$c){
        session()->flash('msg','Invalid Customer Id, Enter a vaild Id');
        return back();
    }
    $o = order::where('c_id','=',$req->id)->where('co_id','=',$req->co_id)->first();
    if($o){
        session()->flash('msg','Coupon Id '.$req->co_id.' has already been used by Custimer Id '.$req->id.'');
        return back();
    }
    $cco = customer_coupon::where('c_id','=',$req->id)->where('co_id','=',$req->co_id)->first();
    if($cco){
        session()->flash('msg','Coupon Id '.$req->co_id.' has already been assign to Custimer Id '.$req->id.'');
        return back();
    }
    $assign = new customer_coupon();
    $assign->c_id=$req->id;
    $assign->co_id=$req->co_id;
    $assign->save();
    session()->flash('msg','Coupon Id '.$req->co_id.' has been assigned to Custimer Id '.$req->id.'');
    return back();
    }
    function orders(){
        session()->forget('product_navbar');
        session()->forget('coupon_navbar');
        $customers = customer::all();
        
        // foreach ($customers as $customer){
    //     foreach($customer->products as $p){
    //         // $o=$p->orders;
    //         foreach ($p->orders as $o){
    //         echo $o->id;
    //     }break;
    // }
    // }
        // echo $o= $c->orders->first();
        // echo $o->coupon;
        // $p= $o->products;
        // echo $p;

        return view('vendor.allorders')->with('customers',$customers);
    }
    function changeorderstatus($id){
        $o = order::where('id','=',$id)->first();
        if($o->status=='Pending'){
            $o->status='Confirmed';
            $o->d_id='1';
            Mail::to($o->customer->email)->send(new confirmOrder("Confirmation of your Order",$o->customer->name,$o->product->name,$o->quantity,$o->delivery_address,$o->d_id));
        }
        // elseif($o->status=='Confirmed'){
        //     $o->status='Delivered';
        //     Mail::to($o->customer->email)->send(new confirmDelivery("Confirmation of your Delivery",$o->customer->name,$o->product->name,$o->quantity,$o->delivery_address));
        //     customer_coupon::where('co_id', $o->co_id) ->delete();
        //     $o->co_id=null;
        //     $r = new review();
        //     $r->c_id=$o->c_id;
        //     $r->p_id=$o->p_id;
        //     $r->save();
        // }
        $o->update();
        session()->flash('msg','Order Updated');
        return redirect()->route("vendor.orders");
    }
    function orderstatus($id){
        $delivery_address='';
        $d_id='1';
        $orders = order::where('c_id', $id)->where('status', 'Confirmed')->where('payment_status', 'Confirmed')->get();
        if($orders){
            foreach($orders as $order){
                $order->status='Delivered';
                $delivery_address=$order->delivery_address;
                customer_coupon::where('co_id', $order->co_id) ->delete();
                $order->co_id=null;
                $r = new review();
                $r->c_id=$order->c_id;
                $r->p_id=$order->p_id;
                $r->save();     
                $order->update();
            }
            $customer = customer::where('id','=',$id)->first();
            Mail::to($customer->email)->send(new confirmDelivery("Confirmation of your Delivery",$customer->name,'$o->product->name','$o->quantity',$delivery_address,$d_id)); 
            session()->flash('msg','Order Updated');
            return redirect()->route("vendor.orders");;  
        }
        else{
            session()->flash('msg','Order need to be confirmed');
            return redirect()->route("vendor.orders");
        }
    }
    function changepaymentstatus($id){
        $o = order::where('id','=',$id)->first();
        $o->payment_status='Confirmed';
        $o->update();
        session()->flash('msg','Order Updated');
        return back();
    }
    function search(){
        session()->flash('msg','Enter value to search');
        return redirect()->route("vendor.orders");
    }
    function searchorder(Request $req){
        $this->validate($req, [
            "id" => "required",
        ],
        [
            'id.required' => 'Please enter valid product Id',
        ]
        );
        $c= customer::where('id', '=', $req->id)->get();
        if(count($c)!=0){
            return view('vendor.allorders')->with('customers',$c);
        }
        else{
            session()->flash('msg','Customer Invalid');
            return redirect()->route("vendor.orders");
        }
    }
    function reviews(){
        session()->forget('product_navbar');
        session()->forget('coupon_navbar');
        // $r = review::all();
        // return view('vendor.allreviews')->with('reviews',$r);
        $p = product::all();
        return view('vendor.allreviews')->with('products',$p);
    }
    function searchreview(Request $req){
        $this->validate($req, [
            "id" => "required",
        ],
        [
            'id.required' => 'Please enter any number',
        ]
    );
    $p= product::where('id', '=', $req->id)->first();
    if($p){return view('vendor.allreview')->with('product',$p);}
    session()->flash('msg','Product not available');
    return redirect()->route("vendor.reviews");
    }
    function notices(){
        session()->forget('product_navbar');
        session()->forget('coupon_navbar');
        $n = notice::where('v_id','=',session()->get('id'))->get();
        return view('vendor.notice')->with('notices',$n);
    }
    function test(){
        $co=coupon::where('id','=','1')->first();
        // echo $co->customers;
        // echo $co->vendor;
        $c=customer::where('id','=','1')->first();
        // echo $c->coupons;
        // echo $c->products;
        // $p=$c->products;
        // echo $c->orders;
        // echo $c->reviews;
        $o=order::where('id','=','2')->first();
        // echo $o->coupon;
        // $cou->$o->coupon;
        // echo $o->customer->name;
        // echo $o->product->name;
        $p=product::where('id','=','1')->first();
        // echo $p->customers;
        // echo $p->reviews;
        // echo $p->vendor;
        // echo $p->orders->payment_status;
        $r=review::where('id','=','1')->first();
        // echo $r->product;
        // echo $r->customer;
        $v=vendor::where('id','=','1')->first();
        // echo $v->coupons;
        // echo $v->products;
        // date_default_timezone_set('Asia/Dhaka');
        // echo $current_time = date("H:i:s");
        // echo date_default_timezone_get(); 
        // echo  $p = DB::table('products');
    }
}
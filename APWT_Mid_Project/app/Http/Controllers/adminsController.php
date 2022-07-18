<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\customer;
use App\Models\deliveryman;
use App\Models\vendor;
use App\Models\req_deliveryman;
use App\Models\notice;
use App\Models\order;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\requested_coupon;
use App\Models\customer_product;
use App\Models\customer_coupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class adminsController extends Controller
{
    //
    function __construct(){
        $this->middleware("logged");
        $this->middleware("admin");
    }
    
    function welcome(){
        return view("public.welcome");
    }

    function adashboard(){
        return view("admin.adashboard");
    }

    function aprofile(){
        $user=admin::where('id','=',session()->get('id'))->first();
        if($user){return view("admin.aprofile")->with('admin',$user);}
        else {return view("admin.adashboard");}
    }

    function aeditprofile(){
        $user=admin::where('id','=',session()->get('id'))->first();
        if($user){return view("admin.aeditprofile")->with('admin',$user);}
        else {return view("admin.adashboard");}
    }
    function aeditprofileupdate(Request $vali){
        $id = session()->get('id');
        $this->validate($vali, [
            "username" => "required|unique:vendors|unique:customers|unique:deliverymen|unique:admins,username,$id",
            "name" => "required|regex:/^[a-z ,.'-]+$/i",
            "email" => "required|email|unique:vendors|unique:customers|unique:deliverymen|unique:admins,email,$id",
            "phone"=>"required|numeric|digits:10",
            "gender" => "required",
            "dob" => "required|before:-18 years",
            "address" => "required"
        ],
        [
            'name.regex' => 'Name cannot contain special characters or numbers.',
            'dob.before' => 'User must be 18 years or older.',
        ]
    );
        $user=admin::where('id','=',session()->get('id'))->first();
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
        return redirect()->route('admin.aprofile');
    }
    function changepassword(Request $vali){
        return view("admin.achangepassword");
    }
    function changepasswordupdate(Request $vali){
        $this->validate($vali,
            [
                "cur_pass"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
                "new_pass"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/",
                "conf_new_pass"=>"required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@&*^~]).*$/|same:new_pass",
            ],
            [
                'new_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
                'conf_new_pass.regex' => 'Must contain special character, number, uppercase and lowercase letter.',
            ]
        );
        $user=admin::where('id','=',session()->get('id'))->first();
        if($user->password == $vali->cur_pass){
            $user->password = $vali->new_pass;
            $user->update();
            session()->flash('msg','Password Update Completed');
            return redirect()->route('admin.aprofile');
        }
        else {
            session()->flash('msg',"Current Password Dosen't Match");
            return back();
        }
        
        
    }
    function apicupload(Request $req){
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

        $req->file('pic')->storeAs('public/admin_profile_images', $picname);

       
        $user = admin::find($id);
        $user->propic = $picname;
        $user->update();

        session()->flash('msg','Profile picture has been successfully updated!');
        return redirect()->route('admin.aprofile');
    }

    function aviewcustomer(){

        $user = DB::table('customers')->simplePaginate(15);
        return view('admin.aviewcustomer', compact('user'));
    }
    function customerremove($id){
        $user = customer::where('id', $id)->delete();
        session()->flash('customerRemove', "Customer has been removed!");
        return redirect()->route('admin.aviewcustomer');
    }
    function searchcustomer(Request $req){
        $this->validate($req, [
            "search_name" => "required",
        ],
        [
            'search_name.required' => 'Please enter any value!',
        ]
    );
    $search_name = $req->search_name;
    $customers= customer::where('name', 'like', '%'.$search_name.'%')->get();
    return view("admin.asearchcustomer")->with('customers', $customers);
    }
    function editcustomer($id){
        $user = customer::where('id', $id)->first();
        return view("admin.aeditcustomer")->with('customer',$user);
    }
    function editcustomerupdate(Request $vali){
        $id=$vali->id;
        $this->validate($vali, [
            "username" => "required|unique:vendors|unique:customers,username,$id|unique:deliverymen",
            "name" => "required|regex:/^[a-z ,.'-]+$/i",
            "email" => "required|email|unique:vendors|unique:customers,email,$id|unique:deliverymen",
            "phone" => "required|max:10|min:10",
            "gender" => "required",
            "dob" => "required|before:-10 years",
            "address" => "required"
        ],
        []
    );
        $user = customer::find($vali->id);
        $user->name = $vali->name;
        $user->username = $vali->username;
        $user->email =$vali->email;
        $user->phone = $vali->phone;
        $user->gender = $vali->gender;
        $user->dob = $vali->dob;
        $user->address = $vali->address;
        $user->update();
        session()->flash('msg','Update Completed');
        return back();
    }
    function customerppupload(Request $req){

        $this->validate($req, [
            "myPP" => "required|mimes:jpg,png,jpeg",
        ],
        [
            'myPP.required' => 'Please select a picture!',
            'myPP.mimes' => 'The profile pic must be a jpg, png or jpeg!',
        ]
    );
        $customer = customer::find($req->id);
        $extension = $req->file('myPP')->getClientOriginalExtension();
        $picname = $customer->name.time().".".$extension;
        $req->file('myPP')->storeAs('public/cprofile_images', $picname);
        $customer->prpopic = $picname;
        $customer->update();

        session()->flash('msg','Customer profile picture has been successfully updated!');
        return back();
    }

    function aviewdeliveryman(){
        $user = DB::table('deliverymen')->simplePaginate(15);
        return view('admin.aviewdeliveryman', compact('user'));
    }
    function deliverymanremove($id){

        $user =DB::delete('delete from deliverymen where id = ?',[$id]);
        session()->flash('deliverymanRemove', "Deliveryman has been removed!");
        return redirect()->route('admin.aviewdeliveryman');
    }
    function searchdeliveryman(Request $req){

        $this->validate($req, [
            "search_name" => "required",
        ],
        [
            'search_name.required' => 'Please enter any value!',
        ]
    );
    $search_name = $req->search_name;
    $deliverymen = deliveryman::where('name', 'like', '%'.$search_name.'%')->get();
    return view("admin.asearchdeliveryman")->with('deliverymen', $deliverymen);
    }
    function editdeliveryman($id){
        $user = deliveryman::where('id', $id)->first();
        return view("admin.aeditdeliveryman")->with('deliveryman',$user);
    }
    function editdeliverymanupdate(Request $vali){
        $id=$vali->id;
        $this->validate($vali, [
            "username" => "required|unique:vendors|unique:customers|unique:deliverymen,username,$id",
            "name" => "required|regex:/^[a-z ,.'-]+$/i",
            "email" => "required|email|unique:vendors|unique:customers|unique:deliverymen,email,$id",
            "phone" => "required|max:10|min:10",
            "gender" => "required",
            "dob" => "required|before:-16 years",
            "address" => "required"
        ],
        []
    );
        $user = deliveryman::find($vali->id);
        $user->name = $vali->name;
        $user->username = $vali->username;
        $user->email =$vali->email;
        $user->phone = $vali->phone;
        $user->gender = $vali->gender;
        $user->dob = $vali->dob;
        $user->address = $vali->address;
        $user->update();
        session()->flash('msg','Update Completed');
        return back();
    }
    function deliverymanppupload(Request $req){

        $this->validate($req, [
            "pic" => "required|mimes:jpg,png,jpeg",
        ],
        [
            'pic.required' => 'Please select a picture!',
            'pic.mimes' => 'The profile pic must be a jpg, png or jpeg!',
        ]
    );
        $deliveryman = deliveryman::find($req->id);
        $extension = $req->file('pic')->getClientOriginalExtension();
        $picname = $deliveryman->name.time().".".$extension;
        $req->file('pic')->storeAs('public/dprofile_images', $picname);
        $deliveryman->propic = $picname;
        $deliveryman->update();

        session()->flash('msg','deliveryman profile picture has been successfully updated!');
        return back();
    }

    function aaprovedeliveryman(){
        $user = DB::table('req_deliverymen')->simplePaginate(15);
        return view('admin.aaprovedeliveryman', compact('user'));
    }
    function adddeliveryman($id){

        $del = req_deliveryman::where('id', $id)->first();

        $user = new deliveryman();
        $user->name = $del->name;
        $user->username = $del->username;
        $user->email =$del->email;
        $user->phone = $del->phone;
        $user->password = $del->password;
        $user->gender = $del->gender;
        $user->dob = $del->dob;
        $user->address = $del->address;
        $user->save();
        $del =DB::delete('delete from req_deliverymen where id = ?',[$id]);
        return redirect()->route('mail.approvedeliverymanmail',['id'=>$user->id]);
    }
    function canceldeliveryman($id){
        $del =DB::delete('delete from req_deliverymen where id = ?',[$id]);
        session()->flash('adddeliveryman', "Deliveryman request has been cancelled!");
        return back();
    }

    function aviewvendor(){

        $user = DB::table('vendors')->simplePaginate(5);
        return view('admin.aviewvendor', compact('user'));
    }

    function asendnotice(){
        return view('admin.asendnotice');
    }
    function asendnoticeupdate(Request $vali){

        if($vali->user_type=="Vendor"){
            $this->validate($vali,
            [
                "email"=>"required|email|exists:vendors,email",
                "subject"=>"required",
                "message"=>"required"
            ],
            [
                'email.exists' => 'Email address does not found!!',
            ]
        );
            $u=vendor::where('email','=',$vali->email)->first();
            
            $mail= new notice();
            $mail->email =$vali->email;
            $mail->a_id =$vali->a_id;
            $mail->v_id =$u->id;
            $mail->user_type =$vali->user_type;
            $mail->subject =$vali->subject;
            $mail->message =$vali->message;
            $mail->save();
        }
        elseif($vali->user_type=="Customer"){
            $this->validate($vali,
            [
                "email"=>"required|email|exists:customers,email",
                "subject"=>"required",
                "message"=>"required"
            ],
            [
                'email.exists' => 'Email address does not found!!',
            ]
        );
            $u=customer::where('email','=',$vali->email)->first();
            
            $mail= new notice();
            $mail->email =$vali->email;
            $mail->a_id =$vali->a_id;
            $mail->c_id =$u->id;
            $mail->user_type =$vali->user_type;
            $mail->subject =$vali->subject;
            $mail->message =$vali->message;
            $mail->save();
        }
        return redirect()->route('mail.sendNotice',['id'=>$mail->id]);
    }
    function aviewallnotice(){
        $notice = notice::all();
        return view('admin.aviewallnotice')->with('notices',$notice);
    }
    function aviewnotice($id){
        $notice = notice::where('id', $id)->first();
        return view('admin.aviewnotice')->with('notices',$notice);
    }
    function aeditnotice($id){
        $notice = notice::where('id', $id)->first();
        return view('admin.aeditnotice')->with('notices',$notice);
    }
    function aeditnoticeupdate(Request $vali){
        $this->validate($vali, [
            "subject"=>"required",
            "message"=>"required"
        ],
        []
    );
    $mail= notice::find($vali->id);
    $mail->subject =$vali->subject;
    $mail->message =$vali->message;
    $mail->update();

    session()->flash('msg','Update Completed');
    return redirect()->route('mail.updateNotice',['id'=>$mail->id]);
    }

    // function adeliveredorders(){
    //     $order = order::where('status', '=', 'Delivered')->get();
    //     // $order = order::all();
    //     return view('admin.adeliveredorders')->with('orders',$order);
    // }
    // function adeliveredorderdetails($id){
    //     $order = order::where('id', $id)->first();
    //     return view('admin.adeliveredorderdetails')->with('orders',$order);
    // }

    function deliveredorders(){
        $customers = customer::all();
        return view('admin.deliveredorders')->with('customers',$customers);
        }
     function pendingorders(){
            $customers = customer::all();
            return view('admin.pendingorders')->with('customers',$customers);
    }


    function aproducts(){
        $products = DB::table('products')->simplePaginate(5);
        return view('admin.aproducts', compact('products'));
    }
    function aaddproduct(){
        return view('admin.aaddproduct');
    }
    function aaddproductupdate(Request $vali){
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
        $p->size = $vali->size;
        $p->description = $vali->description;
        $p->v_id = Session()->get('id');
        $p->save();
        session()->flash('msg','Product Added');
        return redirect()->route('admin.aproducts');
    }

    function acoupons(){
        $c = coupon::all();
        return view('admin.acoupons')->with('coupons',$c);
    }
    function aeditcoupon($id){
        $c = coupon::where('id','=',$id)->first();
        return view('admin.aeditcoupon')->with('c',$c);
    }
    function aeditcouponupdate(Request $value){
        $this->validate($value, [
            "code" => "required",
            "amount" => "required"
        ],
        []
        );
        $c = coupon::where('id','=',$value->id)->first();
        $c->code=$value->code;
        $c->amount=$value->amount;
        $c->save();
        session()->flash('msg','Coupon Id '.$value->id.' Updated');
        return redirect()->route("admin.acoupons");;
    }
    function adeletecoupon($id){
        DB::delete('delete from customer_coupons where co_id = ?',[$id]);
        DB::delete('delete from coupons where id = ?',[$id]);
        $c = coupon::where('id','=',$id)->first();
        session()->flash('msg','Coupon Id '.$id.' Deletion Successful');
        return redirect()->route("admin.acoupons");
    }
    function addcoupon(){
        return view('admin.aaddcoupon');
    }
    function addcouponupdate(Request $value){
        $this->validate($value, [
            "codetype" => "required",
            "code" => "required",
            "amount" => "required"
        ],
        []
        );
        $c=new coupon();
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
        session()->flash('msg','Coupon Created');
        return redirect()->route("admin.acoupons");
    }
    function aassigncoupon(Request $req){
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
    function aapprovecoupon(){
        $c = DB::table('requested_coupons')->simplePaginate(15);
        return view('admin.aapprovecoupon', compact('c'));
    }
    function acouponapprove($id){

        $req = requested_coupon::where('id', $id)->first();

        $co = new coupon();
        $co->code = $req->code;
        $co->amount =$req->amount;
        $co->v_id = $req->v_id;
        $co->save();
        $req =DB::delete('delete from requested_coupons where id = ?',[$id]);
        // return redirect()->route('admin.aapprovecoupon');
        session()->flash('msg','Coupon Added');
        return back();
    }
    
    function acancelcoupon($id){

        $req =DB::delete('delete from requested_coupons where id = ?',[$id]);
        session()->flash('msg','Coupon Canceled');
        return back();
    }
    
}

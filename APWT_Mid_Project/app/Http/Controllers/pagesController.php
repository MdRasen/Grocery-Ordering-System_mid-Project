<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\review;

class pagesController extends Controller
{
    function home(){
        $products5 = [];
        $products10 = [];
        // $products = product::all();
        $products5 = product::where('id', '<=', 15)->get();
        $products10 = product::where('id', '>', 15)->where('id', '<=', 10)->get();
        return view("public.home")->with('products5', $products5)->with('products10', $products10);
    }
    function login(){return view("public.login");}
    function emaillogin(){return view("public.emaillogin");}
    function registration(){return view("public.registration");}
    function logout(){
        session()->flush();
        session()->flash('logoutMsg','User has been successfully logged out!');
        return redirect()->route("public.login");
    }    
    function forgotpassword(){return view("public.forgotpassword");} 
    function enterOTP(){return view("public.enterOTP");}
    function enternewpassword(){return view("public.enternewpassword");}

    function allproducts(){
        // $products = [];
        // $products = product::all();
        // return view("public.allproducts")->with('products', $products);

        $p = DB::table('products')->simplePaginate(8);
        return view('public.allproducts', compact('p'));
    }
    
    function products(){
        session()->forget('product_navbar');
        session()->forget('coupon_navbar');
        $p = DB::table('products')->simplePaginate(5);
 
        // return view('vendor.allproducts', compact('p'));
        return view('public.products', compact('p'));
    }
    function searchcategory($category){
        $products = product::where('category', '=', "$category")->get();
        return view("public.productsbycategory")->with('products', $products);
    }

    function searchproduct(Request $req){

        $this->validate($req, [
            "search_name" => "required",
        ],
        [
            'search_name.required' => 'Please enter any value!',
        ]
    );
    $search_name = $req->search_name;
    $products= product::where('name', 'like', '%'.$search_name.'%')->get();
    return view("public.searchproduct")->with('products', $products);
    }

    function viewproduct($id){
        $product = product::where('id', '=', $id)->first();
        // $reviews = review::where('p_id', '=', $id)->where('message', '!=', null)->get();

        $reviews = DB::table('reviews')
            ->join('customers', 'customers.id', '=', 'reviews.c_id')
            ->where('reviews.p_id', $id)
            ->where('reviews.message', '!=', null)
            ->get();

        return view("public.viewproduct")->with('item', $product)->with('reviews', $reviews);
    }
}

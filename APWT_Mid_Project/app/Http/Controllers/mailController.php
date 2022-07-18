<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin;
use App\Models\customer;
use App\Models\deliveryman;
use App\Models\req_deliveryman;
use App\Models\notice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\approveDeliveryman;
use App\Mail\sendNotice;


class mailController extends Controller
{
    function approvedeliverymanMail($id){

        $del = deliveryman::where('id', $id)->first();

        // Mail::to("arbhoa1@gmail.com")->send(new approveDeliveryman("Your request of deliveryman job has been confirmed!",$del->username));

        Mail::to([$del->email])->send(new approveDeliveryman("Your request of deliveryman job has been confirmed!",$del));

        session()->flash('adddeliveryman', "Deliveryman has been added!");
        return redirect()->route('admin.aaprovedeliveryman');
    }
    function sendNotice($id){

        $notice = notice::where('id', $id)->first();
        Mail::to("$notice->email")->send(new sendNotice($notice->subject,$notice->message));
        
        session()->flash('msg','Mail has been sent!!');
        return redirect()->route('admin.asendnotice');
    }
    function updateNotice($id){

        $notice = notice::where('id', $id)->first();
        Mail::to("$notice->email")->send(new sendNotice($notice->subject,$notice->message));
        
        session()->flash('msg','Update Completed');
        return redirect()->route('admin.aviewnotice',['id'=>$notice->id]);
    }
}

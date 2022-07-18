<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class confirmDelivery extends Mailable
{
    use Queueable, SerializesModels;

    public $sub;
    public $c_name;   
    public $p_name;    
    public $p_quantity; 
    public $c_address;
    public $d_id;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sub,$c_name,$p_name,$p_quantity,$c_address,$d_id)
    {
        $this->sub = $sub;
        $this->c_name = $c_name;   
        $this->p_name = $p_name;    
        $this->p_quantity = $p_quantity; 
        $this->c_address = $c_address; 
        $this->d_id = $d_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.confirmDelivery')
        ->with('c_name',$this->c_name)
        ->with('p_name',$this->p_name)
        ->with('p_quantity',$this->p_quantity)
        ->with('c_address',$this->c_address)
        ->with('d_id',$this->d_id)
        ->subject($this->sub);
    }
}

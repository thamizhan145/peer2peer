<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {

        $user = $req->session()->get('user');
        if($user['id']){
            return redirect('home');
        }else{
            return view('terms_condit');
        }
        
    }

    public function mailCheck()
    {
        $user = [
                "email" => "sakthivel@redblacktree.com", 
                "name" => "sakthivel@redblacktree.com"
            ];
            
        $kk = Mail::to($user)->send(new OrderShipped());


        echo "var :";
        var_dump($kk);

        echo "print :";

        print_r($kk);

        exit;

    }



    
}

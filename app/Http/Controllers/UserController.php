<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Mail\SuspendedMember;

class UserController extends Controller
{


	public function __construct()
	{
		$this->middleware('auth');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        /*     
        $user = $request->session()->get('user');        
        $users = User::all();
        return view('users_list',['u' => $users->toArray()]);
        */
        $users = DB::table('users')->get();
        return view('users_list', ['u' => $users->toArray()]);

    }


    public function addTestimonial(Request $req)
    {

        $user = $req->session()->get('user');

        $InData = [
            "content" => $req->get('msg'),
            "member_id" => $user['id'],
            "help_id" => $req->get('hid'),
        ];

        $added = DB::table('testimonial')->insert($InData);
        // var_dump($added);


        // Mark as Added - testimonial.
        $where1 = [
            'receiver_id' => $user['id'],
            'help_id' => $req->get('hid')
        ];

        $update1 = [
            'allow_to_write' => 2
        ];

        $upd_rec1 = DB::table('help_match')
            ->where($where1)
            ->update($update1);

        // var_dump($upd_rec1);



        return ["success" =>$added];
    }


    // Only to admin session
    public function suspendAccount(Request $req)
    {
        $user = $req->session()->get('user');

        if($req->get('uid') != $user['id'] && $user['role'] == 1){
            $userData = ['status'=>2];
            DB::table('users')
                        ->where('id', $req->get('uid'))
                        ->update($userData);
        }

        return redirect('users');
    }

    // Only to admin session
    public function activateAccount(Request $req)
    {
        
        $user = $req->session()->get('user');

        if($req->get('uid') != $user['id'] && $user['role'] == 1){
            $userData = ['status'=>1];
            DB::table('users')
                        ->where('id', $req->get('uid'))
                        ->update($userData);
        }

        return redirect('users');
    }

    // Not Used
    public function deleteAccount(Request $req)
    {
        $userData = ['isDeleted'=>1];
        DB::table('users')
                    ->where('id', $req->get('uid'))
                    ->update($userData);
        return redirect('users');
    }


    public function myprofile(Request $req)
    {
        $user = $req->session()->get('user');

        $myInfo = DB::table('users')
                    ->where('id', $user['id'])
                    ->select('fname','lname','email','phoneno','remail','role','status','created_at')
                    ->first();
        return view('myprofile', ['d'=>$myInfo]);
    }

    public function myrefs(Request $req)
    {
        $user = $req->session()->get('user');

        $myRefInfo = DB::table('referrals')
                    ->where('member_id', $user['id'])
                    ->join('users', 'users.id', '=', 'referrals.ref_id')
                    ->select('users.fname','users.lname','users.email','users.phoneno','referrals.*')
                    ->orderBy('referrals.id', 'desc')
                    ->get();

        return view('myrefs', ['d'=>$myRefInfo->toArray()]);
    }



    // Mail to Suport
    public function mailToSupport(Request $req)
    {
        $ToUser = [
            "email" => "s.sakthivel589@gmail.com", 
            "name" => "s.sakthivel589@gmail.com"
        ];

        $Req = [
            'uid' => $req->get('uid'),
            'msg' => $req->get('msg')
            ];

        $mailDet = new SuspendedMember($Req);
        $mailDet->msg = $req->get('msg');

        $kk = Mail::to($ToUser)->send($mailDet);


        echo "var :";
        var_dump($kk);

        echo "print :";

        print_r($kk);

        exit;

    }



}
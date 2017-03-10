<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

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

        $users = DB::table('testimonial')->insert($InData);

        return ["success" =>$users];
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
}
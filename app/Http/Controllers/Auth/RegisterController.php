<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'email' => 'required|email|max:50|unique:users',
            'password' => 'required|min:6|max:20|confirmed',
            'phoneno' => 'required|max:15',
            'remail' => 'required|email|max:50',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

        $inVal = User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phoneno' => $data['phoneno'],
            'remail' => $data['remail'],
        ]);

        if(!empty($data['remail'])){
            $this->addReferrals($data['remail'], $inVal->id);
        }

        return $inVal;

    }

    public function addReferrals($email, $uid)
    {
        $refMem = DB::table('users')
                        ->select('id')
                        ->where('email', $email)
                        ->get();
        $user = $refMem->toArray();
        if(count($user)){
            $inData = ['member_id' => $user[0]->id, 'ref_id' => $uid];
            DB::table('referrals')->insert($inData);
        }
    }
}

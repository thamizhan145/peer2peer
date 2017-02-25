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
        $users = DB::table('users')->paginate(2);
        return view('users_list', ['u' => $users]);

    }


    public function analysisHelp($uid)
    {

        $users = DB::table('help_members')->where('member_id', $uid)->first();

        $isProvidedHelp = false;
        $isAcceptProvidedHelp = false;
        $helpMatchGet = array(); 
        $helpMatchProvide = array(); 

        if($users){

            $isAcceptProvidedHelp = ($users['accept_receive'])?true:false;
            $isAcceptGetHelp = ($users['accept_receive'])?true:false;

            if($isAcceptGetHelp || $isAcceptProvidedHelp){

                // 1-Provide 2-Get
                if($users['status'] == 1){
                    // Member is Ready to provide help
                    // Check the help_match table IF any match assigned.

                    // Condition
                    $provide_condi = [
                        ['sender_id', $uid],
                        ['status' , 1]
                    ];
                    $helpMatchProvide = DB::table('help_match')->where($provide_condi)->get();

                }elseif ($users['status'] == 2) {

                    // Condition
                    $provide_condi = [
                        ['receiver_id', $uid],
                        ['status' , 2]
                    ];
                    $helpMatchGet = DB::table('help_match')->where($provide_condi)->get();
                    
                }
            }

        }

        return [
            'isProvidedHelp' => $isProvidedHelp, 
            'isAcceptProvidedHelp' => $isAcceptProvidedHelp, 
            'helpMatchGet' => $helpMatchGet,
            'helpMatchProvide' => $helpMatchProvide
            ];
    }



    public function gethelp(Request $request)
    {
        $user = $request->session()->get('user');
        $resp = $this->analysisHelp($user['id']);

        return view('help_get', ['d' => [$resp]]);     
    }

    public function receivehelp(Request $request)
    {
        $user = $request->session()->get('user');
        $resp = $this->analysisHelp($user['id']);

        return view('help_receive', ['d' => [$resp]]);     
    }


    public function getAllValidMembers()
    {

        // Select Both Get|Provide
        $Match = DB::table('help_members')
                        ->where('status', 1)
                        ->orWhere('status', 2)
                        ->get();

        $arrMatch = array('Get', 'Provide');
        foreach ($Match as $k => $v) {

            if($v['status'] == 1){
                $arrMatch['Get'][] = $v;
            }elseif{
                $arrMatch['Provide'][] = $v;
            }
        }

        return $arrMatch;
    }

    /*
    *   $Members = array()
    *   Sample :
        array(
            array('s_id'=>123, 'r_id'=>3214),
            array('s_id'=>123, 'r_id'=>524),
            array('s_id'=>223, 'r_id'=>6240)
        )
    */
    public function fixMatch($Members)
    {

        foreach ($Members as $key => $d) {
            
            $MatchData[] = [
                'sender_id' => $d['s_id'],
                'receiver_id' => $d['r_id'],
                'amount' =>  2500, // Should Goto Config
                'status' => 1
            ];
        }           

        $mId = DB::table('users')->insert($MatchData);

        return $mId;
    }


    public function autoMatch()
    {
        $arrAll = $this->getAllValidMembers();

        $arrMatchNow = array();
        $j = 0;
        foreach ($arrAll['get'] as $k1 => $v1) {

            // No.Of Help
            $count = $v1['eligible_for'];
            for ($i=1; $i <= $count; $i++) { 
                
                if(isset($arrAll['Provide'][$i])){
                    
                    $sender_id = $arrAll['Provide'][$j]['member_id'];
                    $receiver_id = $v1['member_id'];                
                    
                    $arrMatchNow[] = array('s_id'=>$sender_id, 'r_id' => $receiver_id);
                    $j++;
                }else{
                    return $arrMatchNow;
                }
                
            }
        }

        return $arrMatchNow;
    }




}
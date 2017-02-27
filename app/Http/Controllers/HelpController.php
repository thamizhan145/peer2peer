<?php 

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

// use Input;
// use Validator;
// use Redirect;
// use Session;


class HelpController extends Controller {


	public function __construct()
	{
		$this->middleware('auth');
	}



	public function makeMemberToGetHelp(Request $request){
		
		$resp = ['Success' => 0];
		$user = $request->session()->get('user');

		$uid = $request->get('id');

        if($user['role'] == 1){

	        $Data = DB::table('help_members')        
	                        ->where('member_id', $uid)
	                        ->get();
	        $userData = [
	        		'status' => 2,
	        		'eligible_for' => 2,
	        		'accept_get' => 1,
					'accept_get_on' => date('Y-m-d H:i:s', time())
				];


	        if(count($Data)){

	        	// echo "Update !!";

	        	$val = DB::table('help_members')
			            ->where('member_id', $uid)
			            ->update($userData);

			    // var_dump($val);

	        }else{
	        	$userData['member_id'] = $uid;
	        	//Do Insert
	        	DB::table('help_members')->insert($userData);
	        }
	        $resp['Success']=1; 
        }

        echo json_encode(['d' => $resp]);

	}

	public function analysisHelp($uid)
    {

        $users = DB::table('help_members')->where('member_id', $uid)->first();

        // print_r($users);
        // exit;

        $isAcceptGetHelp = false;
        $isAcceptProvidedHelp = false;
        $currentStatus = 0;
        $helpMatchGet = array(); 
        $helpMatchProvide = array();

        if($users){

            $isAcceptProvidedHelp = ($users->accept_provide)?true:false;
            $isAcceptGetHelp = ($users->accept_get)?true:false;

            if($isAcceptGetHelp || $isAcceptProvidedHelp){

                $currentStatus = $users->status;

                // 1-Provide 2-Get
                if($currentStatus == 1){
                    // Member is Ready to provide help
                    // Check the help_match table IF any match assigned.

                    // Condition
                    $provide_condi = [
                        ['sender_id', $uid],
                        ['help_match.status' , 1]
                    ];
                    $helpMatchProvide = DB::table('help_match')
                                        ->join('accounts', 'help_match.receiver_id', '=', 'accounts.user_id')
                                        ->join('users', 'help_match.receiver_id', '=', 'users.id')
                                        ->select('users.fname','users.lname','users.phoneno','help_match.*', 'accounts.*')
                                        ->where($provide_condi)
                                        ->get();

                    $helpMatchProvide = $helpMatchProvide->toArray();

                }elseif ($currentStatus == 2) {

                    // Condition
                    $get_condi = [
                        ['receiver_id', $uid],
                        ['help_match.status' , 1]
                    ];
                    $helpMatchGet = DB::table('help_match')
                                    ->join('users', 'help_match.sender_id', '=', 'users.id')
                                    ->select('users.fname','users.lname','users.phoneno','help_match.*')
                                    ->where($get_condi)
                                    ->get();

                    $helpMatchGet = $helpMatchGet->toArray();
                }
            }

        }

        return [
            'isAcceptGetHelp' => $isAcceptGetHelp, 
            'isAcceptProvidedHelp' => $isAcceptProvidedHelp, 
            'currentStatus' => $currentStatus,
            'helpMatchGet' => $helpMatchGet,
            'helpMatchProvide' => $helpMatchProvide
            ];
    }

    public function gethelp(Request $request)
    {

        $user = $request->session()->get('user');
        $resp = $this->analysisHelp($user['id']);

        return view('help_get', ['d' => $resp]);
    }

    public function providehelp(Request $request)
    {
        $user = $request->session()->get('user');
        $resp = $this->analysisHelp($user['id']);

        return view('help_provide', ['d' => $resp]);     
    }


    public function matching(Request $req)
    {
    	$resp = $this->getAllValidMembers();
        return view('matching_user', ['d' => $resp]);
    }


    public function getAllValidMembers()
    {

        // Select Both Get|Provide
        $Match = DB::table('help_members')
        				->join('users', 'users.id', '=', 'help_members.member_id')
        				->select('users.fname','users.lname','users.email', 'help_members.*')
                        ->whereIn('help_members.status', [1,2])
                        ->Where('onProcess', 0)
                        ->get();

        $arrMatch = array('Get'=>array(), 'Provide'=>array());

        foreach ($Match->toArray() as $k => $v) {

            if($v->status == 2){
                $arrMatch['Get'][] = $v;
            }elseif($v->status == 1){
                $arrMatch['Provide'][] = $v;
            }
        }

        return $arrMatch;
    }

    public function MatchUser(Request $req)
    {
        echo "<pre>";
        $pro = $req->get('provide_user');
        $get = $req->get('get_user');

        $arrPro = explode(',', $pro);
        $arrGet = explode(',', $get);

        $MatchArr = array();
        foreach ($arrPro as $k => $v) {
            $MatchArr[] = array('s_id'=>$v, 'r_id'=>$get);
        }

        $res = $this->fixMatch($MatchArr);

        $arrAll = array_merge($arrPro,$arrGet);

        $res_prcss = $this->markProcess($arrAll);

        return redirect('matching');

    }



    public function markProcess($mem)
    {

        $userData = ['onProcess'=>1];

        DB::table('help_members')
                    ->whereIn('member_id', $mem)
                    ->update($userData);
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

        $mId = DB::table('help_match')->insert($MatchData);

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


    public function uploadProof(Request $req)
    {

        echo "<pre>";
        // From Req
        $file = $req->file('file_proof');
        $help_id = $req->get('help_id');
        
        // From Session    
        $user = $req->session()->get('user');
        $sender_id = $user['id'];


        // Validate the Files here

        $destinationPath = storage_path().'/proof_uploads';
        $fileName = time().'_'.$file->getClientOriginalName();
        $kk = $file->move($destinationPath, $fileName);

        echo "Upload \n";
        var_dump($kk);


        $where = [
            'sender_id' => $sender_id,
            'help_id' => $help_id
        ];
        $update = [
            'proof' => $fileName,
        ];

        $upd = DB::table('help_match')
            ->where($where)
            ->update($update);
        
        var_dump($upd);

        exit;

    }


    public function ackTheHelp()
    {
        $help_id = $req->get('help_id');
        $sender_id = $req->get('sender_id');
        
        // From Session    
        $user = $req->session()->get('user');
        $receiver_id = $user['id'];

        $where = [
            'receiver_id' => $receiver_id,
            'help_id' => $help_id
        ];

        $update = [
            'receiver_ack' => 1,
            'status' => 2,
            'closed_on' => date('Y-m-d H:i:s')
        ];

        $upd_rec = DB::table('help_match')
            ->where($where)
            ->update($update);
        
        var_dump($upd);


        // Check Here This member GET help completed.
        // If yes - Make him as fresh member

        $where = ['receiver_id' => $receiver_id, 'status'=>1];
        $selectHelp = DB::table('help_match')
                        ->where($where)
                        ->get();

        if(count($selectHelp)){
            // Member Still Have Help

        }else{
            // Member Received all the Help
            $where = ['member_id' => $receiver_id];
            $update = [
                'onProcess' => 0, 
                'accept_get' => 0, 
                'accept_get_on' => NULL, 
                'accept_provide' => 0, 
                'accept_provide_on' => NULL, 
                'status'=> 0, 
                'eligible_for' => 0
                ]

            $upd_rec = DB::table('help_members')
                        ->where($where)
                        ->update($update);
        }

        // Complete this help
        if($upd_rec){
            //Provie Help is over, Make the sender ID to Get Help
            $where = ['member_id' => $sender_id];
            $update = ['onProcess' => 0, 'status'=> 2, 'eligible_for' => 2]

            $upd_rec = DB::table('help_members')
                        ->where($where)
                        ->update($update);
        }
        

        exit;

    }




    public function acceptProvideHelp(Request $request)
    {


        $user = $request->session()->get('user');
        $Data = DB::table('help_members')        
                        ->where('member_id', $user['id'])
                        ->get();
        $userData = [
                'status' => 1,
                'accept_provide' => 1,
                'accept_provide_on' => date('Y-m-d H:i:s', time())
            ];

        if(count($Data)){
            DB::table('help_members')
                    ->where('id', $user['id'])
                    ->update($userData);
        }else{
            //Do Insert
            $userData['member_id'] = $user['id'];
            DB::table('help_members')->insert($userData);
        }

        return redirect('providehelp');

    }


    public function acceptGetHelp(Request $request)
    {


        $user = $request->session()->get('user');
        $Data = DB::table('help_members')        
                        ->where('member_id', $user['id'])
                        ->get();
        $userData = [
                'status' => 1,
                'accept_get' => 1,
                'accept_get_on' => date('Y-m-d H:i:s', time())
            ];

        if(count($Data)){
            DB::table('help_members')
                    ->where('id', $user['id'])
                    ->update($userData);
        }else{
            //Do Insert
            $userData['member_id'] = $user['id'];
            DB::table('help_members')->insert($userData);
        }

        return redirect('gethelp');

    }


}
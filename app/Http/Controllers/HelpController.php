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


    public function index(Request $request)
    {
        $user = $request->session()->get('user');

        
        $resp = $this->analysisHelp($user['id']);

        $resp['acc'] = $this->checkAccount($user['id']);

        $resp['tm'] = $this->getTestimonial();
        
        return view('home', ['d' => $resp]);
    }



    public function getTestimonial()
    {
        $Data = DB::table('testimonial')        
                ->where('isDeleted', NULL)
                ->limit(5)
                ->get();

        return $Data->toArray();        
    }


    public function checkAccount($uid)
    {
        $AccData = DB::table('accounts')        
                ->where('user_id', $uid)
                ->get();

        return count($AccData);

    }


	public function makeMemberToGetHelp(Request $request){
		
		$resp = ['Success' => 0];
		$user = $request->session()->get('user');

        $uid = $request->get('uid');
        $Nofhelp = $request->get('Nofhelp');

        if($user['role'] == 1 && $uid){

	        $Data = DB::table('help_members')        
	                        ->where('member_id', $uid)
	                        ->get();
	        $userData = [
	        		'status' => 2,
	        		'eligible_for' => $Nofhelp,
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
	        $resp['Success'] = 1; 
        }else{

            $resp['Success'] = 0; 

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
                        // ['help_match.status' , 1]
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
                        // ['help_match.status' , 1]
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

        $pro = $req->get('p');
        $get = $req->get('g');

        $arrPro = explode(',', $pro);
        $arrGet = explode(',', $get);

        $MatchArr = array();
        foreach ($arrPro as $k => $v) {
            $MatchArr[] = array('s_id'=>$v, 'r_id'=>$get);
        }

        $res = $this->fixMatch($MatchArr);
        $arrAll = array_merge($arrPro,$arrGet);
        $res_prcss = $this->markProcess($arrAll);

        return ['Success' => 1];

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

        $user_eligible = array();
        foreach ($Members as $key => $d) {

            $user_eligible[$d['r_id']][] = $d;

            $MatchData[] = [
                'sender_id' => $d['s_id'],
                'receiver_id' => $d['r_id'],
                'amount' =>  2500, // Should Goto Config
                'status' => 1
            ];
        }

        foreach ($user_eligible as $user_id => $v) {

            // Run update query based on the No.of Help
            // echo "User : ".$user_id;
            // echo "\n";

            $eligible_tot = count($v);
            DB::table('help_members')->where('member_id', $user_id)
                                    ->update([
                                        'eligible_for' => DB::raw('eligible_for - '.$eligible_tot)
                                        ]);


            // Receiver Set Process
            // Check the number of Help Count with - If matched make process 1                
            $UserVal = DB::table('help_members')
                        ->select('eligible_for')
                        ->where('member_id', $user_id)
                        ->get();

            $UserArr = $UserVal->toArray();
            if(count($UserArr)){
                if($UserArr[0]->eligible_for == 0){
                    $res_prcss = $this->markProcess([$user_id]);
                }
            }

            // Sender Process 1 For the provider 
            $sender_ids = array_column($v, 's_id');
            if(count($sender_ids)){
                
                $this->markProcess($sender_ids);
            }
        }

        $mId = DB::table('help_match')->insert($MatchData);

        return $mId;
    }


    public function autoMatch(Request $req)
    {

        $user = $req->session()->get('user');

        if($user['role'] == 1){

            $arrAll = $this->getAllValidMembers();
            // echo "<pre>";
            // print_r($arrAll);

            $arrMatchNow = array();
            $j = 0;
            foreach ($arrAll['Get'] as $k1 => $v1) {

                // No.Of Help
                $count = $v1->eligible_for;
                for ($i=0; $i < $count; $i++) {
                    
                    if(isset($arrAll['Provide'][$j])){
                        
                        $sender_id = $arrAll['Provide'][$j]->member_id;
                        $receiver_id = $v1->member_id;                
                        
                        $arrMatchNow[] = array('s_id'=>$sender_id, 'r_id' => $receiver_id);
                        $j++;
                    }
                }
            }
        }

        if(count($arrMatchNow)){

            $this->fixMatch($arrMatchNow);
        }

        // print_r($arrMatchNow);
        // exit;
        return redirect('matching');
    }


    public function uploadProof(Request $req)
    {

        // echo "<pre>";
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

        // echo "Upload \n";
        // var_dump($kk);


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
        
        // var_dump($upd);

        // exit;

        return redirect('providehelp');

    }

    

    public function makeComplaint(){

        // From Session    
        $user = $req->session()->get('user');
        $receiver_id = $user['id'];

        $where = [
            'receiver_id' => $receiver_id,
            'help_id' => $help_id
        ];
        $update = [
            'complaint' => 1,
        ];

        $upd = DB::table('help_match')
            ->where($where)
            ->update($update);
    }

    public function checkAvailReferals($uid)
    {
        $where2 = ['member_id' => $uid, 'status'=>0, 'is_paid'=>1];
        $selectRef = DB::table('referrals')
        ->where($where2)
        ->get();
        if(count($selectRef) >= 5){
            // Add +1 to the get help
            return true;
        }
        return false;
    }

    public function removeAllReferral($uid)
    {
     
        // Suspend the receiver account.
        $update = ['is_rejected'=>1];
        $where = [' member_id'=>$uid];
        $upd_user = DB::table('referrals')
                        ->where($where)
                        ->update($update);   
    }


    public function ackTheHelp(Request $req)
    {
        $help_id = $req->get('help_id');
        $sender_id = $req->get('sender_id');
        
        $submit = $req->get('submit');

        $flag = ($submit == 'Yes')?2:3;

        // From Session
        $user = $req->session()->get('user');
        $receiver_id = $user['id'];

        $where1 = [
            'receiver_id' => $receiver_id,
            'help_id' => $help_id
        ];

        $update1 = [
            'receiver_ack' => 1,
            'status' => $flag,
            'closed_on' => date('Y-m-d H:i:s')
        ];

        $upd_rec1 = DB::table('help_match')
            ->where($where1)
            ->update($update1);
        
        var_dump($upd_rec1);

        $upd_rec = false;
        if($flag == 2){

            // Check Here This member GET help completed.
            // If yes - Make him as fresh member

            $where2 = ['receiver_id' => $receiver_id, 'status'=>1];
            $selectHelp = DB::table('help_match')
                            ->where($where2)
                            ->get();

            if(count($selectHelp)){
                // Member Still Have Help

            }else{
                // Member Received all the Help
                $where3 = ['member_id' => $receiver_id];
                $update3 = [
                    'onProcess' => 0, 
                    'accept_get' => 0, 
                    'accept_get_on' => NULL, 
                    'accept_provide' => 0, 
                    'accept_provide_on' => NULL, 
                    'status'=> 0, 
                    'eligible_for' => 0
                    ];

                $upd_rec = DB::table('help_members')
                            ->where($where3)
                            ->update($update3);
            }

            // Complete this help
            if($flag == 2){
                //Provie Help is over, Make the sender ID to Get Help
                $where4 = ['member_id' => $sender_id];
                $update4 = ['onProcess' => 0, 'status'=> 2, 'eligible_for' => 2];

                $upd_Help_mem = DB::table('help_members')
                            ->where($where4)
                            ->update($update4);

                var_dump($upd_Help_mem);

                // This is valid help, Make the member is_paid in referrals
                $referrals_update = DB::table('referrals')
                            ->where(['ref_id' => $sender_id])
                            ->update(['is_paid'=>1]);

                var_dump($referrals_update);
            }
            
        }else{

            // Suspend the receiver account.          
            $this->suspendAccount($sender_id);

            // Add +1 to the received account
            DB::table('help_members')->where('member_id', $receiver_id)
                                    ->update([
                                        'eligible_for' => DB::raw('eligible_for + 1')
                                        ]);

        }

        return redirect('gethelp');

    }



    public function suspendAccount($uid)
    {
        
        // Suspend the receiver account.
        $update = ['status'=>2];
        $where = ['id'=>$uid];
        $upd_user = DB::table('users')
                        ->where($where)
                        ->update($update);
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
                    ->where('member_id', $user['id'])
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
        
        // print_r($Data);
        // exit;

        $isRefAvl = $this->checkAvailReferals($user['id']);

        $nofhelp = ($isRefAvl == true)?3:2;

        $userData = [
                'status' => 2,
                'eligible_for' =>$nofhelp,
                'accept_get' => 1,
                'accept_provide' => 0,
                'accept_provide_on' => NULL,
                'accept_get_on' => date('Y-m-d H:i:s', time())
            ];

        if(count($Data)){
            // Update
            // echo "Update";
            $res = DB::table('help_members')
                    ->where('member_id', $user['id'])
                    ->update($userData);

            // var_dump($uu);
        }else{
            //Do Insert
            // echo "Insert";

            $userData['member_id'] = $user['id'];
            $res = DB::table('help_members')->insert($userData);

            // var_dump($ui);
        }

        if($res){
            $this->closeRefs($user['id']);
        }

        // echo "Here";
        // exit;


        return redirect('gethelp');

    }

    public function closeRefs($uid)
    {
        
        $upData = ["status" => 1];
        $res = DB::table('referrals')
                ->where('member_id', $uid)
                ->limit(5)
                ->update($upData);
    }


}
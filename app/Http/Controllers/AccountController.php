<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Account;

class AccountController extends Controller
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
        $user = $request->session()->get('user');
       
        $acc = DB::table('accounts')->where('user_id',$user['id'])->first();
        
        if($acc){
            return view('account',['acc' => $acc]);
        }else{
            return view('account_add');
        }
    }

    public function add(Request $request)
    {

        $kk = $request->session();
        $user = $request->session()->get('user');

        $this->validate($request, [
            'account_name' => 'required',
            'account_no' => 'required',
            'bank_name' => 'required',
            'account_type' => 'required'
        ]);

        $request['user_id'] = $user['id'];
        Account::create($request->all());

        $acc = DB::table('accounts')->where('user_id',$user['id'])->first();
        return view('account',['acc' => $acc]);

    }

    public function edit(Request $request)
    {        
        $user = $request->session()->get('user');
        $acc = DB::table('accounts')->where('user_id',$user['id'])->first();
        return view('account_edit',['acc' => $acc]);
    }


    public function update(Request $request)
    {
        
        $user = $request->session()->get('user');

        $this->validate($request, [
            'account_name' => 'required',
            'account_no' => 'required',
            'bank_name' => 'required',
            'account_type' => 'required'
        ]);
        
        unset($request['_token']);
        
        DB::table('accounts')
                    ->where('user_id',$user['id'])
                    ->update($request->all());

        $acc = DB::table('accounts')->where('user_id',$user['id'])->first();     
        return view('account', ['acc' => $acc]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ItemCRUD.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        Item::create($request->all());
        return redirect()->route('itemCRUD.index')
                        ->with('success','Item created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        return view('ItemCRUD.show',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_1($id)
    {
        $item = Item::find($id);
        return view('ItemCRUD.edit',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_1(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]);

        Item::find($id)->update($request->all());
        return redirect()->route('itemCRUD.index')
                        ->with('success','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::find($id)->delete();
        return redirect()->route('itemCRUD.index')
                        ->with('success','Item deleted successfully');
    }
}
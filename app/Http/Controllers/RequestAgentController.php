<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agent;
use App\Mail\RequestMail;
use App\Mail\ApprovalMail;
use App\Models\RequestAgen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\AgentRequestNotifications;

class RequestAgentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkrole:admin'])->except('create', 'store');
    }
    
    /*** Display a listing of the resource.
    */
    public function index()
    {
        $request = RequestAgen::all();
        Auth::user()->unreadNotifications->where('type', 'App\Notifications\AgentRequestNotifications')->markAsRead();
        
        return view('request-agent.index', compact('request'));
    }
    
    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        return view('request-agent.create');
    }
    
    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        /**dd($request->all());*/
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'propose'
        ]);
        
        $req = RequestAgen::create([
            'nama' => $request->nama,
            'nomor_kantor' => $request->nomor_kantor,
            'hp' => $request->hp,
            'designation' => $request->designation,
            'pic' => $request->pic,
            'alamat' => $request->address,
            'status' => 'pending',
            'user_id' => $user->id
        ]);
		$user = User::where('role', 'admin')->get();
		
		foreach($user as $use){
			$use->notify(new AgentRequestNotifications());
		};
        
        Mail::to($request->email)->send(new RequestMail);
        return redirect('login')->with('status', 'Proposal Berhasil Dikirimkan, Silahkan Tunggu Admin Mengkonfirmasi Proposal Anda');
    }
    
    /**
    * Display the specified resource.
    */
    public function show(string $id)
    {
        //
    }
    
    /**
    * Show the form for editing the specified resource.
    */
    public function edit(string $id)
    {
        //
    }
    
    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        //
    }
    
    /**
    * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        //
    }
    
    public function approval(Request $request)
    {
        if ($request->status == 'approve') {
            $req = RequestAgen::findorfail($request->id);
            $user = User::findorfail($req->user_id);
            $user->role = 'agent';
            $user->save();
            
            $agent = Agent::create([
                'nama' => $req->nama,
                'nomor_kantor' => $req->nomor_kantor,
                'hp' => $req->hp,
                'designation' => $req->designation,
                'pic' => $req->pic,
                'alamat' => $req->alamat,
                'user_id' => $user->id
            ]);
            Mail::to($user->email)->send(new ApprovalMail);
            $req->delete();
        } else {
            $req = RequestAgen::findorfail($request->id);
            $user = User::destroy($req->user_id);

            $req->delete();
        }

        $re = $request->all();
        
        return $re;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkrole:admin']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agent = Agent::all();
        
        return view('agent.index', compact('agent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $agent = Agent::findorfail($id);

        return view('agent.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $agent = Agent::findorfail($id);
        $agent->nama = $request->nama;
        $agent->alamat = $request->address;
        $agent->nomor_kantor = $request->nomor_kantor;
        $agent->pic = $request->pic;
        $agent->hp = $request->hp;
        $agent->designation = $request->designation;
        $agent->save();

        return redirect('agent')->with('status', 'Data successfully edited!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $agent = Agent::findorfail($id);
        User::destroy($agent->user_id);
        Agent::destroy($id);


        return redirect()->back()->with('status', 'Data successfully deleted!');
    }
}
 
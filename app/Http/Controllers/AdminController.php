<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
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
        $admin = Admin::all();
		
		return view('dashboard.admin', compact('admin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create_admin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
		$user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'admin'
        ]);
        
        $admin = new Admin;
        $admin->nama = $request->nama;
        $admin->alamat = $request->alamat;
		$admin->divisi = $request->divisi;
		$admin->hp = $request->hp;
		$admin->user_id = $user->id;
		$admin->save();
		
		return redirect('admin')->with('status', 'Data Succesfully Stored.');
       
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
        $admin = Admin::findorfail($id);
		
		return view('dashboard.edit_admin', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $admin = Admin::findorfail($id);
        $admin->nama = $request->nama;
        $admin->alamat = $request->alamat;
		$admin->divisi = $request->divisi;
		$admin->hp = $request->hp;
		$admin->save();
		
		$user = User::findorfail($admin->user_id);
        $user->name = $request->nama;
		$user->save();
		
		return redirect('admin')->with('status', 'Data Succesfuly Edited.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Admin::destroy($id);
		
		return redirect()->back()->with('status', 'Data Successfully Removed.');
    }
}

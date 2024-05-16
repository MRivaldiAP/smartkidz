<?php

namespace App\Http\Controllers;

use App\Models\FrontImage;
use Illuminate\Http\Request;

class FrontImageController extends Controller
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
        $bg = FrontImage::findorfail(1);
		
		return view('dashboard.front', compact('bg'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all(), $id);
		
		$front = FrontImage::findorfail($id);
		if($request->hasfile('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('logino/images'), $filename);
            $front->url_foto = $filename;
        }
		//dd($front);
		$front->save();
		
		return redirect()->back()->with('status', 'Login Poster Successfully Updated.' );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

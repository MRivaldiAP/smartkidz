<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RedeemItem;
use Illuminate\Http\Request;
use App\Models\RedeemConfirmation;
use Illuminate\Support\Facades\Auth;

class RedeemController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth', 'checkrole:admin'])->except('index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $redeem = RedeemItem::all();

        return view('redeem.index', compact('redeem'));
    }

    /**
     * Display a listing of the resource.
     */
    public function indexReq()
    {
        $request = RedeemConfirmation::where('status', 'pending')->get();
        $agent = User::all();
        $prize = RedeemItem::all();
        Auth::user()->unreadNotifications->where('type', 'App\Notifications\RedeemRequest')->markAsRead();
        
        return view('redeem.request', compact('request', 'agent', 'prize'));
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
        $redeem = new RedeemItem;
        $redeem->judul = $request->judul;
        $redeem->deskripsi = $request->deskripsi;
        $redeem->point = $request->point;
        if($request->hasfile('file')){
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('prize'), $filename);
            $redeem->url_foto = $filename;
        }
        $redeem->save();

        return redirect()->back();
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
}

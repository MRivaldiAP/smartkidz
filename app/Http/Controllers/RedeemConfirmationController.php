<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\RedeemItem;
use Illuminate\Http\Request;
use App\Models\RedeemHistory;
use App\Models\RedeemConfirmation;
use App\Notifications\RedeemRequest;

class RedeemConfirmationController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        //
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
        //dd($request->all());
		$item = RedeemItem::findorfail($request->prize);
		$agent = User::findorfail($request->agent);
		if($agent->point < $item->point){
			return redirect()->back()->with('error', 'You have insufficent amount of points');	
		}
		
        $req = new RedeemConfirmation;
        $req->agent = $request->agent;
        $req->prize = $request->prize;
        $req->status = 'pending';
        $req->save();
        $user = User::where('role', 'admin')->get();
        
        foreach($user as $use){
            $use->notify(new RedeemRequest());
        };
        
        return redirect()->route('redeem.index');
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
        //dd($request->all());
        if ($request->status == 'approve') {
            $req = RedeemConfirmation::findorfail($request->id);
            $req->status = 'approved';
            $req->save();
            
            $prize = RedeemItem::findorfail($req->prize);
            
            $user = User::findorfail($req->agent);
            $user->point -= $prize->point;
            $user->save();
            
            $today = Carbon::now();
            
            $history = new RedeemHistory;
            $history->booking_code = 'REDEEM';
            $history->tanggal = $today;
            $history->quantity = 1;
            $history->debit = -$prize->point;
            $history->point = $user->point;
            $history->user_id = $user->id;
            $history->remark = 'REDEEM PRODUCT '.$prize->judul;
            $history->save();
            
            return $request->all();

        } else if($request->status == 'decline') {
            $req = RedeemConfirmation::findorfail($request->id);
            $req->status = 'declined';
            $req->save();

            $prize = RedeemItem::findorfail($req->prize);
            $today = Carbon::now();
            $user = User::findorfail($req->agent);

            $history = new RedeemHistory;
            $history->booking_code = 'REDEEM';
            $history->tanggal = $today;
            $history->quantity = 0;
            $history->point = $user->point;
            $history->user_id = $user->id;
            $history->remark = 'REDEEM DECLINED ';
            $history->save();
            
            return $request->all();
        }
        
        
    }
}

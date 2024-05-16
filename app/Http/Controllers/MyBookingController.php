<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Agent;
use App\Models\Jadwal;
use App\Models\Booking;
use App\Models\RedeemHistory;
use Illuminate\Http\Request;

class MyBookingController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
        $agent = User::findorfail(auth()->user()->id);
        $booking = $agent->booking->where('paid', '>', 0)->sortByDesc('created_at');
        $bill = 0;
        foreach ($booking as $key) {
            $bill += ($key->total - $key->paid);
        }
        
        return view('booking.my_booking', compact('booking', 'bill'));
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
        $booking = Booking::findorfail($id);
        $id = $booking->jadwal_id;
        $jadwal = Jadwal::findorfail($booking->jadwal_id);
        $produk = $jadwal->produk;
        $user = User::findorfail($booking->user_id);
        $dewasa = unserialize($booking->dewasa);
        $cwb = unserialize($booking->cwb);
        $cwob = unserialize($booking->cwob);
        $infant = unserialize($booking->infant);
        $exclusion = unserialize($booking->exclusion);
        
        
        return view('booking.my_booking_edit', compact('jadwal', 'produk', 'id', 'user','dewasa', 'cwb', 'cwob', 'infant','exclusion', 'booking'));
    }
    
    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        $dewasa = [];
        $cwb = [];
        $cwob = [];
        $infant = [];
        $exclusion = [];
        
        for ($i=0; $i < count($request->title_dewasa); $i++) { 
            $filename = null;
            if($request->hasfile('file_dewasa')){
                $file = $request->file('file_dewasa');
                $filename = $file[$i]->getClientOriginalName();
                $file[$i]->move(public_path('foto-passport'), $filename);
            }
            $dewasa[] = array('title' => $request->title_dewasa[$i],
            'nama' => $request->nama_cust_dewasa[$i],
            'lahir' => $request->lahir_dewasa[$i],
            'no_passport' => $request->passport_dewasa[$i],
            'url_passport' => $filename,
            'remark' => $request->remark_dewasa[$i],
            'exp_passport' => $request->exp_dewasa[$i]);     
        }
        
        if(isset($request->title_cwb)) {
            for ($i=0; $i < count($request->title_cwb); $i++) { 
                $filename = null;
                if($request->hasfile('file_cwb')){
                    $file = $request->file('file_cwb');
                    $filename = $file[$i]->getClientOriginalName();
                    $file[$i]->move(public_path('foto-passport'), $filename);
                }
                $cwb[] = array('title' => $request->title_cwb[$i],
                'nama' => $request->nama_cust_cwb[$i],
                'lahir' => $request->lahir_cwb[$i],
                'no_passport' => $request->passport_cwb[$i],
                'url_passport' => $filename,
                'remark' => $request->remark_cwb[$i],
                'exp_passport' => $request->exp_cwb[$i]);     
            }
        }
        
        if(isset($request->title_cwob)) {
            for ($i=0; $i < count($request->title_cwob); $i++) {
                $filename = null;
                if($request->hasfile('file_cwob')){
                    $file = $request->file('file_cwob');
                    $filename = $file[$i]->getClientOriginalName();
                    $file[$i]->move(public_path('foto-passport'), $filename);
                }
                $cwob[] = array('title' => $request->title_cwob[$i],
                'nama' => $request->nama_cust_cwob[$i],
                'lahir' => $request->lahir_cwob[$i],
                'no_passport' => $request->passport_cwob[$i],
                'url_passport' => $filename,
                'remark' => $request->remark_cwob[$i],
                'exp_passport' => $request->exp_cwob[$i]);     
            }
        }
        
        if(isset($request->title_infant)) {
            for ($i=0; $i < count($request->title_infant); $i++) { 
                $filename = null;
                if($request->hasfile('file_infant')){
                    $file = $request->file('file_infant');
                    $filename = $file[$i]->getClientOriginalName();
                    $file[$i]->move(public_path('foto-passport'), $filename);
                }
                $infant[] = array('title' => $request->title_infant[$i],
                'nama' => $request->nama_cust_infant[$i],
                'lahir' => $request->lahir_infant[$i],
                'no_passport' => $request->passport_infant[$i],
                'url_passport' => $filename,
                'remark' => $request->remark_infant[$i],
                'exp_passport' => $request->exp_infant[$i]);     
            }
        }
        
        for ($i=0; $i < count($request->exclusion); $i++) { 
            $exclusion[] = array('nama' => $request->exclusion[$i],
            'harga' => $request->exclusion_rate[$i]);
        }
        $agent = Agent::where('user_id', auth()->user()->id)->first();
        
        $booking = Booking::findorfail($id); 
        $booking->dewasa = serialize($dewasa);
        $booking->cwb = serialize($cwb);
        $booking->cwob = serialize($cwob);
        $booking->infant = serialize($infant);
        $booking->save();
        
        return redirect('my-booking')->with('status', 'Data successfully edited!');
    }
    
    /**
    * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        // if delete, also delete allotment in jadwal
    }
    
    public function pay($id)
    {
        $booking = Booking::findorfail($id);
        $jadwal = Jadwal::findorfail($booking->jadwal_id);
        $produk = $jadwal->produk;
        $id = $jadwal->id;
        $user = User::findorfail(auth()->user()->id);
        $dewasa = unserialize($booking->dewasa);
        $cwb = unserialize($booking->cwb);
        $cwob = unserialize($booking->cwob);
        $infant = unserialize($booking->infant);
        $exclusion = unserialize($booking->exclusion);
        
        return view('booking.my_booking_pay', compact('jadwal', 'produk', 'id', 'user','dewasa', 'cwb', 'cwob', 'infant', 'exclusion', 'booking'));
    }
    
    public function payment(Request $request)
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        //dd($request->all());
        $booking = Booking::findorfail($request->book);
        $agent = Agent::where('user_id', auth()->user()->id)->first();
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = true;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => $booking->id.$randomString,
                'gross_amount' => $request->deposit,
            ),
            'customer_details' => array(
                'first_name' => 'Agent',
                'last_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => $agent->hp,
            ),
        );
        
        
        $deposit = $request->deposit;
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        
        return view('booking.my_booking_confirm', compact('snapToken', 'deposit', 'booking'));
    }
    
    public function payCounter(Request $request)
    {
        $booking = Booking::where('kode_booking', $request->kode)->first();
        
        if (!isset($booking)) {
            
            return redirect()->back()->with('error', 'The Booking Code You Entered Does Not Exist');
        } else {
            $booking = Booking::where('kode_booking', $request->kode)->first();
            $jadwal = Jadwal::findorfail($booking->jadwal_id);
            $produk = $jadwal->produk;
            $id = $jadwal->id;
            $user = User::findorfail($booking->user_id);
            $dewasa = unserialize($booking->dewasa);
            $cwb = unserialize($booking->cwb);
            $cwob = unserialize($booking->cwob);
            $infant = unserialize($booking->infant);
            $exclusion = unserialize($booking->exclusion);
            
            return view('booking.my_booking_counter', compact('jadwal', 'produk', 'id', 'user','dewasa', 'cwb', 'cwob', 'infant', 'exclusion', 'booking'));
        }
        
    }

    public function paymentCounter(Request $request)
    {
        //dd($request->all());
        $booking = Booking::findorfail($request->book);
        $agent = User::findorfail($booking->user_id);
        $jadwal = $booking->jadwal->point;
        $booking->paid += $request->deposit;
        $booking->save();

        if($booking->paid >= $booking->total)
        {
            $allotment = count(unserialize($booking->dewasa)) + count(unserialize($booking->cwb)) + count(unserialize($booking->cwob));
            $agent->point += ($jadwal * $allotment);
            $agent->save();
            
            
            $today = Carbon::now();
            
            $history = new RedeemHistory;
            $history->booking_code = $booking->kode_booking ?? '--';
            $history->group = $booking->jadwal->produk->judul ?? '--';
            $history->tanggal = $today;
            $history->quantity = $allotment;
            $history->kredit = $jadwal * $allotment;
            $history->point = $agent->point;
            $history->user_id = $agent->id;
            $history->save();
        }

        return redirect('jadwal')->with('status', 'Data successfully edited!');
    }
}

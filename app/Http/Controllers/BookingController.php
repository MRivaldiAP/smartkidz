<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Agent;
use App\Models\Jadwal;
use App\Models\Booking;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\RedeemHistory;
use App\Mail\BookingNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index(Request $request)
    {
        //dd($request->all());
		$currentDateTime = Carbon::now();
		//$currentDateTime = $currentDateTime->subDay();
        if(isset($request->reset)){
            $jadwal = Jadwal::where('tanggal', '>=', $currentDateTime)
    ->where(function ($query) {
        $query->where('everyday', 'no')
            ->orWhere(function ($subQuery) {
                $subQuery->where('everyday', 'yes')
                    ->whereIn('id', function ($subSubQuery) {
                        $subSubQuery->select(DB::raw('max(id)'))
                            ->from('jadwals as j2')
                            ->where('j2.everyday', 'yes')
                            ->groupBy('j2.produk_id');
                    });
            });
    })
    ->get();
			//dd($currentDateTime);
            $country = Produk::distinct()->pluck('country');
            $countra = Produk::distinct()->pluck('country');
            $negara = '';
            $bul = 0;
            return view('booking.index', compact('jadwal', 'country', 'negara', 'bul', 'countra'));
        }
        
        $query = Jadwal::query();
        $country = Produk::distinct()->pluck('country');
        $countra = Produk::distinct()->pluck('country');
        $negara = '';
        $bul = 0;
        if ($request->country != null) {
            $countryInput = $request->input('country');

    // Apply the condition on the related Produk model
    $query->whereHas('produk', function($query) use ($countryInput) {
        $query->where('country', $countryInput);
    });
            $negara = $request->input('country');
            $countra = [$request->input('country')];
        }
        
        if ($request->bulan != null) {
            $month = $request->input('bulan');
            $query->whereMonth('tanggal', $request->input('bulan'));
            $bul = $request->input('bulan');
        }
        
        // Add more conditions for other filters as needed...
        
        $jadwal = $query->where('tanggal', '>=', $currentDateTime)
    ->where(function ($query) {
        $query->where('everyday', 'no')
            ->orWhere(function ($subQuery) {
                $subQuery->where('everyday', 'yes')
                    ->whereIn('id', function ($subSubQuery) {
                        $subSubQuery->select(DB::raw('max(id)'))
                            ->from('jadwals as j2')
                            ->where('j2.everyday', 'yes')
                            ->groupBy('j2.produk_id');
                    });
            });
    })
    ->get();
        //dd($country);
        
        
        return view('booking.index', compact('jadwal', 'country', 'negara', 'bul', 'countra'));
    }
    
    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        return view('booking.create');
    }
    
    public function pick($id)
    {
        //dd($id);
        $jadwal = Jadwal::findorfail($id);
        $produk = $jadwal->produk;
        $user = User::findorfail(auth()->user()->id);
        $exclusion = unserialize($produk->exclusion);
        $type = 'optional';
        $ex_mandat = array_filter($exclusion, function ($var) use ($type) {
            return ($var['exclusion_type'] == 'mandatory');
        }); 
        $ex_optional = array_filter($exclusion, function ($var) use ($type) {
            return ($var['exclusion_type'] == $type);
        }); 
        
        
        return view('booking.create_alt', compact('jadwal', 'produk', 'id', 'user', 'ex_optional', 'ex_mandat'));
    }
    
    
    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        //dd($request->all());
        $id = $request->jadwal;
        $cwb = 0;
        $cwob = 0;
        $infant = 0;
        $jadwal = Jadwal::findorfail($request->jadwal);
		
		
		$alt = 0;
    if (now()->gt(\Carbon\Carbon::parse($jadwal->tanggal))) {
        $bookings = $jadwal->booking->where('status', '<>', 'cancel')->filter(function ($booking) {
            return $booking->paid >= $booking->total;
        });

        foreach ($bookings as $it) {
            $alt += count(unserialize($it->dewasa)) + count(unserialize($it->cwb)) + count(unserialize($it->cwob));
        }
    } else {
        $bookings = $jadwal->booking->where('status', '<>', 'cancel');
        foreach ($bookings as $it) {
            $alt += count(unserialize($it->dewasa)) + count(unserialize($it->cwb)) + count(unserialize($it->cwob));
        }
    }
		
		
		
        $produk = $jadwal->produk;
        $user = User::findorfail(auth()->user()->id);
        $dewasa = $request->dewasa;
		$alt += $dewasa;
        if(isset($request->cwb)){
            $cwb = $request->cwb;
			$alt += $cwb;
        }
        if(isset($request->cwob)){
            $cwob = $request->cwob;
			$alt += $cwob;
        }
        if(isset($request->infant)){
            $infant = $request->infant;
        }
        $exclusion = unserialize($produk->exclusion);
        $type = 'optional';
        $ex_mandat = array_filter($exclusion, function ($var) use ($type) {
            return ($var['exclusion_type'] == 'mandatory');
        }); 
        $ex_optional = array_filter($exclusion, function ($var) use ($type) {
            return ($var['exclusion_type'] == $type);
        }); 
        //dd($ex_optional);
		//dd($jadwal->allotment);
        if($alt > $jadwal->allotment){
		return redirect()->back()->with('error', 'The quota you requested exceeds the available quota.');	
		}
        return view('booking.create_2', compact('jadwal', 'produk', 'id', 'user','dewasa', 'cwb', 'cwob', 'infant', 'ex_optional', 'ex_mandat'));
    }
    
    public function step2(Request $request) 
    {
        //dd($request->all());
        $id = $request->jadwal;
        $jadwal = Jadwal::findorfail($request->jadwal);
        $produk = $jadwal->produk;
        $user = User::findorfail(auth()->user()->id);
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
            'exp_passport' => $request->exp_dewasa[$i],  
            'remark' => $request->remark_dewasa[$i],
            'url_passport' => $filename);
        }
        //dd($dewasa);
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
                'exp_passport' => $request->exp_cwb[$i],
                'remark' => $request->remark_cwb[$i],
                'url_passport' => $filename);
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
                'exp_passport' => $request->exp_cwob[$i],
                'remark' => $request->remark_cwob[$i],
                'url_passport' => $filename);
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
                'exp_passport' => $request->exp_infant[$i],
                'remark' => $request->remark_infant[$i],
                'url_passport' => $filename);
            }
        }
        
        for ($i=0; $i < count($request->exclusion); $i++) { 
            $exclusion[] = array('nama' => $request->exclusion[$i],
            'harga' => $request->exclusion_rate[$i], 'jumlah' => (int) $request->exclusion_num[$i]);
        }
        //dd($cwb, $cwob);
        return view('booking.create_3', compact('jadwal', 'produk', 'id', 'user','dewasa', 'cwb', 'cwob', 'infant', 'exclusion'));
        //dd($dewasa, $cwb, $exclusion);
    }
    
    public function step3(Request $request) 
    {
        //dd($request->all());
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';
        
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        $id = $request->jadwal;
        $jadwal = Jadwal::findorfail($request->jadwal);
        $produk = $jadwal->produk;
        $user = User::findorfail(auth()->user()->id);
        $dewasa = [];
        $cwb = [];
        $cwob = [];
        $infant = [];
        $exclusion = [];
        
        for ($i=0; $i < count($request->title_dewasa); $i++) { 
            $dewasa[] = array('title' => $request->title_dewasa[$i],
            'nama' => $request->nama_cust_dewasa[$i],
            'lahir' => $request->lahir_dewasa[$i],
            'no_passport' => $request->passport_dewasa[$i],
            'url_passport' => $request->url_passport_dewasa[$i],
            'remark' => $request->remark_dewasa[$i],
            'exp_passport' => $request->exp_dewasa[$i]);     
        }
        
        if(isset($request->title_cwb)) {
            for ($i=0; $i < count($request->title_cwb); $i++) { 
                $cwb[] = array('title' => $request->title_cwb[$i],
                'nama' => $request->nama_cust_cwb[$i],
                'lahir' => $request->lahir_cwb[$i],
                'no_passport' => $request->passport_cwb[$i],
                'url_passport' => $request->url_passport_cwb[$i],
                'remark' => $request->remark_cwb[$i],
                'exp_passport' => $request->exp_cwb[$i]);     
            }
        }
        
        if(isset($request->title_cwob)) {
            for ($i=0; $i < count($request->title_cwob); $i++) { 
                $cwob[] = array('title' => $request->title_cwob[$i],
                'nama' => $request->nama_cust_cwob[$i],
                'lahir' => $request->lahir_cwob[$i],
                'no_passport' => $request->passport_cwob[$i],
                'url_passport' => $request->url_passport_cwob[$i],
                'remark' => $request->remark_cwob[$i],
                'exp_passport' => $request->exp_cwob[$i]);     
            }
        }
        
        if(isset($request->title_infant)) {
            for ($i=0; $i < count($request->title_infant); $i++) { 
                $infant[] = array('title' => $request->title_infant[$i],
                'nama' => $request->nama_cust_infant[$i],
                'lahir' => $request->lahir_infant[$i],
                'no_passport' => $request->passport_infant[$i],
                'url_passport' => $request->url_passport_infant[$i],
                'remark' => $request->remark_infant[$i],
                'exp_passport' => $request->exp_infant[$i]);     
            }
        }
        
        for ($i=0; $i < count($request->exclusion); $i++) { 
            $exclusion[] = array('nama' => $request->exclusion[$i],
            'harga' => $request->exclusion_rate[$i], 'jumlah' => (int) $request->exclusion_num[$i]);
        }
        $agent = Agent::where('user_id', auth()->user()->id)->first();

        /// Backend for total
        $total = 0;

        $jumlahDewasa = count($dewasa);
        $jumlahCwb = count($cwb);
        $jumlahCwob = count($cwob);
        $jumlahInfant = count($infant);

        if ($jumlahDewasa == 1) {
            $total += $jadwal->single;
            $total += $jadwal->dewasa;
        } else {
            $total += ($jumlahDewasa * $jadwal->dewasa);
        }

        $total += $jumlahCwb * $jadwal->cwb;
        $total += $jumlahCwob * $jadwal->cwob;
        $total += $jumlahInfant * $jadwal->infant;
        foreach ($exclusion as $value) {
            $total += ($value['harga'] * $value['jumlah']);
        }

        $total -= ((count($dewasa)+count($cwb)+count($cwob)) * $jadwal->commission);
        
        //// /Backend for total

        $booking = new Booking; 
        $booking->judul = $request->jadwal;
        $booking->user_id = auth()->user()->id;
        $booking->dewasa = serialize($dewasa);
        $booking->cwb = serialize($cwb);
        $booking->cwob = serialize($cwob);
        $booking->infant = serialize($infant);
        $booking->exclusion = serialize($exclusion);
        $booking->allotment = count($dewasa) + count($cwb) + count($cwob);
        $booking->total = $request->total;
        $booking->jadwal_id = $request->jadwal;
        $booking->kode_booking = $randomString;
        $booking->status = 'cancel';
        $booking->save();
        
        dd($request->total, $total);
        
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => $booking->id,
                'gross_amount' => $request->deposit,
            ),
            'customer_details' => array(
                'first_name' => 'Agent',
                'last_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => $agent->hp,
            ),
        );
        
        DB::table('agent_booking')->insert([
            'user_id' => auth()->user()->id,
            'booking_id' => $booking->id
        ]);
        
        $deposit = $request->deposit;
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        //dd($snapToken);
        return view('booking.create_4', compact('jadwal', 'produk', 'id', 'user','dewasa', 'cwb', 'cwob', 'exclusion', 'snapToken', 'booking', 'deposit'));
        //dd($dewasa, $cwb, $exclusion);
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
    
    public function callback(Request $request)
    {
        $booking = Booking::findorfail(preg_replace("/[^0-9]/", "", $request->order_id));
        $jad = Jadwal::findorfail($booking->jadwal_id);
        $jadwal = $booking->jadwal->point;
        $agent = User::findorfail($booking->user_id);
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $booking = Booking::findorfail(preg_replace("/[^0-9]/", "", $request->order_id));
                $booking->paid += $request->gross_amount;
                $booking->save();
                
                if (ctype_digit($request->order_id)) {
                    $allotment = count(unserialize($booking->dewasa)) + count(unserialize($booking->cwb)) + count(unserialize($booking->cwob));
                    $jad->allotment_amt += $allotment;
                    $jad->save();
                    $booking->status = 'aktif';
                    $booking->save();
                    Mail::to($agent->email)->send(new BookingNotification($booking->kode_booking));
                }
                
                if(($booking->total - $booking->paid) <= 0)
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
            }
        }
    }
    
    public function invoice(string $id, Request $request) 
    {
        $booking = Booking::find($id) ?? Booking::where('kode_booking', $request->kode)->firstOrFail();

        $jadwal = Jadwal::findorfail($booking->jadwal_id);
        $agent = User::where('id', $booking->user_id)->first();
        $produk = $jadwal->produk;
        $dewasa = unserialize($booking->dewasa);
        $cwb = unserialize($booking->cwb);
        $cwob = unserialize($booking->cwob);
        $infant = unserialize($booking->infant);
        $exclusion = unserialize($booking->exclusion);
        
        return view('booking.invoice', compact('booking', 'dewasa', 'cwb', 'cwob', 'infant', 'exclusion', 'jadwal', 'produk', 'agent'));
    }
    
    public function getInvoice($id)
    {
        $booking = Booking::findorfail($id);
        $jadwal = Jadwal::findorfail($booking->jadwal_id);
        $agent = User::where('id', $booking->user_id)->first();
        $produk = $jadwal->produk;
        $dewasa = unserialize($booking->dewasa);
        $cwb = unserialize($booking->cwb);
        $cwob = unserialize($booking->cwob);
        $infant = unserialize($booking->infant);
        $exclusion = unserialize($booking->exclusion);
        
        $data = compact('booking', 'dewasa', 'cwb', 'cwob', 'infant', 'exclusion', 'jadwal', 'produk', 'agent');
        $pdf = app('dompdf.wrapper')->loadView('booking.print', $data);
        
        return $pdf->stream('invoice.pdf');
        
    }
    
    public function cancel(string $id)
    {
		
        $booking = Booking::findorfail($id);

        $jadwal = Jadwal::findorfail($booking->jadwal_id);
        $allotment = count(unserialize($booking->dewasa)) + count(unserialize($booking->cwb)) + count(unserialize($booking->cwob));
        //dd($jadwal);
        if ($booking->status == 'aktif') {
            $booking->status = 'cancel';
            $booking->save();
            
            $jadwal->allotment_amt -= $allotment;
            $jadwal->save();
            
            return redirect('booking/invoice/'.$booking->id)->with('status', 'Your Booking Successfully Canceled');
        } else {
            return redirect('booking/invoice/'.$booking->id)->with('error', 'Booking Status Have Already Canceled');
        }
        
    }
}

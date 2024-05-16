<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Jadwal;
use App\Models\Produk;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
		$currentDateTime = Carbon::now();
		
        $jadwal = Jadwal::where('tanggal', '>=', $currentDateTime)->get();
        
        $pre = Carbon::now()->format('Y/m/d');
        
        return view('jadwal.index', compact('jadwal', 'pre'));
    }
    
    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        $produk = Produk::all();
        $pre = Carbon::now()->format('Y/m/d');
        
        return view('jadwal/create', compact('produk', 'pre'));
    }
    
    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        //dd($request->all());
        if (isset($request->everyday)) {
            $dates = $request->dateranges;
            $date = explode(' - ', $dates);
            $startdate = new DateTime($date[0]);
            $enddate = new DateTime($date[1]);
            
            for ($i=$startdate; $i <= $enddate ; $i->modify('+1 day')) { 
                $jadwal = new Jadwal;
                $jadwal->produk_id = $request->produk_id;
                $jadwal->tanggal = $i;
                $jadwal->airlines = $request->airlines;
                $jadwal->dewasa = $request->dewasa;
                $jadwal->single = $request->single;
                $jadwal->cwb = $request->cwb;
                $jadwal->cwob = $request->cwob;
                $jadwal->infant = $request->infant;
                $jadwal->allotment = $request->allotment;
                $jadwal->min_departure = $request->min_departure;
                $jadwal->min_deposit = $request->min_deposit;
                $jadwal->starting = $request->starting;
                $jadwal->commission = $request->commission;
                $jadwal->point = $request->point;
                $jadwal->status = $request->status;
                $jadwal->everyday = 'yes';
                $edit_limit = clone $i;
                $edit_limit->modify('-3 days');
                $jadwal->edit_limit = $edit_limit;
                $jadwal->save();
            }
        } elseif (!isset($request->everyday) && ($request->daterange != null)) {
            $dates = $request->daterange;
            $date = explode(',', $dates);
            
            foreach ($date as $it) {
                $jadwal = new Jadwal;
                $jadwal->produk_id = $request->produk_id;

                $current_date = new DateTime($it);
                $edit_limit = clone $current_date;
                $edit_limit->modify('-3 days');
                
                $jadwal->tanggal = $current_date;
                $jadwal->edit_limit = $edit_limit;
                
                $jadwal->airlines = $request->airlines;
                $jadwal->dewasa = $request->dewasa;
                $jadwal->single = $request->single;
                $jadwal->cwb = $request->cwb;
                $jadwal->cwob = $request->cwob;
                $jadwal->infant = $request->infant;
                $jadwal->allotment = $request->allotment;
                $jadwal->min_departure = $request->min_departure;
                $jadwal->min_deposit = $request->min_deposit;
                $jadwal->starting = $request->starting;
                $jadwal->commission = $request->commission;
                $jadwal->point = $request->point;
                $jadwal->status = $request->status;
                $jadwal->save();
            }
        }
        
        //for($i = $startdate; $i <= $enddate; $i->modify('+1 day')){
            //echo $i->format("d-m-Y");
            //}
            //dd($startdate, $enddate);
            return redirect('jadwal')->with('status', 'Data successfully added!');
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
            $jadwal = Jadwal::findorfail($id);
            $produk = Produk::all();
            
            return view('jadwal.edit', compact('jadwal', 'produk'));
        }
        
        /**
        * Update the specified resource in storage.
        */
        public function update(Request $request, string $id)
        {
            $jadwal = Jadwal::findorfail($id);
            $jadwal->produk_id = $request->produk_id;
            $jadwal->tanggal = $request->daterange;
            $jadwal->airlines = $request->airlines;
            $jadwal->dewasa = $request->dewasa;
            $jadwal->single = $request->single;
            $jadwal->cwb = $request->cwb;
            $jadwal->cwob = $request->cwob;
            $jadwal->infant = $request->infant;
            $jadwal->allotment = $request->allotment;
            $jadwal->min_departure = $request->min_departure;
            $jadwal->min_deposit = $request->min_deposit;
            $jadwal->starting = $request->starting;
            $jadwal->commission = $request->commission;
            $jadwal->point = $request->point;
            $jadwal->status = $request->status;
            $jadwal->save();
            
            return redirect('jadwal')->with('status', 'Data successfully edited!');
        }
        
        /**
        * Remove the specified resource from storage.
        */
        public function destroy(string $id)
        {
            Jadwal::destroy($id);
            
            return redirect('jadwal')->with('status', 'Data successfully deleted!');
        }
        
        public function details(string $id)
        {
            $jadwal = Jadwal::findorfail($id);
			 $alt = 0;
                if(now()->gt(\Carbon\Carbon::parse($jadwal->tanggal))){
                  $bookings = $jadwal->booking->where('status', '<>', 'cancel')->filter(function ($booking) {
                    return $booking->paid >= $booking->total;
                  });
                  
                } else {
                  $bookings = $jadwal->booking->where('status', '<>', 'cancel');
                }
            $produk = $jadwal->produk;
            $list = [];
            
            foreach ($bookings as $book) {
                $status = '';
                if ($book->paid >= $book->total) {
                    $status = 'Payment Completed';
                } else {
                    $status = 'Payment in Progress';
                }
                
                $agent = User::findorfail($book->user_id)->name;
                $de = unserialize($book->dewasa);
                $cwb = unserialize($book->cwb);
                $cwob = unserialize($book->cwob);
                $infant = unserialize($book->infant);
                
                foreach ($de as $d) {
                    $list[] = array('type'=>'Adult', 'kode' => $book->kode_booking, 'status'=>$status, 'agent'=>$agent, 'title' => $d['title'], 'nama' => $d['nama'], 'lahir' => $d['lahir'], 'no_passport' => $d['no_passport'], 'exp_passport' => $d['exp_passport'], 'url_passport'=>$d['url_passport'] ?? null, 'remark'=>$d['remark'] ?? null);
                }
                foreach ($cwb as $d) {
                    $list[] = array('type'=>'Child With Bed','kode' => $book->kode_booking, 'status'=>$status, 'agent'=>$agent, 'title' => $d['title'], 'nama' => $d['nama'], 'lahir' => $d['lahir'], 'no_passport' => $d['no_passport'], 'exp_passport' => $d['exp_passport'], 'url_passport'=>$d['url_passport'] ?? null, 'remark'=>$d['remark'] ?? null);
                }
                foreach ($cwob as $d) {
                    $list[] = array('type'=>'Child No Bed','kode' => $book->kode_booking, 'status'=>$status, 'agent'=>$agent, 'title' => $d['title'], 'nama' => $d['nama'], 'lahir' => $d['lahir'], 'no_passport' => $d['no_passport'], 'exp_passport' => $d['exp_passport'], 'url_passport'=>$d['url_passport'] ?? null, 'remark'=>$d['remark'] ?? null);
                }
                foreach ($infant as $d) {
                    $list[] = array('type'=>'Infant','kode' => $book->kode_booking, 'status'=>$status, 'agent'=>$agent, 'title' => $d['title'], 'nama' => $d['nama'], 'lahir' => $d['lahir'], 'no_passport' => $d['no_passport'], 'exp_passport' => $d['exp_passport'], 'url_passport'=>$d['url_passport'] ?? null, 'remark'=>$d['remark'] ?? null);
                }
            }
            
            return view('jadwal.details', compact('list', 'jadwal', 'produk'));
            //dd($list);
        }

        public function editLimit(Request $request)
        {
            $jadwal = Jadwal::findorfail($request->id);
            $jadwal->edit_limit = $request->status;
            $jadwal->save();

            return $request->all();
        }
    }
    
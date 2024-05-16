<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth', 'checkrole:admin,agent']);
    }
    /**
    * Display a listing of the resource.
    */
    public function index()
    {
		$user = User::all();
        if (auth()->user()->role == 'admin') {
            $currentDate = Carbon::now();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $bookings = Booking::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->get();
        
        $currentMonthStart = Carbon::now()->startOfMonth();
        
        // Get the first day of the previous monthy
        $lastMonthStart = $currentMonthStart->subMonth();
        
        // Get the last day of the previous month
        $lastMonthEnd = $lastMonthStart->copy()->endOfMonth();
        
        // Retrieve bookings created within the previous month
        $bookinglast = Booking::whereDate('created_at', '>=', $lastMonthStart)
        ->whereDate('created_at', '<=', $lastMonthEnd)
        ->get();
		
		$active = collect();
		$book = collect();
		$cancel = collect();
		$jad = Jadwal::all();
		$jid = Jadwal::where('tanggal','<',$currentDate)->get();
		$jud = Jadwal::where('tanggal','>=',$currentDate)->get();
		//dd($jid);
		
		foreach ($jud as $item) {
    		$bookungs = $item->booking->where('status', '<>', 'cancel');

    		//if (now()->gt(\Carbon\Carbon::parse($item->tanggal))) {
        		//$bookings = $bookings->filter(function ($booking) {
            		//return $booking->paid >= $booking->total;
        			//});
    		//}
			$active = $active->concat($bookungs);
		}
		
		foreach ($jad as $item) {
    		$bookengs = $item->booking->where('status', '<>', 'cancel');

    		if (now()->gt(\Carbon\Carbon::parse($item->tanggal))) {
        		$bookengs = $bookengs->filter(function ($booking) {
            		return $booking->paid >= $booking->total;
        			});
    		}
			$book = $book->concat($bookengs);
		}
		
		foreach ($jad as $item) {
    		$bookongs = $item->booking->where('status', 'cancel');
			//$baakings = $item->booking->where('status', '<>', 'cancel');
    		//if (now()->gt(\Carbon\Carbon::parse($item->tanggal))) {
        //$baakings = $baakings->filter(function ($booking) {
            //return $booking->paid < $booking->total && $booking->jadwal->tanggal < now();
        //});
			//}
			$cancel = $cancel->concat($bookongs);
			//dd($cancel);
			//$cancel = $cancel->concat($baakings);
			
		}
		
		foreach ($jid as $item) {
			$baakings = $item->booking->where('status', 'aktif');
    		if (now()->gt(\Carbon\Carbon::parse($item->tanggal))) {
        $baakings = $baakings->filter(function ($booking) {
            return $booking->paid < $booking->total;
        });
			}
			//$cancel = $cancel->concat($bookings);
			//dd($cancel);
			$cancel = $cancel->concat($baakings);
			
		}
        //dd($cancel);
		
			
        //$book = Booking::where('status','<>','cancel')->get();
        $tot =0;
        foreach ($book as $key) {
            if ($key->total - $key->paid >0) {
                $tot += 1;
            } 
        }
		$tat =0;
        foreach ($book as $key) {
            if ($key->total - $key->paid <= 0) {
                $tat += 1;
            } 
        }

        $jadwal = Jadwal::whereRaw('jadwals. allotment_amt >= jadwals.min_departure')->whereDate('tanggal', '>=', date('Y-m-d'))->orderBy('tanggal', 'asc')->get();
        
    } else {
            $currentDate = Carbon::now();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $bookings = Booking::whereYear('created_at', $currentYear)
        ->whereMonth('created_at', $currentMonth)
        ->where('user_id', auth()->user()->id)->get();
        
        $currentMonthStart = Carbon::now()->startOfMonth();
        
        // Get the first day of the previous monthy
        $lastMonthStart = $currentMonthStart->subMonth();
        
        // Get the last day of the previous month
        $lastMonthEnd = $lastMonthStart->copy()->endOfMonth();
        
        // Retrieve bookings created within the previous month
        $bookinglast = Booking::whereDate('created_at', '>=', $lastMonthStart)
        ->whereDate('created_at', '<=', $lastMonthEnd)->where('user_id', auth()->user()->id)
        ->get();
		
		$active = collect();
		$book = collect();
		$cancel = collect();
		$jad = Jadwal::all();
		$jid = Jadwal::where('tanggal','<',$currentDate)->get();
		$jud = Jadwal::where('tanggal','>=',$currentDate)->get();
		//dd($jid);
		
		foreach ($jud as $item) {
    		$bookungs = $item->booking->where('status', '<>', 'cancel')->where('user_id', auth()->user()->id);

    		//if (now()->gt(\Carbon\Carbon::parse($item->tanggal))) {
        		//$bookings = $bookings->filter(function ($booking) {
            		//return $booking->paid >= $booking->total;
        			//});
    		//}
			$active = $active->concat($bookungs);
		}
		
		foreach ($jad as $item) {
    		$bookengs = $item->booking->where('status', '<>', 'cancel')->where('user_id', auth()->user()->id);

    		if (now()->gt(\Carbon\Carbon::parse($item->tanggal))) {
        		$bookengs = $bookengs->filter(function ($booking) {
            		return $booking->paid >= $booking->total;
        			});
    		}
			$book = $book->concat($bookengs);
		}
		
		foreach ($jad as $item) {
    		$bookongs = $item->booking->where('status', 'cancel')->where('user_id', auth()->user()->id);
			//$baakings = $item->booking->where('status', '<>', 'cancel');
    		//if (now()->gt(\Carbon\Carbon::parse($item->tanggal))) {
        //$baakings = $baakings->filter(function ($booking) {
            //return $booking->paid < $booking->total && $booking->jadwal->tanggal < now();
        //});
			//}
			$cancel = $cancel->concat($bookongs);
			//dd($cancel);
			//$cancel = $cancel->concat($baakings);
			
		}
		
		foreach ($jid as $item) {
			$baakings = $item->booking->where('status', 'aktif')->where('user_id', auth()->user()->id);
    		if (now()->gt(\Carbon\Carbon::parse($item->tanggal))) {
        $baakings = $baakings->filter(function ($booking) {
            return $booking->paid < $booking->total;
        });
			}
			//$cancel = $cancel->concat($bookings);
			//dd($cancel);
			$cancel = $cancel->concat($baakings);
			
		}
        //dd($cancel);
		
			
        //$book = Booking::where('status','<>','cancel')->get();
        $tot =0;
        foreach ($book as $key) {
            if ($key->total - $key->paid >0) {
                $tot += 1;
            } 
        }
		$tat =0;
        foreach ($book as $key) {
            if ($key->total - $key->paid <= 0) {
                $tat += 1;
            } 
        }

        $jadwal = Jadwal::whereRaw('jadwals. allotment_amt >= jadwals.min_departure')->whereDate('tanggal', '>=', date('Y-m-d'))->orderBy('tanggal', 'asc')->get();
        }
        
		

        return view('dashboard.index', compact('bookings', 'bookinglast', 'tot', 'book', 'jadwal', 'tat', 'cancel', 'active', 'user'));
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

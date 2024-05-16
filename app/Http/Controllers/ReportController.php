<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'checkrole:admin,agent']);
    }
    /**
    * Display a listing of the resource.
    */
    public function index(Request $request)
    {
        $currentDate = Carbon::now();
        
        if (auth()->user()->role == 'admin') {
            if (isset($request->reset)) {
                /*$query = DB::table('users')
                ->join('bookings', 'users.id', '=', 'bookings.user_id')
                ->select('users.id', 'users.name', DB::raw('SUM(bookings.total) as sales'), DB::raw('COUNT(*) as qty'))
                ->where('bookings.status', '<>', 'cancel');*/
                $agent = collect();
                
                $jadwal = Jadwal::all();
                foreach ($jadwal as $item) {
                    $bookengs = $item->booking->where('status', '<>', 'cancel')->filter(function ($booking) {
                        return $booking->paid >= $booking->total;
                    });
                    $agent = $agent->concat($bookengs);
                }
                $agent = $agent->groupBy('user_id');
                
                $summedAgent = $agent->map(function ($bookings) {
                    $sumPaid = $bookings->sum('paid');
                    return $sumPaid;
                });
                $user = User::all();
                //$agent = $query->groupBy('users.id', 'users.name')->get();
                
                //dd($summedAgent);
                return view('laporan.index', compact('agent', 'user', 'summedAgent'));
            }
            
            $inputStartDate = $request->cr_from;
            $inputEndDate = $request->cr_to;
            $endDate = Carbon::parse($inputEndDate)->addDay();
            $startJourney = $request->st_from;
            $endJourney = $request->st_to;
            $endDate2 = Carbon::parse($endJourney)->addDay();
            
            /*$query = DB::table('users')
            ->join('bookings', 'users.id', '=', 'bookings.user_id')
            ->join('jadwals', 'bookings.jadwal_id', '=', 'jadwals.id')
            ->select('users.id', 'users.name', DB::raw('SUM(bookings.total) as sales'), DB::raw('COUNT(*) as qty'))
            ->where('bookings.status', '<>', 'cancel');*/
            $agent = collect();
            
            $jadwal = Jadwal::all();
            foreach ($jadwal as $item) {
                $bookengs = $item->booking->where('status', '<>', 'cancel')->filter(function ($booking) {
                    return $booking->paid >= $booking->total;
                });
                if ($inputStartDate && $inputEndDate) {
                    $bookengs = $bookengs->filter(function ($booking) use ($inputStartDate, $inputEndDate) {
                        return $booking->created_at >= $inputStartDate && $booking->created_at <= $inputEndDate;
                    });
                }
                
                if ($startJourney && $endJourney) {
                    $bookengs = $bookengs->filter(function ($booking) use ($startJourney, $endJourney) {
                        return $booking->jadwal->tanggal >= $startJourney && $booking->jadwal->tanggal <= $endJourney;
                    });
                }
                $agent = $agent->concat($bookengs);
            }
            
            /* Add date filter if start and end date are provided
            if ($inputStartDate && $inputEndDate) { 
                $query = $query->whereBetween('bookings.created_at', [$inputStartDate, $endDate]);
            }
            if ($startJourney && $endJourney) { 
                $query = $query->whereBetween('jadwals.tanggal', [$startJourney, $endDate2]);
            }*/
            
            $agent = $agent->groupBy('user_id');
            $summedAgent = $agent->map(function ($bookings) {
                $sumPaid = $bookings->sum('paid');
                return $sumPaid;
            });
            $user = User::all();
            return view('laporan.index', compact('agent','inputStartDate', 'inputEndDate', 'startJourney', 'endJourney', 'user', 'summedAgent'));
        } else {
            if (isset($request->reset)) {
                /*$query = DB::table('users')
                ->join('bookings', 'users.id', '=', 'bookings.user_id')
                ->select('users.id', 'users.name', DB::raw('SUM(bookings.total) as sales'), DB::raw('COUNT(*) as qty'))
                ->where('bookings.status', '<>', 'cancel');*/
                $agent = collect();
                
                $jadwal = Jadwal::all();
                foreach ($jadwal as $item) {
                    $bookengs = $item->booking->where('status', '<>', 'cancel')->where('user_id', auth()->user()->id)->filter(function ($booking) {
                        return $booking->paid >= $booking->total;
                    });
                    $agent = $agent->concat($bookengs);
                }
                $agent = $agent->groupBy('user_id');
                
                $summedAgent = $agent->map(function ($bookings) {
                    $sumPaid = $bookings->sum('paid');
                    return $sumPaid;
                });
                $user = User::all();
                //$agent = $query->groupBy('users.id', 'users.name')->get();
                
                //dd($summedAgent);
                return view('laporan.index', compact('agent', 'user', 'summedAgent'));
            }
            
            $inputStartDate = $request->cr_from;
            $inputEndDate = $request->cr_to;
            $endDate = Carbon::parse($inputEndDate)->addDay();
            $startJourney = $request->st_from;
            $endJourney = $request->st_to;
            $endDate2 = Carbon::parse($endJourney)->addDay();
            
            /*$query = DB::table('users')
            ->join('bookings', 'users.id', '=', 'bookings.user_id')
            ->join('jadwals', 'bookings.jadwal_id', '=', 'jadwals.id')
            ->select('users.id', 'users.name', DB::raw('SUM(bookings.total) as sales'), DB::raw('COUNT(*) as qty'))
            ->where('bookings.status', '<>', 'cancel');*/
            $agent = collect();
            
            $jadwal = Jadwal::all();
            foreach ($jadwal as $item) {
                $bookengs = $item->booking->where('status', '<>', 'cancel')->where('user_id', auth()->user()->id)->filter(function ($booking) {
                    return $booking->paid >= $booking->total;
                });
                if ($inputStartDate && $inputEndDate) {
                    $bookengs = $bookengs->filter(function ($booking) use ($inputStartDate, $inputEndDate) {
                        return $booking->created_at >= $inputStartDate && $booking->created_at <= $inputEndDate;
                    });
                }
                
                if ($startJourney && $endJourney) {
                    $bookengs = $bookengs->filter(function ($booking) use ($startJourney, $endJourney) {
                        return $booking->jadwal->tanggal >= $startJourney && $booking->jadwal->tanggal <= $endJourney;
                    });
                }
                $agent = $agent->concat($bookengs);
            }
            
            /* Add date filter if start and end date are provided
            if ($inputStartDate && $inputEndDate) { 
                $query = $query->whereBetween('bookings.created_at', [$inputStartDate, $endDate]);
            }
            if ($startJourney && $endJourney) { 
                $query = $query->whereBetween('jadwals.tanggal', [$startJourney, $endDate2]);
            }*/
            
            $agent = $agent->groupBy('user_id');
            $summedAgent = $agent->map(function ($bookings) {
                $sumPaid = $bookings->sum('paid');
                return $sumPaid;
            });
            $user = User::all();
            return view('laporan.index', compact('agent','inputStartDate', 'inputEndDate', 'startJourney', 'endJourney', 'user', 'summedAgent'));
        }
        
        
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

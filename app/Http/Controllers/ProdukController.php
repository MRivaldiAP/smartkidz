<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
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
        $produk = Produk::all();
        
        return view('produk.index', compact('produk'));
    }
    
    /**
    * Show the form for creating a new resource.
    */
    public function create()
    {
        return view('produk.create');
    }
    
    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        //dd($request->all());
        $produk = new Produk;
        $produk->judul = $request->judul;
        $produk->kode = $request->kode;
		$produk->country = $request->country;
        $itenary = [];
        for ($i=0; $i < count($request->hari); $i++) { 
            $itenary[] = array('hari' => $request->hari[$i], 'lokasi' => $request->lokasi[$i], 'deskripsi' => $request->deskripsi[$i],
            'breakfast' => isset($request->br[$i]) ? $request->br[$i] : null, 'lunch' => isset($request->lun[$i]) ? $request->lun[$i] : null,
            'dinner' => isset($request->din[$i]) ? $request->din[$i] : null, 'flight' => $request->flight[$i]);
        };
        $produk->itinerary = serialize($itenary);
        $exclusion = [];
        for ($i=0; $i < count($request->exclusion); $i++) { 
            $exclusion[] = array('exclusion' => $request->exclusion[$i], 'exclusion_rate' => $request->exclusion_rate[$i], 'exclusion_type' => $request->exclusion_type[$i]);
        };
        $produk->inclusion = $request->inclusion;
        $produk->exclusion = serialize($exclusion);

        if($request->hasfile('file')){
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('poster'), $filename);
            $produk->url_poster = $filename;
        }

        if($request->hasfile('file_iti')){
            $file = $request->file('file_iti');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('itinerary'), $filename);
            $produk->url_iti = $filename;
        }
        $produk->save();

        //dd($itenary);

        return redirect('produk')->with('status', 'Data successfully added!');
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
        $produk = Produk::findorfail($id);
        $itinerary = unserialize($produk->itinerary);
        $exclusion = unserialize($produk->exclusion);
        $keys = array_column($itinerary, 'hari');
        array_multisort($keys, SORT_ASC, $itinerary);
        //dd($itinerary);

        return view('produk.edit', compact('produk', 'itinerary', 'exclusion'));
    }
    
    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $produk = Produk::findorfail($id);
        $produk->judul = $request->judul;
		$produk->country = $request->country;
        $produk->kode = $request->kode;
        $itenary = [];
        for ($i=0; $i < count($request->hari); $i++) { 
            $itenary[] = array('hari' => $request->hari[$i], 'lokasi' => $request->lokasi[$i], 'deskripsi' => $request->deskripsi[$i],
            'breakfast' => isset($request->br[$i]) ? $request->br[$i] : null, 'lunch' => isset($request->lun[$i]) ? $request->lun[$i] : null,
            'dinner' => isset($request->din[$i]) ? $request->din[$i] : null, 'flight' => $request->flight[$i]);
        };
        $produk->itinerary = serialize($itenary);
        $exclusion = [];
        for ($i=0; $i < count($request->exclusion); $i++) { 
            $exclusion[] = array('exclusion' => $request->exclusion[$i], 'exclusion_rate' => $request->exclusion_rate[$i], 'exclusion_type' => $request->exclusion_type[$i]);
        };
        $produk->inclusion = $request->inclusion;
        $produk->exclusion = serialize($exclusion);
        if($request->hasfile('file')){
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('poster'), $filename);
            $produk->url_poster = $filename;
        }

        if($request->hasfile('file_iti')){
            $file = $request->file('file_iti');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('itinerary'), $filename);
            $produk->url_iti = $filename;
        }
        $produk->save();

        return redirect('produk')->with('status', 'Data successfully edited!');
    }
    
    /**
    * Remove the specified resource from storage.
    */
    public function destroy(string $id)
    {
        $produk = Produk::findorfail($id);
        $produk->jadwal()->delete();

        Produk::destroy($id);

        return redirect()->back()->with('status', 'Data successfully deleted!');
    }
}

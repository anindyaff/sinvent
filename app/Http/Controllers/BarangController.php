<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;
// use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ValidatesRequests;
    
    public function index(Request $request)
    {
        /* tanpa pagination
        $Barang = Barang::all();        
        return view('view_barang.index01',compact('Barang'));
        */

        /* ada pagination */
        $rsetBarang = Barang::latest()->paginate(10);        
        return view('v_barang.index',compact('rsetBarang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriOptions= Kategori::all();
        // return view('v_barang.create' compact('kategoriOptions'));
        return view('v_barang.create', compact('kategoriOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;

       // dd("");
        //validate form
        $this->validate($request, [
            'merk'    => 'required',
            'seri'     => 'required',
            'spesifikasi'     => 'required',
            'kategori_id'  => 'required',
            // 'kelas'   => 'required|not_in:blank',
            // 'rombel'  => 'required',
        //     'foto'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // //upload image
        // $foto = $request->file('foto');
        // $foto->storeAs('public/foto', $foto->hashName());

        //create post
        Barang::create([
            'merk'     => $request->merk,
            'seri'      => $request->seri,
            'spesifikasi'      => $request->spesifikasi,
            'kategori_id'   => $request->kategori_id
            // 'foto'     => $foto->hashName()
        ]);

        //redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetBarang = Barang::find($id);
        $rsetkategori = Kategori::find($rsetBarang->kategori_id);

        //return $Barang;

        //return view
        return view('v_barang.show', compact('rsetBarang','rsetkategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        // $akategori = array('blank'=>'Pilih Barang',
        //                             'M'=>'M - Makanan',
        //                             'A'=>'A - Angkutan',
        //                             'BHP'=>'BHP - Beras',
        //                             'BTHP'=>'BTHP - Batu'
        //                 );

        // $rsetBarang = Barang::find($id);
        // return view('v_barang.edit', compact('rsetBarang','akategori'));

        $kategoriOptions = Kategori::all();                    
        // return view('v_barangg.create',compact('kategoriOptions'));
        $rsetBarang = Barang::find($id);
        $selectedkategori = Kategori::find($rsetBarang->kategori_id); 
        //return $rsetBarang;
        return view('v_barang.edit', compact('rsetBarang','kategoriOptions', 'selectedkategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'merk'    => 'required',
            'seri'     => 'required',
            'spesifikasi'  => 'required',
            'kategori_id'  => 'required'
        ]);

        $rsetBarang = Barang::find($id);


        //update post without image
        $rsetBarang->update([
            'merk'     => $request->merk,
            'seri'      => $request->seri,
            'spesifikasi'   => $request->spesifikasi,
            'kategori_id'   => $request->kategori_id,
        ]);

        //redirect to index
        return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Diubah!']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (DB::table('barangmasuk')->where('barang_id', $id)->exists() ||
            DB::table('barangkeluar')->where('barang_id', $id)->exists()){
            return redirect()->route('barang.index')->with(['gagal' => 'Data Tidak dapat Dihapus karena barang terdapat pada barangmasuk/barangkeluar']);
        } else {
            $rsetBarang = Barang::find($id);
            $rsetBarang->delete();
            return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ValidatesRequests;

    public function index()
    {
        $rsetkategori = DB::select('SELECT *, ketKategori(kategori) AS ketKategori FROM kategori');
        
        // return $rsetkategori; die();
        return view('v_kategori.index',compact('rsetkategori'));

        // $rsetKategori = Kategori::select('id','kategori','deskripsi',
        //     \DB::raw('(CASE
        //         WHEN deskripsi = "M" THEN "Modal"
        //         WHEN deskripsi = "A" THEN "Alat"
        //         WHEN deskripsi = "BHP" THEN "Bahan Habis Pakai"
        //         ELSE "Bahan Tidak Habis Pakai"
        //         END) AS ketKategorik'))
        //     ->paginate(10);
        //     return view('v_kategori.index', compact('rsetKategori'));
        //     return DB::table('kategori')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('v_kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'deskripsi'    => 'required',
            'kategori'  => 'required',
            // 'kelas'   => 'required|not_in:blank',
            // 'rombel'  => 'required',
        //     'foto'    => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // //upload image
        // $foto = $request->file('foto');
        // $foto->storeAs('public/foto', $foto->hashName());

        //create post
        Kategori::create([
            'deskripsi'     => $request->deskripsi,
            'kategori'   => $request->kategori
            // 'foto'     => $foto->hashName()
        ]);

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rsetkategori= kategori::find($id);

        //return $Barang;A

        //return view
        return view('v_kategori.show', compact('rsetkategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rsetkategori = Kategori::find($id);
        return view('v_kategori.edit', compact('rsetkategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'kategori'  => 'required',
            'deskripsi'    => 'required'
        ]);

        $rsetkategori = Kategori::find($id);


        //update post without image
        $rsetkategori->update([
            'kategori'   => $request->kategori,
            'deskripsi'     => $request->deskripsi
        ]);

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
     
        if (DB::table('barang')->where('kategori_id', $id)->exists()){
            return redirect()->route('kategori.index')->with(['Gagal' => 'Data Gagal Dihapus!']);
        } else {
            $rsetKategori = Kategori::find($id);
            $rsetKategori->delete();
            return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }
    }
}
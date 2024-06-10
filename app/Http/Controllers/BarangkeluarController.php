<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barangkeluar;
use App\Models\Barang;

class BarangkeluarController extends Controller
{
    public function index()
    {
        // Mengambil data dari tabel 'barangkeluar' menggunakan Eloquent ORM dengan relasi ke 'barang'
        $barangkeluar = Barangkeluar::with('barang')->latest()->paginate(10);

        return view('v_barangkeluar.index', compact('barangkeluar'));
    }

    public function create()
    {
        $merkBarang = Barang::pluck('merk', 'id');
        // Menampilkan form untuk membuat data barang keluar
        return view('v_barangkeluar.create', compact('merkBarang'));
    }
    // supaya gabisa mines
    public function store(Request $request)
    {
        $request->validate([
            'tgl_keluar' => 'required|after_or_equal:today',
            'qty_keluar' => 'required|integer|min:1',
            'barang_id' => 'required|exists:barang,id',
        ]);

        // Create a new barangkeluar record
        $barang = Barang::findOrFail($request->barang_id);

        // Periksa ketersediaan stok
        if ($request->qty_keluar > $barang->stok) {
            return redirect()->back()->withErrors(['qty_keluar' => 'Jumlah keluar melebihi stok yang tersedia'])->withInput();
        }

        // Simpan data pengeluaran barang jika validasi berhasil
        BarangKeluar::create($request->all());

        // Kurangi stok barang yang keluar dari stok yang tersedia
        $barang->stok -= $request->qty_keluar;
        $barang->save();

        return redirect()->route('barangkeluar.index')->with(['success' => 'Data Barang Keluar Berhasil Disimpan!']);
    }

    public function show($id)
    {
        // Mengambil data barang keluar berdasarkan ID
        $barangkeluar = Barangkeluar::findOrFail($id);
    
        return view('v_barangkeluar.show', compact('barangkeluar'));
    }

    public function edit($id)
    {
        // Mengambil data barang keluar untuk diedit berdasarkan ID
        $barangkeluar = Barangkeluar::findOrFail($id);
        $merkBarang = Barang::pluck('merk', 'id');
    
        return view('v_barangkeluar.edit', compact('barangkeluar', 'merkBarang'));
    }
    
    public function update(Request $request, $id)
    {
        // Validasi data dari request jika diperlukan
        $validatedData = $request->validate([
            'tgl_keluar' => 'required|after_or_equal:today',
            'qty_keluar' => 'required|numeric|min:0',
            // Tambahkan validasi lainnya sesuai kebutuhan
        ]);
    
        // Simpan perubahan data barang keluar ke database
        $barangkeluar = Barangkeluar::findOrFail($id);
        $barangkeluar->tgl_keluar = $request->tgl_keluar;
        $barangkeluar->qty_keluar = $request->qty_keluar;
        // Update kolom lainnya yang perlu diubah
        $barangkeluar->save();

        $barang = Barang::find($request->barang_id);
        $barang->stok -= $request->qty_keluar;
        $barang->save();
    
        return redirect()->route('barangkeluar.index')->with('success', 'Barang keluar berhasil diperbarui');
    }
    
    public function destroy($id)
    {
        // Menghapus data barang keluar berdasarkan ID
        $barangkeluar = Barangkeluar::findOrFail($id);
        $barangkeluar->delete();
    
        return redirect()->route('barangkeluar.index')->with('success', 'Barang keluar berhasil dihapus');
    }
}
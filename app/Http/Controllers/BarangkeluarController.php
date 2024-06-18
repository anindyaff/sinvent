<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Barangkeluar;
use App\Models\Barang;

class BarangkeluarController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tgl_keluar = $request->input('tgl_keluar');
    
        $barangkeluar = BarangKeluar::with('barang')
            ->when($search, function ($query, $search) {
                return $query->whereHas('barang', function($q) use ($search) {
                    $q->where('merk', 'like', '%' . $search . '%')
                      ->orWhere('seri', 'like', '%' . $search . '%');
                });
            })
            ->when($tgl_keluar, function ($query, $tgl_keluar) {
                return $query->whereDate('tgl_keluar', $tgl_keluar);
            })
            ->latest()
            ->paginate(10);
    
        $barangkeluar->appends(['search' => $search, 'tgl_keluar' => $tgl_keluar]);
    
        return view('v_barangkeluar.index', compact('barangkeluar'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
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
        // Validasi data dari request
        $validatedData = $request->validate([
            'tgl_keluar' => 'required|after_or_equal:today',
            'qty_keluar' => 'required|integer|min:1',
            'barang_id' => 'required|exists:barang,id',
        ]);
    
        $barangkeluar = Barangkeluar::findOrFail($id);
        $barang = Barang::findOrFail($request->barang_id);
    
        // Hitung perbedaan antara kuantitas yang baru dengan yang lama
        $qty_diff = $request->qty_keluar - $barangkeluar->qty_keluar;
    
        // Periksa apakah perubahan kuantitas akan menyebabkan stok negatif
        if ($qty_diff > $barang->stok) {
            return redirect()->back()->withErrors(['qty_keluar' => 'Jumlah keluar melebihi stok yang tersedia'])->withInput();
        }
    
        // Update data barang keluar
        $barangkeluar->tgl_keluar = $request->tgl_keluar;
        $barangkeluar->qty_keluar = $request->qty_keluar;
        $barangkeluar->save();
    
        // Update stok barang
        $barang->stok -= $qty_diff;
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
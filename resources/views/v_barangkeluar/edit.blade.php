@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Barang Keluar</div>
                    <div class="card-body">
                        <form action="{{ route('barangkeluar.update', $barangkeluar->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL KELUAR</label>
                                <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror" name="tgl_keluar" value="{{ old('tgl_keluar', $barangkeluar->tgl_keluar) }}" placeholder="Masukkan Tanggal">
                            
                                <!-- error message untuk tanggal keluar -->
                                @error('tgl_keluar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="font-weight-bold">JUMLAH KELUAR</label>
                                <input type="number" class="form-control @error('qty_keluar') is-invalid @enderror" name="qty_keluar" value="{{ old('qty_keluar', $barangkeluar->qty_keluar) }}" placeholder="Masukkan Jumlah">
                            
                                <!-- error message untuk jumlah keluar -->
                                @error('qty_keluar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="font-weight-bold">MERK BARANG</label>
                                <select name="barang_id" class="form-control @error('barang_id') is-invalid @enderror" required>
                                    <option value="" selected disabled>Pilih Merk Barang</option>
                                    @foreach ($merkBarang as $id => $merk)
                                        <option value="{{ $id }}" {{ $id == $barangkeluar->barang_id ? 'selected' : '' }}>{{ $merk }}</option>
                                    @endforeach
                                </select>
                                
                                <!-- error message untuk merk barang -->
                                @error('barang_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Tambahkan input atau select lainnya sesuai kebutuhan -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('barangkeluar.index') }}" class="btn btn-primary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
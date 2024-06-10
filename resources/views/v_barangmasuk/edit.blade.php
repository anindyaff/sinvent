@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Barang Masuk</div>
                    <div class="card-body">
                        <form action="{{ route('barangmasuk.update', $barangmasuk->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL MASUK</label>
                                <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" value="{{ old('tgl_masuk', $barangmasuk->tgl_masuk) }}" placeholder="Masukkan Tanggal">
                            
                                <!-- error message untuk tanggal masuk -->
                                @error('tgl_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label class="font-weight-bold">JUMLAH MASUK</label>
                                <input type="number" class="form-control @error('qty_masuk') is-invalid @enderror" name="qty_masuk" value="{{ old('qty_masuk', $barangmasuk->qty_masuk) }}" placeholder="Masukkan Jumlah">
                            
                                <!-- error message untuk jumlah masuk -->
                                @error('qty_masuk')
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
                                        <option value="{{ $id }}" {{ $id == $barangmasuk->barang_id ? 'selected' : '' }}>{{ $merk }}</option>
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
                            <a href="{{ route('barangmasuk.index') }}" class="btn btn-primary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
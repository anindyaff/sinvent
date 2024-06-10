@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">TAMBAH KATEGORI</div>
                <div class="card-body">
                    <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="font-weight-bold">DESKRIPSI</label>
                            <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Masukkan Deskripsi Kategori">

                            <!-- error message untuk deskripsi -->
                            @error('deskripsi')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">KATEGORI</label>

                            <div class="form-check">
                                <select class="form-select @error('kategori') is-invalid @enderror" name="kategori" aria-label="Default select example">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="M" {{ old('kategori') == 'M' ? 'selected' : '' }}>Barang Modal</option>
                                    <option value="A" {{ old('kategori') == 'A' ? 'selected' : '' }}>Alat</option>
                                    <option value="BHP" {{ old('kategori') == 'BHP' ? 'selected' : '' }}>Bahan Habis Pakai</option>
                                    <option value="BTHP" {{ old('kategori') == 'BTHP' ? 'selected' : '' }}>Bahan Tidak Habis Pakai</option>
                                </select>
                                <!-- error message untuk kategori -->
                                @error('kategori')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-md btn-primary">ADD</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        <a href="{{ route('kategori.index') }}" class="btn btn-md btn-danger">BACK</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
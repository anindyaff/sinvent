@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">                    
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Merk</label>
                                <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" value="{{ old('merk') }}" placeholder="Masukkan Merk barang">
                            
                                <!-- error message untuk merk -->
                                @error('merk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Seri</label>
                                <input type="text" class="form-control @error('seri') is-invalid @enderror" name="seri" value="{{ old('seri') }}" placeholder="Masukkan Seri">
                            
                                <!-- error message untuk seri -->
                                @error('seri')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Spesifikasi</label>
                                <input type="text" class="form-control @error('spesifikasi') is-invalid @enderror" name="spesifikasi" value="{{ old('spesifikasi') }}" placeholder="Masukkan Nomor Induk barang">
                            
                                <!-- error message untuk spesifikasi -->
                                @error('spesifikasi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">KATEGORI</label>
                                
                                <div class="form-check">
                                    <select class="form-select" name="kategori_id" aria-label="Default select example">
                                        <option value="blank" selected>Pilih kategori</option>
                                        @foreach ($kategoriOptions as $kategori)
                                            <option value="{{ $kategori->id }}">{{ $kategori->deskripsi }} - {{ $kategori->kategori }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- error message untuk kategori -->
                                @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- <div class="form-group">
                                <label class="font-weight-bold">Kategori</label>
                         
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori_id" id="kategori" value="1">
                                    <label class="form-check-label" for="kategori">
                                      1
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori_id" id="kategori" value="2">
                                    <label class="form-check-label" for="kategori">
                                      2
                                    </label>
                                  </div>       
                                  <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori_id" id="kategori" value="3">
                                        <label class="form-check-label" for="kategori">
                                            3
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori_id" id="kategori" value="4">
                                        <label class="form-check-label" for="kategori">
                                            4
                                        </label>
                                    </div>                         

                                 error message untuk spesifikasi -->
                                <!-- @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror -->
                            <!-- </div> --> 

                        

                            

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>

 

            </div>
        </div>
    </div>
@endsection
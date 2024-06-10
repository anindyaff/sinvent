@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('barang.update',$rsetBarang->id) }}" method="POST" enctype="multipart/form-data">                    
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">Merk</label>
                                <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk" value="{{ $rsetBarang->merk }}" placeholder="Masukkan Merk barang">
                            
                                <!-- error message untuk merk -->
                                @error('merk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Seri</label>
                                <input type="text" class="form-control @error('seri') is-invalid @enderror" name="seri" value="{{ $rsetBarang->seri }}" placeholder="Masukkan Seri">
                            
                                <!-- error message untuk seri -->
                                @error('seri')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Spesifikasi</label>
                                <input type="text" class="form-control @error('spesifikasi') is-invalid @enderror" name="spesifikasi" value="{{ $rsetBarang->spesifikasi }}" placeholder="Masukkan Nomor Induk barang">
                            
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
                                        @foreach($kategoriOptions as $key=>$val)
                                            @if($rsetBarang->kategori_id==$key)
                                                <option value="{{ $rsetBarang->kategori_id }}" selected>{{ $rsetBarang->kategori->deskripsi }} - {{ $rsetBarang->kategori->kategori }}</option>
                                            @else
                                                <option value="{{ $val->id }}">{{ $val->deskripsi }} - {{ $val->kategori }}</option>
                                            @endif
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
                                    <input class="form-check-input" type="radio" name="kategori_id" id="kategori" value="1" {{ ($rsetBarang->kategori_id==1)? "checked" : "" }}>
                                    <label class="form-check-label" for="kategori">
                                      1
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kategori_id" id="kategori" value="2" {{ ($rsetBarang->kategori_id==2)? "checked" : "" }}>
                                    <label class="form-check-label" for="kategori">
                                      2
                                    </label>
                                  </div>       
                                  <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori_id" id="kategori" value="3" {{ ($rsetBarang->kategori_id==3)? "checked" : "" }}>
                                        <label class="form-check-label" for="kategori">
                                            3
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="kategori_id" id="kategori" value="4" {{ ($rsetBarang->kategori_id==4)? "checked" : "" }}>
                                        <label class="form-check-label" for="kategori">
                                            4
                                        </label>
                                    </div>                         

                                error message untuk spesifikasi -->
                                <!-- @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> -->

                            

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>

 

            </div>
        </div>
    </div>
@endsection
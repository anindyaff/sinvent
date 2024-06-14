@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <!-- tambah search -->
                        <div class="row mb-3">
                        <div class="col-md-7">
                            <a href="{{ route('barangkeluar.create') }}" class="btn btn-md btn-success">TAMBAH BARANG KELUAR</a>
                        </div>
                        <div class="col-md-5">
                            <form action="{{ route('barangkeluar.index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari barang..." value="{{ request()->input('search') }}">
                                    <input type="date" name="tgl_keluar" class="form-control" value="{{ request()->input('tgl_keluar') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit"><i class="fa fa-search"></i></button>
                                    </div>
                                    @if(request()->filled('search') || request()->filled('tgl_keluar'))
                                        <div class="input-group-append">
                                            <a href="{{ route('barangkeluar.index') }}" class="btn btn-secondary"><i class="fa fa-times"></i></a>
                                        </div>
                                    @endif
                                </div>
                            </form>
                        </div>
                        @if(session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('Gagal'))
                            <div class="alert alert-danger mt-3">
                                {{ session('Gagal') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="sort-buttons text-right mt-3 mb-3">
                    <!-- Tambahkan kode dropdown untuk sorting -->
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%">ID</th>
                            <th>TANGGAL KELUAR</th>
                            <th>JUMLAH KELUAR</th>
                            <th>STOK SAAT INI</th>
                            <th>MERK</th>
                            <th style="width: 15%">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangkeluar as $bk)
                            <tr>
                                <td>{{ ($barangkeluar->currentPage() -1) * $barangkeluar->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $bk->tgl_keluar }}</td>
                                <td>{{ $bk->qty_keluar }}</td>
                                <td>{{ $bk->barang->stok }}</td>
                                <td>{{ $bk->barang->merk }}</td> <!-- Ubah 'nama' dengan kolom yang tepat -->
                                <td class="text-center"> 
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barangkeluar.destroy', $bk->id) }}" method="POST">
                                        <a href="{{ route('barangkeluar.show', $bk->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('barangkeluar.edit', $bk->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data Barang Keluar belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="pagination">
                    {{ $barangkeluar->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
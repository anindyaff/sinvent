@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('barangkeluar.create') }}" class="btn btn-md btn-success">TAMBAH BARANG KELUAR</a>
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
                                <td>{{ $bk->id }}</td>
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
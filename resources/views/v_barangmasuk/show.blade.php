@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>Tanggal Masuk</td>
                                <td>{{ $barangmasuk->tgl_masuk }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Masuk</td>
                                <td>{{ $barangmasuk->qty_masuk }}</td>
                            </tr>
                            <tr>
                                <td>Merk Barang</td>
                                <td>{{ $barangmasuk->barang->merk }}</td>
                            </tr>
                            <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                        </table>
                    </div>
                    <div class="col-md-12">
                        <a href="{{ route('barangmasuk.index') }}" class="btn btn-md btn-primary mb-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
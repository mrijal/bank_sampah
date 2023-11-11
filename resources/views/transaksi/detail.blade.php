@extends('layouts.template')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Transaksi Terbaru</h6>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Jenis Sampah</th>
                    <th>Berat</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->jenis_sampah->nama_jenis}}</td>
                        <td>{{$item->berat}} Kg</td>
                        <td>Rp. {{$item->harga}}</td>
                        <td>Rp. {{$item->harga * $item->berat}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
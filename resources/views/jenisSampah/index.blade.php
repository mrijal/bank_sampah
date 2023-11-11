@extends('layouts.template')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Input Transaksi</h1>
</div>
@include('layouts.status')

<form action="{{url('jenis-sampah')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-sm-3">
            <label for="">Nama Jenis</label>
        </div>
        <div class="col-sm-3">
            <label for="">Deskripsi</label>
        </div>
        <div class="col-sm-2">
            <label for="">Harga Per Kilo</label>
        </div>
        <div class="col-sm-2">
            <label for="">Foto</label>
        </div>
        <div class="col-sm-2">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <input type="text" class="form-control @error('nama_jenis') is-invalid @enderror" name="nama_jenis">
        </div>
        <div class="col-sm-3">
            <textarea name="deskripsi" id="deskripsi" cols="30" rows="1" class="form-control"></textarea>
        </div>
        <div class="col-sm-2">
            <input type="number" class="form-control" name="harga_per_kilo" min="1">
        </div>
        <div class="col-sm-2">
            <input type="file" class="form-control" name="foto">
        </div>
        <div class="col-sm-2">
            <button type="submit" class="btn btn-success form-control">Submit Data</button>
        </div>
    </div>
</form>
<hr>
<div class="container-fluid">
    <table class="table" width="100%">
        <thead>
            <tr>
                <th>No. </th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Harga Per Kilo</th>
                <th>Foto</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->nama_jenis}}</td>
                    <td>{{$item->deskripsi}}</td>
                    <td>{{$item->harga_per_kilo}}</td>
                    <td><img height="50px" src="{{$item->foto}}" alt="Foto {{$item->nama_jenis}}"></td>
                    <td><a href="{{route('jenis-sampah.edit', $item->id)}}" class="btn btn-secondary"><i class="fa fa-edit"></i></a> <form style="display: inline-block" action="{{route('jenis-sampah.destroy', $item->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger"><i class="fa fa-trash"></i></a></button></form></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
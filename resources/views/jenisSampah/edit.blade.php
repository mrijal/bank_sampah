@extends('layouts.template')
@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Jenis</h1>
</div>

<form action="{{route('jenis-sampah.update', $data->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="row mt-3">
        <div class="col-sm-2">
            Nama Jenis
        </div>
        <div class="col-sm-10">
            <input type="text" name="nama_jenis" class="form-control" value="{{$data->nama_jenis}}">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-2">
            Deskripsi
        </div>
        <div class="col-sm-10">
            <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10">{{$data->deskripsi}}</textarea>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-2">
            Harga Per Kilo
        </div>
        <div class="col-sm-10">
            <input type="number" min="1" name="harga_per_kilo" class="form-control" value="{{$data->harga_per_kilo}}">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-2">
            Foto
        </div>
        <div class="col-sm-10">
            <input type="file" name="foto" class="form-control">
            <input type="hidden" name="fotoLama" class="form-control" value="{{$data->foto}}">
        </div>
    </div>
    <button type="submit" class="btn btn-success">EDIT DATA</button>
</form>
@endsection
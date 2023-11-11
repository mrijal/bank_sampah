@extends('layouts.template')
@section('content')
<form action="{{url('/transaksi')}}" method="POST">
    @csrf
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Validasi Transaksi</h1>
        <button class="d-none d-lg-inline-block btn btn-lg btn-success shadow-lg" name="btnSubmit"><i
                class="fas fa-download fa-sm text-white-50"></i>Submit</button>
    </div>
    <table class="table">
        <thead>
            <tr>
                <td>No.</td>
                <td>Jenis Sampah</td>
                <td>Berat (kg)</td>
                <td>Harga / Kilo</td>
                <td>Total harga</td>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
                $beratTotal = 0;
            @endphp
            @for ($i = 1; $i <= $data["counter"]; $i++)
                <tr>
                    <td>{{$i}}</td>
                    <td><?= $data["jenis_sampah$i"] ?></td>
                    <input type="hidden" name="id_jenis_sampah{{$i}}" value="<?= $data["id_jenis_sampah$i"] ?>">
                    <td><?= $data["berat$i"] ?> Kg</td>
                    <input type="hidden" name="berat{{$i}}" value="<?= $data["berat$i"] ?>">
                    <input type="hidden" name="harga{{$i}}" value="<?= $data["harga$i"] ?>">
                    <td>Rp. <?= number_format($data["harga$i"]) ?></td>
                    <td>Rp. <?= number_format($data["harga$i"] * $data["berat$i"]) ?></td>
                    <input type="hidden" name="total{{$i}}" value="<?= $data["harga$i"] * $data["berat$i"]?>">
                </tr>
                @php
                    $grandTotal += $data["harga$i"] * $data["berat$i"];
                    $beratTotal += $data["berat$i"];
                @endphp
            @endfor
            <tr style="padding-top: 20px; color: black;">
                <td colspan="4"><h3><b>Grand Total</b></h3></td>
                <td><h3><b>
                    @php
                        echo "Rp. ". number_format($grandTotal);
                    @endphp
                </b></h3></td>
                <input type="hidden" name="counter" value="<?=$data["counter"]?>">
                <input type="hidden" name="total_harga" value="<?= $grandTotal?>">
                <input type="hidden" name="total_berat" value="<?= $beratTotal?>">
                <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
            </tr>
        </tbody>
    </table>
    <button class="btn btn-success" name="submit">Submit</button>
    
</form>
@endsection
<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\JenisSampah;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis = JenisSampah::all();
        $transaksi = Transaksi::all();
        return view('transaksi/index', compact('jenis', 'transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'id_user' => 'required',
            'total_berat' => 'required',
            'total_harga' => 'required',
        ]);

        $validator['status'] = "Berhasil";

        $transaksi = Transaksi::create($validator);
        for ($i = 1; $i <= $request->counter; $i++) {
            $berat = 'berat' . $i;
            $jenis_sampah = 'jenis_sampah' . $i;
            $harga = 'harga' . $i;
            $id_jenis_sampah = 'id_jenis_sampah' . $i;
            DetailTransaksi::create([
                'id_transaksi' => $transaksi->id,
                'id_jenis_sampah' => $request->$id_jenis_sampah,
                'berat' => $request->$berat,
                'harga' => $request->$harga,
            ]);
        }

        return redirect('/')->with('success', 'Transaksi Berhasil Diinput');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaksi = DetailTransaksi::where('id_transaksi', '=', $id)->get();

        return view('transaksi/detail', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function hitung(Request $request)
    {
        for ($i = 1; $i <= $request->counter; $i++) {
            $berat = 'berat' . $i;
            $jenis_sampah = 'jenis_sampah' . $i;
            $id_jenis_sampah = 'id_jeni$id_jenis_sampah' . $i;

            $data["berat$i"] = $request->$berat;
            $data["harga$i"] = JenisSampah::find($request->$jenis_sampah)->harga_per_kilo;
            $data["jenis_sampah$i"] = JenisSampah::find($request->$jenis_sampah)->nama_jenis;
            $data["id_jenis_sampah$i"] = $request->$jenis_sampah;
        }
        $data["counter"] = $request->counter;

        return view('transaksi/hitung', compact('data'));
    }
}

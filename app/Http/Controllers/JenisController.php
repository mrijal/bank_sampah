<?php

namespace App\Http\Controllers;

use App\Models\JenisSampah;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JenisSampah::all();
        return view('jenisSampah/index', compact('data'));
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
            'nama_jenis' => 'required',
            'deskripsi' => 'required',
            'harga_per_kilo' => 'required'
        ]);

        $validator['foto'] = $request->file('foto')->store('img');
        JenisSampah::create($validator);

        return redirect('jenis-sampah')->with('success', 'Data berhsail ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = JenisSampah::find($id);
        return view('jenisSampah/detail', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = JenisSampah::find($id);
        return view('jenisSampah/edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = JenisSampah::find($id);
        $validator = $request->validate([
            'nama_jenis' => 'required',
            'deskripsi' => 'required',
            'harga_per_kilo' => 'required',
        ]);

        if ($request->foto == null || $request->foto == "") {
            $data->update([
                'nama_jenis' => $validator['nama_jenis'],
                'deskripsi' => $validator['deskripsi'],
                'harga_per_kilo' => $validator['harga_per_kilo'],
            ]);
        } else {
            $validator['foto'] = $request->file('foto')->store('img');
            $data->update([
                'nama_jenis' => $validator['nama_jenis'],
                'deskripsi' => $validator['deskripsi'],
                'harga_per_kilo' => $validator['harga_per_kilo'],
                'foto' => $validator['foto'],
            ]);
        }

        return redirect('jenis-sampah')->with('success', 'Data berhasil DiEdit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = JenisSampah::find($id);
        $data->delete();

        return redirect('jenis-sampah')->with('success', 'Data berhasil Dihapus');
    }
}

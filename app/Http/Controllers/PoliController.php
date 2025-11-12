<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PoliController extends Controller
{
    // ========== UNTUK ADMIN (CRUD DATA POLI) ==========
    public function index()
    {
        $polis = Poli::all();
        return view('admin.polis.index', compact('polis'));
    }

    public function create()
    {
        return view('admin.polis.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_poli' => 'required',
            'keterangan' => 'nullable',
        ]);

        Poli::create($validated);
        return redirect()->route('polis.index')
            ->with('success', 'Poli berhasil ditambahkan')
            ->with('type', 'success');
    }

    public function edit($id)
    {
        $poli = Poli::findOrFail($id);
        return view('admin.polis.edit', compact('poli'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_poli' => 'required',
            'keterangan' => 'nullable',
        ]);

        $poli = Poli::findOrFail($id);
        $poli->update($validated);
        return redirect()->route('polis.index')
            ->with('success', 'Poli berhasil diupdate');
    }

    public function destroy($id)
    {
        $poli = Poli::findOrFail($id);
        $poli->delete();
        return redirect()->route('polis.index')
            ->with('success', 'Poli berhasil dihapus!');
    }

    // ========== UNTUK PASIEN (DAFTAR POLI) ==========

    // Menampilkan halaman daftar poli pasien
    public function get()
    {
        $user = Auth::user(); // pasien langsung dari user

        // Ambil daftar poli pasien berdasarkan id user
        $daftar_poli = DaftarPoli::with(['poli', 'jadwalPeriksa'])
            ->where('id_pasien', $user->id)
            ->get();

        $poli = Poli::all();
        $jadwalPeriksa = JadwalPeriksa::with('dokter')->get();

        return view('pasien.daftar_poli', compact('user', 'daftar_poli', 'poli', 'jadwalPeriksa'));
    }

    // Menangani proses pendaftaran poli
    public function submit(Request $request)
    {
        $request->validate([
            'id_poli' => 'required',
            'id_jadwal' => 'required',
        ]);

        $user = Auth::user();

        // Nomor antrian otomatis berdasarkan poli & tanggal
        $nomorAntrian = DaftarPoli::where('id_poli', $request->id_poli)
            ->whereDate('created_at', now())
            ->count() + 1;

        // Simpan data daftar poli
        DaftarPoli::create([
            'id_user'     => $user->id, // langsung dari users
            'id_poli'     => $request->id_poli,
            'id_jadwal'   => $request->id_jadwal,
            'no_antrian'  => $nomorAntrian,
        ]);

        return redirect()->back()
            ->with('success', 'Pendaftaran berhasil! Nomor antrian Anda: ' . $nomorAntrian);
    }
}

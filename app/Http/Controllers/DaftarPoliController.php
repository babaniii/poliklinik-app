<?php

namespace App\Http\Controllers;

use App\Models\DaftarPoli;
use Illuminate\Http\Request;

class DaftarPoliController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|exists:jadwal_periksa,id',
            'keluhan'   => 'required|string',
        ]);

        // hitung antrian hari ini berdasarkan jadwal
        $noAntrian = DaftarPoli::where('id_jadwal', $request->id_jadwal)
            ->whereDate('created_at', now())
            ->count() + 1;

        DaftarPoli::create([
            'id_pasien'  => auth()->id(),
            'id_jadwal'  => $request->id_jadwal,
            'keluhan'    => $request->keluhan,
            'no_antrian' => $noAntrian,
        ]);

        return back()
            ->with('message', 'Berhasil daftar poli')
            ->with('type', 'success');
    }
}


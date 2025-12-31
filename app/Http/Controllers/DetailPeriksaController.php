<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetailPeriksa;
use App\Models\Periksa;
use App\Models\Obat;
use App\Models\User;
use Illuminate\Http\Request;

class DetailPeriksaController extends Controller
{
    public function index()
{
    $reseps = DetailPeriksa::with(['obat', 'periksa.pasien'])
        ->latest()
        ->get();

    return view('dokter.atur-resep.index', compact('reseps'));
}

  public function create()
{
    $obats = Obat::where('stok', '>', 0)->get();
    $pasiens = User::where('role', 'pasien')->get();

    return view('dokter.atur-resep.create', compact('obats', 'pasiens'));
}


    public function store(Request $request)
    {
        $request->validate([
    'id_pasien' => 'required|exists:users,id',
    'id_obat'   => 'required|exists:obat,id',
    'jumlah'    => 'required|integer|min:1',
]);

$obat = Obat::findOrFail($request->id_obat);

if ($obat->stok < $request->jumlah) {
    return back()->with('message', 'Stok obat tidak mencukupi')
                 ->with('type', 'danger');
}

// buat periksa
$periksa = Periksa::create([
    'dokter_id' => auth()->id(),
    'pasien_id' => $request->id_pasien,
]);

// detail resep
DetailPeriksa::create([
    'id_periksa' => $periksa->id,
    'id_obat'    => $request->id_obat,
    'jumlah'     => $request->jumlah,
]);

$obat->decrement('stok', $request->jumlah);

return redirect()->route('dokter.atur-resep.index')
    ->with('message', 'Resep berhasil ditambahkan')
    ->with('type', 'success');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('admin.obat.index', compact('obats'));
    }

    public function create()
    {
        return view('admin.obat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string',
            'kemasan'   => 'nullable|string',
            'harga'     => 'required|integer',
            'stok'      => 'required|integer|min:0'
        ]);

        Obat::create($request->all());

        return redirect()->route('obat.index')
            ->with('message', 'Obat berhasil ditambahkan')
            ->with('type', 'success');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obat.edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string',
            'kemasan'   => 'nullable|string',
            'harga'     => 'required|integer',
            'stok'      => 'required|integer|min:0'
        ]);

        $obat = Obat::findOrFail($id);
        $obat->update($request->all());

        return redirect()->route('obat.index')
            ->with('message', 'Stok obat berhasil diperbarui')
            ->with('type', 'success');
    }

    public function destroy($id)
    {
        Obat::findOrFail($id)->delete();

        return redirect()->route('obat.index')
            ->with('message', 'Obat berhasil dihapus')
            ->with('type', 'success');
    }
}

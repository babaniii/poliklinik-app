<x-layouts.app title="Atur Resep">
<div class="container-fluid px-4 mt-4">

<h1 class="mb-4">Tambah Resep</h1>

@if (session('message'))
<div class="alert alert-{{ session('type') }}">
    {{ session('message') }}
</div>
@endif

<form action="{{ route('atur-resep.store') }}" method="POST">
@csrf

<div class="mb-3">
    <label>Nama Pasien</label>
    <select name="id_pasien" class="form-control" required>
        <option value="">-- Pilih Pasien --</option>
        @foreach ($pasiens as $pasien)
            <option value="{{ $pasien->id }}">
                {{ $pasien->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Obat</label>
    <select name="id_obat" class="form-control" required>
        <option value="">-- Pilih Obat --</option>
        @foreach ($obats as $obat)
            <option value="{{ $obat->id }}">
                {{ $obat->nama_obat }} (Stok: {{ $obat->stok }})
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Jumlah</label>
    <input type="number" name="jumlah" class="form-control" min="1" required>
</div>

<button class="btn btn-success">Simpan Resep</button>
<a href="{{ route('atur-resep.index') }}" class="btn btn-secondary">Kembali</a>

</form>
</div>
</x-layouts.app>

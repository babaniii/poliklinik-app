<x-layouts.app title="Data Resep">
<div class="container-fluid px-4 mt-4">

@if (session('message'))
<div class="alert alert-{{ session('type') }}">
    {{ session('message') }}
</div>
@endif

<h1 class="mb-4">Data Resep Pasien</h1>

<a href="{{ route('atur-resep.create') }}" class="btn btn-primary mb-3">
    <i class="fas fa-plus"></i> Tambah Resep
</a>

<table class="table table-bordered">
<thead class="table-light">
<tr>
<th>No</th>
<th>Nama Pasien</th>
<th>Nama Obat</th>
<th>Jumlah</th>
<th>Tanggal</th>
</tr>
</thead>
<tbody>
@forelse ($reseps as $r)
<tr>
<td>{{ $loop->iteration }}</td>
<td>{{ $r->pasien->name }}</td>
<td>{{ $r->obat->nama_obat }}</td>
<td>{{ $r->jumlah }}</td>
<td>{{ $r->created_at->format('d-m-Y') }}</td>
</tr>
@empty
<tr>
<td colspan="5" class="text-center">Belum ada resep</td>
</tr>
@endforelse
</tbody>
</table>

</div>
</x-layouts.app>

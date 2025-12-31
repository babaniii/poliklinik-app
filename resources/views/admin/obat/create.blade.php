<x-layouts.app title="Tambah Obat">
    <div class="container-fluid px-4 mt-4">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h1 class="mb-4">Tambah Obat</h1>

                <div class="card">
                    <div class="card-body">

                        {{-- Flash error stok / validasi --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('obat.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                {{-- Nama Obat --}}
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">
                                            Nama Obat <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            name="nama_obat"
                                            class="form-control @error('nama_obat') is-invalid @enderror"
                                            value="{{ old('nama_obat') }}"
                                            required>
                                        @error('nama_obat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Kemasan --}}
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label class="form-label">
                                            Kemasan <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            name="kemasan"
                                            class="form-control @error('kemasan') is-invalid @enderror"
                                            value="{{ old('kemasan') }}"
                                            placeholder="Strip / Botol / Tube"
                                            required>
                                        @error('kemasan')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Harga --}}
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    Harga <span class="text-danger">*</span>
                                </label>
                                <input type="number"
                                    name="harga"
                                    class="form-control @error('harga') is-invalid @enderror"
                                    value="{{ old('harga') }}"
                                    min="0"
                                    required>
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- STOK OBAT (BARU) --}}
                            <div class="form-group mb-3">
                                <label class="form-label">
                                    Stok Awal <span class="text-danger">*</span>
                                </label>
                                <input type="number"
                                    name="stok"
                                    class="form-control @error('stok') is-invalid @enderror"
                                    value="{{ old('stok', 0) }}"
                                    min="0"
                                    required>
                                @error('stok')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    Digunakan untuk manajemen stok dan resep dokter
                                </small>
                            </div>

                            {{-- Tombol --}}
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="{{ route('obat.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>

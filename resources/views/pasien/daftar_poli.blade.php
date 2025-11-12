<x-layouts.app title="Daftar Poli">
    <div class="container mt-4">
        <h3 class="mb-4 text-primary">
            <i class="fas fa-hospital-user"></i> Pendaftaran Poli
        </h3>

        {{-- Notifikasi sukses --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Form daftar poli --}}
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <strong>Form Pendaftaran Poli</strong>
            </div>
            <div class="card-body">
                <form action="{{ route('pasien.daftar_poli.submit') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="id_poli" class="form-label">Pilih Poli</label>
                            <select name="id_poli" id="id_poli" class="form-select" required>
                                <option value="">-- Pilih Poli --</option>
                                @foreach($poli as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_poli }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="id_jadwal" class="form-label">Pilih Jadwal Periksa</label>
                            <select name="id_jadwal" id="id_jadwal" class="form-select" required>
                                <option value="">-- Pilih Jadwal Periksa --</option>
                                @foreach($jadwalPeriksa as $j)
                                    <option value="{{ $j->id }}">
                                        {{ $j->dokter->nama }} - {{ $j->hari }}
                                        ({{ $j->jam_mulai }} - {{ $j->jam_selesai }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-paper-plane"></i> Daftar Poli
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabel riwayat pendaftaran --}}
        <div class="card shadow">
            <div class="card-header bg-secondary text-white">
                <strong>Riwayat Pendaftaran Poli</strong>
            </div>
            <div class="card-body">
                @if($daftar_poli->isEmpty())
                    <p class="text-muted">Belum ada riwayat pendaftaran poli.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>No Antrian</th>
                                    <th>Poli</th>
                                    <th>Dokter</th>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($daftar_poli as $d)
                                    <tr>
                                        <td>{{ $d->no_antrian }}</td>
                                        <td>{{ $d->poli->nama_poli }}</td>
                                        <td>{{ $d->jadwalPeriksa->dokter->nama }}</td>
                                        <td>{{ $d->jadwalPeriksa->hari }}</td>
                                        <td>{{ $d->jadwalPeriksa->jam_mulai }} - {{ $d->jadwalPeriksa->jam_selesai }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>

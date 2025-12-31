<x-layouts.app title="Daftar Poli">
    <div class="container mt-4">

        <h3 class="mb-4 text-primary">
            <i class="fas fa-hospital-user me-2"></i>Pendaftaran Poli
        </h3>

        {{-- Alert --}}
        @if(session('message'))
            <div class="alert alert-{{ session('type') }} alert-dismissible fade show">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Form --}}
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <strong>Form Pendaftaran Poli</strong>
            </div>

            <div class="card-body">
                <form action="{{ route('pasien.daftar_poli.submit') }}" method="POST">
                    @csrf

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Poli</label>
                            <select name="id_poli" class="form-select" required>
                                <option value="">-- Pilih Poli --</option>
                                @foreach($poli as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_poli }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Jadwal Periksa</label>
                            <select name="id_jadwal" class="form-select" required>
                                <option value="">-- Pilih Jadwal --</option>
                                @foreach($jadwalPeriksa as $j)
                                    <option value="{{ $j->id }}">
                                        {{ $j->dokter->nama }} | {{ $j->hari }}
                                        ({{ $j->jam_mulai }} - {{ $j->jam_selesai }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-success px-4">
                            <i class="fas fa-paper-plane me-1"></i>Daftar
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Riwayat --}}
        <div class="card shadow">
            <div class="card-header bg-secondary text-white">
                <strong>Riwayat Pendaftaran</strong>
            </div>

            <div class="card-body">
                @if($daftar_poli->isEmpty())
                    <p class="text-muted mb-0">Belum ada riwayat pendaftaran.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Poli</th>
                                    <th>Dokter</th>
                                    <th>Hari</th>
                                    <th>Jam</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($daftar_poli as $d)
                                    <tr>
                                        <td class="text-center">{{ $d->no_antrian }}</td>
                                        <td>{{ $d->poli->nama_poli }}</td>
                                        <td>{{ $d->jadwalPeriksa->dokter->nama }}</td>
                                        <td>{{ $d->jadwalPeriksa->hari }}</td>
                                        <td>
                                            {{ $d->jadwalPeriksa->jam_mulai }} -
                                            {{ $d->jadwalPeriksa->jam_selesai }}
                                        </td>
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

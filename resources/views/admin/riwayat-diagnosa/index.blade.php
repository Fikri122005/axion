@extends('layouts.admin')

@section('title', 'Riwayat Diagnosa | ' . config('app.name', 'AxionVet'))
@section('page-title', 'Riwayat & Laporan Diagnosa')

@section('breadcrumbs')
  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
  <li class="breadcrumb-item">Riwayat & Laporan</li>
  <li class="breadcrumb-item active" aria-current="page">Riwayat Diagnosa</li>
@endsection

@section('content')
<!--begin::Stat Summary-->
<div class="row mb-3">
  <div class="col-md-4 col-sm-6 mb-3">
    <div class="small-box text-bg-danger shadow-sm rounded-3">
      <div class="inner">
        <h3>{{ $totalRiwayat }}</h3>
        <p class="mb-0">Total Konsultasi / Diagnosa</p>
      </div>
      <i class="small-box-icon bi bi-journal-medical"></i>
    </div>
  </div>
  <div class="col-md-4 col-sm-6 mb-3">
    <div class="small-box text-bg-primary shadow-sm rounded-3">
      <div class="inner">
        <h3>{{ $kategoriList->count() }}</h3>
        <p class="mb-0">Kategori Hewan</p>
      </div>
      <i class="small-box-icon bi bi-tags-fill"></i>
    </div>
  </div>
  <div class="col-md-4 col-sm-12 mb-3">
    <div class="small-box text-bg-secondary shadow-sm rounded-3">
      <div class="inner">
        <h3>{{ $riwayatList->total() }}</h3>
        <p class="mb-0">Data Ditampilkan</p>
      </div>
      <i class="small-box-icon bi bi-funnel"></i>
    </div>
  </div>
</div>
<!--end::Stat Summary-->

<!--begin::Card Table-->
<div class="card card-outline card-danger shadow-sm mb-4">
  <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
    <h3 class="card-title fw-bold mb-0">
      <i class="bi bi-journal-medical text-danger me-2"></i>Daftar Riwayat Konsultasi & Diagnosa
    </h3>
    <div class="card-tools d-flex flex-wrap align-items-center gap-2">
      <!-- Filter & Search Form -->
      <form action="{{ route('admin.riwayat') }}" method="GET" class="d-flex flex-wrap align-items-center gap-2">
        <select name="kategori_id" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
          <option value="">Semua Kategori</option>
          @foreach($kategoriList as $kat)
            <option value="{{ $kat->id }}" {{ (string)($kategoriId ?? '') === (string)$kat->id ? 'selected' : '' }}>
              {{ $kat->nama_kategori }}
            </option>
          @endforeach
        </select>

        <div class="input-group input-group-sm" style="width: 220px;">
          <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Cari hewan/penyakit/user..."
            value="{{ $search ?? '' }}"
          />
          <button class="btn btn-outline-secondary" type="submit">
            <i class="bi bi-search"></i>
          </button>
          @if(!empty($search) || !empty($kategoriId))
            <a href="{{ route('admin.riwayat') }}" class="btn btn-outline-danger" title="Reset filter">
              <i class="bi bi-x-lg"></i>
            </a>
          @endif
        </div>
      </form>
    </div>
  </div>
  <!-- /.card-header -->

  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table table-hover table-striped align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th class="text-center" style="width: 50px">#</th>
            <th>Waktu Diagnosa</th>
            <th>Nama Hewan</th>
            <th>Kategori</th>
            <th>Hasil Diagnosa Terpilih</th>
            <th style="width: 170px">Tingkat Keyakinan (CF)</th>
            <th>Pemeriksa</th>
            <th class="text-center" style="width: 100px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($riwayatList as $index => $item)
            @php
              $persen = $item->persentase ?? ($item->nilai_cf_akhir * 100);
              if ($persen >= 80) {
                $color = 'success';
              } elseif ($persen >= 60) {
                $color = 'primary';
              } elseif ($persen >= 40) {
                $color = 'info';
              } else {
                $color = 'warning';
              }
            @endphp
            <tr>
              <td class="text-center text-muted fw-semibold">{{ $riwayatList->firstItem() + $index }}</td>
              <td>
                <span class="fw-semibold text-dark">{{ $item->tanggal_diagnosa?->translatedFormat('d M Y') ?? $item->created_at->format('d/m/Y') }}</span>
                <small class="d-block text-muted">{{ $item->tanggal_diagnosa?->format('H:i') ?? $item->created_at->format('H:i') }} WIB</small>
              </td>
              <td>
                <span class="fw-bold text-dark">{{ $item->nama_hewan ?? 'Hewan Tanpa Nama' }}</span>
                @if($item->umur_hewan)
                  <small class="d-block text-muted">{{ $item->umur_hewan }}</small>
                @endif
              </td>
              <td>
                <span class="badge text-bg-primary-subtle text-primary border border-primary-subtle">
                  {{ $item->kategori->nama_kategori ?? '-' }}
                </span>
              </td>
              <td>
                @if($item->penyakitTerpilih)
                  <span class="badge text-bg-light border font-monospace me-1">{{ $item->penyakitTerpilih->kode_penyakit }}</span>
                  <span class="fw-bold text-danger">{{ $item->penyakitTerpilih->nama_penyakit }}</span>
                @else
                  <span class="text-muted italic">Tidak teridentifikasi</span>
                @endif
              </td>
              <td>
                <div class="d-flex align-items-center gap-2">
                  <div class="progress flex-grow-1" style="height: 6px;">
                    <div class="progress-bar bg-{{ $color }}" role="progressbar" style="width: {{ $persen }}%"></div>
                  </div>
                  <span class="badge text-bg-{{ $color }}">{{ number_format($persen, 1) }}%</span>
                </div>
              </td>
              <td>
                <span class="small fw-semibold text-secondary">{{ $item->user->name ?? 'Pengguna Tamu' }}</span>
              </td>
              <td class="text-center">
                <button
                  type="button"
                  class="btn btn-xs btn-outline-danger rounded-pill px-2"
                  data-bs-toggle="modal"
                  data-bs-target="#modalRiwayat{{ $item->id }}"
                  title="Lihat Detail Riwayat"
                >
                  <i class="bi bi-file-earmark-text"></i> Detail
                </button>
              </td>
            </tr>

            <!-- Modal Detail Riwayat -->
            <div class="modal fade" id="modalRiwayat{{ $item->id }}" tabindex="-1" aria-labelledby="modalRiwayatLabel{{ $item->id }}" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header bg-danger-subtle">
                    <h5 class="modal-title fw-bold text-danger-emphasis" id="modalRiwayatLabel{{ $item->id }}">
                      <i class="bi bi-journal-medical me-2"></i>Hasil Diagnosa: {{ $item->nama_hewan ?? 'Hewan' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="row mb-3">
                      <div class="col-sm-6">
                        <p class="mb-1 text-muted small">Kategori: <strong>{{ $item->kategori->nama_kategori ?? '-' }}</strong></p>
                        <p class="mb-1 text-muted small">Umur Hewan: <strong>{{ $item->umur_hewan ?? '-' }}</strong></p>
                      </div>
                      <div class="col-sm-6 text-sm-end">
                        <p class="mb-1 text-muted small">Pemeriksa: <strong>{{ $item->user->name ?? '-' }}</strong></p>
                        <p class="mb-1 text-muted small">Waktu: <strong>{{ $item->tanggal_diagnosa?->format('d M Y H:i') ?? '-' }}</strong></p>
                      </div>
                    </div>

                    <div class="card bg-body-tertiary mb-3 border">
                      <div class="card-body">
                        <h6 class="fw-bold text-danger mb-1">
                          <i class="bi bi-check2-circle me-1"></i>Penyakit Terpilih: {{ $item->penyakitTerpilih->nama_penyakit ?? '-' }}
                        </h6>
                        <p class="mb-2 small text-secondary">
                          Tingkat Kepastian (Certainty Factor): <strong>{{ number_format($persen, 2) }}%</strong>
                        </p>
                        @if($item->penyakitTerpilih?->solusi)
                          <div class="alert alert-light border small mb-0">
                            <strong>Solusi & Penanganan:</strong><br/>
                            {{ $item->penyakitTerpilih->solusi }}
                          </div>
                        @endif
                      </div>
                    </div>

                    @if($item->detailDiagnosa && $item->detailDiagnosa->count() > 0)
                      <h6 class="fw-bold text-secondary mb-2 small"><i class="bi bi-list-check me-1"></i>Gejala yang Dikeluhkan:</h6>
                      <ul class="list-group list-group-flush border rounded mb-3 small">
                        @foreach($item->detailDiagnosa as $det)
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $det->gejala->nama_gejala ?? '-' }}</span>
                            <span class="badge text-bg-light border">CF User: {{ number_format($det->cf_user, 2) }}</span>
                          </li>
                        @endforeach
                      </ul>
                    @endif
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <tr>
              <td colspan="8" class="text-center py-4 text-muted">
                <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                Belum ada data riwayat konsultasi / diagnosa.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!-- /.card-body -->

  @if($riwayatList->hasPages())
    <div class="card-footer bg-body-tertiary clearfix">
      <div class="float-end">
        {{ $riwayatList->links('pagination::bootstrap-5') }}
      </div>
    </div>
  @endif
</div>
<!--end::Card Table-->
@endsection

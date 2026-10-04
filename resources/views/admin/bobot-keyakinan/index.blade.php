@extends('layouts.admin')

@section('title', 'Bobot Keyakinan | ' . config('app.name', 'AxionVet'))
@section('page-title', 'Bobot Keyakinan Certainty Factor')

@section('breadcrumbs')
  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
  <li class="breadcrumb-item">Sistem Pakar (CF)</li>
  <li class="breadcrumb-item active" aria-current="page">Bobot Keyakinan</li>
@endsection

@section('content')
<!--begin::Informational Alert-->
<div class="alert alert-info d-flex align-items-center gap-3 shadow-sm mb-4" role="alert">
  <i class="bi bi-info-circle-fill fs-3 text-info"></i>
  <div>
    <h6 class="fw-bold mb-1">Skala Nilai Certainty Factor (CF)</h6>
    <p class="mb-0 small">
      Bobot keyakinan digunakan sebagai pilihan tingkat kepastian gejala saat pengguna/dokter melakukan diagnosa, serta sebagai rujukan keyakinan pakar pada basis pengetahuan. Nilai berkisar antara <strong>0.0 (Tidak Tahu/Tidak)</strong> hingga <strong>1.0 (Pasti/Sangat Yakin)</strong>.
    </p>
  </div>
</div>
<!--end::Informational Alert-->

<div class="row">
  <!--begin::Table Bobot-->
  <div class="col-lg-8 mb-4">
    <div class="card card-outline card-primary shadow-sm h-100">
      <div class="card-header">
        <h3 class="card-title fw-bold mb-0">
          <i class="bi bi-sliders2-vertical text-primary me-2"></i>Daftar Pilihan Bobot Keyakinan
        </h3>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover table-striped align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th class="text-center" style="width: 70px">Urutan</th>
                <th>Label Tingkat Keyakinan</th>
                <th class="text-center" style="width: 120px">Nilai CF</th>
                <th style="width: 220px">Visualisasi Derajat</th>
              </tr>
            </thead>
            <tbody>
              @forelse($bobotList as $bobot)
                @php
                  $pct = $bobot->nilai_cf * 100;
                  if ($bobot->nilai_cf >= 0.8) {
                    $color = 'success';
                  } elseif ($bobot->nilai_cf >= 0.6) {
                    $color = 'primary';
                  } elseif ($bobot->nilai_cf >= 0.4) {
                    $color = 'info';
                  } elseif ($bobot->nilai_cf >= 0.2) {
                    $color = 'warning';
                  } else {
                    $color = 'secondary';
                  }
                @endphp
                <tr>
                  <td class="text-center fw-bold text-muted">{{ $bobot->urutan }}</td>
                  <td>
                    <span class="fw-bold text-dark">{{ $bobot->label }}</span>
                  </td>
                  <td class="text-center">
                    <span class="badge text-bg-{{ $color }} fs-6 px-3">
                      {{ number_format($bobot->nilai_cf, 2) }}
                    </span>
                  </td>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <div class="progress flex-grow-1" style="height: 8px;">
                        <div class="progress-bar bg-{{ $color }}" role="progressbar" style="width: {{ $pct }}%"></div>
                      </div>
                      <span class="small text-muted fw-semibold" style="width: 40px">{{ $pct }}%</span>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-center py-4 text-muted">
                    Tidak ada data bobot keyakinan.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!--end::Table Bobot-->

  <!--begin::Explanation Card-->
  <div class="col-lg-4 mb-4">
    <div class="card card-outline card-secondary shadow-sm h-100">
      <div class="card-header">
        <h3 class="card-title fw-bold mb-0">
          <i class="bi bi-calculator text-secondary me-2"></i>Formula Certainty Factor
        </h3>
      </div>
      <div class="card-body">
        <h6 class="fw-bold text-primary mb-2">1. CF Gejala Tunggal</h6>
        <div class="p-2 bg-body-tertiary rounded border font-monospace small mb-3">
          CF[H, E] = CF[Pakar] &times; CF[User]
        </div>
        <p class="small text-muted mb-3">
          Mengalikan bobot keyakinan dari basis pengetahuan pakar dengan derajat keyakinan yang dipilih pengguna/dokter hewan.
        </p>

        <h6 class="fw-bold text-success mb-2">2. Kombinasi Gejala (CF Kombinasi)</h6>
        <div class="p-2 bg-body-tertiary rounded border font-monospace small mb-3">
          CF_gabungan = CF_lama + CF_baru &times; (1 - CF_lama)
        </div>
        <p class="small text-muted mb-3">
          Menggabungkan beberapa gejala yang teridentifikasi untuk menghasilkan persentase keyakinan akhir penyakit.
        </p>

        <h6 class="fw-bold text-info mb-2">3. Persentase Akhir</h6>
        <div class="p-2 bg-body-tertiary rounded border font-monospace small mb-0">
          Persentase = CF_akhir &times; 100%
        </div>
      </div>
    </div>
  </div>
  <!--end::Explanation Card-->
</div>
@endsection

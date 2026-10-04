@extends('layouts.admin')

@section('title', 'Basis Pengetahuan (CF) | ' . config('app.name', 'AxionVet'))
@section('page-title', 'Basis Pengetahuan Certainty Factor')

@section('breadcrumbs')
  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
  <li class="breadcrumb-item">Sistem Pakar (CF)</li>
  <li class="breadcrumb-item active" aria-current="page">Basis Pengetahuan</li>
@endsection

@section('content')
<!--begin::Stat Summary-->
<div class="row mb-3">
  <div class="col-md-4 col-sm-6 mb-3">
    <div class="small-box text-bg-primary shadow-sm rounded-3">
      <div class="inner">
        <h3>{{ $totalRules }}</h3>
        <p class="mb-0">Total Aturan (Rules) CF</p>
      </div>
      <i class="small-box-icon bi bi-diagram-3-fill"></i>
    </div>
  </div>
  <div class="col-md-4 col-sm-6 mb-3">
    <div class="small-box text-bg-info shadow-sm rounded-3">
      <div class="inner">
        <h3>{{ number_format($avgCf, 2) }}</h3>
        <p class="mb-0">Rata-rata Nilai CF Pakar</p>
      </div>
      <i class="small-box-icon bi bi-percent"></i>
    </div>
  </div>
  <div class="col-md-4 col-sm-12 mb-3">
    <div class="small-box text-bg-success shadow-sm rounded-3">
      <div class="inner">
        <h3>{{ $penyakitList->count() }}</h3>
        <p class="mb-0">Penyakit Terdefinisi</p>
      </div>
      <i class="small-box-icon bi bi-virus2"></i>
    </div>
  </div>
</div>
<!--end::Stat Summary-->

<!--begin::Card Table-->
<div class="card card-outline card-primary shadow-sm mb-4">
  <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
    <h3 class="card-title fw-bold mb-0">
      <i class="bi bi-diagram-3-fill text-primary me-2"></i>Matriks Relasi Aturan (Penyakit &harr; Gejala)
    </h3>
    <div class="card-tools d-flex flex-wrap align-items-center gap-2">
      <!-- Filter & Search Form -->
      <form action="{{ route('admin.basis-pengetahuan') }}" method="GET" class="d-flex flex-wrap align-items-center gap-2">
        <select name="penyakit_id" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
          <option value="">Semua Penyakit</option>
          @foreach($penyakitList as $p)
            <option value="{{ $p->id }}" {{ (string)($penyakitId ?? '') === (string)$p->id ? 'selected' : '' }}>
              [{{ $p->kode_penyakit }}] {{ $p->nama_penyakit }} ({{ $p->kategori->nama_kategori ?? 'Umum' }})
            </option>
          @endforeach
        </select>

        <div class="input-group input-group-sm" style="width: 220px;">
          <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Cari penyakit / gejala..."
            value="{{ $search ?? '' }}"
          />
          <button class="btn btn-outline-secondary" type="submit">
            <i class="bi bi-search"></i>
          </button>
          @if(!empty($search) || !empty($penyakitId))
            <a href="{{ route('admin.basis-pengetahuan') }}" class="btn btn-outline-danger" title="Reset filter">
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
            <th>Penyakit Terkait</th>
            <th>Gejala Klinis</th>
            <th class="text-center" style="width: 140px">Bobot CF Pakar</th>
            <th class="text-center" style="width: 180px">Interpretasi Keyakinan</th>
          </tr>
        </thead>
        <tbody>
          @forelse($rules as $index => $item)
            @php
              $cf = $item->cf_pakar;
              if ($cf >= 0.8) {
                $badgeClass = 'text-bg-success';
                $label = 'Sangat Yakin';
              } elseif ($cf >= 0.6) {
                $badgeClass = 'text-bg-primary';
                $label = 'Yakin';
              } elseif ($cf >= 0.4) {
                $badgeClass = 'text-bg-info';
                $label = 'Cukup Yakin';
              } elseif ($cf >= 0.2) {
                $badgeClass = 'text-bg-warning text-dark';
                $label = 'Sedikit Yakin';
              } else {
                $badgeClass = 'text-bg-secondary';
                $label = 'Tidak Tahu / Rendah';
              }
            @endphp
            <tr>
              <td class="text-center text-muted fw-semibold">{{ $rules->firstItem() + $index }}</td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="badge text-bg-light border font-monospace me-2">{{ $item->penyakit->kode_penyakit ?? '-' }}</span>
                  <div>
                    <span class="fw-bold text-dark">{{ $item->penyakit->nama_penyakit ?? '-' }}</span>
                    @if($item->penyakit?->kategori)
                      <span class="badge text-bg-light text-secondary border ms-1 small">
                        {{ $item->penyakit->kategori->nama_kategori }}
                      </span>
                    @endif
                  </div>
                </div>
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <span class="badge text-bg-light border font-monospace me-2">{{ $item->gejala->kode_gejala ?? '-' }}</span>
                  <span>{{ $item->gejala->nama_gejala ?? '-' }}</span>
                </div>
              </td>
              <td class="text-center">
                <span class="badge {{ $badgeClass }} fs-6 px-3">
                  {{ number_format($item->cf_pakar, 2) }}
                </span>
              </td>
              <td class="text-center">
                <span class="small fw-semibold text-secondary">{{ $label }}</span>
                <div class="progress mt-1" style="height: 4px;">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $cf * 100 }}%"></div>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center py-4 text-muted">
                <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                Tidak ada data aturan basis pengetahuan yang ditemukan.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!-- /.card-body -->

  @if($rules->hasPages())
    <div class="card-footer bg-body-tertiary clearfix">
      <div class="float-end">
        {{ $rules->links('pagination::bootstrap-5') }}
      </div>
    </div>
  @endif
</div>
<!--end::Card Table-->
@endsection

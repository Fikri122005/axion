@extends('layouts.admin')

@section('title', 'Data Penyakit | ' . config('app.name', 'AxionVet'))
@section('page-title', 'Data Penyakit')

@section('breadcrumbs')
  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
  <li class="breadcrumb-item">Master Data</li>
  <li class="breadcrumb-item active" aria-current="page">Data Penyakit</li>
@endsection

@section('content')
<!--begin::Stat Summary-->
<div class="row mb-3">
  <div class="col-md-4 col-sm-6 mb-3">
    <div class="small-box text-bg-success shadow-sm rounded-3">
      <div class="inner">
        <h3>{{ $totalPenyakit }}</h3>
        <p class="mb-0">Total Jenis Penyakit</p>
      </div>
      <i class="small-box-icon bi bi-virus2"></i>
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
        <h3>{{ $penyakit->total() }}</h3>
        <p class="mb-0">Data Ditampilkan</p>
      </div>
      <i class="small-box-icon bi bi-funnel"></i>
    </div>
  </div>
</div>
<!--end::Stat Summary-->

<!--begin::Card Table-->
<div class="card card-outline card-success shadow-sm mb-4">
  <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
    <h3 class="card-title fw-bold mb-0">
      <i class="bi bi-virus2 text-success me-2"></i>Daftar Penyakit Hewan
    </h3>
    <div class="card-tools d-flex flex-wrap align-items-center gap-2">
      <!-- Filter & Search Form -->
      <form action="{{ route('admin.penyakit') }}" method="GET" class="d-flex flex-wrap align-items-center gap-2">
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
            placeholder="Cari kode/nama penyakit..."
            value="{{ $search ?? '' }}"
          />
          <button class="btn btn-outline-secondary" type="submit">
            <i class="bi bi-search"></i>
          </button>
          @if(!empty($search) || !empty($kategoriId))
            <a href="{{ route('admin.penyakit') }}" class="btn btn-outline-danger" title="Reset filter">
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
            <th style="width: 100px">Kode</th>
            <th>Nama Penyakit</th>
            <th>Kategori Hewan</th>
            <th class="text-center">Jml Gejala</th>
            <th>Penyebab Singkat</th>
            <th class="text-center" style="width: 120px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($penyakit as $index => $item)
            <tr>
              <td class="text-center text-muted fw-semibold">{{ $penyakit->firstItem() + $index }}</td>
              <td>
                <span class="badge text-bg-light border fw-bold text-dark font-monospace">{{ $item->kode_penyakit }}</span>
              </td>
              <td>
                <span class="fw-bold text-dark">{{ $item->nama_penyakit }}</span>
              </td>
              <td>
                <span class="badge text-bg-primary-subtle text-primary border border-primary-subtle">
                  {{ $item->kategori->nama_kategori ?? 'Umum' }}
                </span>
              </td>
              <td class="text-center">
                <span class="badge text-bg-info">
                  {{ $item->gejala_count }} Gejala
                </span>
              </td>
              <td>
                <span class="text-secondary small">{{ Str::limit($item->penyebab ?? $item->deskripsi, 50, '...') }}</span>
              </td>
              <td class="text-center">
                <button
                  type="button"
                  class="btn btn-xs btn-outline-success rounded-pill px-2"
                  data-bs-toggle="modal"
                  data-bs-target="#modalDetailPenyakit{{ $item->id }}"
                  title="Lihat Detail Medis"
                >
                  <i class="bi bi-file-medical"></i> Detail
                </button>
              </td>
            </tr>

            <!-- Modal Detail Penyakit -->
            <div class="modal fade" id="modalDetailPenyakit{{ $item->id }}" tabindex="-1" aria-labelledby="modalDetailPenyakitLabel{{ $item->id }}" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                  <div class="modal-header bg-success-subtle">
                    <h5 class="modal-title fw-bold text-success-emphasis" id="modalDetailPenyakitLabel{{ $item->id }}">
                      <i class="bi bi-virus2 me-2"></i>[{{ $item->kode_penyakit }}] {{ $item->nama_penyakit }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="d-flex align-items-center gap-2 mb-3">
                      <span class="badge text-bg-primary">Kategori: {{ $item->kategori->nama_kategori ?? 'Umum' }}</span>
                      <span class="badge text-bg-info">{{ $item->gejala_count }} Gejala Terkait</span>
                    </div>

                    <div class="mb-3">
                      <h6 class="fw-bold text-secondary border-bottom pb-1"><i class="bi bi-info-circle me-1"></i>Deskripsi</h6>
                      <p class="small text-secondary">{{ $item->deskripsi ?? 'Tidak ada data deskripsi.' }}</p>
                    </div>

                    <div class="mb-3">
                      <h6 class="fw-bold text-secondary border-bottom pb-1"><i class="bi bi-bug me-1"></i>Penyebab</h6>
                      <p class="small text-secondary">{{ $item->penyebab ?? 'Tidak ada data penyebab.' }}</p>
                    </div>

                    <div class="mb-3">
                      <h6 class="fw-bold text-secondary border-bottom pb-1"><i class="bi bi-shield-check me-1"></i>Pencegahan</h6>
                      <p class="small text-secondary">{{ $item->pencegahan ?? 'Tidak ada data pencegahan.' }}</p>
                    </div>

                    <div class="mb-3">
                      <h6 class="fw-bold text-secondary border-bottom pb-1"><i class="bi bi-prescription2 me-1"></i>Solusi & Penanganan</h6>
                      <p class="small text-secondary">{{ $item->solusi ?? 'Tidak ada data solusi.' }}</p>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="{{ route('admin.basis-pengetahuan', ['penyakit_id' => $item->id]) }}" class="btn btn-sm btn-success">
                      <i class="bi bi-diagram-3-fill me-1"></i>Lihat Rules CF
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <tr>
              <td colspan="7" class="text-center py-4 text-muted">
                <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                Tidak ada data penyakit yang ditemukan.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!-- /.card-body -->

  @if($penyakit->hasPages())
    <div class="card-footer bg-body-tertiary clearfix">
      <div class="float-end">
        {{ $penyakit->links('pagination::bootstrap-5') }}
      </div>
    </div>
  @endif
</div>
<!--end::Card Table-->
@endsection

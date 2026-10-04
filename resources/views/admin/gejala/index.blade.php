@extends('layouts.admin')

@section('title', 'Data Gejala | ' . config('app.name', 'AxionVet'))
@section('page-title', 'Data Gejala')

@section('breadcrumbs')
  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
  <li class="breadcrumb-item">Master Data</li>
  <li class="breadcrumb-item active" aria-current="page">Data Gejala</li>
@endsection

@section('content')
<!--begin::Stat Summary-->
<div class="row mb-3">
  <div class="col-md-4 col-sm-6 mb-3">
    <div class="small-box text-bg-warning shadow-sm rounded-3">
      <div class="inner">
        <h3>{{ $totalGejala }}</h3>
        <p class="mb-0">Total Gejala Klinis</p>
      </div>
      <i class="small-box-icon bi bi-clipboard2-pulse-fill"></i>
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
        <h3>{{ $gejala->total() }}</h3>
        <p class="mb-0">Gejala Ditampilkan</p>
      </div>
      <i class="small-box-icon bi bi-funnel"></i>
    </div>
  </div>
</div>
<!--end::Stat Summary-->

<!--begin::Card Table-->
<div class="card card-outline card-warning shadow-sm mb-4">
  <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
    <h3 class="card-title fw-bold mb-0">
      <i class="bi bi-clipboard2-pulse-fill text-warning me-2"></i>Daftar Gejala Klinis
    </h3>
    <div class="card-tools d-flex flex-wrap align-items-center gap-2">
      <!-- Filter & Search Form -->
      <form action="{{ route('admin.gejala') }}" method="GET" class="d-flex flex-wrap align-items-center gap-2">
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
            placeholder="Cari kode/nama gejala..."
            value="{{ $search ?? '' }}"
          />
          <button class="btn btn-outline-secondary" type="submit">
            <i class="bi bi-search"></i>
          </button>
          @if(!empty($search) || !empty($kategoriId))
            <a href="{{ route('admin.gejala') }}" class="btn btn-outline-danger" title="Reset filter">
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
            <th class="text-center" style="width: 60px">#</th>
            <th style="width: 110px">Kode Gejala</th>
            <th>Nama Gejala Klinis</th>
            <th>Spesifikasi Kategori</th>
            <th class="text-center" style="width: 160px">Terkait di Penyakit</th>
          </tr>
        </thead>
        <tbody>
          @forelse($gejala as $index => $item)
            <tr>
              <td class="text-center text-muted fw-semibold">{{ $gejala->firstItem() + $index }}</td>
              <td>
                <span class="badge text-bg-light border fw-bold text-dark font-monospace">{{ $item->kode_gejala }}</span>
              </td>
              <td>
                <span class="fw-semibold text-dark">{{ $item->nama_gejala }}</span>
              </td>
              <td>
                @if($item->kategori)
                  <span class="badge text-bg-primary-subtle text-primary border border-primary-subtle">
                    {{ $item->kategori->nama_kategori }}
                  </span>
                @else
                  <span class="badge text-bg-secondary-subtle text-secondary border border-secondary-subtle">
                    Umum (Semua Hewan)
                  </span>
                @endif
              </td>
              <td class="text-center">
                <span class="badge text-bg-info">
                  {{ $item->penyakit_count }} Penyakit
                </span>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center py-4 text-muted">
                <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                Tidak ada data gejala klinis yang ditemukan.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!-- /.card-body -->

  @if($gejala->hasPages())
    <div class="card-footer bg-body-tertiary clearfix">
      <div class="float-end">
        {{ $gejala->links('pagination::bootstrap-5') }}
      </div>
    </div>
  @endif
</div>
<!--end::Card Table-->
@endsection

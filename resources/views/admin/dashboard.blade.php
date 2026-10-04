@extends('layouts.admin')

@section('title', 'Dashboard | ' . config('app.name', 'AxionVet'))
@section('page-title', 'Dashboard Sistem Pakar')

@section('breadcrumbs')
  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection

@section('content')
<!--begin::Small Box Row (Statistik Utama)-->
<div class="row" id="small-box">
  <!--begin::Col Kategori Hewan-->
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-primary">
      <div class="inner">
        <h3>{{ $stats['totalKategori'] }}</h3>
        <p>Kategori Hewan</p>
      </div>
      <i class="small-box-icon bi bi-tags-fill"></i>
      <a
        href="#kategori-hewan"
        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
      >
        Lihat Kategori <i class="bi bi-arrow-right-circle"></i>
      </a>
    </div>
  </div>
  <!--end::Col Kategori Hewan-->

  <!--begin::Col Data Penyakit-->
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-success">
      <div class="inner">
        <h3>{{ $stats['totalPenyakit'] }}</h3>
        <p>Data Penyakit</p>
      </div>
      <i class="small-box-icon bi bi-virus2"></i>
      <a
        href="#daftar-penyakit"
        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
      >
        Lihat Penyakit <i class="bi bi-arrow-right-circle"></i>
      </a>
    </div>
  </div>
  <!--end::Col Data Penyakit-->

  <!--begin::Col Data Gejala-->
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-warning">
      <div class="inner">
        <h3>{{ $stats['totalGejala'] }}</h3>
        <p>Data Gejala</p>
      </div>
      <i class="small-box-icon bi bi-clipboard2-pulse-fill"></i>
      <a
        href="#daftar-gejala"
        class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover"
      >
        Lihat Gejala <i class="bi bi-arrow-right-circle"></i>
      </a>
    </div>
  </div>
  <!--end::Col Data Gejala-->

  <!--begin::Col Basis Pengetahuan-->
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-danger">
      <div class="inner">
        <h3>{{ $stats['totalBasisPengetahuan'] }}</h3>
        <p>Basis Pengetahuan (Rules)</p>
      </div>
      <i class="small-box-icon bi bi-diagram-3-fill"></i>
      <a
        href="#basis-pengetahuan"
        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
      >
        Lihat Aturan CF <i class="bi bi-arrow-right-circle"></i>
      </a>
    </div>
  </div>
  <!--end::Col Basis Pengetahuan-->
</div>
<!--end::Small Box Row-->

<!--begin::Info Box Row-->
<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon text-bg-info shadow-sm">
        <i class="bi bi-journal-medical"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Riwayat Diagnosa</span>
        <span class="info-box-number">{{ $stats['totalRiwayat'] }} <small>kasus</small></span>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon text-bg-secondary shadow-sm">
        <i class="bi bi-sliders2-vertical"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Bobot Keyakinan User</span>
        <span class="info-box-number">{{ $stats['totalBobotKeyakinan'] }} <small>pilihan CF</small></span>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon text-bg-success shadow-sm">
        <i class="bi bi-person-badge-fill"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Dokter Hewan (Pakar)</span>
        <span class="info-box-number">{{ $stats['totalPakar'] }} <small>pakar</small></span>
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon text-bg-primary shadow-sm">
        <i class="bi bi-people-fill"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Total Pengguna</span>
        <span class="info-box-number">{{ $stats['totalUsers'] }} <small>akun</small></span>
      </div>
    </div>
  </div>
</div>
<!--end::Info Box Row-->

<!--begin::Main Content Row-->
<div class="row">
  <!--begin::Left Col (Tabel Penyakit & Aturan)-->
  <div class="col-lg-8">
    <!--begin::Daftar Penyakit Card-->
    <div class="card mb-4" id="daftar-penyakit">
      <div class="card-header border-transparent d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">
          <i class="bi bi-virus2 me-2 text-success"></i>Daftar Penyakit & Kategori Hewan
        </h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover align-middle m-0">
            <thead class="table-light">
              <tr>
                <th style="width: 90px;">Kode</th>
                <th>Nama Penyakit</th>
                <th>Kategori Hewan</th>
                <th class="text-center">Jml Gejala</th>
                <th>Solusi / Penanganan</th>
              </tr>
            </thead>
            <tbody>
              @forelse($penyakitList as $p)
                <tr>
                  <td><span class="badge text-bg-primary">{{ $p->kode_penyakit }}</span></td>
                  <td class="fw-semibold">{{ $p->nama_penyakit }}</td>
                  <td>
                    <span class="badge text-bg-info">{{ $p->kategori->nama_kategori ?? 'Umum' }}</span>
                  </td>
                  <td class="text-center">
                    <span class="badge rounded-pill text-bg-secondary">{{ $p->gejala_count }} gejala</span>
                  </td>
                  <td>
                    <small class="text-secondary text-truncate d-inline-block" style="max-width: 250px;">
                      {{ $p->solusi }}
                    </small>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="text-center py-3 text-secondary">Belum ada data penyakit.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer text-end">
        <small class="text-muted">Total terdaftar: {{ $stats['totalPenyakit'] }} penyakit</small>
      </div>
    </div>
    <!--end::Daftar Penyakit Card-->

    <!--begin::Basis Pengetahuan Card-->
    <div class="card mb-4" id="basis-pengetahuan">
      <div class="card-header border-transparent d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">
          <i class="bi bi-diagram-3-fill me-2 text-danger"></i>Basis Pengetahuan (Rules Certainty Factor)
        </h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-striped align-middle m-0">
            <thead class="table-light">
              <tr>
                <th>Kategori</th>
                <th>Penyakit</th>
                <th>Gejala Terkait</th>
                <th class="text-center">CF Pakar (Bobot)</th>
              </tr>
            </thead>
            <tbody>
              @forelse($basisPengetahuanList as $bp)
                <tr>
                  <td><span class="badge text-bg-light border">{{ $bp->nama_kategori }}</span></td>
                  <td>
                    <span class="badge text-bg-success me-1">{{ $bp->kode_penyakit }}</span>
                    {{ $bp->nama_penyakit }}
                  </td>
                  <td>
                    <span class="badge text-bg-warning me-1">{{ $bp->kode_gejala }}</span>
                    {{ $bp->nama_gejala }}
                  </td>
                  <td class="text-center">
                    <span class="badge text-bg-danger fs-7">{{ number_format($bp->cf_pakar, 2) }}</span>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-center py-3 text-secondary">Belum ada aturan basis pengetahuan.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer text-end">
        <small class="text-muted">Total aturan aktif: {{ $stats['totalBasisPengetahuan'] }} aturan</small>
      </div>
    </div>
    <!--end::Basis Pengetahuan Card-->
  </div>
  <!--end::Left Col-->

  <!--begin::Right Col (Kategori & Users)-->
  <div class="col-lg-4">
    <!--begin::Kategori Hewan Card-->
    <div class="card mb-4" id="kategori-hewan">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">
          <i class="bi bi-tags-fill me-2 text-primary"></i>Kategori Hewan
        </h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        @forelse($kategoriList as $kat)
          <div class="d-flex justify-content-between align-items-center mb-3 p-2 rounded bg-body-tertiary">
            <div>
              <h6 class="mb-0 fw-bold">{{ $kat->nama_kategori }}</h6>
              <small class="text-secondary">{{ $kat->deskripsi ?? 'Tidak ada deskripsi' }}</small>
            </div>
            <div class="text-end">
              <span class="badge text-bg-success d-block mb-1">{{ $kat->penyakit_count }} Penyakit</span>
              <span class="badge text-bg-warning d-block">{{ $kat->gejala_count }} Gejala</span>
            </div>
          </div>
        @empty
          <p class="text-secondary text-center">Belum ada kategori hewan.</p>
        @endforelse
      </div>
    </div>
    <!--end::Kategori Hewan Card-->

    <!--begin::Daftar Gejala Card-->
    <div class="card mb-4" id="daftar-gejala">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">
          <i class="bi bi-clipboard2-pulse me-2 text-warning"></i>Sample Gejala Terdaftar
        </h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <ul class="list-group list-group-flush">
          @forelse($gejalaList as $g)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <span class="badge text-bg-warning me-2">{{ $g->kode_gejala }}</span>
                <span>{{ $g->nama_gejala }}</span>
              </div>
              <small class="text-muted ms-2">
                {{ $g->kategori->nama_kategori ?? 'Umum' }}
              </small>
            </li>
          @empty
            <li class="list-group-item text-center text-secondary">Belum ada gejala.</li>
          @endforelse
        </ul>
      </div>
    </div>
    <!--end::Daftar Gejala Card-->

    <!--begin::Akun Pengguna Card-->
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">
          <i class="bi bi-people-fill me-2 text-primary"></i>Pengguna Terdaftar
        </h3>
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <ul class="list-group list-group-flush">
          @forelse($recentUsers as $u)
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <div>
                <span class="fw-semibold">{{ $u->name }}</span>
                <br>
                <small class="text-secondary">{{ $u->email }}</small>
              </div>
              <span class="badge {{ $u->role === 'admin' ? 'text-bg-danger' : ($u->role === 'pakar' ? 'text-bg-success' : 'text-bg-secondary') }}">
                {{ strtoupper($u->role) }}
              </span>
            </li>
          @empty
            <li class="list-group-item text-center text-secondary">Belum ada user.</li>
          @endforelse
        </ul>
      </div>
    </div>
    <!--end::Akun Pengguna Card-->
  </div>
  <!--end::Right Col-->
</div>
<!--end::Main Content Row-->
@endsection

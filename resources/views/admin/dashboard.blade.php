@extends('layouts.admin')

<<<<<<< HEAD
@section('title', 'Dashboard | ' . config('app.name', 'Axion Admin'))
@section('page-title', 'Dashboard v1')
=======
@section('title', 'Dashboard | ' . config('app.name', 'AxionVet'))
@section('page-title', 'Dashboard Sistem Pakar')
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354

@section('breadcrumbs')
  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection

@section('content')
<<<<<<< HEAD
<!--begin::Small Box Row-->
<div class="row" id="small-box">
  <!--begin::Col-->
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-primary">
      <div class="inner">
        <h3>150</h3>
        <p>New Orders</p>
      </div>
      <svg
        class="small-box-icon"
        fill="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
      >
        <path
          d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z"
        ></path>
      </svg>
      <a
        href="#"
        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
      >
        More info <i class="bi bi-link-45deg"></i>
      </a>
    </div>
  </div>
  <!--end::Col-->

  <!--begin::Col-->
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-success">
      <div class="inner">
        <h3>53<sup class="fs-5">%</sup></h3>
        <p>Bounce Rate</p>
      </div>
      <svg
        class="small-box-icon"
        fill="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
      >
        <path
          d="M18.375 2.25c-1.035 0-1.875.84-1.875 1.875v15.75c0 1.035.84 1.875 1.875 1.875h.75c1.035 0 1.875-.84 1.875-1.875V4.125c0-1.036-.84-1.875-1.875-1.875h-.75zM9.75 8.625c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-.75a1.875 1.875 0 01-1.875-1.875V8.625zM3 13.125c0-1.036.84-1.875 1.875-1.875h.75c1.036 0 1.875.84 1.875 1.875v6.75c0 1.035-.84 1.875-1.875 1.875h-.75A1.875 1.875 0 013 19.875v-6.75z"
        ></path>
      </svg>
      <a
        href="#"
        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
      >
        More info <i class="bi bi-link-45deg"></i>
      </a>
    </div>
  </div>
  <!--end::Col-->

  <!--begin::Col-->
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-warning">
      <div class="inner">
        <h3>44</h3>
        <p>User Registrations</p>
      </div>
      <svg
        class="small-box-icon"
        fill="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
      >
        <path
          d="M6.25 6.375a4.125 4.125 0 118.25 0 4.125 4.125 0 01-8.25 0zM3.25 19.125a7.125 7.125 0 0114.25 0v.75H3.25v-.75z"
        ></path>
      </svg>
      <a
        href="#"
        class="small-box-footer link-dark link-underline-opacity-0 link-underline-opacity-50-hover"
      >
        More info <i class="bi bi-link-45deg"></i>
      </a>
    </div>
  </div>
  <!--end::Col-->

  <!--begin::Col-->
  <div class="col-lg-3 col-6">
    <div class="small-box text-bg-danger">
      <div class="inner">
        <h3>65</h3>
        <p>Unique Visitors</p>
      </div>
      <svg
        class="small-box-icon"
        fill="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
      >
        <path
          clip-rule="evenodd"
          fill-rule="evenodd"
          d="M2.25 13.5a8.25 8.25 0 018.25-8.25.75.75 0 01.75.75v6.75H18a.75.75 0 01.75.75 8.25 8.25 0 01-16.5 0z"
        ></path>
        <path
          clip-rule="evenodd"
          fill-rule="evenodd"
          d="M12.75 3a.75.75 0 01.75-.75 8.25 8.25 0 018.25 8.25.75.75 0 01-.75.75h-7.5a.75.75 0 01-.75-.75V3z"
        ></path>
      </svg>
      <a
        href="#"
        class="small-box-footer link-light link-underline-opacity-0 link-underline-opacity-50-hover"
      >
        More info <i class="bi bi-link-45deg"></i>
      </a>
    </div>
  </div>
  <!--end::Col-->
=======
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
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354
</div>
<!--end::Small Box Row-->

<!--begin::Info Box Row-->
<<<<<<< HEAD
<div class="row" id="info-box">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon text-bg-primary shadow-sm">
        <i class="bi bi-gear-fill"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">CPU Traffic</span>
        <span class="info-box-number">10 <small>%</small></span>
=======
<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon text-bg-info shadow-sm">
        <i class="bi bi-journal-medical"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Riwayat Diagnosa</span>
        <span class="info-box-number">{{ $stats['totalRiwayat'] }} <small>kasus</small></span>
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
<<<<<<< HEAD
      <span class="info-box-icon text-bg-danger shadow-sm">
        <i class="bi bi-hand-thumbs-up-fill"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Likes</span>
        <span class="info-box-number">41,410</span>
=======
      <span class="info-box-icon text-bg-secondary shadow-sm">
        <i class="bi bi-sliders2-vertical"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Bobot Keyakinan User</span>
        <span class="info-box-number">{{ $stats['totalBobotKeyakinan'] }} <small>pilihan CF</small></span>
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
      <span class="info-box-icon text-bg-success shadow-sm">
<<<<<<< HEAD
        <i class="bi bi-cart-fill"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Sales</span>
        <span class="info-box-number">760</span>
=======
        <i class="bi bi-person-badge-fill"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Dokter Hewan (Pakar)</span>
        <span class="info-box-number">{{ $stats['totalPakar'] }} <small>pakar</small></span>
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354
      </div>
    </div>
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <div class="info-box">
<<<<<<< HEAD
      <span class="info-box-icon text-bg-warning shadow-sm">
        <i class="bi bi-people-fill text-white"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">New Members</span>
        <span class="info-box-number">2,000</span>
=======
      <span class="info-box-icon text-bg-primary shadow-sm">
        <i class="bi bi-people-fill"></i>
      </span>
      <div class="info-box-content">
        <span class="info-box-text">Total Pengguna</span>
        <span class="info-box-number">{{ $stats['totalUsers'] }} <small>akun</small></span>
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354
      </div>
    </div>
  </div>
</div>
<!--end::Info Box Row-->

<<<<<<< HEAD
<!--begin::Main Charts & Tables Row-->
<div class="row" id="cards">
  <!--begin::Left Col (Charts & Orders)-->
  <div class="col-lg-8">
    <!--begin::Sales Chart Card-->
    <div class="card mb-4">
      <div class="card-header border-0">
        <div class="d-flex justify-content-between align-items-center">
          <h3 class="card-title mb-0">Sales & Revenue Overview</h3>
          <div class="card-tools">
            <button
              type="button"
              class="btn btn-tool"
              data-lte-toggle="card-collapse"
              aria-label="Collapse card"
            >
              <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
              <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
            </button>
            <button
              type="button"
              class="btn btn-tool"
              data-lte-toggle="card-remove"
              aria-label="Remove card"
            >
              <i class="bi bi-x-lg"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="d-flex mb-3">
          <p class="d-flex flex-column mb-0">
            <span class="fw-bold fs-5">$18,230.00</span>
            <span class="text-secondary fs-7">Sales Over Time</span>
          </p>
          <p class="ms-auto d-flex flex-column text-end mb-0">
            <span class="text-success fw-bold">
              <i class="bi bi-arrow-up"></i> 12.5%
            </span>
            <span class="text-secondary fs-7">Since last week</span>
          </p>
        </div>
        <div class="position-relative" style="height: 300px;">
          <canvas id="sales-chart"></canvas>
        </div>
      </div>
    </div>
    <!--end::Sales Chart Card-->

    <!--begin::Recent Orders Card-->
    <div class="card mb-4" id="recent-orders">
      <div class="card-header border-transparent">
        <h3 class="card-title">Latest Orders</h3>
        <div class="card-tools">
          <button
            type="button"
            class="btn btn-tool"
            data-lte-toggle="card-collapse"
          >
            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
          </button>
          <button
            type="button"
            class="btn btn-tool"
            data-lte-toggle="card-remove"
          >
            <i class="bi bi-x-lg"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Item</th>
                <th>Status</th>
                <th>Popularity</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><a href="#" class="link-primary">OR9842</a></td>
                <td>Call of Duty IV</td>
                <td><span class="badge text-bg-success">Shipped</span></td>
                <td>
                  <div class="progress progress-xs">
                    <div class="progress-bar text-bg-success" style="width: 90%"></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td><a href="#" class="link-primary">OR1848</a></td>
                <td>Samsung Smart TV</td>
                <td><span class="badge text-bg-warning">Pending</span></td>
                <td>
                  <div class="progress progress-xs">
                    <div class="progress-bar text-bg-warning" style="width: 70%"></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td><a href="#" class="link-primary">OR7429</a></td>
                <td>iPhone 15 Pro</td>
                <td><span class="badge text-bg-danger">Delivered</span></td>
                <td>
                  <div class="progress progress-xs">
                    <div class="progress-bar text-bg-danger" style="width: 85%"></div>
                  </div>
                </td>
              </tr>
              <tr>
                <td><a href="#" class="link-primary">OR9842</a></td>
                <td>Sony PlayStation 5</td>
                <td><span class="badge text-bg-info">Processing</span></td>
                <td>
                  <div class="progress progress-xs">
                    <div class="progress-bar text-bg-info" style="width: 60%"></div>
                  </div>
                </td>
              </tr>
=======
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
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354
            </tbody>
          </table>
        </div>
      </div>
<<<<<<< HEAD
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <a href="javascript:void(0)" class="btn btn-sm btn-primary float-start">Place New Order</a>
        <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-end">View All Orders</a>
      </div>
      <!-- /.card-footer -->
    </div>
    <!--end::Recent Orders Card-->
  </div>
  <!--end::Left Col-->

  <!--begin::Right Col-->
  <div class="col-lg-4">
    <!--begin::Server Status Card-->
    <div class="card mb-4">
      <div class="card-header">
        <h3 class="card-title">System Status</h3>
=======
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
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354
        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
<<<<<<< HEAD
        <div class="mb-3">
          <div class="d-flex justify-content-between mb-1">
            <span>Memory Usage</span>
            <span class="fw-bold">64%</span>
          </div>
          <div class="progress" style="height: 8px;">
            <div class="progress-bar text-bg-primary" style="width: 64%"></div>
          </div>
        </div>
        <div class="mb-3">
          <div class="d-flex justify-content-between mb-1">
            <span>Disk Space</span>
            <span class="fw-bold">42%</span>
          </div>
          <div class="progress" style="height: 8px;">
            <div class="progress-bar text-bg-success" style="width: 42%"></div>
          </div>
        </div>
        <div class="mb-3">
          <div class="d-flex justify-content-between mb-1">
            <span>Bandwidth</span>
            <span class="fw-bold">88%</span>
          </div>
          <div class="progress" style="height: 8px;">
            <div class="progress-bar text-bg-warning" style="width: 88%"></div>
          </div>
        </div>
        <div>
          <div class="d-flex justify-content-between mb-1">
            <span>Database Load</span>
            <span class="fw-bold">25%</span>
          </div>
          <div class="progress" style="height: 8px;">
            <div class="progress-bar text-bg-info" style="width: 25%"></div>
          </div>
        </div>
      </div>
    </div>
    <!--end::Server Status Card-->

    <!--begin::Members Card-->
    <div class="card mb-4">
      <div class="card-header">
        <h3 class="card-title">Latest Members</h3>
        <div class="card-tools">
          <span class="badge text-bg-danger">8 New Members</span>
=======
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
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354
          <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
          </button>
        </div>
      </div>
<<<<<<< HEAD
      <!-- /.card-header -->
      <div class="card-body p-0">
        <ul class="users-list clearfix list-unstyled d-flex flex-wrap justify-content-around p-3 mb-0 text-center">
          <li class="m-2">
            <img src="{{ asset('adminlte/assets/img/user1-128x128.jpg') }}" class="rounded-circle mb-1" width="60" height="60" alt="User Image" />
            <a class="users-list-name d-block fs-7 text-truncate" style="max-width: 70px;" href="#">Alexander</a>
            <span class="users-list-date fs-8 text-secondary">Today</span>
          </li>
          <li class="m-2">
            <img src="{{ asset('adminlte/assets/img/user8-128x128.jpg') }}" class="rounded-circle mb-1" width="60" height="60" alt="User Image" />
            <a class="users-list-name d-block fs-7 text-truncate" style="max-width: 70px;" href="#">Norman</a>
            <span class="users-list-date fs-8 text-secondary">Yesterday</span>
          </li>
          <li class="m-2">
            <img src="{{ asset('adminlte/assets/img/user7-128x128.jpg') }}" class="rounded-circle mb-1" width="60" height="60" alt="User Image" />
            <a class="users-list-name d-block fs-7 text-truncate" style="max-width: 70px;" href="#">Jane</a>
            <span class="users-list-date fs-8 text-secondary">12 Jan</span>
          </li>
          <li class="m-2">
            <img src="{{ asset('adminlte/assets/img/user6-128x128.jpg') }}" class="rounded-circle mb-1" width="60" height="60" alt="User Image" />
            <a class="users-list-name d-block fs-7 text-truncate" style="max-width: 70px;" href="#">John</a>
            <span class="users-list-date fs-8 text-secondary">15 Jan</span>
          </li>
        </ul>
      </div>
      <!-- /.card-body -->
      <div class="card-footer text-center">
        <a href="javascript:void(0)" class="link-primary">View All Users</a>
      </div>
      <!-- /.card-footer -->
    </div>
    <!--end::Members Card-->
  </div>
  <!--end::Right Col-->
</div>
<!--end::Main Charts & Tables Row-->
@endsection

@push('scripts')
<!--begin::Chart.js-->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('sales-chart');
    if (ctx) {
      new Chart(ctx, {
        type: 'line',
        data: {
          labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          datasets: [
            {
              label: 'This Year',
              data: [65, 59, 80, 81, 56, 95, 100, 85, 110, 120, 105, 130],
              borderColor: '#0d6efd',
              backgroundColor: 'rgba(13, 110, 253, 0.1)',
              fill: true,
              tension: 0.3,
            },
            {
              label: 'Last Year',
              data: [28, 48, 40, 19, 86, 27, 90, 60, 75, 80, 70, 85],
              borderColor: '#6c757d',
              borderDash: [5, 5],
              fill: false,
              tension: 0.3,
            }
          ]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'top',
            }
          },
          scales: {
            y: {
              beginAtZero: true,
              grid: {
                color: 'rgba(0, 0, 0, 0.05)'
              }
            },
            x: {
              grid: {
                display: false
              }
            }
          }
        }
      });
    }
  });
</script>
<!--end::Chart.js-->
@endpush
=======
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
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354

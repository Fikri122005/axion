<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <!--begin::Brand Image-->
      <img src="{{ asset('adminlte/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow" />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">{{ config('app.name', 'AxionVet') }} Admin</span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->

  <!--begin::Sidebar Search-->
  <div class="sidebar-search p-2" role="search">
    <label for="sidebar-search-input" class="visually-hidden">Filter menu</label>
    <div class="input-group">
      <input type="search" id="sidebar-search-input" class="form-control form-control-sm" placeholder="Cari menu…"
        autocomplete="off" data-lte-toggle="sidebar-search" data-lte-target="#navigation" />
      <button class="btn btn-sm btn-secondary" type="button">
        <i class="bi bi-search"></i>
      </button>
    </div>
  </div>
  <!--end::Sidebar Search-->

  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2" aria-label="Main navigation">
      <!--begin::Sidebar Menu-->
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" data-accordion="false" id="navigation">
        <li class="nav-header">MENU UTAMA</li>

        <li class="nav-item">
          <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer2"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-header">MASTER DATA</li>

        <li class="nav-item">
          <a href="{{ route('admin.kategori') }}" class="nav-link {{ request()->routeIs('admin.kategori*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-tags-fill"></i>
            <p>Kategori Hewan</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.penyakit') }}" class="nav-link {{ request()->routeIs('admin.penyakit*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-virus2"></i>
            <p>Data Penyakit</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.gejala') }}" class="nav-link {{ request()->routeIs('admin.gejala*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-clipboard2-pulse-fill"></i>
            <p>Data Gejala</p>
          </a>
        </li>

        <li class="nav-header">SISTEM PAKAR (CF)</li>

        <li class="nav-item">
          <a href="{{ route('admin.basis-pengetahuan') }}" class="nav-link {{ request()->routeIs('admin.basis-pengetahuan*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-diagram-3-fill"></i>
            <p>Basis Pengetahuan</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('admin.bobot-keyakinan') }}" class="nav-link {{ request()->routeIs('admin.bobot-keyakinan*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-sliders2-vertical"></i>
            <p>Bobot Keyakinan</p>
          </a>
        </li>

        <li class="nav-header">RIWAYAT & LAPORAN</li>

        <li class="nav-item">
          <a href="{{ route('admin.riwayat') }}" class="nav-link {{ request()->routeIs('admin.riwayat*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-journal-medical"></i>
            <p>Riwayat Diagnosa</p>
          </a>
        </li>
      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
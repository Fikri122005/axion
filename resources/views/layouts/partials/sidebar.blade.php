<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <!--begin::Brand Image-->
<<<<<<< HEAD
      <img
        src="{{ asset('adminlte/assets/img/AdminLTELogo.png') }}"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
      />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">{{ config('app.name', 'Axion') }} Admin</span>
=======
      <img src="{{ asset('adminlte/assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow" />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">{{ config('app.name', 'AxionVet') }} Admin</span>
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->

  <!--begin::Sidebar Search-->
  <div class="sidebar-search p-2" role="search">
    <label for="sidebar-search-input" class="visually-hidden">Filter menu</label>
    <div class="input-group">
<<<<<<< HEAD
      <input
        type="search"
        id="sidebar-search-input"
        class="form-control form-control-sm"
        placeholder="Search menu…"
        autocomplete="off"
        data-lte-toggle="sidebar-search"
        data-lte-target="#navigation"
      />
=======
      <input type="search" id="sidebar-search-input" class="form-control form-control-sm" placeholder="Cari menu…"
        autocomplete="off" data-lte-toggle="sidebar-search" data-lte-target="#navigation" />
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354
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
<<<<<<< HEAD
      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        data-accordion="false"
        id="navigation"
      >
        <li class="nav-header">MAIN NAVIGATION</li>

        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>
              Dashboard
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                <i class="nav-icon bi bi-circle"></i>
                <p>Dashboard v1</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">COMPONENTS</li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-box-seam-fill"></i>
            <p>
              Widgets
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.dashboard') }}#small-box" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Small Box</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.dashboard') }}#info-box" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Info Box</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('admin.dashboard') }}#cards" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Cards</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-table"></i>
            <p>
              Tables
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('admin.dashboard') }}#recent-orders" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Recent Orders</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">SYSTEM</li>

        <li class="nav-item">
          <a href="{{ url('/') }}" class="nav-link">
            <i class="nav-icon bi bi-house-door"></i>
            <p>Landing Page</p>
=======
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
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354
          </a>
        </li>
      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<<<<<<< HEAD
<!--end::Sidebar-->
=======
<!--end::Sidebar-->
>>>>>>> 4ffa67b0066a29241f078b9971b0a9af43ebb354

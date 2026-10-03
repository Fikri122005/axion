<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <!--begin::Brand Image-->
      <img
        src="{{ asset('adminlte/assets/img/AdminLTELogo.png') }}"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
      />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">{{ config('app.name', 'Axion') }} Admin</span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->

  <!--begin::Sidebar Search-->
  <div class="sidebar-search p-2" role="search">
    <label for="sidebar-search-input" class="visually-hidden">Filter menu</label>
    <div class="input-group">
      <input
        type="search"
        id="sidebar-search-input"
        class="form-control form-control-sm"
        placeholder="Search menu…"
        autocomplete="off"
        data-lte-toggle="sidebar-search"
        data-lte-target="#navigation"
      />
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
          </a>
        </li>
      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->

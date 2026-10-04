@extends('layouts.admin')

@section('title', 'Kategori Hewan | ' . config('app.name', 'AxionVet'))
@section('page-title', 'Kategori Hewan')

@section('breadcrumbs')
  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
  <li class="breadcrumb-item">Master Data</li>
  <li class="breadcrumb-item active" aria-current="page">Kategori Hewan</li>
@endsection

@section('content')
<!--begin::Alert Messages-->
@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 shadow-sm mb-3" role="alert">
    <i class="bi bi-check-circle-fill text-success fs-5"></i>
    <div class="flex-grow-1">{{ session('success') }}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if(session('error'))
  <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 shadow-sm mb-3" role="alert">
    <i class="bi bi-exclamation-octagon-fill text-danger fs-5"></i>
    <div class="flex-grow-1">{{ session('error') }}</div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

@if($errors->any())
  <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-3" role="alert">
    <div class="fw-bold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i>Terjadi kesalahan pengisian form:</div>
    <ul class="mb-0 ps-3 small">
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
<!--end::Alert Messages-->

<!--begin::Stat Cards-->
<div class="row mb-3">
  <div class="col-md-4 col-sm-6 mb-3">
    <div class="small-box text-bg-primary shadow-sm rounded-3">
      <div class="inner">
        <h3>{{ $totalKategori }}</h3>
        <p class="mb-0">Total Kategori Hewan</p>
      </div>
      <i class="small-box-icon bi bi-tags-fill"></i>
    </div>
  </div>
  <div class="col-md-4 col-sm-6 mb-3">
    <div class="small-box text-bg-success shadow-sm rounded-3">
      <div class="inner">
        <h3>{{ $kategori->sum('penyakit_count') }}</h3>
        <p class="mb-0">Total Penyakit Terdaftar</p>
      </div>
      <i class="small-box-icon bi bi-virus2"></i>
    </div>
  </div>
  <div class="col-md-4 col-sm-12 mb-3">
    <div class="small-box text-bg-info shadow-sm rounded-3">
      <div class="inner">
        <h3>{{ $kategori->sum('gejala_count') }}</h3>
        <p class="mb-0">Total Gejala Spesifik</p>
      </div>
      <i class="small-box-icon bi bi-clipboard2-pulse-fill"></i>
    </div>
  </div>
</div>
<!--end::Stat Cards-->

<!--begin::Card Table-->
<div class="card card-outline card-primary shadow-sm mb-4">
  <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
    <h3 class="card-title fw-bold mb-0">
      <i class="bi bi-tags-fill text-primary me-2"></i>Daftar Kategori Hewan
    </h3>
    <div class="card-tools d-flex flex-wrap align-items-center gap-2">
      <!-- Button Tambah Kategori -->
      <button
        type="button"
        class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm d-flex align-items-center gap-1"
        data-bs-toggle="modal"
        data-bs-target="#modalTambahKategori"
      >
        <i class="bi bi-plus-circle-fill"></i>
        <span>Tambah Kategori</span>
      </button>

      <!-- Search Form -->
      <form action="{{ route('admin.kategori') }}" method="GET" class="d-flex align-items-center gap-1">
        <div class="input-group input-group-sm">
          <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Cari kategori..."
            value="{{ $search ?? '' }}"
          />
          <button class="btn btn-outline-secondary" type="submit">
            <i class="bi bi-search"></i>
          </button>
          @if(!empty($search))
            <a href="{{ route('admin.kategori') }}" class="btn btn-outline-danger" title="Reset filter">
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
            <th>Nama Kategori</th>
            <th>Slug Identifier</th>
            <th>Deskripsi</th>
            <th class="text-center">Jml Penyakit</th>
            <th class="text-center">Jml Gejala</th>
            <th class="text-center">Riwayat</th>
            <th class="text-center" style="width: 170px">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($kategori as $index => $item)
            <tr>
              <td class="text-center text-muted fw-semibold">{{ $kategori->firstItem() + $index }}</td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="badge text-bg-primary-subtle text-primary border border-primary-subtle p-2 me-2 rounded-3">
                    @if(str_contains(strtolower($item->nama_kategori), 'kucing'))
                      <i class="bi bi-emoji-smile fs-5"></i>
                    @elseif(str_contains(strtolower($item->nama_kategori), 'anjing'))
                      <i class="bi bi-shield-heart fs-5"></i>
                    @elseif(str_contains(strtolower($item->nama_kategori), 'unggas') || str_contains(strtolower($item->nama_kategori), 'burung') || str_contains(strtolower($item->nama_kategori), 'ayam'))
                      <i class="bi bi-feather fs-5"></i>
                    @else
                      <i class="bi bi-tag-fill fs-5"></i>
                    @endif
                  </div>
                  <div>
                    <span class="fw-bold text-dark">{{ $item->nama_kategori }}</span>
                  </div>
                </div>
              </td>
              <td>
                <code>{{ $item->slug }}</code>
              </td>
              <td>
                <span class="text-secondary small">{{ Str::limit($item->deskripsi, 60, '...') }}</span>
              </td>
              <td class="text-center">
                <a href="{{ route('admin.penyakit', ['kategori_id' => $item->id]) }}" class="badge text-bg-success text-decoration-none">
                  {{ $item->penyakit_count }} Penyakit
                </a>
              </td>
              <td class="text-center">
                <a href="{{ route('admin.gejala', ['kategori_id' => $item->id]) }}" class="badge text-bg-warning text-dark text-decoration-none">
                  {{ $item->gejala_count }} Gejala
                </a>
              </td>
              <td class="text-center">
                <span class="badge text-bg-secondary">
                  {{ $item->riwayat_diagnosa_count }}
                </span>
              </td>
              <td class="text-center">
                <div class="btn-group btn-group-sm" role="group">
                  <!-- Detail Button -->
                  <button
                    type="button"
                    class="btn btn-outline-info rounded-start-pill"
                    data-bs-toggle="modal"
                    data-bs-target="#modalDetail{{ $item->id }}"
                    title="Lihat Detail"
                  >
                    <i class="bi bi-eye"></i>
                  </button>

                  <!-- Edit Button -->
                  <button
                    type="button"
                    class="btn btn-outline-warning"
                    data-bs-toggle="modal"
                    data-bs-target="#modalEdit{{ $item->id }}"
                    title="Edit Kategori"
                  >
                    <i class="bi bi-pencil-square"></i>
                  </button>

                  <!-- Delete Button -->
                  <button
                    type="button"
                    class="btn btn-outline-danger rounded-end-pill"
                    data-bs-toggle="modal"
                    data-bs-target="#modalHapus{{ $item->id }}"
                    title="Hapus Kategori"
                  >
                    <i class="bi bi-trash"></i>
                  </button>
                </div>
              </td>
            </tr>

            <!-- Modal Detail -->
            <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-labelledby="modalDetailLabel{{ $item->id }}" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalDetailLabel{{ $item->id }}">
                      <i class="bi bi-tag-fill text-primary me-2"></i>Detail Kategori: {{ $item->nama_kategori }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label class="fw-semibold text-secondary small">Nama Kategori</label>
                      <p class="fs-6 fw-bold mb-0">{{ $item->nama_kategori }}</p>
                    </div>
                    <div class="mb-3">
                      <label class="fw-semibold text-secondary small">Slug Identifier</label>
                      <p class="mb-0"><code>{{ $item->slug }}</code></p>
                    </div>
                    <div class="mb-3">
                      <label class="fw-semibold text-secondary small">Deskripsi</label>
                      <p class="text-secondary small mb-0">{{ $item->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                    </div>
                    <div class="row pt-2 border-top">
                      <div class="col-4 text-center">
                        <div class="fw-bold fs-5 text-primary">{{ $item->penyakit_count }}</div>
                        <small class="text-muted">Penyakit</small>
                      </div>
                      <div class="col-4 text-center">
                        <div class="fw-bold fs-5 text-warning">{{ $item->gejala_count }}</div>
                        <small class="text-muted">Gejala</small>
                      </div>
                      <div class="col-4 text-center">
                        <div class="fw-bold fs-5 text-success">{{ $item->riwayat_diagnosa_count }}</div>
                        <small class="text-muted">Riwayat</small>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <a href="{{ route('admin.penyakit', ['kategori_id' => $item->id]) }}" class="btn btn-sm btn-primary">
                      Lihat Penyakit <i class="bi bi-arrow-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal Edit -->
            <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $item->id }}" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <form action="{{ route('admin.kategori.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                      <h5 class="modal-title fw-bold" id="modalEditLabel{{ $item->id }}">
                        <i class="bi bi-pencil-square text-warning me-2"></i>Edit Kategori Hewan
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <div class="mb-3">
                        <label for="edit_nama_kategori_{{ $item->id }}" class="form-label small fw-semibold text-secondary">
                          Nama Kategori <span class="text-danger">*</span>
                        </label>
                        <input
                          type="text"
                          class="form-control"
                          id="edit_nama_kategori_{{ $item->id }}"
                          name="nama_kategori"
                          value="{{ old('nama_kategori', $item->nama_kategori) }}"
                          required
                          maxlength="50"
                        />
                      </div>
                      <div class="mb-3">
                        <label for="edit_deskripsi_{{ $item->id }}" class="form-label small fw-semibold text-secondary">
                          Deskripsi
                        </label>
                        <textarea
                          class="form-control"
                          id="edit_deskripsi_{{ $item->id }}"
                          name="deskripsi"
                          rows="3"
                          maxlength="255"
                        >{{ old('deskripsi', $item->deskripsi) }}</textarea>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-sm btn-warning">
                        <i class="bi bi-save me-1"></i>Simpan Perubahan
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Modal Hapus -->
            <div class="modal fade" id="modalHapus{{ $item->id }}" tabindex="-1" aria-labelledby="modalHapusLabel{{ $item->id }}" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                      <h5 class="modal-title fw-bold text-danger" id="modalHapusLabel{{ $item->id }}">
                        <i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>Hapus Kategori Hewan
                      </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p class="mb-2">Apakah Anda yakin ingin menghapus kategori <strong>"{{ $item->nama_kategori }}"</strong>?</p>
                      @if($item->penyakit_count > 0 || $item->gejala_count > 0)
                        <div class="alert alert-warning small mb-0 py-2">
                          <i class="bi bi-exclamation-circle me-1"></i>
                          Kategori ini memiliki <strong>{{ $item->penyakit_count }} penyakit</strong> dan <strong>{{ $item->gejala_count }} gejala</strong> terkait. Kategori tidak dapat dihapus sebelum relasi dipindahkan atau dihapus terlebih dahulu.
                        </div>
                      @endif
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-sm btn-danger" {{ ($item->penyakit_count > 0 || $item->gejala_count > 0) ? 'disabled' : '' }}>
                        <i class="bi bi-trash me-1"></i>Ya, Hapus
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          @empty
            <tr>
              <td colspan="8" class="text-center py-4 text-muted">
                <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                Tidak ada data kategori hewan yang ditemukan.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  <!-- /.card-body -->

  @if($kategori->hasPages())
    <div class="card-footer bg-body-tertiary clearfix">
      <div class="float-end">
        {{ $kategori->links('pagination::bootstrap-5') }}
      </div>
    </div>
  @endif
</div>
<!--end::Card Table-->

<!--begin::Modal Tambah Kategori-->
<div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow">
      <form action="{{ route('admin.kategori.store') }}" method="POST">
        @csrf
        <div class="modal-header bg-primary-subtle">
          <h5 class="modal-title fw-bold text-primary-emphasis" id="modalTambahKategoriLabel">
            <i class="bi bi-plus-circle-fill me-2"></i>Tambah Kategori Hewan Baru
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="nama_kategori" class="form-label small fw-semibold text-secondary">
              Nama Kategori Hewan <span class="text-danger">*</span>
            </label>
            <input
              type="text"
              class="form-control @error('nama_kategori') is-invalid @enderror"
              id="nama_kategori"
              name="nama_kategori"
              placeholder="Contoh: Unggas / Kuda / Reptil"
              value="{{ old('nama_kategori') }}"
              required
              maxlength="50"
              autofocus
            />
            @error('nama_kategori')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <div class="form-text small text-muted">Slug identifier URL akan dibuat otomatis dari nama kategori.</div>
          </div>

          <div class="mb-3">
            <label for="deskripsi" class="form-label small fw-semibold text-secondary">
              Deskripsi Singkat
            </label>
            <textarea
              class="form-control @error('deskripsi') is-invalid @enderror"
              id="deskripsi"
              name="deskripsi"
              rows="3"
              placeholder="Keterangan singkat tentang jenis hewan dalam kategori ini..."
              maxlength="255"
            >{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-sm btn-primary">
            <i class="bi bi-check-circle-fill me-1"></i>Simpan Kategori
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--end::Modal Tambah Kategori-->
@endsection

@extends('layouts.app')
 
@section('title', 'Daftar Buku')
 
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <i class="bi bi-book"></i>
        Daftar Buku
    </h1>
    <a href="{{ route('buku.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Buku
    </a>
</div>
 
{{-- Statistik Cards --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Buku</h6>
                        <h2 class="mb-0">{{ $totalBuku }}</h2>
                    </div>
                    <div class="text-primary">
                        <i class="bi bi-book-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Buku Tersedia</h6>
                        <h2 class="mb-0">{{ $bukuTersedia }}</h2>
                    </div>
                    <div class="text-success">
                        <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Buku Habis</h6>
                        <h2 class="mb-0">{{ $bukuHabis }}</h2>
                    </div>
                    <div class="text-danger">
                        <i class="bi bi-x-circle-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
{{-- Search & Filter --}}
<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('buku.search') }}" method="GET">
            <div class="row">
                {{-- Keyword --}}
                <div class="col-md-3 mb-3">
                    <label class="form-label">
                        Kata Kunci
                    </label>
                    <input type="text"
                           name="keyword"
                           class="form-control"
                           placeholder="Judul, pengarang..."
                           value="{{ request('keyword') }}">
                </div>

                {{-- Kategori --}}
                <div class="col-md-2 mb-3">
                    <label class="form-label">
                        Kategori
                    </label>
                    <select name="kategori" class="form-select">
                        <option value="">
                            Semua
                        </option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori }}"
                                {{ request('kategori') == $kategori ? 'selected' : '' }}>

                                {{ $kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tahun --}}
                <div class="col-md-2 mb-3">
                    <label class="form-label">
                        Tahun
                    </label>
                    <select name="tahun" class="form-select">
                        <option value="">
                            Semua
                        </option>
                        @foreach($tahuns as $tahun)
                            <option value="{{ $tahun }}"
                                {{ request('tahun') == $tahun ? 'selected' : '' }}>
                                {{ $tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Ketersediaan --}}
                <div class="col-md-2 mb-3">
                    <label class="form-label">
                        Status
                    </label>
                    <select name="ketersediaan" class="form-select">
                        <option value="">
                            Semua
                        </option>
                        <option value="tersedia"
                            {{ request('ketersediaan') == 'tersedia' ? 'selected' : '' }}>
                            Tersedia
                        </option>
                        <option value="habis"
                            {{ request('ketersediaan') == 'habis' ? 'selected' : '' }}>
                            Habis
                        </option>
                    </select>
                </div>

                {{-- Button --}}
                <div class="col-md-3 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="bi bi-search"></i>
                        Cari
                    </button>
                    <a href="{{ route('buku.index') }}"
                       class="btn btn-secondary">
                        Reset
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
 
{{-- Daftar Buku --}}
@if($bukus->count() > 0)
    <div class="row">
        @foreach($bukus as $buku)
            <div class="col-md-4 mb-4">
                <x-buku-card :buku="$buku" />
            </div>
        @endforeach
    </div>

@else
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i>
        Tidak ada data buku
        @isset($kategori)
            dengan kategori <strong>{{ $kategori }}</strong>
        @endisset
    </div>
@endif
 
@if ($bukus->count() > 0)
    <div class="text-center mt-4">
        <p class="text-muted">
            Menampilkan {{ $bukus->count() }} buku
            @isset($kategori)
                dari kategori <strong>{{ $kategori }}</strong>
            @endisset
        </p>
    </div>
@endif
@endsection
@push('scripts')
<script>
    // SweetAlert confirmation untuk delete
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function () {
            const form = this.closest('form');
            const judul = this.getAttribute('data-judul');

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: `Apakah Anda yakin ingin menghapus buku "${judul}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
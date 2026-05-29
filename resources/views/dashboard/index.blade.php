@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h1 class="mb-4">
    <i class="bi bi-speedometer2"></i>
    Dashboard Perpustakaan
</h1>

<div class="row">

    {{-- Total Buku --}}
    <div class="col-md-4 mb-4">
        <div class="card border-primary shadow-sm">
            <div class="card-body text-center">

                <h5>Total Buku</h5>

                <h2 class="text-primary">
                    {{ $totalBuku }}
                </h2>

            </div>
        </div>
    </div>

    {{-- Buku Tersedia --}}
    <div class="col-md-4 mb-4">
        <div class="card border-success shadow-sm">
            <div class="card-body text-center">

                <h5>Buku Tersedia</h5>

                <h2 class="text-success">
                    {{ $bukuTersedia }}
                </h2>

            </div>
        </div>
    </div>

    {{-- Buku Habis --}}
    <div class="col-md-4 mb-4">
        <div class="card border-danger shadow-sm">
            <div class="card-body text-center">

                <h5>Buku Habis</h5>

                <h2 class="text-danger">
                    {{ $bukuHabis }}
                </h2>

            </div>
        </div>
    </div>

</div>

<div class="row">

    {{-- Total Anggota --}}
    <div class="col-md-4 mb-4">
        <div class="card border-info shadow-sm">
            <div class="card-body text-center">

                <h5>Total Anggota</h5>

                <h2 class="text-info">
                    {{ $totalAnggota }}
                </h2>

            </div>
        </div>
    </div>

    {{-- Anggota Aktif --}}
    <div class="col-md-4 mb-4">
        <div class="card border-success shadow-sm">
            <div class="card-body text-center">

                <h5>Anggota Aktif</h5>

                <h2 class="text-success">
                    {{ $anggotaAktif }}
                </h2>

            </div>
        </div>
    </div>

    {{-- Anggota Nonaktif --}}
    <div class="col-md-4 mb-4">
        <div class="card border-secondary shadow-sm">
            <div class="card-body text-center">

                <h5>Anggota Nonaktif</h5>

                <h2 class="text-secondary">
                    {{ $anggotaNonaktif }}
                </h2>

            </div>
        </div>
    </div>

</div>

<div class="row">

    {{-- Buku Terbaru --}}
    <div class="col-md-6 mb-4">

        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white">
                5 Buku Terbaru
            </div>

            <div class="card-body">

                <ul class="list-group">

                    @foreach($bukuTerbaru as $buku)

                        <li class="list-group-item">
                            {{ $buku->judul }}
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>

    {{-- Anggota Terbaru --}}
    <div class="col-md-6 mb-4">

        <div class="card shadow-sm">

            <div class="card-header bg-success text-white">
                5 Anggota Terbaru
            </div>

            <div class="card-body">

                <ul class="list-group">

                    @foreach($anggotaTerbaru as $anggota)

                        <li class="list-group-item">
                            {{ $anggota->nama }}
                        </li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>

</div>

{{-- Quick Menu --}}
<div class="card shadow-sm">

    <div class="card-header bg-dark text-white">
        Menu Cepat
    </div>

    <div class="card-body">

        <a href="{{ route('buku.index') }}" class="btn btn-primary me-2">
            <i class="bi bi-book"></i>
            Kelola Buku
        </a>

        <a href="{{ route('anggota.index') }}" class="btn btn-success me-2">
            <i class="bi bi-people"></i>
            Kelola Anggota
        </a>

        <a href="{{ route('home') }}" class="btn btn-secondary">
            <i class="bi bi-house"></i>
            Home
        </a>

    </div>

</div>

@endsection
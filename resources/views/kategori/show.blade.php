@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb">

    <ol class="breadcrumb">

        <li class="breadcrumb-item">
            <a href="{{ route('kategori.index') }}">
                Kategori
            </a>
        </li>

        <li class="breadcrumb-item active">
            {{ $kategori['nama'] }}
        </li>

    </ol>

</nav>

<div class="card shadow mb-4">

    <div class="card-body">

        <h2>{{ $kategori['nama'] }}</h2>

        <p>{{ $kategori['deskripsi'] }}</p>

        <span class="badge bg-primary">
            {{ $kategori['jumlah_buku'] }} Buku
        </span>

    </div>

</div>

<h3>Daftar Buku</h3>

<table class="table table-bordered">

    <thead class="table-dark">

        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Tahun</th>
        </tr>

    </thead>

    <tbody>

        @foreach($buku_list as $index => $buku)

        <tr>

            <td>{{ $index + 1 }}</td>
            <td>{{ $buku['judul'] }}</td>
            <td>{{ $buku['pengarang'] }}</td>
            <td>{{ $buku['tahun'] }}</td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection
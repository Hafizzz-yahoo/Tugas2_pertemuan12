@extends('layouts.app')

@section('title', 'Pencarian Kategori')

@section('content')

<h1 class="mb-4">
    Hasil Pencarian:
    <span class="text-danger">
        "{{ $keyword }}"
    </span>
</h1>

@if(count($hasil) > 0)

<div class="row">

    @foreach($hasil as $kategori)

    <div class="col-md-4 mb-4">

        <div class="card shadow-sm">

            <div class="card-body">

                <h4>
                    {!! str_ireplace(
                        $keyword,
                        '<mark>'.$keyword.'</mark>',
                        $kategori['nama']
                    ) !!}
                </h4>

                <p>
                    {{ $kategori['deskripsi'] }}
                </p>

                <span class="badge bg-success">
                    {{ $kategori['jumlah_buku'] }} Buku
                </span>

            </div>

        </div>

    </div>

    @endforeach

</div>

@else

<div class="alert alert-danger">

    Kategori tidak ditemukan.

</div>

@endif

@endsection
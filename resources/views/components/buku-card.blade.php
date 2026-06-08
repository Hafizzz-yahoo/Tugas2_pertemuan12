<div class="card h-100 shadow-sm border-0">

    {{-- Header --}}
    <div class="card-header bg-primary text-white text-center">

        <i class="bi bi-book-fill display-4"></i>

    </div>

    {{-- Body --}}
    <div class="card-body">

        {{-- Judul --}}
        <h5 class="card-title">
            {{ $buku->judul }}
        </h5>

        {{-- Pengarang --}}
        <p class="text-muted mb-2">
            <i class="bi bi-person"></i>
            {{ $buku->pengarang }}
        </p>

        {{-- Kategori --}}
        <span class="badge bg-info mb-2">
            {{ $buku->kategori }}
        </span>

        {{-- Harga --}}
        <p class="mb-1">
            <strong>Harga:</strong>
            {{ $buku->harga_format }}
        </p>

        {{-- Stok --}}
        <p class="mb-1">
            <strong>Stok:</strong>
            {{ $buku->stok }}
        </p>

        {{-- Status --}}
        <p>
            <strong>Status:</strong>
            {!! $buku->status_stok_badge !!}
        </p>

    </div>

    {{-- Footer --}}
    @if($showActions)
        <div class="card-footer bg-white border-0">

            <div class="d-flex gap-2">

                <a href="{{ route('buku.show', $buku->id) }}"
                class="btn btn-info btn-sm flex-fill text-white">
                    <i class="bi bi-eye"></i>
                    Detail
                </a>

                <a href="{{ route('buku.edit', $buku->id) }}"
                class="btn btn-warning btn-sm flex-fill">
                    <i class="bi bi-pencil"></i>
                    Edit
                </a>

                <form action="{{ route('buku.destroy', $buku->id) }}" 
                      method="POST" 
                      class="d-inline delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger w-100 btn-delete" 
                            data-judul="{{ $buku->judul }}">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    @endif

</div>
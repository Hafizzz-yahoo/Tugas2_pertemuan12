<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
 
class Buku extends Model
{
    use HasFactory;
 
    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'buku';
 
    /**
     * Kolom yang dapat diisi secara mass assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_buku',
        'judul',
        'kategori',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'isbn',
        'harga',
        'stok',
        'deskripsi',
        'bahasa',
    ];
 
    /**
     * Tipe casting untuk atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tahun_terbit' => 'integer',
        'harga' => 'decimal:2',
        'stok' => 'integer',
    ];
 
    /**
     * Accessor untuk format harga.
     */
    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
 
    /**
     * Accessor untuk status ketersediaan.
     */
    public function getTersediaAttribute(): bool
    {
        return $this->stok > 0;
    }

    /**
     * Accessor status stok badge.
     */
    public function getStatusStokBadgeAttribute()
    {
        if ($this->stok > 0) {
            return '<span class="badge bg-success">Tersedia</span>';
        }
    return '<span class="badge bg-danger">Habis</span>';
    }

    /**
     * Accessor tahun label.
     */
    public function getTahunLabelAttribute(): string
    {
        return $this->tahun_terbit >= 2024
            ? 'Buku Baru'
            : 'Buku Lama';
    }
 
    /**
     * Scope untuk filter buku tersedia.
     */
    public function scopeTersedia(Builder $query)
    {
        return $query->where('stok', '>', 0);
    }
 
    /**
     * Scope untuk filter berdasarkan kategori.
     */
    public function scopeKategori(Builder $query, string $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Scope stok menipis.
     */
    public function scopeStokMenipis(Builder $query)
    {
    return $query->where('stok', '<', 5);
    }

    /**
     * Scope harga range.
     */
    public function scopeHargaRange(Builder $query, int $min, int $max)
    {
        return $query->whereBetween('harga', [$min, $max]);
    }

    /**
     * Scope buku terbaru.
     */
    public function scopeTerbaru(Builder $query)
    {
        return $query->where('tahun_terbit', '>=', 2024);
    }
}
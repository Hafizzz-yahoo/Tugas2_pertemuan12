<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;
 
class Anggota extends Model
{
    use HasFactory;
 
    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'anggota';
 
    /**
     * Kolom yang dapat diisi secara mass assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_anggota',
        'nama',
        'email',
        'telepon',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'tanggal_daftar',
        'status',
    ];
 
    /**
     * Tipe casting untuk atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_daftar' => 'date',
    ];
 
    /**
     * Accessor untuk menghitung umur.
     */
    public function getUmurAttribute(): int
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }
 
    /**
     * Accessor untuk lama menjadi anggota (dalam hari).
     */
    public function getLamaAnggotaAttribute(): int
    {
        return (int) Carbon::parse($this->tanggal_daftar)
            ->diffInDays(now());
    }

    /**
     * Accessor status badge.
     */
    public function getStatusBadgeAttribute(): string
    {
        return $this->status == 'Aktif'
            ? '<span class="badge bg-success">Aktif</span>'
            : '<span class="badge bg-secondary">Nonaktif</span>';
    }

    /**
     * Accessor kategori usia.
     */
    public function getKategoriUsiaAttribute(): string
    {
        if ($this->umur < 20) {
            return 'Remaja';
        } elseif ($this->umur >= 20 && $this->umur <= 50) {
            return 'Dewasa';
        } else {
            return 'Senior';
        }
    }
 
    /**
     * Scope untuk filter anggota aktif.
     */
    public function scopeAktif(Builder $query)
    {
        return $query->where('status', 'Aktif');
    }
 
    /**
     * Scope untuk filter berdasarkan jenis kelamin.
     */
    public function scopeJenisKelamin(
        Builder $query,
        string $jenisKelamin
    )
    {
        return $query->where('jenis_kelamin', $jenisKelamin);
    }

    /**
     * Scope anggota terdaftar bulan ini.
     */
    public function scopeTerdaftarBulanIni(Builder $query)
    {
        return $query->whereMonth(
                'tanggal_daftar',
                Carbon::now()->month
            )
            ->whereYear(
                'tanggal_daftar',
                Carbon::now()->year
            );
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'nama_kategori' => 'Pemrograman',
            'deskripsi' => 'Kategori buku pemrograman',
            'icon' => 'code-slash',
            'warna' => 'primary',
        ]);

        Kategori::create([
            'nama_kategori' => 'Basis Data',
            'deskripsi' => 'Kategori buku basis data',
            'icon' => 'database',
            'warna' => 'success',
        ]);

        Kategori::create([
            'nama_kategori' => 'Desain Web',
            'deskripsi' => 'Kategori buku desain web',
            'icon' => 'palette',
            'warna' => 'info',
        ]);

        Kategori::create([
            'nama_kategori' => 'Jaringan',
            'deskripsi' => 'Kategori buku jaringan komputer',
            'icon' => 'wifi',
            'warna' => 'warning',
        ]);

        Kategori::create([
            'nama_kategori' => 'Ilmu Data',
            'deskripsi' => 'Kategori buku data science',
            'icon' => 'graph-up',
            'warna' => 'danger',
        ]);
    }
}
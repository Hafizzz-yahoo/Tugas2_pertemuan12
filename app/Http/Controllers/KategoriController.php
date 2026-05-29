<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    // Data kategori
    private $kategori_list = [
        [
            'id' => 1,
            'nama' => 'Programming',
            'deskripsi' => 'Buku pemrograman dan coding',
            'jumlah_buku' => 25
        ],
        [
            'id' => 2,
            'nama' => 'Database',
            'deskripsi' => 'Buku database dan SQL',
            'jumlah_buku' => 18
        ],
        [
            'id' => 3,
            'nama' => 'Web Design',
            'deskripsi' => 'Buku desain website modern',
            'jumlah_buku' => 15
        ],
        [
            'id' => 4,
            'nama' => 'Networking',
            'deskripsi' => 'Buku jaringan komputer',
            'jumlah_buku' => 12
        ],
        [
            'id' => 5,
            'nama' => 'Artificial Intelligence',
            'deskripsi' => 'Buku AI dan machine learning',
            'jumlah_buku' => 10
        ]
    ];

    // INDEX
    public function index()
    {
        $kategori_list = $this->kategori_list;

        return view('kategori.index', compact('kategori_list'));
    }

    // SHOW
    public function show($id)
    {
        $kategori = collect($this->kategori_list)->firstWhere('id', $id);

        if (!$kategori) {
            abort(404);
        }

        // Data buku
        $buku_list = [
            [
                'judul' => 'Laravel 12',
                'pengarang' => 'Budi Raharjo',
                'tahun' => 2025
            ],
            [
                'judul' => 'PHP Modern',
                'pengarang' => 'Andi Nugroho',
                'tahun' => 2024
            ],
            [
                'judul' => 'Mastering Coding',
                'pengarang' => 'Rina Wijaya',
                'tahun' => 2023
            ]
        ];

        return view('kategori.show', compact('kategori', 'buku_list'));
    }

    // SEARCH
    public function search($keyword)
    {
        $hasil = collect($this->kategori_list)->filter(function ($item) use ($keyword) {

            return str_contains(
                strtolower($item['nama']),
                strtolower($keyword)
            );

        });

        return view('kategori.search', [
            'hasil' => $hasil,
            'keyword' => $keyword
        ]);
    }
}
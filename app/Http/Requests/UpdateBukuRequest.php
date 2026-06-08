<?php
 
namespace App\Http\Requests;
 
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\KodeBukuFormat;
 
class UpdateBukuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get buku ID from route parameter
        $bukuId = $this->route('buku');
        
        return [
            'kode_buku' => ['required', 'string', 'max:20', new KodeBukuFormat, Rule::unique('buku', 'kode_buku')->ignore($bukuId)],
            'judul' => 'required|string|max:200',
            'kategori' => 'required|in:Pemrograman,Database,Web Design,Networking,Data Science',
            'pengarang' => 'required|string|max:100',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'isbn' => 'nullable|string|max:20',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'bahasa' => 'required|string|max:20',
        ];
    }

        /**
     * Validasi bersyarat
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Jika kategori Pemrograman harus Bahasa Inggris
            if (
                $this->kategori == 'Pemrograman' &&
                $this->bahasa != 'Bahasa Inggris'
            ) {
                $validator->errors()->add(
                    'bahasa',
                    'Buku kategori Pemrograman harus menggunakan Bahasa Inggris.'
                );
            }
            // Jika tahun < 2000 stok maksimal 5
            if (
                $this->tahun_terbit < 2000 &&
                $this->stok > 5
            ) {
                $validator->errors()->add(
                    'stok',
                    'Untuk buku terbit sebelum tahun 2000, stok maksimal adalah 5.'
                );
            }
        });
    }
 
    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'kode_buku.required' => 'Kode buku wajib diisi.',
            'kode_buku.unique' => 'Kode buku sudah digunakan.',
            'judul.required' => 'Judul buku wajib diisi.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'harga.required' => 'Harga buku wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'stok.integer' => 'Stok harus berupa angka bulat.',
        ];
    }
}
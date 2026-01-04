<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCalonSiswaRequest extends FormRequest
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
        return [
            'nik' => 'required|string|size:16|unique:calon_siswa,nik',
            'nisn' => 'required|string|size:10|unique:calon_siswa,nisn',

            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'required|string|max:50',

            'asal_sekolah' => 'required|string|max:255',
            'riwayat_hafalan' => 'nullable|string|max:255',

            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'umur' => 'required|integer|min:1',

            'id_agama' => 'required|exists:agama,id',
            'jenis_kelamin' => 'required|in:L,P',

            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'email' => 'required|email|max:255',

            'tinggi_badan' => 'required|numeric|min:1',
            'berat_badan' => 'required|numeric|min:1',

            'anak_ke' => 'required|integer|min:1',
            'status_dalam_keluarga' => 'required|string|max:50',

            'nama_ayah' => 'required|string|max:255',
            'tahun_lahir_ayah' => 'required|digits:4',
            'pekerjaan_ayah_id' => 'required|exists:pekerjaan,id',
            'pendidikan_ayah_id' => 'required|exists:pendidikan,id',

            'nama_ibu' => 'required|string|max:255',
            'tahun_lahir_ibu' => 'required|digits:4',
            'pekerjaan_ibu_id' => 'required|exists:pekerjaan,id',
            'pendidikan_ibu_id' => 'required|exists:pendidikan,id',

            'penghasilan_orang_tua_id' => 'required|exists:penghasilan,id',

            'nama_wali' => 'nullable|string|max:255',
            'nomor_wali' => 'nullable|string|max:15',
            'pekerjaan_wali_id' => 'nullable|exists:pekerjaan,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nik.unique' => 'NIK sudah terdaftar.',
            'nisn.unique' => 'NISN sudah terdaftar.',
            'id_agama.exists' => 'Agama tidak valid.',
            'jenis_kelamin.in' => 'Jenis kelamin harus L atau P.',
        ];
    }
}
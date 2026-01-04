<?php

namespace App\Http\Requests;

use App\Models\Gelombang;
use Illuminate\Foundation\Http\FormRequest;

class StoreGelombangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // nanti bisa dibatasi admin
    }

    public function rules(): array
    {
        return [
            'tahun_ajaran_id' => 'required|uuid|exists:tahun_ajaran,id',

            'name' => 'required|string|max:100',

            'start_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    $exists = Gelombang::where('tahun_ajaran_id', $this->tahun_ajaran_id)
                        ->where(function ($query) {
                            // overlap FULL RANGE
                            $query->whereBetween('start_date', [$this->start_date, $this->end_date])
                                  ->orWhereBetween('end_date', [$this->start_date, $this->end_date])
                                  ->orWhere(function ($q) {
                                      $q->where('start_date', '<=', $this->start_date)
                                        ->where('end_date', '>=', $this->end_date);
                                  });
                        })
                        ->exists();

                    if ($exists) {
                        $fail('Periode gelombang tidak boleh bertabrakan dengan gelombang lain dalam tahun ajaran yang sama.');
                    }
                },
            ],

            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],

            'quota' => 'required|integer|min:1',

            'registration_fee' => 'required|numeric|min:0',

            'status' => 'required|in:open,closed,full',
        ];
    }

    public function messages(): array
    {
        return [
            'tahun_ajaran_id.required' => 'Tahun ajaran wajib dipilih.',
            'tahun_ajaran_id.exists' => 'Tahun ajaran tidak valid.',

            'name.required' => 'Nama gelombang wajib diisi.',

            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'end_date.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',

            'quota.required' => 'Kuota wajib diisi.',
            'quota.min' => 'Kuota minimal 1 siswa.',

            'registration_fee.required' => 'Biaya pendaftaran wajib diisi.',

            'status.in' => 'Status gelombang tidak valid.',
        ];
    }
}
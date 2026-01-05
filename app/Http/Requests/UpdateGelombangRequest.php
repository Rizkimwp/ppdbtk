<?php

namespace App\Http\Requests;

use App\Models\Gelombang;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGelombangRequest extends FormRequest
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
        $gelombangId = $this->route('id'); // ambil ID dari route

        return [
            'tahun_ajaran_id' => 'required|uuid|exists:tahun_ajaran,id',
            'name' => 'required|string|max:100',
            'start_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($gelombangId) {
                    $exists = Gelombang::where('tahun_ajaran_id', $this->tahun_ajaran_id)
                        ->where('id', '!=', $gelombangId) // jangan cek sendiri
                        ->where(function ($query) {
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
}
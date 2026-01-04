<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateUploadBukti extends FormRequest
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
            'file_path' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'amount' => 'required|numeric|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'file_path.required' => 'Bukti pembayaran wajib diupload.',
            'file_path.mimes' => 'Format file harus  JPG, atau PNG.',
            'file_path.max' => 'Ukuran file maksimal 2MB.',
            'amount.required' => 'Jumlah pembayaran wajib diisi.',
            'amount.numeric' => 'Jumlah pembayaran harus berupa angka.',
            'amount.min' => 'Jumlah pembayaran tidak valid.',
            'amount.in' => 'Nominal pembayaran tidak sesuai.',
        ];
    }

}
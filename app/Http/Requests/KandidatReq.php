<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KandidatReq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'no_urut'=>'required|numeric',
            'nama_ketua'=>'required|alpha',
            'path_foto_ketua'=>'required',
            'npm_ketua'=>'required|numeric|digits:10',
            'nama_wakil'=>'nullable|alpha',
            'path_foto_wakil'=>'nullable',
            'npm_wakil'=> 'nullable|numeric|digits:10'
        ];
    }
}

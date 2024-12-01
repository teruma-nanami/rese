<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class CsvImportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'csv_file' => 'required|mimes:csv,txt|max:2048', // 必須で、CSVまたはTXTファイル、最大サイズ2MB
        ];
    }

    public function messages()
    {
        return [
            'csv_file.required' => 'CSVファイルを選択してください。',
            'csv_file.mimes' => 'CSVファイルの形式が正しくありません。csvまたはtxtファイルを選択してください。',
            'csv_file.max' => 'CSVファイルのサイズが大きすぎます。2MB以内にしてください。',
        ];
    }

    public function validateEachRow($rows, $header)
    {
        $errors = [];
        foreach ($rows as $key => $row) {
            $row = array_combine($header, $row);
            $validator = Validator::make($row, [
                'name' => 'required|string|max:50',
                'post_code' => 'required|string|max:10',
                'address' => 'required|string|max:255',
                'phone_number' => 'required|string|max:15',
                'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,', 'max:2048'],
                'email' => 'nullable|email|max:255',
                'area_id' => 'required|integer|exists:areas,id',
                'cuisine_type_id' => 'required|integer|exists:cuisine_types,id',
                'detail' => 'nullable|string|max:400',
                'owner_id' => 'required|integer|exists:users,id',
            ]);
            if ($validator->fails()) {
                $errors[$key + 1] = $validator->errors()->all();
            }
        }
        return $errors;
    }
}

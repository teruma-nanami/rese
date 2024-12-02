<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Http\Requests\CsvImportRequest;

class CsvImportController extends Controller
{
    public function showImportForm()
    {
        return view('admin.csv_import');
    }

    public function import(CsvImportRequest $request)
    {
        // CSVファイルの取得
        $file = $request->file('csv_file');
        $path = $file->getRealPath();

        // CSVファイルの読み込み
        $csvData = array_map('str_getcsv', file($path));
        $header = array_shift($csvData); // ヘッダー行を取得

        // 各行のバリデーションを実行
        $error = $request->validateEachRow($csvData, $header);

        // バリデーションエラーが存在する場合はビューにエラーを渡す
        if ($error) {
            return redirect()->route('import.csv')->withErrors(['csv_error' => $error])->withInput();
        }

        // データベースに保存
        foreach ($csvData as $row) {
            $row = array_combine($header, $row);
            Restaurant::create($row);
        }


        return redirect()->route('import.csv')->with('success', 'CSVファイルをインポートしました。');
    }
}

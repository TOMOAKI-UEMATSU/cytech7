<?php

return [
    'required' => ':attribute は必須項目です。',
    'integer' => ':attribute には整数を入力してください。',
    'string' => ':attribute は文字列で入力してください。',
    'image' => ':attribute は画像ファイルである必要があります。',
    'max' => [
        'file' => ':attribute は :max KB 以下でなければなりません。',
    ],
    'mimes' => ':attribute は :values タイプのファイルでなければなりません。',
    'exists' => '選択された :attribute は存在しません。',
    'attributes' => [
        'name' => '商品名',
        'company_id' => 'メーカー',
        'price' => '価格',
        'stock' => '在庫数',
        'description' => '商品説明',
        'image' => '商品画像',
    ],
];
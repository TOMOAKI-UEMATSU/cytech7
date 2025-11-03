@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品情報詳細</h1>
    <div class="d-flex justify-content-end gap-2 mt-4">
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">
            編集する
        </a>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">
            商品一覧に戻る
        </a>
    </div>


    <dl class="row mt-3">
        <dt class="col-sm-3">商品情報ID</dt>
        <dd class="col-sm-9">{{ $product->id }}</dd>

        <dt class="col-sm-3">商品名</dt>
        <dd class="col-sm-9">{{ $product->product_name }}</dd>

        <dt class="col-sm-3">メーカー</dt>
        <dd class="col-sm-9">{{optional($product->company)->company_name }}</dd>

        <dt class="col-sm-3">価格</dt>
        <dd class="col-sm-9">￥{{ $product->price }}</dd>

        <dt class="col-sm-3">在庫数</dt>
        <dd class="col-sm-9">{{ $product->stock }}本</dd>

        <dt class="col-sm-3">コメント</dt>
        <dd class="col-sm-9">{{ $product->comment }}</dd>

        <dt class="col-sm-3">商品画像</dt>
        <dd class="col-sm-9"><img src="{{ asset($product->img_path) }}" width="300"></dd>
    </dl>

</div>
@endsection
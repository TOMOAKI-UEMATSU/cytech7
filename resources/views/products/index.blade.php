@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品情報一覧</h1>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">商品新規登録</a>

    <div class="products mt-5">


        <h2>商品情報</h2>
        <form method="GET" action="{{ route('products.index') }}" class="mb-4">
            <div class="row g-2">
                <div class="col-md-4">
                    <input type="text" name="keyword" class="form-control" placeholder="商品名で検索" value="{{ request('keyword') }}">
                </div>
                <div class="col-md-4">
                    <select name="company_id" class="form-select">
                        <option value="">メーカーを選択</option>
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">検索</button>
                </div>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>商品名</th>
                    <th>メーカー</th>
                    <th>価格</th>
                    <th style="white-space: nowrap;">在庫数</th>
                    <th>コメント</th>
                    <th>商品画像</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id}}.</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ optional($product->company)->company_name }}</td>
                    <td>￥{{ $product->price }}</td>
                    <td>{{ $product->stock }}本</td>
                    <td>{{ $product->comment }}</td>
                    <td><img src="{{ asset($product->img_path) }}" alt="商品画像" width="100"></td>
                    <td>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm mx-1">詳細表示</a>
                        {{-- <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm mx-1">編集</a>--}}
                        <form method="POST" action="{{ route('products.destroy', $product) }}" class="d-inline" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm mx-1">削除</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $products->appends([
    'keyword' => request('keyword'),
    'company_id' => request('company_id')
])->links() }}
</div>

@endsection
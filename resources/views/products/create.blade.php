@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">商品新規登録</h1>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" novalidate>
        @csrf

        {{-- 商品名 --}}
        <div class="mb-3">
            <label for="name" class="form-label">商品名:</label>
            <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- メーカー --}}
        <div class="mb-3">
            <label for="company_id" class="form-label">メーカー</label>
            <select class="form-select" id="company_id" name="company_id">
                @foreach($companies as $company)
                <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                    {{ $company->company_name }}
                </option>
                @endforeach
            </select>
            @error('company_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- 価格 --}}
        <div class="mb-3">
            <label for="price" class="form-label">価格:</label>
            <input id="price" type="text" name="price" class="form-control" value="{{ old('price') }}">
            @error('price')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- 在庫数 --}}
        <div class="mb-3">
            <label for="stock" class="form-label">在庫数:</label>
            <input id="stock" type="text" name="stock" class="form-control" value="{{ old('stock') }}">
            @error('stock')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- コメント --}}
        <div class="mb-3">
            <label for="description" class="form-label">コメント:</label>
            <textarea id="description" name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- 商品画像 --}}
        <div class="mb-3">
            <label for="image" class="form-label">商品画像:</label>
            <input id="image" type="file" name="image" class="form-control">
            @error('image')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-secondary">
                商品一覧に戻る
            </a>
            <button type="submit" class="btn btn-primary">
                登録
            </button>
        </div>
    </form>
</div>
@endsection
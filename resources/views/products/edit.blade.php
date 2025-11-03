@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header">商品情報を変更する</div>
                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif


                    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- 商品名 --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">商品名＊</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- メーカー名 --}}
                        <div class="mb-3">
                            <label for="company_id" class="form-label">メーカー名＊</label>
                            <select class="form-select" id="company_id" name="company_id">
                                @foreach($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id', $product->company_id) == $company->id ? 'selected' : '' }}>
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
                            <label for="price" class="form-label">価格＊</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}">
                            @error('price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 在庫数 --}}
                        <div class="mb-3">
                            <label for="stock" class="form-label">在庫数＊</label>
                            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}">
                            @error('stock')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- コメント --}}
                        <div class="mb-3">
                            <label for="description" class="form-label">コメント</label>
                            <textarea id="description" name="description" class="form-control" rows="3">{{ old('description', $product->comment) }}</textarea>
                            @error('description')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 商品画像 --}}
                        <div class="mb-3">
                            <label for="image" class="form-label">商品画像:</label>
                            <input id="image" type="file" name="image" class="form-control" onchange="previewImage(event)">
                            @error('image')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <img id="preview" src="{{ asset($product->img_path) }}" alt="商品画像" class="product-image" style="max-width:200px; margin-top:10px;">
                        </div>

                        <script>
                            function previewImage(event) {
                                const reader = new FileReader();
                                reader.onload = function() {
                                    const output = document.getElementById('preview');
                                    output.src = reader.result;
                                };
                                reader.readAsDataURL(event.target.files[0]);
                            }
                        </script>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary">
                                詳細画面に戻る
                            </a>
                            <button type="submit" class="btn btn-primary">
                                変更内容で保存する
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
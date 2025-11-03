<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('keyword')) {
            $query->where('product_name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        $products = $query->paginate(10)->appends($request->query());
        $companies = Company::all();

        return view('products.index', compact('products', 'companies'));
    }


    public function create()
    {
        $companies = Company::all();
        return view('products.create', compact('companies'));
    }


    public function store(Request $request)
    {
        // 🔒 バリデーション（例外外で実行）
        $request->validate([
            'name'        => 'required|string|max:255',
            'company_id'  => 'required|integer|exists:companies,id',
            'price'       => 'required|integer',
            'stock'       => 'required|integer',
            'description' => 'required|string|max:1000',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // 🆕 新規商品作成
            $product = new Product([
                'product_name' => $request->name,
                'company_id'   => $request->company_id,
                'price'        => $request->price,
                'stock'        => $request->stock,
                'comment'      => $request->description,
            ]);

            // 🖼 画像アップロードがある場合のみ保存
            if ($request->hasFile('image')) {
                $filename = time() . '_' . $request->image->getClientOriginalName();
                $filePath = $request->image->storeAs('products', $filename, 'public');
                $product->img_path = '/storage/' . $filePath;
            }

            $product->save();

            return redirect()->route('products.index')
                ->with('success', '商品を登録しました');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', '登録中にエラーが発生しました')->withInput();
        }
    }


    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }


    public function edit(Product $product)
    {
        $companies = Company::all();
        return view('products.edit', compact('product', 'companies'));
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'company_id'  => 'required|integer|exists:companies,id',
            'price'       => 'required|integer',
            'stock'       => 'required|integer',
            'description' => 'required|string|max:1000',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $product->product_name = $request->name;
            $product->company_id   = $request->company_id;
            $product->price        = $request->price;
            $product->stock        = $request->stock;
            $product->comment      = $request->description;

            if ($request->hasFile('image')) {
                $filename = time() . '_' . $request->image->getClientOriginalName();
                $filePath = $request->image->storeAs('products', $filename, 'public');
                $product->img_path = '/storage/' . $filePath;
            }

            $product->save();

            return redirect()->route('products.index')
                ->with('success', '商品を更新しました');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', '更新中にエラーが発生しました')->withInput();
        }
    }


    public function destroy(Product $product)
    {
        try {
            // 画像が存在すれば削除（任意）
            if ($product->img_path && Storage::disk('public')->exists(str_replace('/storage/', '', $product->img_path))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $product->img_path));
            }

            $product->delete();

            return redirect()->route('products.index')
                ->with('success', '商品を削除しました');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', '削除中にエラーが発生しました');
        }
    }
}

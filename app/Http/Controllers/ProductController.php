<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use App\Models\Sale;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
{
    try {
        $query = Product::query();

        
        if ($request->filled('product_name')) {
            $query->where('product_name', 'like', '%' . $request->input('product_name') . '%');
        }

        
        if ($request->filled('company_id')) {
            $query->where('company_id', $request->input('company_id'));
        }

       
        $query->orderBy('id');

        $products = $query->paginate(5);

     
        $companies = Company::all();

        return view('index', compact('products', 'companies'))
            ->with('page_id', request()->page)
            ->with('i', (request()->input('page', 1) - 1) * 5);
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'データの取得に失敗しました。');
    }
}
    public function create()
    {
        try {
            $companies = Company::all();
            return view('create', compact('companies'));
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'データの取得に失敗しました。');
        }
    }

    public function store(ArticleRequest $request)
    {
        try {
            $validatedData = $request->validated();
    
            
            $imgPath = null;
    
            if ($request->hasFile('img_path')) {
               
                $imgPath = $request->file('img_path')->store('products_images', 'public');
                
                
                $request->merge(['img_path' => $imgPath]);
            }
    
            $product = new Product([
                'company_id' => $validatedData['company_id'],
                'product_name' => $validatedData['product_name'],
                'price' => $validatedData['price'],
                'stock' => $validatedData['stock'],
                'comment' => $validatedData['comment'],
                'img_path' => $imgPath,
            ]);
    
            $product->save();
    
            $sale = new Sale([
                'product_id' => $product->id,
            ]);
    
            $sale->save();
    
            return redirect()->route('products.create', $product->id)->with('success', '商品が正常に新規登録されました');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'データの登録に失敗しました。');
        }
    }

    public function show(Product $product)
    {
        try {
            $companies = Company::all();
            return view('show', compact('product', 'companies'))->with('page_id',request()->page_id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'データの取得に失敗しました。');
        }
    }

    public function edit(Product $product)
    {
        try {
            $companies = Company::all();
            return view('edit', compact('product', 'companies'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'データの取得に失敗しました。');
        }
    }

    public function update(ArticleRequest $request, Product $product)
{
    try {
        $validatedData = $request->validated();

        $imgPath = $product->img_path; 

        if ($request->hasFile('img_path')) {
            
            $imgPath = $request->file('img_path')->store('products_images', 'public');
        }

        
        $product->update(array_merge($validatedData, ['img_path' => $imgPath]));

        $sale = Sale::where('product_id', $product->id)->first();

        if (!$sale) {
            $sale = new Sale();
            $sale->product_id = $product->id;
        }

        $sale->save();

        
        return redirect()->route('products.edit', $product->id)->with('success', '商品が正常に更新されました');
    } catch (\Exception $e) {
        \Log::error($e->getMessage());
        return redirect()->back()->with('error', 'データの更新に失敗しました。');
    }
}

    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return redirect()->route('products.index')
                ->with('success', '商品名：' . $product->product_name . 'を削除しました');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'データの削除に失敗しました。');
        }
    }
}

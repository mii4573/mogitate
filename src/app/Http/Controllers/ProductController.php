<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Season;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('name', 'LIKE', "%{$keyword}%");
        }
        
       $sort = $request->input('sort');
       if ($sort === 'asc') {
           $query->orderBy('price', 'asc');
       }
       elseif ($sort === 'desc') {
           $query->orderBy('price', 'desc');
        }
        else {
            $query->orderBy('id', 'asc');
        }

       $products = $query->paginate(6);
       $products->appends($request->all());
        
        return view('index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('show', compact('product'));
    }

    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;

        $product->seasons()->sync($request->seasons);
        
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', '商品を更新しました');
    }  

    public function register()
    {
        $seasons = Season::all();
        return view('register', compact('seasons'));
    }
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $filename = $request->file('image')->store('products', 'public');
            $data['image'] = $filename;
        }

        $product = Product::create($data);
        $product->seasons()->attach($request->seasons);

        return redirect()->route('products.index')->with('success', '商品を登録しました');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->seasons()->detach();
        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました');
    }



}
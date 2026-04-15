@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="products">
    <aside class="sidebar">
        <form action="{{ route('products.index') }}" method="GET">
            <div class="search-group">
                <label for="keyword">商品名で検索</label>
                <input type="text" name="keyword" id="keyword" placeholder="商品名を入力..." value="{{ request('keyword') }}">
            </div>

            <button type="submit" class="search-btn">検索</button>

            <div class="filter-group">
                <label for="sort">価格順で表示</label>
                <select name="sort" id="sort">
                    <option value="" {{ request('sort') == '' ? 'selected' : '' }}>価格で並び替え</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>低い順に表示</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順に表示</option>
                </select>
            </div>
        </form>
    </aside>

    <main class="product-main">
        <div class="product-header">
            <h1 class="page-title">商品一覧</h1>
            <a href="{{ route('products.register') }}" class="add-btn">+ 商品を追加</a>
        </div>
        <div class="product-grid">
            @foreach($products as $product)
              <a href="{{ route('products.show', $product->id) }}" class="product-card">
               <div class="product-image">
                  <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                </div>
                <div class="product-info">
                   <h3 class="product-name">{{ $product->name }}</h3>
                   <p class="product-price">¥{{ number_format($product->price) }}</p>
                </div>
              </a>
            @endforeach
        </div>
        <div class="pagination-wrapper">
            {{ $products->links() }}
        </div>
    </main>
</div>
@endsection

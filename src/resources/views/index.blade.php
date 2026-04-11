@extends('layouts.app')

@section('content')
<div class="products">
    <aside class="sidebar">
        <form action="/products/search" method="GET">
            <div class="search-group">
                <label for="keyword">商品検索</label>
                <input type="text" name="keyword" id="keyword" placeholder="商品名を入力..." value="{{ request('keyword') }}">
            </div>

            <button type="submit" class="search-btn">検索</button>

            <div class="filter-group">
                <label for="sort">価格順</label>
                <select name="sort" id="sort">
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>価格の低い順</option>
                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>価格の高い順</option>
                </select>
            </div>
        </form>
    </aside>

    <main class="product-grid">
        @foreach($products as $product)
        <div class="product-card">
            <div class="product-image">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            </div>
            <div class="product-info">
                <h3 class="product-name">{{ $product->name }}</h3>
                <p class="product-price">¥{{ number_of_format($product->price) }}</p>
                <a href="{{ route('products.show', $product->id) }}" class="detail-link">詳細を見る</a>
            </div>
        </div>
        @endforeach
    </main>
</div>
@endsection
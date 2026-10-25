@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="product-detail">
    <nav class="breadcrumb">
        <a href="{{ route('products.index') }}">商品一覧</a>
        ＞
        <span>{{ $product->name }}</span>
    </nav>

    <div class="detail-container">
        <div class="detail-image-section">
            <div class="current-image">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
            </div>
        </div>

        <div class="detail-info-section">
            <div class="input-group">
                <label>商品名</label>
                <p>{{ $product->name }}</p>
            </div>

            <div class="input-group">
                <label>値段</label>
                <p>{{ number_format($product->price) }}円</p>
            </div>

            <div class="input-group">
                <label>季節</label>
                <p>
                    @forelse ($product->seasons as $season)
                        {{ $season->name }}@if (!$loop->last)、@endif
                    @empty
                        未設定
                    @endforelse
                </p>
            </div>
        </div>
    </div>

    <div class="description-section">
        <label>商品説明</label>
        <p>{{ $product->description }}</p>
    </div>

    <div class="detail-actions">
        <a href="{{ route('products.index') }}" class="back-btn">戻る</a>

        <a href="{{ route('products.edit', $product->id) }}" class="save-btn">
            変更
        </a>

        <form action="{{ route('products.destroy', $product->id) }}"
              method="POST"
              onsubmit="return confirm('本当にこの商品を削除してもよろしいですか？');"
              class="delete-form">
            @csrf
            @method('DELETE')

            <button type="submit" class="delete-btn" aria-label="商品を削除">
                <span class="trash-icon">🗑️</span>
            </button>
        </form>
    </div>
</div>
@endsection
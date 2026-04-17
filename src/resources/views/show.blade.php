@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
<div class="product-detail">
    <nav class="breadcrumb">
        <a href="{{ route('products.index') }}">商品一覧</a> ＞ <span>{{ $product->name }}</span>
    </nav>
    
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="detail-container">
            <div class="detail-image-section">
                <div class="current-image">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="現在の画像">
                </div>
                <div class="file-input-group">
                    <input type="file" name="image" id="image">
                    @error('image')
                      <p class="error-message" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="detail-info-section">
                <div class="input-group">
                    <label for="name">商品名</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}">
                    @error('name')
                      <p class="error-message" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</p>
                    @enderror  
                </div>

                <div class="input-group">
                    <label for="price">値段</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}">
                    @error('price')
                       <p class="error-message" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</p>
                    @enderror  
                </div>

                <div class="input-group">
                    <label>季節</label>
                    <div class="checkbox-group">
                        @php
                            $currentSeasonIds = $product->seasons->pluck('id')->toArray();
                        @endphp
                        <label>
                            <input type="checkbox" name="seasons[]" value="1"
                            {{ in_array(1, old('seasons', $currentSeasonIds)) ? 'checked' : '' }}> 春
                        </label>
                        <label>
                            <input type="checkbox" name="seasons[]" value="2"
                            {{ in_array(2, old('seasons', $currentSeasonIds)) ? 'checked' : '' }}> 夏
                        </label>
                        <label>
                            <input type="checkbox" name="seasons[]" value="3"
                            {{ in_array(3, old('seasons', $currentSeasonIds)) ? 'checked' : '' }}> 秋
                        </label>
                        <label>
                            <input type="checkbox" name="seasons[]" value="4"
                            {{ in_array(4, old('seasons', $currentSeasonIds)) ? 'checked' : '' }}> 冬
                        </label>
                    </div>
                @error('seasons')
                   <p class="error-message" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</p>
                @enderror    
                </div>
            </div>
        </div>

        <div class="description-section">
            <label for="description">商品説明</label>
            <textarea name="description" id="description" rows="5">{{ old('description', $product->description) }}</textarea>
            @error('description')
              <p class="error-message" style="color: red; font-size: 14px; margin-top: 5px;">{{ $message }}</p>
            @enderror
        </div>

        <div class="detail-actions">
            <a href="{{ route('products.index') }}" class="back-btn">戻る</a>
            <button type="submit" class="save-btn">変更を保存</button>
        </div>
    </form>
    
    <form action="{{ route('products.destroy', $product->id) }}" method="POST" 
          onsubmit="return confirm('本当にこの商品を削除してもよろしいですか？');" 
          class="delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="delete-btn">
            <span class="trash-icon">🗑️</span>
        </button>
        </div>
    </form>
    
</div>
@endsection
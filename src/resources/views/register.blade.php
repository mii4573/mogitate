@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register-container">
    <h2>商品登録</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 商品名 --}}
        <div class="form-group">
            <label>商品名
               <span class="required-tag">必須</span> 
            </label>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 価格 --}}
        <div class="form-group">
            <label>価格
                <span class="required-tag">必須</span>
            </label>
            <input type="number" name="price" value="{{ old('price') }}">
            @error('price')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 季節（チェックボックス） --}}
        <div class="form-group">
            <label>季節
                <span class="required-tag">必須</span>
                <span class="sub-text">複数選択可能</span>
            </label>
            @foreach($seasons as $season)
                <input type="checkbox" name="seasons[]" value="{{ $season->id }}" 
                    {{ is_array(old('seasons')) && in_array($season->id, old('seasons')) ? 'checked' : '' }}>
                {{ $season->name }}
            @endforeach
            @error('seasons')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        {{-- 画像 --}}
        <div class="form-group">
            <label>商品画像
                <span class="required-tag">必須</span>
            </label>
            <input type="file" name="image">
            @error('image')
                <p class="error-message" style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- 商品説明 --}}
        <div class="form-group">
          <label for="description">商品説明
            <span class="required-tag">必須</span>
          </label>
          <textarea name="description" id="description" class="form-input" rows="5" placeholder="商品の詳細を入力してください">{{ old('description') }}</textarea>
          @error('description')
           <p class="error-message" style="color: red;">{{ $message }}</p>
          @enderror 
        </div>

        <div class="form-actions">
            <button type="submit">登録する</button>
            <a href="{{ route('products.index') }}" class="back-link">戻る</a>
        </div>

    </form>
</div>
@endsection
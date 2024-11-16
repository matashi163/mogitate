@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('content')
<div class="register">
    <h2 class="register__title">商品登録</h2>
    <form action="/store" method="post" enctype="multipart/form-data" class="register__form">
        @csrf
        <div class="register__content">
            <div class="register__name">
                <div class="register__lavel">
                    <span class="register__lavel--item">商品名</span>
                    <span class="register__lavel--required">必須</span>
                </div>
                <input type="text" value="{{old('name')}}" name="name" placeholder="商品名を入力" class="register__name--input">
                @error('name')
                <p class="register__name--error">{{$errors->first('name')}}</p>
                @enderror
            </div>
            <div class="register__price">
                <div class="register__lavel">
                    <span class="register__lavel--item">値段</span>
                    <span class="register__lavel--required">必須</span>
                </div>
                <input type="text" value="{{old('price')}}" name="price" placeholder="値段を入力" class="register__price--input">
                @error('price')
                <p class="register__price--error">{{$errors->first('price')}}</p>
                @enderror
            </div>
            <div class="register__image">
                <div class="register__lavel">
                    <span class="register__lavel--item">商品画像</span>
                    <span class="register__lavel--required">必須</span>
                </div>
                <input type="file" value="{{old('image')}}" name="image" class="register__image--input">
                @error('image')
                <p class="register__image--error">{{$errors->first('image')}}</p>
                @enderror
            </div>
            <div class="register__season">
                <div class="register__lavel">
                    <span class="register__lavel--item">季節</span>
                    <span class="register__lavel--required">必須</span>
                </div>
                @foreach($seasons as $season)
                <input type="checkbox" name="seasons[]" value="{{$season->id}}" class="register__season--input"
                @if(in_array($season->id, old('seasons', [])))
                checked
                @endif
                >
                <span>{{$season->name}}</span>
                @endforeach
                @error('seasons')
                <p class="register__season--error">{{$errors->first('seasons')}}</p>
                @enderror
            </div>
            <div class="register__description">
                <div class="register__lavel">
                    <span class="register__lavel--item">商品説明</span>
                    <span class="register__lavel--required">必須</span>
                </div>
                <textarea name="description" placeholder="商品の説明を入力" class="register__description--input">{{old('description')}}</textarea>
                @error('description')
                <p class="register_description--error">{{$errors->first('description')}}</p>
                @enderror
            </div>
        </div>
        <a href="/" class="register__back-button">戻る</a>
        <button class="form-button__register">登録</button>
    </form>
</div>
@endsection
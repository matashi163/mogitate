@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/detail.css')}}">
@endsection

@section('content')
<div class="detail">
    <p class="detail__tag">
        <a href="/">商品一覧</a>
        <span>>{{$product->name}}</span>
    </p>
    <form action="/update" method="post" enctype="multipart/form-data" class="update__form">
        @csrf
        <input type="hidden" name="id" value="{{$product->id}}">
        <div class="detail__information">
            <div class="information__image-file">
                <image src="{{Storage::url('image/' . $product->image)}}" class="information__image-file--image"></image>
                <input type="file" name="image" class="information__image-file--input">
                @error('image')
                <p class="information__image-file--error">{{$errors->first('image')}}</p>
                @enderror
            </div>
            <div class="information__basic-information">
                <div class="basic-information__name">
                    <p class="basic-information__name--lavel">商品名</p>
                    <input type="text" name="name" value="{{$product->name}}" placeholder="商品名を入力" class="basic-information__name--input">
                    @error('name')
                    <p class="basic-information__name--error">{{$errors->first('name')}}</p>
                    @enderror
                </div>
                <div class="basic-information__price">
                    <p class="basic-information__price--lavel">値段</p>
                    <input type="text" name="price" value="{{$product->price}}" placeholder="値段を入力" class="basic-information__price--input">
                    @error('price')
                    <p class="basic-information__price--error">{{$errors->first('price')}}</p>
                    @enderror
                </div>
                <div class="basic-information__season">
                    <p class="basic-information__season--lavel">季節</p>
                    <div class="basic-information__season--input">
                        @foreach($seasons as $season)
                        <input type="checkbox" name="seasons[]" value="{{$season->id}}" class="basic-information__season--checkbox"
                        @if($product->season->contains($season->id))
                        checked
                        @endif>
                        <span>{{$season->name}}</span>
                        @endforeach
                        @error('seasons')
                        <p class="basic-information__season--error">{{$errors->first('seasons')}}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="detail__discription">
            <p class="discription--lavel">商品説明</p>
            <textarea name="description" placeholder="商品の説明を入力" class="discription--input">{{$product->description}}</textarea>
            @error('description')
            <p class="description--error">{{$errors->first('name')}}</p>
            @enderror
        </div>
        <div class="detail__form-button">
            <a href="/" class="form-button__back">戻る</a>
            <button class="form-button__update">変更を保存</button>
        </div>
    </form>
    <form action="delete" method="post" class="detail__delete">
        @csrf
        <input type="hidden" name="id" value="{{$product->id}}">
        <button class="detail__delete--button">削除</button>
    </form>
</div>
@endsection
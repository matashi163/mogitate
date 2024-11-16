@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection

@section('content')
<div class="product">
    <div class="product__header">
        <h2 class="product__title">商品一覧</h2>
        <form action="/register" method="get" class="product__register">
            @csrf
            <button class="product__register--button">+商品を追加</button>
        </form>
    </div>    
    <div class="product__content">
        <div class="product__search">
            <form action="/search" method="post" class="search__form">
                @csrf
                <input type="text" name="search" placeholder="商品名で検索" class="search__form--input">
                <button class="search__form--button">検索</button>
            </form>
        </div>
        <div class="product">
            <form action="/detail" method="get" class="product__list">
                @csrf
                @foreach($products as $product)
                <button name="id" value="{{$product->id}}" class="product__group">
                    <image src="{{Storage::url('image/' . $product->image)}}" class="group__image"></image>
                    <div class="group__lavel">
                        <span class="group__lavel--name">{{$product->name}}</span>
                        <span class="group__lavel--price">¥{{$product->price}}</span>
                    </div>
                </button>
                @endforeach
            </form>
            {{$products->links()}}
        </div>
    </div>
</div>
@endsection
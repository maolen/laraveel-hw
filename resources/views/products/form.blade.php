<?php

$product = $product ?? null;
?>

@extends('layouts.main')

@section('content')
    <h1>{{ $product ? 'Редактировать продукт' : 'Создать продукт' }}</h1>

    @include('components.form-errors')

    <form enctype="multipart/form-data"
          action="{{ $product ? route('products.update', $product) : route('products.store')}}" method="post">
        @csrf

        @if($product)
            @method('put')
        @endif
        <div>
            <label for="name">Название</label>
        </div>
        <div>
            <input value="{{ old('name', $product->name ?? null) }}"
                   type="text"
                   id="name"
                   name="name"
                   placeholder="Введите название">
        </div>
        <div>
            <label for="supplier">Производитель</label>
        </div>
        <div>
            <input value="{{ old('supplier', $product->supplier ?? null) }}"
                   type="text"
                   id="supplier"
                   name="supplier"
                   placeholder="Введите производителя">
        </div>

        <div>
            <label for="price">Цена</label>
        </div>
        <div>
            <input value="{{ old('price', $product->price ?? null) }}"
                   type="number"
                   min="1"
                   step="any"
                   id="price"
                   name="price"
                   placeholder="Введите цену">
        </div>

        <div>
            <label for="image">Обложка</label>
        </div>
        e
        <div>
            <input type="file" name="image" id="image" accept="image/*"/>
        </div>

        <div>
            <label for="description">Описание</label>
        </div>
        <div>
            <textarea name="description"
                      id=""
                      cols="30"
                      rows="10"
                      placeholder="Напишите описание продукта...">{{old('description', $product->description ?? null)}}</textarea>
        </div>

        <button>Сохранить</button>
    </form>

@endsection

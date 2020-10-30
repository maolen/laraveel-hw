@extends('layouts.main')

@section('content')
    <h1>{{ $product->name }}</h1>

    <div>
        <a href="{{ route('products.edit', $product) }}">Редактировать</a>
        <a href="{{ route('products.destroy', $product) }}"
           onclick="event.preventDefault(); document.getElementById('delete-form').submit()">
            Удалить
        </a>
    </div>

    <form id="delete-form" action="{{ route('products.destroy', $product) }}" method="post">
        @csrf @method('delete')
    </form>

    <p><b>Производитель</b> {{ $product->supplier }}</p>
    <p><b>Цена</b> {{ $product->price }} тг</p>
    <p><b>Описание</b></p>
    @if($product->description != null)
        <p>{{ $product->description }}</p>
    @else
        <p>Нет описания</p>
    @endif
@endsection

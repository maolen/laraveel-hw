@extends('layouts.main')

@section('content')
    <h1>{{ $product->name }}</h1>

    <small>
        Продавец: {{ $product->user->name }}
    </small>

    <div>
        @can('update', $product)
            <a href="{{ route('products.edit', $product) }}">Редактировать</a>
        @endcan

        @can('delete', $product)
            <a href="{{ route('products.destroy', $product) }}"
               onclick="event.preventDefault(); document.getElementById('delete-form').submit()">
                Удалить
            </a>

            <form id="delete-form" action="{{ route('products.destroy', $product) }}" method="post">
                @csrf
                @method('delete')
            </form>
        @endcan
    </div>

    <p><b>Производитель</b> {{ $product->supplier }}</p>
    <p><b>Цена</b> {{ $product->price }} тг</p>
    <p><b>Описание</b></p>
    @if($product->description != null)
        <p>{{ $product->description }}</p>
    @else
        <p>Нет описания</p>
    @endif
@endsection

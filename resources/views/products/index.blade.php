@extends('layouts.main')

@section('content')
    <h1>Продукты</h1>

    <p>
        <a href="{{ route('products.create') }}">Добавить продукт</a>
    </p>

    @if($products->isEmpty())
        <p>Нет продуктов</p>
    @else
        @foreach($products as $product)
            <div class="card text-center" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $product->price }} тг</h6>
                </div>
            </div>
        @endforeach

    @endif

@endsection

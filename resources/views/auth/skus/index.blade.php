@extends('auth.layouts.master')

@section('title', 'Товарные предложения')

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @if(session()->has('success'))
                        <p class="alert alert-success">{{ session()->get('success') }}</p>
                    @endif
                    @if(session()->has('warning'))
                        <p class="alert alert-warning">{{ session()->get('warning') }}</p>
                    @endif
                    <div class="row">
                        <div class="col-md-7">
                            <h1>Товарные предложения</h1>
                            <h2>{{ $product->title }}</h2>
                        </div>
                        <div class="col-md-5">
                            <a class="btn add" href="{{ route('skus.create', $product) }}">Добавить</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>SKU</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($skus as $sku)
                            <tr>
                                <td>{{ $sku->id }}</td>
                                <td>{{ $sku->propertyOptions->map->title->implode(', ') }}</td>
                                <td>{{ $sku->price }}</td>
                                <td>{{ $sku->count }}</td>
                                <td>
                                    <form action="{{ route('skus.destroy', [$product, $sku]) }}" method="post">
                                        <ul>
                                            <li><a class="btn view" href="{{ route('skus.show', [$product, $sku]) }}">Открыть</a></li>
                                            <li><a class="btn edit" href="{{ route('skus.edit', [$product, $sku])
                                            }}">Редактировать</a></li>
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn delete">Удалить</button>
                                        </ul>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $skus->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection

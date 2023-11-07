@extends('auth.layouts.master')

@section('title', 'Продукции')

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
                            <h1>Продукции</h1>
                        </div>
                        <div class="col-md-5">
                            <a href="{{ route('products.create') }}" class="btn add">Добавить</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Изображение</th>
                            <th>Название</th>
                            <th>Категория</th>
{{--                            <th>Кол-во пред</th>--}}
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td><img src="{{ Storage::url($product->image) }}" alt=""></td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->category->title }}</td>
{{--                                <td>{{ dd($product->sku) }}</td>--}}
                                <td>
                                    <form action="{{ route('products.destroy', $product) }}" method="post">
                                        <ul>
                                            <li><a class="btn view" href="{{ route('products.show', $product)
                                            }}">Открыть</a></li>
                                            <li><a class="btn add" href="{{ route('skus.index', $product)
                                            }}">Skus</a></li>
                                            <li><a class="btn edit" href="{{ route('products.edit', $product)
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
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection

<style>
    .admin table img{
        max-width: 100px !important;
    }
    .admin form .delete{
        padding: 8px 10px !important;
    }
</style>
@extends('auth.layouts.master')

@section('title', 'Sku ' . $sku->title)

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    <h1>Sku {{ $sku->product->title }}</h1>
                    <h2>{{ $sku->propertyOptions->map->title->implode(', ') }}</h2>
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>
                                Поле
                            </th>
                            <th>
                                Значение
                            </th>
                        </tr>
                        <tr>
                            <td>ID</td>
                            <td>{{ $sku->id }}</td>
                        </tr>
                        <tr>
                            <td>Цена</td>
                            <td>{{ $sku->price }}</td>
                        </tr>
                        <tr>
                            <td>Кол-во</td>
                            <td>{{ $sku->count }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

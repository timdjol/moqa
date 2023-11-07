@extends('auth.layouts.master')

@section('title', 'Категория ' . $category->title)

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    <h1>Категория {{ $category->title }}</h1>
                    <table class="table">
                        <tr>
                            <td>ID</td>
                            <td>{{ $category->id }}</td>
                        </tr>
                        <tr>
                            <td>Код</td>
                            <td>{{ $category->code }}</td>
                        </tr>
                        <tr>
                            <td>Название</td>
                            <td>{{ $category->title }}</td>
                        </tr>
                        <tr>
                            <td>Название EN</td>
                            <td>{{ $category->title_en }}</td>
                        </tr>
                        <tr>
                            <td>Описание</td>
                            <td>{{ $category->description }}</td>
                        </tr>
                        <tr>
                            <td>Описание EN</td>
                            <td>{{ $category->description_en }}</td>
                        </tr>
                        <tr>
                            <td>Изображение</td>
                            <td><img src="{{ Storage::url($category->image) }}"></td>
                        </tr>
                        <tr>
                            <td>Количество товаров</td>
                            <td>{{ $category->products->count() }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

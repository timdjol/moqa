@extends('auth.layouts.master')

@section('title', 'Вариант свойства ' . $propertyOption->title)

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    <h1>Вариант свойства {{ $propertyOption->title }}</h1>
                    <table class="table">
                        <tr>
                            <th>Поле</th>
                            <th>Значение</th>
                        </tr>
                        <tr>
                            <td>ID</td>
                            <td>{{ $propertyOption->id }}</td>
                        </tr>
                        <tr>
                            <td>Свойство</td>
                            <td>{{ $propertyOption->property->title }}</td>
                        </tr>
                        <tr>
                            <td>Название</td>
                            <td>{{ $propertyOption->title }}</td>
                        </tr>
                        <tr>
                            <td>Название EN</td>
                            <td>{{ $propertyOption->title_en }}</td>
                        </tr>
                        <tr>
                            <td>Цвет</td>
                            <td><div class="circle" style="background-color: {{ $propertyOption->color }}"></div></td>
                        </tr>
                        <tr>
                            <td>Количество</td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .circle{
            width: 30px;
            height: 30px;
            border-radius: 100%;
        }
    </style>

@endsection

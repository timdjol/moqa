@extends('auth.layouts.master')

@section('title', 'Свойство ' . $property->title)

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    <h1>Свойство {{ $property->title }}</h1>
                    <table class="table">
                        <tr>
                            <td>ID</td>
                            <td>{{ $property->id }}</td>
                        </tr>
                        <tr>
                            <td>Название</td>
                            <td>{{ $property->title }}</td>
                        </tr>
                        <tr>
                            <td>Название EN</td>
                            <td>{{ $property->title_en }}</td>
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

@endsection

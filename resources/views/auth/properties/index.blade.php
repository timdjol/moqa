@extends('auth.layouts.master')

@section('title', 'Свойства')

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
                            <h1>Свойства продукций</h1>
                        </div>
                        <div class="col-md-5">
                            <a class="btn add" href="{{ route('properties.create') }}">Добавить</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Название</th>
                            <th>Название EN</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($properties as $property)
                            <tr>
                                <td>{{ $property->id }}</td>
                                <td>{{ $property->title }}</td>
                                <td>{{ $property->title_en }}</td>
                                <td>
                                    <form action="{{ route('properties.destroy', $property) }}" method="post">
                                        <ul>
{{--                                            <li><a class="btn view" href="{{ route('properties.show', $property)--}}
{{--                                            }}">Открыть</a></li>--}}
                                            <li><a class="btn edit" href="{{ route('properties.edit', $property)
                                            }}">Редактировать</a></li>
                                            <li><a class="btn add" href="{{ route('property-options.index', $property)
                                            }}">Значение свойства</a></li>
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
                    {{ $properties->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection

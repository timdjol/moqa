@extends('auth.layouts.master')

@section('title', 'Варианты свойства')

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-7">
                            <h1>Варианты свойства</h1>
                        </div>
                        <div class="col-md-5">
                            <a class="btn add" href="{{ route('property-options.create', $property) }}">Добавить</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Свойство</th>
                            <th>Название</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($propertyOptions as $propertyOption)
                            <tr>
                                <td>{{ $propertyOption->id }}</td>
                                <td>{{ $propertyOption->property->title }}</td>
                                <td>{{ $propertyOption->title }}</td>
                                <td>
                                    <form action="{{ route('property-options.destroy', [$property, $propertyOption])
                                    }}"
                                          method="post">
                                        <ul>
                                            <li><a class="btn view" href="{{ route('property-options.show',
                                            [$property, $propertyOption])
                                            }}">Открыть</a></li>
                                            <li><a class="btn edit" href="{{ route('property-options.edit',
                                            [$property, $propertyOption])
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
                    {{ $propertyOptions->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection

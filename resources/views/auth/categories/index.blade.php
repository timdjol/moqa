@extends('auth.layouts.master')

@section('title', 'Категории')

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
                            <h1>Категории</h1>
                        </div>
                        <div class="col-md-5">
                            <a class="btn add" href="{{ route('categories.create') }}">Добавить</a>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Код</th>
                            <th>Название</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->code }}</td>
                                <td>{{ $category->title }}</td>
                                <td>
                                    <form action="{{ route('categories.destroy', $category) }}" method="post">
                                        <ul>
                                            <li><a class="btn view" href="{{ route('categories.show', $category)
                                            }}">Открыть</a></li>
                                            <li><a class="btn edit" href="{{ route('categories.edit', $category)
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
                    {{ $categories->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection

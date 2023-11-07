@extends('auth.layouts.master')

@section('title', 'Страницы')

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
                            <h1>Страницы</h1>
                        </div>
                        <div class="col-md-5">
                            <a class="btn add" href="{{ route('pages.create') }}">Добавить</a>
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
                        @foreach($pages as $page)
                            <tr>
                                <td>{{ $page->id }}</td>
                                <td>{{ $page->code }}</td>
                                <td>{{ $page->title }}</td>
                                <td>
                                    <form action="{{ route('pages.destroy', $page) }}" method="post">
                                        <ul>
                                            <li><a class="btn view" href="{{ route('pages.show', $page)
                                            }}">Открыть</a></li>
                                            <li><a class="btn edit" href="{{ route('pages.edit', $page)
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
                    {{ $pages->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection

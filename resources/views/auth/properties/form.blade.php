@extends('auth.layouts.master')

@isset($property)
    @section('title', 'Редактировать свойство' . $property->name)
@else
    @section('title', 'Создать свойство')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @isset($property)
                        <h1>Редактировать свойство {{ $property->title }}</h1>
                    @else
                        <h1>Создать свойство</h1>
                    @endisset
                    <form method="post"
                          @isset($property)
                              action="{{ route('properties.update', $property) }}"
                          @else
                              action="{{ route('properties.store') }}"
                            @endisset
                    >
                        @isset($property)
                            @method('PUT')
                        @endisset
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Заголовок</label>
                            <input type="text" name="title" value="{{ old('title', isset($property) ? $property->title :
                             null) }}">
                        </div>
                        @error('title_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Заголовок EN</label>
                            <input type="text" name="title_en" value="{{ old('title_en', isset($property) ?
                                $property->title_en : null) }}">
                        </div>
                        @csrf
                        <button class="more">Отправить</button>
                            <a href="{{url()->previous()}}" class="btn delete cancel">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

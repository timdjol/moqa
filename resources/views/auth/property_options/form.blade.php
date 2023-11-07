@extends('auth.layouts.master')

@isset($propertyOption)
    @section('title', 'Редактировать вариант свойства' . $propertyOption->name)
@else
    @section('title', 'Добавить вариант свойства')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @isset($propertyOption)
                        <h1>Редактировать вариант свойства {{ $propertyOption->title }}</h1>
                    @else
                        <h1>Добавить вариант свойства</h1>
                    @endisset
                    <form method="post"
                          @isset($propertyOption)
                              action="{{ route('property-options.update', [$property, $propertyOption]) }}"
                          @else
                              action="{{ route('property-options.store', $property) }}"
                            @endisset
                    >
                        @isset($propertyOption)
                            @method('PUT')
                        @endisset
                        <div class="form-group">
                            <h5>Свойство {{ $property->title }}</h5>
                        </div>
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Заголовок</label>
                            <input type="text" name="title" value="{{ old('title', isset($propertyOption) ? $propertyOption->title :
                             null) }}">
                        </div>
                        @error('title_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Заголовок EN</label>
                            <input type="text" name="title_en" value="{{ old('title_en', isset($propertyOption) ?
                                $propertyOption->title_en : null) }}">
                        </div>
                        @error('color')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <input type="color" name="color" value="{{ old('color', isset($propertyOption) ?
                                $propertyOption->color : null) }}">
                        </div>
                        @csrf
                        <button class="more">Отправить</button>
                        <a href="{{url()->previous()}}" class="btn delete cancel">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        input[type='color'] {
            width: 20%;
        }
    </style>

@endsection

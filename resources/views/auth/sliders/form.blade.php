@extends('auth.layouts.master')

@isset($slider)
    @section('title', 'Редактировать слайд ' . $slider->title)
@else
    @section('title', 'Создать слайд')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @isset($slider)
                        <h1>Редактировать слайд {{ $slider->title }}</h1>
                    @else
                        <h1>Создать слайд</h1>
                    @endisset
                    <form method="post" enctype="multipart/form-data"
                          @isset($slider)
                              action="{{ route('sliders.update', $slider) }}"
                          @else
                              action="{{ route('sliders.store') }}"
                            @endisset
                    >
                        @isset($slider)
                            @method('PUT')
                        @endisset
                        @error('title')
                        <div class="alert alert-dange">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Заголовок</label>
                            <input type="text" name="title" value="{{ old('title', isset($slider) ? $slider->title :
                             null) }}">
                        </div>
                        @error('title_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Заголовок EN</label>
                            <input type="text" name="title_en" value="{{ old('title_en', isset($slider) ?
                                $slider->title_en :
                             null) }}">
                        </div>
                        @error('link')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Ссылка</label>
                            <input type="text" name="link" value="{{ old('link', isset($slider) ?
                                $slider->link :
                             null) }}">
                        </div>
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Изображение</label>
                            @isset($slider)
                                <img src="{{ Storage::url($slider->image) }}" alt="">
                            @endisset
                            <input type="file" name="image">
                        </div>
                        @csrf
                        <button class="more">Отправить</button>
                        <a href="{{ url()->previous() }}" class="btn delete cancel">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('auth.layouts.master')

@isset($review)
    @section('title', 'Редактировать отзыв ' . $review->title)
@else
    @section('title', 'Создать отзыв')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @isset($review)
                        <h1>Редактировать отзыв {{ $review->title }}</h1>
                    @else
                        <h1>Создать отзыв</h1>
                    @endisset
                    <form method="post" enctype="multipart/form-data"
                          @isset($review)
                              action="{{ route('reviews.update', $review) }}"
                          @else
                              action="{{ route('reviews.store') }}"
                            @endisset
                    >
                        @isset($review)
                            @method('PUT')
                        @endisset
                        @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Заголовок</label>
                            <input type="text" name="title" value="{{ old('title', isset($review) ? $review->title :
                             null) }}">
                        </div>
                        @error('title_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Заголовок EN</label>
                            <input type="text" name="title_en" value="{{ old('title_en', isset($review) ?
                                $review->title_en :
                             null) }}">
                        </div>
                        @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Описание</label>
                            <textarea name="description" class="editor" rows="3">{{ old('description', isset
                            ($review) ?
                            $review->description : null) }}</textarea>
                        </div>
                        @error('description_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Описание EN</label>
                            <textarea name="description_en" class="editor1" rows="3">{{ old('description_en', isset
                            ($review) ?
                            $review->description_en : null) }}</textarea>
                        </div>
                        <script src="https://cdn.tiny.cloud/1/yxonqgmruy7kchzsv4uizqanbapq2uta96cs0p4y91ov9iod/tinymce/6/tinymce.min.js"
                                referrerpolicy="origin"></script>
                        <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('.editor'))
                                .catch(error => {
                                    console.error(error);
                                });
                            ClassicEditor
                                .create(document.querySelector('.editor1'))
                                .catch(error => {
                                    console.error(error);
                                });
                        </script>
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Изображение</label>
                            @isset($review)
                                <img src="{{ Storage::url($review->image) }}" alt="">
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

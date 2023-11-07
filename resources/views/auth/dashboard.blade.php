@extends('auth/layouts.master')

@section('title', 'Консоль')

@section('content')

<div class="page admin dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('auth/layouts.sidebar')
            </div>
            <div class="col-md-9">
                @if(session()->has('success'))
                    <p class="alert alert-success">{{ session()->get('success') }}</p>
                @endif
                @if(session()->has('warning'))
                    <p class="alert alert-warning">{{ session()->get('warning') }}</p>
                @endif
                <h1>Добро пожаловать {{ $user->name }}</h1>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="dashboard-item">
                            <div class="num">{{ $order->count() }}</div>
                            <h5>Количество <br> заказов</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dashboard-item">
                            <div class="num">{{ $user->count() }}</div>
                            <h5>Количество <br> пользователей</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dashboard-item">
                            <div class="num">{{ $product->count() }}</div>
                            <h5>Количество <br> продукций</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dashboard-item">
                            <div class="num">{{ $categories->count() }}</div>
                            <h5>Количество <br> категорий</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dashboard-item">
                            <div class="num">{{ $page->count() }}</div>
                            <h5>Количество <br> страниц</h5>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="dashboard-item">
                            <div class="num">{{ $coupon->count() }}</div>
                            <h5>Количество <br> купонов</h5>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="sliders">
                            <h3>Слайды</h3>
                            <p>Количество слайдов: {{ $sliders->count() }}</p>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Изображение</th>
                                    <th>Название</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sliders as $slider)
                                    <tr>
                                        <td><img src="{{ Storage::url($slider->image) }}" alt=""></td>
                                        <td>{{ $slider->title }}</td>
                                        <td>
                                            <form action="{{ route('sliders.destroy', $slider) }}" method="post">
                                                <ul>
                                                    <li><a class="btn edit" href="{{ route('sliders.edit', $slider)
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
                            <a class="btn add" href="{{ route('sliders.create') }}">Добавить слайд</a>
                            {{ $sliders->links('pagination::bootstrap-4') }}
                        </div>

                        <div class="reviews">
                            <h3>Отзывы</h3>
                            <p>Количество отзывов: {{ $reviews->count() }}</p>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Изображение</th>
                                    <th>Название</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reviews as $review)
                                    <tr>
                                        <td><img src="{{ Storage::url($review->image) }}" alt=""></td>
                                        <td>{{ $review->title }}</td>
                                        <td>
                                            <form action="{{ route('sliders.destroy', $review) }}" method="post">
                                                <ul>
                                                    <li><a class="btn edit" href="{{ route('reviews.edit', $review)
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
                            <a class="btn add" href="{{ route('reviews.create') }}">Добавить отзыв</a>
                            {{ $reviews->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

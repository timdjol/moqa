@extends('auth.layouts.master')

@section('title', 'Купон ' . $coupon->title)

@section('content')

    <div class="page">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    <h1>Купон {{ $coupon->title }}</h1>
                    <table class="table">
                        <tr>
                            <td>ID</td>
                            <td>{{ $coupon->id }}</td>
                        </tr>
                        <tr>
                            <td>Код</td>
                            <td>{{ $coupon->code }}</td>
                        </tr>
                        <tr>
                            <td>Абсолютное значение</td>
                            <td>@if($coupon->isAbsolute())
                                    Да
                                @else
                                    Нет
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Скидка</td>
                            <td>{{ $coupon->value }}
                                @if($coupon->isAbsolute())
                                    {{ $coupon->currency->symbol}}
                                @else
                                    %
                                @endif
                            </td>
                        </tr>
                        @isset($coupon->currency)
                            <tr>
                                <td>Валюта</td>
                                <td>{{ $coupon->currency->code ?? null}}</td>
                            </tr>
                        @endisset
                        <tr>
                            <td>Использовать один раз</td>
                            <td>@if($coupon->isOnlyOnce())
                                    Да
                                @else
                                    Нет
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Использован</td>
                            <td>{{ $coupon->orders->count() }}</td>
                        </tr>
                        @isset($coupon->expired_at)
                            <tr>
                                <td>Действителен до:</td>
                                <td>{{ $coupon->changeDate() }}</td>
                            </tr>
                        @endisset
                        <tr>
                            <td>Описание</td>
                            <td>{{ $coupon->description }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

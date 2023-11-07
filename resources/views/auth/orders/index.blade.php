@extends('auth/layouts.master')

@section('title', 'Заказы')

@section('content')

    <div class="page admin order">
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
                    <h1>Заказы</h1>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Дата</th>
                            <th>Сумма</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->name }}</td>
                                <td><a href="tel:{{ $order->phone }}">{{ $order->phone }}</a></td>
                                <td>{{ $order->showDate() }}</td>
                                <td>{{ $order->sum }} {{ $order->currency->symbol }}</td>
                                <td>
                                    <ul>
                                        <li>
                                            <a class="btn add" href="
                                            @admin
                                                {{ route('orders.show', $order) }}
                                            @else
                                                {{ route('person.orders.show', $order) }}
                                            @endadmin">
                                                Открыть
                                            </a>
                                        </li>
                                        @admin
                                        <li><a class="btn edit" href="{{ route('orders.edit', $order)
                                            }}">Редактировать</a></li>
                                        <form action="{{ route('orders.destroy', $order) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn delete">Удалить</button>
                                        </form>
                                        @endadmin
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $orders->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection

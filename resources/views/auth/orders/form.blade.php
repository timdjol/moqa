@extends('auth.layouts.master')

@isset($order)
    @section('title', 'Редактировать  ' . $order->name)
@else
    @section('title', 'Создать заказ')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @isset($order)
                        <h1>Редактировать заказ {{ $order->title }}</h1>
                    @else
                        <h1>Создать заказ</h1>
                    @endisset
                    <form method="post" enctype="multipart/form-data"
                          @isset($order)
                              action="{{ route('orders.update', $order) }}"
                          @else
                              action="{{ route('orders.store') }}"
                            @endisset
                    >
                        @isset($order)
                            @method('PUT')
                        @endisset
                        @include('auth.layouts.error', ['fieldname' => 'name'])
                        <div class="form-group">
                            <label for="">ФИО</label>
                            <input type="text" name="name" value="{{ old('name', isset($order) ? $order->name :
                             null) }}">
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'phone'])
                        <div class="form-group">
                            <label for="">Номер телефона</label>
                            <input type="text" name="phone" value="{{ old('phone', isset($order) ? $order->phone :
                             null) }}">
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'email'])
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" value="{{ old('email', isset($order) ?
                                $order->email : null) }}">
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'sum'])
                            <div class="form-group">
                                <label for="">Сумма</label>
                                <input type="text" name="sum" value="{{ old('sum', isset($order) ?
                                $order->sum : null) }}">
                            </div>
                            @include('auth.layouts.error', ['fieldname' => 'label'])
                            <div class="form-group">
                                <label for="">Статус</label>
                                <select name="label">
                                    <option value="{{ $order->label }}">{{ $order->label }}</option>
                                    <option value="В процессе">В процессе</option>
                                    <option value="Выполнено">Выполнено</option>
                                    <option value="Отправлено">Отправлено</option>
                                    <option value="Возврат товара">Возврат товара</option>
                                    <option value="Отменено">Отменено</option>
                                </select>
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

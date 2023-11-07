@extends('layouts.master')

@isset($coupon)
    @section('title', 'Редактировать купон')
@else
    @section('title', 'Добавить купон')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @isset($coupon)
                        <h1>Редактировать купон</h1>
                    @else
                        <h1>Добавить купон</h1>
                    @endisset
                    <form method="post"
                          @isset($coupon)
                              action="{{ route('coupons.update', $coupon) }}"
                          @else
                              action="{{ route('coupons.store') }}"
                            @endisset
                    >
                        @isset($coupon)
                            @method('PUT')
                        @endisset
                        @include('auth.layouts.error', ['fieldname' => 'code'])
                        <div class="form-group">
                            <label for="">Код</label>
                            <input type="text" name="code" value="{{ old('code', isset($coupon) ? $coupon->code :
                             null) }}">
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'value'])
                        <div class="form-group">
                            <label for="">Номинал</label>
                            <input type="text" name="value" value="{{ old('value', isset($coupon) ? $coupon->value :
                             null) }}">
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'currency_id'])
                        <div class="form-group">
                            <label for="">Валюта</label>
                            <select name="currency_id">
                                <option value="">Без валюты</option>
                                @foreach($currencies as $currency)
                                    <option value="{{ $currency->id }}"
                                            @isset($coupon)
                                                @if($coupon->currency_id == $currency->id)
                                                    selected
                                            @endif
                                            @endisset
                                    >{{ $currency->code }}</option>
                                @endforeach
                            </select>
                        </div>
                        @foreach([
                            'type' => 'Абсолютное значение',
                            'only_once' => 'Купон может быть использован только один раз',
                        ] as $field => $title)
                            <div class="form-group">
                                <input type="checkbox" name="{{ $field }}"
                                       @if (isset($coupon) && $coupon->$field === 1)
                                           checked="checked"
                                @endif
                                <label for="">{{ $title }}</label>
                            </div>
                        @endforeach
                        @include('auth.layouts.error', ['fieldname' => 'expired_at'])
                        <div class="form-group">
                            <label for="">Использовать до:</label>
                            <input type="date" name="expired_at" value="{{ old('description', isset($coupon) ?
                            $coupon->changeDateForm() : null) }}">
                        </div>
                        @include('auth.layouts.error', ['fieldname' => 'description'])
                        <div class="form-group">
                            <label for="">Описание</label>
                            <textarea name="description" rows="3">{{ old('description', isset($coupon) ?
                            $coupon->description : null) }}</textarea>
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

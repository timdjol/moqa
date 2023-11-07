@extends('layouts.master')

@section('title', 'Корзина')

@section('content')
    <div class="page cart basket">
        <div class="container">
            <div class="col-md-12">
                <h1>@lang('basket.basket')</h1>
                <table>
                    <tr>
                        <td>@lang('basket.image')</td>
                        <td>@lang('basket.name')</td>
                        <td>@lang('basket.count')</td>
                        <td>@lang('basket.price')</td>
                        <td>@lang('basket.cost')</td>
                    </tr>
                    @foreach($order->skus as $sku)
                        <tr>
                            <td>
                                <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code,
                                $sku->id]) }}">
                                    <img src="{{ Storage::url($sku->product->image) }}" alt="{{ $sku->product->__
                                    ('title') }}">
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code,
                                $sku->id]) }}">{{ $sku->product->__('title') }}</a>
                                @isset($sku->product->properties)
                                    @foreach($sku->propertyOptions as $propertyOption)
                                        <p style="margin-bottom: 0; font-size: 12px;">{{ $propertyOption->property->__
                                        ('title') }}: {{ $propertyOption->__
                ('title') }}</p>
                                    @endforeach
                                @endisset

                            </td>
                            <td>
                                <form action="{{ route('basket-remove', $sku) }}" method="post">
                                    <button type="submit" class="btn btn-danger">-</button>
                                    @csrf
                                </form>
                                <span class="badge">{{ $sku->countInOrder }}</span>
                                <form action="{{ route('basket-add', $sku) }}" method="post">
                                    <button type="submit" class="btn btn-success">+</button>
                                    @csrf
                                </form>
                            </td>
                            <td>{{ $sku->price }} {{ $currencySymbol }}</td>
                            <td>{{ $sku->price * $sku->countInOrder }} {{ $currencySymbol }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">@lang('basket.total_cost')</td>
                        @if($order->hasCoupon())
                            <td><strike>{{ $order->getFullSum(false) }} {{
                            $currencySymbol }}</strike> <b>{{ $order->getFullSum() }} {{
                            $currencySymbol }}</b></td>
                        @else
                            <td>{{ $order->getFullSum() }} {{ $currencySymbol }}</td>
                        @endif
                    </tr>
                </table>
                @if(!$order->hasCoupon())
                    <div class="row">
                        <div class="col-md-4">
                            <div class="coupon">
                                <form action="{{ route('set-coupon') }}" method="post">
                                    @error ('coupon')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div class="form-group">
                                        <label for="">@lang('basket.coupon_promo')</label>
                                        <input type="text" name="coupon">
                                        <button class="more">@lang('basket.coupon_btn')</button>
                                    </div>
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <p>@lang('basket.coupon_use') {{ $order->coupon->code }}</p>
                @endif
                <div class="row">
                    <div class="col-md-4">
                        <div class="btn-wrap orderbtn">
                            <a href="{{ route('order') }}" class="more">@lang('basket.checkout_btn')</a>
                        </div>
                    </div>
                    <div class="col-md-8 btns">
                        <div class="btn-wrap">
                            <ul>
                                <li><a href="{{ route('catalog') }}" class="more">@lang('basket.continue')</a></li>
                                <li><a href="{{ route('basket-reset') }}" class="more delete">@lang('basket.clear')</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

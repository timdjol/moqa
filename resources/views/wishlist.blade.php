@extends('layouts.master')

@section('title', 'Избранные')

@section('content')
    <div class="page cart basket wishlist">
        <div class="container">
            <div class="row">
                @if($order)
                    <div class="col-md-12">
                        <h1>@lang('wish.title')</h1>
                        <table>
                            <tr>
                                <td>@lang('basket.name')</td>
                                <td>@lang('basket.price')</td>
                                <td>@lang('wish.action')</td>
                            </tr>
                            @foreach($order->skus as $sku)
                                <tr>
                                    <td>
                                        <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code,
                                $sku->id]) }}">
                                            <img src="{{ Storage::url($sku->product->image) }}" alt="{{ $sku->product->__
                                    ('title') }}">
                                            {{ $sku->product->__('title') }}
                                        </a>
                                    </td>
                                    <td>{{ $sku->price }} {{ $currencySymbol }}</td>
                                    <td>
{{--                                        <span class="badge">{{ $sku->countInOrder }}</span>--}}
                                        <form action="{{ route('wishlist-remove', $sku) }}" method="post">
                                            <button type="submit" class="btn btn-danger">@lang('wish.delete')</button>
                                            @csrf
                                        </form>
                                        @if($sku->isAvailable())
                                            <form action="{{ route('basket-add', $sku) }}" method="POST">
                                                <button class="more" type="submit">@lang('product.addtocart')</button>
                                                @csrf
                                            </form>
                                        @else
                                            <p>@lang('product.no_available')</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="btn-wrap">
                                    <a href="{{ route('catalog') }}" class="more">@lang('basket.continue')</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="btn-wrap">
                                    <a href="{{ route('wishlist-reset') }}" class="more">@lang('wish.clear')</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-12">
                        <h2>@lang('wish.not')</h2>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

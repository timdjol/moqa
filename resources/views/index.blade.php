@extends('layouts.master')

@section('title', 'Главная страница')

@section('content')

    <div class="slider">
        <div class="owl-carousel owl-slider">
            @foreach($sliders as $slider)
                <div class="slider-item" style="background-image: url({{ Storage::url($slider->image) }})">
                    <div class="container">
                        <div class="text-wrap">
                            <h2>{{ $slider->__('title') }}</h2>
                            @if($slider->link)
                                <div class="btn-wrap">
                                    <a href="{{ $slider->link }}" class="more">@lang('main.readmore')</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="products novelties">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>@lang('main.news')</h2>
                    <div class="owl-carousel owl-products">
                        @foreach($news->map->skus->flatten() as $sku)
                            @include('layouts.cart', compact('sku'))
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products coming">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>@lang('main.soon')</h2>
                    <div class="owl-carousel owl-products">
                        @foreach($soons->map->skus->flatten() as $sku)
                            @include('layouts.cart', compact('sku'))
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <div class="products capsule">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <h2>Капсула</h2>--}}
{{--                    <div class="owl-carousel owl-products">--}}
{{--                        @foreach($capsules->map->skus->flatten() as $sku)--}}
{{--                            @include('layouts.cart', compact('sku'))--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="products clothes">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>@lang('main.cloth')</h2>
                    <div class="owl-carousel owl-products">
                        @foreach($clothes->map->skus->flatten() as $sku)
                            @include('layouts.cart', compact('sku'))
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="products sport">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>@lang('main.sportswear')</h2>
                    <div class="owl-carousel owl-products">
                        @foreach($sports->map->skus->flatten() as $sku)
                            @include('layouts.cart', compact('sku'))
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products home">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>@lang('main.homewear')</h2>
                    <div class="owl-carousel owl-products">
                        @foreach($homes->map->skus->flatten() as $sku)
                            @include('layouts.cart', compact('sku'))
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products beach">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>@lang('main.beach')</h2>
                    <div class="owl-carousel owl-products">
                        @foreach($beaches->map->skus->flatten() as $sku)
                            @include('layouts.cart', compact('sku'))
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products underwear">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>@lang('main.underwear')</h2>
                    <div class="owl-carousel owl-products">
                        @foreach($underwears->map->skus->flatten() as $sku)
                            @include('layouts.cart', compact('sku'))
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products socks">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>@lang('main.socks')</h2>
                    <div class="owl-carousel owl-products">
                        @foreach($socks->map->skus->flatten() as $sku)
                            @include('layouts.cart', compact('sku'))
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products access">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>@lang('main.access')</h2>
                    <div class="owl-carousel owl-products">
                        @foreach($access->map->skus->flatten() as $sku)
                            @include('layouts.cart', compact('sku'))
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <div class="products cosmetic">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12">--}}
{{--                    <h2>Косметика</h2>--}}
{{--                    <div class="owl-carousel owl-products">--}}
{{--                        @foreach($cosmetics->map->skus->flatten() as $sku)--}}
{{--                            @include('layouts.cart', compact('sku'))--}}
{{--                        @endforeach--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="products sale">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>SALE</h2>
                    <div class="owl-carousel owl-products">
                        @foreach($sales->map->skus->flatten() as $sku)
                            @include('layouts.cart', compact('sku'))
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

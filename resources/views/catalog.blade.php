@extends('layouts.master')

@section('title', 'Каталог')

@section('content')

    <div class="pagetitle">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>@lang('main.catalog')</h1>
                    <h4>@lang('main.showed') {{ $product->count() }}</h4>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('index') }}">@lang('main.home')</a></li>
                            <li>/</li>
                            <li>@lang('main.catalog')</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page products category">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="filters">
                        <form action="{{ route('catalog') }}" method="get">
                            <div class="row">
                                <div class="col-md-12">
{{--                                    <div class="form-group form-label">--}}
{{--                                        <label for="">Выбрать категорию</label>--}}
{{--                                        <select name="category_id" id="">--}}
{{--                                            @foreach($categories as $category)--}}
{{--                                                <option--}}
{{--                                                        value="{{ $category->id }}"--}}
{{--                                                        @if(@isset(request()->category_id))--}}
{{--                                                            @if(request()->category_id == $category->id) selected @endif--}}
{{--                                                        @endif--}}
{{--                                                >{{--}}
{{--                                                $category->title--}}
{{--                                                }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
                                    <div class="form-group form-label">
                                        <label for="price_from">@lang('main.price_from')</label>
                                        <input type="text" name="price_from" id="price_from"
                                               value="{{ request()->price_from }}">
                                    </div>
                                    <div class="form-group form-label">
                                        <label for="price_to">@lang('main.price_to')</label>
                                        <input type="text" name="price_to" label="price_to" value="{{ request()
                                        ->price_to }}">
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="hit" name="hit" @if(request()->has('hit')) checked
                                                @endif>
                                        <label for="hit">@lang('product.properties.hit')</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="recommend" name="recommend" @if(request()->has
                                        ('recommend'))
                                            checked @endif>
                                        <label for="recommend">@lang('product.properties.recommend')</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="new" name="new" @if(request()->has('new')) checked
                                                @endif>
                                        <label for="new">@lang('product.properties.new')</label>
                                    </div>
                                    <div class="form-group btn-wrap">
                                        <button class="more">@lang('main.filter')</button>
                                        <a href="{{ route('catalog') }}" class="reset">@lang('main.reset')</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($skus->isNotEmpty())
                    @foreach($skus->unique('product_id') as $sku)
                        <div class="col-lg-3 col-md-4 col-6" style="margin-bottom: 40px">
                            @include('layouts.cart', compact('sku'))
                        </div>
                    @endforeach
                @else
                    <h2>@lang('main.not_found')</h2>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ $skus->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

@endsection

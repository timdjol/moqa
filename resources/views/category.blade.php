@extends('layouts.master')

@section('title', $category->__('title'))

@section('content')

    <div class="pagetitle">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{$category->__('title')}}</h1>
{{--                    <p>{!! $category->__('description') !!}</p>--}}
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('index') }}">@lang('main.home')</a></li>
                            <li>/</li>
                            <li><a href="{{ route('catalog') }}">@lang('main.catalog')</a></li>
                            <li>/</li>
                            <li>{{$category->__('title')}}</li>
                        </ul>
                    </div>
                    <h4>@lang('main.showed') {{ $category->products->count() }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="products category">
        <div class="container">
            <div class="row">
                @if($category->products->map->skus->flatten()->isNotEmpty())
                    @foreach($category->products->map->skus->flatten()->unique('product_id') as $sku)
                        <div class="col-lg-3 col-md-4 col-6">
                            @include('layouts.cart', compact('sku'))
                        </div>
                    @endforeach
                @else
                    <h2>@lang('main.not_found')</h2>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="pagination">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.master')

@section('title', 'Поиск')

@section('content')

    <div class="pagetitle">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>@lang('main.search')</h1>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('index') }}">@lang('main.home')</a></li>
                            <li>/</li>
                            <li>@lang('main.search')</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="products">
        <div class="container">
            <div class="row">
                @if($search->map->skus->flatten()->isNotEmpty())
                    @foreach($search->map->skus->flatten() as $sku)
                        <div class="col-lg-3 col-md-4 col-6">
                            @include('layouts.cart', compact('sku'))
                        </div>
                    @endforeach
                @else
                    <h2>Продукции не найдены</h2>
                @endif
            </div>
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
        </div>
    </div>

@endsection

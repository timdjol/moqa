@extends('layouts.master')

@section('title', 'Каталог')

@section('content')

    <div class="pagetitle">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>@lang('main.all_categories')</h1>
                    <h4>@lang('main.showed'): {{ $categories->count() }}</h4>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('index') }}">@lang('main.home')</a></li>
                            <li>/</li>
                            <li>@lang('main.all_categories')</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page products catalog category">
        <div class="container">
            <div class="row">
                @foreach($categories as $category)
                    <div class="col-lg-4 col-md-4 col-6">
                        <div class="catalog-item">
                            <a href="{{ route('category', $category->code) }}">
                                {{$category->__('title')}}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

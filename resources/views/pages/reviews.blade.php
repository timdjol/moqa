@extends('layouts.master')

@section('title', 'Отзывы')

@section('content')

    <div class="pagetitle">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $page->__('title') }}</h1>
                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('index') }}">@lang('main.home')</a></li>
                            <li>/</li>
                            <li>{{ $page->__('title') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page reviews pt0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 col-md-12">
                    @foreach($reviews as $review)
                        <div class="reviews-item">
                            <div class="img" style="background-image: url({{ Storage::url($review->image) }})"></div>
                            <h4>{{ $review->__('title') }}</h4>
                            <div class="text-wrap">
                                <p>{!! $review->__('description') !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

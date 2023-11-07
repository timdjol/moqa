@extends('layouts.master')

@section('title', 'Контакты')

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

    <div class="page contacts pt0">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="phone"><a href="tel:{{ $contacts->first()->phone }}">{{ $contacts->first()->phone }}</a></div>
                    <div class="soc">
                        <ul>
                            <li><a href="{{ $contacts->first()->whatsapp }}" target="_blank"><img src="{{ url('/')
                                }}/img/whatsapp.svg"
                                                                                                  alt=""></a></li>
                            <li><a href="{{ $contacts->first()->instagram }}" target="_blank"><img src="{{ url('/')
                                }}/img/instagram.svg" alt=""></a>
                            </li>
                            <li><a href="{{ $contacts->first()->telegram }}" target="_blank"><img src="{{ url('/')
                                }}/img/telegram.svg" alt=""></a></li>
                        </ul>
                    </div>
                    {!! $page->__('description') !!}
                    <form action="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" placeholder="@lang('basket.your_name')">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" placeholder="@lang('basket.phone')" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <textarea name="" rows="4" placeholder="@lang('main.message')"></textarea>
                                <button class="more" id="send">@lang('product.send')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

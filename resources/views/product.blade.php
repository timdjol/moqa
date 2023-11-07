@extends('layouts.master')

@section('title', $skus->product->__('title'))

@section('content')

    <div class="pagetitle">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>@lang('main.catalog')</h1>

                    <div class="breadcrumbs">
                        <ul>
                            <li><a href="{{ route('index') }}">@lang('main.home')</a></li>
                            <li>/</li>
                            <li><a href="{{ route('category', $skus->product->category->code) }}">{{
                    $skus->product->category->__('title') }}</a></li>
                            <li>/</li>
                            <li>{{ $skus->product->__('title') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="single">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row gallery">
                        <div class="col-md-6 col-6">
                            <a href="{{ Storage::url($skus->product->image) }}">
                                <div class="img" style="background-image: url({{ Storage::url($skus->product->image) }})
                                "></div>
                            </a>
                        </div>
                        @foreach($images as $image)
                            <div class="col-md-6">
                                <a href="{{ Storage::url($image->image) }}">
                                    <div class="img" style="background-image: url({{ Storage::url($image->image) }})
                                "></div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <h1>{{ $skus->product->__('title') }}</h1>
                    <div class="cat">
                        <a href="{{ route('category', $skus->product->category->code) }}">{{
                    $skus->product->category->__('title') }}</a>
                    </div>
                    <div class="price">{{ $skus->price }} {{ $currencySymbol }}</div>
                    @if($skus->isAvailable() == 1)
                        <div class="stock in">@lang('product.stock')</div>
                    @endif


                    @isset($skus->product->properties)
                        <div class="properties">
                            @foreach($skus->propertyOptions as $propertyOption)
                                <div class="text">{{ $propertyOption->property->__('title') }}: {{ $propertyOption->__
                                                        ('title') }}</div>
                            @endforeach
                        </div>
                    @endisset


                    <div class="colors">
                        <ul>
                            @foreach($relatedsku as $sku)
                                @isset($sku->product->properties)
                                    @foreach($sku->propertyOptions->where('property_id', 1) as $propertyOption)
                                        <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code,
                                         $sku]) }}"><span class="color @if($sku->id == $skus->id ){{ 'current' }}@endif"
                                                          style="background-color: {{ $propertyOption->color }}"></span>
                                        </a>
                                    @endforeach
                                @endisset
                            @endforeach
                        </ul>
                    </div>

                    <div class="size">
                        <form>
                            <select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                @foreach($relatedsku as $sku)
                                    @isset($sku->product->properties)
                                        @foreach($sku->propertyOptions->where('property_id', 2) as $propertyOption)
                                            <option value="{{ route('sku', [$sku->product->category->code, $sku->product->code,
                                         $sku]) }}" @if($sku->id == $skus->id )
                                                {{ 'selected' }}
                                                    @endif>{{ $propertyOption->title
                                            }}</option>
                                        @endforeach
                                    @endisset
                                @endforeach
                            </select>
                        </form>
                    </div>
                    <div class="btn-wrap">
                        <div class="buy">
                            @if($skus->isAvailable())
                                <form action="{{ route('basket-add', $skus) }}" method="post">
                                    <button class="more" type="submit">@lang('product.addtocart')</button>
                                    @csrf
                                </form>
                            @else
                                <span>@lang('product.no_available')</span><br>
                                <span>@lang('product.subscription')</span>
                                @if($errors->get('email'))
                                    <div class="alert alert-warning">
                                        {!! $errors->get('email')[0] !!}
                                    </div>
                                @endif
                                <form action="{{ route('subscription', $skus) }}" method="post">
                                    <div class="form-group">
                                        <input type="text" name="email" placeholder="@lang('main.your_email')">
                                    </div>
                                    @csrf
                                    <button class="more">@lang('product.send')</button>
                                </form>
                            @endif
                        </div>
                        <div class="click">
                            <a href="#click" class="more">@lang('product.click')</a>
                            <div class="hidden">
                                <form action="" class="form-callback" id="click">
                                    <h3>@lang('product.click')</h3>
                                    <img src="{{ Storage::url($skus->product->image) }}" class="img" alt="">
                                    <input type="hidden" name="product" value="{{ $skus->product->__('title') }}">
                                    <input type="hidden" name="price" value="{{ $skus->price }} {{ $currencySymbol }}">
                                    <div class="form-group">
                                        <label for="">@lang('basket.your_name')</label>
                                        <input type="text" name="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">@lang('basket.phone')</label>
                                        <input type="number" id="phone" name="phone" value="{{ old('phone', isset
                                            ($order) ?
                            $order->phone : null) }}" required>
                                        <div id="output" class="error"></div>
                                    </div>
                                    <button id="send" class="more">@lang('product.send')</button>
                                </form>
                            </div>
                        </div>
                        <div class="wish">
                            <form action="{{ route('wishlist-add', $skus) }}" method="POST">
                                <button>
                                    <svg width="800px" height="800px" viewBox="0 0 64 64"
                                         xmlns="http://www.w3.org/2000/svg"
                                         stroke-width="1.5"
                                         stroke="#fff" fill="none">
                                        <path d="M9.06,25C7.68,17.3,12.78,10.63,20.73,10c7-.55,10.47,7.93,11.17,9.55a.13.13,0,0,0,.25,0c3.25-8.91,9.17-9.29,11.25-9.5C49,9.45,56.51,13.78,55,23.87c-2.16,14-23.12,29.81-23.12,29.81S11.79,40.05,9.06,25Z"/>
                                    </svg>
                                </button>
                                @csrf
                            </form>
                        </div>
                    </div>
                    <div class="choose">
                        <a href="#choose_size">@lang('product.choose_size')</a>
                        <div class="hidden">
                            @if($skus->product->category->id == 17)
                                <div id="choose_size" class="form-callback size-wrap">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="img" style="background-image: url('{{route('index')}}/img/foot.jpeg')
                                            "></div>
                                        </div>
                                        <div class="col-md-9">
                                            <h3>@lang('product.size_table')</h3>
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>@lang('product.size')</th>
                                                    <th>@lang('product.size_shoes')</th>
                                                    <th>@lang('product.foot')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>23</td>
                                                    <td>35-37</td>
                                                    <td>21,3-23,3</td>
                                                </tr>
                                                <tr>
                                                    <td>25</td>
                                                    <td>38-40</td>
                                                    <td>23,3-25,3</td>
                                                </tr>
                                                <tr>
                                                    <td>OS</td>
                                                    <td>35-40</td>
                                                    <td>21,3-25,3</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <h3>@lang('product.tights')</h3>
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>@lang('product.size')</th>
                                                    <th>@lang('product.height')</th>
                                                    <th>@lang('product.girth')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>2</td>
                                                    <td>150-165</td>
                                                    <td>90-94</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>165-175</td>
                                                    <td>94-98</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>175-180</td>
                                                    <td>98-102</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div id="choose_size" class="form-callback size-wrap">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="img" style="background-image: url('{{route('index')}}/img/prod1.jpeg')
                                            "></div>
                                        </div>
                                        <div class="col-md-9">
                                            <h3>@lang('product.search_table')</h3>
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>INT</th>
                                                    <th>RU</th>
                                                    <th>@lang('product.table1')</th>
                                                    <th>@lang('product.table2')</th>
                                                    <th>@lang('product.table3')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>XXS</td>
                                                    <td>40</td>
                                                    <td>80</td>
                                                    <td>60</td>
                                                    <td>88</td>
                                                </tr>
                                                <tr>
                                                    <td>XS</td>
                                                    <td>42</td>
                                                    <td>84</td>
                                                    <td>64</td>
                                                    <td>92</td>
                                                </tr>
                                                <tr>
                                                    <td>S</td>
                                                    <td>44</td>
                                                    <td>88</td>
                                                    <td>68</td>
                                                    <td>96</td>
                                                </tr>
                                                <tr>
                                                    <td>M</td>
                                                    <td>46</td>
                                                    <td>92</td>
                                                    <td>72</td>
                                                    <td>100</td>
                                                </tr>
                                                <tr>
                                                    <td>L</td>
                                                    <td>48</td>
                                                    <td>96</td>
                                                    <td>76</td>
                                                    <td>104</td>
                                                </tr>
                                                <tr>
                                                    <td>XL</td>
                                                    <td>50</td>
                                                    <td>100</td>
                                                    <td>80</td>
                                                    <td>108</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <p>*@lang('product.all_sizes')</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="tech">
                        <ul>
                            @if($skus->product->vendor)
                                <li>@lang('product.sku'): {{ $skus->product->vendor }}</li>
                            @endif
                            @if($skus->product->param)
                                <li>@lang('product.parameters'): {{ $skus->product->param }}</li>
                            @endif
                            @if($skus->product->size)
                                <li>@lang('product.model_size'): {{ $skus->product->size }}</li>
                            @endif
                        </ul>
                    </div>
                    <div class="descr">
                        {!! $skus->product->__('description') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>



    @if($category->products->map->skus->flatten()->isNotEmpty())
        <div class="products related">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>@lang('product.related')</h2>
                    </div>
                </div>
                <div class="row">
                    @foreach($category->products->map->skus->flatten()->unique('product_id') as $sku)
                        @if($sku->product->id === $skus->product->id)

                        @else
                            <div class="col-md-3">
                                @include('layouts.cart', compact('sku'))
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <div class="products view">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>@lang('product.recently')</h2>
                </div>
            </div>
            <div class="row">
                @foreach($recentlies->unique('product_id') as $sku)
                    <div class="col-md-3">
                        @include('layouts.cart', compact('sku'))
                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection


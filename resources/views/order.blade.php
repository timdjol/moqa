@extends('layouts.master')

@section('title', 'Оформление заказа')

@section('content')
    <div class="page order">
        <div class="container">
            <div class="col-lg-6 col-md-12 offset-lg-3">
                <h1>@lang('basket.checkout')</h1>
                <h5>@lang('basket.total_order'): {{ $order->getFullSum() }} {{
                $currencySymbol }}</h5>
                <form action="{{ route('order-confirm') }}" method="post">
                    @error ('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="">@lang('basket.your_name')</label>
                        <input type="text" name="name" value="{{ old('name', isset($order) ? $order->name :
                             null) }}">
                    </div>
                    @error ('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="">@lang('basket.phone')</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', isset($order) ?
                        $order->phone : null) }}">
                        <div id="output" class="error"></div>
                    </div>
                    @guest
                        @error ('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email">
                        </div>
                    @endguest
                    <div class="delivery">
                        <div class="form-group">
                            <h5>@lang('checkout.delivery')</h5>
                            <input type="radio" id="del_1" name="type_address" value="@lang('checkout.courier')"
                                   checked>
                            <label for="del_1">@lang('checkout.courier')</label>
                        </div>
                        <div id="form1">
                            <div class="form-group">
                                <label for="">@lang('checkout.delivery_address')</label>
                                <input type="text" name="address" value="{{ old('address', isset($order) ? $order->address :
                             null) }}">
                            </div>
                            <div class="form-group">
                                <label for="comment">@lang('checkout.comment')</label>
                                <textarea name="comment" id="comment" rows="3">{{ old('comment', isset($order) ?
                        $order->comment :
                             null) }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="radio" id="del_2" name="type_address" value="Самовывоз">
                            <label for="del_2">@lang('checkout.pickup')</label>
                        </div>
                        <div id="form2">
                            <div class="form-group">
                                <p>{{ $contacts->first()->address }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="paymentblock">
                        <div class="form-group">
                            <h5>@lang('checkout.payment')</h5>
                            <input type="radio" id="nal" name="type_payment" value="@lang('checkout.cash')" checked>
                            <label for="nal">@lang('checkout.cash')</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" id="bank" value="@lang('checkout.card')" name="type_payment">
                            <label for="bank">@lang('checkout.card')</label>
                        </div>
                        <div id="form3">
                            <ul class="tabs">
                                <li class="current" data-tab="tab-1">@lang('checkout.russia')</li>
                                <li data-tab="tab-2">@lang('checkout.other')</li>
                            </ul>
                            <div class="tab-content current" id="tab-1">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b9/Mir-logo.SVG.svg/800px-Mir-logo.SVG.svg.png"
                                     alt="">
                                <h4>@lang('checkout.process')...</h4>
                            </div>
                            <div class="tab-content" id="tab-2">
                                <img src="https://4a7efb2d53317100f611-1d7064c4f7b6de25658a4199efb34975.ssl.cf1.rackcdn.com/visa-mastercard-agree-to-give-gas-pumps-break-on-emv-shift-showcase_image-9-p-2335.jpg"
                                     alt="">
                                <h4>@lang('checkout.process')...</h4>
                            </div>
                        </div>
                    </div>

                    @csrf
                    <button id="send" class="more">@lang('basket.confirm')</button>
                </form>
            </div>
        </div>
    </div>
@endsection


<style>
    .form-group input[type="radio"] {
        width: auto;
        height: auto;
    }

    #form2, #form3 {
        display: none;
    }

    .page ul.tabs {
        margin-top: 30px;
        padding-left: 0;
    }

    .page ul.tabs li {
        display: inline-block;
        font-size: 18px;
        padding: 5px 20px;
        border: 1px solid #ddd;
        margin-right: 10px;
    }

    .page ul.tabs li.current {
        border-color: #ab8e83;
        background-color: #ab8e83;
        color: #fff;
    }

    .page ul.tabs li::after {
        display: none;
    }

    .tab-content {
        display: none;
        padding: 20px 0;
    }

    .tab-content.current {
        display: block;
    }

    .tab-content img {
        max-width: 400px;
        margin-bottom: 30px;
    }
</style>

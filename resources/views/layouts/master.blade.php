<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - @lang('main.online_shop') Moqa</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="{{route('index')}}/css/main.min.css">
    <link rel="stylesheet" href="{{route('index')}}/css/admin.css">
    <link rel="stylesheet" href="{{route('index')}}/css/style.css">
</head>
<body>

<header>
    <div class="top-head">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <div class="logo">
                        <a href="{{route('index')}}"><img src="{{ url('/') }}/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="search d-xl-inline-block d-lg-inline-block d-md-inline-block d-none">
                        <form action="{{ route('search') }}" method="GET">
                            <input type="text" placeholder="@lang('main.search')..." name="search">
                            <button><img src="{{ url('/') }}/img/search.svg" alt=""></button>
                        </form>
                    </div>
                    <div class="search d-xl-none d-lg-none d-lg-none d-inline-block">
                        <a href="#search"><img src="{{ url('/') }}/img/search.svg" alt=""></a>
                    </div>
                    <div class="lk">
                        @guest
                            <li><a href="{{ route('login') }}"><img src="{{ url('/') }}/img/user.svg" alt=""></a></li>
                        @endguest
                        @auth
                            @admin
                            <li><a href="{{ route('dashboard') }}"><img src="{{ url('/') }}/img/user.svg" alt=""></a></li>
                        @else
                            <li><a href="{{ route('person.orders.index') }}"><img src="{{ url('/') }}/img/user.svg" alt=""></a></li>
                            @endadmin
{{--                            <li><a href="{{ route('get-logout') }}">@lang('main.exit')</a></li>--}}
                        @endauth
                    </div>
                    <div class="cart">
                        <a href="{{route('basket')}}"><img src="{{ url('/') }}/img/cart.svg" alt=""></a>
                    </div>
                    <div class="wish">
                        <a href="{{ route('wishlist') }}"><img src="{{ url('/') }}/img/wish.svg" alt=""></a>
                    </div>
                    <div class="lang">
                        <ul>
                            <li class="
                            @if(session('locale')=='ru')
                                current
                            @endif
                            "><a href="{{ route('locale', 'ru') }}">RU</a></li>
                            <li class="
                            @if(session('locale')=='en')
                                current
                            @endif
                            "><a href="{{ route('locale', 'en') }}">EN</a></li>
                        </ul>
                    </div>
                    <div class="currency">
                        <ul>
                            @foreach($currencies as $currency)
                                <li
                                  @if($currencySymbol == $currency->symbol) class="current"
                                        @endif
                                ><a href="{{ route('currency', $currency->code) }}">{{ $currency->symbol
                                }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="head">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <a href="#" class="toggle-mnu d-xl-none d-lg-none"><span></span></a>
                        <ul>
                            <li @routeactive('index')><a href="{{route('index')}}">@lang('main.home')</a></li>
                            <li @routeactive('cat*')><a href="{{route('catalog')}}">@lang('main.catalog')</a></li>
                            <li @routeactive('payment')><a href="{{route('payment')}}">@lang('main.payment')</a></li>
                            <li @routeactive('delivery')><a href="{{route('delivery')}}">@lang('main.delivery')</a></li>
                            <li @routeactive('refund')><a href="{{route('refund')}}">@lang('main.refund')</a></li>
                            <li @routeactive('about')><a href="{{route('about')}}">@lang('main.about')</a></li>
                            <li @routeactive('contactspage')><a href="{{route('contactspage')}}">@lang('main.contacts')
                            </a></li>
                            <li @routeactive('cooperation')><a href="{{route('cooperation')}}">@lang('main.cooperation')
                            </a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('success'))
                <p class="alert alert-success">{{ session()->get('success') }}</p>
            @endif
            @if(session()->has('warning'))
                <p class="alert alert-warning">{{ session()->get('warning') }}</p>
            @endif
        </div>
    </div>
</div>
@yield('content')

<footer>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <div class="logo">
                            <img src="{{ url('/') }}/img/logo.png" alt="">
{{--                            <div class="best">--}}
{{--                                <ul>--}}
{{--                                    @foreach($bestSkus as $bestSku)--}}
{{--                                        <li><a href="{{ route('sku', [$bestSku->product->category->code,--}}
{{--                                        $bestSku->product->code, $bestSku]) }}">{{--}}
{{--                                        $bestSku->product->__('title') }}</a></li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4>@lang('main.catalog')</h4>
                        <ul>
                            @foreach($categories as $category)
                                <li><a href="{{ route('category', $category->code) }}">{{ $category->__('title')
                                }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4>@lang('main.buyers')</h4>
                        <ul>
                            <li><a href="{{route('categories')}}">@lang('main.all_categories')</a></li>
                            <li><a href="{{route('delivery')}}">@lang('main.delivery')</a></li>
                            <li><a href="{{route('refund')}}">@lang('main.refund')</a></li>
                            <li><a href="{{route('where')}}">@lang('main.where')</a></li>
                            <li><a href="{{route('policy')}}">@lang('main.policy')</a></li>
                            <li><a href="{{route('reviews')}}">@lang('main.reviews')</a></li>
                            <li><a href="{{route('about')}}"@lang('main.about')</a></li>
                            <li><a href="{{route('cooperation')}}">@lang('main.cooperation')</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4>@lang('main.contacts')</h4>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copy">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>MOQA {{ date('Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<style>
    .lk li{
        display: block;
    }

</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
<script src="{{route('index')}}/js/scripts.min.js"></script>

<script>
    $(document).ready(function() {
        $('.delivery input[type="radio"]').click(function() {
            if($(this).attr('id') == 'del_1') {
                $('#form1').show();
                $('#form2').hide();
            }
            else {
                $('#form1').hide();
                $('#form2').show();
            }
        });

        $('.paymentblock input[type="radio"]').click(function() {
            if($(this).attr('id') == 'bank') {
                $('#form3').show();
            }
            else {
                $('#form3').hide();
            }
        });

    });

    const input = document.querySelector("#phone");
    const output = document.querySelector("#output");

    const iti = window.intlTelInput(input, {
        nationalMode: true,
        initialCountry: 'kg',
        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js" // just for formatting/placeholders etc
    });

    const handleChange = () => {
        let text;
        if (input.value) {
            text = iti.isValidNumber()
                ? "Действительный номер " + iti.getNumber()
                : "Неверный номер - попробуйте еще раз";
        } else {
            text = "Пожалуйста, введите действительный номер";
        }
        if (iti.isValidNumber()) {
            output.classList.add("agree");
            document.getElementById("send").disabled = false;
        } else {
            output.classList.remove("agree");
            document.getElementById("send").disabled = true;
        }
        const textNode = document.createTextNode(text);
        output.innerHTML = "";
        output.appendChild(textNode);
    };

    input.addEventListener('change', handleChange);
    input.addEventListener('keyup', handleChange);
</script>


</body>
</html>

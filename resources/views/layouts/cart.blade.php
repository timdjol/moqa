<div class="products-item">
    <div class="img-wrap">
        <div class="labels">
            @if($sku->product->isNew())
                <div class="badge badge-success">@lang('product.properties.new')</div>
            @endif
            @if($sku->product->isRecommend())
                <div class="badge badge-warning">@lang('product.properties.recommend')</div>
            @endif
            @if($sku->product->isHit())
                <div class="badge badge-danger">@lang('product.properties.hit')</div>
            @endif
        </div>
        <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code, $sku]) }}">
            <div class="img" style="background-image: url({{ Storage::url($sku->product->image) }})"></div>
        </a>
    </div>
    <h4>{{ $sku->product->__('title') }}</h4>
    @isset($sku->product->properties)
        @foreach($sku->propertyOptions as $propertyOption)
            <p style="margin-bottom: 0">{{ $propertyOption->property->__('title') }}: {{ $propertyOption->__
                ('title') }}</p>
        @endforeach
    @endisset
    <div class="price">{{ $sku->price }} {{ $currencySymbol }}</div>
    @if($sku->isAvailable())
        <form action="{{ route('basket-add', $sku) }}" method="POST">
            <button class="more" type="submit">@lang('product.addtocart')</button>
            @csrf
        </form>
    @else
        <p>@lang('product.no_available')</p>
    @endif
    <div class="wishlist">
        <form action="{{ route('wishlist-add', $sku) }}" method="POST">
            <button>
                <svg width="800px" height="800px" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"
                     stroke-width="1.5"
                     stroke="#fff" fill="none">
                    <path d="M9.06,25C7.68,17.3,12.78,10.63,20.73,10c7-.55,10.47,7.93,11.17,9.55a.13.13,0,0,0,.25,0c3.25-8.91,9.17-9.29,11.25-9.5C49,9.45,56.51,13.78,55,23.87c-2.16,14-23.12,29.81-23.12,29.81S11.79,40.05,9.06,25Z"/>
                </svg>
            </button>
            @csrf
        </form>
    </div>
</div>


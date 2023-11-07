<p>@lang('mail.dear') {{ $name }}</p>

<p>@lang('mail.order_sum') {{ $fullSum }} {{ $order->currency->symbol }} @lang('mail.order_create')</p>

<table>
    <tbody>
    @foreach($order->skus as $sku)
        <tr>
            <td>
                <a href="{{ route('sku', [$sku->product->category->code, $sku->product->code, $sku->id]) }}">
                    <img src="{{ Storage::url($sku->product->image) }}" alt="{{ $sku->product->__('title') }}">
                    {{ $sku->product->__('title') }}
                </a>
            </td>
            <td>
                <span class="badge">{{ $sku->countInOrder }}</span>
            </td>
            <td>{{ $sku->price }} {{ $order->currency->symbol }}</td>
            <td>{{ $sku->getPriceForCount() }} {{ $order->currency->symbol }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
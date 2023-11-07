<p>Уважаемый клиент, товар {{ $sku->title }} появился в наличии</p>

<a href="{{ route('product', [$sku->category->code, $sku->code]) }}">Узнать подробности</a>
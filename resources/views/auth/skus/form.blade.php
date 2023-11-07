@extends('auth.layouts.master')

@isset($sku)
    @section('title', 'Редактировать Sku' . $sku->title)
@else
    @section('title', 'Добавить Sku')
@endisset

@section('content')

    <div class="page admin">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    @include('auth.layouts.sidebar')
                </div>
                <div class="col-md-9">
                    @isset($sku)
                        <h1>Редактировать Sku {{ $sku->title }}</h1>
                    @else
                        <h1>Создать Sku</h1>
                    @endisset
                    <form method="post"
                          @isset($sku)
                              action="{{ route('skus.update', [$product, $sku]) }}"
                          @else
                              action="{{ route('skus.store', $product) }}"
                            @endisset
                    >
                        @isset($sku)
                            @method('PUT')
                        @endisset
                        @csrf

                        <div class="form-group">
                            <label for="">Цена</label>
                            @include('auth.layouts.error', ['fieldname' => 'price'])
                            <input type="text" name="price" value="@isset($sku){{ $sku->price }}@endisset">
                        </div>

                        <div class="form-group">
                            <label for="">Кол-во</label>
                            @include('auth.layouts.error', ['fieldname' => 'count'])
                            <input type="text" name="count" value="@isset($sku){{ $sku->count }}@endisset">
                        </div>

                        <div class="form-group">
                            @foreach ($product->properties as $property)
                                <div class="input-group row">
                                    <label for="property_id[{{ $property->id }}]" class="col-sm-2 col-form-label">{{
                                    $property->title }}: </label>
                                    <div class="col-sm-4">
                                        <select name="property_id[{{ $property->id }}]" class="form-control">
                                            @foreach($property->propertyOptions as $propertyOption)
                                                <option value="{{ $propertyOption->id }}"
                                                        @isset($sku)
                                                            @if($sku->propertyOptions->contains($propertyOption->id))
                                                                selected
                                                        @endif
                                                        @endisset
                                                >{{ $propertyOption->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="more">Отправить</button>
                        <a href="{{url()->previous()}}" class="btn delete cancel">Отмена</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

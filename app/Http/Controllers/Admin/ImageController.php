<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkuRequest;
use App\Models\Image;
use App\Models\Product;
use App\Models\Sku;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function create(Image $image)
    {
        return view('auth.products.form', compact('image'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @param Product $product
     */
    public function store(SkuRequest $request, Image $image, Product $product){
        $params = $request->all();
        $params['product_id'] = $request->product->id;
        $image = Image::create($params);
        session()->flash('success', 'Sku ' . $request->product->title . ' добавлен' );
        return redirect()->route('skus.index', $product);
    }
}

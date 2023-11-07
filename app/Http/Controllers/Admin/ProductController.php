<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Property;
use App\Models\Sku;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(40);
        return view('auth.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        $properties = Property::get();
        return view('auth.products.form', compact('categories', 'properties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, Product $product)
    {
        $request['code'] = Str::slug($request->title);
        $params = $request->all();
        unset($params['image']);
        if($request->has('image')){
            if($product->image != null) {
                Storage::delete($product->image);
            }
            $params['image'] = $request->file('image')->store('products');
        }

        //images
        //$product->properties()->sync($request->property_id);
        $prod = Product::create($params);

        $images = $request->file('images');
        if ($request->hasFile('images')) :
            foreach ($images as $image):
                $image = $image->store('products');
                DB::table('images')->insert(
                    array(
                        'image'=>  $image,
                        'product_id' => $prod->id,
                    )
                );
            endforeach;
        endif;

        session()->flash('success', 'Продукция ' . $request->title . ' добавлена');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, Sku $skus)
    {
        $images = Image::where('product_id', $product->id)->get();
        return view('auth.products.show', compact('product', 'skus', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        $properties = Property::get();
        $images = Image::where('product_id', $product->id)->get();
        session()->flash('success', 'Продукция ' . $product->title . ' добавлена');
        return view('auth.products.form', compact('product', 'categories', 'properties', 'images'));
    }

    /**
     * Update the specified resource in storage.
     * @param ProductRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        $request['code'] = Str::slug($request->title);
        $params = $request->all();
        unset($params['image']);
        if($request->has('image')){
            if($product->image != null) {
                Storage::delete($product->image);
            }
            $path = $request->file('image')->store('products');
            $params['image'] = $path;
        }

        //images
        //$product->update($params);
        unset($params['images']);
        $images = $request->file('images');


        if ($request->hasFile('images')) :
            if($images != null) {
                Storage::delete($images);
                DB::table('images')->where('product_id', $product->id)->delete();
            }
            foreach ($images as $image):
                $image = $image->store('products');
                //$arr[] = $image;

                DB::table('images')
                    ->where('product_id', $product->id)
                    ->updateOrInsert(['product_id' => $product->id, 'image' => $image]);
            endforeach;
        endif;

        foreach (['new', 'hit', 'recommend'] as $fieldName){
            if(!isset($params[$fieldName])){
                $params[$fieldName] = 0;
            }
        }

        $product->properties()->sync($request->property_id);
        $product->update($params);
        session()->flash('success', 'Продукция ' . $product->title . ' обновлена');
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product, Sku $sku)
    {
        $product->delete();
        $sku->where('product_id', $product->id)->delete();
        session()->flash('success', 'Продукция ' . $product->title . ' удалена');
        return redirect()->route('products.index');
    }

}

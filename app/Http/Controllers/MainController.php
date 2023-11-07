<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductsFilterRequest;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Category;
use App\Models\Currency;
use App\Models\Image;
use App\Models\Product;
use App\Models\Review;
use App\Models\Sku;
use App\Models\Slider;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        $sliders = Slider::get();
        //$skus = Sku::query()->paginate(8);
        $news = Product::query()->where('category_id', 9)->get();
        $soons = Product::query()->where('category_id', 10)->get();
        $capsules = Product::query()->where('category_id', 11)->get();
        $clothes = Product::query()->where('category_id', 12)->get();
        $sports = Product::query()->where('category_id', 13)->get();
        $homes = Product::query()->where('category_id', 14)->get();
        $beaches = Product::query()->where('category_id', 15)->get();
        $underwears = Product::query()->where('category_id', 16)->get();
        $socks = Product::query()->where('category_id', 17)->get();
        $access = Product::query()->where('category_id', 18)->get();
        $cosmetics = Product::query()->where('category_id', 19)->get();
        $sales = Product::query()->where('category_id', 20)->get();

        //$products = DB::table('skus')->get();
        return view('index', compact('soons', 'capsules', 'clothes', 'sports', 'homes', 'beaches', 'underwears', 'socks', 'access', 'cosmetics', 'sales', 'sliders', 'news'));
    }

    public function catalog(ProductsFilterRequest $request)
    {
        $skusQuery = Sku::with(['product', 'product.category']);

//        if ($request->has('category_id')) {
//            //dd($skusQuery->get());
//            $skusQuery->where('category_id', $request->category_id);
//        }

        if ($request->filled('price_from')) {
            $skusQuery->where('price', '>=', $request->price_from);
        }

        if ($request->filled('price_to')) {
            $skusQuery->where('price', '<=', $request->price_to);
        }

        foreach (['hit', 'new', 'recommend'] as $field) {
            if ($request->has($field)) {
                $skusQuery->whereHas('product', function ($query) use ($field)
                {
                    $query->$field();
                });
            }
        }
        $skus = $skusQuery->paginate(20)->withPath("?".$request->getQueryString());

//        $skus = Sku::paginate(20);
            //->distinct()
            //->unique('product_id')
            //->get();

        //$categories = Category::get();
        $product = Product::get();


        return view('catalog', compact('skus', 'product'));
    }

    public function categories()
    {
        return view('categories');
    }

    public function category($code)
    {
        $category = Category::where('code', $code)->first();

        return view('category', compact('category'));
    }

    public function sku($categoryCode, $productCode, Sku $skus, Request $request, Image $image)
    {
        if ($skus->product->code != $productCode) {
            abort(404, 'Продукция не найдена');
        }
        if ($skus->product->category->code != $categoryCode) {
            abort(404, 'Категория не найдена');
        }

        $images = Image::where('product_id', $skus->product->id)->get();

        //related sku
//        $skus_arr = DB::table('skus')
//            ->where('product_id', $skus->product->id)
//            //->orderBy('id', 'desc')
//            ->pluck('id')
//            ->toArray();
//
//        $prop_arr = DB::table('sku_property_option')
//            ->whereIn('sku_id', $skus_arr)
//            ->pluck('property_option_id')
//            ->toArray();
//
//        //color
//        $prop_opt_arr = DB::table('property_options')
//            ->where('property_id', 1)
//            ->whereIn('id', $prop_arr)
//            ->orderBy('id', 'desc')
//            ->pluck('color')
//            ->toArray();
//
//        //size
//        $prop_opt_size = DB::table('property_options')
//            ->where('property_id', 2)
//            ->whereIn('id', $prop_arr)
//            ->get();

        //relatedsku
        $relatedsku = Sku::where('product_id', $skus->product->id)->get();


        //related
        $category = Category::where('code', $categoryCode)->first();


        //recently
        if (session()->exists('recently')) {
            $arr = session('recently');
        } else{
            $arr = [];
        }

        if(!in_array($skus->product->id, $arr)){
            session()->push('recently', $skus->product->id);
        }

        $distinct = array_unique($arr);
        $reverse = array_reverse($distinct);
        //$sort = collect($distinct)->sortKeysDesc();
        //dd($reverse);

        $recentlies = Sku::whereIn('product_id', $reverse)->take(4)->get();
        //dd($recentlies);


        return view('product', compact('skus', 'images', 'relatedsku', 'category', 'recentlies'));
    }


    public function subscribe(SubscriptionRequest $request, Sku $skus)
    {
        Subscription::create([
            'email' => $request->email,
            'sku_id' => $skus->id,
        ]);

        return redirect()->back()->with('success', 'Спасибо, мы сообщим Вам о поступлении продукции');
    }

    public function changeLocale($locale)
    {
        $availableLocales = ['ru', 'en'];
        if (!in_array($locale, $availableLocales)) {
            $locale = config('app.locale');
        }
        session(['locale' => $locale]);
        App::setLocale($locale);
        return redirect()->back();
    }

    public function changeCurrency($currencyCode)
    {
        $currency = Currency::byCode($currencyCode)->firstOrFail();
        session(['currency' => $currency->code]);
        return redirect()->back();
    }

    public function search()
    {
        $title = $_GET['search'];
        $search = Product::query()
            ->where('title', 'like', '%'.$title.'%')
            ->orWhere('title_en', 'like', '%'.$title.'%')
            ->get();
        return view('search', compact('search'));
    }


}

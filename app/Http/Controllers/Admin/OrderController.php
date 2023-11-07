<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\OrderRequest;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Page;
use App\Models\Product;
use App\Models\Review;
use App\Models\Slider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::active()->paginate(10);
        return view('auth.orders.index', compact('orders'));
    }

    /**
     * @param Order $order
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show(Order $order)
    {
        $skus = $order->skus()->withTrashed()->get();
        return view('auth.orders.show', compact('order', 'skus'));
    }


    public function edit(Order $order)
    {
        return view('auth.orders.form', compact('order'));
    }

    /**
     * @param OrderRequest $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function update(OrderRequest $request, Order $order)
    {
        $params = $request->all();
        $order->update($params);
        session()->flash('success', 'Заказ ' . $request->name . ' обновлен');
        return redirect()->route('orders.index');
    }

    /**
     * @param Order $order
     * @return RedirectResponse
     */
    public function destroy(Order $order)
    {
        $order->delete();
        session()->flash('success', 'Заказ ' . $order->name . ' удален');
        return redirect()->route('orders.index');
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function dashboard()
    {
        $user = Auth::user();
        $categories = Category::get();
        $product = Product::get();
        $order = Order::get();
        $page = Page::get();
        $coupon = Coupon::get();
        $sliders = Slider::paginate(4);
        $reviews = Review::paginate(4);
        return view('auth.dashboard',
            compact('user', 'categories', 'product', 'order', 'page', 'coupon', 'sliders', 'reviews'));
    }
}


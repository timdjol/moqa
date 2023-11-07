<?php

namespace App\Http\Controllers;

use App\Classes\Basket;
use App\Http\Requests\AddCouponRequest;
use App\Http\Requests\BasketRequest;
use App\Models\Coupon;
use App\Models\Sku;
use CdekSDK2\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket()
    {
        $order = (new Basket())->getOrder();
        return view('basket', compact('order'));
    }

    public function basketAdd(Sku $skus)
    {
        $result = (new Basket(true))->addSku($skus);
        if($result){
            session()->flash('success', __('basket.added_cart') . $skus->product->__('title'));
        } else {
            session()->flash('warning', __('basket.item') . $skus->product->__('title') . __('basket.unavailable'));
        }


        return redirect()->route('basket');
    }

    public function basketRemove(Sku $skus){
        (new Basket())->removeSku($skus);

        session()->flash('warning', __('basket.delete_product') . $skus->product->__('title'));
        return redirect()->route('basket');
    }

    public function order()
    {
        $basket = new Basket();
        $order = $basket->getOrder();
        if(!$basket->countAvailable()){
            session()->flash('warning', __('basket.unavailable_full'));
            return redirect()->route('basket');
        }

        $account = 'EMscd6r9JnFiQ3bLoyjJY6eM78JrJceI';
        $password = 'PjLZkKBHEiLK3YsjtNrt3TGNG0ahs3kG';



        return view('order', compact('order'));
    }

    public function orderConfirm(BasketRequest $request)
    {
        $basket = new Basket();

        if($basket->getOrder()->hasCoupon() && !$basket->getOrder()->coupon->availableForUse()){
            $basket->clearCoupon();
            session()->flash('warning', __('basket.coupon_unavailable'));
            return redirect()->route('basket');
        }

        $email = Auth::check() ? Auth::user()->email : $request->email;

        if($basket->saveOrder($request->name, $request->phone, $email, $request->type_address, $request->address,
            $request->comment, $request->type_payment)){
            session()->flash('success', __('basket.processed'));
        } else {
            session()->flash('warning', __('basket.unavailable_full'));
        }

        return redirect()->route('index');
    }

    public function setCoupon(AddCouponRequest $request){
        $coupon = Coupon::where('code', $request->coupon)->first();
        if($coupon->availableForUse()){
            (new Basket())->setCoupon($coupon);
            session()->flash('success', __('basket.coupon_add'));
        }
        else {
            session()->flash('warning', __('basket.coupon_nouse'));
        }

        return redirect()->route('basket');
    }

    public function resetBasket(Request $request){
        $request->session()->forget('order');
        session()->flash('success', __('basket_cleared'));
        return redirect()->route('index');
    }

}

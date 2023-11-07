<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Models\Currency;
use Illuminate\Http\RedirectResponse;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::paginate(10);
        return view('auth.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currencies = Currency::get();
        return view('auth.coupons.form', compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     * @param CouponRequest $request
     * @return RedirectResponse
     */
    public function store(CouponRequest $request)
    {
        $params = $request->all();
        foreach (['type', 'only_once'] as $fieldName){
            if(isset($params[$fieldName])){
                $params[$fieldName] = 1;
            }
        }
        if(!$request->has('type')){
            $params['currency_id'] = null;
        }
        Coupon::create($params);
        session()->flash('success', 'Купон ' . $request->code . ' добавлен');
        return redirect()->route('coupons.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coupon $coupon)
    {
        return view('auth.coupons.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        $currencies = Currency::get();
        return view('auth.coupons.form', compact('coupon', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     * @param CouponRequest $request
     * @param Coupon $coupon
     */
    public function update(CouponRequest $request, Coupon $coupon)
    {
        $params = $request->all();
        foreach (['type', 'only_once'] as $fieldName){
            if(isset($params[$fieldName])){
                $params[$fieldName] = 1;
            } else {
                $params[$fieldName] = 0;
            }
        }
//        if(!$request->has('type')){
//            $params['currency_id'] = null;
//        }
        $coupon->update($params);
        session()->flash('success', 'Купон ' . $coupon->code . ' обновлен');
        return redirect()->route('coupons.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        session()->flash('success', 'Купон ' . $coupon->code . ' удален');
        return redirect()->route('coupons.index');
    }
}

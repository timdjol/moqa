<?php

namespace App\Classes;

use App\Models\Order;
use App\Models\Sku;
use App\Services\CurrencyConversion;
use Illuminate\Support\Facades\Auth;

class Wishlist
{
    public function __construct($createWishlist = false){
        $order = session('wishlist');

        if (is_null($order) && $createWishlist) {
            $data = [];
            if(Auth::check()){
                $data['user_id'] = Auth::id();
            }
            $data['currency_id'] = CurrencyConversion::getCurrentCurrencyFromSession()->id;
            $this->order = new Order($data);
            session(['wishlist' => $this->order]);
        } else {
            $this->order = $order;
        }
    }

    public function getWishlist(){
        return $this->order;
    }

    public function removeWishlist (Sku $sku){

        if ($this->order->skus->contains($sku)) {
            session()->forget('wishlist');
            return redirect()->route('index');
        }
    }

    public function addWishlist(Sku $sku){
        if ($this->order->skus->contains($sku)) {
            $pivotRow = $this->order->skus->where('id', $sku->id)->first();
            if($pivotRow->countInOrder >= $sku->count){
                return false;
            }
        } else {
            if($sku->count == 0){
                return false;
            }
            $sku->countInOrder = 1;
            $this->order->skus->push($sku);
        }

        return true;
    }
}
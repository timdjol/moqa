<?php

namespace App\Http\Controllers;

use App\Classes\Wishlist;
use App\Models\Sku;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function wishlist()
    {
        $order = (new Wishlist())->getWishlist();
        return view('wishlist', compact('order'));
    }

    public function wishlistAdd(Sku $skus)
    {
        $result = (new Wishlist(true))->addWishlist($skus);
        if($result){
            session()->flash('success', $skus->product->__('title') . __('wish.add'));
        } else {
            session()->flash('warning', $skus->product->__('title') . __('wish.unavailable'));
        }
        return redirect()->route('wishlist');
    }

    public function wishlistRemove(Sku $skus){
        (new Wishlist())->removeWishlist($skus);

        session()->flash('warning', $skus->product->__('title') . __('wish.deleted'));
        return redirect()->route('index');
    }

    public function resetWishlist(Request $request){
        $request->session()->forget('wishlist');
        session()->flash('success', __('wish.cleared'));
        return redirect()->route('index');
    }
}

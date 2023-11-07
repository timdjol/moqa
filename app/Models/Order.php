<?php

namespace App\Models;

use App\Services\CurrencyConversion;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class Order extends Model
{
    protected $fillable = ['user_id', 'currency_id', 'sum', 'coupon_id', 'name', 'phone', 'email', 'label'];

    public function skus()
    {
        return $this->belongsToMany(Sku::class)->withPivot('count', 'price')->withTimestamps();
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function calculateFullSum()
    {
        $sum = 0;
        foreach ($this->skus()->withTrashed()->get() as $sku) {
            $sum += $sku->getPriceForCount();
        }
        return $sum;
    }

    public function getFullSum($withCoupon = true)
    {
        /* подсчет суммы в валюте заказа */
        $sum = 0;
        foreach ($this->skus as $sku) {
            $sum += $sku->getPriceInCurrency($this->currency) * $sku->countInOrder;
        }

        if ($withCoupon && $this->hasCoupon()) {
            $sum = $this->coupon->applyCost($sum, $this->currency);
        }

        /* сумма в валюте сессии сайта */
        $sum = round(CurrencyConversion::convert($sum, $this->currency->code,
            CurrencyConversion::getCurrentCurrencyFromSession()->code), 0);
        return $sum;

    }

    public function saveOrder($name, $phone, $type_address, $address, $comment, $type_payment)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->type_address = $type_address;
        $this->address = $address;
        $this->comment = $comment;
        $this->type_payment = $type_payment;
        $this->status = 1;
        $this->label = 'В процессе';
        $this->sum = $this->getFullSum();
        $skus = $this->skus;
        $this->save();
        foreach ($skus as $skuInOrder) {
            $this->skus()->attach($skuInOrder, [
                'count' => $skuInOrder->countInOrder,
                'price' => $skuInOrder->price
            ]);
        }
        session()->forget('order');
        return true;
    }

    public function hasCoupon()
    {
        return $this->coupon;
    }

    public function showDate(){
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d/m/Y H:i');
    }
}

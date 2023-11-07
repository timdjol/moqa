<?php

namespace App\Services;

use App\Models\Currency;

class CurrencyConversion
{
    protected static $container;

    public static function loadContainer(){
        if(is_null(self::$container)){
            $currencies = Currency::get();
            foreach ($currencies as $currency){
                self::$container[$currency->code] = $currency;
            }
        }
    }

    public static function getCurrencies(){
        return self::$container;
    }

    public static function getCurrencyFromSession(){
        return session('currency', 'KGS');
    }

    public static function getCurrentCurrencyFromSession(){
        self::loadContainer();
        $currencyCode = self::getCurrencyFromSession();
        foreach (self::$container as $currency) {
            if($currency->code === $currencyCode){
                return $currency;
            }
        }
    }

    public static function convert($sum, $originCurrencyCode = 'KGS', $targetCurrencyCode = null){
        self::loadContainer();

        $originCurrency = self::$container[$originCurrencyCode];
        if(is_null($targetCurrencyCode)){
            $targetCurrencyCode = self::getCurrencyFromSession();
        }
        $targetCurrency = self::$container[$targetCurrencyCode];

        return $sum * $originCurrency->rate / $targetCurrency->rate;
    }

    public static function getCurrencySymbol(){
        self::loadContainer();

        $currencyFromSession = self::getCurrencyFromSession();
        $currency = self::$container[$currencyFromSession];
        return $currency->symbol;
    }
}
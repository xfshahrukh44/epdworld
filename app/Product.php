<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\HelperTrait;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_title', 'description', 'price', 'category',
        'link', 'user_id', 'sku', 'item_number'
    ];

    protected $appends = ['calculated_final_price'];

    public function categorys()
    {
        return $this->belongsTo('App\Category', 'category', 'id');
    }

    public function users()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function attributes()
    {
        return $this->hasMany('App\ProductAttribute', 'product_id', 'id');
    }

    public function userss()
    {
        return $this->belongsToMany('App\User', 'product_users', 'product_id', 'user_id')
                    ->withPivot('price', 'stock_inventory');
    }

    // Final Price Accessor
    public function getCalculatedFinalPriceAttribute()
    {
        return $this->calculateFinalPrice($this->price);
    }

    public function calculateFinalPrice($basePrice)
    {
        // Read admin-configured percents from global cache first, fall back to session/defaults
        $defaults = [
            'markup_percent' => 100.0,
            'affiliate_percent' => 30.0,
            'tax_percent' => 6.0,
            'shipping_percent' => 30.0,
            'processing_percent' => 5.0,
            'maintenance_percent' => 35.0,
        ];

        $stored = null;
        try {
            $stored = Cache::get('calc');
        } catch (\Exception $e) {
            $stored = null;
        }

        if (is_array($stored) && !empty($stored)) {
            $cfg = array_merge($defaults, $stored);
        } else {
            $cfg = [
                'markup_percent' => session('calc.markup_percent', $defaults['markup_percent']),
                'affiliate_percent' => session('calc.affiliate_percent', $defaults['affiliate_percent']),
                'tax_percent' => session('calc.tax_percent', $defaults['tax_percent']),
                'shipping_percent' => session('calc.shipping_percent', $defaults['shipping_percent']),
                'processing_percent' => session('calc.processing_percent', $defaults['processing_percent']),
                'maintenance_percent' => session('calc.maintenance_percent', $defaults['maintenance_percent']),
            ];
        }

        $base = (float) $basePrice;

        // 1) Apply markup (percent of base)
        $priceWithProfit = $base + ($base * ($cfg['markup_percent'] / 100.0));

        // 2) Subtract affiliate commission (percent of base)
        $afterCommission = $priceWithProfit - ($base * ($cfg['affiliate_percent'] / 100.0));

        // 3) Add sales tax (percent of the amount after commission)
        $afterSalesTax = $afterCommission + ($afterCommission * ($cfg['tax_percent'] / 100.0));

        // 4) Add shipping (percent of the taxed amount)
        $priceWithShipping = $afterSalesTax + ($afterSalesTax * ($cfg['shipping_percent'] / 100.0));

        // 5) Add processing fee (percent of the running total)
        $afterProcessing = $priceWithShipping + ($priceWithShipping * ($cfg['processing_percent'] / 100.0));

        // 6) Add maintenance (percent of the running total)
        $finalPrice = $afterProcessing + ($afterProcessing * ($cfg['maintenance_percent'] / 100.0));

        return round($finalPrice, 2);
    }
}

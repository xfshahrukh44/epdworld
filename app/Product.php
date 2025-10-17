<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\HelperTrait;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['product_title', 'description', 'price', 'category', 'link', 'user_id', 'sku', 'item_number'];

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
        return $this->belongsToMany('App\User', 'product_users', 'product_id', 'user_id')->withPivot('price', 'stock_inventory');
    }

    public function getCalculatedFinalPriceAttribute()
    {
        return $this->calculateFinalPrice($this->price);
    }

    public function calculateFinalPrice($basePrice)
    {
        $profitMargin = HelperTrait::returnFlag(1974);
        $shipping = HelperTrait::returnFlag(1973);
        $stripeFee = HelperTrait::returnFlag(1975);

        // --- New Formula ---
        // Step 1: 100% Markup
        $priceWithProfit = $basePrice + ($basePrice * 1.00);

        // Step 2: Subtract 30% Affiliate Commission
        $priceWithProfit -= ($basePrice * 0.30);

        // Step 3: Add 6% Sales Tax
        $priceWithProfit += ($priceWithProfit * 0.06);

        // Step 4: Add 30% Shipping
        $priceWithShipping = $priceWithProfit + ($priceWithProfit * 0.30);

        // Step 5: Add 5% Payment Processing Fee
        $priceWithShipping += ($priceWithShipping * 0.05);

        // Step 6: Add 35% Maintenance/Admin Fee
        $finalPrice = $priceWithShipping + ($priceWithShipping * 0.35);

        // --- Return same as original ---
        return round($finalPrice, 2);
    }
}

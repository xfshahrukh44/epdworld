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
    protected $fillable = ['product_title', 'description','price', 'category', 'link', 'user_id', 'sku', 'item_number'];

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
        return $this->belongsToMany('App\User', 'product_users', 'product_id','user_id')->withPivot('price', 'stock_inventory');
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

        $priceWithProfit = $basePrice * (1 + $profitMargin);
        $priceWithShipping = $priceWithProfit * (1 + $shipping);
        $finalPrice = $priceWithShipping * (1 + $stripeFee);

        return round($finalPrice, 2);
    }

}

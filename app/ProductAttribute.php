<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_attributes';

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
    protected $fillable = ['attribute_id', 'value', 'image', 'qty', 'price', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributesValues()
    {
        return $this->belongsTo('App\AttributeValue', 'value', 'id');
    }

    public function attribute()
    {
        return $this->belongsTo('App\Attributes', 'attribute_id', 'id');
    }

    // public function variationValues()
    // {
    //     return $this->belongsTo('App\Models\ProductVariationValue', 'id', 'product_attribute_id');
    // }

    public function variationValues()
    {
        return $this->hasMany('App\Models\ProductVariationValue', 'product_attribute_id', 'id');
    }


}

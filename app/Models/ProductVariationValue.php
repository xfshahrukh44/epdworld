<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariationValue extends Model
{
    use HasFactory;

    protected $table = 'product_variations';

    protected $fillable = [
        'product_attribute_id',
        'attribute_id',
        'attribute_value_id',
    ];

    public function attribute()
    {
        return $this->belongsTo('App\Attributes', 'attribute_id', 'id');
    }

    // Each variation value belongs to an attribute value
    public function attributeValue()
    {
        return $this->belongsTo('App\AttributeValue', 'attribute_value_id');
    }
}

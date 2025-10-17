<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

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
    protected $fillable = ['name', 'heading', 'detail', 'icon', 'image', 'parent', 'slug'];



    public function products()
    {
        return $this->hasMany(Product::class, 'category', 'id');
    }

    public function parent_cat()
    {
        return $this->belongsTo(self::class, 'parent');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent')->orderBy('name', 'asc');
    }

    public function grandchildren()
    {
        return $this->children()->with('grandchildren')->orderBy('name', 'asc');
    }
}

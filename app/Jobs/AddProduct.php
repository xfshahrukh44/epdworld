<?php

namespace App\Jobs;

use App\Category;
use App\Product;
use App\ProductAttribute;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AddProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $product;
    protected $title;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($product, $title)
    {
        $this->product = $product;
        $this->title = $title;
        dump($this->title);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!$category = Category::where('name', 'LIKE', '%'.$this->title.'%')->first()) {
            $category = Category::create([
                'name' => $this->title,
                'slug' => Str::slug($this->title),
            ]);
            $category_id = strval($category->id);
        } else {
            $category_id = strval($category->id);
        }

        $created_product = Product::firstOrCreate([
            'product_title' => $this->product->title,
            'category' => $category_id,
//            'sku' => $this->product->sku
        ], [
            'price' => floatval($this->product->price),
//            'item_number' => $this->product->manufacturer_part_number,
//            'unspsc' => $this->product->unspsc,
//            'manufacturer' => $this->product->manufacturer,
//            'brand' => $this->product->brand,
//            'attributes' => json_encode($this->product->attributes),
            'description' => $this->product->description,
        ]);

        //feature image
        if ($this->product->feature_image) {
            $upload_dir = 'uploads/products';
            $unique_file_name = uniqid() . '_' . basename($this->product->feature_image);
            $destinationPath = public_path($upload_dir) . DIRECTORY_SEPARATOR . $unique_file_name;
            $imageData = file_get_contents($this->product->feature_image);
            if ($imageData !== false) {
                if (file_put_contents($destinationPath, $imageData) !== false) {
                    $created_product->image = $upload_dir . '/' . $unique_file_name;
                    $created_product->save();
                }
            }
        }

        //images
        foreach ($this->product->images as $image) {
            $upload_dir = 'uploads/products';
            $unique_file_name = uniqid() . '_' . basename($image);
            $destinationPath = public_path($upload_dir) . DIRECTORY_SEPARATOR . $unique_file_name;
            $imageData = file_get_contents($image);
            if ($imageData !== false) {
                if (file_put_contents($destinationPath, $imageData) !== false) {
                    DB::table('product_imagess')->insert([

                        ['image' => ($upload_dir . '/' . $unique_file_name), 'product_id' => $created_product->id]

                    ]);
                }
            }
        }

//        //colors
//        foreach ($this->product->colors as $color) {
//            ProductAttribute::create([
//                'attribute_id' => 11,
//                'product_id' => $created_product->id,
//                'value' => $color,
//            ]);
//        }
//
//        //sizes
//        foreach ($this->product->sizes as $size) {
//            ProductAttribute::create([
//                'attribute_id' => 12,
//                'product_id' => $created_product->id,
//                'value' => $size,
//            ]);
//        }

        return true;
    }
}

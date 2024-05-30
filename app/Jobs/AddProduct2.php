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

class AddProduct2 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $category;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($category)
    {
        $this->category = $category;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!$category = Category::where('name', 'LIKE', '%'.$this->category->title.'%')->first()) {
            $category = Category::create([
                'name' => $this->category->title,
                'slug' => Str::slug($data['name']),
            ]);
            $category_id = $category->id;
        } else {
            $category_id = strval($category->id);
        }

        foreach ($this->category->products as $product) {
            dispatch(new \App\Jobs\AddProduct($product, $this->category->title));

//            $created_product = Product::firstOrCreate([
//                'product_title' => $product->title,
//                'category' => $category_id,
//    //            'sku' => $this->product->sku
//            ], [
//                'price' => floatval($product->price),
//    //            'item_number' => $product->manufacturer_part_number,
//    //            'unspsc' => $product->unspsc,
//    //            'manufacturer' => $product->manufacturer,
//    //            'brand' => $product->brand,
//    //            'attributes' => json_encode($product->attributes),
//                'description' => $product->description,
//            ]);
//
//            //feature image
//            if ($product->feature_image) {
//                $upload_dir = 'uploads/products';
//                $unique_file_name = uniqid() . '_' . basename($product->feature_image);
//                $destinationPath = public_path($upload_dir) . DIRECTORY_SEPARATOR . $unique_file_name;
//                $imageData = file_get_contents($product->feature_image);
//                if ($imageData !== false) {
//                    if (file_put_contents($destinationPath, $imageData) !== false) {
//                        $created_product->image = $upload_dir . '/' . $unique_file_name;
//                        $created_product->save();
//                    }
//                }
//            }
//
//            //images
//            foreach ($product->images as $image) {
//                $upload_dir = 'uploads/products';
//                $unique_file_name = uniqid() . '_' . basename($image);
//                $destinationPath = public_path($upload_dir) . DIRECTORY_SEPARATOR . $unique_file_name;
//                $imageData = file_get_contents($image);
//                if ($imageData !== false) {
//                    if (file_put_contents($destinationPath, $imageData) !== false) {
//                        DB::table('product_imagess')->insert([
//
//                            ['image' => ($upload_dir . '/' . $unique_file_name), 'product_id' => $created_product->id]
//
//                        ]);
//                    }
//                }
//            }
//
//            //colors
//            foreach ($product->colors as $color) {
//                ProductAttribute::create([
//                    'attribute_id' => 11,
//                    'product_id' => $created_product->id,
//                    'value' => $color,
//                ]);
//            }
//
//            //sizes
//            foreach ($product->sizes as $size) {
//                ProductAttribute::create([
//                    'attribute_id' => 12,
//                    'product_id' => $created_product->id,
//                    'value' => $size,
//                ]);
//            }
        }

        return true;
    }
}

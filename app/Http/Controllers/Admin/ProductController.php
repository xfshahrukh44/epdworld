<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;
use App\orders;
use App\orders_products;
use App\Product;
use App\imagetable;
use App\Attributes;
use App\AttributeValue;
use App\ProductAttribute;
use App\Models\ProductVariationValue;
use Illuminate\Http\Request;
use Image;
use File;
use DB;
use Session;
use Shuchkin\SimpleXLSX;
use Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        $logo = imagetable::
            select('img_path')
            ->where('table_name', '=', 'logo')
            ->first();

        $favicon = imagetable::
            select('img_path')
            ->where('table_name', '=', 'favicon')
            ->first();

        View()->share('logo', $logo);
        View()->share('favicon', $favicon);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {

        $model = str_slug('product', '-');
        if (auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first() != null) {
            $keyword = $request->get('search');
            //$perPage = 25;

            if (!empty($keyword)) {
                $product = Product::where('products.product_title', 'LIKE', "%$keyword%")
                    ->paginate(12);
            } else {
                $product = Product::orderBy('id', 'desc')->paginate(12);
            }

            return view('admin.product.index', compact('product'));
        }
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $model = str_slug('product', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {

            $att = Attributes::all();
            $attval = AttributeValue::all();

            // $items = Category::all(['id', 'name']);
            $items = Category::pluck('name', 'id');

            return view('admin.product.create', compact('items', 'att', 'attval'));
        }
        return response(view('403'), 403);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $model = str_slug('product', '-');
        if (auth()->user()->permissions()->where('name', '=', 'add-' . $model)->first() != null) {
            $this->validate($request, [
                'product_title' => 'required',
                'description' => 'required',
                'base_price' => 'required',
                'image' => 'required',
                'item_id' => 'required',
            ]);

            // Create new product
            $product = new product;
            $product->product_title = $request->input('product_title');
            $product->slug = $request->input('slug');
            $product->price = $request->input('base_price');
            $product->description = $request->input('description');
            $product->category = $request->input('item_id');

            // Handle main image upload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_main.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/products/'), $imageName);
                $product->image = 'uploads/products/' . $imageName;

            }


            $product->save();

            // Handle multiple images upload
            if ($request->hasFile('images')) {
                $photos = $request->file('images');

                foreach ($photos as $key => $photo) {
                    // Generate unique name for each image
                    $imageName = time() . '_' . $key . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                    $photo->move(public_path('uploads/products/'), $imageName);

                    // Insert new image record
                    DB::table('product_imagess')->insert([
                        'image' => 'uploads/products/' . $imageName,
                        'product_id' => $product->id
                    ]);
                }
            }

            $variationData = $request->input('attribute_values'); // Same structure you already have
            $prices = $request->input('price');
            $qtys = $request->input('qty');
            $images = $request->file('var_image');

            foreach ($variationData as $blockIndex => $attributes) {
                $productVariation = new ProductAttribute();
                $productVariation->product_id = $product->id;
                $productVariation->price = $prices[$blockIndex];
                $productVariation->qty = $qtys[$blockIndex];

                if (isset($images[$blockIndex])) {
                    $imageName = time() . '_variation_' . $blockIndex . '.' . $images[$blockIndex]->getClientOriginalExtension();
                    $images[$blockIndex]->move(public_path('uploads/product_attributes/'), $imageName);
                    $productVariation->image = 'uploads/product_attributes/' . $imageName;
                }

                $productVariation->save();

                if($productVariation) {
                    foreach ($attributes as $attributeId => $valueId) {
                        ProductVariationValue::create([
                            'product_attribute_id' => $productVariation->id,
                            'attribute_id' => $attributeId,
                            'attribute_value_id' => $valueId,
                        ]);
                    }
                }

            }

            // Handle product attributes
            // $attributeValues = $request->attribute_values;

            // if (is_array($attributeValues)) {
            //     foreach ($attributeValues as $blockIndex => $attributes) {
            //         // Build variation key
            //         $variationKeyParts = [];
            //         foreach ($attributes as $attributeId => $valueId) {
            //             $variationKeyParts[] = 'attr-' . $attributeId . '_' . $valueId;
            //         }
            //         $variationKey = implode('_', $variationKeyParts);

            //         // ✅ Upload image ONCE per variation block
            //         $imagePath = null;
            //         if ($request->hasFile("var_image.$blockIndex")) {
            //             $image = $request->file("var_image.$blockIndex");
            //             $imageName = time() . '_attr_' . $blockIndex . '.' . $image->getClientOriginalExtension();
            //             $image->move(public_path('uploads/product_attributes/'), $imageName);
            //             $imagePath = 'uploads/product_attributes/' . $imageName;
            //         }

            //         // ✅ Save each attribute row, but with the SAME image path
            //         foreach ($attributes as $attributeId => $valueId) {
            //             $productAttribute = new ProductAttribute();
            //             $productAttribute->attribute_id = $attributeId;
            //             $productAttribute->value = $valueId;
            //             $productAttribute->price = $request->price[$blockIndex];
            //             $productAttribute->qty = $request->qty[$blockIndex];
            //             $productAttribute->product_id = $product->id;
            //             $productAttribute->variation_key = $variationKey;

            //             // ✅ Set the same image path for all attributes in this block
            //             if ($imagePath) {
            //                 $productAttribute->image = $imagePath;
            //             }

            //             $productAttribute->save();
            //         }
            //     }
            // }

            return redirect('admin/product')->with('message', 'Product added!');
        }
        return response(view('403'), 403);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $model = str_slug('product', '-');
        if (auth()->user()->permissions()->where('name', '=', 'view-' . $model)->first() != null) {
            $product = Product::findOrFail($id);
            return view('admin.product.show', compact('product'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $model = str_slug('product', '-');
        if (auth()->user()->permissions()->where('name', '=', 'edit-' . $model)->first() != null) {

            $att = Attributes::all();
            $product = Product::findOrFail($id);

            $items = Category::pluck('name', 'id');

            $product_images = DB::table('product_imagess')
                ->where('product_id', $id)
                ->get();

            // Load existing variations and their attributes
            $variations = ProductAttribute::with('variationValues')->where('product_id', $product->id)->get();

            // Load all attributes
            $attributes = Attributes::with('values')->get();

            $existingVariations = ProductAttribute::where('product_id', $id)->get();


            return view('admin.product.edit', compact('product', 'items', 'product_images', 'att', 'variations', 'attributes', 'existingVariations'));
        }
        return response(view('403'), 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $model = str_slug('product', '-');
        if (auth()->user()->permissions()->where('name', '=', 'edit-' . $model)->first() != null) {
            $this->validate($request, [
                'product_title' => 'required',
                'description' => 'required',
                'item_id' => 'required'
            ]);

            $requestData['product_title'] = $request->input('product_title');
            $requestData['slug'] = $request->input('slug');
            $requestData['description'] = $request->input('description');
            $requestData['sku'] = $request->input('sku');
            $requestData['price'] = $request->input('base_price');
            $requestData['category'] = $request->input('item_id');

            // Handle main image upload
            if ($request->hasFile('image')) {
                $product = product::where('id', $id)->first();
                $image_path = public_path($product->image);

                if (File::exists($image_path)) {
                    File::delete($image_path);
                }

                $file = $request->file('image');
                $imageName = time() . '_main.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/products/'), $imageName);
                $requestData['image'] = 'uploads/products/' . $imageName;
            }

            // Handle multiple images upload
            if ($request->hasFile('images')) {
                // First delete existing images for this product if needed
                // DB::table('product_imagess')->where('product_id', $id)->delete();

                $photos = $request->file('images');

                foreach ($photos as $photo) {
                    // Generate unique name for each image
                    $imageName = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                    $photo->move(public_path('uploads/products/'), $imageName);

                    // Insert new image record
                    DB::table('product_imagess')->insert([
                        'image' => 'uploads/products/' . $imageName,
                        'product_id' => $id
                    ]);
                }
            }

            // Update product data
            product::where('id', $id)->update($requestData);

            $product = Product::findOrFail($id);

            // Delete existing variations and variation values
            $oldVariations = ProductAttribute::where('product_id', $product->id)->get();
            foreach ($oldVariations as $oldVar) {
                ProductVariationValue::where('product_attribute_id', $oldVar->id)->delete();
                $oldVar->delete();
            }

            // Save new variations
            $variationData = $request->input('attribute_values');
            $prices = $request->input('price');
            $qtys = $request->input('qty');
            $images = $request->file('var_image');

            foreach ($variationData as $blockIndex => $attributes) {
                $productVariation = new ProductAttribute();
                $productVariation->product_id = $product->id;
                $productVariation->price = $prices[$blockIndex];
                $productVariation->qty = $qtys[$blockIndex];


                if (isset($images[$blockIndex])) {
                    $imageName = time() . '_variation_' . $blockIndex . '.' . $images[$blockIndex]->getClientOriginalExtension();
                    $images[$blockIndex]->move(public_path('uploads/product_attributes/'), $imageName);
                    $productVariation->image = 'uploads/product_attributes/' . $imageName;
                }

                $productVariation->save();

                foreach ($attributes as $attributeId => $valueId) {
                    ProductVariationValue::create([
                        'product_attribute_id' => $productVariation->id,
                        'attribute_id' => $attributeId,
                        'attribute_value_id' => $valueId,
                    ]);
                }
            }

            // Handle product attributes
            // $attval = $request->attribute;
            // $product_attribute_id = $request->product_attribute;
            // $oldatt = $request->attribute_id;
            // $oldval = $request->value;
            // $oldprice = $request->v_price;
            // $oldqty = $request->qty;

            // if (is_array($oldatt)) {
            //     for ($j = 0; $j < count($oldatt); $j++) {
            //         $product_attribute = ProductAttribute::find($product_attribute_id[$j]);
            //         $product_attribute->attribute_id = $oldatt[$j];
            //         $product_attribute->value = $oldval[$j];
            //         $product_attribute->price = $oldprice[$j];
            //         $product_attribute->qty = $oldqty[$j];

            //         if ($request->hasFile("image_att.$j")) {
            //             $image = $request->file("image_att.$j");
            //             $imageName = time() . '_attr_' . $j . '.' . $image->getClientOriginalExtension();
            //             $image->move(public_path('uploads/product_attributes/'), $imageName);
            //             $product_attribute->image = 'uploads/product_attributes/' . $imageName;
            //         }

            //         $product_attribute->save();
            //     }
            // }

            // if (is_array($attval)) {
            //     for ($i = 0; $i < count($attval); $i++) {
            //         $product_attributes = new ProductAttribute;
            //         $product_attributes->attribute_id = $attval[$i]['attribute_id'];
            //         $product_attributes->value = $attval[$i]['value'];
            //         $product_attributes->price = $attval[$i]['v-price'];
            //         $product_attributes->qty = $attval[$i]['qty'];
            //         $product_attributes->product_id = $id;

            //         if ($request->hasFile("attribute.$i.image")) {
            //             $image = $request->file("attribute.$i.image");
            //             $imageName = time() . '_newattr_' . $i . '.' . $image->getClientOriginalExtension();
            //             $image->move(public_path('uploads/product_attributes/'), $imageName);
            //             $product_attributes->image = 'uploads/product_attributes/' . $imageName;
            //         }

            //         $product_attributes->save();
            //     }
            // }

            return redirect('admin/product')->with('message', 'Product updated!');
        }
        return response(view('403'), 403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $model = str_slug('product', '-');
        if (auth()->user()->permissions()->where('name', '=', 'delete-' . $model)->first() != null) {
            Product::destroy($id);

            return redirect('admin/product')->with('flash_message', 'Product deleted!');
        }
        return response(view('403'), 403);

    }
    public function orderList()
    {

        $orders = orders::
            select('orders.*')
            ->get();

        return view('admin.ecommerce.order-list', compact('orders'));
    }

    public function orderListDetail($id)
    {

        $order_id = $id;
        $order = orders::where('id', $order_id)->first();
        $order_products = orders_products::where('orders_id', $order_id)->get();



        return view('admin.ecommerce.order-page')->with('title', 'Invoice #' . $order_id)->with(compact('order', 'order_products'))->with('order_id', $order_id);

        // return view('admin.ecommerce.order-page');
    }

    public function updatestatuscompleted($id)
    {

        $order_id = $id;
        $order = DB::table('orders')
            ->where('id', $id)
            ->update(['order_status' => 'Completed']);


        Session::flash('message', 'Order Status Updated Successfully');
        Session::flash('alert-class', 'alert-success');
        return back();

    }
    public function updatestatusPending($id)
    {

        $order_id = $id;
        $order = DB::table('orders')
            ->where('id', $id)
            ->update(['order_status' => 'Pending']);


        Session::flash('message', 'Order Status Updated Successfully');
        Session::flash('alert-class', 'alert-success');
        return back();

    }




    public function csvupload()
    {
        return view('admin.product.csvupload');
    }

    public function csvuploadreq(Request $request)
    {
        if ($request->has('csvupload')) {

            // dd(request()->csvupload);
            ini_set('max_execution_time', 3600); //3 minutes

            $data = SimpleXLSX::parse(request()->csvupload);
            // dd($data);
            $array = $data->rowsEx();
            $header = $array[0];
            // dd($array);
            unset($array[0]);
            // dump($array[1]);

            foreach ($array as $key => $newArray) {
                // Product Category
                // $category = $newArray[6]['value'];
                $category = 124;

                $proCat = explode('/', $category);

                unset($proCat[0]);
                unset($proCat[1]);

                $parent = 0;

                // foreach($proCat as $key => $item)
                // {
                //dump('Category'.'"===>"'.$item);  //category

                // $items = str_replace(' ', '-', $item);

                // $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $items);

                // $slugs = strtolower($slug);

                // dump($item);
                // dump('----------------------------------------------------------------');

                // if($key != 0)
                // {
                //     $previous = Category::where('name', $proCat[$key-1])->first()->id;
                // }else{
                //     $previous = 0;
                // }

                // dd($key);

                // $categories = Category::where('name', $item)->first();


                // if(!$categories->name)
                // {
                // $cat = new Category();
                // $cat->name = $item;
                // $cat->slug = $slugs;
                // $cat->parent = ($previous == null || $previous == 0) ? 0 : $previous;
                // $cat->save();


                // }

                // dump($categories);


                //dump('slug'.'"===>"'.$slugs);  //slug
                //    }
                $moq = $newArray[9]['value'];
                // dump($moq);
                // die();

                $link = $newArray[0]['value'];   //link
                // dump($link);
                // die();
                $product_title = $newArray[5]['value'];
                //dump($product_title);  //description


                $str = $newArray[1]['value'];
                $price = (float) filter_var($str, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); // Price
                //dump($price);
                $profit_margin = 80;
                $shipping_fee = 25;
                // $margin = 1.00;
                // $supplier_fee = 5;
                // $advertisment = 3;

                $margin_final = (($profit_margin + 100) * $price) / 100;

                $shipping_final = (($shipping_fee / 100) * $margin_final);
                // $stripe_final = (($stripe_fee / 100) * $margin_final);
                // $supplier_final = (($supplier_fee / 100) * $margin_final);
                // $advertisment_final = (($advertisment / 100) * $margin_final);
                // dump($value->price);
                // dump($shipping_final);
                // dd($margin_final);
                // $final = $margin_final + $shipping_final + $stripe_final;
                $final = $margin_final + $shipping_final;
                //dump($price); // Price

                $description = $newArray[2]['value'];
                //dump($description);  //description


                // Product Image
                $doc1 = new \DOMDocument();
                @$doc1->loadHTML($newArray[3]['value']);
                $imagePrd = $doc1->getElementsByTagName('img');

                //For Signle Product Image
                $imagename = "";
                foreach ($imagePrd as $key => $tag) {
                    if ($key == '0') {
                        $prdImage = explode("_", ($tag->getAttribute('src')))[0];
                        //dump($prdImage); //Product Image
                        //dump('here');
                        // die();

                        $url = $prdImage;
                        $imagename = substr($url, strrpos($url, '/') + 1);
                        //dump($url);
                        Storage::disk('localProductImg')->put($imagename, file_get_contents($url));
                        // break;
                    }
                }

                $product = new Product();
                $product->product_title = $product_title;
                $product->description = $description;
                $product->price = $final;
                $product->image = 'uploads/products/' . $imagename;
                $product->link = $link;
                $product->category = 124;
                $product->user_id = 1;
                $product->moq = $moq;
                $product->save();
                $pro_id = $product->id;



                foreach ($imagePrd as $key => $tag) {

                    $prdImage = explode("_", ($tag->getAttribute('src')))[0]; //Product Gallery Image
                    // dump($prdImage);

                    $url = $prdImage;
                    $imagename = substr($url, strrpos($url, '/') + 1);

                    //dump($url);

                    Storage::disk('localProduct')->put($key . $imagename, file_get_contents($url));

                    DB::table('product_imagess')->insert([

                        ['image' => 'uploads/galleryimages/' . $key . $imagename, 'product_id' => $product->id]

                    ]);

                    ;
                }

                //Product Attribute Image

                $doc2 = new \DOMDocument();
                @$doc2->loadHTML($newArray[4]['value']);
                $tagName = '';

                $attrColor = $doc2->getElementsByTagName('span');

                $imagePrdAttr = $doc2->getElementsByTagName('img');

                foreach ($attrColor as $key => $tag) {

                    $prdAttClass = $tag->getAttribute('class');



                    if ($prdAttClass == 'color') {
                        // dump('----------------------------------------------------------------');
                        $prdAttColor = $tag->getAttribute('style'); //Product Attribute Color

                        $attributeValue = AttributeValue::where('value', $colorName)->first();

                        if (!$attributeValue->value) {
                            $attValue = new AttributeValue();
                            $attValue->attribute_id = 11;
                            $attValue->value = $colorName;
                            $attValue->save();
                        }

                        // $colorName = $tag->getAttribute('title');
                        //dump('hereeeee');

                        $ProductAttribute = new ProductAttribute();
                        $ProductAttribute->attribute_id = 11;
                        $ProductAttribute->value = $attValue->id;
                        $ProductAttribute->product_id = $product->id;
                        $ProductAttribute->save();



                        // dump($colorName);
                        //dump('colorCode'.'"===>"'.$prdAttColor);
                    }
                    //dump($prdAttClass);
                    if ($prdAttClass == 'price') {
                        //   dump('here----------------------------------------------------------------');


                        $colorName = $tag->getAttribute('title');

                        $attPrice = (float) filter_var($tag->nodeValue, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);


                        $attributeValue = AttributeValue::where('value', $colorName)->first();

                        if (!$attributeValue->value) {
                            $attValue = new AttributeValue();
                            $attValue->attribute_id = 11;
                            $attValue->value = $colorName;
                            $attValue->save();
                        }

                        $ProductAttribute = new ProductAttribute();
                        $ProductAttribute->attribute_id = 11;
                        $ProductAttribute->value = $attValue->id;
                        $ProductAttribute->product_id = $product->id;
                        $ProductAttribute->price = $attPrice;
                        $ProductAttribute->save();
                        //dump('Price'.'"===>"'.$attPrice);  // Attribute Price
                    }


                }
                foreach ($imagePrdAttr as $key => $tag) {

                    $prdAttImage = explode("_", ($tag->getAttribute('src')))[0]; //Product Attribute Image


                    $url = $prdAttImage;
                    $imagename = substr($url, strrpos($url, '/') + 1);

                    Storage::disk('localAttribute')->put($key . $imagename, file_get_contents($url));
                    $colorName = $tag->getAttribute('title');

                    $attributeValue = AttributeValue::where('value', $colorName)->first();

                    if (!$attributeValue->value) {
                        $attValue = new AttributeValue();
                        $attValue->attribute_id = 11;
                        $attValue->value = $colorName;
                        $attValue->save();
                    }

                    $ProductAttribute = new ProductAttribute();
                    $ProductAttribute->attribute_id = 11;
                    $ProductAttribute->value = $attValue->id;
                    $ProductAttribute->product_id = $product->id;
                    $ProductAttribute->price = $attPrice;
                    $ProductAttribute->image = 'uploads/productAttributes/' . $key . $imagename;
                    $ProductAttribute->save();
                    // dump('----------------------------------------------------------------');
                    //dump($colorName);
                    //dump('prdAtt'.'"===>"'.$prdAttImage);
                    //if($key == '0'){

                }




                // Size

                $size = $newArray[7]['value'];

                //    dump($size);
                //    die();

                $sizes = json_decode($size);

                if (!empty($sizes)) {
                    foreach ($sizes as $key => $item) {
                        if ($item->attribute_size != null) {

                            $proSize = explode('US', $item->attribute_size);

                            $attprosize = filter_var($proSize[0], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

                            if (intval($attprosize)) {

                                $attributeValue = AttributeValue::where('value', $attprosize)->first();


                                $attValue = new AttributeValue();
                                $attValue->attribute_id = 12;
                                $attValue->value = $attprosize;
                                $attValue->save();

                                $ProductAttribute = new ProductAttribute();
                                $ProductAttribute->attribute_id = 12;
                                $ProductAttribute->value = $attValue->id;
                                $ProductAttribute->product_id = $product->id;
                                $ProductAttribute->price = (float) filter_var($proSize[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                $ProductAttribute->save();



                                //dump('----------------------------------------------------------------');
                                // dump('attSize'.'"===>"'.$attprosize);
                                //dump( );
                            }





                            foreach ($proSize as $productSize) {
                                $prdSize = filter_var($productSize, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                //dump($productSize[0]);  //size
                            }


                        }

                    }
                } else {

                    $size = $newArray[8]['value'];

                    //    dump($size);

                    $sizes = json_decode($size);

                    foreach ($sizes as $key => $item) {
                        if ($item->attribute_size_one != null) {

                            $proSize = explode('US', $item->attribute_size_one);

                            foreach ($proSize as $productSize) {
                                $attributeValue = AttributeValue::where('value', $productSize)->first();


                                $attValue = new AttributeValue();
                                $attValue->attribute_id = 12;
                                $attValue->value = $productSize;
                                $attValue->save();




                                $ProductAttribute = new ProductAttribute();
                                $ProductAttribute->attribute_id = 12;
                                $ProductAttribute->value = $attValue->id;
                                $ProductAttribute->product_id = $product->id;
                                $ProductAttribute->price = $proSize[1];
                                $ProductAttribute->save();


                                // dump('attSize1'.'"===>"'.strtolower($productSize));
                            }


                        }

                    }
                }



            }

            // die();
            Session::flash('message', 'Product Uploaded Successfully!');
            Session::flash('alert-class', 'alert-success');
            return redirect('admin/product')->with('message', 'Product Uploaded Successfully!');


        }

    }


    public function getAttributeValues($id)
    {
        $values = AttributeValue::where('attribute_id', $id)->get(['id', 'value']);
        return response()->json($values);
    }

    public function searchAttributeValues(Request $request, $attributeId)
    {
        $query = $request->get('q', '');
        $page = $request->get('page', 1);
        $perPage = 10;

        $attributeValues = \App\AttributeValue::where('attribute_id', $attributeId)
            ->where('value', 'LIKE', '%' . $query . '%')
            ->paginate($perPage, ['*'], 'page', $page);

        $results = [];

        foreach ($attributeValues as $value) {
            $results[] = [
                'id' => $value->id,
                'text' => $value->value
            ];
        }

        return response()->json([
            'results' => $results,
            'pagination' => [
                'more' => $attributeValues->hasMorePages()
            ]
        ]);
    }

    public function getSingleAttributeValue($attributeId, $valueId)
    {
        $value = AttributeValue::where('attribute_id', $attributeId)
                            ->where('id', $valueId)
                            ->first(['id', 'value']);

        if (!$value) {
            return response()->json(null, 404);
        }

        // Return in Select2 format { id, text }
        return response()->json([
            'id' => $value->id,
            'text' => $value->value,
        ]);
    }
}



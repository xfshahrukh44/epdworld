<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use File;
use Hash;
use View;
use Image;
use Session;
use App\User;
use App\Banner;
use App\orders;
use App\inquiry;
use App\Product;
use App\Program;
use App\Category;
use App\Attributes;
use App\imagetable;
use App\newsletter;
use App\AttributeValue;
use App\orders_products;
use App\ProductAttribute;
use Illuminate\Http\Request;
use App\Http\Traits\HelperTrait;
use App\Models\ProductVariationValue;



class LoggedInController extends Controller
{
    use HelperTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // use Helper;

    public function __construct()
    {

        // $this->middleware('guest');
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
        //View()->share('config',$config);
    }


    public function orders()
    {

        $orders = orders::where('orders.user_id', Auth::user()->id)
            ->orderBy('orders.id', 'desc')
            ->get();
        return view('account.orders', ['ORDERS' => $orders]);

    }

    public function myorders()
    {

        $orders = orders::where('orders.seller_id', Auth::user()->id)
            ->orderBy('orders.id', 'desc')
            ->get();

        return view('account.orders', ['ORDERS' => $orders]);

    }


    public function productlist()
    {
        $products = Product::where('user_id', Auth::user()->id)->get();
        $vendor_pro = DB::table('product_users')->where('user_id', Auth::user()->id)->get();

        return view('account.products.index', compact('products', 'vendor_pro'));
    }

    public function sell_on_epd_edit(Request $request)
    {
        // dd($request->input());
        // $product = Product::find($request->product_id);
        // $user = User::find($request->user_id);
        $stock_inventory = $request->stock_inventory;
        $price = $request->price;

        $affected = DB::table('product_users')
            ->where('user_id', $request->input('user_id'))
            ->where('product_id', $request->input('product_id'))
            ->update([
                'stock_inventory' => $request->stock_inventory,
                'price' => $request->price
            ]);

        return back();
    }



    public function addnewproduct()
    {
        $data = null;
        $att = Attributes::all();
        $attval = AttributeValue::all();
        $items = Category::pluck('name', 'id');
        return view('account.products.create', compact('data', 'att', 'attval'));

    }

    public function editproduct($id)
    {
        $data = Product::find($id);
        $att = Attributes::all();
        $items = Category::pluck('name', 'id');
        $product_images = DB::table('product_imagess')
            ->where('product_id', $id)
            ->get();
        // Load existing variations and their attributes
        $variations = ProductAttribute::with('variationValues')->where('product_id', $id)->get();

        // Load all attributes
        $attributes = Attributes::with('values')->get();

        $existingVariations = ProductAttribute::where('product_id', $id)->get();
        return view('account.products.edit', compact('data', 'att', 'items', 'product_images', 'variations', 'attributes', 'existingVariations'));

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

        $attributeValues = AttributeValue::where('attribute_id', $attributeId)
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

    public function updateproduct(Request $request, $id)
    {

        $request->validate([
            'product_title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'base_price' => 'required'
        ]);

        $requestData['product_title'] = $request->input('product_title');
        $requestData['description'] = $request->input('description');
        $requestData['price'] = $request->input('base_price');
        $requestData['category'] = $request->input('category');


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


        product::where('id', $id)->update($requestData);

        $product = Product::findOrFail($id);

        // dd($product);

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


        Session::flash('message', 'Your Product has been updated Successfully');
        return redirect()->route("productlist");
    }
    public function storeproduct(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'product_title' => 'required',
            'description' => 'required',
            'base_price' => 'required',
            'image' => 'required',
            'category' => 'required',
        ]);
        // dd($request);
        $product = new product;
        $product->product_title = $request->input('product_title');
        $product->price = $request->input('base_price');
        $product->description = $request->input('description');
        $product->category = $request->input('category');
        $product->user_id = Auth::user()->id;

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

        //$photos->save();
        //$requestData = $request->all();
        //Product::create($requestData);

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

            if ($productVariation) {
                foreach ($attributes as $attributeId => $valueId) {
                    ProductVariationValue::create([
                        'product_attribute_id' => $productVariation->id,
                        'attribute_id' => $attributeId,
                        'attribute_value_id' => $valueId,
                    ]);
                }
            }

        }
        Session::flash('message', 'Your Product has been saved Successfully');
        return redirect()->route('productlist');
    }
    public function account()
    {
        $orders = orders::where('orders.user_id', Auth::user()->id)
            ->orderBy('orders.id', 'desc')
            ->get();
        $seller_order = orders::where('seller_id', Auth::user()->id)->get();
        foreach ($seller_order as $order) {
            $seller_order_products = orders_products::where('orders_id', $order->id)->get();
            //  dump($seller_order_products);
        }
        return view('account.index', ['ORDERS' => $orders, 'seller_order' => $seller_order, 'seller_order_products' => $seller_order_products]);
    }
    public function update_profile(Request $request)
    {
        $user = DB::table('profiles')->where('id', Auth::user()->id)->first();
        $validateArr = array();
        $messageArr = array();
        $insertArr = array();
        $validateArr = [
            'uname' => 'required',
            'email' => array(),
        ];
        if ($user->email != $_POST['email']) {
            $validateArr['email'] = 'required|unique:users,email,NULL,id';
        }
        if (trim($_POST['password']) != "") {
            $validateArr['password'] = 'required|min:6|confirmed';
            $validateArr['password_confirmation'] = 'required|min:6';
        }

        $this->validate($request, $validateArr, $messageArr);

        $insertArr['name'] = $_POST['uname'];
        $insertArr['email'] = $_POST['email'];
        if (trim($_POST['password']) != "") {
            $insertArr['password'] = Hash::make($_POST['password']);
        }

        DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(
                $insertArr
            );

        Session::flash('message', 'Your Profile Settings has been changed');
        Session::flash('alert-class', 'alert-success');
        return back();

    }
    public function uploadPicture(Request $request)
    {
        $user = DB::table('profiles')->where('id', Auth::user()->id)->first();

        if ($file = $request->file('pic')) {
            $extension = $file->extension() ?: 'jpg|png';
            $destinationPath = public_path() . '/storage/uploads/users/';
            $safeName = str_random(10) . '.' . $extension;
            $file->move($destinationPath, $safeName);
            //delete old pic if exists
            if (File::exists($destinationPath . $user->pic)) {
                File::delete($destinationPath . $user->pic);
            }
            //save new file path into db
            $profile->pic = $safeName;
        }
        $insertArr['pic'] = $safeName;
        DB::table('profiles')
            ->where('id', Auth::user()->id)
            ->update(
                $insertArr
            );
        Session::flash('message', 'Your Profile has been changed');
        Session::flash('alert-class', 'alert-success');
        return back();
    }
    public function updateAccount(Request $request)
    {
        $user = DB::table('users')->where('id', Auth::user()->id)->first();
        $insertArr['name'] = $_POST['name'];
        $insertArr['email'] = $_POST['email'];
        $password = $_POST['password'];
        $confirmpass = $_POST['password_confirmation'];
        if ($password == $confirmpass) {
            if (trim($_POST['password']) != "") {
                $insertArr['password'] = Hash::make($_POST['password']);
            }
            DB::table('users')
                ->where('id', Auth::user()->id)
                ->update(
                    $insertArr
                );
            Session::flash('message', 'Your password settings has been changed');
            Session::flash('alert-class', 'alert-success');
            return back();
        } else {
            Session::flash('flash_message', 'Password do not match');
            Session::flash('alert-class', 'alert-danger');
            return back();
        }
    }
    public function accountDetail()
    {
        $orders = orders::where('orders.user_id', Auth::user()->id)
            ->orderBy('orders.id', 'desc')
            ->get();
        return view('account.account', ['ORDERS' => $orders]);
    }
    public function invoice($id)
    {
        $order_id = $id;
        $order = orders::where('id', $order_id)->first();
        $order_products = orders_products::where('orders_id', $order_id)->get();
        return view('account.invoice')->with('title', 'Invoice #' . $order_id)->with(compact('order', 'order_products'))->with('order_id', $order_id);
        ;
    }
    public function friends()
    {
        return view('account.friends');
    }

    public function upload()
    {
        return view('account.upload');
    }

    public function password()
    {
        return view('account.password');
    }
}


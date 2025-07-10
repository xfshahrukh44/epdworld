<?php

namespace App\Http\Controllers;
use Hash;
use Illuminate\Http\Request;
use App\inquiry;
use App\newsletter;
use App\Program;
use App\imagetable;
use App\Banner;
use DB;
use View;
use File;
use App\Product;
use App\orders_products;
use App\orders;
use Auth;
use Session;
use App\Http\Traits\HelperTrait;
use App\Attributes;
use App\AttributeValue;
use App\ProductAttribute;
use Image;
use App\Category;
use App\User;



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
        return view('account.products.create', compact('data', 'att', 'items', 'product_images'));

    }

    public function updateproduct(Request $request, $id)
    {
        $requestData['product_title'] = $request->input('product_title');
        $requestData['description'] = $request->input('description');
        $requestData['price'] = $request->input('price');
        $requestData['category'] = $request->input('category');


        if ($request->hasFile('image')) {

            $product = product::where('id', $id)->first();
            $image_path = public_path($product->image);

            if (File::exists($image_path)) {

                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
            $pathToStore = public_path('uploads/products/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR . $fileNameToStore);

            $requestData['image'] = 'uploads/products/' . $fileNameToStore;
        }

        product::where('id', $id)
            ->update($requestData);

        if (!is_null(request('images'))) {

            $photos = request()->file('images');
            foreach ($photos as $photo) {
                $destinationPath = 'uploads/products/';

                $filename = date("Ymdhis") . uniqid() . "." . $photo->getClientOriginalExtension();
                //dd($photo,$filename);
                Image::make($photo)->save(public_path($destinationPath) . DIRECTORY_SEPARATOR . $filename);

                $product = product::where('id', $id)->first();

                DB::table('product_imagess')->insert([

                    ['image' => $destinationPath . $filename, 'product_id' => $product->id]

                ]);

            }

        }
        product::where('id', $id)
            ->update($requestData);
        $attval = $request->attribute;
        $product_attribute_id = $request->product_attribute;
        $oldatt = $request->attribute_id;
        $oldval = $request->value;
        $oldprice = $request->v_price;
        $oldqty = $request->qty;
        for ($j = 0; $j < count($oldatt); $j++) {
            $product_attribute = ProductAttribute::find($product_attribute_id[$j]);
            $product_attribute->attribute_id = $oldatt[$j];
            $product_attribute->value = $oldval[$j];
            $product_attribute->price = $oldprice[$j];
            $product_attribute->qty = $oldqty[$j];
            $product_attribute->save();
        }
        for ($i = 0; $i < count($attval); $i++) {
            $product_attributes = new ProductAttribute;
            $product_attributes->attribute_id = $attval[$i]['attribute_id'];
            $product_attributes->value = $attval[$i]['value'];
            $product_attributes->price = $attval[$i]['v-price'];
            $product_attributes->qty = $attval[$i]['qty'];
            $product_attributes->product_id = $id;
            $product_attributes->save();
        }
        Session::flash('message', 'Your Product has been updated Successfully');
        return redirect('/uploadproduct');
    }
    public function storeproduct(Request $request)
    {
        $product = new product;
        $product->product_title = $request->input('product_title');
        $product->price = $request->input('price');
        $product->description = $request->input('description');
        $product->category = $request->input('category');
        $product->user_id = Auth::user()->id;
        $file = $request->file('image');
        //make sure yo have image folder inside your public
        $destination_path = 'uploads/products/';
        $profileImage = date("Ymdhis") . "." . $file->getClientOriginalExtension();
        Image::make($file)->save(public_path($destination_path) . DIRECTORY_SEPARATOR . $profileImage);
        $product->image = $destination_path . $profileImage;
        $product->save();
        if (!is_null(request('images'))) {

            $photos = request()->file('images');
            foreach ($photos as $photo) {
                $destinationPath = 'uploads/products/';

                $filename = date("Ymdhis") . uniqid() . "." . $photo->getClientOriginalExtension();
                //dd($photo,$filename);
                Image::make($photo)->save(public_path($destinationPath) . DIRECTORY_SEPARATOR . $filename);

                DB::table('product_imagess')->insert([

                    ['image' => $destination_path . $filename, 'product_id' => $product->id]

                ]);

            }

        }
        //$photos->save();
        //$requestData = $request->all();
        //Product::create($requestData);

        $attval = $request->attribute;

        for ($i = 0; $i < count($attval); $i++) {
            $product_attributes = new ProductAttribute;
            $product_attributes->attribute_id = $attval[$i]['attribute_id'];
            $product_attributes->value = $attval[$i]['value'];
            $product_attributes->price = $attval[$i]['v-price'];
            $product_attributes->qty = $attval[$i]['qty'];
            $product_attributes->product_id = $product->id;

            $product_attributes->save();
        }
        Session::flash('message', 'Your Product has been saved Successfully');
        return redirect('/uploadproduct');
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


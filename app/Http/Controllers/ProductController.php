<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\inquiry;

use App\newsletter;
use App\Program;
use App\imagetable;
use SoapClient;
use App\Product;
use App\Category;
use App\Banner;
use App\ProductAttribute;
use DB;
use View;
use Session;
use App\Http\Traits\HelperTrait;
use App\orders;
use App\orders_products;
use Illuminate\Contracts\Session\Session as SessionSession;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Models\Productreview;

class ProductController extends Controller
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
		//$this->middleware('auth');
		$logo = imagetable::select('img_path')
			->where('table_name', '=', 'logo')
			->first();

		$favicon = imagetable::select('img_path')
			->where('table_name', '=', 'favicon')
			->first();

		View()->share('logo', $logo);
		View()->share('favicon', $favicon);
		//View()->share('config',$config);
	}

	public function index()
	{
		$products = new Product;
		if (isset($_GET['q']) && $_GET['q'] != '') {

			$keyword = $_GET['q'];

			$products = $products->where(function ($query)  use ($keyword) {
				$query->where('product_title', 'like', $keyword);
			});
		}
		$products = $products->orderBy('id', 'asc')->get();
		return view('products', ['products' => $products]);
	}

	public function productDetail($id)
	{

		$product = new Product;
		$product_detail = $product->where('id', $id)->first();
		$products = DB::table('products')->get()->take(10);
		return view('product_detail', ['product_detail' => $product_detail, 'products' => $products]);
	}

	public function categoryDetail($id)
	{

		$page = DB::table('pages')->where('id', 2)->first();

		$shops = Product::where('category', $id)->paginate(12);
        $category = Category::all();
        $latest = Product::orderBy('id', 'desc')->take(4)->get();


		return view('shop.shop', compact('shops', 'page', 'category', 'latest'));
	}


	public function cart()
	{

		$page = DB::table('pages')->where('id', 2)->first();
		$cartCount = COUNT(Session::get('cart'));
		$language = Session::get('language');
		$product_detail = DB::table('products')->first();
		if (Session::get('cart') && count(Session::get('cart')) > 0) {
			return view('shop.cart', ['cart' => Session::get('cart'), 'language' => $language, 'product_detail' => $product_detail, 'page' => $page]);
		} else {
			Session::flash('flash_message', 'No Product found');
			Session::flash('alert-class', 'alert-success');
			return redirect('/');
		}
	}

	public function saveCart(Request $request)
	{

    // dd($request->input('vendor_id'));
		$var_item = $_POST['variation'];

		$result = array();


		$product_detail = DB::table('products')->where('id', $_POST['product_id'])->first();
		$id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
		$qty = isset($_POST['qty']) ? intval($_POST['qty']) : '1';
        // dd($product_detail);


		$cart = array();
		$cartId = $id;
		if (Session::has('cart')) {

			$cart = Session::get('cart');
		}

        if($request->input('vendor_id') != null){
            $vendor_pro = DB::table('product_users')->where('user_id', $request->input('vendor_id'))->where('product_id', $product_detail->id)->first();
            $price = $vendor_pro->price;
            // dd($price);
        }else{
		$price = $product_detail->price;
        }

		if ($id != "" && intval($qty) > 0) {

			if (array_key_exists($cartId, $cart)) {
				unset($cart[$cartId]);
			}
			$productFirstrow = Product::where('id', $id)->first();


			$cart[$cartId]['id'] = $id;
			$cart[$cartId]['name'] = $productFirstrow->product_title;
			$cart[$cartId]['baseprice'] = $price;
			$cart[$cartId]['vendor_id'] = $request->input('vendor_id');
			$cart[$cartId]['qty'] = $qty;
			$cart[$cartId]['variation_price'] = 0;

			foreach ($var_item as $key => $value) {

				$data = ProductAttribute::where('product_id', $_POST['product_id'])
					->where('value', $value)->first();
				$cart[$cartId]['variation'][$data->id]['attribute'] = 	$data->attribute->name;
				$cart[$cartId]['variation'][$data->id]['attribute_val'] = 	$data->attributesValues->value;
				$cart[$cartId]['variation'][$data->id]['attribute_price'] = 	$data->price;
				$cart[$cartId]['variation_price'] += $data->price;
			}


			Session::put('cart', $cart);
// 			dd(Session::get('cart'));
			Session::flash('message', 'Product Added to cart Successfully');
			Session::flash('alert-class', 'alert-success');
			return redirect('/cart');
		} else {
			Session::flash('flash_message', 'Sorry! You can not proceed with 0 quantity');
			Session::flash('alert-class', 'alert-success');
			return back();
		}
	}
	public function updateCart()
	{

		$cart = Session::get('cart');
		$pro_id = $_POST['product_id'];
		$qty = $_POST['qty'];
		$count = 0;
		if (sizeof($_POST['row']) >= 1) {
			foreach ($cart as $key => $value) {
				foreach ($value as $key_item => $value_item) {
					if ($key_item == 'qty') {
						$cart[$key][$key_item] = (int)($_POST['row'][$count]);
					}
				}
				$count = $count + 1;
			}
		}



		// $productFirstrow = Product::where('id', $pro_id)->first();
		// $cart[$pro_id]['id'] = $pro_id;
		// $cart[$pro_id]['name'] = $productFirstrow->product_title;
		// $cart[$pro_id]['baseprice'] = $productFirstrow->price;
		// $cart[$pro_id]['qty'] = $qty;


		$variation_total = 0;
		foreach ($cart[$pro_id]['variation'] as $key => $value) {
			$variation_total += $value['attribute_price'];
		}

		$cart[$pro_id]['variation_price'] = $variation_total * $qty;


		Session::put('cart', $cart);
		Session::flash('message', 'Your Cart Updated Successfully');
		Session::flash('alert-class', 'alert-success');
		return redirect('/checkout');
	}


	public function removeCart($id)
	{

		//$id = isset($_POST['ArrayofArrays'][0]) ? $_POST['ArrayofArrays'][0] : '';

		if ($id != "") {

			if (Session::has('cart')) {

				$cart = Session::get('cart');
			}

			if (array_key_exists($id, $cart)) {

				unset($cart[$id]);
			}

			Session::put('cart', $cart);
		}

		// echo 'success';
		Session::flash('flash_message', 'Product item removed successfully');
		Session::flash('alert-class', 'alert-success');
		return back();
	}

	public function shop(Request $request, $orderBy = '')
	{


		$page = DB::table('pages')->where('id', 2)->first();

        $name = $request->name;

        $cat = $request->product_cat;

        $shops = new Product;

        if($orderBy !="" && $orderBy!= 'default'){
                if($orderBy == 'latest'){
                    $shops = $shops->orderBy('id','desc');
                }elseif($orderBy == 'price-low-high'){
                    $shops = $shops->orderBy('price','asc');
                }elseif($orderBy == 'price-high-low'){
                    $shops = $shops->orderBy('price','desc');
                }else{
                    $variable = substr($orderBy,strpos($orderBy, "-"));
                    $min = explode('-',$variable)[1];
                    $max = explode('-',$variable)[2];

                    $shops = $shops->whereBetween('price', [$min,$max]);
                }
            }

        if($name != null){
//            $shops = $shops->where('product_title', 'LIKE', "%$name%");
	        $shops = $shops->where('product_title', 'LIKE', "%$name%")->orWhere('sku', 'LIKE', "%$name%")->orWhere('item_number', 'LIKE', "%$name%");
	    }elseif($cat != null){

	        $shops = $shops->where('category', $cat);

	    }


	   // dd($shops);
        // if(!$shops->isEmpty()){
            $shops = $shops->orderByDesc('id')->paginate(12);
        // }


        $category = Category::all();
        $latest = Product::orderBy('id', 'desc')->take(4)->get();


		return view('shop.shop', compact('shops', 'page', 'category', 'latest'));
	}

	public function shopDetail($id)
	{

		$product = new Product;
		$product_detail = $product->where('id', $id)->first();
		$att_model = ProductAttribute::groupBy('attribute_id')->where('product_id', $id)->get();
		$att_id = DB::table('product_attributes')->where('product_id', $id)->get();
		$shops = DB::table('products')
			->join('categories', 'products.category', '=', 'categories.id')
			->select('products.*', 'categories.name as category_title')->take(3)->get();
		$vendor_pro = DB::table('product_users')->where('product_id', $product_detail->id)->get();
		$exist = DB::table('product_users')->where('product_id', $product_detail->id)->where('user_id', Auth::user()->id)->first();
		$reviews = Productreview::where('product_id', $product_detail->id)->get();
        //  dd($reviews);

		return view('shop.detail', compact('product_detail', 'shops', 'att_id', 'att_model', 'vendor_pro', 'exist', 'reviews'));
	}

	public function reviewFormSubmit(Request $request){
	   // dd($request->all());
	    $review = new Productreview;
	    $review->name = $request->name;
	    $review->rating = $request->rating;
	    $review->review = $request->review;
	    $review->product_id = $request->product_id;
	    $review->save();

	    Session::flash('message', 'Product Review Added Successfully');
		Session::flash('alert-class', 'alert-success');

		return back();
	}


	public function invoice($id)
	{
		$order_id = $id;
		$order = orders::where('id', $order_id)->first();
		$order_products = orders_products::where('orders_id', $order_id)->get();

		return view('account.invoice')->with('title', 'Invoice #' . $order_id)->with(compact('order', 'order_products'))->with('order_id', $order_id);;
	}

	public function checkout()
	{
		if (Session::get('cart') && count(Session::get('cart')) > 0) {
			$countries = DB::table('countries')
				->get();
			return view('checkout', ['cart' => Session::get('cart'), 'countries' => $countries]);
		} else {
			Session::flash('flash_message', 'No Product found');
			Session::flash('alert-class', 'alert-success');
			return redirect('/');
		}
	}


	public function language()
	{
		$languages = $_POST['id'];

		Session::put('language', $languages);

		Session::put('is_select_dropdown', 1);
		// Session::put('language',$languages);
		// $test = Session::get('language');

		// Session::put('test',$test);

		//return redirect('shop-detail/1', ['test'=>$test]);
	}

	public function shipping(Request $request)
	{

		$PostalCode = $request->country; // Zipcode you are shipping To

		define("ENV", "demo"); // demo OR live

		if (ENV == 'demo') {
			$client = new SoapClient("https://staging.postaplus.net/APIService/PostaWebClient.svc?wsdl");
			$Password =  '123456';
			$ShipperAccount =  'DXB51487';
			$UserName =  'DXB51487';
			$CodeStation =  'DXB';
		} else {
			$client = new SoapClient("https://etrack.postaplus.net/APIService/PostaWebClient.svc?singleWsdl");
			$Password =  '';
			$ShipperAccount =  '';
			$UserName =  '';
			$CodeStation =  '';
		}

		$params = array(
			'ShipmentCostCalculation' => array(
				'CI' => array(
					'Password' => $Password,
					'ShipperAccount' => $ShipperAccount,
					'UserName' => $UserName,
					'CodeStation' => $CodeStation,
				),
				"OriginCountryCode" => 'AE',
				"DestinationCountryCode" => $PostalCode,
				"RateSheetType" => 'DOC',
				"Width" => 1,
				"Height" => 1,
				"Length" => 1,
				"ScaleWeight" => 1,
			),
		);


		try {

			$d = $client->__SoapCall("ShipmentCostCalculation", $params);
			$d = json_decode(json_encode($d), true);

			if (isset($d['ShipmentCostCalculationResult']['Message']) and ($d['ShipmentCostCalculationResult']['Message'] == 'SUCCESS')) {
				$status = true;
				$rate = $d['ShipmentCostCalculationResult']['Amount'];
			} else {
				$status = false;
				$messgae = $d['ShipmentCostCalculationResult']['Message'];
			}
		} catch (SoapFault $exception) {
			$status = false;
			$messgae = "Error Found Please try Again";
		}

		//if($status):
		//	echo $rate;
		//else:
		//	echo $messgae;
		//endif;

		//}
		//$cart = Session::get('cart');



		if ($status) {

			$cart = Session::get('cart');
			$cart['shipping'] = $rate;
			//$cart['shipping_address'] = $_POST['shipping_address'];
			Session::put('cart', $cart);

			// return view('shop.cart', ['rate'=> $rate, 'cart'=> $cart]);
			return redirect('/cart');
		} else {
			Session::flash('flash_message', 'Error');
			Session::flash('alert-class', 'alert-success');
			return view('shop.cart', ['messgae' => $messgae]);
		}
		return view('shop.cart', ['messgae' => $messgae, 'cart' => $cart]);
	}
}

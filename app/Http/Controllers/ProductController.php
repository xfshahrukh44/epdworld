<?php

namespace App\Http\Controllers;

use DB;
use Auth;

use View;
use Session;
use App\Banner;
use App\orders;
use SoapClient;
use App\inquiry;
use App\Product;
use App\Program;
use App\Category;
use App\Attributes;
use App\imagetable;
use App\newsletter;
use App\orders_products;
use App\ProductAttribute;
use App\AttributeValue;
use Illuminate\Http\Request;
use App\Models\Productreview;
use App\Http\Traits\HelperTrait;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Session\Session as SessionSession;

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

			$products = $products->where(function ($query) use ($keyword) {
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
        // dd($request->all());
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

		// if ($request->input('vendor_id') != null) {
		// 	$vendor_pro = DB::table('product_users')->where('user_id', $request->input('vendor_id'))->where('product_id', $product_detail->id)->first();
		// 	$price = $vendor_pro->price;
		// 	// dd($price);
		// } else {
		// 	$price = $product_detail->price;
		// }

		if ($id != "" && intval($qty) > 0) {

			if (array_key_exists($cartId, $cart)) {
				unset($cart[$cartId]);
			}
			$productFirstrow = Product::where('id', $id)->first();


			$cart[$cartId]['id'] = $id;
			$cart[$cartId]['name'] = $productFirstrow->product_title;
			$cart[$cartId]['baseprice'] = $_POST['price'] ?? $product_detail->price;
			$cart[$cartId]['vendor_id'] = $request->input('vendor_id');
			$cart[$cartId]['qty'] = $qty;
			$cart[$cartId]['variation_price'] = 0;

            foreach ($var_item as $key => $val) {
                $data = ProductAttribute::where('product_id', $_POST['product_id'])->first();
                $get_att = Attributes::where('id', $key)->first();
                $get_att_val = AttributeValue::where('id', $val)->first();

                $cart[$cartId]['variation'][] = [
                    'product_att_id' => $data->id,
                    'attribute' => $get_att->name,
                    'attribute_val' => $get_att_val->value,
                    'attribute_image' => $data->image,
                ];
            }

			// foreach ($var_item as $key => $value) {

			// 	$data = ProductAttribute::where('product_id', $_POST['product_id'])
			// 		->where('id', $value)->first();
			// 	$cart[$cartId]['variation'][$data->id]['attribute'] = $data->attribute->name;
			// 	$cart[$cartId]['variation'][$data->id]['attribute_val'] = $data->attributesValues->value;
			// 	$cart[$cartId]['variation'][$data->id]['attribute_price'] = $data->price;
			// 	$cart[$cartId]['variation_price'] += $data->price;
			// }

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
						$cart[$key][$key_item] = (int) ($_POST['row'][$count]);
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

		if ($orderBy != "" && $orderBy != 'default') {
			if ($orderBy == 'latest') {
				$shops = $shops->orderBy('id', 'desc');
			} elseif ($orderBy == 'price-low-high') {
				$shops = $shops->orderBy('price', 'asc');
			} elseif ($orderBy == 'price-high-low') {
				$shops = $shops->orderBy('price', 'desc');
			} else {
				$variable = substr($orderBy, strpos($orderBy, "-"));
				$min = explode('-', $variable)[1];
				$max = explode('-', $variable)[2];

				$shops = $shops->whereBetween('price', [$min, $max]);
			}
		}

		if ($name != null) {
			//            $shops = $shops->where('product_title', 'LIKE', "%$name%");
			$shops = $shops->where(function ($q) use ($name) {
				return $q->where('product_title', 'LIKE', "%$name%")->orWhere('sku', 'LIKE', "%$name%")->orWhere('item_number', 'LIKE', "%$name%");
			});
		}
		if ($cat != null && $cat !== '0') {

			$shops = $shops->where('category', $cat);

		}


		// dd($shops);
		// if(!$shops->isEmpty()){
//            $shops = $shops->where('price', '!=', 10.00)->orderByDesc('id')->paginate(12);
		$shops = $shops->orderByDesc('id')->paginate(12);
		// }


		$category = Category::all();
		$latest = Product::orderBy('id', 'desc')->take(4)->get();


		return view('shop.shop', compact('shops', 'page', 'category', 'latest'));
	}

	public function shopDetailSlug($slug)
	{
		$product = new Product;
		$product_detail = $product->where('slug', $slug)->first();

		if (!$product_detail) {
			abort(404, 'Product not found');
		}

		$att_model = ProductAttribute::groupBy('attribute_id')->where('product_id', $product_detail->id)->get();
		$att_id = DB::table('product_attributes')->where('product_id', $product_detail->id)->get();
		$shops = DB::table('products')
			->join('categories', 'products.category', '=', 'categories.id')
			->select('products.*', 'categories.name as category_title')->take(3)->get();
		$vendor_pro = DB::table('product_users')->where('product_id', $product_detail->id)->get();
		$exist = DB::table('product_users')->where('product_id', $product_detail->id)->where('user_id', Auth::user()->id)->first();
		$reviews = Productreview::where('product_id', $product_detail->id)->get();
        // $variations = \App\ProductAttribute::with('variationValues')->where('product_id', $product_detail->id)
        //     ->get();

        // Get all variations of this product
        $variations = \App\ProductAttribute::with('variationValues.attribute', 'variationValues.attributeValue')
            ->where('product_id', $product_detail->id)
            ->get();

        // Extract all used attributes from variations
        $usedAttributeIds = [];
        $usedAttributeValueIds = [];

        foreach ($variations as $variation) {
            foreach ($variation->variationValues as $vValue) {
                $usedAttributeIds[] = $vValue->attribute_id;
                $usedAttributeValueIds[] = $vValue->attribute_value_id;
            }
        }

        $usedAttributeIds = array_unique($usedAttributeIds);
        $usedAttributeValueIds = array_unique($usedAttributeValueIds);

        // Get only the attributes that are used in variations
        $attributes = \App\Attributes::with(['values' => function ($query) use ($usedAttributeValueIds) {
            $query->whereIn('id', $usedAttributeValueIds);
        }])->whereIn('id', $usedAttributeIds)->get();

        // Get all product attributes at once to reduce queries
        $productAttributes = \App\ProductAttribute::where('product_id', $product_detail->id)
            ->with('variationValues')
            ->get();

        // Attach images only to the first attribute's values
        $firstAttribute = true;

        foreach ($attributes as $attribute) {
            foreach ($attribute->values as $value) {

                if ($firstAttribute) {
                    // Find the matching ProductAttribute
                    $productAttribute = $productAttributes->first(function ($item) use ($attribute, $value) {
                        return $item->variationValues->contains(function ($v) use ($attribute, $value) {
                            return $v->attribute_id == $attribute->id && $v->attribute_value_id == $value->id;
                        });
                    });

                    // Attach image if found
                    if ($productAttribute) {
                        $value->image = $productAttribute->image;
                    } else {
                        $value->image = null;
                    }
                }
            }

            // ✅ After processing the first attribute, we skip image assignment for the rest
            if ($firstAttribute) {
                $firstAttribute = false;
            }
        }

		return view('shop.detail', compact('product_detail', 'shops', 'att_id', 'att_model', 'vendor_pro', 'exist', 'reviews', 'variations', 'attributes'));
	}

	public function shopDetail($id)
	{
		$product = new Product;
		$product_detail = $product->where('id', $id)->first();

		if (!$product_detail) {
			abort(404, 'Product not found');
		}

		$att_model = ProductAttribute::groupBy('attribute_id')->where('product_id', $product_detail->id)->get();
		$att_id = DB::table('product_attributes')->where('product_id', $product_detail->id)->get();
		$shops = DB::table('products')
			->join('categories', 'products.category', '=', 'categories.id')
			->select('products.*', 'categories.name as category_title')->take(3)->get();
		$vendor_pro = DB::table('product_users')->where('product_id', $product_detail->id)->get();
		$exist = DB::table('product_users')->where('product_id', $product_detail->id)->where('user_id', Auth::user()->id)->first();
		$reviews = Productreview::where('product_id', $product_detail->id)->get();
        // Get all variations of this product
        $variations = \App\ProductAttribute::with('variationValues.attribute', 'variationValues.attributeValue')
            ->where('product_id', $product_detail->id)
            ->get();

        // Extract all used attributes from variations
        $usedAttributeIds = [];
        $usedAttributeValueIds = [];

        foreach ($variations as $variation) {
            foreach ($variation->variationValues as $vValue) {
                $usedAttributeIds[] = $vValue->attribute_id;
                $usedAttributeValueIds[] = $vValue->attribute_value_id;
            }
        }

        $usedAttributeIds = array_unique($usedAttributeIds);
        $usedAttributeValueIds = array_unique($usedAttributeValueIds);

        // Get only the attributes that are used in variations
        $attributes = \App\Attributes::with(['values' => function ($query) use ($usedAttributeValueIds) {
            $query->whereIn('id', $usedAttributeValueIds);
        }])->whereIn('id', $usedAttributeIds)->get();

        // Get all product attributes at once to reduce queries
        $productAttributes = \App\ProductAttribute::where('product_id', $product_detail->id)
            ->with('variationValues')
            ->get();

        // Attach images only to the first attribute's values
        $firstAttribute = true;

        foreach ($attributes as $attribute) {
            foreach ($attribute->values as $value) {

                if ($firstAttribute) {
                    // Find the matching ProductAttribute
                    $productAttribute = $productAttributes->first(function ($item) use ($attribute, $value) {
                        return $item->variationValues->contains(function ($v) use ($attribute, $value) {
                            return $v->attribute_id == $attribute->id && $v->attribute_value_id == $value->id;
                        });
                    });

                    // Attach image if found
                    if ($productAttribute) {
                        $value->image = $productAttribute->image;
                    } else {
                        $value->image = null;
                    }
                }
            }

            // ✅ After processing the first attribute, we skip image assignment for the rest
            if ($firstAttribute) {
                $firstAttribute = false;
            }
        }

		return view('shop.detail', compact('product_detail', 'shops', 'att_id', 'att_model', 'vendor_pro', 'exist', 'reviews', 'variations', 'attributes'));
	}


	public function reviewFormSubmit(Request $request)
	{
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

		return view('account.invoice')->with('title', 'Invoice #' . $order_id)->with(compact('order', 'order_products'))->with('order_id', $order_id);
		;
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
			$Password = '123456';
			$ShipperAccount = 'DXB51487';
			$UserName = 'DXB51487';
			$CodeStation = 'DXB';
		} else {
			$client = new SoapClient("https://etrack.postaplus.net/APIService/PostaWebClient.svc?singleWsdl");
			$Password = '';
			$ShipperAccount = '';
			$UserName = '';
			$CodeStation = '';
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

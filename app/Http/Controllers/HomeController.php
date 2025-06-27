<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\inquiry;
use App\schedule;
use App\newsletter;
use App\post;
use App\banner;
use App\imagetable;
use App\Category;
use DB;
use Mail;use View;
use Session;
use App\Http\Helpers\UserSystemInfoHelper;
use App\Http\Traits\HelperTrait;
use Auth;
use App\Profile;
use App\Page;
use Image;
use App\Product;
use App\User;
use App\Blog;

class HomeController extends Controller
{
    use HelperTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     // use Helper;

     public $cat_array =[];

    public function __construct()
    {
        //$this->middleware('auth');



        $logo = imagetable::
                     select('img_path')
                     ->where('table_name','=','logo')
                     ->first();

        $favicon = imagetable::
                     select('img_path')
                     ->where('table_name','=','favicon')
                     ->first();

        View()->share('logo',$logo);
        View()->share('favicon',$favicon);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $page = DB::table('pages')->where('id', 1)->first();
       $banner = DB::table('banners')->where('slider_cat', 0)->get();
       $second_banner = DB::table('banners')->where('slider_cat', 1)->get();
       $section = DB::table('section')->where('page_id', 1)->get();
       $product = Product::latest()->limit(12)->get();
       $product_all = Product::inRandomOrder()->limit(12)->get();
       $category = Category::inRandomOrder()->limit(24)->get();

       return view('welcome', compact('page', 'banner', 'second_banner', 'section', 'product', 'product_all', 'category'));
    }
    
    public function india(){
        
        return view('india');
    }
    
    public function italy(){
        
        return view('italy');
    }
    
    public function malaysia(){
        
        return view('malaysia');
    }
    
    public function mexico(){
        
        return view('mexico');
    }
    
    public function spain(){
        
        return view('spain');
    }
    
    public function australia(){
        
        return view('australia');
    }
    
    public function brazil(){
        
        return view('brazil');
    }
    
    public function canada(){
        
        return view('canada');
    }
    
    
    public function france(){
        
        return view('france');
    }
    
    public function germany(){
        
        return view('germany');
    }

    public function dubai(){
        return view('dubai');
    }

    public function denmark(){
        return view('denmark');
    }

    public function egypt(){
        return view('egypt');
    }

    public function ghana(){
        return view('ghana');
    }

    public function kenya(){
        return view('kenya');
    }

    public function nigeria(){
        return view('nigeria');
    }

    public function norway(){
        return view('norway');
    }

    public function senegal(){
        return view('senegal');
    }

    public function southAfrica(){
        return view('south-africa');
    }

    public function sweden(){
        return view('sweden');
    }




    public function children_category($category,$cat_id)
    {
        $array = [];
        foreach($category->children as $value)
        {
            array_push($array,$value->id);

            if (count($value->children)>0)
            {
                $this->cat_array[$value->id] = [];

                $this->children_category($value,$value->id);
            }
            else{
                // $this->cat_array[$value->id] =$cat_id;
            }


        }

    }
    public function generate_tree($categories)
    {
        foreach ($categories as $category) {
            echo '<li id="categoryId_' . $category->id . '">';
            echo $category->name;
            if ($category->children) {
                echo '<ul>';
                generate_tree($category->children);
                echo '</ul>';
            }
            else{
                return 0;
            }
            echo '</li>';
        }
    }
    public function buildTree($array,$id_key = 'id',$parent_key = 'parent_id'){
        $res = [];
        foreach($array as $y){
            $array_with_id[$y[$id_key]] = $y;
        }
        foreach($array_with_id as $key => $element){
            if($element[$parent_key]){
                $array_with_id[$element[$parent_key]]['childrens'][$key] = &$array_with_id[$key];
            }else{
                $res[$element[$id_key]] = &$array_with_id[$key];
            }
        }
        return $res;
    }

    public function test123()
    {
        $product  = Product::all();

            // $value  = Product::find(646);

         foreach($product as $value){
            $profit_margin = 80;
            $shipping_fee = 25;
            // $margin = 1.00;
            // $supplier_fee = 5;
            // $advertisment = 3;

            $margin_final = (($profit_margin + 100) * $value->price) /100;

            $shipping_final = (($shipping_fee / 100) * $margin_final);
            // $stripe_final = (($stripe_fee / 100) * $margin_final);
            // $supplier_final = (($supplier_fee / 100) * $margin_final);
            // $advertisment_final = (($advertisment / 100) * $margin_final);
            // dump($value->price);
            // dump($shipping_final);
            // dd($margin_final);
            // $final = $margin_final + $shipping_final + $stripe_final;
            $final = $margin_final + $shipping_final;

            dump($value->price);

            $product = DB::table('products')->where('id', $value->id)->update(['price' => $final]);

            dump('--------------------------');

            dump($value->price);

            dump('==========================');

         }


    }

    public function about()
    {
        $page = DB::table('pages')->where('id', 2)->first();
        $section = DB::table('section')->where('page_id', 2)->get();

        return view('about', compact('page', 'section'));
    }

    public function features(Request $request)
    {
        $page = DB::table('pages')->where('id', 3)->first();


        $name = $request->name;

        $cat = $request->product_cat;

        $shops = new Product;

        if($name != null){

	        $shops = $shops->where('product_title', 'LIKE', "%$name%");
	    }elseif($cat != null){
	        $shops = $shops->where('category', $cat);
	    }
	        $shops = $shops->paginate(12);



        $category = Category::all();
        $latest = Product::orderBy('id', 'desc')->take(4)->get();



        return view('features', compact('shops', 'page', 'category', 'latest'));
    }

    public function contact()
    {
        $page = DB::table('pages')->where('id', 4)->first();

        return view('contact', compact('page'));
    }


    public function seller_profile($slug){
        $user = User::where('slug', $slug)->first();
        $product = Product::where('user_id', $user->id)->paginate(12);
        $vendor_pro = DB::table('product_users')->where('user_id', $user->id)->get();
        // dd($vendor_pro);
        return view('seller-profile', compact('user', 'product', 'vendor_pro'));
    }

    public function sell_on_epd(Request $request){
        // dd($request->input());
        $product = Product::find($request->product_id);
        $user = User::find($request->user_id);
        $stock_inventory = $request->stock_inventory;
        $price = $request->price;

        $product->userss()->attach($user, ['price' => $price, 'stock_inventory' => $stock_inventory]);

        return back();
    }


    public function careerSubmit(Request $request)
    {


        inquiry::create($request->all());


        return response()->json(['message'=>'Thank you for contacting us. We will get back to you asap', 'status' => true]);
        return back();
    }

    public function newsletterSubmit(Request $request){

        $is_email = newsletter::where('newsletter_email',$request->newsletter_email)->count();
        if($is_email == 0) {
            $inquiry = new newsletter;
            $inquiry->newsletter_email = $request->newsletter_email;
            $inquiry->save();
            return response()->json(['message'=>'Thank you for contacting us. We will get back to you asap', 'status' => true]);

        }else{
            return response()->json(['message'=>'Email already exists', 'status' => false]);
        }

    }

    public function updateContent(Request $request){
        $id = $request->input('id');
        $keyword = $request->input('keyword');
        $htmlContent = $request->input('htmlContent');
        if($keyword == 'page'){
            $update = DB::table('pages')
                        ->where('id', $id)
                        ->update(array('content' => $htmlContent));

            if($update){
                return response()->json(['message'=>'Content Updated Successfully', 'status' => true]);
            }else{
                return response()->json(['message'=>'Error Occurred', 'status' => false]);
            }
        }else if($keyword == 'section'){
            $update = DB::table('section')
                        ->where('id', $id)
                        ->update(array('value' => $htmlContent));
            if($update){
                return response()->json(['message'=>'Content Updated Successfully', 'status' => true]);
            }else{
                return response()->json(['message'=>'Error Occurred', 'status' => false]);
            }
        }
    }

    public function blog_detail (Request $request, $slug = null)
    {
        if (!$slug) {
            $blog = null;
            return view('blog_detail', compact('blog'));
        }

        if (!$blog = Blog::where('slug', $slug)->first()) {
            return redirect()->back();
        }

        return view('blog_detail', compact('blog'));
    }

}

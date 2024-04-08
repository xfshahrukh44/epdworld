<?php

namespace App\Http\Controllers\productreview;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Productreview;
use Illuminate\Http\Request;
use Image;
use File;

class ProductreviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $model = str_slug('productreview','-');

            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $productreview = Productreview::where('name', 'LIKE', "%$keyword%")
                ->orWhere('designation', 'LIKE', "%$keyword%")
                ->orWhere('rating', 'LIKE', "%$keyword%")
                ->orWhere('review', 'LIKE', "%$keyword%")
                ->orWhere('product_id', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $productreview = Productreview::paginate($perPage);
            }

            return view('productreview.productreview.index', compact('productreview'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
            return view('productreview.productreview.create');
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
            $productreview = new Productreview($request->all());

            if ($request->hasFile('image')) {

                $file = $request->file('image');

                //make sure yo have image folder inside your public
                $productreview_path = 'uploads/productreviews/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($productreview_path) . DIRECTORY_SEPARATOR. $profileImage);

                $productreview->image = $productreview_path.$profileImage;
            }

            $productreview->save();
            return redirect()->back()->with('message', 'Productreview added!');

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

            $productreview = Productreview::findOrFail($id);
            return view('productreview.productreview.show', compact('productreview'));
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
            $productreview = Productreview::findOrFail($id);
            return view('productreview.productreview.edit', compact('productreview'));

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

            $requestData = $request->all();


        if ($request->hasFile('image')) {

            $productreview = Productreview::where('id', $id)->first();
            $image_path = public_path($productreview->image);
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/productreviews/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/productreviews/'.$fileNameToStore;
        }


            $productreview = Productreview::findOrFail($id);
            $productreview->update($requestData);
            return redirect()->back()->with('message', 'Productreview updated!');


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

            Productreview::destroy($id);
            return redirect()->back()->with('message', 'Productreview deleted!');


    }
}

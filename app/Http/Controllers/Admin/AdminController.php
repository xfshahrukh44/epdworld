<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\imagetable;
use Auth;
use App\inquiry;
use DB;
use Image;
use File;
use App\User;
use Mail;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */

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

    public function index()
    {
        return view('auth.login')->with('title','Josue Francois');;
    }

	public function dashboard()
    {
        return view('admin.dashboard.index');
    }


    public function configSettingUpdate()
    {

        if(isset($_POST)) {

            foreach($_POST as $key=>$value) {
                if($key=='_token') {
                    continue;
                }

                DB::UPDATE("UPDATE m_flag set flag_value = '".$value."',flag_additionalText = '".$value."' where flag_type = '".$key."'");


            }
        }
		session()->flash('message', 'Successfully Updated');
        return redirect('admin/config/setting');

    }

	public function faviconEdit() {

		$user = Auth::user();
		$favicon = DB::table('imagetable')->where('table_name', 'favicon')->first();

		return view('admin.dashboard.index-favicon')->with(compact('favicon'))->with('title',$user->name.' Edit Favicon');

    }

    public function faviconUpload(Request $request)
    {
        // Validate the image input
        $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        $file = $request->file('image');

        // Create a clean, unique filename
        $originalName = $file->getClientOriginalName();
        $fileName = pathinfo($originalName, PATHINFO_FILENAME);
        $fileName = str_replace(' ', '_', $fileName);
        $fileExt = $file->getClientOriginalExtension();
        $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;

        $destinationPath = public_path('uploads/imagetable/');
        $fullImagePath = $destinationPath . DIRECTORY_SEPARATOR . $fileNameToStore;

        // Resize to 16x16 and save
        Image::make($file)->resize(16, 16)->save($fullImagePath);

        // Fetch existing favicon record
        $imagetable = imagetable::where('table_name', 'favicon')->first();

        // If it exists, delete old file
        if ($imagetable && File::exists(public_path($imagetable->img_path))) {
            File::delete(public_path($imagetable->img_path));
        }

        // Save or update record
        if (!$imagetable) {
            $imagetable = new imagetable();
            $imagetable->table_name = 'favicon';
        }

        $imagetable->img_path = 'uploads/imagetable/' . $fileNameToStore;
        $imagetable->save();

        session()->flash('message', 'Successfully updated the favicon');
        return redirect('admin/favicon/edit');
    }


	public function logoEdit() {

		$user = Auth::user();

		return view('admin.dashboard.index-logo')->with('title',$user->name.'  Edit Logo');

    }

    public function logoUpload(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        ]);

        $imagetable = imagetable::where('table_name', 'logo')->first();

        $file = $request->file('image');

        // Create a clean, unique file name
        $originalName = $file->getClientOriginalName();
        $fileName = pathinfo($originalName, PATHINFO_FILENAME);
        $fileName = str_replace(' ', '_', $fileName);
        $fileExt = $file->getClientOriginalExtension();
        $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;

        $destinationPath = public_path('uploads/imagetable/');

        // Delete old file if record exists
        if ($imagetable && File::exists(public_path($imagetable->img_path))) {
            File::delete(public_path($imagetable->img_path));
        }

        // Save new image
        $file->move($destinationPath, $fileNameToStore);

        // Save or update the record
        if (!$imagetable) {
            $imagetable = new imagetable();
            $imagetable->table_name = 'logo';
        }

        $imagetable->img_path = 'uploads/imagetable/' . $fileNameToStore;
        $imagetable->save();

        session()->flash('message', 'Successfully updated the logo');
        return redirect('admin/logo/edit');
    }


	public function contactSubmissions() {
	 	$contact_inquiries = DB::table('inquiry')->get();

	 	return view('admin.inquires.contact_inquiries', compact('contact_inquiries'));

	}

	public function contactSubmissionsDelete($id) {

		  $del = DB::table('inquiry')->where('id',$id)->delete();

		  if($del) {
			  return redirect('admin/contact/inquiries')->with('flash_message', 'Contact deleted!');
		  }

	}

    public function inquiryshow($id)
    {
            $inquiry = inquiry::findOrFail($id);
            return view('admin.inquires.inquirydetail', compact('inquiry'));
    }

	public function newsletterInquiries() {

	 	$newsletter_inquiries = DB::table('newsletter')->get();

	 	return view('admin.inquires.newsletter_inquiries', compact('newsletter_inquiries'));

	}

	public function newsletterInquiriesDelete($id) {
		  $del = DB::table('newsletter')->where('id',$id)->delete();

		  if($del) {
			  return redirect('admin/newsletter/inquiries')->with('flash_message', 'Contact deleted!');
		  }

	}

	public function requestuser(){

	    $user = User::where('is_seller', 1)->where('is_approved', 0)->get();
	    return view('admin/affiliateuser/requestuser', compact('user'));
	}

	public function alluser(){

	    $user = User::where('is_seller', 1)->where('is_approved', 1)->get();
	    return view('admin/affiliateuser/all', compact('user'));
	}

	public function isseller(Request $request){
	    $is_approved = DB::table('users')
              ->where('id', $request->user_id)
              ->update(['is_approved' => 1]);

        $user = User::find($request->user_id);

        $emails = $user->email;
        $data = [];
        $subject = 'EPD WORLD - BECOME A AFFILIATE REQUEST APPROVAL';
        Mail::send('seller_request',$data, function($message) use ($emails, $subject){
            $message->from(config('services.mail.username'), 'EPD WORLD - BECOME A AFFILIATE REQUEST APPROVAL');
            $message->to($emails)->subject($subject);
        });

        return back()->with('flash_message', 'Seller Approved!');
	}


	public function configSetting(){
		return view('admin.dashboard.index-config');
	}

}

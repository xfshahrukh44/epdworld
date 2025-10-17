<?php

namespace App\Http\Controllers\Auth;

use App\Profile;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Session;
use Illuminate\Support\Str;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];

        if (!empty($data['is_seller']) && $data['is_seller'] == 1) {
            $rules = array_merge($rules, [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:500',
                'country' => 'required|string|max:255',
                'why_join' => 'required|string',
                'affiliate_experience' => 'required|string|in:yes,no',
                'agree_terms' => 'required',
                'agree_noncompete' => 'required',
                'agree_disclosure' => 'required',
                'agree_promote' => 'required',
                'printed_name' => 'required|string|max:255',
                'signature' => 'required|string|max:255',
                'application_date' => 'required|date',
            ]);

            // اب یہ فیلڈز required ہیں کیونکہ default value ہے
            $rules = array_merge($rules, [
                'instagram_yesno' => 'required|string|in:yes,no',
                'facebook_yesno' => 'required|string|in:yes,no',
                'youtube_yesno' => 'required|string|in:yes,no',
                'tiktok_yesno' => 'required|string|in:yes,no',
                'other_yesno' => 'required|string|in:yes,no',
                'competing_brands_yesno' => 'required|string|in:yes,no',
                'commission_transfer' => 'required|string|in:yes,no',
            ]);

            // Conditional validation - صرف جب Yes ہو تو required
            if (isset($data['instagram_yesno']) && $data['instagram_yesno'] === 'yes') {
                $rules['instagram_handle'] = 'required|string|max:255';
            }
            if (isset($data['facebook_yesno']) && $data['facebook_yesno'] === 'yes') {
                $rules['facebook_name'] = 'required|string|max:255';
            }
            if (isset($data['youtube_yesno']) && $data['youtube_yesno'] === 'yes') {
                $rules['youtube_page'] = 'required|string|max:255';
            }
            if (isset($data['tiktok_yesno']) && $data['tiktok_yesno'] === 'yes') {
                $rules['tiktok_channel'] = 'required|string|max:255';
            }
            if (isset($data['other_yesno']) && $data['other_yesno'] === 'yes') {
                $rules['other_social'] = 'required|string|max:255';
            }
            if (isset($data['competing_brands_yesno']) && $data['competing_brands_yesno'] === 'yes') {
                $rules['competing_brands_details'] = 'required|string|max:255';
            }
            if (isset($data['affiliate_experience']) && $data['affiliate_experience'] === 'yes') {
                $rules['experience_details'] = 'required|string|max:255';
                $rules['experience_details2'] = 'required|string|max:255';
            }
        }

        return Validator::make($data, $rules);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            \Log::error('Validation Errors:', $validator->errors()->toArray());
            return redirect()->back()->withInput()->withErrors($validator, 'registerForm');
        }

        event(new Registered($user = $this->create($request->all())));

        $data = $request->all();
        $emails = config('services.mail.username'); // from config
        $subject = 'EPD WORLD - New Affiliate Application';

        /**
         * Email to Admin with full application data
         */
        Mail::send('seller_request_approval', $data, function ($message) use ($emails, $subject, $user) {
            $message->from($user->email, 'EPD WORLD Affiliate');
            $message->to('info@epdworld.com') // Admin email fixed
                ->replyTo($user->email, $user->name)
                ->subject($subject);
        });

        /**
         * Email to User (thank you)
         */
        Mail::send('seller_request', ['user' => $user], function ($message) use ($emails, $user) {
            $message->from($emails, 'EPD WORLD Affiliate');
            $message->to($user->email)
                ->subject('Thank you for applying - EPD WORLD Affiliate Program');
        });

        $this->guard()->login($user);

        Session::flash('message', 'Your application has been submitted successfully.');
        Session::flash('alert-class', 'alert-success');

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // Full name combine karo
        $fullName = trim(($data['first_name'] ?? '') . ' ' . ($data['last_name'] ?? ''));

        // 1. Create the user first
        $user = User::create([
            'name' => $fullName,
            'slug' => Str::slug($fullName),
            'email' => $data['email'],
            'is_seller' => $data['is_seller'] ?? 0,
            'image' => 'image/noimage.png',
            'password' => Hash::make($data['password']),
        ]);

        // 2. If seller → create profile with extra affiliate details
        if (!empty($data['is_seller']) && $data['is_seller'] == 1) {
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->localisation = $data['localisation'] ?? null;
            $profile->dob = $data['dob'] ?? null;
            $profile->gender = $data['gender'] ?? null;
            $profile->country = $data['country'] ?? null;
            $profile->state = $data['state'] ?? null;
            $profile->city = $data['city'] ?? null;
            $profile->address = $data['address'] ?? null;
            $profile->postal = $data['postal'] ?? null;

            $profile->phone = $data['phone'] ?? null;
            $profile->company_name = $data['company_name'] ?? null;
            $profile->why_join = $data['why_join'] ?? null;
            $profile->affiliate_experience = $data['affiliate_experience'] ?? null;
            $profile->experience_details = $data['experience_details'] ?? null;
            $profile->experience_details2 = $data['experience_details2'] ?? null;

            $profile->instagram_yesno = $data['instagram_yesno'] ?? null;
            $profile->instagram_handle = $data['instagram_handle'] ?? null;
            $profile->facebook_yesno = $data['facebook_yesno'] ?? null;
            $profile->facebook_name = $data['facebook_name'] ?? null;
            $profile->youtube_yesno = $data['youtube_yesno'] ?? null;
            $profile->youtube_page = $data['youtube_page'] ?? null;
            $profile->tiktok_yesno = $data['tiktok_yesno'] ?? null;
            $profile->tiktok_channel = $data['tiktok_channel'] ?? null;
            $profile->other_yesno = $data['other_yesno'] ?? null;
            $profile->other_social = $data['other_social'] ?? null;

            $profile->competing_brands_yesno = $data['competing_brands_yesno'] ?? null;
            $profile->competing_brands_details = $data['competing_brands_details'] ?? null;
            $profile->hear_about = $data['hear_about'] ?? null;
            $profile->commission_transfer = $data['commission_transfer'] ?? null;
            $profile->about_yourself = $data['about_yourself'] ?? null;


            $profile->agree_terms = isset($data['agree_terms']) ? 1 : 0;
            $profile->agree_noncompete = isset($data['agree_noncompete']) ? 1 : 0;
            $profile->agree_disclosure = isset($data['agree_disclosure']) ? 1 : 0;
            $profile->agree_promote = isset($data['agree_promote']) ? 1 : 0;

            $profile->printed_name = $data['printed_name'] ?? null;
            $profile->signature = $data['signature'] ?? null;
            $profile->application_date = $data['application_date'] ?? now();

            $profile->save();
        }

        return $user;
    }

    protected function registered(Request $request, $user)
    {
        if ($user->profile == null) {
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->localisation = $request->localisation;
            $profile->dob = $request->dob;
            $profile->save();
        }
        $user->assignRole('user');
    }
}
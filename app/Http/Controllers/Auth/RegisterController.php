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
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];

        if (!empty($data['is_seller']) && $data['is_seller'] == 1) {
            // Affiliate Seller Application validation
            $rules = array_merge($rules, [
                'first_name'          => 'required|string|max:255',
                'last_name'           => 'required|string|max:255',
                'phone'               => 'required|string|max:20',
                'address'             => 'required|string|max:500',
                'country'             => 'required|string|max:255',
                'why_join'            => 'required|string',
                'affiliate_experience' => 'required|string|in:yes,no',
                'agree_terms'         => 'required',
                'agree_noncompete'    => 'required',
                'agree_disclosure'    => 'required',
            ]);
        } else {
            // Normal User registration
            $rules = array_merge($rules, [
                'name' => 'required|string|max:255',
            ]);
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
            return redirect()->back()->withInput()->withErrors($validator, 'registerForm');
        }

        event(new Registered($user = $this->create($request->all())));

        // Email notification to admin
        $emails = config('services.mail.username');
        $subject = 'EPD WORLD - New Affiliate Application';

        $data = $request->all(); // full form data
        Mail::send('seller_request_approval', $data, function ($message) use ($emails, $subject) {
            $message->from(config('services.mail.username'), 'EPD WORLD Affiliate');
            $message->to($emails)->subject($subject);
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
            'name'      => $fullName,
            'slug'      => Str::slug($fullName),
            'email'     => $data['email'],
            'is_seller' => $data['is_seller'] ?? 0,
            'image'     => 'image/noimage.png',
            'password'  => Hash::make($data['password']),
        ]);

        // 2. If seller → create profile with extra affiliate details
        if (!empty($data['is_seller']) && $data['is_seller'] == 1) {
            $profile = new Profile();
            $profile->user_id              = $user->id;
            $profile->localisation         = $data['localisation'] ?? null;
            $profile->dob                  = $data['dob'] ?? null;
            $profile->gender               = $data['gender'] ?? null;
            $profile->country              = $data['country'] ?? null;
            $profile->state                = $data['state'] ?? null;
            $profile->city                 = $data['city'] ?? null;
            $profile->address              = $data['address'] ?? null;
            $profile->postal               = $data['postal'] ?? null;

            // Affiliate application fields
            $profile->company_name         = $data['company_name'] ?? null;
            $profile->why_join             = $data['why_join'] ?? null;
            $profile->affiliate_experience = $data['affiliate_experience'] ?? null;
            $profile->experience_details   = $data['experience_details'] ?? null;
            $profile->experience_details2  = $data['experience_details2'] ?? null;
            $profile->social_media         = !empty($data['social_media'])
                ? json_encode($data['social_media'])
                : null;
            $profile->competing_brands     = $data['competing_brands'] ?? null;
            $profile->hear_about           = $data['hear_about'] ?? null;
            $profile->payment_method       = $data['payment_method'] ?? null;
            $profile->about_yourself       = $data['about_yourself'] ?? null;
            $profile->signature            = $data['signature'] ?? null;
            $profile->application_date     = $data['application_date'] ?? now();

            $profile->save();
        }

        return $user;
    }


    protected function registered(Request $request, $user)
    {
        // dd($request->all());
        if ($user->profile == null) {
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->localisation = $request->localisation;
            $profile->dob = $request->dob;
            $profile->save();
        }
        // activity($user->name)
        //     ->performedOn($user)
        //     ->causedBy($user)
        //     ->log('Registered');
        $user->assignRole('user');
    }
}

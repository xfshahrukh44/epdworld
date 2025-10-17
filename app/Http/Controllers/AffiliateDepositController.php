<?php

namespace App\Http\Controllers;

use App\Models\AffiliateUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AffiliateDepositController extends Controller
{

    public function affiliate_deposit()
    {
        $affiliate = AffiliateUser::where('user_id', auth()->id())->first();
        return view('account.affiliate_deposit', compact('affiliate'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'business_name' => 'nullable|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'account_holder_name' => 'required|string',
            'bank_name' => 'required|string',
            'account_number' => 'required|string',
            'routing_swift_bic_code' => 'required|string',
            'account_type' => 'nullable|string',
            'bank_location' => 'nullable|string',
            'currency' => 'nullable|string',
            'printed_name' => 'required|string',
            'signature' => 'required|string',
            'date' => 'required|date|after_or_equal:today',
        ]);

        AffiliateUser::updateOrCreate(
            ['user_id' => auth()->id()],
            array_merge($data, ['user_id' => auth()->id()])
        );

        return back()->with('success', 'Affiliate details saved successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AffiliateUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AffiliateDepositController extends Controller
{

    public function affiliate_deposit()
    {
        return view('account.affiliate_deposit');
    }

    public function store(Request $request)
    {
        // dd(123);
        $request->validate([
            'full_name' => 'required|string|max:255',
            'business_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string',

            'account_holder_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:100',
            'routing_swift_bic_code' => 'required|string|max:100',
            'account_type' => 'nullable|string|max:50',
            'bank_location' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:50',

            'printed_name' => 'required|string|max:255',
            'signature' => 'nullable|string',
            'date' => 'nullable|date',
        ]);
        // dd($request->all());

        AffiliateUser::create([
            'user_id' => Auth::id(),
            'full_name' => $request->full_name,
            'business_name' => $request->business_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'account_holder_name' => $request->account_holder_name,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'routing_swift_bic_code' => $request->routing_swift_bic_code,
            'account_type' => $request->account_type,
            'bank_location' => $request->bank_location,
            'currency' => $request->currency,
            'printed_name' => $request->printed_name,
            'signature' => $request->signature,
            'date' => $request->date,
        ]);

        return back()->with('success', 'Affiliate form submitted successfully!');
    }
}

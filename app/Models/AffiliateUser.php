<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffiliateUser extends Model
{
    use HasFactory;

    
    protected $table = 'affiliate_user';

    protected $fillable = [
        'user_id',
        'full_name',
        'business_name',
        'email',
        'phone',
        'address',
        'account_holder_name',
        'bank_name',
        'account_number',
        'routing_swift_bic_code',
        'account_type',
        'bank_location',
        'currency',
        'printed_name',
        'signature',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerForm extends Model
{
    protected $fillable = [
        'user_id', 'first_name', 'last_name', 'email', 'phone', 'business_name', 'business_type',
        'country', 'business_address', 'product_types',
        'manufacture','shipping', 'music_plan',
        'payment_method',  'business_certificate',
        'government_id', 'contract', 
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    protected $fillable = [
        'seller_id',
        'gross_revenue',
        'platform_fee',
        'net_revenue',
    ];
}

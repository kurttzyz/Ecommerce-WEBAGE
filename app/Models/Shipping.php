<?php
namespace App\Models;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model {
    protected $fillable = [
        'order_id',
        'shipping_method', 
        'address', 'city',
        'zip_code',
        'mobile_number',
        'shipping_status', 
        'tracking_number',
        'full_name',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}

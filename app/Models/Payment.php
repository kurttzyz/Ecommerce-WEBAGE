<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    protected $fillable = [
        'order_id',
        'payment_method',
        'payment_status',
        'transaction_id',
        'amount',
        'card_number',
        'expiry',
        'cvc',
        'paypal_email',
        'account_name',
        'bank_name',
        'iban',
        'gcash_name',
        'gcash_number',
        'COD',
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }
}

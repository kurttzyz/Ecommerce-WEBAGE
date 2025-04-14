<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model {
    protected $fillable = [
        'user_id', 
        'total_amount',
        'payment_status',
        'shipment_status',
        'status',
        'paymongo_intent_id',
        'paymongo_status',
        'paymongo_response',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany {
        return $this->hasMany(OrderItem::class); // Note: Should be OrderItem (singular)
    }

    public function payment(): HasOne {
        return $this->hasOne(Payment::class); // Note: Singular Payment
    }

    public function shipping(): HasOne {
        return $this->hasOne(Shipping::class);
    }
}
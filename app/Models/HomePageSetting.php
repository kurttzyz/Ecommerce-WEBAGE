<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomePageSetting extends Model {

    use HasFactory;
    protected $fillable = [
        'discounted_product_id',
        'discounted_amount',
        'discount_heading',
        'discount_subheading',
        'featured_product_1_id',
        'featured_product_2_id',
    ];

    public function discountedProduct(){
        return $this->belongsTo(Product::class, 'discounted_product_id');
    }

    public function featuredProduct1(){
        return $this->belongsTo(Product::class, 'featured_product_1_id');
    }

    public function featuredProduct2(){
        return $this->belongsTo(Product::class, 'featured_product_2_id');
    }
}

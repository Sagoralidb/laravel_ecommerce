<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product2 extends Model
{
    use HasFactory;

    // মডেলটির সংযোগ টেবিলের নাম
    protected $table = 'products2';
    

    // মডেলের ফিল্ড গুলো যা ডেটা ইনসার্ট করা হবে
    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'compare_price',
        'sku',
        'barcode',
        'track_qty',
        'qty',
        'status',
        'category_id',
        'sub_category_id',
        'brand_id',
        'is_featured',
        'size'
    ];


    public function products_images()
    {
        return $this->hasMany(product2_images::class, 'product_id', 'id');
    }
    

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
   
    public function product_ratings() {
        return $this->hasMany(ProductRating::class, 'product_id')->where('status',1);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class,'product_id');
    }
    // Product2.php Model

       
    public function soldQuantity()
    {
        return $this->orderItems()
                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->where('orders.status', '!=', 'cancelled')
                    ->sum('order_items.qty');
    }
    public function CancelledQuantity()
    {
        return $this->orderItems()
                    ->join('orders', 'order_items.order_id', '=', 'orders.id')
                    ->where('orders.status', '=', 'cancelled')
                    ->sum('order_items.qty');
    }

}

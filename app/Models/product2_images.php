<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class product2_images extends Model
{
    use HasFactory;
     // মডেলটির সংযোগ টেবিলের নাম
     protected $table = 'product2_images';

     protected $fillable = ['product_id', 'image'];

     public function product2()
     {
         return $this->belongsTo(Product2::class, 'product_id');
     }
     
}

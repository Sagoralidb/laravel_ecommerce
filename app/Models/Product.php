<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =['name','slug','quantity','price']; //protected $guarded = [];

    public const PRODUCT_IMAGE  = 1;

    public function gallery()
    {
        //return $this->hasOne(Gallery::class,'gallery_id','id');
        return $this->hasOne(Gallery::class);
    }
    
}
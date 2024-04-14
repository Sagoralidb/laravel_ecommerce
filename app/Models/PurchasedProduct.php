<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedProduct extends Model
{
    use HasFactory;

    //protected $fillable =   ['user_id','name','quantity','price']; //recommended

    protected $guarded = [];  // not recommended

    public function gallery()
    {     
        return $this->hasOne(Gallery::class);
    }
    
}

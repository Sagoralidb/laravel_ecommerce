<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // protected $fillable =['user_id','transaction_id','amount','currency','product_name','quantity','status'];

    // /**
    //  * Interact with the user's first name.
    //  *
    //  * @return \Illuminate\Database\Eloquent\Casts\Attribute
    //  */
    // public $preventAttrSet  = false;

    // protected function amount(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (int $value) =>$this->preventAttrSet==true ? $value : $value / 100,
    //         set: fn (int $value) =>$this->preventAttrSet==true ? $value : $value * 100,
    //     );
    // }


}

    
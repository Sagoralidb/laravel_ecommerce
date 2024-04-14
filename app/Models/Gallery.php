<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public $uploadDir       ='assets/site/img/';

    protected $fillable     =['image','type'];

    public function image() : Attribute
    {
        return Attribute::make(
            get: fn ($image) => $this->uploadDir. $image
        );
        
    }
}

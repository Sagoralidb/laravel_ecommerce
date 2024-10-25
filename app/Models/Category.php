<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // protected $fillable = ['name', 'slug', 'image', 'status', 'showHome'];

    // public function getImageAttribute($image)
    // {
    //     return asset('uploads/category/' . $image);
    // }

    // public function getThumbnailAttribute($image)
    // {
    //     return asset('uploads/category/thumb/' . $image);
    // }

    // public function sub_category()
    // {
    //     return $this->hasMany(SubCategory::class);
    // }

    public function sub_category(){
        return $this->hasMany(SubCategory::class);
    }
}

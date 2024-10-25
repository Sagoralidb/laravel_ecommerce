<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TempImage extends Model
{
    use HasFactory;
    // protected $table = ['temp_images'];
    protected $fillable = ['image'];

    // যেসব ফিল্ডগুলি সময় করে হালনাগাদ হওয়ার সময় আপডেট হতে পারে
    const UPDATED_AT = null;

    // যেসব ফিল্ডগুলি নতুন ডেটা সংযুক্ত হওয়ার সময় এক্টিভ হবে
    protected $dates = [];
}


<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Admin extends Model implements Authenticatable
{
    use AuthenticableTrait;
    protected $table ='users';
    protected $fillable =[
        'name','email','password',
    ];

    use HasFactory;

    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }
}

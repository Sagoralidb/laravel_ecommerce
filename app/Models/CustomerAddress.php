<?php
// Project 2 Model: We will manage The customer Address 
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;
    protected $table = 'customer_addressess'; 

    protected $fillable =[
        'user_id', 
        'first_name', 
        'last_name', 
        'email', 
        'mobile', 
        'country_id', 
        'address' , 
        'apartment', 
        'city', 
        'state', 
        'zip', 
    ];
}

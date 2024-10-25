<?php
// Project 2
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable =[   
    'user_id',
    'subtotal',
    'shipping',
    'discount',
    'grand_total',
    'first_name',
    'last_name',
    'email',
    'mobile',
    'country_id',
    'address',
    'apartment',
    'state',
    'city',
    'zip',
    'notes',

    ];

    public function items() {
        return $this->hasMany(OrderItem::class);
    }
    public function user() {
        return $this->belongsTo(CustomerAddress::class);
    }
}

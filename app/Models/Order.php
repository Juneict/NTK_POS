<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'customer_id',
        'user_id',
        'order_price',
        'paying',
        'deleted'
    ];

    public function customers(){
        return $this->belongsTo('App\Models\Customer','customer_id');
    }

    public function payments(){
        return $this->hasOne(Payment::class, 'order_id');
    }

    public function order_items(){
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function total(){
        return $this->order_items->map(function($i){
            return $i->price;
        })->sum();
    }

    
}

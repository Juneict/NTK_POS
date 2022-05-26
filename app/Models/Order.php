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
        'user_id'
    ];

    public function customers(){
        return $this->belongsTo('App\Models\Customer','customer_id');
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function order_items(){
        return $this->hasMany(OrderItem::class);
    }

    public function total(){
        return $this->order_items->map(function($i){
            return $i->price;
        })->sum();
    }
}

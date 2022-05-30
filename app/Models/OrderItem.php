<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'order_id',
        'product_id',
        'deleted'
    ];
    public function order(){
        return $this->belongsTo('App\Models\Order','order_id');
    }
}
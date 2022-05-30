<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $fillable = [
        'amount',
        'order_id',
        'customer_id',
        'deleted'
    ];
    
    public function order(){
        return $this->belongsTo('App\Models\Order','order_id');
    }
}

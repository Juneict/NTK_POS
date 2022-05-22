<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = [
        'customer_name',
        'phone',
        'address'
    ];
    public function order(){
        return $this->hasMany('App\Models\Order');
    }
}

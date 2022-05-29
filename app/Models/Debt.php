<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    use HasFactory;

    protected $table = 'debts';

    protected $fillable = [
        'customer_id',
        'total_amount',
        'total_received'
    ];

}

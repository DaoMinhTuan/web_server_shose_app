<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oder extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'address_id',
        'number',
        'total',
        'note',
        'paymentAmount',
        'status'
    ];
}

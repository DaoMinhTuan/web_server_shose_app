<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'color_id','size_id','product_id','quantity','price'
    ];
}

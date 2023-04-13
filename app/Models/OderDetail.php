<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OderDetail extends Model
{
    use HasFactory;
    protected $table = 'oderdetail';
    protected $fillable = [
        'oder_id','product_id','quantity','price','status','attributes'
    ];
}

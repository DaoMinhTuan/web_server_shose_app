<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    // protected $table = 'users';
    protected $fillable = [
        'name','address','phoneNumber','email','password','avatar',
        'role_id','status'
    ];
}

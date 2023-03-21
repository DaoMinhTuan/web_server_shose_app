<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'name', 'address_id', 'phoneNumber', 'email', 'password', 'avatar',
        'role_id', 'status', 'token'
    ];


    public function get_user($id)
    {
        $query = DB::table($this->table)->where('id', $id)->select($this->fillable);
        $user = $query->first();
        return $user;
    }
}

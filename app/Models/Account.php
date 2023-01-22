<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
protected $table="accounts";
     protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'user_type',
        'role_id',
        'photo',
    ];

    public function role(){
         $this->belongsTo(Role::class,'role_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','customer_id','name','phone','email','n_id','address','status'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id')->select('id','name','email');
    }
}

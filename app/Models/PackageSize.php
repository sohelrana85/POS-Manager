<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageSize extends Model
{
    protected $fillable = ['user_id','unit_id','name','status'];
    use HasFactory;

    public function unitTypes(){
        return $this->BelongsTo(UnitType::class, 'unit_id')->select('id','name');
    }
}

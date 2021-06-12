<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user',
        'product_name',
        'product_code',
        'product_desc',
        'category',
        'brand',
        'unit_type',
        'package_size',
        'unit_selling_price',
        'discount_price',
        'discount_price_from',
        'discount_price_to',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user', 'id')->select('id','name');
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category', 'id')->select('id','name');
    }
    public function brand(){
        return $this->belongsTo(Brand::class, 'brand', 'id')->select('id','name');
    }
    public function unit(){
        return $this->belongsTo(UnitType::class, 'unit_type', 'id')->select('id','name');
    }
    public function package(){
        return $this->belongsTo(PackageSize::class, 'package_size', 'id')->select('id','name');
    }
}

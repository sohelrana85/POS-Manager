<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable =['user','product_name','warehouse','stock_qty','stock_value'];

    public function product_name(){
        return $this->belongsTo(Product::class, 'product_name')->select('id','product_name','unit_selling_price');
    }
}

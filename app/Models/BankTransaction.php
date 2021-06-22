<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','date','transaction_type','bank_name','debit','credit','description'];

    public function bank_names(){
        return $this->belongsTo(BankAccount::class, 'bank_name')->select('id','bank_name');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
            'user',
            'date',
            'expense_type',
            'payment_status',
            'paid_amount',
            'due_amount',
            'payment_type',
            'bank_account',
            'remarks'
    ];

    public function expense(){
        return $this->belongsTo(ExpenseType::class, 'expense_type')->select('id','expense_type');
    }
    public function pType(){
        return $this->belongsTo(PaymentType::class, 'payment_type')->select('id','name');
    }
    public function bAccount(){
        return $this->belongsTo(BankAccount::class, 'bank_account')->select('id','bank_name');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseEntry1 extends Model
{
    use HasFactory;
    protected $table="expense_entry1s";
    protected $fillable=[
        'expense_entry_id',
        'amount',
        'select_expense',
        'expence_head',
        'select_catagory'
      
    ];
}

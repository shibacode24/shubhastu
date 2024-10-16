<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseHead extends Model
{
    use HasFactory;
    protected $table="expense_heads";
    protected $fillable=[
        'expense',
        'expense_head_id'
      
    ];
}

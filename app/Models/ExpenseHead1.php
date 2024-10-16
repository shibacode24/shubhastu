<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseHead1 extends Model
{
    use HasFactory;
    protected $table="expense_head1s";
    protected $fillable=[
        
        'select_Category'
      
    ];
}

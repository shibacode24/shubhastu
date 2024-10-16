<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseEntry extends Model
{
    use HasFactory;

    protected $table="expense_entries";
    protected $fillable=[
        'select_year',
        'select_month',
        'select_company',
        'select_category'
      
    ];
    



}

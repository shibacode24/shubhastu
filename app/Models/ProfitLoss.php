<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfitLoss extends Model
{
    use HasFactory;
    protected $table="profit_losses";
    protected $fillable=[
        'select_year',
        'select_month',
        'select_company',
       
    ];
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secondary_Sale extends Model
{
    use HasFactory;
    protected $table="secondary__sales";
    protected $fillable=['year_id','sale_of_month','select_company_id','select_stokist_id','sale_value','grand_total1','pdf'];


    
}

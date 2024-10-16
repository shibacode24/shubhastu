<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecondaryMedicine extends Model
{
    use HasFactory;
    protected $table="secondary_medicines";
   protected $fillable=['select_medicine','select_batch','qnty','purchase_rate','qntypurchase','secondary__sales_id','select_stokist_id','sale_value','grand_total2'];
}
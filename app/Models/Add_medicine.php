<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Add_medicine extends Model
{
    use HasFactory;
    protected $table="add_medicines";
    protected $fillable=[
        'role',

    'medicinesecond_id',
    'batch_no_id',
    'mrp',
    'given_gst',
    'purchase',
    'gst'
    ,'amount_after_gst',
    'retail_margin'
    ,'ptr',
    'stockist_margin',
    'pts',
    'management',
    'promotion_cost',
    'scheme',
    'default_scheme',
    'scheme_amount_deduct',
    'transport_expiry_breakage',
    'tot',
    'marketing_working_cost',
    'company_profit',
    'percent_profit_to_investment',
    'marketing_promotion_scheme',
    'percent_profit_to_ptr'
];
}



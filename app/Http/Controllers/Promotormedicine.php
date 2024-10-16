<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotormedicine extends Model
{
    use HasFactory;
    protected $table = "promotorsalemedicine";
    protected $fillable = [
        'promotor__sales_id',
        'append_no',
        'role',
        'select_stokist_id',
        'select_medical_id',
        'medicine_id',
        'batch_no_id',
        'ptrs',
        'mpss',
        'qntys',
        'qnty_mps_total',
        'qnty_ptr_total',
        'grandtot1',
        'grandtot2',
        'select_batchs'
    ];
}

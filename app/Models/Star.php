<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    use HasFactory;
    protected $table="stars";
    protected $fillable=[
        'select_company',
        'name_of_star',
        'bank_name',
        'account_no',
        'ifsc_code',
        'pan_no'
 ];
}

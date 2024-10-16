<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Primary_Sale extends Model
{
    use HasFactory;
    protected $table="primary__sales";
    protected $fillable=[
        'select_company_id',
    'medicine_id',
    'batch_no',
    'mrp',
    'expiry_date',
    'quantitys'];

}

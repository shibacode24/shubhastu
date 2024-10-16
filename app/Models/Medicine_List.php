<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine_List extends Model
{
    use HasFactory;
    protected $table="medicinesecond";
    protected $fillable=[
        'select_company_id',
    'medicine_id',
    'batch_no_id',
    'mrp',
    'given_gst',
    'purchase'];
}

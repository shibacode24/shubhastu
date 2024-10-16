<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newmedicinemaster extends Model
{
    use HasFactory;
    protected $table="newmedicinemaster";
    protected $fillable=[
    'select_company_id',
    'select_medical_id',
    'medicine_id',
    'batch_no',
    'expiry_date',
    'quantity',
    'mrp',
    'given_gst',
    'purchase'
];

protected $casts = [
    
    'select_medical_id' => 'array',
];

public function getLinkmAttribute()
{
    $link=Medical::whereIn('id',$this->select_medical_id)->pluck('medical')->toArray(); 
    return implode(', ',$link);
}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotor_Sale extends Model
{
    use HasFactory;
    protected $table="promotor__sales";
    protected $fillable=['year_id','sale_of_month','select_company_id','select_marketing_id','select_doctor_id','
    select_scheme','grand_total1','grand_total2','date','tds','tds_mps','date','tds','payable'];

    public function getmarketingrAttribute()
    {
        $link=explode(',',$this->select_company_id);
        $link=Addcompany::whereIn('id',$link)->pluck('Name')->toArray(); 
        return implode(', ',$link);
    }
}

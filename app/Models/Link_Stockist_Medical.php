<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link_Stockist_Medical extends Model
{
    use HasFactory;
    protected $table="link__stockist__medicals";
    protected $fillable=['select_city_id','select_company_id','select_stockist_id','select_medical_id'];

    protected $casts = [
        'select_company_id' => 'array',
        'select_medical_id' => 'array',
    ];
    //table me ek se zada value show krne ke liye
    public function getLinkmedicalAttribute()
    {
        //$link=explode(',',$this->select_company_id);
        $link=Addcompany::whereIn('id',$this->select_company_id)->pluck('Name')->toArray(); 
        return implode(', ',$link);
    }

    // public function getLinkMedAttribute()
    // {
    //     $link=Medical::whereIn('id',$this->select_medical_id)->pluck('medical')->toArray(); 
    //     return implode(', ',$link);
    // }

    public function getLinkMedAttribute()
{
    // Check if select_medical_id is null or empty
    if ($this->select_medical_id === null || empty($this->select_medical_id)) {
        return 'No medical selection'; // Or any default message you prefer
    }
    
    // Retrieve medical information based on select_medical_id
    $link = Medical::whereIn('id', $this->select_medical_id)->pluck('medical')->toArray(); 
    
    // If there are no matching records, return a default message
    if (empty($link)) {
        return 'No medical records found'; // Or any default message you prefer
    }
    
    // Otherwise, implode the medical information and return
    return implode(', ', $link);
}

}

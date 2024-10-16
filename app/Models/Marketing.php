<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Marketing extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $guard = "marketings";
    protected $table="marketings";
    protected $fillable=['city_id','select_company_id','name','mobile','email','address','username','
    password','pan','aadhar_card','plain_password'];

    protected $hidden = [
        'password'
    ];


    public function getmarketingAttribute()
    {
        $link=explode(',',$this->city_id);
        $link=City::whereIn('id',$link)->pluck('city')->toArray(); 
        return implode(', ',$link);
    }

    public function getmarketingrAttribute()
    {
        $link=explode(',',$this->select_company_id);
        $link=Addcompany::whereIn('id',$link)->pluck('Name')->toArray(); 
        return implode(', ',$link);
    }
}

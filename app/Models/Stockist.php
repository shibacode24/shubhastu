<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockist extends Model
{
    use HasFactory;
    protected $table="stockists";
    protected $fillable=['city_id','stockist'];
    
}
